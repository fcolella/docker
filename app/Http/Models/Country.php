<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country';
    protected $primaryKey = 'code';
    public $timestamps = false;

    /**
     * Get the Region record associated with the Country.
     */
    public function region()
    {
        return $this->hasOne('App\Http\Models\Region', 'id_region');
    }
}
