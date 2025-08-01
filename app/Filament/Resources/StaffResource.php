<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaffResource\Pages;
use App\Filament\Resources\StaffResource\RelationManagers;
use App\Models\Staff;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StaffResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Data Staff';
    protected static ?string $slug = 'data-staff';
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Hanya field untuk Nama
                Forms\Components\TextInput::make('name')
                    ->label('Nama Staff')
                    ->required(),

                // Email dan password tetap dibutuhkan untuk membuat user
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),

                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->visibleOn('create'),

                // Hidden field untuk role
                Forms\Components\Hidden::make('role')->default('staff'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Hanya kolom untuk Nama
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Staff')
                    ->searchable(),
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
            'index' => Pages\ListStaff::route('/'),
            'create' => Pages\CreateStaff::route('/create'),
            'edit' => Pages\EditStaff::route('/{record}/edit'),
        ];
    }    
    public static function getEloquentQuery(): Builder
    {
        // Filter ini akan menampilkan user dengan role 'mahasiswa'
    return parent::getEloquentQuery()->whereHas('roles', fn (Builder $query) => $query->where('name', 'staff'));
    }
}
