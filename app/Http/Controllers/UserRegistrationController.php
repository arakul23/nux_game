<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use App\Services\UserRegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class UserRegistrationController extends Controller
{
    public function __construct(readonly private UserRegistrationService $userRegistrationService)
    {}

    public function register(RegisterFormRequest $request): RedirectResponse
    {
        $user = $this->userRegistrationService->register($request->validated());
        $link = $this->generateLink($user->id, $user->link_token);

        return redirect()->to($link)->with(compact('user', 'link'));
    }

    public function getNewLink(User $user): RedirectResponse
    {
        $token = (string) Str::uuid();
        $user->update(['link_token' => $token]);
        $link = $this->generateLink($user->id, $token);

        return redirect()->to($link)->with(compact('user', 'link'));
    }

    public function unsignedLink(User $user): RedirectResponse
    {
        $user->update(['link_token' => null]);

        return redirect()->route('welcome');
    }

    private function generateLink(int $userId, string $token): string
    {
      return URL::temporarySignedRoute('gamble_form', now()->addDays(7), ['user' => $userId, 'link_id' => $token]);
    }
}
