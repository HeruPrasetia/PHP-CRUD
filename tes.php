<?php
include 'sys/naylatools.php';
$db = new database();
$koneksi->pdoDB();
$tes = $koneksi->query("SELECt * FROM pengeluaran");
