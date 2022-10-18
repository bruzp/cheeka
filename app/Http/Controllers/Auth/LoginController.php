<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Auth/Login');
    }

    public function authenticate(LoginRequest $request, AuthService $authService)
    {
        $response = $authService->login($request->validated());

        $token = $response['token'] ?? null;

        if ($token) {
            session(['token' => $token]);

            return redirect()->route('dashboard');
        }

        return redirect()
            ->route('login')
            ->withErrors($response['messages'] ?? null)
            ->withInput();
    }

    public function logout(AuthService $authService)
    {
        $response = $authService->logout();

        if ($response->status() === 200) {
            session()->forget('token');
            Cache::forget('user');

            return redirect()
                ->route('login')
                ->with($response['messages'] ?? null);
        }

        return redirect()->back(303);
    }
}
