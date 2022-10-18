<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegistrationService extends Service
{
    public function register(array $data)
    {
        return Http::withToken($this->getAPIBasicToken())
            ->post($this->getAPIUrl() . '/register', $data);
    }
}
