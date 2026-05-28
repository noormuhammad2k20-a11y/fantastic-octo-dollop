<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class TempMailController extends Controller
{
    private $secMailUrl = 'https://www.1secmail.com/api/v1/';
    private $mailTmUrl = 'https://api.mail.tm';

    /**
     * Get or generate a temporary email.
     */
    public function index()
    {
        $email = Session::get('temp_mail_address');
        $provider = Session::get('temp_mail_provider');

        Log::info("Index Request. SessionID: " . Session::getId() . " | Provider: $provider | Email: $email");

        if (!$email || !$provider) {
            return $this->generate();
        }

        return response()->json([
            'success' => true,
            'email' => $email,
            'provider' => $provider
        ]);
    }

    /**
     * Generate a new random email address.
     */
    public function generate()
    {
        Log::info("Generate Request. SessionID: " . Session::getId());
        
        // Try 1secmail first
        $result = $this->generate1SecMail();

        if (!$result['success']) {
            Log::warning("1secmail failed, falling back to Mail.tm: " . ($result['message'] ?? 'Unknown error'));
            $result = $this->generateMailTm();
        }

        Session::save(); // Explicitly save session
        return response()->json($result);
    }

    private function generate1SecMail()
    {
        try {
            $response = Http::timeout(5)->get($this->secMailUrl, ['action' => 'getDomainList']);

            if ($response->successful()) {
                $domains = $response->json();
                if (empty($domains)) throw new \Exception("Empty domain list");

                $domain = $domains[array_rand($domains)];
                $login = strtolower(Str::random(10));
                $email = "{$login}@{$domain}";

                Session::put('temp_mail_address', $email);
                Session::put('temp_mail_provider', '1secmail');
                Session::forget(['temp_mail_password', 'temp_mail_token', 'temp_mail_id']);

                Log::info("1secmail Generated: $email");
                return ['success' => true, 'email' => $email, 'provider' => '1secmail'];
            }
            return ['success' => false, 'message' => '1secmail domain list unreachable'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    private function generateMailTm()
    {
        try {
            // 1. Get Domain
            $domainsRes = Http::timeout(5)->get("{$this->mailTmUrl}/domains");
            if (!$domainsRes->successful()) throw new \Exception("Mail.tm domains unreachable");
            
            $domainsData = $domainsRes->json();
            $domains = $domainsData['hydra:member'] ?? [];
            if (empty($domains)) throw new \Exception("No Mail.tm domains available");
            $domain = $domains[0]['domain'];

            // 2. Create Account
            $login = strtolower(Str::random(10));
            $address = "{$login}@{$domain}";
            $password = Str::random(12);

            $accountRes = Http::post("{$this->mailTmUrl}/accounts", [
                'address' => $address,
                'password' => $password
            ]);

            if (!$accountRes->successful()) {
                throw new \Exception("Mail.tm account creation failed: " . $accountRes->body());
            }

            $accountData = $accountRes->json();
            $accountId = $accountData['id'] ?? $accountData['@id'] ?? '';

            // 3. Get Token
            $tokenRes = Http::post("{$this->mailTmUrl}/token", [
                'address' => $address,
                'password' => $password
            ]);

            if (!$tokenRes->successful()) throw new \Exception("Mail.tm token generation failed");
            
            $token = $tokenRes->json()['token'];

            Session::put('temp_mail_address', $address);
            Session::put('temp_mail_provider', 'mailtm');
            Session::put('temp_mail_password', $password);
            Session::put('temp_mail_token', $token);
            Session::put('temp_mail_id', $accountId);

            Log::info("Mail.tm Generated: $address");
            return ['success' => true, 'email' => $address, 'provider' => 'mailtm'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => "Mail.tm error: " . $e->getMessage()];
        }
    }

    /**
     * Fetch the inbox for the current session email.
     */
    public function fetchInbox()
    {
        $email = Session::get('temp_mail_address');
        $provider = Session::get('temp_mail_provider');

        Log::info("FetchInbox Request. SessionID: " . Session::getId() . " | Provider: $provider | Email: $email");

        if (!$email) {
            return response()->json(['success' => false, 'message' => 'No session'], 400);
        }

        // Defensive check: if provider is missing but email is present, try to guess or use 1secmail
        if (!$provider) {
            $domain = explode('@', $email)[1] ?? '';
            // If it's a known 1secmail domain (hardcoded common ones as fallback)
            $common1sec = ['1secmail.com', '1secmail.org', '1secmail.net'];
            $provider = in_array($domain, $common1sec) ? '1secmail' : 'mailtm';
            Log::info("Guessed Provider: $provider");
        }

        if ($provider === 'mailtm') {
            return $this->fetchInboxMailTm();
        }

        return $this->fetchInbox1SecMail($email);
    }

    private function fetchInbox1SecMail($email)
    {
        list($login, $domain) = explode('@', $email);
        try {
            $response = Http::get($this->secMailUrl, [
                'action' => 'getMessages',
                'login' => $login,
                'domain' => $domain
            ]);

            if ($response->successful()) {
                return response()->json(['success' => true, 'emails' => $response->json(), 'provider' => '1secmail']);
            }
            return response()->json(['success' => false, 'message' => '1secmail API error'], 500);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    private function fetchInboxMailTm()
    {
        $token = Session::get('temp_mail_token');
        if (!$token) {
            // Try to re-authenticate if we have password
            return $this->reauthMailTm();
        }

        try {
            $response = Http::withToken($token)->get("{$this->mailTmUrl}/messages");

            if ($response->successful()) {
                $raw = $response->json()['hydra:member'] ?? [];
                $emails = array_map(function($m) {
                    return [
                        'id' => $m['id'],
                        'from' => $m['from']['address'] ?? 'Unknown',
                        'subject' => $m['subject'] ?? '(No Subject)',
                        'date' => date('Y-m-d H:i:s', strtotime($m['createdAt']))
                    ];
                }, $raw);

                return response()->json(['success' => true, 'emails' => $emails, 'provider' => 'mailtm']);
            }
            
            // If 401, try re-auth
            if ($response->status() === 401) {
                return $this->reauthMailTm();
            }

            return response()->json(['success' => false, 'message' => 'Mail.tm API error'], 500);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    private function reauthMailTm()
    {
        $address = Session::get('temp_mail_address');
        $password = Session::get('temp_mail_password');
        
        if (!$address || !$password) {
            return response()->json(['success' => false, 'message' => 'Mail.tm session lost'], 401);
        }

        try {
            $tokenRes = Http::post("{$this->mailTmUrl}/token", ['address' => $address, 'password' => $password]);
            if ($tokenRes->successful()) {
                $token = $tokenRes->json()['token'];
                Session::put('temp_mail_token', $token);
                Session::save();
                return $this->fetchInboxMailTm(); // Retry
            }
            return response()->json(['success' => false, 'message' => 'Mail.tm re-auth failed'], 401);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Fetch a specific message body.
     */
    public function fetchMessage($id)
    {
        $provider = Session::get('temp_mail_provider');
        if ($provider === 'mailtm') {
            return $this->fetchMessageMailTm($id);
        }
        return $this->fetchMessage1SecMail($id);
    }

    private function fetchMessage1SecMail($id)
    {
        $email = Session::get('temp_mail_address');
        list($login, $domain) = explode('@', $email);

        try {
            $response = Http::get($this->secMailUrl, [
                'action' => 'readMessage',
                'login' => $login,
                'domain' => $domain,
                'id' => $id
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json(['success' => true, 'message' => $data, 'otp' => $this->extractOtp($data)]);
            }
            return response()->json(['success' => false], 500);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
    }

    private function fetchMessageMailTm($id)
    {
        $token = Session::get('temp_mail_token');
        try {
            $response = Http::withToken($token)->get("{$this->mailTmUrl}/messages/{$id}");

            if ($response->successful()) {
                $m = $response->json();
                $data = [
                    'id' => $m['id'],
                    'from' => $m['from']['address'] ?? '',
                    'subject' => $m['subject'] ?? '',
                    'date' => $m['createdAt'] ?? '',
                    'textBody' => $m['text'] ?? '',
                    'htmlBody' => $m['html'][0] ?? $m['text'] ?? ''
                ];
                return response()->json(['success' => true, 'message' => $data, 'otp' => $this->extractOtp($data)]);
            }
            return response()->json(['success' => false], 500);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
    }

    private function extractOtp($data)
    {
        $body = ($data['textBody'] ?? '') . ' ' . strip_tags($data['htmlBody'] ?? $data['body'] ?? '');
        if (preg_match('/\b(\d{4,8})\b/', $body, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
