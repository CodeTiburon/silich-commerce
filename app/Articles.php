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
    public function scopePublished($query)
    {

        $query->where('published_at', '<=', Carbon::now());

    }

    public function scopeUnPublished($query)
    {

        $query->where('published_at', '>=', Carbon::now());

    }
    //before database insert
    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    public function user()
    {

        return $this->belongsTo('\App\Main_user');

    }

}
