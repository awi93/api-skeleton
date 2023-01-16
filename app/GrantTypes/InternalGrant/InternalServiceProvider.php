<?php

namespace App\GrantTypes\InternalGrant;

use App\GrantTypes\PohonPinangGrant\PohonPinangGrant;
use Laravel\Passport\Bridge\RefreshTokenRepository;
use Laravel\Passport\Bridge\UserRepository;
use Laravel\Passport\Passport;
use Laravel\Passport\PassportServiceProvider;
use League\OAuth2\Server\AuthorizationServer;

class InternalServiceProvider extends PassportServiceProvider
{

    public function boot()
    {
        /**
         * Create our facebook.php configuration file.
         */
        if (file_exists(app()->basePath() . '/storage/oauth-private.key')) {
            app(AuthorizationServer::class)->enableGrantType($this->makeRequestGrant(), Passport::tokensExpireIn());
        }
    }

    public function register()
    {
        //
    }

    protected function makeRequestGrant()
    {
        $grant = new InternalGrant(
            $this->app->make(UserRepository::class),
            $this->app->make(RefreshTokenRepository::class)
        );
        $grant->setRefreshTokenTTL(Passport::refreshTokensExpireIn());
        return $grant;
    }

}
