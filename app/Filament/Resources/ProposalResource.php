<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProposalResource\Pages;
use App\Models\Proposal;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProposalResource extends Resource
{
    protected static ?string $model = Proposal::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-plus';
    protected static ?string $navigationLabel = 'Ajuan Promosi';
    protected static ?string $modelLabel = 'Ajuan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengajuan')->schema([
                    Forms\Components\Select::make('user_id')
                        ->label('Pengaju (Mahasiswa/Dosen)')
                        ->options(User::whereIn('role', ['mahasiswa', 'dosen'])->pluck('name', 'id'))
                        ->searchable()
                        ->required(),
                    Forms\Components\Select::make('school_id')
                        ->label('Sekolah Tujuan')
                        ->relationship('school', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\DatePicker::make('proposed_date')
                        ->label('Tanggal Usulan')
                        ->required(),
                    Forms\Components\RichEditor::make('notes')
                        ->label('Catatan Tambahan')
                        ->columnSpanFull(),
                ])->columns(2),
                Forms\Components\Section::make('Status & Persetujuan')->schema([
                    Forms\Components\Select::make('status')
                        ->options([
                            'diajukan' => 'Diajukan',
                            'disetujui_pembina' => 'Disetujui Pembina',
                            'ditolak_pembina' => 'Ditolak Pembina',
                            'disetujui_staf' => 'Disetujui Staf',
                            'ditolak_staf' => 'Ditolak Staf',
                            'siap_dilaksanakan' => 'Siap Dilaksanakan',
                            'laporan_disubmit' => 'Laporan Disubmit',
                            'laporan_diverifikasi' => 'Laporan Diverifikasi',
                            'selesai' => 'Selesai',
                        ])
                        ->required(),
                    Forms\Components\Textarea::make('rejection_reason')
                        ->label('Alasan Penolakan')
                        ->visible(fn ($get) => in_array($get('status'), ['ditolak_pembina', 'ditolak_staf'])),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Pengaju')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('school.name')->label('Sekolah Tujuan')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('proposed_date')->label('Tgl Usulan')->date('d M Y')->sortable(),
                Tables\Columns\BadgeColumn::make('status')->colors([
                    'primary' => 'diajukan',
                    'warning' => fn ($state) => in_array($state, ['disetujui_pembina', 'laporan_disubmit']),
                    'success' => fn ($state) => in_array($state, ['disetujui_staf', 'laporan_diverifikasi', 'selesai', 'siap_dilaksanakan']),
                    'danger' => fn ($state) => in_array($state, ['ditolak_pembina', 'ditolak_staf'])
                ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), // Menambahkan aksi hapus
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(), // Menambahkan hapus massal
                ]),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProposals::route('/'),
            'create' => Pages\CreateProposal::route('/create'),
            'edit' => Pages\EditProposal::route('/{record}/edit'),
        ];
    }    
}