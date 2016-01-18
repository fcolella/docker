<?php

namespace App\Http\Controllers\Booking;

use Illuminate\Database\Eloquent\Model;

class PaymentGulliverDataModel extends Model
{
	protected $table = 'payment_gulliver_data';
	protected $fillable = ['*'];
	private static $data = [];
	public $timestamps = false;

	static function store($ref_id="")
	{
		$row = self::where('ref_id', $ref_id)->first();
		if (null == $row) {
			$row = new static;
			$row->ref_id            = $ref_id;
		}
		$row->gastos_HTL            = self::$data['gastos_HTL'];
		$row->fecha_reserva         = \DB::raw('CURRENT_TIMESTAMP');
		$row->payment_try           = self::$data['payment_try'];
		$row->email_reserva         = self::$data['email_reserva'];
		$row->analitycs_data        = self::$data['analitycs_data'];
		$row->confirm_data          = self::$data['confirm_data'];
		//  Update
		$row->save();
		//  Reset
		self::$data = [];
		return $row->id;
	}

	public static function setData($value)
	{
		self::$data = $value;
	}
}