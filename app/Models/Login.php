<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;

// filament
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;

// database relationship
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Relations\HasOne;
// use Illuminate\Database\Eloquent\Relations\HasOneThrough;
// use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
// use Illuminate\Database\Eloquent\Relations\HasMany;
// use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// custom email reset password in
// use App\Notifications\ResetPassword;

// class Login extends Authenticatable implements MustVerifyEmail
// class Login extends Authenticatable implements MustVerifyEmail, FilamentUser, HasName
class Login extends Authenticatable implements MustVerifyEmail, FilamentUser, HasName, CanResetPassword
{
	// protected $connection = 'mysql';
	// protected $table = 'logins';
	// protected $primaryKey = 'id';

	// use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
	use HasFactory, Notifiable, SoftDeletes;

	protected $guarded = [];
	// protected $fillable = [
	// 	'username',
	// 	'password',
	// 	'status',
	// ];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
	// 	'email_verified_at' => 'datetime',
		'password' => 'hashed',		// this is because we are using clear text password
	];

	/////////////////////////////////////////////////////////////////////////////////////////////////////
	// db relation belongsTo
	public function belongstouser(): BelongsTo
	{
		return $this->belongsTo(\App\Models\User::class, 'user_id');
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////
	// no need this anymore cause we choose "logins" for auth, not "users" table anymore. config/auth.php
	// public function getAuthIdentifierName()
	// {
	// 	return 'username';
	// }

	// for password
	// public function getAuthPassword()
	// {
	// 	return $this->password;
	// }

	/////////////////////////////////////////////////////////////////////////////////////////////////////
	// custom email reset password in
	// public function sendPasswordResetNotification($token)
	// {
	// 		$this->notify(new ResetPassword($token));
	// }

	/////////////////////////////////////////////////////////////////////////////////////////////////////
	// filament
	// https://filamentphp.com/docs/3.x/panels/users#configuring-the-users-name-attribute
	public function canAccessPanel(Panel $panel): bool
	{
		return true && $this->hasVerifiedEmail(); // Or add your custom logic here
	}

	public function getFilamentName(): string
	{
		return $this->belongstouser?->name;
	}

	public function getFilamentEmail(): string
	{
		return $this->belongstouser?->email;
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	public function getEmailForPasswordReset()
	{
		return $this->belongstouser?->email;
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////
	// for email Notifiable
	public function routeNotificationForMail($notification)
	{
		return [$this->belongstouser?->email => $this->belongstouser?->name];
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////
	// used for mustVerifyEmail
	public function hasVerifiedEmail()
	{
		return ! is_null($this->belongstouser?->email_verified_at);
	}

	public function markEmailAsVerified()
	{
		return $this->belongstouser?->forceFill([
			'email_verified_at' => $this->freshTimestamp(),
			])->save();
	}

		// Method to send email verification
		//	public function sendEmailVerificationNotification()
		//	{
		//		$this->notify(new EmailVerificationNotification());
		//	}

		/////////////////////////////////////////////////////////////////////////////////////////////////////
		// all acl will be done here

		/////////////////////////////////////////////////////////////////////////////////////////////////////
}
