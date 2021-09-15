<?php

namespace App\Services;

use App\Contracts\TokenContract;
use App\Models\Info\TokenAttr;
use App\Models\Info\UserAttr;
use App\Models\Token;
use App\Models\User;

class TokenService implements TokenContract
{
    public function refreshToken(Token $token): Token
    {
        $token->update([TokenAttr::TOKEN => $token->refreshToken()]);
        return $token;
    }

    public function createToken(User $user): Token
    {
        return Token::create([
            TokenAttr::USER_ID => $user[UserAttr::ID],
            TokenAttr::TOKEN => Token::generateToken($user),
        ]);
    }
}
