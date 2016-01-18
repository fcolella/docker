<?php
return [
	'decode'            => true,        // Decode html entities in string?
	'decode_charset'    => 'UTF-8',     // Charset to use if $decode is set to true
	'lowercase'         => true,        // Turns string into all lowercase letters
	'strip'             => true,        // Strip out html tags from string?
	'maxlength'         => 50,          // Maximum length of resulting title
	'whole_word'        => true,        // If maxlength is reached, chop at nearest whole word? or hard chop?
	'blank'             => 'no-title',  // What title to use if no alphanumeric characters can be found
	'separator'         => '-',         // Allow a differnt character to be used as the separator.
	//	A table of UTF-8 characters and what to make them.
	'translation_table' => [
		'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj','Ð'=>'Dj','đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
		'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
		'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
		'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
		'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
		'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
		'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
		'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', 'ē'=>'e',
		','=>'-','.'=>'-',';'=>'-',
		/**
		 * Special characters:
		 */
		"'"    => '',       // Single quote
		'&'    => ' and ',  // Ampersand
		"\r\n" => ' ',      // Newline
		"\n"   => ' '       // Newline
	]
];