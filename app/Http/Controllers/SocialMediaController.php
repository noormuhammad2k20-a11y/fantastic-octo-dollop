<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SocialMediaController extends Controller
{
    /**
     * Generate content based on tool type.
     */
    public function generate(Request $request, $type)
    {
        switch ($type) {
            case 'youtube-title':
                return $this->generateYoutubeTitles($request);
            case 'instagram-bio':
                return $this->generateInstagramBios($request);
            case 'tiktok-username':
                return $this->generateTiktokUsernames($request);
            case 'instagram-caption':
                return $this->generateInstagramCaptions($request);
            case 'youtube-description':
                return $this->generateYoutubeDescriptions($request);
            default:
                return response()->json(['success' => false, 'message' => 'Invalid tool type'], 400);
        }
    }

    private function generateYoutubeTitles(Request $request)
    {
        $topic = $request->input('topic', 'My Awesome Video');
        $tone = $request->input('tone', 'seo');

        $clickbaitPrefixes = ["You Won't Believe", "The Secret To", "Why I Quit", "STOP Doing This", "How I Made", "10X Your"];
        $emotionalPrefixes = ["Life-Changing", "Heartbreaking", "Incredible", "Terrified", "Finally Revealed", "Shocking"];
        $powerWords = ["Insane", "Secret", "Guaranteed", "Proven", "Viral", "Must Watch", "Hack"];

        $titles = [];
        for ($i = 0; $i < 15; $i++) {
            $prefix = "";
            if ($tone === 'clickbait') $prefix = $clickbaitPrefixes[array_rand($clickbaitPrefixes)] . " ";
            if ($tone === 'emotional') $prefix = $emotionalPrefixes[array_rand($emotionalPrefixes)] . " ";
            
            $power = $powerWords[array_rand($powerWords)];
            
            $variation = rand(1, 4);
            switch ($variation) {
                case 1: $title = "{$prefix}{$topic}: The {$power} Truth!"; break;
                case 2: $title = "How to {$topic} Like a Pro (Step-by-Step)"; break;
                case 3: $title = "Why Everyone is Talking About {$topic}"; break;
                case 4: $title = "I Tried {$topic} For 30 Days and This Happened..."; break;
                default: $title = "{$topic} - {$power} Guide";
            }
            $titles[] = $title;
        }

        return response()->json(['success' => true, 'results' => array_values(array_unique($titles))]);
    }

    private function generateInstagramBios(Request $request)
    {
        $category = $request->input('category', 'aesthetic');
        $name = $request->input('name', 'User');

        $aestheticTemplates = [
            "âœ¨ | Â· {$name} Â·\nðŸŒ™ | seek magic in every moment\nðŸ“ | dream land\nâ˜ï¸ | lost in thoughts",
            "â—¦ {$name} â—¦\nâœ­ simple yet significant\nâœ­ creating my own sunshine\nâœ­ limited edition",
            "â‹š {$name} â‹›\nâ‹« coffee & chaos\nâ‹« soul full of sunshine\nâ‹« be a starlight"
        ];

        $businessTemplates = [
            "ðŸš€ | {$name} | Digital Creator\nðŸ’¼ | Helping you scale your brand\nðŸ“ | Based in NY\nðŸ‘‡ | Work with me",
            "âœ¨ | Helping CEOs save 10hrs/week\nðŸ“ˆ | 500+ Clients transformed\nðŸ“… | Book a call below\nâ¬‡ï¸ | free.link/me",
            "ðŸ’Ž | Premium Jewelry Brand\nðŸŒ | Shipping Worldwide\nâœ¨ | Quality that lasts\nðŸ›’ | Shop our collection"
        ];

        $results = ($category === 'business') ? $businessTemplates : $aestheticTemplates;
        
        // Add font variations (simplified)
        $fonts = [
            "â„â„™â„°â„¤â„•â„±â„›", // Just examples
            "ð— ð—”ð—˜ð—™ð—”ð—–ð—˜",
            "ððððððððð"
        ];

        return response()->json(['success' => true, 'results' => $results]);
    }

    private function generateTiktokUsernames(Request $request)
    {
        $vibe = $request->input('vibe', 'aesthetic');
        $base = $request->input('base', 'user');

        $prefixes = ['itz', 'the', 'only', 'vibe', 'real', 'og', 'just', 'official'];
        $suffixes = ['x', 'off', 'vibe', 'main', 'aesthetic', 'clouds', 'heart', 'star'];

        $usernames = [];
        for ($i = 0; $i < 15; $i++) {
            $p = $prefixes[array_rand($prefixes)];
            $s = $suffixes[array_rand($suffixes)];
            $num = rand(10, 99);
            
            $type = rand(1, 3);
            switch ($type) {
                case 1: $u = "{$p}_{$base}"; break;
                case 2: $u = "{$base}.{$s}"; break;
                case 3: $u = "{$base}{$num}"; break;
            }
            $usernames[] = strtolower($u);
        }

        return response()->json(['success' => true, 'results' => array_values(array_unique($usernames))]);
    }

    private function generateInstagramCaptions(Request $request)
    {
        $topic = $request->input('topic', 'Daily Life');
        $tone = $request->input('tone', 'fun');

        $funTemplates = [
            "Living my best life with {$topic} âœ¨",
            "Life isn't perfect, but this {$topic} is! ðŸ˜",
            "Less perfection, more {$topic}. ðŸŒˆ",
            "Wait, did someone say {$topic}? ðŸ¤”"
        ];

        $professionalTemplates = [
            "The importance of {$topic} in today's landscape. ðŸ’¼",
            "Strategic insights into {$topic}. ðŸ“ˆ",
            "How we approach {$topic} at the highest level. âœ¨",
            "Maxmizing efficiency through {$topic}. ðŸš€"
        ];

        $results = ($tone === 'professional') ? $professionalTemplates : $funTemplates;

        return response()->json(['success' => true, 'results' => $results]);
    }

    private function generateYoutubeDescriptions(Request $request)
    {
        $topic = $request->input('topic', 'My Awesome Video');
        $tone = $request->input('tone', 'seo');

        $intros = [
            "seo" => "In this video, we dive deep into {$topic} to help you understand the core concepts and best practices. If you're looking to master {$topic}, you're in the right place!",
            "engaging" => "Have you ever wondered about {$topic}? ðŸ¤” Today, I'm sharing my personal journey and tips on how to conquer {$topic} like a pro. Stick around to the end for a special tip!",
            "clickbait" => "Everything you thought you knew about {$topic} is WRONG! ðŸ˜± I'm exposing the truth and showing you exactly how to navigate {$topic} in 2024.",
            "professional" => "This comprehensive guide provides a strategic overview of {$topic}, aimed at professionals looking to optimize their workflow and results in this specific niche.",
            "educational" => "Welcome to our tutorial on {$topic}. This lesson covers the fundamental principles and advanced techniques required to excel in {$topic}.",
            "ai" => "[AI Optimized] Analying data trends for {$topic}... Result: This content is specifically structured to satisfy search algorithms while providing high-value user engagement for {$topic}."
        ];

        $bodies = [
            "We cover everything from the basics to advanced strategies. {$topic} is an essential part of success in today's landscape.",
            "The key takeaway from this video on {$topic} is that consistency and quality always win. Let's look at the data.",
            "I've spent years researching {$topic}, and here are the top findings I want to share with you today."
        ];

        $ctas = [
            "ðŸ“¬ Join our newsletter for more tips: tools.link/news",
            "ðŸ‘• Get our exclusive merch: tools.link/shop",
            "ðŸ‘‡ Leave a comment below with your thoughts on {$topic}!",
            "âœ… Don't forget to SUBSCRIBE and turn on notifications! ðŸ”"
        ];

        $hashtags = ["#{$topic}", "#viral", "#trending", "#youtube", "#tips", "#2024"];
        $cleanTopic = str_replace(' ', '', $topic);
        $hashtags[] = "#{$cleanTopic}";

        $results = [];
        for ($i = 0; $i < 5; $i++) {
            $intro = $intros[$tone] ?? $intros['seo'];
            $body = $bodies[array_rand($bodies)];
            $cta = $ctas[array_rand($ctas)];
            $tagStr = implode(' ', array_slice($hashtags, 0, 5));
            
            $desc = "{$intro}\n\n{$body}\n\nâ–¶ï¸  TIMESTAMPS:\n0:00 Intro\n1:20 Getting Started with {$topic}\n4:45 Advanced Tips\n8:10 Conclusion\n\n{$cta}\n\n{$tagStr}";
            $results[] = $desc;
        }

        return response()->json(['success' => true, 'results' => $results]);
    }
}
