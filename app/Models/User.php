<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\UploadedFile;
use Orchid\Attachment\File;
use Orchid\Attachment\Models\Attachment;
use Orchid\Platform\Models\User as Authenticatable;
use Orchid\Attachment\Attachable;
use App\Traits\FlushTagCache;

class User extends Authenticatable

{
    use Attachable, FlushTagCache;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
        'phone',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'permissions',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    public function comparedProduct(): HasMany
    {
        return $this->hasMany(ComparedProduct::class);
    }

    public function avatar(): HasOne
    {
        return $this->hasOne(Attachment::class)->withDefault();
    }

    public function addAvatar(UploadedFile $file): void
    {
        $this->avatar()->delete();
        $file = new File($file);
        $attachment = $file->load();
        $this->attachment()->sync($attachment);
    }

    public function reviews(): hasMany
    {
        return  $this->hasMany(Review::class);
    }
}
