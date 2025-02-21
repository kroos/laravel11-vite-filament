<?php
namespace App\Providers\Filament\Auth;
// namespace Filament\Pages\Auth;

use Filament\Pages\Auth\Register as BaseRegister;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Actions\Action;
use Filament\Events\Auth\Registered;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Register extends BaseRegister
{
	public function register(): ?RegistrationResponse
	{
		try {
			$this->rateLimit(2);
		} catch (TooManyRequestsException $exception) {
			$this->getRateLimitedNotification($exception)?->send();
			return null;
		}

		$user = $this->wrapInDatabaseTransaction(function () {
			$this->callHook('beforeValidate');
			$data = $this->form->getState();
			$this->callHook('afterValidate');
			$data = $this->mutateFormDataBeforeRegister($data);
			$this->callHook('beforeRegister');
			$user = $this->handleRegistration($data);
			$this->form->model($user)->saveRelationships();
			$this->callHook('afterRegister');
			return $user;
		});

		event(new Registered($user));
		$this->sendEmailVerificationNotification($user);
		Filament::auth()->login($user);
		session()->regenerate();
		return app(RegistrationResponse::class);
	}


	public function form(Form $form): Form
	{
		return $form;
	}

	protected function getForms(): array
	{
		return [
			'form' => $this->form(
				$this->makeForm()
				->schema([
					$this->getNameFormComponent(),
					$this->getEmailFormComponent(),
					$this->getUsernameFormComponent(),
					$this->getPasswordFormComponent(),
					$this->getPasswordConfirmationFormComponent(),
					])
					->statePath('data'),
				),
			];
		}

		protected function getNameFormComponent(): Component
		{
			return TextInput::make('name')
			->label(__('filament-panels::pages/auth/register.form.name.label'))
			->required()
			->maxLength(255)
			->autofocus();
		}

		protected function getUsernameFormComponent(): Component
		{
			return TextInput::make('username')
			->label('Username')
			->required()
			->unique('logins', 'username')
			->maxLength(16)
			->autofocus();
		}

		protected function getEmailFormComponent(): Component
		{
			return TextInput::make('email')
			->label(__('filament-panels::pages/auth/register.form.email.label'))
			->email()
			->required()
			->maxLength(255)
			->unique($this->getUserModel());
		}

		protected function getPasswordFormComponent(): Component
		{
			return TextInput::make('password')
			->label(__('filament-panels::pages/auth/register.form.password.label'))
			->password()
			->revealable(filament()->arePasswordsRevealable())
			->required()
			->rule(Password::default())
			->dehydrateStateUsing(fn ($state) => Hash::make($state))
			->same('passwordConfirmation')
			->validationAttribute(__('filament-panels::pages/auth/register.form.password.validation_attribute'));
		}

		protected function getPasswordConfirmationFormComponent(): Component
		{
			return TextInput::make('passwordConfirmation')
			->label(__('filament-panels::pages/auth/register.form.password_confirmation.label'))
			->password()
			->revealable(filament()->arePasswordsRevealable())
			->required()
			->dehydrated(false);
		}

		public function loginAction(): Action
		{
			return Action::make('login')
			->link()
			->label(__('filament-panels::pages/auth/register.actions.login.label'))
			->url(filament()->getLoginUrl());
		}

		protected function getUserModel(): string
		{
			if (isset($this->userModel)) {
				return $this->userModel;
			}

			/** @var SessionGuard $authGuard */
			$authGuard = Filament::auth();

			/** @var EloquentUserProvider $provider */
			$provider = $authGuard->getProvider();

			return $this->userModel = $provider->getModel();
		}

		protected function getFormActions(): array
		{
			return [
				$this->getRegisterFormAction(),
			];
		}

		public function getRegisterFormAction(): Action
		{
			return Action::make('register')
			->label(__('filament-panels::pages/auth/register.form.actions.register.label'))
			->submit('register');
		}

		protected function mutateFormDataBeforeRegister(array $data): array
		{
			$user = \App\Models\User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'email_verified_at' => now(),
			]);

			$data['user_id'] = $user->id; // Assign the created user to the login entry
			unset($data['name'], $data['email']); // Remove 'name' and 'email' from logins table insertion
			return $data;
		}
	}
