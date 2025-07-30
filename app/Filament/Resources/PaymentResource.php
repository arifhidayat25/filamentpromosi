<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;

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
                Forms\Components\TextInput::make('proposal.user.name')
                    ->label('Penerima')
                    ->disabled(),
                Forms\Components\TextInput::make('proposal.school.name')
                    ->label('Sekolah')
                    ->disabled(),
                Forms\Components\TextInput::make('amount')
                    ->label('Jumlah Fee')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Forms\Components\Select::make('status')
                    ->options([
                        'menunggu_pembayaran' => 'Menunggu Pembayaran',
                        'dibayar' => 'Dibayar',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('payment_date')
                    ->label('Tanggal Pembayaran'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('proposal.user.name')
                    ->label('Penerima')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('proposal.school.name')
                    ->label('Sekolah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'menunggu_pembayaran',
                        'success' => 'dibayar',
                    ]),
                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Tgl Dibayar')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('pay')
                    ->label('Bayar Fee')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Payment $record) {
                        $record->status = 'dibayar';
                        $record->payment_date = now();
                        $record->processed_by = auth()->id();
                        $record->save();

                        $record->proposal->status = 'selesai';
                        $record->proposal->save();

                        Notification::make()
                            ->title('Pembayaran berhasil')
                            ->body('Fee untuk ' . $record->proposal->user->name . ' telah dibayar.')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Payment $record): bool => $record->status === 'menunggu_pembayaran'),
            ])
            ->bulkActions([
                //
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
