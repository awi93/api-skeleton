<?php

namespace App\GrantTypes\InternalGrant;

use Illuminate\Http\Request;
use Laravel\Passport\Bridge\User;
use Laravel\Passport\Bridge\UserRepository;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Exception\UniqueTokenIdentifierConstraintViolationException;
use League\OAuth2\Server\Grant\AbstractGrant;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use League\OAuth2\Server\RequestEvent;
use League\OAuth2\Server\ResponseTypes\ResponseTypeInterface;
use Psr\Http\Message\ServerRequestInterface;
use DateInterval;

class InternalGrant extends AbstractGrant
{

    /**
     * @param UserRepository $userRepository
     * @param RefreshTokenRepositoryInterface $refreshTokenRepository
     */
    public function __construct(
        UserRepository $userRepository,
        RefreshTokenRepositoryInterface $refreshTokenRepository
    ) {
        $this->setUserRepository($userRepository);
        $this->setRefreshTokenRepository($refreshTokenRepository);
        $this->refreshTokenTTL = new \DateInterval("P1M");
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseTypeInterface $responseType
     * @param DateInterval $accessTokenTTL
     * @return ResponseTypeInterface
     * @throws OAuthServerException
     * @throws UniqueTokenIdentifierConstraintViolationException
     */
    public function respondToAccessTokenRequest (ServerRequestInterface $request, ResponseTypeInterface $responseType, DateInterval $accessTokenTTL): ResponseTypeInterface
    {
        $client = $this->validateClient($request);
        $scopes = $this->validateScopes($this->getRequestParameter('scope', $request));
        $user=  $this->validateUser($request);
        $scopes = $this->scopeRepository->finalizeScopes($scopes, $this->getIdentifier(), $client, $user->getIdentifier());
        $accessToken = $this->issueAccessToken($accessTokenTTL, $client, $user->getIdentifier(), $scopes);
        $refreshToken = $this->issueRefreshToken($accessToken);
        $responseType->setAccessToken($accessToken);
        $responseType->setRefreshToken($refreshToken);
        return $responseType;
    }

    /**
     * @return string
     */
    public function getIdentifier() : string {
        return "internal_grant";
    }

    /**
     * @param ServerRequestInterface $request
     * @return User
     * @throws OAuthServerException
     */
    protected function validateUser(ServerRequestInterface $request): User
    {
        $lavarelRequest = new Request($request->getParsedBody());
        $user = $this->getUserEntityByRequest($lavarelRequest);

        if ($user instanceof \App\Models\Tables\User === false) {
            $this->getEmitter()->emit(new RequestEvent(RequestEvent::USER_AUTHENTICATION_FAILED, $request));
        }

        return new User($user->id);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws OAuthServerException
     */
    protected function getUserEntityByRequest (Request $request): mixed
    {
        if (is_null($model = config("auth.providers.users.model"))) {
            throw OAuthServerException::serverError('AUTH_MODEL_NOT_FOUND');
        }
        if (method_exists($model, 'internalLogin')) {
            $user = (new $model)->internalLogin($request);
        } else {
            throw OAuthServerException::serverError('AUTH_METHOD_NOT_FOUND');
        }
        return $user;
    }

}
