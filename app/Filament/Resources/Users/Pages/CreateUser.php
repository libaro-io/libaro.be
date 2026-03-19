<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use App\Services\AdminUserPasswordResetService;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['is_admin'] = true;
        $data['password'] = Hash::make(Str::random(40));

        return $data;
    }

    protected function afterCreate(): void
    {
        /** @var User $user */
        $user = $this->getRecord();
        $status = app(AdminUserPasswordResetService::class)->send($user);

        $notification = Notification::make()
            ->title($status === Password::RESET_LINK_SENT ? 'Invite email sent.' : __($status));

        if ($status === Password::RESET_LINK_SENT) {
            $notification->success();
        } else {
            $notification->danger();
        }

        $notification->send();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    }
}
