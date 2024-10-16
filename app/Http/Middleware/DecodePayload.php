<?php

namespace App\Http\Middleware;

use App\Helpers\MyResponse;
use App\Repository\Teqrypt;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DecodePayload
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (App::hasEncryptionEnabled() && ! App::excludedEncryptionRoutes()) {
            if (in_array($request->method(), ['POST', 'PUT', 'PATCH'])) {
                $payload = $request->get('payload');

                if (App::hasDebugModeEnabled()) {
                    \Log::info('Incoming Request', ['payload' => $payload, 'url' => $request->fullUrl()]);
                }

                if ($request->collect()->except('payload')->isNotEmpty()) {
                    return MyResponse::failed('Invalid data: No encryption.');
                }

                if (!is_null($payload)) {
                    $teqrypt = new Teqrypt;

                    $data = $teqrypt->decrypt($payload);

                    if ( $data['success'] !== true ) {
                        return MyResponse::failed($data['message']);
                    }

                    if( !$data['data'] ) {
                        return MyResponse::failed('Invalid data');
                    }

                    $request->merge($data['data']);

                    $request->request->remove('payload');
                }
            }
        }

        return $next($request);
    }
}
