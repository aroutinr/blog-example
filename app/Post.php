<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use MathieuTu\JsonSyncer\Contracts\JsonImportable;
use MathieuTu\JsonSyncer\Traits\JsonImporter;

class Post extends Model implements JsonImportable
{
    use JsonImporter;
    
	public const TITLE = 'Posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'publication_date',
        'category_id',
        'user_id'
    ];

    protected $appends = [
        'post_month_and_year',
        'post_year',
        'post_month'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function postsFilterByMonth()
    {
        return Post::select('id', 'publication_date')
            ->orderByDesc('publication_date')
            ->get()
            ->groupBy(function($post) {
                return Carbon::parse($post->publication_date)->format('m');
            })
            ->map(function($post) {
                return $post->first();
            })
        ;
    }

    public function getPostMonthAndYearAttribute()
    {
        return Carbon::parse($this->publication_date)->format('F Y');
    }

    public function getPostYearAttribute()
    {
        return Carbon::parse($this->publication_date)->format('Y');
    }

    public function getPostMonthAttribute()
    {
        return Carbon::parse($this->publication_date)->format('m');
    }
}
