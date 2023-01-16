<?php

namespace App\Models\Tables;

use App\Models\Equatable;
use App\Models\EquatableModel;
use App\Models\Timestamp;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model implements Equatable
{

    use Timestamp, EquatableModel;

    protected $table = "dashboards";

    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "created_by" => "string",
        "updated_by" => "string"
    ];

    public function dirty(Equatable $new): bool
    {
        if ($this->code != $new->code) return true;
        if ($this->label != $new->label) return true;
        if ($this->description != $new->description) return true;
        if ($this->screenshot != $new->screenshot) return true;
        if ($this->status != $new->status) return true;
        return false;
    }

    public function diff(Equatable $new): array
    {
        $result = [];

        if ($this->code != $new->code) $result["code"] = $this->getDiff($this->code, $new->code);
        if ($this->label != $new->label) $result["label"] = $this->getDiff($this->label, $new->label);
        if ($this->description != $new->description) $result["description"] = $this->getDiff($this->description, $new->description);
        if ($this->screenshot != $new->screenshot) $result["screenshot"] = $this->getDiff($this->screenshot, $new->screenshot);
        if ($this->status != $new->status) $result["status"] = $this->getDiff($this->status, $new->status);

        $result;
    }
}
