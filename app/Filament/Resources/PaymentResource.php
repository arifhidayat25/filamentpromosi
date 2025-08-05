<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use App\Models\Proposal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Placeholder; // Pastikan ini ada
use Filament\Notifications\Notification; // Pastikan ini ada

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Manajemen Fee';
    protected static ?string $modelLabel = 'Pembayaran Fee';
    protected static ?string $navigationGroup = 'Manajemen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('proposal_id')
                    ->label('Proposal')
                    ->relationship('proposal', 'id')
                    ->getOptionLabelFromRecordUsing(fn (Proposal $record) => "{$record->user->name} - {$record->school->name}")
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('amount')->label('Jumlah Fee')->required()->numeric()->prefix('Rp'),
                Forms\Components\Select::make('status')->options(['menunggu_pembayaran' => 'Menunggu Pembayaran', 'dibayar' => 'Dibayar'])->required(),
                Forms\Components\DatePicker::make('payment_date')
                    ->label('Tanggal Pembayaran')
                    ->default(now()),
                Forms\Components\Select::make('processed_by')->label('Diproses Oleh')->relationship('processor', 'name')->default(auth()->id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('proposal.user.name')->label('Penerima')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('proposal.school.name')->label('Sekolah')->searchable(),
                Tables\Columns\TextColumn::make('amount')->label('Jumlah')->money('IDR')->sortable(),
                Tables\Columns\BadgeColumn::make('status')->colors(['warning' => 'menunggu_pembayaran', 'success' => 'dibayar']),
                Tables\Columns\TextColumn::make('payment_date')->label('Tgl Dibayar')->date('d M Y')->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                
                // ----- BLOK AKSI YANG DIPERBAIKI -----
                Action::make('pay')
                    ->label('Bayar Fee')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Payment $record): bool => $record->status === 'menunggu_pembayaran')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Pembayaran Fee')
                    ->modalDescription('Pastikan Anda sudah mentransfer dana sesuai detail di bawah ini sebelum menekan tombol konfirmasi.')
                    ->modalSubmitActionLabel('Ya, Sudah Dibayar')
                    ->form([
                        Placeholder::make('nama_penerima')
                            ->label('Nama Penerima')
                            ->content(fn (Payment $record): string => $record->proposal->user->name),

                        Placeholder::make('bank_tujuan')
                            ->label('Bank Tujuan')
                            ->content(fn (Payment $record): string => $record->proposal->user->bankAccount->bank_name ?? 'Data Bank Belum Diisi'),

                        Placeholder::make('nomor_rekening')
                            ->label('Nomor Rekening')
                            ->content(fn (Payment $record): string => $record->proposal->user->bankAccount->account_number ?? 'Data Bank Belum Diisi'),
                            
                        Placeholder::make('atas_nama')
                            ->label('Atas Nama')
                            ->content(fn (Payment $record): string => $record->proposal->user->bankAccount->account_holder_name ?? 'Data Bank Belum Diisi'),

                        Placeholder::make('jumlah_transfer')
                            ->label('Jumlah Transfer')
                            ->content(fn (Payment $record): string => 'Rp ' . number_format($record->amount, 0, ',', '.')),
                    ])
                    ->action(function (Payment $record) {
                        $record->status = 'dibayar';
                        $record->payment_date = now();
                        $record->processed_by = auth()->id();
                        $record->save();
                        
                        $record->proposal->status = 'selesai';
                        $record->proposal->save();
                        
                        Notification::make()->title('Pembayaran berhasil')->success()->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }       
}