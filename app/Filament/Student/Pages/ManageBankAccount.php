<?php

// app/Filament/Student/Pages/ManageBankAccount.php
namespace App\Filament\Student\Pages;

use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Auth;
use App\Models\BankAccount;
use Filament\Notifications\Notification;

class ManageBankAccount extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static string $view = 'filament.student.pages.manage-bank-account';
    protected static ?string $navigationLabel = 'Rekening Bank';
    protected static ?string $title = 'Informasi Rekening Bank';

    public ?array $data = []; // Properti untuk menampung data form

    public function mount(): void
    {
        // Ambil data rekening milik user yg login, jika ada
        $bankAccount = Auth::user()->bankAccount;
        if ($bankAccount) {
            $this->form->fill($bankAccount->toArray());
        } else {
            $this->form->fill();
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('bank_name')
                    ->label('Nama Bank')
                    ->options([
                        'BCA' => 'BCA',
                        'BNI' => 'BNI',
                        'BRI' => 'BRI',
                        'Mandiri' => 'Mandiri',
                        'CIMB Niaga' => 'CIMB Niaga',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->required(),
                TextInput::make('account_holder_name')
                    ->label('Nama Pemilik Rekening')
                    ->required(),
                TextInput::make('account_number')
                    ->label('Nomor Rekening')
                    ->numeric()
                    ->required(),
            ])
            ->statePath('data'); // Arahkan state form ke properti $data
    }

    public function save(): void
    {
        $data = $this->form->getState();

        Auth::user()->bankAccount()->updateOrCreate(
            ['user_id' => Auth::id()], // Kondisi pencarian
            $data // Data untuk di-update atau di-create
        );

        Notification::make()
            ->title('Berhasil disimpan')
            ->success()
            ->send();
    }
}