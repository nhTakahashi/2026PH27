<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Busho;
/**
 * 部署コントローラー
 */
class BushoController extends Controller
{
    //indexメソッドを追加
    public function index()
    {
        //部署一覧を取得
        $bushoList = Busho::all();
        //ビューに渡す
        return view('busho.index', ['bushoList' => $bushoList]);
    }

    //部署新規登録メソッドを追加
    public function sakusei()
    {
        //ビューに渡す
        return view('busho.sakusei');
    }

    //部署保存メソッドを追加
    public function hozon(Request $request)
    {
        //バリデーション
        $request->validate([
            //部署名は「必須」で「文字列」、「最大255文字」
            'busho_mei' => 'required|string|max:255',
        ]);
        //部署を保存
        Busho::create($request->all());

        //部署一覧にリダイレクト
        return redirect()->route('busho.index');
    }

    //部署編集メソッドを追加
    public function edit(int $id)
    {
        //部署を取得
        $busho = Busho::findOrFail($id);
        //ビューに渡す
        return view('busho.edit', ['busho' => $busho]);
    }

    //部署更新メソッドを追加
    public function update(Request $request, int $id)
    {
        //バリデーション
        $request->validate([
            //部署名は「必須」で「文字列」、「最大255文字」
            'busho_mei' => 'required|string|max:255',
        ]);
        //部署を取得
        $busho = Busho::findOrFail($id);
        //部署を更新
        $busho->update($request->all());

        //部署一覧にリダイレクト
        return redirect()->route('busho.index');
    }

    //部署削除メソッドを追加
    public function delete(int $id)
    {
        //部署を取得
        $busho = Busho::findOrFail($id);
        //部署を削除
        $busho->delete();
        //部署一覧にリダイレクト
        return redirect()->route('busho.index');
    }
}