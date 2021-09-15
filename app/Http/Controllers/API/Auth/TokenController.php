<?php

namespace App\Http\Controllers\API\Auth;

use App\Contracts\TokenContract;
use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Token\GetTokenRequest;
use App\Models\Info\UserAttr;
use App\Utils\HttpStatus;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    private UserContract $userService;
    private TokenContract $tokenService;

    public function __construct(UserContract $userService, TokenContract $tokenService)
    {
        $this->userService = $userService;
        $this->tokenService = $tokenService;
    }

    public function getToken(GetTokenRequest $request)
    {
        $validated = $request->validated();
        $user = $this->userService->whereFirst(UserAttr::USERNAME, $validated[UserAttr::USERNAME]);
        return response()->json($user);
    }

    public function refreshToken(Request $request)
    {
        $this->tokenService->refreshToken($request->user());
        return response()->json([], HttpStatus::HTTP_204_NO_CONTENT);
    }
}
