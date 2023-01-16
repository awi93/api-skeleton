<?php


namespace App\Models;


interface Equatable
{

    public function dirty(Equatable $new) : bool;

    public function diff (Equatable $new) : array;

}
