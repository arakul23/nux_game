<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\GambleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GambleController extends Controller
{

    public function __construct(readonly private GambleService $gambleService)
    {
    }

    public function index(Request $request, User $user)
    {
        if ($request->query('link_id') !== $user->link_token) {
            abort(403, 'Ссылка недействительна.');
        }

        return view('gamble', compact('user'));
    }

    public function getResult(User $user): RedirectResponse
    {
        $result = $this->gambleService->calculateResult();
        $user->history()->create($result);

        return back()->with(['result' => $result]);
    }
}
