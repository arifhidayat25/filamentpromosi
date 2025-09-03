<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    /**
     * Metode ini akan berjalan SETELAH record user berhasil dibuat.
     * Kita akan mengatur role dan prodi di sini.
     */
    protected function afterCreate(): void
    {
        $currentUser = Auth::user();
        $newUser = $this->record; // Mengambil user yang baru saja dibuat

        // Jika yang membuat adalah seorang PEMBINA...
        if ($currentUser->hasRole('pembina')) {
            // ...langsung tetapkan role 'mahasiswa'.
            $mahasiswaRole = Role::where('name', 'mahasiswa')->first();
            if ($mahasiswaRole) {
                $newUser->assignRole($mahasiswaRole);
            }

            // ...dan langsung atur program studinya, lalu simpan.
            $newUser->program_studi_id = $currentUser->program_studi_id;
            $newUser->save();
        }
    }
    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
}