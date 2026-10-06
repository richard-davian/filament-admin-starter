<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    private const array FILE_COLUMNS = ['avatar_url' => ['disk' => 'public']];

    public function creating(User $user): void
    {
        $user->username ??= strstr((string) $user->email, '@', true) ?: null;
    }

    public function updated(User $user): void
    {
        foreach (self::FILE_COLUMNS as $column => $options) {
            if ($this->isGalleryAvatar($user->getOriginal($column))) continue;

            if ($user->wasChanged($column) && $user->getOriginal($column)) {
                Storage::disk($options['disk'])->delete($user->getOriginal($column));
            }
        }
    }

    public function deleted(User $user): void
    {
        foreach (self::FILE_COLUMNS as $column => $options) {
            if ($this->isGalleryAvatar($user->{$column})) continue;

            if ($user->{$column}) {
                Storage::disk($options['disk'])->delete($user->{$column});
            }
        }
    }

    private function isGalleryAvatar(?string $path): bool
    {
        return $path && str_starts_with($path, 'avatars/');
    }
}
