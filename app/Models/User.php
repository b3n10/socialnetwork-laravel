<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'email',
		'username',
		'password',
		'first_name',
		'last_name',
		'location'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	public function getName() {
		if ($this->first_name && $this->last_name) return "{$this->first_name} {$this->last_name}";
		if ($this->first_name) return "{$this->first_name}";
		if ($this->username) return "{$this->username}";
	}

	public function getAvatarUrl() {
		return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=retro&s=40";
	}
}
