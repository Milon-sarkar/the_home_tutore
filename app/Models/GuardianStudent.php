<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardianStudent extends Model
{
    use HasFactory;

    public function district(){
        return $this->belongsTo(District::class, 'district_id');
    }

    public function thana(){
        return $this->belongsTo(Thana::class, 'thana_id');
    }

    public function area(){
        return $this->belongsTo(Area::class, 'area_id');
    }
}
