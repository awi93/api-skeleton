<?php

namespace App\Services;

interface MenuService
{

    public function generateMenuTrees (int $roleId) : array;

}
