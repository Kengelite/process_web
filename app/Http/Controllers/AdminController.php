<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdmin(): View
    {
        return view('user.index');
    }

}
