<?php

namespace App\Http\Controllers\Booking;

use Illuminate\Database\Eloquent\Model;

class PaymentProductDataModel extends Model
{
	protected $table = 'payment_product_data';
	protected $fillable = ['*'];
	private static $data=[];
	public $timestamps = false;

	static function store($ref_id="")
	{
		$row = self::where('ref_id', $ref_id)->first();
		if (null == $row) {
			$row = new static;
			$row->ref_id            = $ref_id;
		}
		//  Update
		$row->email_address         = self::$data['dataProd']['userPostData']['email'];
		$row->data_prod             = json_encode(self::$data['dataProd']);
		$row->type_prod             = self::$data['typeProd'];
		$row->body_mail_reserva     = self::$data['BodyMailReserva'];
		$row->body_mail_compra      = self::$data['BodyMailCompra'];
		$row->tpl_ok                = self::$data['TempateOk'];
		$row->fecha_reserva         = \DB::raw('CURRENT_TIMESTAMP');
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
