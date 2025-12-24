<?php

namespace App\Http\Middleware;

use Closure;

class SecurityHeaders
{
   
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Security Headers
        $response->headers->set('X-Frame-Options', 'DENY');                     // Cegah clickjacking
        $response->headers->set('X-Content-Type-Options', 'nosniff');           // Cegah MIME sniff
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin'); // Proteksi referrer
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()'); // Batasi fitur browser
        $response->headers->set('Cross-Origin-Embedder-Policy', 'require-corp');
        $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin');
        $response->headers->set('Cross-Origin-Resource-Policy', 'same-origin');

        // Hanya aktif di HTTPS (sangat penting)
        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // OPTIONAL (bisa diaktifkan jika butuh CSP)
        $response->headers->set('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:; font-src 'self' data:;");

        return $response;
    }
}
