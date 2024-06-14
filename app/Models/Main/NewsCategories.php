<?php

namespace App\Models\Main;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCategories extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'news_categories';
    protected $fillable = [
        'name','slug','created_by','updated_by',
    ];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function newsEvents()
    {
        return $this->hasMany(NewsAndEvents::class, 'news_categories_id');
    }
    use HasFactory;
}
?>







