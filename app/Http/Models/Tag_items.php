<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Tag_items extends Model
{
    protected $table = 'tag_items';
    public $timestamps = false;

    /**
     * Get the Tag record associated with the Tag-Item relationship.
     */
    public function tag()
    {
        return $this->belongsTo('App\Http\Models\Tag', 'id_tag');
    }

    /**
     * Get the Product record associated with the Tag-Item relationship.
     * 1 - Offers
     * 2 - City
     * 3 - Country
     * 4 - Region
     */
    public function product()
    {
        //
    }

    /**
     * Get the Country record associated with the Tag-Item relationship.
     */
    public function country()
    {
        return $this->hasOne('App\Http\Models\Country', 'id_type');
    }

    /**
     * Get the City record associated with the Tag-Item relationship.
     */
    public function city()
    {
        return $this->hasOne('App\Http\Models\City', 'id_type');
    }

    /**
     * Get the Region record associated with the Tag-Item relationship.
     */
    public function region()
    {
        return $this->hasOne('App\Http\Models\Region', 'id_type');
    }

    /**
     * Get the Flight Offers record associated with the Tag-Item relationship.
     */
    public function flight_offers()
    {
        //return $this->hasOne('App\Http\Models\Products_cache', 'id_type');
    }
}