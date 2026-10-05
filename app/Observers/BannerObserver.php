<?php

namespace App\Observers;

use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerObserver
{
    private const array FILE_COLUMNS = ['image_path'];

    public function updated(Banner $banner): void
    {
        foreach (self::FILE_COLUMNS as $column) {
            if ($banner->wasChanged($column) && $banner->getOriginal($column)) {
                Storage::disk('public')->delete($banner->getOriginal($column));
            }
        }
    }

    public function deleted(Banner $banner): void
    {
        foreach (self::FILE_COLUMNS as $column) {
            if ($banner->{$column}) {
                Storage::disk('public')->delete($banner->{$column});
            }
        }
    }
}
