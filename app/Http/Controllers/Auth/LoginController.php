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
            $user = auth()->user();
            if ($user->type === 'admin') {
                return redirect()->to('/dashboard/users'); // Redirect admin to the dashboard
            } else{
                return redirect()->to('/');
            }
//return redirect()->back()->with('success', 'Login success');
        } else {
            return redirect()->back()->withErrors(['error' => 'Email or password invalid']);
        }
    }

}
