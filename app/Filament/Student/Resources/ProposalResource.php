<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\ProposalResource\Pages;
use App\Filament\Student\Resources\ReportResource;
use App\Models\Proposal;
use App\Models\School;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProposalResource extends Resource
{
    protected static ?string $model = Proposal::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';
    protected static ?string $navigationLabel = 'Proposal Saya';
    protected static ?string $modelLabel = 'Proposal';
    protected static ?string $navigationGroup = 'Kegiatanku';
    protected static ?string $slug = 'proposal-saya';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('school_id')
                    ->label('Sekolah Tujuan')
                    ->relationship('school', 'name') // Cara terbaik untuk mengisi options
                    ->searchable()
                    ->preload() // Memuat data saat halaman dibuka
                    ->required(),
                Forms\Components\DatePicker::make('proposed_date')
                    ->label('Tanggal Usulan Pelaksanaan')
                    ->native(false) // Gunakan datepicker yang lebih modern
                    ->displayFormat('d F Y')
                    ->required(),
                Forms\Components\RichEditor::make('notes')
                    ->label('Catatan Tambahan (jika ada)')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('school.name')->label('Sekolah Tujuan')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('proposed_date')->label('Tgl Usulan')->date('d F Y')->sortable(),
                Tables\Columns\BadgeColumn::make('status')->label('Status')->colors([
                    'primary' => 'diajukan',
                    'warning' => fn ($state) => in_array($state, ['disetujui_pembina', 'laporan_disubmit']),
                    'success' => fn ($state) => in_array($state, ['disetujui_staf', 'siap_dilaksanakan', 'laporan_diverifikasi', 'selesai']),
                    'danger' => fn ($state) => in_array($state, ['ditolak_pembina', 'ditolak_staf'])
                ])->formatStateUsing(fn (string $state): string => str_replace('_', ' ', \Illuminate\Support\Str::title($state))),
                Tables\Columns\TextColumn::make('rejection_reason')->label('Alasan Penolakan')->toggleable()->toggledHiddenByDefault(),
            ])
            ->actions([
                Tables\Actions\Action::make('isi_laporan')
                    ->label('Isi Laporan')
                    ->url(fn (Proposal $record): string => ReportResource::getUrl('create', ['proposal_id' => $record->id]))
                    ->icon('heroicon-o-document-text')
                    ->color('success')
                    ->visible(fn (Proposal $record): bool => in_array($record->status, ['siap_dilaksanakan', 'disetujui_staf'])),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('Buat Pengajuan Baru'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProposals::route('/'),
            'create' => Pages\CreateProposal::route('/create'),
            // Mahasiswa tidak perlu halaman edit, karena diedit oleh admin/staf
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        // Hanya tampilkan proposal milik user yang sedang login
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

    public static function canEdit(Model $record): bool
    {
        return false; // Mahasiswa tidak bisa mengedit proposal yang sudah diajukan
    }
}