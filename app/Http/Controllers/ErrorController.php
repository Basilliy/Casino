<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ErrorController extends Controller
{
    public function linkError(): View
    {
        return view('error.wrong_link');
    }
}
