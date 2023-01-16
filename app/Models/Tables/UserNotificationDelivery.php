<?php

namespace App\Models\Tables;

use App\Models\Equatable;
use App\Models\EquatableModel;
use App\Models\Timestamp;
use Illuminate\Database\Eloquent\Model;

class UserNotificationDelivery extends Model
{

    use Timestamp;

    protected $table = "user_notification_deliveries";

    protected $casts = [
        "channel_config" => "json",
        "delivered_at" => "timestamp",
        "created_at" => "timestamp",
        "updated_at" => "timestamp",
        "created_by" => "string",
        "updated_by" => "string",
    ];
}
