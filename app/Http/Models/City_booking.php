<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class City_booking extends Model
{
    protected $table = 'bkg_city';
    public $timestamps = false;

	/**
	 * Get the Country record associated with the City.
	 */
	public function country()
	{
		return $this->hasOne('App\Http\Models\Country', 'country');
	}
}
