<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prospectus extends Model
{
    use SoftDeletes;
    protected $table = 'prospectuses';
    protected $fillable = [
        'name','slug','image','prospectus','sub_details','status','order','created_by','updated_by',
    ];
    protected $dates = ['deleted_at'];
}
