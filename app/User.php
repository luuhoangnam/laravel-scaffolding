<?php

namespace App;

use App\Http\View\Presenters\UserPresenter;
use App\Support\ModelTraits\HasSlug;
use App\Support\ModelTraits\HttpTransformer;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

/**
 * Class User
 * @package App
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword, HasSlug, PresentableTrait, HttpTransformer;

    //--------------------------------------------------------------------------
    // Configurations
    //--------------------------------------------------------------------------
    protected $presenter = UserPresenter::class;
    protected $fillable = ['slug', 'name', 'email', 'avatar', 'bio', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['permissions' => 'array', 'searchable' => 'boolean'];


    //--------------------------------------------------------------------------
    // Accessors & Mutators
    //--------------------------------------------------------------------------
    /**
     * @return bool
     */
    public function getCanSearchAttribute()
    {
        $me = \Auth::user();

        return boolval($me instanceof User ? $me->can('manage_users') : false);
    }

    /**
     * @return bool
     */
    public function getCanRemoveAttribute()
    {
        $me = \Auth::user();

        return boolval($me instanceof User ? $me->can('manage_users') : false);
    }


    //--------------------------------------------------------------------------
    // Relationships
    //--------------------------------------------------------------------------


    //--------------------------------------------------------------------------
    // Scopes
    //--------------------------------------------------------------------------
    /**
     * @param Builder $query
     *
     * @param string  $id
     *
     * @return mixed
     */
    public function scopeFacebookId($query, $id)
    {
        return $query->where('facebook_id', '=', $id);
    }

    /**
     * @param Builder $query
     * @param string  $email
     *
     * @return mixed
     */
    public function scopeEmail($query, $email)
    {
        return $query->where('email', '=', $email);
    }

    //--------------------------------------------------------------------------
    // Custom Pivot Table
    //--------------------------------------------------------------------------


    //--------------------------------------------------------------------------
    // Helpers
    //--------------------------------------------------------------------------
    /**
     * @param array $permissions
     *
     * @return bool
     *
     */
    public function can($permissions = [])
    {
        $permissions = is_string($permissions) ? explode('|', $permissions) : $permissions;

        foreach ($permissions as $perm) {
            if ( ! in_array($perm, $this->permissions)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string $email
     * @param array  $columns
     *
     * @return Model|null
     */
    public static function findByEmail($email, $columns = ['*'])
    {
        return static::where('email', '=', $email)->first($columns);
    }

    /**
     * @param string $id
     * @param array  $columns
     *
     * @return Model|null
     */
    public static function findByFacebookId($id, $columns = ['*'])
    {
        return static::where('facebook_id', '=', $id)->first($columns);
    }

    //--------------------------------------------------------------------------
    // Scopes
    //--------------------------------------------------------------------------


    //--------------------------------------------------------------------------
    // Custom Pivot Table
    //--------------------------------------------------------------------------


    //--------------------------------------------------------------------------
    // API
    //--------------------------------------------------------------------------
    /**
     * @param array $fields
     *
     * @return array
     */
    public function toApi($fields = [])
    {
        if ( ! $fields)
            $fields = ['id', 'slug', 'name', 'email', 'avatar', 'created_at'];

        $result = [
            'id'          => $this['id'],
            'slug'        => $this['slug'],
            'name'        => $this['name'],
            'email'       => $this['email'],
            'avatar'      => $this['avatar'],
            'bio'         => $this['bio'],
            'permissions' => $this['permissions'],
            'created_at'  => $this['created_at']->toDatetimeString(),
            'updated_at'  => $this['updated_at']->toDatetimeString(),
            'can_remove'  => $this['can_remove'],
            'can_search'  => $this['can_search'],
        ];

        return array_only($result, $fields);
    }


    //--------------------------------------------------------------------------
    // Helpers
    //--------------------------------------------------------------------------


}
