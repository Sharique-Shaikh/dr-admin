<?php
session_start();

// $hostname = "localhost";
// $username = "root";
// $password = "";
// $db="dream";

$hostname = "localhost";
$username = "u886461235_dream";
$password = "Pass#@123";
$db="u886461235_dream";





$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$dsn = "mysql:host=$hostname;dbname=$db;charset=$charset";

try {
        $pdo = new PDO($dsn, $username, $password, $options);
    } 
    catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
  }
  
define('siteUrl', 'http://code.hybclient.com/dr-admin/');
$bodyClass_pagename = basename($_SERVER['REQUEST_URI'], ".php");


// $rootPath="/var/www/portal.dreamsredeveloped.com/assets/images/uploads";


function sanitize_data($data)
 {
  $data = trim($data);
  $data = stripslashes($data);
  $data = strip_tags($data);
  $data = htmlspecialchars($data);
  return $data;    
 }
 
//  function format_size($size) {
//       $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
//       if ($size == 0) { return('n/a'); } else {
//       return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]); }
// }
?> 