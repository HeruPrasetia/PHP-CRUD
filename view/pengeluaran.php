<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Transaksi</a>
    </li>
    <li class="breadcrumb-item active">Pengeluaran</li>
</ol>
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Data Pengeluaran
        <button class="btn btn-primary" onclick="$('#tampilModal').load('modul/inputpengeluaran.php');" data-toggle="modal" data-target="#exampleModal">Tambah Data</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <?php
            $menu = [
                "edit" => '<button data-toggle="modal" data-target="#modal" onclick="edit()" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</button>',
                "hapus" => "<button data-toggle='modal' data-target='#modal' onclick='alert(hapus);' class='btn btn-danger'> <i class='fa fa-trash'></i> Hapus</button>",
            ];
            $opsi = [
                "menu" => $menu,#
                "nomer" => true
            ];
            include "../sys/naylatools.php";
            $tampil = new tampil();
            $tampil->tabel("SELECT * FROM pengeluaran", $opsi);
        ?>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>