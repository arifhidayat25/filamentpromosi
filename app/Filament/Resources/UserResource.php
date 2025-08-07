<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use App\Models\ProgramStudi; // <-- Tambahkan ini
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Manajemen Pengguna';
    protected static ?string $modelLabel = 'Pengguna';
    protected static ?string $navigationGroup = 'Manajemen Pengguna';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('Nama Lengkap')->required()->maxLength(255),
                Forms\Components\TextInput::make('email')->email()->required()->maxLength(255),
                Forms\Components\TextInput::make('nim')->maxLength(255),
                
                // --- PERBAIKAN PADA FORM ---
                // Menggunakan relationship dengan titleAttribute 'name'
                Select::make('program_studi_id')
                    ->relationship('programStudi', 'name') // <-- 'nama' diubah menjadi 'name'
                    ->searchable()
                    ->preload()
                    ->label('Program Studi'),
                    
                Forms\Components\TextInput::make('no_telepon')->tel()->maxLength(255),
                
                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
                    
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama Pengguna')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('nim')->searchable(),
                
                // --- PERBAIKAN PADA TABEL ---
                // Mengambil nama prodi melalui relasi 'programStudi.name'
                Tables\Columns\TextColumn::make('programStudi.name') // <-- 'nama' diubah menjadi 'name'
                    ->label('Program Studi')
                    ->sortable()
                    ->badge(), // Tampilan lebih bagus

                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}