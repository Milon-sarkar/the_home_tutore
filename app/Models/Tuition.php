<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tuition extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'interest_sub' => 'array', 'interest_medium' => 'array', 'weekly' => 'array', 'interest_time' => 'array', 'interest_class' => 'array', 'interest_gender' => 'array',
        'tclass' => 'array', 'gender' => 'array', 'subject_ids' => 'array', 'student_medium' => 'array'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function tuition_books()
    {
        return $this->hasMany(TuitionBook::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function medium()
    {
        return $this->belongsTo(Medium::class);
    }
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
    public function area()
    {
        return $this->belongsTo('App\Models\Area', 'area_id');
    }
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

    public function subjectjeson()
    {
        return $this->belongsToJson(Subject::class, 'interest_sub');
    }
    public function interest_subjectjeson()
    {
        return $this->belongsToJson(Subject::class, 'interest_sub');
    }
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

    public function student_mediumjeson()
    {
        return $this->belongsToJson(Medium::class, 'student_medium');
    }
    public function mediumjeson()
    {
        return $this->belongsToJson(Medium::class, 'interest_medium');
    }
    public function weekjeson()
    {
        return $this->belongsToJson(Weekly::class, 'weekly');
    }
    public function classjeson()
    {
        return $this->belongsToJson(Tclass::class, 'tclass');
    }

    public function timejeson()
    {
        return $this->belongsToJson(Timely::class, 'interest_time');
    }
    public function subject_idsjeson()
    {
        return $this->belongsToJson(Subject::class, 'subject_ids');
    }
    public function interest_classjeson()
    {
        return $this->belongsToJson(Tclass::class, 'interest_class');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'tuition_id');
    }
   

    public function payments()
    {
        return $this->hasMany(Payment::class, 'tuition_book_id'); // Update the foreign key here
    }
    // public function payment()
    // {
    //     return $this->hasMany(Payment::class, 'tuition_book_id');
    // }
    public function calculateTotalAmount()
    {
        // Sum the salaries from related tuition_books
        return $this->tuition_books->sum('salary');
    }

}
