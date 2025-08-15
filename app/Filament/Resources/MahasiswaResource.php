<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Filament\Resources\MahasiswaResource\RelationManagers;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Cache; // <-- Pastikan ini sudah di-import

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

                // --- PERUBAHAN UTAMA ADA DI SINI ---
                // Field untuk Prodi dengan Caching
                Forms\Components\Select::make('program_studi_id')
                    ->label('Program Studi')
                    ->options(function () {
                        // Ambil data dari cache Redis. Jika tidak ada, jalankan query
                        // lalu simpan hasilnya di cache selama 24 jam (1 hari).
                        return Cache::remember('select_options:program_studi', now()->addDay(), function () {
                            return ProgramStudi::all()->pluck('name', 'id');
                        });
                    })
                    ->searchable()
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
                Tables\Columns\TextColumn::make('programStudi.name')
                    ->label('Program Studi')
                    ->sortable()
                    ->searchable(),
                
                // Kolom untuk Email
                Tables\Columns\TextColumn::make('email'),
            ])
            ->filters([
                //
            ])
            ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make()
                ->successRedirectUrl(self::getUrl('index')),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make()
                    ->successRedirectUrl(self::getUrl('index')),
            ]),
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