<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // ユーザー用のログイン画面を表示
    public function showLoginForm()
    {
        return view('auth.user_login'); // ユーザー専用ログイン画面
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->intended('/dashboard'); // ログイン後のリダイレクト先
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが違います',
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
