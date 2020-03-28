<?php
include "db.php";
$act = $_POST['act'];
$now = date('Y-m-d');
switch($act){
    case 'inputPengeluaran':
        $note   = $_POST['note'];
        $jml    = $_POST['jumlah'];
        $jenis  = $_POST['jenis'];
        $insert = $koneksi->query("INSERT INTO pengeluaran (tanggal, jenis, note, jumlah) VALUES('$now', '$jenis', '$note', '$jml')");
        if($insert){
            $response = array(
                'status' => 'Berhasil',
                'pesan'  => 'Berhasil Menambah Data Pengeleuaran',
            );
        }else{
            $response = array(
                'status' => 'Gagal',
                'pesan'  => 'Gagal Menambah Data Pengeleuaran',
            );
        }
        print json_encode($response);
    break;

    case 'editPengeluaran':
        $id     = $_POST['id'];
        $note   = $_POST['note'];
        $jml    = $_POST['jumlah'];
        $jenis  = $_POST['jenis'];
        $edit   = $koneksi->query("UPDATE pengeluaran SET  jenis = '$jenis', note = '$note', jumlah = '$jml' WHERE ID = '$id'");
        if($edit){
            $response = array(
                'status' => 'Berhasil',
                'pesan'  => 'Berhasil Merubah Data Pengeleuaran',
            );
        }else{
            $response = array(
                'status' => 'Gagal',
                'pesan'  => 'Gagal Merubah Data Pengeleuaran',
            );
        }
        print json_encode($response);
    break;

    case 'hapusPengeluaran':
        $id = $_POST['id'];
        $delete = $koneksi->query("DELETE FROM pengeluaran WHERE ID = '$id'");
        if($delete){
            $response = array(
                'status' => 'Berhasil',
                'pesan'  => 'Berhasil Menghapus Data Pengeleuaran',
            );
        }else{
            $response = array(
                'status' => 'Gagal',
                'pesan'  => 'Gagal Menghapus Data Pengeleuaran',
            );
        }
        print json_encode($response);
    break;

    case 'inputPemasukan':
        $note   = $_POST['note'];
        $jml    = $_POST['jumlah'];
        $jenis  = $_POST['jenis'];
        $insert = $koneksi->query("INSERT INTO pemasukan (tanggal, jenis, note, jumlah) VALUES('$now', '$jenis', '$note', '$jml')");
        if($insert){
            $response = array(
                'status' => 'Berhasil',
                'pesan'  => 'Berhasil Menambah Data Pemasukan',
            );
        }else{
            $response = array(
                'status' => 'Gagal',
                'pesan'  => 'Gagal Menambah Data Pemasukan',
            );
        }
        print json_encode($response);
    break;

    case 'editPemasukan':
        $id     = $_POST['id'];
        $note   = $_POST['note'];
        $jml    = $_POST['jumlah'];
        $jenis  = $_POST['jenis'];
        $edit   = $koneksi->query("UPDATE pemasukan SET  jenis = '$jenis', note = '$note', jumlah = '$jml' WHERE ID = '$id'");
        if($edit){
            $response = array(
                'status' => 'Berhasil',
                'pesan'  => 'Berhasil Merubah Data Pemasukan',
            );
        }else{
            $response = array(
                'status' => 'Gagal',
                'pesan'  => 'Gagal Merubah Data Pemasukan',
            );
        }
        print json_encode($response);
    break;

    case 'hapusPemasukan':
        $id = $_POST['id'];
        $delete = $koneksi->query("DELETE FROM pemasukan WHERE ID = '$id'");
        if($delete){
            $response = array(
                'status' => 'Berhasil',
                'pesan'  => 'Berhasil Menghapus Data Pemasukan',
            );
        }else{
            $response = array(
                'status' => 'Gagal',
                'pesan'  => 'Gagal Menghapus Data Pemasukan',
            );
        }
        print json_encode($response);
    break;

    default:
        print "tidak ada perintah";
    break;
}