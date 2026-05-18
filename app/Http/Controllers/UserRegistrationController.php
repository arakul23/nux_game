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

        $url = URL::temporarySignedRoute('gamble_form', now()->addDays(7), ['user' => $user->id, 'link_id' => $user->link_token]);

        return redirect()->to($url)->with(compact('user', 'url'));
    }

    public function getLink(User $user): RedirectResponse
    {
        $user->update(['link_token' =>  $data['link_token'] = (string) Str::uuid()]);
        $url = URL::temporarySignedRoute('gamble_form', now()->addDays(7), ['user' => $user->id, 'link_id' => $user->link_token]);

        return redirect()->to($url)->with(compact('user', 'url'));
    }

    public function unsignedLink(User $user): RedirectResponse
    {
        $user->update(['link_token' => null]);

        return redirect()->route('welcome');
    }

    private function generateLink(string $userId, string $token): string
    {
      return URL::temporarySignedRoute(
            'gamble_form',
            now()->addDays(7),
            [
                'user' => $userId,
                'token' => $token
            ]
        );
    }
}
