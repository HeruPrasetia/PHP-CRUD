<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Transaksi</a>
    </li>
    <li class="breadcrumb-item active">Pemasukan</li>
</ol>
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Data Pemasukan
        <button class="btn btn-primary" onclick="$('#tampilModal').load('modul/inputpemasukan.php');" data-toggle="modal" data-target="#exampleModal">Tambah Data</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <?php
            include "../sys/naylatools.php";
            $tampil = new tampil();
            $tampil->tabel("SELECT * FROM pemasukan");
        ?>
        </div>
        <script>
            function tes(){
                alert('hallo guys');
            }
        </script>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>