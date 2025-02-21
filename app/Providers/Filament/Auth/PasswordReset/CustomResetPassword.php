<?php
namespace App\Providers\Filament\Auth\PasswordReset;

use Filament\Pages\Auth\PasswordReset\ResetPassword as BaseResetPassword;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\PasswordResetResponse;
use Filament\Notifications\Notification;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;

class CustomResetPassword extends BaseResetPassword
{
	public ?string $username = null;

	public function mount(?string $username = null, ?string $token = null): void
	{
		if (Filament::auth()->check()) {
			redirect()->intended(Filament::getUrl());
		}

		$this->token = $token ?? request()->query('token');

		$this->form->fill([
			'username' => $username ?? request()->query('username'),
		]);
	}

	public function resetPassword(): ?PasswordResetResponse
	{
		try {
			$this->rateLimit(2);
		} catch (TooManyRequestsException $exception) {
			$this->getRateLimitedNotification($exception)?->send();
			return null;
		}

		$data = $this->form->getState();

		$data['username'] = $this->username;
		$data['token'] = $this->token;

		$status = Password::broker(Filament::getAuthPasswordBroker())->reset(
			$data,
			function (CanResetPassword | Model | Authenticatable $user) use ($data) {
				$user->forceFill([
					'password' => Hash::make($data['password']),
					'remember_token' => Str::random(60),
				])->save();
				event(new PasswordReset($user));
			},
		);
		if ($status === Password::PASSWORD_RESET) {
			Notification::make()
				->title(__($status))
				->success()
				->send();
			return app(PasswordResetResponse::class);
		}

		Notification::make()
			->title(__($status))
			->danger()
			->send();
		return null;
	}

	public function form(Form $form): Form
	{
		return $form
			->schema([
				$this->getUsernameFormComponent(),
				$this->getPasswordFormComponent(),
				$this->getPasswordConfirmationFormComponent(),
			]);
	}

	protected function getUsernameFormComponent(): Component
	{
		return TextInput::make('username')
		->label('Username')
		->required()
		->autofocus();
	}
}
