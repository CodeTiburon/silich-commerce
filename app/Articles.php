<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model {

	protected $fillable = [
        'title',
        'body',
        'published_at',
        'user_id' //temp
    ];

    protected $dates = ['published_at'];
    //after database insert

    /**
     * @param $query
     */
    public function scopePublished($query)
    {

        $query->where('published_at', '<=', Carbon::now());

    }

    /**
     * @param $query
     */

    public function scopeUnPublished($query)
    {

        $query->where('published_at', '>=', Carbon::now());

    }


    //before database insert
    /**
     * @param $date
     */

    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    /**
     * @param $date
     * @return Carbon
     */
    public function getPublishedAtAttribute($date)
    {
        return new Carbon($date);
    }

    /**
     * An article only has 1 user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user()
    {

        return $this->belongsTo('\App\Main_user');

    }

    /**
     * Get a tag that belongs to a user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function tags()
    {
        return $this->belongsToMany('App\Tags', 'article_tags', 'article_id')->withTimestamps();
    }

    /**
     * @return mixed
     */

    public function getTagListAttribute()
    {
        return $this->tags->lists('id');
    }
}
