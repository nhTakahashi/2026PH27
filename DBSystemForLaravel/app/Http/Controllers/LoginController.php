<?php

namespace App\Http\Controllers;

use App\Models\Shain;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        // フォームから送られたログイン情報の形式を検証します。
        $credentials = $request->validate([
            'mail_address' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // メールアドレスが一致する社員を一人だけ取得します。
        $shain = Shain::where('mail_address', $credentials['mail_address'])->first();

        // 課題仕様に合わせ、平文のパスワード同士を直接比較します。
        if ($shain === null || $credentials['password'] !== $shain->password) {
            return back()->withErrors(['mail_address' => 'メールアドレスまたはパスワードが正しくありません。'])->onlyInput('mail_address');
        }

        // セッションIDを再発行してから、ログイン中の社員IDを保存します。
        $request->session()->regenerate();
        $request->session()->put('login_shain_id', $shain->shain_id);

        return redirect()->route('shain.index')->with('success', 'ログインしました。');
    }

    public function destroy(Request $request)
    {
        // セッションからログイン情報を削除してログアウトします。
        $request->session()->forget('login_shain_id');
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'ログアウトしました。');
    }
}