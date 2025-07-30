<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProposalResource\Pages;
use App\Models\Proposal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class ProposalResource extends Resource
{
    protected static ?string $model = Proposal::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    // Cek apakah user saat ini adalah staff
    $isStaff = auth()->user()->hasRole('staff');

    return $form
        ->schema([
            Forms\Components\Select::make('user_id')
                ->label('Mahasiswa Pengaju')
                ->relationship(name: 'user', titleAttribute: 'name', modifyQueryUsing: fn (Builder $query) => $query->where('role', 'mahasiswa'))
                ->searchable()
                ->preload()
                ->required()
                ->visible(auth()->user()->hasRole('admin'))
                // Nonaktifkan jika staff
                ->disabled($isStaff),

            Forms\Components\Select::make('school_id')
                ->label('Sekolah Tujuan')
                ->relationship('school', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')->required()->label('Nama Sekolah'),
                    Forms\Components\Textarea::make('address')->columnSpanFull()->label('Alamat'),
                ])
                // Nonaktifkan jika staff
                ->disabled($isStaff),

            Forms\Components\DatePicker::make('proposed_date')
                ->label('Tanggal Pengajuan')
                ->default(now())
                ->required()
                // Nonaktifkan jika staff
                ->disabled($isStaff),

            Forms\Components\Textarea::make('notes')
                ->label('Catatan Tambahan')
                ->columnSpanFull()
                // Nonaktifkan jika staff
                ->disabled($isStaff),

            // Fieldset untuk status approval
            Forms\Components\Fieldset::make('Status Approval')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->options([
                            'diajukan' => 'Diajukan',
                            'disetujui_pembina' => 'Disetujui Pembina',
                            'ditolak_pembina' => 'Ditolak Pembina',
                            'disetujui_staf' => 'Disetujui Staf',
                            'ditolak_staf' => 'Ditolak Staf',
                            'laporan_disubmit' => 'Laporan Disubmit',
                            'laporan_diverifikasi' => 'Laporan Diverifikasi',
                            'selesai' => 'Selesai',
                        ])
                        ->default('diajukan')
                        ->required()
                        // KUNCI: Nonaktifkan juga untuk staff
                        ->disabled($isStaff),

                    Forms\Components\Textarea::make('rejection_reason')
                        ->label('Alasan Penolakan (Jika ditolak)')
                        // KUNCI: Nonaktifkan juga untuk staff
                        ->disabled($isStaff),
                ])
                ->visible(fn () => !auth()->user()->hasRole('mahasiswa')),
        ]);
}

    // app/Filament/Resources/ProposalResource.php

public static function table(Table $table): Table
{
    $user = auth()->user();

    return $table
        ->columns([
            // Biarkan semua kolom relevan terlihat oleh semua peran
            Tables\Columns\TextColumn::make('user.name')
                ->label('Nama Mahasiswa')
                ->searchable(),

            Tables\Columns\TextColumn::make('school.name')
                ->label('Sekolah Tujuan')
                ->searchable(),

            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'warning' => fn ($state) => in_array($state, ['diajukan', 'laporan_disubmit']),
                    'success' => fn ($state) => in_array($state, ['disetujui_pembina', 'disetujui_staf', 'laporan_diverifikasi', 'selesai']),
                    'danger' => fn ($state) => in_array($state, ['ditolak_pembina', 'ditolak_staf']),
                ]),

            Tables\Columns\TextColumn::make('proposed_date')
                ->label('Tgl. Diajukan')
                ->date()
                ->sortable(),
        ])
        ->filters([
            //
        ])
        ->actions([
            // Tombol View tetap ada untuk semua
            Tables\Actions\ViewAction::make(),
            // KUNCI: Logika baru untuk tombol Edit
            Tables\Actions\EditAction::make()
                ->visible(function (Proposal $record) use ($user) {
                    // Tampilkan jika user adalah admin ATAU pembina
                    if ($user->hasRole('admin') || $user->hasRole('pembina')) {
                        return true;
                    }
                    // Mahasiswa hanya bisa edit jika proposalnya sendiri DAN statusnya masih 'diajukan'
                    if ($user->hasRole('mahasiswa') && $record->user_id === $user->id && $record->status === 'diajukan') {
                        return true;
                    }
                    // Sembunyikan untuk kasus lainnya (termasuk untuk staff)
                    return false;
                }),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}

    // KUNCI: Menggunakan getEloquentQuery adalah cara terbaik untuk membatasi data
    public static function getEloquentQuery(): Builder
{
    $user = auth()->user();

    // KUNCI: Hanya jika rolenya adalah 'mahasiswa', kita filter berdasarkan ID mereka.
    if ($user->hasRole('mahasiswa')) {
        return parent::getEloquentQuery()->where('user_id', $user->id);
    }

    // Untuk role lain (admin, pembina, staff), tampilkan semua data.
    // Pembatasan akan dilakukan di level kolom pada method table().
    return parent::getEloquentQuery();
}

    public static function getRelations(): array
    {
        return [
            //
        ];
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