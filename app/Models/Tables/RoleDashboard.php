<?php

namespace App\Models\Tables;

use Illuminate\Database\Eloquent\Model;

class RoleDashboard extends Model
{

    public $incrementing = false;

    protected $table = "role_dashboards";

    public function dashboard() {
        return $this->belongsTo(Dashboard::class);
    }

}
