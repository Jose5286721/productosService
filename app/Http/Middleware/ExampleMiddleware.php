<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class ExampleMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		$secret = $request->header("secret");
		if (strcmp(env("SERVICE_SECRET"), $secret) === 0) {
			return $next($request);
		}
		abort(Response::HTTP_UNAUTHORIZED);
	}
}
