<x-filament-panels::page>

    {{-- Form untuk Membuat Token Baru --}}
    <x-filament::section>
        <x-slot name="heading">
            Buat API Token Baru
        </x-slot>
        <form wire:submit.prevent="createToken" class="space-y-4">
            <div>
                <x-filament::input.wrapper>
                    <x-filament::input
                        type="text"
                        wire:model.defer="tokenName"
                        placeholder="Nama Token (misal: Aplikasi Android)"
                    />
                </x-filament::input.wrapper>
                @error('tokenName') <span class="text-sm text-danger-500">{{ $message }}</span> @enderror
            </div>
            <x-filament::button type="submit">
                Buat Token
            </x-filament::button>
        </form>
    </x-filament::section>

    {{-- 
        --- PERUBAHAN UTAMA ADA DI SINI ---
        Blok ini sekarang dikontrol oleh Alpine.js.
        x-data: Mendefinisikan state awal (token kosong, kotak tersembunyi).
        @token-created.window: Mendengarkan event dari server. Jika event datang,
                                isi variabel `newToken` dan tampilkan kotak `showTokenBox`.
    --}}
    <div 
        x-data="{ newToken: '', showTokenBox: false }"
        @token-created.window="
            newToken = $event.detail.token;
            showTokenBox = true;
            $nextTick(() => $refs.tokenInput.select());
        "
        class="mt-6"
    >
        <div x-show="showTokenBox" style="display: none;" class="p-4 bg-success-50 rounded-lg dark:bg-success-500/10">
            <h3 class="font-semibold text-success-800 dark:text-success-400">Token Baru Berhasil Dibuat!</h3>
            <p class="text-sm text-success-700 dark:text-success-300 mt-1">
                Salin dan simpan token ini di tempat aman. <strong>Anda tidak akan bisa melihatnya lagi.</strong>
            </p>
            <div class="mt-2">
                <input x-ref="tokenInput" type="text" :value="newToken" readonly
                       class="w-full p-2 bg-gray-900 text-white rounded font-mono text-sm border-none break-all cursor-pointer"
                       onclick="this.select(); document.execCommand('copy');"
                >
            </div>
        </div>
    </div>


    {{-- Daftar Token yang Sudah Ada --}}
    <div class="mt-6">
        <x-filament::section>
            <x-slot name="heading">
                Kelola API Tokens
            </x-slot>
            <ul class="divide-y divide-gray-200 dark:divide-white/10">
                @forelse ($tokens as $token)
                    <li class="py-3 flex items-center justify-between">
                        <div>
                            <p class="font-semibold">{{ $token->name }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Last used: {{ $token->last_used_at ? $token->last_used_at->diffForHumans() : 'Never' }}
                            </p>
                        </div>
                        <x-filament::button
                            color="danger"
                            wire:click="deleteToken({{ $token->id }})"
                            wire:confirm="Apakah Anda yakin ingin menghapus token '{{ $token->name }}'? Aksi ini tidak bisa dibatalkan.">
                            Hapus
                        </x-filament::button>
                    </li>
                @empty
                    <li class="py-3 text-center text-gray-500 dark:text-gray-400">
                        Anda belum memiliki API Token.
                    </li>
                @endforelse
            </ul>
        </x-filament::section>
    </div>

</x-filament-panels::page>