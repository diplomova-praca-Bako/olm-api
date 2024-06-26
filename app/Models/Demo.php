<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Demo extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;


    protected $fillable = [
        'name',
        'type',
        'device_type_id',
        'software_id',
        'note',
        'visible_preview'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];


    public function getDemoAttribute(): ?String
    {
        return isset($this->getMedia('demo')[0])
            ? $this->getMedia('demo')[0]->getFullUrl()
            : null;
    }

    // **************************** MEDIA **************************** //

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('demo')
            ->acceptsMimeTypes([
                'text/xml',
                'text/plain',
                'text/csv'
            ])
            ->singleFile();
    }

    // **************************** RELATIONS **************************** //

    public function deviceType(): BelongsTo
    {
        return $this->belongsTo(DeviceType::class);
    }

    public function software(): BelongsTo
    {
        return $this->belongsTo(Software::class);
    }

    public function userExperiments(): HasMany
    {
        return $this->hasMany(Experiment::class);
    }
}
