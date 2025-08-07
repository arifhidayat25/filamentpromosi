<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembinaResource\Pages;
use App\Filament\Resources\PembinaResource\RelationManagers;
use App\Models\Pembina;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\User;

use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PembinaResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Data Pembina';
    protected static ?string $slug = 'data-pembina';
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Hanya field untuk Nama
                Forms\Components\TextInput::make('name')
                    ->label('Nama Pembina')
                    ->required(),

                // Field email dan password bisa Anda tambahkan jika perlu
                // Jika tidak, biarkan seperti ini agar formnya simpel
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                    
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->visibleOn('create'),

                // Hidden field untuk role
                Forms\Components\Hidden::make('role')->default('pembina'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Hanya kolom untuk Nama
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pembina')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make()
                ->successRedirectUrl(self::getUrl('index')), // <-- Tambahkan ini
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make()
                    ->successRedirectUrl(self::getUrl('index')), // <-- Dan ini
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
            'index' => Pages\ListPembinas::route('/'),
            'create' => Pages\CreatePembina::route('/create'),
            'edit' => Pages\EditPembina::route('/{record}/edit'),
        ];
    }    
    public static function getEloquentQuery(): Builder
    {
        // Filter ini akan menampilkan user dengan role 'mahasiswa'
    return parent::getEloquentQuery()->whereHas('roles', fn (Builder $query) => $query->where('name', 'pembina'));
    }
}
