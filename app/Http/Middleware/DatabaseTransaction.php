<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DatabaseTransaction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        DB::beginTransaction();

        $response = $next($request);

        if (isset($response->exception) || ($response instanceof Response && $response->getStatusCode() > 399)) {
            DB::rollBack();
        } else {
            DB::commit();
        }

        return $response;
    }
}