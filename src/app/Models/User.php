<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'avatar_url',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

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
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    public function getFilamentAvatarUrl(): ?string
    {
        if ($this->avatar_url) {
            return asset('storage/' . $this->avatar_url);
        } else {
            $hash = md5(strtolower(trim($this->email)));

            return 'https://www.gravatar.com/avatar/' . $hash . '?d=mp&r=g&s=250';
        }
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('super_admin');
    }

    /*
    |--------------------------------------------------------------------------
    | Two-Factor Authentication
    |--------------------------------------------------------------------------
    */

    public function hasTwoFactorEnabled(): bool
    {
        return $this->two_factor_secret !== null
            && $this->two_factor_confirmed_at !== null;
    }

    public function enableTwoFactorAuth(): string
    {
        $google2fa = app('pragmarx.google2fa');
        $secret = $google2fa->generateSecretKey();

        $this->two_factor_secret = encrypt($secret);
        $this->two_factor_recovery_codes = encrypt(json_encode($this->generateRecoveryCodes()));
        $this->save();

        return $secret;
    }

    public function disableTwoFactorAuth(): void
    {
        $this->two_factor_secret = null;
        $this->two_factor_recovery_codes = null;
        $this->two_factor_confirmed_at = null;
        $this->save();
    }

    public function confirmTwoFactorAuth(): void
    {
        $this->two_factor_confirmed_at = now();
        $this->save();
    }

    public function getTwoFactorQrCodeSvg(): string
    {
        $google2fa = app('pragmarx.google2fa');
        $secret = $this->getDecryptedSecret();

        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $this->email,
            $secret
        );

        $renderer = new ImageRenderer(
            new RendererStyle(256, 0),
            new SvgImageBackEnd,
        );

        $writer = new Writer($renderer);

        return $writer->writeString($qrCodeUrl);
    }

    public function verifyTwoFactorCode(string $code): bool
    {
        $google2fa = app('pragmarx.google2fa');
        $secret = $this->getDecryptedSecret();

        if (empty($secret)) {
            return false;
        }

        return $google2fa->verifyKey($secret, $code);
    }

    public function verifyRecoveryCode(string $code): bool
    {
        $codes = $this->getRecoveryCodes();

        $position = array_search($code, $codes, true);

        if ($position === false) {
            return false;
        }

        unset($codes[$position]);

        $this->two_factor_recovery_codes = encrypt(json_encode(array_values($codes)));
        $this->save();

        return true;
    }

    public function getRecoveryCodes(): array
    {
        if (empty($this->two_factor_recovery_codes)) {
            return [];
        }

        /** @var string $decrypted */
        $decrypted = decrypt($this->two_factor_recovery_codes);

        return json_decode($decrypted, true) ?? [];
    }

    public function getDecryptedSecret(): string
    {
        if (empty($this->two_factor_secret)) {
            return '';
        }

        return decrypt($this->two_factor_secret);
    }

    public static function getTwoFactorSetupView(): string
    {
        return 'filament.pages.auth.two-factor-setup';
    }

    protected function generateRecoveryCodes(): array
    {
        $codes = [];

        for ($i = 0; $i < 8; $i++) {
            $codes[] = bin2hex(random_bytes(8));
        }

        return $codes;
    }
}
