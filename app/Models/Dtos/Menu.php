<?php

namespace App\Models\Dtos;

class Menu
{

    var ?string $icon;
    var string $code;
    var string $label;
    var ?string $description;
    var ?string $link;
    var ?array $children;

}
