<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model {

    /**
     * Fillable fields
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get the article associated with a tag
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function article()
    {

        return $this->belongsToMany('App\Articles', 'article_tags','tags_id', 'article_id')->withTimestamps();

    }

}
