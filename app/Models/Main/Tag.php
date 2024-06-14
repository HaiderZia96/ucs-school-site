<?php

namespace App\Models\Main;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    protected $table = 'tags';
    protected $fillable = [
        'name','slug','created_by','updated_by'
    ];
    protected $dates = ['deleted_at'];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function newsEvents()
    {
        return $this->hasMany(NewsAndEvents::class, 'tags');
    }
    use HasFactory;
}

?>