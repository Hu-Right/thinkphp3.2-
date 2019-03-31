<?php

$config = include ('config.php');
$config['LOAD_EXT_CONFIG'] = 'accounts_config,tixian_config,Bonus_config';
//$config['MODULE_ALLOW_LIST'] = 'Home,Mobile';

return $config;
