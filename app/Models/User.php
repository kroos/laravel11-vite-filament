<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


// db relation class to load
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Relations\HasOne;
// use Illuminate\Database\Eloquent\Relations\HasOneThrough;
// use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
// use Illuminate\Database\Eloquent\Relations\HasManyThrough;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
	/** @use HasFactory<\Database\Factories\UserFactory> */
	use HasFactory, Notifiable, SoftDeletes;

	// protected $connection = 'mysql';
	protected $table = 'users';
	protected $dates = ['deleted_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var list<string>
	 */
	// protected $fillable = [
	// 	'name',
	// 	'email',
	// 	'password',
	// ];

	protected $guarded = [];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var list<string>
	 */
	// protected $hidden = [
	// 	'password',
	// 	'remember_token',
	// ];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
		];
	}

	 /**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		// 'password' => 'hashed',		// this is because we are using clear text password
	];

	// public function getEmailForPasswordReset()
	// {
	// 	return $this->email;
	// }

	// // this is important for sending email
	// public function routeNotificationForMail($notification)
	// {
	// 	return $this->email;
	// }

	/////////////////////////////////////////////////////////////////////////////////////////////////////
	// db relation hasMany/hasOne
	public function hasmanylogin(): HasMany
	{
		return $this->hasMany(Login::class, 'user_id');
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////

}
