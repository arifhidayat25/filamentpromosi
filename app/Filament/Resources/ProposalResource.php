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
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder; // <-- Tambahkan ini
use Illuminate\Support\Facades\Auth;     // <-- Tambahkan ini

class ProposalResource extends Resource
{
    protected static ?string $model = Proposal::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-plus';
    protected static ?string $navigationLabel = 'Manajemen Ajuan';
    protected static ?string $modelLabel = 'Ajuan Promosi';
    protected static ?string $navigationGroup = 'Manajemen';

    /**
     * INI ADALAH SOLUSI UTAMA:
     * Memfilter data yang ditampilkan berdasarkan peran pengguna.
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Jika user yang login adalah 'pembina',
        if (Auth::user()->hasRole('pembina')) {
            $pembinaProdiId = Auth::user()->program_studi_id;
            // maka hanya tampilkan proposal dari mahasiswa yang satu prodi dengannya.
            return $query->whereHas('user', function ($q) use ($pembinaProdiId) {
                $q->where('program_studi_id', $pembinaProdiId);
            });
        }

        // Jika bukan pembina (admin/staff), tampilkan semua data.
        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengajuan')->schema([
                    Forms\Components\Select::make('user_id')
                        ->label('Pengaju (Mahasiswa)')
                        ->options(User::whereHas('roles', fn($q) => $q->where('name', 'mahasiswa'))->pluck('name', 'id'))
                        ->searchable()->required(),
                    
                    Forms\Components\Select::make('school_id')->label('Sekolah Tujuan')->relationship('school', 'name')->searchable()->preload()->required(),

                    Forms\Components\Select::make('dosen_pembina_id')
                        ->label('Dosen Pembina')
                        ->options(User::whereHas('roles', fn($q) => $q->where('name', 'pembina'))->pluck('name', 'id'))
                        ->searchable()->required(),

                    Forms\Components\DatePicker::make('proposed_date')->label('Tanggal Usulan')->required(),
                    Forms\Components\RichEditor::make('notes')->label('Catatan Tambahan')->columnSpanFull(),
                ])->columns(2),
                
                Forms\Components\Section::make('Status & Persetujuan')->schema([
                    Forms\Components\Select::make('status')
                        ->options([
                            'diajukan' => 'Diajukan',
                            'disetujui_pembina' => 'Disetujui Pembina',
                            'ditolak_pembina' => 'Ditolak Pembina',
                            'Menunggu Pembayaran' => 'Menunggu Pembayaran',
                            'selesai' => 'Selesai',
                        ])->required(),
                    
                    Forms\Components\Textarea::make('rejection_reason')->label('Alasan Penolakan')->visible(fn ($get) => in_array($get('status'), ['ditolak_pembina', 'ditolak_staff'])),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Pengaju')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('dosenPembina.name')->label('Pembina')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('school.name')->label('Sekolah')->searchable()->sortable(),
                BadgeColumn::make('status')->colors([
                    'primary'   => 'diajukan',
                    'warning'   => fn ($state) => in_array($state, ['diproses', 'Menunggu Pembayaran']),
                    'success'   => fn ($state) => in_array($state, ['disetujui_pembina', 'disetujui_staff', 'selesai']),
                    'danger'    => fn ($state) => in_array($state, ['ditolak_pembina', 'ditolak_staff']),
                ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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