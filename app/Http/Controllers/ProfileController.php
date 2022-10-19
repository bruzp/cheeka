<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\User\UserUpdateRequest;

class ProfileController extends Controller
{
    public function edit()
    {
        return Inertia::render('Profile');
    }

    public function update(UserUpdateRequest $request, UserService $userService)
    {
        $response = $userService->update($request->validated());

        if ($response->status() === 200) {
            Cache::forget('user');
        }

        return redirect()
            ->route('profile')
            ->with('message', $response['messages'] ?? null)
            ->withErrors($response['messages'] ?? null);
    }
}
