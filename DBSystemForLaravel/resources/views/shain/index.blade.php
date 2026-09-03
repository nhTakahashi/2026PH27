<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社員一覧</title>
</head>
<body>
    <h1>社員一覧</h1>
    <nav>
        <a href="{{ route('shain.sakusei') }}">社員を新規登録</a> |
        <a href="{{ route('busho.index') }}">部署一覧</a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">ログアウト</button>
        </form>
    </nav>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form method="GET" action="{{ route('shain.index') }}">
        <label for="keyword">社員名</label>
        <input id="keyword" name="keyword" value="{{ request('keyword') }}">
        <label for="busho_id">部署</label>
        <select id="busho_id" name="busho_id">
            <option value="">すべて</option>
            @foreach ($bushoList as $busho)
                <option value="{{ $busho->busho_id }}" @selected((string) $busho->busho_id === request('busho_id'))>{{ $busho->busho_mei }}</option>
            @endforeach
        </select>
        <label for="sort">並び順</label>
        <select id="sort" name="sort">
            <option value="shain_id">登録順</option>
            <option value="kyuyo" @selected(request('sort') === 'kyuyo')>給与</option>
            <option value="nyusha_bi" @selected(request('sort') === 'nyusha_bi')>入社日</option>
        </select>
        <select name="direction" aria-label="昇順・降順">
            <option value="desc" @selected(request('direction', 'desc') === 'desc')>降順</option>
            <option value="asc" @selected(request('direction') === 'asc')>昇順</option>
        </select>
        <button type="submit">検索</button>
    </form>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>社員名</th>
                <th>部署名</th>
                <th>役職</th>
                <th>入社日</th>
                <th>給与</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shainList as $shain)
                <tr>
                    <td>{{ $shain->shain_id }}</td>
                    <td>{{ $shain->shain_mei }}</td>
                    <td>{{ $shain->busho?->busho_mei ?? '未所属' }}</td>
                    <td>{{ $shain->yakushoku }}</td>
                    <td>{{ $shain->nyusha_bi?->format('Y/m/d') }}</td>
                    <td>{{ $shain->kyuyo !== null ? number_format($shain->kyuyo) . '円' : '' }}</td>
                    <td>
                        <a href="{{ route('shain.edit', ['id' => $shain->shain_id]) }}">編集</a>
                        <form action="{{ route('shain.delete', ['id' => $shain->shain_id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $shainList->links('vendor.pagination.shain') }}
</body>
</html>