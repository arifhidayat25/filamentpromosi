<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationLabel = 'Manajemen Laporan';
    protected static ?string $navigationGroup = 'Manajemen';

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Auth::user();

        if ($user->hasRole('pembina')) {
            $pembinaProdiId = $user->program_studi_id;
            return $query->whereHas('proposal.user', fn ($q) => $q->where('program_studi_id', $pembinaProdiId));
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        // Form ini hanya untuk Admin, bukan untuk persetujuan
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'diajukan' => 'Diajukan',
                        'disetujui_staff' => 'Disetujui Staff',
                        'ditolak_staff' => 'Ditolak Staff',
                    ])->required(),
                Forms\Components\RichEditor::make('qualitative_notes')->label('Isi Laporan')->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('proposal.user.name')->label('Mahasiswa')->searchable(),
                Tables\Columns\TextColumn::make('proposal.school.name')->label('Sekolah Tujuan')->searchable(),
                Tables\Columns\TextColumn::make('proposal.dosenPembina.name')->label('Dosen Pembina')->searchable(),
                BadgeColumn::make('status')->label('Status Laporan')->colors([
                    'primary' => 'diajukan',
                    'success' => 'disetujui_staff',
                    'danger'  => 'ditolak_staff',
                ]),
            ])
            ->actions([
                // Aksi "Setujui Laporan" hanya untuk Staff
                Action::make('approve')
                    ->label('Setujui Laporan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Report $record): bool => $record->status === 'diajukan' && Auth::user()->hasRole(['staff', 'admin']))
                    ->action(function (Report $record) {
                        $record->update(['status' => 'disetujui_staff']);
                        $record->proposal->update(['status' => 'Menunggu Pembayaran']);
                        Notification::make()->title('Laporan berhasil disetujui!')->success()->send();
                    }),
                
                // Tombol Edit & View hanya untuk Admin
                Tables\Actions\EditAction::make()->visible(fn (): bool => Auth::user()->hasRole('admin')),
                Tables\Actions\ViewAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}