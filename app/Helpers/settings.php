<?php

use App\Models\AppSetting;

if (! function_exists('appSettings')) {
    function appSettings(?string $key = null, mixed $default = null): mixed
    {
        static $settings = null;

        $settings ??= AppSetting::firstOrCreate(['id' => 1]);

        if ($key === null) {
            return $settings;
        }

        $value = $settings->getAttribute($key);

        return filled($value) ? $value : value($default);
    }
}
