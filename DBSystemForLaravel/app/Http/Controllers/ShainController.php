<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Busho;
use App\Models\Shain;

/**
 * 社員コントローラー
 */
class ShainController extends Controller
{
    public function index(Request $request)
    {
        // with()で部署も一緒に取得し、一覧表示時の余分なSQLを防ぎます。
        $query = Shain::with('busho');

        // 入力された社員名を含む社員だけに絞り込みます。
        if ($request->filled('keyword')) {
            $query->where('shain_mei', 'like', '%' . $request->string('keyword') . '%');
        }

        // 部署が選ばれているときだけ、その部署の社員に絞り込みます。
        if ($request->filled('busho_id')) {
            $query->where('busho_id', $request->integer('busho_id'));
        }

        // 許可した項目だけを並び替えに使い、想定外の列名を受け付けません。
        $sort = in_array($request->input('sort'), ['kyuyo', 'nyusha_bi'], true)
            ? $request->input('sort')
            : 'shain_id';
        $direction = $request->input('direction') === 'asc' ? 'asc' : 'desc';

        return view('shain.index', [
            // 1ページに2件表示し、検索条件を次のページにも引き継ぎます。
            'shainList' => $query->orderBy($sort, $direction)->paginate(2)->withQueryString(),
            'bushoList' => Busho::orderBy('busho_mei')->get(),
        ]);
    }

    public function sakusei()
    {
        return view('shain.sakusei', ['bushoList' => Busho::orderBy('busho_mei')->get()]);
    }

    public function hozon(Request $request)
    {
        // 入力内容を検証してから、許可した項目だけを保存します。
        $data = $this->validateShain($request);
        Shain::create($data);

        return redirect()->route('shain.index')->with('success', '社員を登録しました。');
    }

    public function edit(int $id)
    {
        return view('shain.edit', [
            'shain' => Shain::findOrFail($id),
            'bushoList' => Busho::orderBy('busho_mei')->get(),
        ]);
    }

    public function update(Request $request, int $id)
    {
        // URLで指定された社員を取得し、存在しない場合は404画面を表示します。
        $shain = Shain::findOrFail($id);
        $data = $this->validateShain($request, $shain);

        if ($data['password'] === null) {
            // パスワード未入力なら、現在登録されている値を変更しません。
            unset($data['password']);
        }

        $shain->update($data);

        return redirect()->route('shain.index')->with('success', '社員情報を更新しました。');
    }

    public function delete(int $id)
    {
        // ログインできる社員が一人もいなくなることを防ぎます。
        if (Shain::count() === 1) {
            return redirect()->route('shain.index')->with('error', '最後の社員は削除できません。');
        }

        Shain::findOrFail($id)->delete();

        return redirect()->route('shain.index')->with('success', '社員を削除しました。');
    }

    private function validateShain(Request $request, ?Shain $shain = null): array
    {
        // 新規登録では必須、更新では空欄なら変更しないパスワード規則です。
        $passwordRules = $shain === null
            ? ['required', 'string', 'min:8', 'confirmed']
            : ['nullable', 'string', 'min:8', 'confirmed'];

        return $request->validate([
            // メールアドレスは社員ごとに重複しないようにします。
            'shain_mei' => ['required', 'string', 'max:50'],
            'mail_address' => ['required', 'email', 'max:100', Rule::unique('shain', 'mail_address')->ignore($shain?->shain_id, 'shain_id')],
            'password' => $passwordRules,
            'busho_id' => ['required', 'integer', Rule::exists('busho', 'busho_id')],
            'yakushoku' => ['nullable', 'string', 'max:30'],
            'nyusha_bi' => ['nullable', 'date'],
            'kyuyo' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}