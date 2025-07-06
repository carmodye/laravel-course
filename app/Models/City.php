<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['state_id', 'name'];

     public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }


}
