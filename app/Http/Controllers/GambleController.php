<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GambleController extends Controller
{
    public function calculateResult()
    {
        return view('gamble');
    }
}
