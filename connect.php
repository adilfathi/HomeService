<?php
session_start();

$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = '';
$db_name = 'homeservice';
$connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if(mysqli_connect_errno()) {
  echo '<b>Database Error:</b> '.mysqli_connect_error();
  exit;
}