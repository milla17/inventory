<?php

require __DIR__ . "/__fungsi.php";

if(isset($_GET["id"])) {
  if(hapusKategori($_GET["id"]) > 0) {
    echo "<script>
            alert('Kategori berhasil dihapus!');
            document.location.href = 'list-kategori.php';
          </script>";
  } else {
    echo "<script>
            alert('Kategori gagal dihapus!');
            document.location.href = 'list-kategori.php';
          </script>";
  }
}