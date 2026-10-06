<?php

namespace App\Observers;

use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerObserver
{
    private const array FILE_COLUMNS = ['image_path' => ['disk' => 'public']];

    public function updated(Banner $banner): void
    {
        foreach (self::FILE_COLUMNS as $column => $options) {
            if ($banner->wasChanged($column) && $banner->getOriginal($column)) {
                Storage::disk($options['disk'])->delete($banner->getOriginal($column));
            }
        }
    }

    public function deleted(Banner $banner): void
    {
        foreach (self::FILE_COLUMNS as $column => $options) {
            if ($banner->{$column}) {
                Storage::disk($options['disk'])->delete($banner->{$column});
            }
        }
    }
}
