<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumPackage extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

    protected $casts = ['selected_items' => 'array'];

    public function items(){
        return $this->belongsToJson(PremiumPackageIteme::class, 'selected_items');
    }
}
