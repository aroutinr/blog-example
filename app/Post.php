<?php

namespace App;

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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
