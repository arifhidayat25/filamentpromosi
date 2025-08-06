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
use Filament\Forms\Components\Placeholder;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder; // <-- Tambahkan ini
use Illuminate\Support\Facades\Auth;     // <-- Tambahkan ini

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Manajemen Fee';
    protected static ?string $modelLabel = 'Pembayaran Fee';
    protected static ?string $navigationGroup = 'Manajemen';

    /**
     * SOLUSI #1: Memfilter data yang ditampilkan berdasarkan peran pengguna.
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Auth::user();

        // Jika user adalah 'mahasiswa', hanya tampilkan pembayaran miliknya.
        if ($user->hasRole('mahasiswa')) {
            return $query->whereHas('proposal', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        // Jika user adalah 'pembina', hanya tampilkan pembayaran dari mahasiswa di prodinya.
        if ($user->hasRole('pembina')) {
            $pembinaProdiId = $user->program_studi_id;
            return $query->whereHas('proposal.user', function ($q) use ($pembinaProdiId) {
                $q->where('program_studi_id', $pembinaProdiId);
            });
        }

        // Jika bukan keduanya (admin/staff), tampilkan semua data.
        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // SOLUSI #2: Memfilter pilihan proposal di form.
                Forms\Components\Select::make('proposal_id')
                    ->label('Proposal (Menunggu Pembayaran)')
                    ->options(
                        Proposal::where('status', 'Menunggu Pembayaran')
                                ->whereDoesntHave('payment') // Hanya tampilkan yang belum punya data pembayaran
                                ->get()
                                ->pluck('user.name', 'id')
                                ->map(function ($name, $id) {
                                    $proposal = Proposal::find($id);
                                    return "{$name} - {$proposal->school->name}";
                                })
                    )
                    ->searchable()
                    ->required(),
                
                Forms\Components\TextInput::make('amount')->label('Jumlah Fee')->required()->numeric()->prefix('Rp'),
                Forms\Components\Select::make('status')->options(['menunggu_pembayaran' => 'Menunggu Pembayaran', 'dibayar' => 'Dibayar'])->default('menunggu_pembayaran')->required(),
                Forms\Components\DatePicker::make('payment_date')->label('Tanggal Pembayaran')->default(now()),
                Forms\Components\Select::make('processed_by')->label('Diproses Oleh')->relationship('processor', 'name')->default(auth()->id())->disabled()->dehydrated(),
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
                Action::make('pay')
                    ->label('Bayar Fee')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Payment $record): bool => $record->status === 'menunggu_pembayaran')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Pembayaran Fee')
                    ->modalSubmitActionLabel('Ya, Sudah Dibayar')
                    ->form([
                        Placeholder::make('nama_penerima')->label('Nama Penerima')->content(fn (Payment $record): string => $record->proposal->user->name),
                        Placeholder::make('jumlah_transfer')->label('Jumlah Transfer')->content(fn (Payment $record): string => 'Rp ' . number_format($record->amount, 0, ',', '.')),
                    ])
                    ->action(function (Payment $record) {
                        $record->status = 'dibayar';
                        $record->payment_date = now();
                        $record->processed_by = auth()->id();
                        $record->save();
                        
                        $record->proposal->status = 'selesai';
                        $record->proposal->save();
                        
                        // Opsi: Anda juga bisa menambahkan logika untuk mengubah status laporan di sini
                        if ($record->proposal->report) {
                            $record->proposal->report->update(['status' => 'telah diterima']);
                        }
                        
                        Notification::make()->title('Pembayaran berhasil')->success()->send();
                    }),
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