<?php


namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Laravel\Passport\Exceptions\MissingScopeException;
use Laravel\Passport\Http\Middleware\CheckCredentials;
use Laravel\Passport\Token;

class CheckClientCredentials extends CheckCredentials
{
    /**
     * Validate token credentials.
     *
     * @param  Token  $token
     * @return void
     *
     * @throws AuthenticationException
     */
    protected function validateCredentials($token): void
    {
        if (! $token) {
            throw new AuthenticationException;
        }
    }

    /**
     * Validate token credentials.
     *
     * @param  Token  $token
     * @param  array  $scopes
     * @return void
     *
     * @throws MissingScopeException
     */
    protected function validateScopes($token, $scopes)
    {
        if (in_array('*', $token->scopes)) {
            return;
        }

        foreach ($scopes as $scope) {
            if ($token->cant($scope)) {
                throw new MissingScopeException($scope);
            }
        }
    }
}
