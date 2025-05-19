<?php

namespace aliirfaan\CitronelCore\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use aliirfaan\CitronelCore\Traits\CitronelCorrelationTokenTrait;

class CitronelCorrelationToken
{
    use CitronelCorrelationTokenTrait;
    
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $correlationToken = $this->getCorrelationTokenFromHeader($request);

        $correlationTokenHeaderKey = config('citronel.correlation_token_header_key');
        
        if (is_null($correlationToken)) {
            $correlationToken = $this->generateCorrelationToken();
            $request->headers->set($correlationTokenHeaderKey, $correlationToken);
        }

        Log::withContext([
            $correlationTokenHeaderKey => $correlationToken
        ]);

        return $next($request);
    }
}
