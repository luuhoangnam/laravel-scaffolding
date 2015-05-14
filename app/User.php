<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword;

    //--------------------------------------------------------------------------
    // Configurations
    //--------------------------------------------------------------------------
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];


    //--------------------------------------------------------------------------
    // Accessors & Mutators
    //--------------------------------------------------------------------------


    //--------------------------------------------------------------------------
    // Relationships
    //--------------------------------------------------------------------------


    //--------------------------------------------------------------------------
    // Scopes
    //--------------------------------------------------------------------------


    //--------------------------------------------------------------------------
    // Custom Pivot Table
    //--------------------------------------------------------------------------


    //--------------------------------------------------------------------------
    // Helpers
    //--------------------------------------------------------------------------


}
