<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;

class LoginController extends Controller
{
    public function index()
    {

        return view('auth.login');

    }

    public function save(LoginFormRequest $request)
    {

        $data = $request->validated();
// [email=>'',password=>'']
        if (auth()->attempt($data)) {
            return redirect()->to(path: '/');
//return redirect()->back()->with('success', 'Login success');
        } else {
            return redirect()->back()->withErrors(['error' => 'Email o']);
        }
    }

}
