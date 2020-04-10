<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $guarded = [];

    /**
     * Select image data by default.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('sliders', function (Builder $builder) {
            $builder->where('is_setting', false);
        });
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeSliderSettings($query)
    {
        return $query->where('is_setting', true);
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
