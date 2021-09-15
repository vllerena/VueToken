<?php

namespace App\Models;

use App\Contracts\Autenticable;
use App\Models\Info\TokenAttr;
use App\Models\Info\UserAttr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Token extends Model implements Autenticable
{
    use HasFactory;

    public $timestamps = false;
    protected $table = TokenAttr::NOMBRE_TABLA;

    protected $fillable = [
        TokenAttr::USER_ID,
        TokenAttr::TOKEN,
    ];

    public static function generateToken(User $user)
    {
        $token = Str::random(40) . $user[UserAttr::ID];
        return hash('sha256', $token);
    }

    public function refreshToken()
    {
        $rawToken = Str::random(40) . $this->user[UserAttr::ID];
        return hash('sha256', $rawToken);
    }

    public function user()
    {
        return $this->belongsTo(User::class, TokenAttr::USER_ID, UserAttr::ID);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    static function getPrimaryKey()
    {
        return TokenAttr::ID;
    }
}
