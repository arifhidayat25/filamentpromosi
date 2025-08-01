<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Filament\Resources\MahasiswaResource\RelationManagers;
use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MahasiswaResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Data Mahasiswa';
    protected static ?string $slug = 'data-mahasiswa';
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Field untuk Nama
                Forms\Components\TextInput::make('name')
                    ->label('Nama Mahasiswa')
                    ->required(),

                // Field untuk NIM
                Forms\Components\TextInput::make('nim')
                    ->label('NIM')
                    ->required(),

                // Field untuk Prodi
                Forms\Components\TextInput::make('prodi')
                    ->label('Program Studi')
                    ->required(),
                
                // Field lainnya yang dibutuhkan (misal: email, password)
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->visibleOn('create'), // Hanya muncul saat membuat data baru

                // Hidden field untuk role
                Forms\Components\Hidden::make('role')->default('mahasiswa'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom untuk NIM, dibuat bisa dicari (searchable)
                Tables\Columns\TextColumn::make('nim')
                    ->searchable()
                    ->sortable(),

                // Kolom untuk Nama, dibuat bisa dicari juga
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Mahasiswa')
                    ->searchable(),

                // Kolom untuk Prodi
                Tables\Columns\TextColumn::make('prodi')
                    ->label('Program Studi'),
                
                // Kolom untuk Email
                Tables\Columns\TextColumn::make('email'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }    
    public static function getEloquentQuery(): Builder
    {
        // Filter ini akan menampilkan user dengan role 'mahasiswa'
    return parent::getEloquentQuery()->whereHas('roles', fn (Builder $query) => $query->where('name', 'mahasiswa'));
    }
}
