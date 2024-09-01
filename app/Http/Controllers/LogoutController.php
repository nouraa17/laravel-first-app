<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth')
            ->only('logout_system');
    }
public function logout_system()
{
//    echo 'logout_system';

    if (auth()->check()) {
        auth()->logout();
    }
        return redirect()->to('/auth/login');

    }
}
