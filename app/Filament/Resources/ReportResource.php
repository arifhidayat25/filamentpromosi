<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationLabel = 'Manajemen Laporan';
    protected static ?string $navigationGroup = 'Manajemen';

    /**
     * LOGIKA BARU: Membatasi data yang bisa dilihat oleh Pembina.
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (Auth::user()->hasRole('pembina')) {
            $pembinaProdiId = Auth::user()->program_studi_id;
            return $query->whereHas('proposal.user', function ($q) use ($pembinaProdiId) {
                $q->where('program_studi_id', $pembinaProdiId);
            });
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'diajukan' => 'Diajukan',
                        'disetujui_staff' => 'Disetujui Staff',
                        'ditolak_staff' => 'Ditolak Staff',
                    ])->required(),
                Forms\Components\RichEditor::make('notes')->label('Isi Laporan')->disabled(),
            ]);
    }

    /**
     * PERBAIKAN UTAMA: Menambahkan kolom Nama Sekolah dan Nama Pembina.
     */
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
                Tables\Columns\TextColumn::make('event_date')->label('Tgl Kegiatan')->date('d M Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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