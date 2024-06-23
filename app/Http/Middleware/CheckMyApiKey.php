<?php

namespace App\Http\Middleware;

use App\src\Response\Domain\Contracts\ICustomResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMyApiKey
{
    private $customResponse;
    public function __construct(ICustomResponse $customResponse) {
        $this->customResponse = $customResponse;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */    
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = config('app.my_api_key');

        $myApiKeyIsValid = (! empty($apiKey)) && ($request->header('my-api-key') == $apiKey);
       
        if(! $myApiKeyIsValid){
            return $this->customResponse->responseTo(
                false,
                "Acceso Denegado",
                "",
                403
            );
        }

        return $next($request);
    }
}
