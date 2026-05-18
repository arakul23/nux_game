<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Services\UserRegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;

class UserRegistrationController extends Controller
{
    public function __construct(readonly private UserRegistrationService $userRegistrationService)
    {}

    public function register(RegisterFormRequest $request): RedirectResponse
    {
        $user = $this->userRegistrationService->register($request->validated());

        $url = URL::temporarySignedRoute('gamble_form', now()->addDays(7), compact('user'));

        return redirect()->to($url)->with(compact('user', 'url'));
    }
}
