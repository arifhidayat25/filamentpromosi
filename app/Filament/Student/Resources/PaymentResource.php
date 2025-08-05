<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\PaymentResource\Pages;
use App\Models\Payment;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth; // <-- 1. Tambahkan ini

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Pembayaran';
    protected static ?string $modelLabel = 'Pembayaran';
    protected static ?string $pluralModelLabel = 'Pembayaran';
    protected static ?string $navigationGroup = 'Keuangan';
    protected static ?string $slug = 'pembayaran';

    /**
     * Mahasiswa tidak perlu membuat/mengedit data pembayaran secara langsung.
     * Jadi, kita bisa kosongkan method form() ini.
     */
    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    /**
     * --- PERBAIKAN UTAMA ADA DI SINI ---
     * Fungsi ini akan memfilter semua data Payment dan hanya mengambil
     * data yang proposalnya milik user yang sedang login.
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('proposal', function (Builder $query) {
                $query->where('user_id', Auth::id());
            });
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom 'Penerima' tidak perlu lagi karena sudah pasti milik user sendiri
                // Tables\Columns\TextColumn::make('proposal.user.name')->label('Penerima'), 
                Tables\Columns\TextColumn::make('proposal.school.name')->label('Sekolah Promosi')->searchable(),
                Tables\Columns\TextColumn::make('amount')->label('Jumlah Fee')->money('IDR')->sortable(),
                Tables\Columns\BadgeColumn::make('status')->colors(['warning' => 'menunggu_pembayaran', 'success' => 'dibayar']),
                Tables\Columns\TextColumn::make('payment_date')->label('Tanggal Dibayar')->date('d M Y')->sortable(),
            ])
            // --- PERBAIKAN KEDUA ---
            // Mahasiswa tidak perlu aksi Edit, Delete, atau Bayar.
            // Cukup melihat saja.
            ->actions([]) 
            ->bulkActions([]);
    }
    
    public static function getPages(): array
    {
        // Mahasiswa hanya perlu melihat daftar (index), tidak perlu membuat/mengedit.
        return [
            'index' => Pages\ListPayments::route('/'),
        ];
    }
}