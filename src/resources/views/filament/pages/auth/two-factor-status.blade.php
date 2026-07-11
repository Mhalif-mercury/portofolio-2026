<div class="flex items-center justify-between">
    <div class="flex items-center gap-3">
        @if($enabled)
            <x-filament::icon icon="heroicon-o-shield-check" class="w-5 h-5 text-success-500" />
            <span class="text-success-600 dark:text-success-400 font-medium">Aktif</span>
        @else
            <x-filament::icon icon="heroicon-o-shield-exclamation" class="w-5 h-5 text-danger-500" />
            <span class="text-danger-600 dark:text-danger-400 font-medium">Tidak Aktif</span>
        @endif
    </div>
    <a href="{{ $setupUrl }}" class="text-primary-600 hover:text-primary-500 text-sm font-medium">
        {{ $enabled ? 'Kelola 2FA' : 'Aktifkan Sekarang' }}
    </a>
</div>
