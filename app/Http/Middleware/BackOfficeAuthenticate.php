<?php

namespace App\Http\Middleware;

use App\Models\Enums\UserType;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BackOfficeAuthenticate
{

    /**
     * The authentication guard factory instance.
     *
     * @var Auth
     */
    protected Auth $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  Auth $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ?String $guard = null): mixed
    {

        if ($this->auth->guard($guard)->guest()) {
            return response()->json([
                "error" => "unauthorized",
                "cause" => "invalid_authentication",
            ], Response::HTTP_UNAUTHORIZED);
        }
        if ($this->auth->guard($guard)->user()->user_type != UserType::BACK_OFFICE) {
            return response()->json([
                "error" => "unauthorized",
                "cause" => "invalid_authentication",
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }

}
