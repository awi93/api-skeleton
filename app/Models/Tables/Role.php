<?php

namespace App\Models\Tables;

use App\Models\Equatable;
use App\Models\EquatableModel;
use App\Models\Timestamp;
use Illuminate\Database\Eloquent\Model;

class Role extends Model implements Equatable
{

    use Timestamp, EquatableModel;

    protected $table = "roles";

    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "created_by" => "string",
        "updated_by" => "string"
    ];


    public function role_menus () {
        return $this->hasMany(RoleMenu::class)->with("menu");
    }

    public function role_dashboards () {
        return $this->hasMany(RoleDashboard::class)->with("dashboard");
    }

    public function menu() {
        $menu = "";
        foreach ($this->role_menus as $role_menu) {
            $menu .= $role_menu->menu_id;
        }
        return $menu;
    }

    public function dashboard() {
        $dashboard = "";
        foreach ($this->role_dashboards as $role_dashboard) {
            $dashboard .= $role_dashboard->dashboard_id;
        }
        return $dashboard;
    }

    public function menuDiff () {
        $menus = [];
        foreach ($this->role_menus as $role_menu) {
            $menus[] = $role_menu->menu_id;
        }
        return $menus;
    }

    public function dashboardDiff() {
        $dashboards = [];
        foreach ($this->role_dashboards as $role_dashboard) {
            $dashboards[] = $role_dashboard->dashboard_id;
        }
        return $dashboards;
    }

    public function dirty(Equatable $new): bool
    {
        if ($this->label != $new->label) return true;
        if ($this->description != $new->description) return true;
        if ($this->status != $new->status) return true;
        if ($this->menu() != $new->menu()) return true;
        if ($this->dashboard() != $new->dashboard()) return true;

        return false;
    }

    public function diff(Equatable $new): array
    {
        $result = [];
        if ($this->label != $new->label) $result["label"] = $this->getDiff($this->label, $new->label);
        if ($this->description != $new->description) $result["description"] = $this->getDiff($this->description, $new->description);
        if ($this->status != $new->status) $result["status"] = $this->getDiff($this->status, $new->status);
        if ($this->menu() != $new->menu()) $result["role_menus"] = $this->getDiff($this->menuDiff(), $new->menuDiff());
        if ($this->dashboard() != $new->dashboard()) $result["role_dashboard"] = $this->getDiff($this->dashboardDiff(), $new->dashboardDiff());
        return $result;
    }

}
