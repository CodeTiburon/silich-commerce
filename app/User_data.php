<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class User_data extends Model {

    protected $table = 'main_users';
	protected $fillable = [
        'name',
        'email'
    ];

}
