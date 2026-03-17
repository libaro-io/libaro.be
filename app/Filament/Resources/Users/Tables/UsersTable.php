<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\User;
use App\Services\AdminUserPasswordResetService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Password;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                IconColumn::make('email_verified_at')
                    ->label('Verified')
                    ->boolean()
                    ->state(fn (User $record): bool => $record->email_verified_at !== null),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime(),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
                Action::make('sendPasswordReset')
                    ->label('Send reset email')
                    ->action(function (User $record, AdminUserPasswordResetService $service): void {
                        $status = $service->send($record);

                        $notification = Notification::make()
                            ->title($status === Password::RESET_LINK_SENT ? 'Password reset email sent.' : __($status));

                        if ($status === Password::RESET_LINK_SENT) {
                            $notification->success();
                        } else {
                            $notification->danger();
                        }

                        $notification->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
