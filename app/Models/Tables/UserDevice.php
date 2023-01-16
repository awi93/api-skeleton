<?php

namespace App\Models\Tables;

use App\Models\Timestamp;
use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{

    use Timestamp;

    protected $table = "user_devices";

    protected $casts = [
        "device" => "json",
        "created_at" => "timestamp",
        "created_by" => "created_by",
    ];

}
