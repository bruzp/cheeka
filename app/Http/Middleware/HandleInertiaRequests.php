<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed[]
     */
    public function share(Request $request)
    {
        $message = session('message') ?? null;

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $this->getUser(),
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => [
                'message' => is_string($message) ? $message :  ''
            ],
        ]);
    }

    private function getUser()
    {
        if (!session()->has('token')) {
            return [];
        }

        if (Cache::has('user')) {
            return Cache::get('user');
        }

        $auth_service = new AuthService;

        $user = $auth_service->getUser();

        if ($user) {
            Cache::put('user', $user);

            return $user;
        }

        return [];
    }
}
