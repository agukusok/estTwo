@extends('layouts.app')

@section('content')
<div class="container">
	<h2>Авторизация</h2>

	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif

	<form id="loginForm" method="POST" action="{{ route('login') }}">
		@csrf
		<div class="mb-3">
			<label for="email" class="form-label">Email</label>
			<input type="email" class="form-control" id="email" name="email" required>
		</div>
		<div class="mb-3">
			<label for="username" class="form-label">Имя пользователя</label>
			<input type="text" class="form-control" id="username" name="username" required>
		</div>
		<button type="submit" class="btn btn-primary">Войти</button>
		<a href="{{ route('register') }}" class="linkTo">Нет аккаунта? Зарегистрироваться!</a>
	</form>
</div>
@endsection