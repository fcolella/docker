<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Country;

class City extends Model
{
	protected $table = 'city';
	protected $primaryKey = 'code';
	public $timestamps = false;

	/**
	 * Get the Country record associated with the City.
	 */
	public function country()
	{
		return $this->belongsTo('App\Http\Models\Country', 'id_country', 'code');
	}
}