@extends('layouts.app')

@section('content')
<div class="container my-container">
	<div class="left col-6">
		<h2>Профиль пользователя</h2>
		<p><strong>ID:</strong> {{ $user->id }}</p>
		<p><strong>Email:</strong> {{ $user->email }}</p>
		<p><strong>Имя пользователя:</strong> {{ $user->username }}</p>
		<p><strong>Имя:</strong> {{ $user->name }}</p>

		<form action="{{ route('logout') }}" method="POST" id="logoutForm">
			@csrf
			<button type="submit" class="btn btn-secondary" id="logoutButton">Выйти</button>
		</form>
		<button type="button" class="btn btn-danger" id="deleteButton">Удалить аккаунт</button>
	</div>
	<div class="right col-6">
		<h3>Обновить данные</h3>
		<form id="updateForm">
			@csrf
			@method('PUT')
			<div class="mb-3">
				<label for="username" class="form-label">Имя пользователя</label>
				<input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
			</div>
			<div class="mb-3">
				<label for="name" class="form-label">Имя</label>
				<input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
			</div>
			<button type="button" class="btn btn-primary" id="updateButton">Обновить</button>
		</form>
	</div>
</div>

<script>
	document.getElementById('updateButton').addEventListener('click', async function() {
		const username = document.getElementById('username').value;
		const name = document.getElementById('name').value;

		const data = {
			username: username,
			name: name
		};

		try {
			const response = await fetch("{{ route('user.update') }}", {
				method: 'PUT',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
				},
				body: JSON.stringify(data),
			});

			const result = await response.json();
			if (response.ok) {
				alert('Данные успешно обновлены!');
				window.location.href = 'user';
			} else {
				console.error('Ошибка:', result);
				alert('Ошибка обновления: ' + result.message);
			}
		} catch (error) {
			console.error('Ошибка:', error);
		}
	});

	document.getElementById('deleteButton').addEventListener('click', async function() {
		if (confirm("Вы уверены, что хотите удалить свой аккаунт? Это действие нельзя отменить.")) {
			try {
				const response = await fetch("{{ route('user.delete') }}", {
					method: 'DELETE',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
					},
				});

				const result = await response.json();
				if (response.ok) {
					alert(result.message);
					window.location.href = result.redirect;
				} else {
					console.error('Ошибка:', result);
					alert('Ошибка удаления: ' + result.message);
				}
			} catch (error) {
				console.error('Ошибка:', error);
			}
		}
	});
</script>
@endsection