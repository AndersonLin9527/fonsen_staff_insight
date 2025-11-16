<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginController
 */
class LoginController extends Controller
{
    /**
     * 登入頁
     * @return Factory|View
     * @link https://local-fonsen-staff-insight.henxo9527.com/loginPage
     */
    public function loginPage()
    {
        return view('auth.login');
    }

    /**
     * 登入
     * @return RedirectResponse
     */
    public function login(Request $request)
    {
        // 驗證輸入
        $credentials = $request->validate([
            'code' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // 使用 code + password 嘗試登入（使用預設 web guard）
        $remember = $request->boolean('remember');

        if (Auth::attempt([
            'code'     => $credentials['code'],
            'password' => $credentials['password'],
        ], $remember)) {
            $request->session()->regenerate();

            // 之後可以改成 redirect()->route('feedback.form');
            return redirect()->intended('/');
        }

        // 登入失敗
        return back()
            ->withErrors([
                'code' => '帳號或密碼錯誤。',
            ])
            ->onlyInput('code');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('frontend.loginPage');
    }

}
