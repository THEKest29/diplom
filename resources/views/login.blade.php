@extends('layouts.app')
@section('content')
<main class="form-center" style="background-image: url('{{ asset('img/chainsaw-man-backfon.png') }}'); background-size: cover; background-position: center;">
    <form action="{{ route('login')}}" class="light-theme form-container" method="POST">
    @csrf
    <label>Никнейм</label><br>
    <input type="text" id="nick" name="nick" required><br>
    <label>Пароль</label><br>
    <input type="password" id="password" name="password" required><br>
    <p>У вас нет аккаунта?<a href="{{route('register')}}">Зарегистрироваться</a><br>
    <button type="submit">Войти</button>
</form>
</main>
@endsection