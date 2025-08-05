<?php

namespace App\Filament\Auth;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select; // <-- 1. Tambahkan ini
use Filament\Pages\Auth\Register as BaseRegister;
use App\Models\User;
use App\Models\ProgramStudi; // <-- 2. Tambahkan ini

class StudentRegistration extends BaseRegister
{
    /**
     * Metode ini mendefinisikan field apa saja yang akan muncul di form registrasi.
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(), // Field Nama (bawaan)
                
                // --- FIELD TAMBAHAN ANDA ---
                TextInput::make('nim')
                    ->label('NIM')
                    ->required()
                    ->unique(table: User::class, column: 'nim')
                    ->maxLength(50),
                    
                // --- INI BAGIAN YANG DIUBAH ---
                Select::make('program_studi_id') // Menggunakan nama kolom dari database
                    ->label('Program Studi')
                    ->options(ProgramStudi::all()->pluck('name', 'id'))
                    ->searchable() // Agar bisa dicari
                    ->required(),

                TextInput::make('no_telepon')
                    ->label('No. Telepon')
                    ->tel()
                    ->required()
                    ->maxLength(20),
                // --- AKHIR FIELD TAMBAHAN ---

                $this->getEmailFormComponent(), // Field Email (bawaan)
                $this->getPasswordFormComponent(), // Field Password (bawaan)
                $this->getPasswordConfirmationFormComponent(), // Field Konfirmasi Password (bawaan)
            ])
            ->statePath('data');
    }

    /**
     * Metode ini di-override untuk menambahkan logika penetapan role
     * setelah user berhasil dibuat.
     */
    protected function handleRegistration(array $data): User
    {
        // Pertama, buat user seperti biasa menggunakan data dari form
        $user = static::getUserModel()::create($data);

        // Setelah user dibuat, tetapkan rolenya menjadi 'mahasiswa'
        $user->assignRole('mahasiswa');

        // Kirim notifikasi email verifikasi (jika diaktifkan)
        $this->sendEmailVerificationNotification($user);

        return $user;
    }
}