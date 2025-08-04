<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\PaymentResource\Pages;
use App\Filament\Student\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Pembayaran';
    protected static ?string $modelLabel = 'Pembayaran';
    protected static ?string $pluralModelLabel = 'Pembayaran';
    protected static ?string $navigationGroup = 'Keuangan';
    protected static ?string $slug = 'pembayaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('proposal_id')
                    ->relationship('proposal', 'id')
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\DatePicker::make('payment_date'),
                Forms\Components\TextInput::make('processed_by')
                    ->numeric(),
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
                Action::make('pay')->label('Bayar Fee')->icon('heroicon-o-check-circle')->color('success')->requiresConfirmation()
                    ->action(function (Payment $record) {
                        $record->status = 'dibayar';
                        $record->payment_date = now();
                        $record->processed_by = auth()->id();
                        $record->save();
                        
                        // PERBAIKAN: Status proposal diubah menjadi 'selesai' untuk memicu
                        // tombol generate sertifikat, bukan 'sertifikat_diterbitkan'.
                        $record->proposal->status = 'selesai';
                        $record->proposal->save();

                        Notification::make()->title('Pembayaran berhasil')->success()->send();
                    })
                    ->visible(fn (Payment $record): bool => $record->status === 'menunggu_pembayaran'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}