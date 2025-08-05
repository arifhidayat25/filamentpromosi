<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankAccountResource\Pages;
use App\Filament\Resources\BankAccountResource\RelationManagers;
use App\Models\BankAccount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankAccountResource extends Resource
{
    protected static ?string $model = BankAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('user.name') // Ambil nama dari relasi user
                ->label('Nama Mahasiswa')
                ->searchable()
                ->sortable(),
            TextColumn::make('bank_name')
                ->label('Nama Bank')
                ->searchable(),
            TextColumn::make('account_holder_name')
                ->label('Pemilik Rekening')
                ->searchable(),
            TextColumn::make('account_number')
                ->label('Nomor Rekening')
                ->searchable(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\ViewAction::make(), // Hanya ada action view
        ])
        ->bulkActions([
            // Kosongkan atau hapus jika tidak perlu bulk delete
        ]);
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBankAccounts::route('/'),
            // 'create' => Pages\CreateBankAccount::route('/create'),
            // 'edit' => Pages\EditBankAccount::route('/{record}/edit'),
        ];
    }
}
