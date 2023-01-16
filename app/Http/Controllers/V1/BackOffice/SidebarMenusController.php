<?php

namespace App\Http\Controllers\V1\BackOffice;

use App\Services\MenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SidebarMenusController extends Controller
{

    var MenuService $service;

    public function __construct(MenuService $service) {
        $this->service = $service;
    }

    public function index (Request $request, int $roleId) : JsonResponse {
        try {
            $menus = $this->service->generateMenuTrees($roleId);
            return response()->json($menus);
        } catch (\Exception $ex) {
            Log::error("[System][SidebarMenuController] Fail to generate menu tree", [
                "error" => $ex->getMessage(),
                "roleId" => $roleId,
            ]);
            return $this->internalServerError("fail_fetch_data");
        }
    }

}
