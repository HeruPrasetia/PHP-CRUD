<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Home</a>
    </li>
    <li class="breadcrumb-item active">Laporan</li>
</ol>
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Laporan
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <?php
            $bulan = date('m');
            $tahun = date('Y');
            $menu = [
                "edit" => "<li data-toggle='modal' data-target='#modal' onclick='tes();' style='cursor: pointer;'> <i class='fa fa-edit'></i> Edit</li>",
                "hapus" => "<li data-toggle='modal' data-target='#modal' onclick='alert(hapus);' style='cursor: pointer;'> <i class='fa fa-trash'></i> Hapus</li>",
            ];
            include "../sys/naylatools.php";
            $tampil = new tampil();
            $tampil->tabel("SELECT a.tanggal AS Tanggal, sum(a.jumlah) as Pengeluaran, sum(b.jumlah) as Pemasukan FROM pengeluaran a, pemasukan b WHERE (MONTH(a.tanggal) = $bulan AND YEAR(a.tanggal) = '$tahun') AND (MONTH(b.tanggal) = $bulan AND YEAR(b.tanggal) = '$tahun') GROUP BY a.tanggal ", false, true);
        ?>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>