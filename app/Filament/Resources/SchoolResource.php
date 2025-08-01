<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolResource\Pages;
use App\Models\School;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SchoolResource extends Resource
{
    protected static ?string $model = School::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Manajemen Sekolah';
    
    protected static ?string $navigationGroup = 'Manajemen';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Sekolah')
                ->required()
                ->maxLength(255),
            Forms\Components\Textarea::make('address')
                ->label('Alamat')
                ->required()
                ->maxLength(65535)
                ->columnSpanFull(),
            Forms\Components\TextInput::make('city')
                ->label('Kota')
                ->required()
                ->maxLength(100),
            Forms\Components\TextInput::make('contact_person')
                ->label('Nama Kontak')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('contact_phone')
                ->label('Nomor Telepon')
                ->required()
                ->tel()
                ->maxLength(25),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Nama Sekolah')
                ->searchable(),
            Tables\Columns\TextColumn::make('address')
                ->label('Alamat')
                ->limit(50),
            Tables\Columns\TextColumn::make('city')
                ->label('Kota')
                ->searchable(),
            Tables\Columns\TextColumn::make('contact_person')
                ->label('Nama Kontak'),
            Tables\Columns\TextColumn::make('contact_phone')
                ->label('Nomor Telepon'),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Dibuat Pada')
                ->dateTime('d M Y H:i')
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListSchools::route('/'),
            'create' => Pages\CreateSchool::route('/create'),
            'edit' => Pages\EditSchool::route('/{record}/edit'),
        ];
    }
    
}