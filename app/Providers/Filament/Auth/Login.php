<?php
namespace App\Providers\Filament\Auth;

use Filament\Forms\Form;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login as BaseAuth;
use Illuminate\Validation\ValidationException;

class Login extends BaseAuth
{
	public function form(Form $form): Form
	{
		return $form
		->schema([
			// $this->getEmailFormComponent(),
			$this->getLoginFormComponent(),
			$this->getPasswordFormComponent(),
			$this->getRememberFormComponent(),
		])
		->statePath('data');
	}

	protected function getLoginFormComponent(): Component
	{
		return TextInput::make('username')
		->label('Username')
		->required()
		->autocomplete()
		->autofocus()
		->extraInputAttributes(['tabindex' => 1]);
	}

	protected function getCredentialsFromFormData(array $data): array
	{
		$login_type = filter_var($data['username'], FILTER_VALIDATE_EMAIL ) ? 'email' : 'username';
		return [
			$login_type => $data['username'],
			'password'  => $data['password'],
		];
	}

	protected function throwFailureValidationException(): never
	{
		throw ValidationException::withMessages([
			'data.username' => __('filament-panels::pages/auth/login.messages.failed'),
		]);
	}



}
