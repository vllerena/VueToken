<?php

namespace App\Contracts;

use App\Models\Token;
use App\Models\User;

interface TokenContract
{
    public function refreshToken(Token $token): Token;

    public function createToken(User $user): Token;
}
