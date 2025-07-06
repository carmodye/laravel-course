<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Model as EloquentModel;
class Model extends EloquentModel
{
    //
    public $timestamps = false;
protected $fillable = ['maker_id', 'name'];


public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
