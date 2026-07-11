<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Status Card --}}
        <x-filament::section>
            <x-slot name="heading">
                Two-Factor Authentication
            </x-slot>

            <x-slot name="description">
                @if(auth()->user()->hasTwoFactorEnabled())
                    Two-factor authentication <strong>aktif</strong>. Akun Anda lebih aman.
                @else
                    Two-factor authentication <strong>belum aktif</strong>. Aktifkan untuk meningkatkan keamanan akun.
                @endif
            </x-slot>

            @if(! auth()->user()->hasTwoFactorEnabled())
                {{-- Enable 2FA --}}
                @if(! $this->qrCodeSvg)
                    <x-filament::button
                        wire:click="enableAction"
                        color="primary"
                        icon="heroicon-o-shield-check"
                    >
                        Aktifkan Two-Factor Authentication
                    </x-filament::button>
                @else
                    {{-- QR Code and Verification --}}
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-medium mb-2">1. Scan Kode QR</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                                Scan kode QR berikut dengan aplikasi authenticator Anda
                                (Google Authenticator, Authy, Microsoft Authenticator, dll).
                            </p>
                            <div class="bg-white p-4 rounded-lg inline-block dark:bg-gray-800">
                                {!! $qrCodeSvg !!}
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium mb-2">Setup Key (Manual)</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                Jika tidak bisa scan QR, masukkan kode berikut secara manual:
                            </p>
                            <code class="bg-gray-100 dark:bg-gray-800 px-4 py-2 rounded-md text-lg font-mono select-all">
                                {{ $setupSecret }}
                            </code>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium mb-2">2. Verifikasi Kode</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                                Masukkan kode 6-digit yang muncul di aplikasi authenticator Anda:
                            </p>

                            <x-filament-panels::form wire:submit="confirmEnable">
                                {{ $this->form }}

                                <div class="mt-4 flex gap-3">
                                    <x-filament::button type="submit" color="success" icon="heroicon-o-check">
                                        Verifikasi & Aktifkan
                                    </x-filament::button>
                                    <x-filament::button
                                        wire:click="$set('qrCodeSvg', null); $set('setupSecret', null)"
                                        color="gray"
                                    >
                                        Batal
                                    </x-filament::button>
                                </div>
                            </x-filament-panels::form>
                        </div>
                    </div>
                @endif
            @else
                {{-- Disable 2FA --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-medium">Kode Pemulihan</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Simpan kode pemulihan berikut di tempat yang aman. Setiap kode hanya bisa digunakan <strong>satu kali</strong>.
                    </p>

                    <div class="grid grid-cols-2 gap-2 max-w-md">
                        @foreach(auth()->user()->getRecoveryCodes() as $code)
                            <code class="bg-gray-100 dark:bg-gray-800 px-3 py-2 rounded-md text-sm font-mono select-all">
                                {{ $code }}
                            </code>
                        @endforeach
                    </div>

                    <div class="pt-4 border-t dark:border-gray-700">
                        <x-filament::button
                            wire:click="disableAction"
                            color="danger"
                            icon="heroicon-o-shield-exclamation"
                        >
                            Nonaktifkan Two-Factor Authentication
                        </x-filament::button>
                    </div>
                </div>
            @endif
        </x-filament::section>
    </div>
</x-filament-panels::page>
