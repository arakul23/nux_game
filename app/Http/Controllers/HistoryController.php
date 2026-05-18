<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class HistoryController extends Controller
{
    public function getHistories(User $user): View
    {
        return view('history', ['history' => $user->history()->latest()->take(3)->get()]);
    }
}
