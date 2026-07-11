<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class TwoFactorSetup extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationLabel = 'Two-Factor Auth';

    protected static ?string $title = 'Two-Factor Authentication';

    protected static string $view = 'filament.pages.auth.two-factor-setup';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'two-factor-setup';

    public ?array $verificationData = [];

    public ?string $qrCodeSvg = null;

    public ?string $setupSecret = null;

    protected function getViewData(): array
    {
        return [];
    }

    public function mount(): void
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->hasTwoFactorEnabled()) {
            $this->qrCodeSvg = null;
            $this->setupSecret = null;
        }
    }

    public function enableAction(): void
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->hasTwoFactorEnabled()) {
            return;
        }

        $this->setupSecret = $user->enableTwoFactorAuth();
        $this->qrCodeSvg = $user->getTwoFactorQrCodeSvg();

        Notification::make()
            ->title(__('Scan kode QR dengan aplikasi authenticator Anda (Google Authenticator, Authy, dll).'))
            ->success()
            ->send();
    }

    public function confirmEnable(): void
    {
        $data = $this->form->getState();
        $code = str_replace(' ', '', $data['code'] ?? '');

        /** @var User $user */
        $user = Auth::user();

        if (! $user->verifyTwoFactorCode($code)) {
            Notification::make()
                ->title(__('Kode tidak valid. Pastikan Anda memasukkan kode yang benar.'))
                ->danger()
                ->send();

            return;
        }

        $user->confirmTwoFactorAuth();

        session(['2fa.confirmed' => true]);

        $recoveryCodes = $user->getRecoveryCodes();

        $this->qrCodeSvg = null;
        $this->setupSecret = null;

        $formattedCodes = implode('<br>', array_map(function ($code) {
            return '<span class="font-mono text-sm">' . e($code) . '</span>';
        }, $recoveryCodes));

        Notification::make()
            ->title(__('Two-Factor Authentication berhasil diaktifkan!'))
            ->body(__('Simpan kode pemulihan berikut di tempat yang aman:') . '<br><br>' . $formattedCodes)
            ->persistent()
            ->success()
            ->send();
    }

    public function disableAction(): void
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user->hasTwoFactorEnabled()) {
            return;
        }

        $user->disableTwoFactorAuth();

        session()->forget('2fa.confirmed');

        session()->regenerate();

        Notification::make()
            ->title(__('Two-Factor Authentication berhasil dinonaktifkan.'))
            ->success()
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
                            ->label(__('Kode Verifikasi'))
                            ->required()
                            ->autocomplete('one-time-code')
                            ->autofocus()
                            ->extraInputAttributes([
                                'inputmode' => 'numeric',
                                'pattern' => '[0-9]*',
                                'placeholder' => '000000',
                            ]),
                    ])
                    ->statePath('verificationData'),
            ),
        ];
    }

    protected function getActions(): array
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            return [];
        }

        if ($user->hasTwoFactorEnabled()) {
            return [];
        }

        return [];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
