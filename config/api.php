<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Basic Token
    |--------------------------------------------------------------------------
    |
    | This API Token will protect routes before user logs in.
    | We may also call it guest API routes protection.
    |
    */

    'basic_token' => env('APP_TOKEN', null),
];
