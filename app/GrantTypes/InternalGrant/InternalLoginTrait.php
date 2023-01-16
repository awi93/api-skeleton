<?php

namespace App\GrantTypes\InternalGrant;

use App\Exceptions\AuthenticationException;
use App\Models\Enums\GeneralStatus;
use App\Models\Enums\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Contract\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Kreait\Laravel\Firebase\Facades\Firebase;

trait InternalLoginTrait
{

    /**
     * @param Request $request
     * @return mixed|void|null
     * @throws AuthenticationException
     */
    public function internalLogin (Request $request) {
        if (!$request->has("login_type")) {
            return null;
        }
        $loginType = $request->login_type;
        switch ($loginType) {
            case InternalLoginType::Firebase:
                return $this->loginFirebase($request);
            case InternalLoginType::Password:
                return $this->loginPassword($request);
        }
        return AuthenticationException::invalidRequest("login_type");
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws AuthenticationException
     */
    private function loginFirebase (Request $request): mixed
    {
        if (!$request->has("id_token")) throw AuthenticationException::invalidRequest("id_token");

        $model = config('auth.providers.users.model');
        $uid = "";
        try {
            $token = Firebase::auth()->verifyIdToken($request->id_token, true);
            $uid = $token->claims()->get("sub");
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            AuthenticationException::invalidOtpToken();
        }
        $user = $model->where("uid", $uid)->first();
        if (empty($user)) throw AuthenticationException::invalidUsername();
        return $user;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws AuthenticationException
     */
    private function loginPassword (Request $request): mixed
    {
        if (!$request->has("username")) throw AuthenticationException::invalidRequest("username");
        if (!$request->has("password")) throw AuthenticationException::invalidRequest("password");

        $username = strtolower($request->username);
        $password = $request->password;

        $model = config("auth.providers.users.model");
        $user = $model->where(function ($query) use ($username) {
                $query->where(function($query) use ($username) {
                    $query->where("email", $username);
                })->orWhere(function($query) use ($username) {
                    $query->where("phone_no", $username);
                })->orWhere(function($query) use ($username) {
                    $query->where("username", $username);
                });
            })
            ->where("status", UserStatus::ACTIVATED)
            ->first();

        if (empty($user)) return null;
        if (!Hash::check($password, $user->password)) throw AuthenticationException::invalidPassword();

        if ($request->username == $user->email && !$user->email_verified) throw AuthenticationException::unverifiedEmail();
        if ($request->username == $user->phone_no && !$user->phone_verified) throw AuthenticationException::unverifiedPhoneNo();

        return $user;
    }

}
