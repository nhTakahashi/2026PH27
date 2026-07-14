<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>部署編集</title>
</head>
<body>
    <h1>部署編集</h1>
    <form action="{{ route('busho.update', ['id' => $busho->busho_id]) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="busho_mei">部署名:</label>
        <input type="text" id="busho_mei" name="busho_mei" value="{{ $busho->busho_mei }}" required>
        <button type="submit">更新</button>
    </form>
</body>
</html>