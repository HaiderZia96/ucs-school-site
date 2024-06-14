<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicCalendar extends Model
{
    use SoftDeletes;
    protected $table = 'academic_calendars';
    protected $fillable = [
        'name','slug','image','calendar','sub_details','status','archived','order','created_by','updated_by',
    ];
    protected $dates = ['deleted_at'];
}
