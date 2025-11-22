<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

/**
 * Class LoginController
 */
class LoginController extends Controller
{
    protected string $rememberMemberCode = 'rememberMemberCode';


    /**
     * 登入頁
     * @return Factory|View
     * @link https://local-fonsen-staff-insight.henxo9527.com/loginPage
     */
    public function loginPage()
    {
        // 從 Cookie 把上次勾選「記住我」的員工編號帶回來
        $data = [
            'rememberMemberCode' => request()->cookie($this->rememberMemberCode),
        ];
        return view('auth.login', $data);
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

        $authResult = Auth::attempt([
            'code' => $credentials['code'],
            'password' => $credentials['password'],
        ], $remember);

        if ($authResult) {
            $request->session()->regenerate();
            // -----------------------------
            // 記住員工編號到本機 Cookie
            // -----------------------------
            if ($remember) {
                // 43200 分鐘 = 30 天
                Cookie::queue($this->rememberMemberCode, $credentials['code'], 43200);
            } else {
                Cookie::queue(Cookie::forget($this->rememberMemberCode));
            }
            return redirect()->intended(route('frontend.home'));
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
