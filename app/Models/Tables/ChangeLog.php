<?php

namespace App\Models\Tables;

use App\Models\Timestamp;
use Illuminate\Database\Eloquent\Model;

class ChangeLog extends Model
{

    use Timestamp;

    protected $table = "change_logs";

    protected $casts = [
        "data_id" => "string",
        "created_at" => "datetime",
        "created_by" => "string"
    ];


}
