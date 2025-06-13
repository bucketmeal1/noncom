<?php

namespace App\Filament\Pages\Auth;

use Filament\Facades\Filament;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use App\Http\Responses;

class  Login extends \Filament\Pages\Auth\Login
{

    


    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->form->fill();
    }


    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/login.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(array_key_exists('body', __('filament-panels::pages/auth/login.notifications.throttled') ?: []) ? __('filament-panels::pages/auth/login.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]) : null)
                ->danger()
                ->send();

            return null;
        }

        $data = $this->form->getState();

        if (! Filament::auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            throw ValidationException::withMessages([
                'data.email' => __('filament-panels::pages/auth/login.messages.failed'),
            ]);
        }

        session()->regenerate();

    
        return app(LoginResponse::class);
    }

    // protected function getForms(): array
    // {
    //     return [
    //         'form' => $this->form(
    //             $this->makeForm()
    //                 ->schema([
    //                     $this->getEmailFormComponent(),
    //                     $this->getPasswordFormComponent(),
    //                     $this->getRememberFormComponent(),
    //                 ])
    //                 ->statePath('data'),
    //         ),
    //     ];
    // }

    // protected function getEmailFormComponent(): Component
    // {
    //     return TextInput::make('email')
    //         ->label(__('filament-panels::pages/auth/login.form.email.label'))
    //         ->email()
    //         ->required()
    //         ->autocomplete()
    //         ->autofocus()
    //         ->extraInputAttributes(['tabindex' => 1]);
    // }

    // protected function getPasswordFormComponent(): Component
    // {
    //     return TextInput::make('password')
    //         ->label(__('filament-panels::pages/auth/login.form.password.label'))
    //         ->hint(filament()->hasPasswordReset() ? new HtmlString(Blade::render('<x-filament::link :href="filament()->getRequestPasswordResetUrl()"> {{ __(\'filament-panels::pages/auth/login.actions.request_password_reset.label\') }}</x-filament::link>')) : null)
    //         ->password()
    //         ->autocomplete('current-password')
    //         ->required()
    //         ->extraInputAttributes(['tabindex' => 2]);
    // }

    // protected function getRememberFormComponent(): Component
    // {
    //     return Checkbox::make('remember')
    //         ->label(__('filament-panels::pages/auth/login.form.remember.label'));
    // }

    // public function registerAction(): Action
    // {
    //     return Action::make('register')
    //         ->link()
    //         ->label(__('filament-panels::pages/auth/login.actions.register.label'))
    //         ->url(filament()->getRegistrationUrl());
    // }

    // public function getTitle(): string | Htmlable
    // {
    //     return __('filament-panels::pages/auth/login.title');
    // }

    // public function getHeading(): string | Htmlable
    // {
    //     return __('filament-panels::pages/auth/login.heading');
    // }

    // /**
    //  * @return array<Action | ActionGroup>
    //  */
    // protected function getFormActions(): array
    // {
    //     return [
    //         $this->getAuthenticateFormAction(),
    //     ];
    // }

    // protected function getAuthenticateFormAction(): Action
    // {
    //     return Action::make('authenticate')
    //         ->label(__('filament-panels::pages/auth/login.form.actions.authenticate.label'))
    //         ->submit('authenticate');
    // }

    // protected function hasFullWidthFormActions(): bool
    // {
    //     return true;
    // }

    // /**
    //  * @param  array<string, mixed>  $data
    //  * @return array<string, mixed>
    //  */
    // protected function getCredentialsFromFormData(array $data): array
    // {
    //     return [
    //         'email' => $data['email'],
    //         'password' => $data['password'],
    //     ];
    // }

}

