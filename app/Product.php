<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {


    protected $fillable = [
        'photo_id',
        'name',
        'description',
        'price',
    ];

    /**
     * Get photos associated with product
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    /**
     *  Get the categories associated with product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category','categories_products')->withTimestamps();
    }

}
