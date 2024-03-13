<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Tutor extends Model
{
    use HasFactory;
    protected $casts = [
        'interest_sub' => 'array', 'interest_medium' => 'array', 'weekly' => 'array', 'interest_time' => 'array', 'interest_class' => 'array', 'interest_gender' => 'array',
        'tclass' => 'array', 'preferred_area_id' => 'array'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function book_tuitions()
    {
        return $this->hasMany(TuitionBook::class);
    }
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    public function subjectjeson()
    {
        return $this->belongsToJson(Subject::class, 'interest_sub');
    }
    public function mediumjeson()
    {
        return $this->belongsToJson(Medium::class, 'interest_medium');
    }
    public function timejeson()
    {
        return $this->belongsToJson(Timely::class, 'interest_time');
    }
    public function weekjeson()
    {
        return $this->belongsToJson(Weekly::class, 'weekly');
    }
    public function classjeson()
    {
        return $this->belongsToJson(Tclass::class, 'tclass');
    }
    public function interest_class()
    {
        return $this->belongsToJson(Tclass::class, 'interest_class');
    }


    public function areajeson()
    {
        return $this->belongsToJson(Area::class, 'preferred_area_id');
    }
    public function permanent_division()
    {
        return $this->belongsTo(Division::class, 'permanent_division_id');
    }
    public function permanent_district()
    {
        return $this->belongsTo(District::class, 'permanent_district_id');
    }
    public function permanent_upazila()
    {
        return $this->belongsTo(Upazila::class, 'permanent_upazila_id');
    }

    public function parent_division()
    {
        return $this->belongsTo(Division::class, 'parent_division_id');
    }
    public function parent_district()
    {
        return $this->belongsTo(District::class, 'parent_district_id');
    }
    public function parent_upazila()
    {
        return $this->belongsTo(Upazila::class, 'parent_upazila_id');
    }
    public function mediums()
    {
        return $this->hasMany(Medium::class);
    }
}
