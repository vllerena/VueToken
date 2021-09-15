<?php

namespace App\Services;

use App\Contracts\ArchivoContract;
use App\Contracts\TokenContract;
use App\Contracts\UserContract;
use App\Models\Info\RolAttr;
use App\Models\Info\UserAttr;
use App\Models\User;
use App\Utils\Archivo;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UserService implements UserContract
{
    private TokenContract $tokenService;
    private ArchivoContract $archivoService;

    public function __construct(TokenContract $tokenService, ArchivoContract $archivoService)
    {
        $this->tokenService = $tokenService;
        $this->archivoService = $archivoService;
    }

    public function whereFirst($attr, $value, $raise404 = false)
    {
        if ($raise404)
            return User::where($attr, $value)->with('token')->firstOrFail();
        return User::where($attr, $value)->with('token')->first();
    }

    public function crearUser(array $datos)
    {
        $user = User::create($datos);
        $this->setRol($datos[UserAttr::ROL_ID], $user);
        $this->setUpdateImg(Arr::get($datos, UserAttr::IMAGEN), $user);
        $this->tokenService->createToken($user);
        return $user;
    }

    public function editarUser(User $user, array $datos)
    {
        $user->update($datos);
        $this->updateRol(Arr::get($datos, UserAttr::ROL_ID), $user);
        $this->setUpdateImg(Arr::get($datos, UserAttr::IMAGEN), $user);
        return $user;
    }

    public function eliminarUser(User $user)
    {
        $this->editarUser($user, [UserAttr::ESTA_ACTIVO => false]);
    }

    private function setUpdateImg($image, User $user)
    {
        if ($image)
            $this->setImage($image, $user);
    }

    private function setImage($image, User $user)
    {
        $archivo = (new Archivo($image))->setNombre('user_img_' . $user[UserAttr::ID])
            ->setCarpeta('imagenes/postulante');
        $user[UserAttr::IMAGEN] = $this->archivoService->saveUploadedFile($archivo);
        $user->save();
    }

    private function setRol($rolId, User $user)
    {
        DB::table(RolAttr::USER_ROLES)->insert([
            'user_id' => $user[UserAttr::ID], 'rol_id' => $rolId
        ]);
    }

    private function updateRol($rolId, User $user)
    {
        if ($rolId)
            $this->saveRol($rolId, $user);
    }

    private function saveRol($rolId, User $user)
    {
        $sameRolAsBefore = collect($user->roles)->where(RolAttr::ID, $rolId)->count();
        if (!$sameRolAsBefore) {
            $this->cleanOldRoles($user);
            DB::table(RolAttr::USER_ROLES)->insert([
                'user_id' => $user[UserAttr::ID], 'rol_id' => $rolId
            ]);
        }
    }

    private function cleanOldRoles(User $user)
    {
        foreach ($user->roles as $r)
            DB::table(RolAttr::USER_ROLES)
                ->where('rol_id', $r[RolAttr::ID])
                ->where('user_id', $user[UserAttr::ID])
                ->delete();
    }
}
