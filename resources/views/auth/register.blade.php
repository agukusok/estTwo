@extends('layouts.app')

@section('content')
<div class="container">
	<h2>Регистрация</h2>

	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form action="{{ route('register') }}" method="POST">
		@csrf
		<div class="mb-3">
			<label for="email" class="form-label">Email</label>
			<input type="email" class="form-control" id="email" name="email" required>
		</div>
		<div class="mb-3">
			<label for="username" class="form-label">Имя пользователя</label>
			<input type="text" class="form-control" id="username" name="username" required>
		</div>
		<div class="mb-3">
			<label for="name" class="form-label">Имя</label>
			<input type="text" class="form-control" id="name" name="name">
		</div>
		<button type="submit" class="btn btn-primary">Зарегистрироваться</button>
		<a href="{{ route('login') }}" class="linkTo">Есть аккаунт? Войди в систему!</a>
	</form>
</div>
@endsection
