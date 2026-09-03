<!DOCTYPE html>
<html lang="ja">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>ログイン</title></head>
<body>
    <h1>社員管理システム ログイン</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    @if ($errors->any())
        <ul style="color: red;">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    @endif
    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <p><label>メールアドレス <input type="email" name="mail_address" value="{{ old('mail_address') }}" required></label></p>
        <p><label>パスワード <input type="password" name="password" required></label></p>
        <button type="submit">ログイン</button>
    </form>
</body>
</html>