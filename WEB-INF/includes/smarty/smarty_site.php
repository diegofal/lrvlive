<?php
define('SMARTY_DIR','WEB-INF/includes/smarty/libs/');
require(SMARTY_DIR.'Smarty.class.php');
$smarty = new Smarty;
$smarty->compile_check = true;
$smarty->debugging = true;
$smarty->template_dir = 'WEB-INF/templates/site/';
$smarty->compile_dir = 'WEB-INF/includes/smarty/templates_c/site/';
$smarty->config_dir = 'WEB-INF/includes/smarty/configs/site/';
$smarty->cache_dir = 'WEB-INF/includes/smarty/cache/';
?>