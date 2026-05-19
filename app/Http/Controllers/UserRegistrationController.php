<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use App\Services\UserRegistrationService;
use DateTimeInterface;
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
        $link = $this->generateLink($user->id, $user->link_token, $user->link_expires_at);

        return redirect()->to($link)->with(compact('user', 'link'));
    }

    public function getNewLink(User $user): RedirectResponse
    {
        $token = (string) Str::uuid();
        $expiresAt = now()->addMinute();
        $user->update([
            'link_token' => $token,
            'link_expires_at' => $expiresAt,
        ]);
        $link = $this->generateLink($user->id, $token, $expiresAt);

        return redirect()->to($link)->with(compact('user', 'link'));
    }

    public function unsignedLink(User $user): RedirectResponse
    {
        $user->update([
            'link_token' => null,
            'link_expires_at' => null,
        ]);

        return redirect()->route('welcome');
    }

    private function generateLink(int $userId, string $token, DateTimeInterface $expiresAt): string
    {
      return URL::temporarySignedRoute('gamble_form', $expiresAt, ['user' => $userId, 'link_id' => $token]);
    }
}
