<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';
    public $timestamps = false;

	/**
	 * Get the product for this Tag.
	 */
	public function product()
	{
		return $this->hasOne('App\Http\Models\Product', 'id_product');
	}
}