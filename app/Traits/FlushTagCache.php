<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait FlushTagCache
{
    public static function bootFlushTagCache()
    {
        static::creating(fn() => Cache::tags(self::$tagsArr)->flush());
        static::updating(fn() => Cache::tags(self::$tagsArr)->flush());
        static::deleting(fn() => Cache::tags(self::$tagsArr)->flush());
    }
}
