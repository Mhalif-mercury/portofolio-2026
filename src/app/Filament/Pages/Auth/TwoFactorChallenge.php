<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\HasRoutes;
use Filament\Pages\SimplePage;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;

class TwoFactorChallenge extends SimplePage implements HasForms
{
    use HasRoutes;
    use InteractsWithForms;
    use WithRateLimiting;

    protected static string $view = 'filament.pages.auth.two-factor-challenge';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        if (! Auth::check()) {
            redirect()->intended(Filament::getUrl());
        }

        $user = Auth::user();

        if (! $user || ! $user->hasTwoFactorEnabled()) {
            redirect()->intended(Filament::getUrl());
        }

        if (session()->has('2fa.confirmed')) {
            redirect()->intended(Filament::getUrl());
        }

        $this->form->fill();
    }

    public function authenticate(): void
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('Terlalu banyak percobaan. Silakan coba lagi dalam :seconds detik.', [
                    'seconds' => $exception->secondsUntilAvailable,
                ]))
                ->danger()
                ->send();

            return;
        }

        $data = $this->form->getState();
        $user = Auth::user();

        if (! $user instanceof User) {
            Auth::logout();

            redirect()->to(Filament::getLoginUrl());

            return;
        }

        $code = str_replace(' ', '', $data['code'] ?? '');

        if ($user->verifyTwoFactorCode($code)) {
            session(['2fa.confirmed' => true]);
            session()->regenerate();

            redirect()->intended(Filament::getUrl());

            return;
        }

        if ($user->verifyRecoveryCode($code)) {
            session(['2fa.confirmed' => true]);
            session()->regenerate();

            redirect()->intended(Filament::getUrl());

            return;
        }

        Notification::make()
            ->title(__('Kode tidak valid.'))
            ->danger()
            ->send();
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
                        TextInput::make('code')
                            ->label(__('Kode Otentikasi'))
                            ->required()
                            ->autocomplete('one-time-code')
                            ->autofocus()
                            ->extraInputAttributes(['inputmode' => 'numeric', 'pattern' => '[0-9]*']),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('verify')
                ->label(__('Verifikasi'))
                ->submit('authenticate'),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __('Two-Factor Authentication');
    }

    public function getHeading(): string|Htmlable
    {
        return __('Verifikasi Kode 2FA');
    }

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }

    public static function getSlug(): string
    {
        return 'two-factor-challenge';
    }

    public static function registerNavigationItems(): void
    {
        //
    }
}
