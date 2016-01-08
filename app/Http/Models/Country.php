<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\City;

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
        return $this->belongsTo('App\Http\Models\Region');
    }

	/**
	 * Get the Cities associated with the Country.
	 */
	public function cities()
	{
		return $this->hasMany('App\Http\Models\City', 'id_country');
	}
}
