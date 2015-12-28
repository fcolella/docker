<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'region';
    public $timestamps = false;

	/**
	 * Get the countries for this Region.
	 */
	public function countries()
	{
		return $this->hasMany('App\Http\Models\Country', 'id_region');
	}
}