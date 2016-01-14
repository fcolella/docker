<?php
/**
$include_path 			= '../';
require_once( $include_path . 'includes/init.php' );
$smarty->template_dir 	= "../templates/mobile";
$smarty->compile_dir 	= "../templates_c";

$bancos = $db->getAll('SELECT * FROM promos_bancos JOIN listado_bancos ON listado_bancos.id = promos_bancos.banco WHERE promos_bancos.online = 1   ORDER BY orden ASC');



$smarty->assign('bancos', $bancos);
$smarty->display('promo-bancos-mobile.tpl');
**/