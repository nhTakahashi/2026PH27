<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Busho;
/**
 * 部署コントローラー
 */
class BushoController extends Controller
{
    // 部署一覧を表示します。
    public function index()
    {
        // withCount()で、各部署に所属する社員数も同時に取得します。
        $bushoList = Busho::withCount('shain')->orderBy('busho_id')->get();

        // 取得した部署一覧をBladeテンプレートに渡します。
        return view('busho.index', ['bushoList' => $bushoList]);
    }

    // 部署の新規登録フォームを表示します。
    public function sakusei()
    {
        return view('busho.sakusei');
    }

    // フォームから送られた部署を保存します。
    public function hozon(Request $request)
    {
        // 空欄や長すぎる部署名を保存しないために入力内容を検証します。
        $request->validate([
            'busho_mei' => 'required|string|max:255',
        ]);

        // only()で、登録を許可した部署名だけを取り出して保存します。
        Busho::create($request->only('busho_mei'));

        // 一覧画面へ戻り、処理完了メッセージを一度だけ表示します。
        return redirect()->route('busho.index')->with('success', '部署を登録しました。');
    }

    // 指定された部署の編集フォームを表示します。
    public function edit(int $id)
    {
        // findOrFail()は対象IDが存在しない場合に404エラーを返します。
        $busho = Busho::findOrFail($id);

        return view('busho.edit', ['busho' => $busho]);
    }

    // 指定された部署情報を更新します。
    public function update(Request $request, int $id)
    {
        $request->validate([
            'busho_mei' => 'required|string|max:255',
        ]);

        $busho = Busho::findOrFail($id);

        // リクエスト全体ではなく、更新を許可した部署名だけを反映します。
        $busho->update($request->only('busho_mei'));

        return redirect()->route('busho.index')->with('success', '部署情報を更新しました。');
    }

    // 指定された部署を削除します。
    public function delete(int $id)
    {
        $busho = Busho::findOrFail($id);

        // 所属社員がいると外部キー制約により削除できないため、先に確認します。
        if ($busho->shain()->exists()) {
            return redirect()->route('busho.index')->with('error', '所属社員がいる部署は削除できません。');
        }

        // 社員がいない部署だけを削除します。
        $busho->delete();
        return redirect()->route('busho.index')->with('success', '部署を削除しました。');
    }
}