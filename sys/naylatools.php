<?php
class database
{
  public function pdoDB($host = "localhost", $user = "root", $pwd = "naylatools", $db = "crud")
  {
    date_default_timezone_set("Asia/Bangkok");

    try {
      $kon = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
      $kon->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
      $kon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $kon->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      print "Koneksi atau query bermasalah: " . $e->getMessage() . "<br/>";
      die();
    }
    return $kon;
  }

  public function mysqliDB($host = "localhost", $user = "root", $pwd = "naylatools", $db = "crud")
  {
    date_default_timezone_set("Asia/Bangkok");

    $kon = mysqli_connect($host, $user, $pwd, $db);

    if (mysqli_connect_errno()) {
      echo "Koneksi atau query bermasalah: " . mysqli_connect_error();
      exit();
    }
    return $kon;
  }

  public function createDB($dbHost, $dbUsername, $dbPassword, $dbName, $filePath)
  {
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword);
    $sql = "CREATE DATABASE `$dbName` ";
    if ($conn->query($sql) === TRUE) {
      $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
      $templine = '';

      $lines = file($filePath);

      $error = '';

      foreach ($lines as $line) {
        if (substr($line, 0, 2) == '--' || $line == '') {
          continue;
        }

        $templine .= $line;

        if (substr(trim($line), -1, 1) == ';') {
          if (!$db->query($templine)) {
            $error .= 'Error performing query "<b>' . $templine . '</b>": ' . $db->error . '<br /><br />';
          }

          $templine = '';
        }
      }
      return !empty($error) ? $error : true;
    } else {
      echo "Error creating database: " . $conn->error;
    }

    $conn->close();
  }
}

class tampil
{
  public function tabel($sql, $opsi = false)
  {
    $kon = new database();
    $conn = $kon->pdoDB();
    if ($opsi != false) {
      print "<table class='table table-striped' id='tabel'>";
      print "<thead class='thead-dark'><tr>";
      $select = $conn->query($sql);
      $total_column = $select->columnCount();
      for ($counter = 0; $counter < $total_column; $counter++) {
        $meta = $select->getColumnMeta($counter);
        $column[] = $meta['name'];
      }
      foreach ($column as $th) {
        print "<th>$th</th>";
      }


      if (isset($opsi['menu'])) {
        print "<th>Opsi</th>";
      }

      print "</tr></thead><tbody>";
      $result = $select->fetchAll(\PDO::FETCH_ASSOC);
      foreach ($result as $td) {
        print "<tr id='25'>";
        foreach ($td as $hasil) {
          print "<td>$hasil</td>";
        }

        if (isset($opsi['menu'])) {
          print "<td>";
          foreach ($opsi['menu'] as $menu) {
            print $menu;
          }
          print "</td>";
        }
        print "</tr>";
      }
      print "</tr></tbody>";
      print "</table>";
      if (isset($opsi['datatable'])) {
        print "
            <script>$(document).ready(function() {
                $('#tabel').DataTable();
            } );
            </script>";
      }
    } else {
      print "<table class='table table-striped'>";
      print "<thead class='thead-dark'><tr>";
      $select = $conn->query($sql);
      $total_column = $select->columnCount();
      for ($counter = 0; $counter < $total_column; $counter++) {
        $meta = $select->getColumnMeta($counter);
        $column[] = $meta['name'];
      }
      foreach ($column as $th) {
        print "<th>$th</th>";
      }
      print "</tr></thead><tbody>";
      $result = $select->fetchAll(\PDO::FETCH_ASSOC);
      foreach ($result as $td) {
        print "<tr id='asd'>";
        foreach ($td as $hasil) {
          print "<td>$hasil</td>";
        }
        print "</tr>";
      }
      print "</tr></tbody>";
      print "</table>";
    }
  }

  public function pagination($cek = 50, $pg = 1, $batas = 10, $act = "index.php")
  { ?>
    <nav>
      <ul class="pagination">
        <?php $jml_data = $cek;
        $JmlHalaman = ceil($jml_data / $batas);
        if ($pg > 1) {
          $link = $pg - 1;
          $prev = "$link"; ?>
          <li onclick="pagination('<?php print $act; ?>','<?php echo $link; ?>');">
            <a href="#" aria-label="Previous"> <span aria-hidden="true">«</span> </a>
          </li>
        <?php } else {
          $prev = "#"; ?>
          <li onclick="pagination('<?php print $act; ?>','<?php echo $link; ?>');">
            <a href="#" aria-label="Previous" style="cursor: not-allowed;"> <span aria-hidden="true">«</span> </a>
          </li>
          <?php }
        $nmr = '';
        if ($pg > 9) {
          $awal = $pg;
        } else {
          $awal = 1;
        }
        if ($JmlHalaman > 10) {
          if ($pg > 9) {
            $akhir = $pg + 9;
          } else {
            $akhir = 10;
          }
        } else {
          $akhir = $JmlHalaman;
        }
        for ($i = $awal; $i <= $akhir; $i++) {
          if ($i == $pg) {
            $nmr = "#"; ?>
            <li onclick="pagination('<?php print $act; ?>','<?php echo $nmr; ?>');" class="active"><a href="#"><?php echo $i; ?></a>
            </li>
          <?php  } else {
            $nmr = "$i";  ?>
            <li onclick="pagination('<?php print $act; ?>','<?php echo $nmr; ?>');">
              <a href="#"><?php echo $i; ?></a>
            </li>
          <?php  }
        }
        if ($pg < $JmlHalaman) {
          $link = $pg + 1;
          $next = "$link"; ?>
          <li onclick="pagination('<?php print $act; ?>','<?php echo $next; ?>');">
            <a href="#" aria-label="Next"> <span aria-hidden="true">»</span> </a>
          </li>
        <?php } else {
          $next = "#"; ?>
          <li onclick="pagination('<?php print $act; ?>','<?php echo $next; ?>');">
            <a href="#" aria-label="Next" style="cursor: not-allowed;"> <span aria-hidden="true">»</span> </a>
          </li>
        <?php } ?>
      </ul>
    </nav>
<?php }
}

class naylatools
{
  // fungsi untuk extract base64
  public function ubah($file, $nama, $lokasi)
  {
    $img       = $file;
    $img      = str_replace('data:file/;base64,', '', $img);
    $img      = str_replace(' ', '+', $img);
    $data     = base64_decode($img);
    $file     = "$lokasi/$nama";
    $success  = file_put_contents($file, $data);
    return $success;
  }

  public function copyapp($dst, $file)
  {
    define('FILEPATH', "../assets/app/");
    define('TEST', "../../" . $dst);
    $za = new ZipArchive();
    $za->open(FILEPATH . $file);
    print_r($za);
    var_dump($za);

    for ($i = 0; $i < $za->numFiles; $i++) {
      echo "index : $i\n";
      $name = $za->statIndex($i)['name'];
      $size = $za->statIndex($i)['size'];
      $comp_size = $za->statIndex($i)['comp_size'];
      print_r($name . ' [ ' . $size . '>' . $comp_size . ']');
      $za->extractTo(TEST, $name);
    }
  }

  public function TampilBulan($date)
  {
    $bulan = substr($date, 5);
    $tahun = substr($date, 0, 4);
    if ($bulan == '01') {
      $hasil = "Januari $tahun";
    }
    if ($bulan == '02') {
      $hasil = "Februari $tahun";
    }
    if ($bulan == '03') {
      $hasil = "Maret $tahun";
    }
    if ($bulan == '04') {
      $hasil = "April $tahun";
    }
    if ($bulan == '05') {
      $hasil = "Mei $tahun";
    }
    if ($bulan == '06') {
      $hasil = "Juni $tahun";
    }
    if ($bulan == '07') {
      $hasil = "Juli $tahun";
    }
    if ($bulan == '08') {
      $hasil = "Agustus $tahun";
    }
    if ($bulan == '09') {
      $hasil = "September $tahun";
    }
    if ($bulan == '10') {
      $hasil = "Oktober $tahun";
    }
    if ($bulan == '11') {
      $hasil = "Novemer $tahun";
    }
    if ($bulan == '12') {
      $hasil = "Desember $tahun";
    }
    return $hasil;
  }

  //fungsi untuk merubah tanggal ke indonesia
  public function TanggalIndo($date)
  {
    if ($date == "0000-00-00" || $date == null) {
      return ($date);
    } else {
      $BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agust", "Sept", "Okt", "Nov", "Des");

      $tahun = substr($date, 2, 2);
      $bulan = substr($date, 5, 2);
      $tgl   = substr($date, 8, 2);

      $result = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
      return ($result);
    }
  }

  //fungsi untuk merubah nilai ke huruf
  public function penyebut($nilai)
  {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
      $temp = $this->penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
      $temp = $this->penyebut($nilai / 10) . " puluh" . $this->penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " seratus" . $this->penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = $this->penyebut($nilai / 100) . " ratus" . $this->penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " seribu" . $this->penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = $this->penyebut($nilai / 1000) . " ribu" . $this->penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = $this->penyebut($nilai / 1000000) . " juta" . $this->penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = $this->penyebut($nilai / 1000000000) . " milyar" . $this->penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = $this->penyebut($nilai / 1000000000000) . " trilyun" . $this->penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
  }

  public function terbilang($nilai)
  {
    if ($nilai < 0) {
      $hasil = "minus " . trim($this->penyebut($nilai));
    } else {
      $hasil = trim($this->penyebut($nilai));
    }
    return $hasil;
  }

  //fungsi untuk kirim notifikasi
  public function pesan($device, $pesan, $dari)
  {

    $registrationIds = $device;
    #prep the bundle
    $msg = array(
      'body'  => $pesan,
      'title' => $dari
    );

    $fields = array(
      'to'    => $registrationIds,
      'notification'  => $msg
    );


    $headers = array(
      'Authorization: key= AAAAUya0OJw:APA91bGTzUJ2JUfIFXILXUAkrSgS52NiAnjlkkLI0iZi759_KdUkByFZbUx635AevSBVSbstIn0_sK128bpWK0bGvbaGN6xhcYNYfTtHiAUJur0KId0HgKigGflg9pq1DTF5sb--5Xij',
      'Content-Type: application/json'
    );

    #Send Reponse To FireBase Server  
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);
    #Echo Result Of FireBase Server
    //echo $result;
  }
}

class satpam
{
  public function cekIP()
  {
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    if (getenv('HTTP_CLIENT_IP'))
      $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
      $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
      $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
      $ipaddress = getenv('REMOTE_ADDR');
    else
      $ipaddress = 'IP Tidak Dikenali';
    // print "IP : ".$ipaddress." Browser : ".$_SERVER['HTTP_USER_AGENT']." Sistem Operasi :".php_uname();
    return $ipaddress;
  }

  //insert log
  public function kegiatan($kegiatan, $keterangan, $status = "Berhasil")
  {
    $conn = new database();
    $kon = $conn->pdoDB();
    $id_user = $_COOKIE['id_admin_notaris'];
    $user = $_COOKIE['usr_admin_notaris'];
    $sekarang = date('Y-m-d H:i:s');
    $log = $kon->query('INSERT INTO dbmlog(Waktu, UserID, NamaUser, Kegiatan, Keterangan, StatusLog) VALUES ("' . $sekarang . '","' . $id_user . '","' . $user . '","' . htmlspecialchars($kegiatan) . '", "' . htmlspecialchars($keterangan) . '", "' . $status . '")');
    return $log;
  }

  public function akses($id, $lokasi, $akses)
  {
    $conn = new database();
    $kon = $conn->pdoDB();
    $sql = "SELECT count(*) FROM `dbmsetting` a LEFT JOIN master.`dbmmenu` b ON a.`Location` = b.`ID` WHERE a.`Access` = '$akses' AND a.`Location` = '$lokasi' AND a.`IdUser` = '$id' AND b.`StatusMenu` = 1";
    $cek = $kon->query($sql)->fetchColumn();
    return $cek;
    // return print $sql;
  }
}
?>