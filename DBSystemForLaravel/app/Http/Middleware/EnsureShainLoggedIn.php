<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Shain;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureShainLoggedIn
{
    // 管理画面へ進む前に、ログイン済みかを確認します。
    public function handle(Request $request, Closure $next): Response
    {
        // 初回はログイン用社員がいないため、最初の部署・社員登録を許可します。
        if (!Shain::exists()) {
            return $next($request);
        }

        // セッションに社員IDがなければ、ログイン画面へ戻します。
        if (!$request->session()->has('login_shain_id')) {
            return redirect()->route('login')->with('error', 'ログインしてください。');
        }

        // ログイン済みなら、本来のコントローラ処理を実行します。
        return $next($request);
    }
}