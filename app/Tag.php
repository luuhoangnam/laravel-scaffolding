<?php

namespace App;

use App\Http\View\Presenters\TagPresenter;
use App\Support\ModelTraits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

/**
 * Class Tag
 * @package App
 */
class Tag extends Model
{
    use HasSlug, PresentableTrait;

    //--------------------------------------------------------------------------
    // Configurations
    //--------------------------------------------------------------------------
    protected $presenter = TagPresenter::class;
    protected $fillable = ['slug', 'name'];


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
