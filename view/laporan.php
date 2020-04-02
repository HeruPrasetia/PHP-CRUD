<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Home</a>
    </li>
    <li class="breadcrumb-item active">Laporan</li>
</ol>
<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive">
        <?php
            $bulan = date('m');
            $tahun = date('Y');
            include "../sys/naylatools.php";
            $tampil = new tampil();
            $tampil->tabel("SELECT a.tanggal AS Tanggal, sum(a.jumlah) as Pengeluaran, sum(b.jumlah) as Pemasukan FROM pengeluaran a, pemasukan b WHERE (MONTH(a.tanggal) = $bulan AND YEAR(a.tanggal) = '$tahun') AND (MONTH(b.tanggal) = $bulan AND YEAR(b.tanggal) = '$tahun') GROUP BY a.tanggal ");
        ?>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>