<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * Absolute CanonicalMiddleware — The Final synchronization fix.
 * Forces 301 redirects to the clean /ToolsHub/ slugs for legacy /public/ paths.
 * Also handles locale detection, x-default, and the hreflang matrix.
 */
class CanonicalMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Get current full request URI relative to domain root
        $currentUri = $request->getRequestUri();
        $cleanUri = parse_url($currentUri, PHP_URL_PATH) ?: $currentUri;
        
        // 2. Normalize it locally (remove /public/ and trailing slashes)
        $normalizedPath = $cleanUri;
        if (Str::endsWith($normalizedPath, '/public')) {
            $normalizedPath = Str::replaceLast('/public', '', $normalizedPath);
        } elseif (Str::contains($normalizedPath, '/public/')) {
            $normalizedPath = str_replace('/public/', '/', $normalizedPath);
        }
        
        if ($normalizedPath !== '/') {
            $normalizedPath = rtrim($normalizedPath, '/');
        }
        if ($normalizedPath === '') {
            $normalizedPath = '/';
        }

        // 3. Perform 301 Redirect if context is NOT CLEAN
        if (Str::lower(rtrim($cleanUri, '/')) !== Str::lower(rtrim($normalizedPath, '/'))) {
            $target = $request->getSchemeAndHttpHost() . $normalizedPath;
            $query = $request->getQueryString();
            if ($query) {
                $target .= '?' . $query;
            }
            if (Str::lower(rtrim($request->fullUrl(), '/')) !== Str::lower(rtrim($target, '/'))) {
                return redirect()->to($target, 301);
            }
        }

        // 4. Locale Detection from URL
        $locales = config('seo.locales', []);
        $pathSegments = explode('/', trim($normalizedPath, '/'));
        $currentLocale = 'en'; // Default
        
        if (count($pathSegments) > 0 && isset($locales[$pathSegments[0]])) {
            $currentLocale = $pathSegments[0];
            $pathWithoutLocale = '/' . implode('/', array_slice($pathSegments, 1));
        } else {
            $pathWithoutLocale = $normalizedPath;
        }

        if ($pathWithoutLocale === '') {
            $pathWithoutLocale = '/';
        }

        app()->setLocale($currentLocale);
        View::share('currentLocale', $currentLocale);
        View::share('localeDir', $locales[$currentLocale]['dir'] ?? 'ltr');
        
        $response = $next($request);

        // 5. Inject standard rel="canonical" and hreflang matrix for HTML
        if (str_contains($response->headers->get('Content-Type') ?? '', 'text/html')) {
            $host = $request->getHost();
            $scheme = $request->getScheme();
            
            // Canonical is always the current resolved path
            $canonicalUrl = "$scheme://$host" . $normalizedPath;
            $links = ["<$canonicalUrl>; rel=\"canonical\""];
            
            // Generate hreflang links
            $hreflangData = [];
            foreach ($locales as $code => $localeData) {
                $localePath = $code === 'en' ? $pathWithoutLocale : '/' . $code . ($pathWithoutLocale === '/' ? '' : $pathWithoutLocale);
                $localeUrl = "$scheme://$host" . $localePath;
                $hreflang = $localeData['hreflang'];
                
                $links[] = "<$localeUrl>; rel=\"alternate\"; hreflang=\"$hreflang\"";
                $hreflangData[$code] = $localeUrl;
                
                if ($code === 'en') {
                    $links[] = "<$localeUrl>; rel=\"alternate\"; hreflang=\"x-default\"";
                    $hreflangData['x-default'] = $localeUrl;
                }
            }

            View::share('hreflangData', $hreflangData);
            View::share('canonicalUrl', $canonicalUrl);

            $response->headers->set('Link', implode(', ', $links));
        }

        return $response;
    }
}
