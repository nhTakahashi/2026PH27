<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>部署編集</title>
</head>
<body>
    <h1>部署編集</h1>
    @if ($errors->any())
        <ul style="color: red;">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    @endif
    <form action="{{ route('busho.update', ['id' => $busho->busho_id]) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="busho_mei">部署名:</label>
        <input type="text" id="busho_mei" name="busho_mei" value="{{ old('busho_mei', $busho->busho_mei) }}" required>
        <button type="submit">更新</button>
        <p><a href="{{ route('busho.index') }}">部署一覧に戻る</a></p>
    </form>
</body>
</html>