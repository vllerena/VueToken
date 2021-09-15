<?php

namespace App\Contracts;

use App\Models\User;

interface UserContract
{
    public function whereFirst($attr, $value);

    public function crearUser(array $datos);

    public function editarUser(User $user, array $datos);

    public function eliminarUser(User $user);
}
