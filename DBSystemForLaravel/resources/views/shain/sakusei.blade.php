<!DOCTYPE html>
<html lang="ja">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>社員登録</title></head>
<body>
    <h1>社員登録</h1>
    @if ($errors->any())
        <ul style="color: red;">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    @endif
    <form action="{{ route('shain.hozon') }}" method="POST">
        @csrf
        <p><label>社員名 <input name="shain_mei" value="{{ old('shain_mei') }}" required></label></p>
        <p><label>メールアドレス <input type="email" name="mail_address" value="{{ old('mail_address') }}" required></label></p>
        <p><label>パスワード <input type="password" name="password" required></label></p>
        <p><label>パスワード確認 <input type="password" name="password_confirmation" required></label></p>
        <p><label>所属部署 <select name="busho_id" required><option value="">選択してください</option>@foreach ($bushoList as $busho)<option value="{{ $busho->busho_id }}" @selected(old('busho_id') == $busho->busho_id)>{{ $busho->busho_mei }}</option>@endforeach</select></label></p>
        <p><label>役職 <input name="yakushoku" value="{{ old('yakushoku') }}"></label></p>
        <p><label>入社日 <input type="date" name="nyusha_bi" value="{{ old('nyusha_bi') }}"></label></p>
        <p><label>給与 <input type="number" name="kyuyo" min="0" value="{{ old('kyuyo') }}"></label></p>
        <button type="submit">登録</button>
    </form>
    <p><a href="{{ route('shain.index') }}">社員一覧に戻る</a></p>
</body>
</html>