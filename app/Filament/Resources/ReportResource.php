<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Models\Report;
use App\Models\Payment;
use App\Models\Proposal;
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
    protected static ?string $navigationGroup = 'Manajemen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Laporan')->schema([
                    Forms\Components\Select::make('proposal_id')
                        ->label('Proposal Terkait')
                        ->relationship('proposal', 'id')
                        ->getOptionLabelFromRecordUsing(fn (Proposal $record) => "{$record->user->name} - {$record->school->name}")
                        ->searchable()
                        ->preload()
                        ->required(),
                    // PERUBAHAN: Menambahkan default tanggal hari ini
                    Forms\Components\DatePicker::make('event_date')
                        ->label('Tanggal Kegiatan')
                        ->required()
                        ->default(now()),
                    Forms\Components\TextInput::make('attendees_count')->label('Jumlah Peserta')->numeric()->required()->default(0),
                    Forms\Components\RichEditor::make('qualitative_notes')->label('Catatan Kualitatif')->columnSpanFull(),
                    Forms\Components\TextInput::make('documentation_path')->label('Link Dokumentasi')->columnSpanFull(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('proposal.user.name')->label('Pengaju')->searchable(),
                Tables\Columns\TextColumn::make('proposal.school.name')->label('Sekolah')->searchable(),
                Tables\Columns\TextColumn::make('event_date')->label('Tgl Kegiatan')->date('d M Y')->sortable(),
                Tables\Columns\BadgeColumn::make('proposal.status')->label('Status Proposal')->colors(['warning' => 'laporan_disubmit', 'success' => 'laporan_diverifikasi']),
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Aksi edit sekarang aktif
                Tables\Actions\DeleteAction::make(), // Aksi hapus sekarang aktif
                Action::make('verify_report')->label('Verifikasi')->icon('heroicon-o-check-circle')->color('success')->requiresConfirmation()
                    ->action(function (Report $record) {
                        $proposal = $record->proposal;
                        $proposal->status = 'laporan_diverifikasi';
                        $proposal->save();
                        Payment::updateOrCreate(['proposal_id' => $proposal->id], ['amount' => 250000, 'status' => 'menunggu_pembayaran']);
                        Notification::make()->title('Laporan berhasil diverifikasi')->success()->send();
                    })
                    ->visible(fn (Report $record): bool => $record->proposal?->status === 'laporan_disubmit'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(), // Aksi hapus massal aktif
                ]),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'), // Halaman Create sekarang aktif
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }    
}


