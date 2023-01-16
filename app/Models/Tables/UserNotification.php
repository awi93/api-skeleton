<?php

namespace App\Models\Tables;

use App\Models\Timestamp;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{

    use Timestamp;

    protected $table = "user_notifications";

    protected $casts = [
        "created_at" => "timestamp",
        "updated_at" => "timestamp",
        "created_by" => "string",
        "updated_by" => "string",
    ];



}
