<?php

namespace App\Exceptions;

use League\OAuth2\Server\Exception\OAuthServerException;

class AuthenticationException extends OAuthServerException
{

    public static function invalidUsername () : AuthenticationException {
        return new AuthenticationException("INVALID_USERNAME", 6, "INVALID_USERNAME", 401);
    }

    public static function invalidPassword () : AuthenticationException {
        return new AuthenticationException("INVALID_PASSWORD", 6, "INVALID_PASSWORD", 401);
    }

    public static function invalidOtpToken () : AuthenticationException {
        return new AuthenticationException('INVALID_OTP_TOKEN', 6, 'INVALID_OTP_TOKEN', 401);
    }

    public static function unverifiedEmail () : AuthenticationException {
        return new AuthenticationException('UNVERIFIED_EMAIL', 6, 'UNVERIFIED_EMAIL', 401);
    }

    public static function unverifiedPhoneNo () : AuthenticationException {
        return new AuthenticationException('UNVERIFIED_PHONE_NO', 6, 'UNVERIFIED_PHONE_NO', 401);
    }

}
