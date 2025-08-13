<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArsipResource\Pages;
use App\Models\Proposal;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction; 

class ArsipResource extends Resource
{
    protected static ?string $model = Proposal::class;

    // --- Konfigurasi Menu ---
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationLabel = 'Arsip Proposal';
    protected static ?string $modelLabel = 'Arsip';
    protected static ?string $pluralModelLabel = 'Arsip Proposal';
    protected static ?string $navigationGroup = 'Laporan & Arsip';
    protected static ?int $navigationSort = 2;

    /**
     * Filter utama: Hanya tampilkan proposal yang statusnya sudah 'selesai'.
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('status', 'selesai');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                 FilamentExportHeaderAction::make('export')
                    ->label('Export Data')

            ])
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Mahasiswa')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('dosenPembina.name')
                    ->label('Nama Pembimbing')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('school.name')
                    ->label('Sekolah Tujuan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('certificate.certificate_number')
                    ->label('Nomor Sertifikat')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            
            ->actions([
                
                // Tombol untuk mengunduh sertifikat
                Tables\Actions\Action::make('download_sertifikat')
                    ->label('Unduh Sertifikat')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    // Tombol hanya muncul jika sertifikatnya ada
                    ->visible(fn (Proposal $record): bool => (bool) $record->certificate)
                    ->action(function (Proposal $record) {
                        $path = $record->certificate->file_path;
                        if (Storage::disk('public')->exists($path)) {
                            return Storage::disk('public')->download($path);
                        }
                    }),
            ])
            ->bulkActions([
                // Tidak ada aksi massal untuk arsip
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArsips::route('/'),
            'view' => Pages\ViewArsip::route('/{record}'),
        ];
    }    
}
