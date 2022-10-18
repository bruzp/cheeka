<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthService extends Service
{
    public function login(array $credentials)
    {
        return Http::withToken($this->getAPIBasicToken())
            ->post($this->getAPIUrl() . '/login', $credentials);
    }

    public function getUser()
    {
        return Http::withToken(session('token'))
            ->get($this->getAPIUrl() . '/user')
            ->json();
    }

    public function logout()
    {
        return Http::withToken(session('token'))
            ->post($this->getAPIUrl() . '/logout');
    }
}
