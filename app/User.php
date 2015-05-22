<?php

namespace App;

use App\Http\View\Presenters\UserPresenter;
use App\Support\ModelTraits\HasSlug;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laracasts\Presenter\PresentableTrait;

/**
 * Class User
 * @package App
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword, HasSlug, PresentableTrait;

    //--------------------------------------------------------------------------
    // Configurations
    //--------------------------------------------------------------------------
    protected $presenter = UserPresenter::class;
    protected $fillable = ['slug', 'name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];


    //--------------------------------------------------------------------------
    // Accessors & Mutators
    //--------------------------------------------------------------------------


    //--------------------------------------------------------------------------
    // Relationships
    //--------------------------------------------------------------------------
    /**
     * @return BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }


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


    //--------------------------------------------------------------------------
    // Custom Pivot Table
    //--------------------------------------------------------------------------


    //--------------------------------------------------------------------------
    // Helpers
    //--------------------------------------------------------------------------
    /**
     * @param string       $resource
     * @param string|array $actions
     *
     * @return bool
     */
    public function can($resource, $actions)
    {
        $actions = is_array($actions) ? $actions : explode('|', $actions);

        $permissions = [];
        foreach ($this->role->permissions as $permission) {
            $permissions[$permission['resource']][] = $permission['action'];
        }

        $deny = array_filter($actions, function ($action) use ($permissions, $resource) {
            return ! isset($permissions[$resource]) || ! in_array($action, $permissions[$resource]);
        });

        return ! boolval($deny);
    }

    /**
     * @param string $role
     *
     * @return bool
     */
    public function is($role)
    {
        return $this->role->name === $role;
    }

    /**
     * @param string $id
     * @param array  $columns
     *
     * @return Model|null
     */
    public static function findByFacebookId($id, $columns = ['*'])
    {
        return static::facebookId($id)->first($columns);
    }

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
