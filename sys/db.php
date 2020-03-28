<?php
$server   = "localhost";
$username = "root";
$password = "Minervatt";
$db       = "crud";
try {
   $koneksi = new PDO("mysql:host=$server;dbname=$db", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
   $koneksi->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
   $koneksi->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 
   }
catch (PDOException $e) {
   print "Koneksi atau query bermasalah: " . $e->getMessage() . "<br/>";
   die();
}
?>