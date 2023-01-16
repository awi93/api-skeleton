<?php


namespace App\Models;


trait EquatableModel
{

    public function getDiff ($prev, $new) : array {
        return [
            "old" => $this->getDiffValue($prev),
            "new" => $this->getDiffValue($new)
        ];
    }

    public function getDiffValue ($value) : mixed {
        if (!empty($value)) {
            if ($value instanceof \DateTime) return $value->format("yyyy-MM-dd HH:mm:ss");
            return $value;
        }
        return "-";
    }

}
