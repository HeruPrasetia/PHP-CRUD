<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"> </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css"/>
    <script type="text/javascript" src="assets/js/datatables.min.js"></script>
    <title>Aplikasi Keuangan</title>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<?php
include "sys/naylatools.php";
$menu = [
  "edit" => "<input value='uvuv' id='sadsad' type='button' value='button' class='menu' onclick='getId(this)'>",
];
$opsi = [
  "menu" => $menu
];
$tampil = new tampil();
$tampil->tabel("SELECT * FROM pengeluaran", $opsi);
?>
<script>
  function getId(id) {
    alert($(id).closest('tr').prop('id'));
  }
</script>