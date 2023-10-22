<?php
// error_reporting(-1);
// ini_set('display_startup_errors', 1);
// ini_set('display_errors', 1);
// define('__ROOT_PATH', dirname(dirname(__FILE__)));

define('__ROOT_PATH', dirname(dirname(__FILE__)));
require_once('./api/index.php');

$func = $_GET['func'] ?: null;

if (!$func || !function_exists($func)) {
  exit(0);
}

$result = call_user_func($func);
if (is_array($result)) {
  header('Content-type: application/json');
  echo json_encode($result);
} else if ($result) {
  echo $result;
}
