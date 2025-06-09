<form method="POST" action="{{ route('2fa.action') }}">
    @csrf
    <div>
        <label for="2fa_code">Введите 6-значный код:</label>
        <input id="2fa_code" type="text" name="2fa_code" required>
    </div>

    <div>
        <button type="submit">Подтвердить</button>
    </div>
</form>
