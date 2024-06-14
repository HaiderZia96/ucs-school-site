<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsAndEvents extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'news_and_events';
    protected $fillable = [
        'news_categories_id','tag','name','slug','thumbnail','cover_image','event_date','short_description','description','created_by','updated_by'
    ];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function newsCategories()
    {
        return $this->belongsTo(NewsCategories::class, 'news_categories_id');
    }
    public function tags()
    {
        return $this->belongsTo(Tag::class, 'tag');
    }
    use HasFactory;
}
