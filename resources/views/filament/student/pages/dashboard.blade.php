<x-filament-panels::page>

    {{-- Kita akan menggunakan komponen Section bawaan Filament agar terlihat rapi --}}
<x-filament::section>
        <x-slot name="heading">
            Selamat Datang di Portal Mahasiswa!
        </x-slot>

    <p class="mb-4">
            Berikut adalah panduan singkat untuk menggunakan portal ini:
        </p>

    <div class="space-y-4">
            {{-- Langkah 1 --}}
        <div class="p-4 bg-gray-100 rounded-lg dark:bg-gray-800">
                <h3 class="font-semibold text-lg">1. Buat Pengajuan Promosi</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Masuk ke menu "Pengajuan" di navigasi samping untuk membuat proposal promosi baru ke sekolah yang Anda tuju.
                </p>
            </div>

        {{-- Langkah 2 --}}
        <div class="p-4 bg-gray-100 rounded-lg dark:bg-gray-800">
                <h3 class="font-semibold text-lg">2. Lacak Status Anda</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Anda dapat melacak status pengajuan, laporan, dan pembayaran fee Anda melalui menu di navigasi.
                </p>
            </div>

        {{-- Langkah 3 --}}
        <div class="p-4 bg-gray-100 rounded-lg dark:bg-gray-800">
                <h3 class="font-semibold text-lg">3. Cetak Sertifikat</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Setelah semua proses selesai dan pembayaran fee telah dilakukan, Anda dapat mengunduh sertifikat partisipasi dari halaman "Pengajuan".
                </p>
            </div>
        </div>
    </x-filament::section>

</x-filament-panels::page>