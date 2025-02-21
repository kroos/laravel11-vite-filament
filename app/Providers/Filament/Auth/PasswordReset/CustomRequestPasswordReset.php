<?php
namespace App\Providers\Filament\Auth\PasswordReset;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Exception;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\Password;

use Filament\Notifications\Auth\ResetPassword as ResetPasswordNotification;
use Filament\Pages\Auth\PasswordReset\RequestPasswordReset as BaseRequestPasswordReset;

class CustomRequestPasswordReset extends BaseRequestPasswordReset
{
	protected function getForms(): array
	{
		return [
			'form' => $this->form(
				$this->makeForm()
				->schema([
					$this->getUsernameFormComponent(),
				])
				->statePath('data'),
			),
		];
	}

	protected function getUsernameFormComponent(): Component
	{
		return TextInput::make('username')
		->label('Username')
		->required()
		->autocomplete()
		->autofocus();
	}

	public function request(): void // Must be void, so we don't return anything
	{
		try {
			$this->rateLimit(2);
		} catch (TooManyRequestsException $exception) {
			$this->getRateLimitedNotification($exception)?->send();
			return;
		}

		$data = $this->form->getState();

		$status = Password::broker(Filament::getAuthPasswordBroker())->sendResetLink(
			$data,
			function (CanResetPassword $user, string $token): void {
				$notification = app(ResetPasswordNotification::class, ['token' => $token]);
				$notification->url = Filament::getResetPasswordUrl($token, $user);
				$user->notify($notification);
			},
		);

		if ($status !== Password::RESET_LINK_SENT) {
			Notification::make()
			->title(__($status))
			->danger()
			->send();
			return;
		}

		Notification::make()
		->title(__($status))
		->success()
		->send();

		$this->form->fill();
	}
}
