<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectBadController extends Controller
{
    public static function falha() {
        return view('errors.404');
    }
}
