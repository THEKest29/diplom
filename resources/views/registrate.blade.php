@extends('layouts.app')
@section('content')
<main class="form-center" style="background-image: url('{{ asset('img/chainsaw-man-backfon.png') }}'); background-size: cover; background-position: center;">
<form action="{{ route('post.regist') }}" class="form-container light-theme" method="POST">
    @csrf
    <label for="nick">Никнейм</label><br>
    <input type="text" name="nick" id="nick" minlength="5" required><br>
    <label for="email">Почта</label><br>
    <input type="email" name="email" id="email" required><br>
    <label for="password">Пароль</label><br>
    <input type="password" name="password" id="password" minlength="5" required><br>
    <label for="password_confirm">Подтвердите пароль</label><br>
    <input type="password" name="password_confirm" minlength="5" required><br>
    <p>У вас есть аккаунт?<a href="{{route('login')}}">Войти</a><br>
    <button type="submit">Зарегистрироваться</button>
</form>
</main>
@endsection