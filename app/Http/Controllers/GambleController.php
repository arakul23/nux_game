<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\GambleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class GambleController extends Controller
{

    public function __construct(readonly private GambleService $gambleService)
    {
    }

    public function index(User $user): View
    {
        return view('gamble', [
            'user' => $user,
            'actions' => $this->buildActionLinks($user),
        ]);
    }

    public function getResult(User $user): RedirectResponse
    {
        $result = $this->gambleService->calculateResult();
        $user->history()->create($result);

        return redirect()
            ->to($this->signedRoute('gamble_form', $user))
            ->with(['result' => $result]);
    }

    private function buildActionLinks(User $user): array
    {
        return [
            'play' => $this->signedRoute('calculate_gamble', $user),
            'history' => $this->signedRoute('get_histories', $user),
            'generate' => $this->signedRoute('generate_link', $user),
            'revoke' => $this->signedRoute('unsigned_link', $user),
        ];
    }

    private function signedRoute(string $routeName, User $user): string
    {
        return URL::temporarySignedRoute($routeName, $this->resolveLinkExpiration($user), [
            'user' => $user->id,
            'link_id' => $user->link_token,
        ]);
    }

    private function resolveLinkExpiration(User $user): Carbon
    {
        return $user->link_expires_at ?? now();
    }
}
