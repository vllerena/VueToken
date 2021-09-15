<?php

namespace App\Http\Requests\Auth\Token;

use App\Models\Info\UserAttr;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class GetTokenRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $validCredentials = Auth::validate($this->getCredentials());
            if (!$validCredentials)
                $validator->errors()->add(UserAttr::USERNAME, 'El username y/o contraseña ingresados son incorrectos.');
        });
    }

    public function rules()
    {
        return [
            UserAttr::USERNAME => [
                'required',
                Rule::exists(UserAttr::NOMBRE_TABLA)->where(function ($query) {
                    return $query->where(UserAttr::ESTA_ACTIVO, true);
                })
            ],
            UserAttr::PASSWORD => ['required', 'string',]
        ];
    }

    private function getCredentials()
    {
        $email = $this->input(UserAttr::USERNAME, '');
        $pass = $this->input(UserAttr::PASSWORD, '');
        return [UserAttr::USERNAME => $email, UserAttr::PASSWORD => $pass];
    }
}
