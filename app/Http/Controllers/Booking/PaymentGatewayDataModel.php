<?php

namespace App\Http\Controllers\Booking;

use Illuminate\Database\Eloquent\Model;

class PaymentGatewayDataModel extends Model
{
	protected $table = 'payment_gateway_data';
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
		$row->noperacion            = self::$data['noperacion'];
        $row->rq_decidir            = self::$data['rq_decidir'];
        $row->moneda                = self::$data['moneda'];
        $row->cuotas                = self::$data['cuotas'];
        $row->monto                 = self::$data['monto'];
        $row->tarjeta               = self::$data['tarjeta'];
        $row->banco                 = self::$data['banco'];
        $row->sps                   = self::$data['sps'];
        $row->emailcomprador        = self::$data['emailcomprador'];
        $row->traffic               = self::$data['traffic'];
        $row->gastos_HTL            = self::$data['gastos_HTL'];
        $row->gastos_financieros    = self::$data['gastos_financieros'];
        $row->bonificacion          = self::$data['bonificacion'];
        $row->cargos_gestion        = self::$data['cargos_gestion'];
        $row->desc_cargos_gestion   = self::$data['desc_cargos_gestion'];
        $row->coef_descuento        = self::$data['coef_descuento'];
        $row->uatp                  = self::$data['uatp'];
        $row->cambio                = self::$data['cambio'];
        $row->fecha_pago            = self::$data['fecha_pago'];
        $row->rate                  = self::$data['rate'];
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