<?php

namespace App\Services\Impl;

use App\Models\Enums\GeneralStatus;
use App\Models\Tables\Menu;
use App\Models\Tables\RoleMenu;
use App\Services\MenuService;

class MenuServiceImpl implements MenuService
{

    public function generateMenuTrees(int $roleId): array
    {
        $roleMenus = RoleMenu::query()->select(["menu_id"])->where("role_id", $roleId)->get()->toArray();
        $menus = Menu::query()
            ->where("is_display", true)
            ->where('status', GeneralStatus::ACTIVATED)
            ->whereIn("id", $roleMenus)
            ->get()
            ->toArray();
        return $this->structureTree($this->groupMenu($menus), null);
    }

    public function groupMenu(array $menus) : array {
        $result = [];
        foreach ($menus as $menu) {
            $key = "NULL";
            if ($menu->menu_id != null) {
                $key = $menu->menu_id;
            }
            if (array_key_exists($key, $result)) {
                $result[$key][] = $menu;
            } else {
                $result[$key] = [$menu];
            }
        }
        return $result;
    }

    public function structureTree(array $menus, ?int $menuId) : ?array {
        $result = [];
        $key = "NULL";
        if ($menuId != null) {
            $key = $menuId;
        }
        if (!array_key_exists($key, $menus)) return null;
        foreach ($menus[$key] as $menu) {
            $newMenu = new \App\Models\Dtos\Menu();
            $newMenu->icon = $menu->icon;
            $newMenu->label = $menu->label;
            $newMenu->description = $menu->description;
            $newMenu->link = $menu->link;
            $newMenu->children = $this->structureTree($menus, $menu->id);
            $result[] = $newMenu;
        }
        return $result;
    }

}
