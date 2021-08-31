<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait FlushTagCache
{
    public static function bootFlushCache()
    {
        static::creating(fn() => Cache::tags($this->tagsArr)->flush());
        static::updating(fn() => Cache::tags($this->tagsArr)->flush());
        static::deleting(fn() => Cache::tags($this->tagsArr)->flush());
    }
}
