<?php
require_once '../tools.php';
require_once '../conf.php';

$mods = getSubdirs($aProject[$_POST['id']]['path'] . 'app/code/local/');

echo json_encode(array('namespaces' => $mods));
