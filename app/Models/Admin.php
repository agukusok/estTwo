<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use CrudTrait, HasFactory;

    protected $table = 'admins';
    protected $fillable = ['email', 'name', 'password'];
    protected $hidden = ['password', 'remember_token'];
}
