<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(): View
    {
        return view('user.index');
    }
    public function showform(): View
    {
        return view('user.form');
    }
}
