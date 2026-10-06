<?php

namespace App\Observers;

use App\Models\AppSetting;
use Illuminate\Support\Facades\Storage;

class AppSettingObserver
{
    private const array FILE_COLUMNS = [
        'logo_url'    => ['disk' => 'public'],
        'favicon_url' => ['disk' => 'public']
    ];

    public function updated(AppSetting $appSetting): void
    {
        foreach (self::FILE_COLUMNS as $column => $options) {
            if ($appSetting->wasChanged($column) && $appSetting->getOriginal($column)) {
                Storage::disk($options['disk'])->delete($appSetting->getOriginal($column));
            }
        }
    }

    public function deleted(AppSetting $appSetting): void
    {
        foreach (self::FILE_COLUMNS as $column => $options) {
            if ($appSetting->{$column}) {
                Storage::disk($options['disk'])->delete($appSetting->{$column});
            }
        }
    }
}
