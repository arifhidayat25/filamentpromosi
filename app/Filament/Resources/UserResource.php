<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Manajemen Pengguna';

    public static function getNavigationLabel(): string
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            return 'Manajemen Pengguna';
        }
        if ($user->hasRole('staff')) {
            return 'Data Pengguna';
        }
        return 'Data Mahasiswa';
    }

    public static function getModelLabel(): string
    {
        return Auth::user()->hasRole(['admin', 'staff']) ? 'Pengguna' : 'Mahasiswa';
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $query = parent::getEloquentQuery();

        if ($user->hasRole('admin')) {
            return $query;
        }

        if ($user->hasRole('staff')) {
            return $query->whereHas('roles', function ($subQuery) {
                $subQuery->whereIn('name', ['mahasiswa', 'pembina']);
            });
        }

        if ($user->hasRole('pembina')) {
            return $query->where('program_studi_id', $user->program_studi_id)
                ->whereHas('roles', function ($subQuery) {
                    $subQuery->where('name', 'mahasiswa');
                });
        }

        return $query->whereNull('id');
    }

    public static function form(Form $form): Form
    {
        $currentUser = Auth::user();

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nim')
                    ->label('NIM')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('no_telepon')
                    ->label('No. Telepon')
                    ->tel()
                    ->maxLength(255),
                
                Select::make('program_studi_id')
                    ->relationship('programStudi', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Program Studi')
                    // --- PERBAIKAN DI SINI ---
                    ->visible(fn () => $currentUser->hasRole(['admin', 'staff'])),

                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->options(function () use ($currentUser) {
                        if ($currentUser->hasRole('admin')) {
                            return Role::pluck('name', 'id');
                        }
                        if ($currentUser->hasRole('staff')) {
                            return Role::whereIn('name', ['mahasiswa', 'pembina'])->pluck('name', 'id');
                        }
                        return [];
                    })
                    // --- PERBAIKAN DI SINI ---
                    ->visible(fn () => $currentUser->hasRole(['admin', 'staff'])),

                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        $currentUser = Auth::user();

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('nim')->label('NIM')->searchable(),
                Tables\Columns\TextColumn::make('programStudi.name')->label('Program Studi')->sortable(),
                
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    // --- PERBAIKAN DI SINI ---
                    ->visible(fn() => $currentUser->hasRole('admin')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('roles')
                    ->relationship('roles', 'name')
                    ->label('Filter berdasarkan Role')
                    // --- PERBAIKAN DI SINI ---
                    ->visible(fn () => $currentUser->hasRole('admin')),
            ])
            ->actions([
                // --- PERBAIKAN DI SINI ---
                Tables\Actions\EditAction::make()->visible(fn () => $currentUser->hasRole('admin')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ])
                // --- PERBAIKAN DI SINI ---
                ->visible(fn () => $currentUser->hasRole('admin')),
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