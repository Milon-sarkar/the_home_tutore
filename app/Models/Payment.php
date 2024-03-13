<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function tutor_book(){
        return $this->belongsTo(TuitionBook::class,'tuition_book_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
