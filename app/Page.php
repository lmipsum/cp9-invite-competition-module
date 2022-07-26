<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'hash';
    }

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return HasMany
     */
    public function pageKeys(): HasMany
    {
        return $this->hasMany(PageKey::class);
    }

    /**
     * @return HasMany
     */
    public function pageTexts(): HasMany
    {
        return $this->hasMany(PageText::class);
    }

    /**
     * @return HasMany
     */
    public function pageSubmits(): HasMany
    {
        return $this->hasMany(PageSubmit::class);
    }
}
