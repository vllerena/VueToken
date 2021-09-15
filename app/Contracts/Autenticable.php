<?php

namespace App\Contracts;

use App\Models\User;

interface Autenticable
{
    public function getUser(): User;

    static function getPrimaryKey();
}
