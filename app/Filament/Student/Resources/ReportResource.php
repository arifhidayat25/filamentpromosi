<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\ReportResource\Pages;
use App\Models\Report;
use App\Models\Proposal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationLabel = 'Laporan Saya';
    protected static ?string $modelLabel = 'Laporan';
    protected static ?string $navigationGroup = 'Kegiatanku';
    protected static ?string $slug = 'laporan-saya';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('proposal_id')
                    ->label('Proposal Terkait')
                    // --- PERBAIKAN DI SINI ---
                    ->options(Proposal::where('user_id', Auth::id())->get()->pluck('custom_label', 'id'))
                    ->default(request()->get('proposal_id'))
                    ->required()
                    ->searchable()
                    ->disabled(request()->has('proposal_id')),
                Forms\Components\DatePicker::make('event_date')
                    ->label('Tanggal Pasti Pelaksanaan')
                    ->required(),
                Forms\Components\TextInput::make('attendees_count')->label('Jumlah Peserta (Siswa)')->numeric()->required()->default(0),
                Forms\Components\RichEditor::make('qualitative_notes')->label('Catatan Kualitatif (Deskripsi Kegiatan)')->columnSpanFull()->required(),
                Forms\Components\TextInput::make('documentation_path')->label('Link Dokumentasi (Google Drive, dll.)')->url()->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('proposal.school.name')->label('Sekolah'),
                Tables\Columns\TextColumn::make('event_date')->label('Tgl Kegiatan')->date('d M Y'),
                Tables\Columns\BadgeColumn::make('proposal.status')->label('Status Laporan')->colors([
                    'warning' => 'laporan_disubmit',
                    'success' => 'laporan_diverifikasi',
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('proposal', function ($query) {
            $query->where('user_id', Auth::id());
        });
    }

    public static function canCreate(): bool
    {
        return Proposal::where('user_id', Auth::id())->whereIn('status', ['siap_dilaksanakan', 'disetujui_staf'])->exists();
    }
}