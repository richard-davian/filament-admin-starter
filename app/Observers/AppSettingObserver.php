<?php

namespace App\Observers;

use App\Models\AppSetting;
use Illuminate\Support\Facades\Storage;

class AppSettingObserver
{
    private const array FILE_COLUMNS = ['logo_url', 'favicon_url'];

    public function updated(AppSetting $appSetting): void
    {
        foreach (self::FILE_COLUMNS as $column) {
            if ($appSetting->wasChanged($column) && $appSetting->getOriginal($column)) {
                Storage::disk('public')->delete($appSetting->getOriginal($column));
            }
        }
    }

    public function deleted(AppSetting $appSetting): void
    {
        foreach (self::FILE_COLUMNS as $column) {
            if ($appSetting->{$column}) {
                Storage::disk('public')->delete($appSetting->{$column});
            }
        }
    }
}
