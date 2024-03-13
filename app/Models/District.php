<?php

namespace App\Models;

use App\Scopes\OrderByAscScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OrderByAscScope('name'));
    }

    public function division(){
        return $this->belongsTo(Division::class, 'division_id');
    }

}
