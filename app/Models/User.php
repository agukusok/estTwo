<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use CrudTrait, HasApiTokens;
	use HasFactory, Notifiable;

	protected $fillable = [
		'email',
		'username',
		'name',
		'is_blocked',
	];
}
