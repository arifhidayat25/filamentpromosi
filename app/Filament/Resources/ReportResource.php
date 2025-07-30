<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Models\Report;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationLabel = 'Manajemen Laporan';
    protected static ?string $modelLabel = 'Laporan';
    protected static ?string $pluralModelLabel = 'Laporan';
    protected static ?string $navigationGroup = 'Manajemen';

    public static function form(Form $form): Form
    {
        // Formulir ini dibuat read-only karena data diisi oleh mahasiswa/dosen
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Laporan')
                    ->schema([
                        Forms\Components\TextInput::make('proposal.user.name')
                            ->label('Pengaju')
                            ->disabled(),
                        Forms\Components\TextInput::make('proposal.school.name')
                            ->label('Sekolah')
                            ->disabled(),
                        Forms\Components\DatePicker::make('event_date')
                            ->label('Tanggal Kegiatan')
                            ->disabled(),
                        Forms\Components\TextInput::make('attendees_count')
                            ->label('Jumlah Peserta')
                            ->numeric()
                            ->disabled(),
                        Forms\Components\RichEditor::make('qualitative_notes')
                            ->label('Catatan Kualitatif')
                            ->columnSpanFull()
                            ->disabled(),
                        Forms\Components\TextInput::make('documentation_path')
                            ->label('Link Dokumentasi')
                            ->columnSpanFull()
                            ->disabled(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('proposal.user.name')
                    ->label('Pengaju')
                    ->searchable(),
                Tables\Columns\TextColumn::make('proposal.school.name')
                    ->label('Sekolah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('event_date')
                    ->label('Tgl Kegiatan')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('proposal.status')
                    ->label('Status Proposal')
                    ->badge()
                    ->colors([
                        'warning' => 'laporan_disubmit',
                        'success' => 'laporan_diverifikasi',
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Aksi kustom untuk verifikasi laporan
                Action::make('verify_report')
                    ->label('Verifikasi Laporan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation() // Meminta konfirmasi sebelum eksekusi
                    ->action(function (Report $record) {
                        $proposal = $record->proposal;

                        // 1. Ubah status proposal
                        $proposal->status = 'laporan_diverifikasi';
                        $proposal->save();

                        // 2. Buat record pembayaran baru
                        Payment::create([
                            'proposal_id' => $proposal->id,
                            'amount' => 250000, // Anda bisa set default amount di sini
                            'status' => 'menunggu_pembayaran',
                            'processed_by' => auth()->id(),
                        ]);

                        // 3. Kirim notifikasi sukses
                        Notification::make()
                            ->title('Laporan berhasil diverifikasi')
                            ->body('Data pembayaran telah dibuat dan siap diproses.')
                            ->success()
                            ->send();
                    })
                    // Hanya tampilkan tombol jika statusnya masih 'laporan_disubmit'
                    ->visible(fn (Report $record): bool => $record->proposal->status === 'laporan_disubmit'),
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListReports::route('/'),
            // Kita nonaktifkan halaman create dan edit karena laporan dibuat dari sisi user
            // 'create' => Pages\CreateReport::route('/create'), 
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }    
}
