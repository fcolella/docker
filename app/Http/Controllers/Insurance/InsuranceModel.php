<?php

namespace App\Http\Controllers\Insurance;

use Illuminate\Database\Eloquent\Model;

class InsuranceModel extends Model
{
	protected $table = 'seguros_resultados';
	protected $fillable = ['*'];

	static function store($data)
	{
		$row = self::where('session', $data['session'])->where('plan_number', $data['plan_number'])->first();
		if (null == $row) {
			$row = new static;
			$row->forceFill($data);
			$row->save();
		}
		return $row;
	}
}
