<?php

namespace App\Services;

use Illuminate\Http\Request;

class Service
{
    public function getAPIUrl()
    {
        return config('api.url') ?: abort(404, 'API URL is missing!');
    }

    public function getAPIBasicToken()
    {
        return config('api.token') ?: abort(422, 'API Basic Token is missing!');
    }
}
