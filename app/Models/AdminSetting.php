<?php

namespace App\Models;

use App\Traits\FlushTagCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class AdminSetting extends Model
{
    use HasFactory;

    use AsSource;
    use FlushTagCache;

    protected $guarded = [];
    public $tagsArr = [];

    public function setCacheTag(string $tag)
    {
        $this->tagsArr[] = $tag;
    }
}
