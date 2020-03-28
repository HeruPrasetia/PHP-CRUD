<?php
    include "../sys/db.php";
    $id     = $_GET['id'];
    $data   = $koneksi->query("SELECT * FROM Pemasukan WHERE ID = '$id'")->fetch();
?>
<form id="iniForm">
    <input type="hidden" name="act" value="editPemasukan">
    <input type="hidden" name="id" value="<?php print $id; ?>">
    <!-- Modal Header -->
    <div class="modal-header">
        <h4 class="modal-title">Edit Data Pemasukan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <!-- Modal body -->
    <div class="modal-body">
        <div class="form-group">
            <label>Jumlah Pemasukan</label>
            <input type="number" name="jumlah" class="form-control" value="<?php print $data->jumlah; ?>">
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="note" class="form-control"><?php print $data->note; ?></textarea>
        </div>
        <div class="form-group">
            <label>Jenis Pemasukan</label>
            <input type="text" name="jenis" class="form-control" value="<?php print $data->jenis; ?>">
        </div>
    </div>

    <!-- Modal footer -->
    <div class="modal-footer">
        <button type="button" id="tutupModal" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="button" id="simpan" class="btn btn-primary" onclick="proses();">Simpan</button>
    </div>
</form>
<script>
    function proses() {
        var valid = document.getElementById("iniForm").checkValidity();
        if (valid) {
            var data = $("#iniForm").serialize();
            event.preventDefault();
            $("#simpan").prop("disabled", true);

            $.ajax({
                url: "sys/crud.php",
                type: "POST",
                data: data,
                dataType: "JSON",
                async: true,
                cache: false,
                success: function(response) {
                    if (response.status == "Berhasil") {
                        $("#tampil").load("view/Pemasukan.php");
                        $("#tutupModal").click();
                        alert(response.pesan);
                    } else {
                        alert(response.pesan);
                        $("#simpan").prop("disabled", false);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert("ERROR : " + xhr.responseText);
                    $("#simpan").prop("disabled", false);
                }
            });
        }
    }
</script>