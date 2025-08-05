<?php

namespace App\Filament\Student\Widgets;

use App\Filament\Student\Resources\ProposalResource;
use App\Models\Proposal;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class ProposalTerbaru extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Proposal::query()->where('user_id', Auth::id())
            )
            ->defaultSort('created_at', 'desc')
            ->heading('5 Pengajuan Terakhir Anda')
            ->columns([
                Tables\Columns\TextColumn::make('school.name')
                    ->label('Nama Sekolah'),
                Tables\Columns\TextColumn::make('proposed_date')
                    ->label('Tanggal Diajukan')
                    ->date(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'primary'   => 'diajukan',
                        'warning'   => 'diproses',
                        'success'   => 'disetujui_pembina',
                        'danger'    => 'ditolak_pembina',
                        'info'      => 'Menunggu Pembayaran',
                        'secondary' => 'selesai',
                    ]),
            ])
            ->paginated(false)
            ->actions([
                // --- PERBAIKAN DI SINI ---
                // Mengarahkan tombol ke halaman 'edit' yang sudah ada, bukan 'view'
                Tables\Actions\Action::make('Lihat')
                    ->url(fn (Proposal $record): string => ProposalResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}