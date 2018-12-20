<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function can($ability, $arguments = array())
    {
        return !is_null($ability) && $this->checkPermission($ability);
    }

    protected function checkPermission($perm)
    {
        // echo "Checking permission:";

        // print_r($perm);

        //  exit(1);

        $permissions = $this->getAllPernissionsFormAllRoles();

        $permissionArray = is_array($perm) ? $perm : [$perm];

        return count(array_intersect($permissions, $permissionArray));
    }

    protected function getAllPernissionsFormAllRoles()
    {
        $permissionsArray = [];

        $permissions = $this->roles->load('permissions')->pluck('permissions')->toArray();

        return array_map('strtolower', array_unique(array_flatten(array_map(function ($permission) {

            return array_pluck($permission, 'permission_slug');

        }, $permissions))));
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
     */

    /**
     * Many-To-Many Relationship Method for accessing the User->roles
     *
     * @return QueryBuilder Object
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
