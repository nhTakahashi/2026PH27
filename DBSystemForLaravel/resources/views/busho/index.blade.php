<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>部署一覧</title>
</head>
<body>
    <h1>部署一覧</h1>
    <p><a href="{{ route('busho.sakusei') }}">新規登録</a></p>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>部署名</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bushoList as $busho)
                <tr>
                    <td>{{ $busho->busho_id }}</td>
                    <td>{{ $busho->busho_mei }}</td>
                    <td>
                        <a href="{{ route('busho.edit', ['id' => $busho->busho_id]) }}">編集</a>
                        <form action="{{ route('busho.delete', ['id' => $busho->busho_id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>