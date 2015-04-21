<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class Main_user extends Model implements AuthenticatableContract {

    use Authenticatable;

    protected $table = 'main_users';

	protected $fillable = ['name', 'email', 'password'];

}
