<?php

require __DIR__ . "/__fungsi.php";

if(isset($_GET["id"])) {
  if(hapusDistributor($_GET["id"]) > 0) {
    echo "<script>
            alert('Distributor berhasil dihapus!');
            document.location.href = 'list-distributor.php';
          </script>";
  } else {
    echo "<script>
            alert('Distributor gagal dihapus!');
            document.location.href = 'list-distributor.php';
          </script>";
  }
}