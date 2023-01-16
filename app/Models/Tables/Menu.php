<?php

namespace App\Models\Tables;

use App\Models\Equatable;
use App\Models\EquatableModel;
use App\Models\Timestamp;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model implements Equatable
{

    use Timestamp, EquatableModel;

    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "created_by" => "string",
        "updated_by" => "string",
    ];

    public function dirty(Equatable $new): bool
    {
        if ($this->code != $new->code) return true;
        if ($this->menu_id != $new->menu_id) return true;
        if ($this->is_display != $new->is_display) return true;
        if ($this->icon != $new->icon) return true;
        if ($this->label != $new->label) return true;
        if ($this->description != $new->description) return true;
        if ($this->link != $new->link) return true;
        if ($this->status != $new->status) return true;

        return false;
    }

    public function diff(Equatable $new): array
    {
        $result = [];
        if ($this->code != $new->code) $result["code"] = $this->getDiff($this->code, $new->code);
        if ($this->menu_id != $new->menu_id) $result["code"] = $this->getDiff($this->code, $new->code);
        if ($this->is_display != $new->is_display) $result["code"] = $this->getDiff($this->code, $new->code);
        if ($this->icon != $new->icon) $result["code"] = $this->getDiff($this->code, $new->code);
        if ($this->label != $new->label) $result["code"] = $this->getDiff($this->code, $new->code);
        if ($this->description != $new->description) $result["code"] = $this->getDiff($this->code, $new->code);
        if ($this->link != $new->link) $result["code"] = $this->getDiff($this->code, $new->code);
        if ($this->status != $new->status) $result["code"] = $this->getDiff($this->code, $new->code);
        return $result;
    }

}
