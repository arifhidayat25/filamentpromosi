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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ProposalResource extends Resource
{
    protected static ?string $model = Proposal::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-plus';
    protected static ?string $navigationLabel = 'Manajemen Ajuan';
    protected static ?string $modelLabel = 'Ajuan Promosi';
    protected static ?string $navigationGroup = 'Manajemen';

    /**
     * Memfilter data agar pembina hanya melihat proposal dari prodinya.
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Auth::user();

        if ($user->hasRole('pembina')) {
            $pembinaProdiId = $user->program_studi_id;
            return $query->whereHas('user', function ($q) use ($pembinaProdiId) {
                $q->where('program_studi_id', $pembinaProdiId);
            });
        }

        return $query;
    }

    /**
     * Mendefinisikan form untuk membuat dan mengedit data.
     * Termasuk logika pembatasan status untuk peran pembina.
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengajuan')->schema([
                    Forms\Components\Select::make('user_id')
                        ->label('Pengaju (Mahasiswa)')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->required(),
                    
                    Forms\Components\Select::make('school_id')
                        ->label('Sekolah Tujuan')
                        ->relationship('school', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Forms\Components\Select::make('dosen_pembina_id')
                        ->label('Dosen Pembina')
                        ->options(User::whereHas('roles', fn($q) => $q->where('name', 'pembina'))->pluck('name', 'id'))
                        ->searchable()
                        ->required(),

                    Forms\Components\DatePicker::make('proposed_date')
                        ->label('Tanggal Usulan')
                        ->required(),

                    Forms\Components\RichEditor::make('notes')
                        ->label('Catatan Tambahan')
                        ->columnSpanFull(),
                ])->columns(2),
                
                Forms\Components\Section::make('Status & Persetujuan')->schema([
                    // --- INI ADALAH LOGIKA UTAMA YANG ANDA MINTA ---
                    Forms\Components\Select::make('status')
                        ->label('Ubah Status Pengajuan')
                        ->options(function () {
                            // Jika yang login adalah 'pembina'
                            if (Auth::user()->hasRole('pembina')) {
                                // Tampilkan hanya dua pilihan ini
                                return [
                                    'disetujui_pembina' => 'Setujui Pengajuan Ini',
                                    'ditolak_pembina'  => 'Tolak Pengajuan Ini',
                                ];
                            }

                            // Jika bukan pembina (misalnya admin atau staff), tampilkan semua pilihan
                            return [
                                'diajukan'           => 'Diajukan',
                                'disetujui_pembina'   => 'Disetujui Pembina',
                                'ditolak_pembina'     => 'Ditolak Pembina',
                                'Menunggu Pembayaran' => 'Menunggu Pembayaran',
                                'selesai'             => 'Selesai',
                            ];
                        })
                        ->required(),
                    
                    Forms\Components\Textarea::make('rejection_reason')
                        ->label('Alasan Penolakan')
                        ->visible(fn ($get) => in_array($get('status'), ['ditolak_pembina', 'ditolak_staff'])),
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
                Tables\Actions\DeleteAction::make()
                    ->successRedirectUrl(self::getUrl('index')), // Perbaikan di sini
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->successRedirectUrl(self::getUrl('index')), // Perbaikan di sini
                ])
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