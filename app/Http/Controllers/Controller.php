<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class Controller extends BaseController
{

    /**
     * @param $id
     * @return JsonResponse
     */
    public function successUpdate ($id) : JsonResponse {
        return response()->json([
            "id" => $id,
            "is_success" => true
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function successCreate (int $id) : JsonResponse {
        return response()->json([
            "id" => $id,
            "is_success" => true
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * @return JsonResponse
     */
    public function invalidAuthentication () : JsonResponse {
        return response()->json([
            "error" => "unauthorized",
            "cause" => "invalid_authentication",
        ], ResponseAlias::HTTP_UNAUTHORIZED);
    }

    /**
     * @return JsonResponse
     */
    public function invalidRequest () : JsonResponse
    {
        return response()->json([
            "error" => "bad request",
            "cause" => "invalid_request_from_client"
        ], ResponseAlias::HTTP_BAD_REQUEST);
    }

    /**
     * @return JsonResponse
     */
    public function failToSaveData () : JsonResponse
    {
        return response()->json([
            "error" => "internal server error",
            "cause" => "fail_to_save_data"
        ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @return JsonResponse
     */
    public function dataNotfound () : JsonResponse
    {
        return response()->json([
            "error" => "not found",
            "cause" => "data_not_found"
        ], ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * @return JsonResponse
     */
    public function forbiddenAccess () : JsonResponse {
        return response()->json([
            "error" => "forbidden",
            "cause" => "unauthorized_access"
        ], ResponseAlias::HTTP_FORBIDDEN);
    }

    /**
     * @return JsonResponse
     */
    public function notImplemented () : JsonResponse {
        return response()->json([
            "error" => "not implemented",
            "cause" => "function_not_implemented"
        ], ResponseAlias::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * @param string $cause
     * @return JsonResponse
     */
    public function badRequest (string $cause) : JsonResponse {
        return response()->json([
            "error" => "bad request",
            "cause" => $cause
        ], ResponseAlias::HTTP_BAD_GATEWAY);
    }

    public function internalServerError (String $cause) : JsonResponse {
        return response()->json([
            "error" => "internal server error",
            "cause" => $cause
        ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
    }

}
