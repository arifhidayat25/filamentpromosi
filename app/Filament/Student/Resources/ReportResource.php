<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\ReportResource\Pages;
use App\Models\Proposal;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn; // <-- Pastikan ini ada
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationLabel = 'Laporan';
    protected static ?string $pluralModelLabel = 'Laporan Saya';
    protected static ?string $navigationGroup = 'Aktivitas';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('proposal', function ($query) {
            $query->where('user_id', Auth::id());
        });
    }

    public static function canCreate(): bool
    {
        return Proposal::where('user_id', Auth::id())
                       ->where('status', 'disetujui_pembina')
                       ->doesntHave('report')
                       ->exists();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('proposal_id')
                    ->label('Pilih Pengajuan (Disetujui Pembina)')
                    ->options(function () {
                        return Proposal::where('user_id', auth()->id())
                            ->where('status', 'disetujui_pembina')
                            ->doesntHave('report')
                            ->get()
                            ->mapWithKeys(function ($proposal) {
                                return [$proposal->id => 'Pengajuan #' . $proposal->id . ' (' . \Carbon\Carbon::parse($proposal->proposed_date)->format('d M Y') . ')'];
                            });
                    })
                    ->required()
                    ->searchable(),
                
                Forms\Components\DatePicker::make('event_date')
                    ->label('Tanggal Kegiatan/Kejadian')
                    ->default(now())
                    ->required(),
                
                Forms\Components\RichEditor::make('notes')
                    ->label('Isi Laporan')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('proposal.id')
                    ->label('Terkait Pengajuan #')
                    ->sortable(),

                // --- INI PERBAIKAN UTAMANYA ---
                BadgeColumn::make('status')
                    ->label('Status Laporan')
                    ->colors([
                        'primary' => 'diajukan',
                        'success' => 'disetujui_staff',
                        'danger'  => 'ditolak_staff',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Mahasiswa tidak bisa mengedit laporan yang sudah diajukan
                // Tables\Actions\EditAction::make(), 
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}