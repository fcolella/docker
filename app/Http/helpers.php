<?php
/**
 * Created by PhpStorm.
 * User: gabrielvazquez
 * Date: 4/1/16
 * Time: 9:24
 *
 * composer dump-auto
 */

use App\Http\Controllers\Controller;

/**
 * Check if a given date is valid and is between a minimum and a maximum period of time
 * @param (string) $date	Date to validate in 'Y-m-d' format
 * @param (string) $min		minimum time period
 * @param (string) $max		maximum time period
 * @return (boolean)		true on success, false on error
 **/
function dateValidate($date="", $min='P1D', $max='P12M')
{
	//	Switch a date between formats
	$date = dateFormat($date, $format='Y-m-d');
	//	Check if we have a valid date
	$datetime = \DateTime::createFromFormat('Y-m-d', $date);
	if (!$date || ($datetime && $datetime->format('Y-m-d') != $date)) {
		return false;
	}
	//	Calculate minimum date from today
	$mindate = new \DateTime();
	$mindate = $mindate->add(new \DateInterval($min))->format('Y-m-d');
	//	Calculate maximum date from today
	$maxdate = new \DateTime();
	$maxdate = $maxdate->add(new \DateInterval($max))->format('Y-m-d');
	//	Check if the date is between minimum and maximum dates
	if ($date < $mindate) {
		return 'min';
	}
	if ($date > $maxdate) {
		return 'max';
	}
	return true;
}

/**
 * Switch a date between formats
 *
 * @param date $date	 ej. '2014-11-01'
 * @param date $format	 ej. d/m/Y
 **/
function dateFormat($date=false, $format='Y-m-d')
{
	if (false===$date) {
		return false;
	}
	if (true !== strpos($date, '/')) {
		$date = strtr($date, '/', '-');
	}
	try {
		$date = new \DateTime($date);
	} catch (\Exception $e) {
		return false;
	}
	return $date->format($format);
}

/**
 *
 * @param number $amount
 * @return string
 **/
function amountFormat($amount=0,$decimal_amount=null,$decimal_separator=null,$thousand_separator=null)
{
	if (is_null($decimal_amount)) {
		$decimal_amount = Controller::$settings['currency']['decimal_amount'];
	}
	if (is_null($decimal_separator)) {
		$decimal_separator = Controller::$settings['currency']['decimal_separator'];
	}
	if (is_null($thousand_separator)) {
		$thousand_separator = Controller::$settings['currency']['thousand_separator'];
	}
	return (string) number_format($amount, $decimal_amount, $decimal_separator, $thousand_separator);
}

/**
 * Método para imprimir preformateado
 * @param mixed $datos
 * @param bool $var_dump
 * @param bool $exit
 **/
function print_pre($data, $var_dump = false, $exit = true)
{
	if (!isset($data)) {
		print_r('The function print_pre() requires at least 1 parameter');
	}
	$var = ($var_dump) ? 'var_dump' : 'print_r';
	//	AJAX check
	if (\Illuminate\Support\Facades\Request::ajax()) {
		$var($data);
		$backtrace = debug_backtrace();
		$file = $backtrace[0]['file'];
		$line = $backtrace[0]['line'];
		echo "\nCalled from the file: {$file}, Line: {$line}\n";
		if ($exit) {
			exit('End.');
		}
	} else {
		echo ($var_dump) ? "" : '<pre>';
		$var($data);
		$backtrace = debug_backtrace();
		$file = $backtrace[0]['file'];
		$line = $backtrace[0]['line'];
		echo ($var_dump) ? "" : '</pre>';
		echo "Called from the file: {$file}, Line: {$line}<br><br>";
		if ($exit) {
			exit('<strong> End.</strong>');
		}
	}
}