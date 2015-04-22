<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class Main_user extends Model implements AuthenticatableContract {

    use Authenticatable;

    protected $table = 'main_users';

	protected $fillable = ['name', 'email', 'password'];

    public function articles()
    {

        return $this->hasMany('\App\Articles');

    }

    public function isAdmin()
    {
        if(\Auth::user()->role == 'admin') {
            return true;
        }
        return false;
    }
}


// in case there are many users

//    public function roles()
//    {
//        return $this->belongsToMany('App\Role', 'roles');
//    }
//
//    public function is($roleName)
//    {
//        foreach($this->roles()->get() as $role) {
//            if($role == $roleName) {
//                return true;
//            }
//        }
//
//        return false;
//    }
