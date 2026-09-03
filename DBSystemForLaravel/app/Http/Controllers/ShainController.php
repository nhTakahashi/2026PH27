<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Busho;
use App\Models\Shain;

/**
 * 社員コントローラー
 */
class ShainController extends Controller
{
    //indexメソッドを追加
    public function index()
    {
        //社員一覧を取得
        $shainList = Shain::all();
        //ビューに渡す
        return view('shain.index', ['shainList' => $shainList]);
    }

    //社員新規登録メソッドを追加
    public function sakusei()
    {
        //部署一覧を取得
        $bushoList = Busho::all();
        //ビューに渡す
        return view('shain.sakusei', ['bushoList' => $bushoList]);
    }

    //社員保存メソッドを追加
    public function hozon(Request $request)
    {
        //バリデーション
        $request->validate([
            //社員名は「必須」で「文字列」、「最大255文字」
            'shain_mei' => 'required|string|max:255',
            //部署IDは「必須」で「整数」
            'busho_id' => 'required|integer',
            //役職は「必須」で「文字列」、「最大255文字」
            'yakushoku' => 'required|string|max:255',
            //入社日は「必須」で「日付」
            'nyusha_date' => 'required|date',
            //社員電話番号は「必須」で「文字列」、「最大20文字」
            'shain_tel' => 'required|string|max:20',
            //社員メールアドレスは「必須」で「メールアドレス形式」、「最大255文字」
            'shain_mail' => 'required|email|max:255',
        ]);
        //社員を保存
        Shain::create($request->all());

        //社員一覧にリダイレクト
        return redirect()->route('shain.index');
    }
}