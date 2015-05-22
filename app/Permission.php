<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Permission
 * @package App
 */
class Permission extends Model
{

    //--------------------------------------------------------------------------
    // Configurations
    //--------------------------------------------------------------------------


    //--------------------------------------------------------------------------
    // Accessors & Mutators
    //--------------------------------------------------------------------------


    //--------------------------------------------------------------------------
    // Relationships
    //--------------------------------------------------------------------------
    /**
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
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