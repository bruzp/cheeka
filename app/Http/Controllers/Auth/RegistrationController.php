<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Services\RegistrationService;
use App\Http\Requests\Auth\RegistrationRequest;

class RegistrationController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    public function store(RegistrationRequest $request, RegistrationService $registrationService)
    {
        $response = $registrationService->register($request->validated());

        return redirect()
            ->route('register')
            ->with('message', $response['messages'] ?? null)
            ->withErrors($response['messages'] ?? null);
    }
}
