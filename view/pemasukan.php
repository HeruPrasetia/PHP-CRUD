<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Transaksi</a>
    </li>
    <li class="breadcrumb-item active">Pemasukan</li>
</ol>
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Data Pemasukan
        <button class="btn btn-primary" onclick="$('#tampilModal').load('modul/inputpemasukan.php');" data-toggle="modal" data-target="#modal">Tambah Data</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Note</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include "../sys/naylatools.php";
                    $db = new database();
                    $koneksi = $db->pdoDB();
                    $no = 0;
                    $query = $koneksi->query("SELECT * FROM pemasukan");
                    while($data = $query->fetch()){
                    $no++;
                ?>
                    <tr>
                        <td><?php print $no; ?></td>
                        <td><?php print $data->tanggal; ?></td>
                        <td><?php print $data->jenis; ?></td>
                        <td><?php print $data->jumlah; ?></td>
                        <td><?php print $data->note; ?></td>
                        <td>
                            <button class="btn btn-warning" onclick="modal('modul/editpemasukan.php?id=<?php print $data->ID; ?>');" data-toggle="modal" data-target="#modal"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger" onclick="modal('modul/hapuspemasukan.php?id=<?php print $data->ID; ?>');" data-toggle="modal" data-target="#modal"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <script>
            function tes(){
                alert('hallo guys');
            }
        </script>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>