<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>部署新規登録</title>
</head>
<body>
    <h1>部署新規登録</h1>
    @if ($errors->any())
        <ul style="color: red;">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    @endif
    <form action="{{ route('busho.hozon') }}" method="POST">
        @csrf
        <label for="busho_mei">部署名:</label>
        <input type="text" name="busho_mei" id="busho_mei" value="{{ old('busho_mei') }}" required>
        <button type="submit">登録</button>
    </form>
    <p><a href="{{ route('busho.index') }}">部署一覧に戻る</a></p>
</body>
</html>