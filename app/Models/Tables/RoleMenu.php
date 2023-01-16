<?php

namespace App\Models\Tables;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    public $incrementing = false;

    protected $table = "role_menus";

    public function menu() {
        return $this->belongsTo(Menu::class);
    }


}
