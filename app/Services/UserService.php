<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserService extends Service
{
    public function update(array $data)
    {
        return Http::withToken(session('token'))
            ->put($this->getAPIUrl() . '/user', $data);
    }
}
