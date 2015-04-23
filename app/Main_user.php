<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class Main_user extends Model implements AuthenticatableContract {

    use Authenticatable;

    protected $table = 'main_users';


	protected $fillable = ['name', 'email', 'password'];

    /**
     * A user can have many articles
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {

        return $this->hasMany('\App\Articles', 'user_id');

    }

    /**
     * Determine if the current user is admin
     * @return bool
     */
    public function isAdmin()
    {
        if(\Auth::user()->role == 'admin') {
            return true;
        }
        return false;
    }

    /**
     * View helper
     * @param $node
     * @return string
     */
    public function renderNode($node) {

        if( $node->isLeaf() ) {
            return '<li data-id="'. $node->id .'"">' . $node->name . '</li>';
        } else {
            $html = '<li data-id="'. $node->id .'"">' . $node->name;

            $html .= '<ul>';

            foreach($node->children as $child)
                $html .= $this->renderNode($child);

            $html .= '</ul>';

            $html .= '</li>';
        }

        return $html;
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
