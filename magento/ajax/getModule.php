<?php
require_once '../tools.php';
require_once '../conf.php';

$mods = getSubdirs($aProject[$_POST['path']]['path'] . 'app/code/local/' . $_POST['id'] . '/');

echo json_encode(array('modules' => $mods));