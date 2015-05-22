<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Role
 * @package App
 */
class Role extends Model
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
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
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
