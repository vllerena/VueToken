<?php

namespace App\Console\Commands;

use App\Models\Info\TokenAttr;
use App\Models\Info\UserAttr;
use App\Models\Token;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CrearSuperuser extends Command
{
    protected $signature = 'make:superuser {email} {pass}';
    protected $description = 'Crea un superusuario o actualiza acorde a un email y pass';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $args = $this->arguments();
        $email = $args['email'];
        $pass = $args['pass'];

        $user = User::updateOrCreate(
            [UserAttr::USERNAME => $email],
            [
                UserAttr::USERNAME => $email,
                UserAttr::PASSWORD => Hash::make($pass),
                UserAttr::ES_SUPERUSER => true,
            ]
        );

        $token = Str::random(40) . $user[UserAttr::ID];

        Token::updateOrCreate(
            [TokenAttr::USER_ID => $user[UserAttr::ID]],
            [
                TokenAttr::USER_ID => $user[UserAttr::ID],
                TokenAttr::TOKEN => \hash('sha256', $token)
            ]
        );

        $this->info("Se ha actualizado o creado el usuario.");

        return 0;
    }
}
