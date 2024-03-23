<?php

require __DIR__ . "/__fungsi.php";
$arsip = lihatArsip($_GET["id"]);

if(!$arsip) {
  echo "<script>
          alert('Arsip tidak ditemukan!');
          document.location.href = 'list-arsip.php';
        </script>";
}

$hapus = hapusArsip($_GET["id"]);
if($hapus > 0) {
  echo "<script>
          alert('Arsip berhasil dihapus!');
          document.location.href = 'list-arsip.php';
        </script>";
} else {
  echo "<script>
          alert('Arsip gagal dihapus!');
          document.location.href = 'list-arsip.php';
        </script>";
}