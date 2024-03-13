<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TuitionBook extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tutor(){
        return $this->belongsTo(Tutor::class);
    }
    public function tuition(){
        return $this->belongsTo(Tuition::class);
    }
    public function payment(){
        return $this->hasOne(Payment::class,'tuition_book_id');
    }
}
