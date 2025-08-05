<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\ProposalResource\Pages;
use App\Filament\Student\Resources\PaymentResource; // <-- Tambahkan ini
use App\Models\Proposal;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ProposalResource extends Resource
{
    protected static ?string $model = Proposal::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Pengajuan';
    protected static ?string $pluralModelLabel = 'Pengajuan Saya';
    protected static ?string $navigationGroup = 'Aktivitas';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

    // Di dalam app/Filament/Student/Resources/ProposalResource.php

public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Group::make()->schema([
                Forms\Components\TextInput::make('nama_mahasiswa')->label('Mahasiswa')->default(Auth::user()->name)->disabled()->dehydrated(false),
                Forms\Components\TextInput::make('prodi_mahasiswa')->label('Program Studi')->default(Auth::user()->programStudi->name ?? 'Belum Diatur')->disabled()->dehydrated(false),
            ])->columns(2),

            Forms\Components\Select::make('school_id')->label('Sekolah')->relationship('school', 'name')->searchable()->required(),

            // --- INI BAGIAN YANG DIPERBARUI ---
            Forms\Components\TextInput::make('dosen_pembina_otomatis')
                ->label('Dosen Pembina')
                ->default(function () {
                    $prodiId = Auth::user()->program_studi_id;
                    if ($prodiId) {
                        $pembina = User::where('program_studi_id', $prodiId)
                                     ->whereHas('roles', fn($q) => $q->where('name', 'pembina'))
                                     ->first();
                        return $pembina ? $pembina->name : 'Pembina untuk prodi Anda belum diatur';
                    }
                    return 'Program studi Anda belum diatur';
                })
                ->disabled()
                ->dehydrated(false), // Field ini tidak akan disimpan ke database

            Forms\Components\DatePicker::make('proposed_date')->label('Tanggal Diajukan')->default(now())->required(),
            Forms\Components\RichEditor::make('notes')->label('Deskripsi Pengajuan')->required()->columnSpanFull(),
            Forms\Components\Textarea::make('rejection_reason')->label('Alasan Penolakan')->columnSpanFull()->hiddenOn('create')->disabled(),
        ]);
}

    // ===============================================
    // == PERBAIKAN UTAMA ADA DI DALAM FUNGSI INI ==
    // ===============================================
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('school.name')
                    ->label('Nama Sekolah')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('proposed_date')
                    ->label('Tanggal Diajukan')
                    ->date()
                    ->sortable(),

                // Kolom Status Pengajuan
                BadgeColumn::make('status')
                    ->label('Status Pengajuan')
                    ->colors([
                        'primary'   => 'diajukan',
                        'warning'   => 'diproses',
                        'success'   => 'disetujui_pembina',
                        'danger'    => 'ditolak_pembina',
                        'info'      => 'Menunggu Pembayaran',
                        'secondary' => 'selesai',
                    ]),
                
                // Kolom Status Laporan
                BadgeColumn::make('report.status')
                    ->label('Status Laporan')
                    ->colors([
                        'primary' => 'diajukan',
                        'success' => 'disetujui_staff',
                        'danger'  => 'ditolak_staff',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn (Proposal $record) => $record->status === 'diajukan'),

       Action::make('cetak_sertifikat')
                    ->label(fn (Proposal $record): string => $record->certificate ? 'Unduh Sertifikat' : 'Cetak Sertifikat')
                    ->icon(fn (Proposal $record): string => $record->certificate ? 'heroicon-o-arrow-down-tray' : 'heroicon-o-document-arrow-down')
                    ->color('success')
                    ->visible(fn (Proposal $record): bool => $record->status === 'selesai')
                    ->url(fn (Proposal $record) => route('mahasiswa.sertifikat.generate', $record), shouldOpenInNewTab: true),
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