<?php

require __DIR__ . "/__koneksi.php";

// deskripsi fungsi
// digunakan untuk registrasi
// return integer
function register ($data) {
  global $koneksi;

  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($koneksi, $data["password"]);
  $password_konfirmasi = mysqli_real_escape_string($koneksi, $data["password_konfirmasi"]);
  
  $nama_lengkap = mysqli_real_escape_string($koneksi, $data["nama_lengkap"]);

  $result = mysqli_query($koneksi, "SELECT username FROM admins WHERE username = '$username'");

  if (mysqli_fetch_assoc($result)) {
    echo "<script>
            alert('Username sudah terdaftar!');
          </script>";
    return false;
  }

  if ($password !== $password_konfirmasi) {
    echo "<script>
            alert('Konfirmasi password tidak sesuai!');
          </script>";
    return false;
  }

  $password = password_hash($password, PASSWORD_DEFAULT);

  mysqli_query($koneksi, "INSERT INTO admins VALUES ('', '$nama_lengkap', '$username', '$password')");

  return mysqli_affected_rows($koneksi);
}

// deskripsi fungsi
// digunakan untuk login
// return boolean
function login ($username, $password) {
  global $koneksi;

  $query = "SELECT * FROM admins WHERE username = '$username'";
  $result = mysqli_query($koneksi, $query);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {
      $_SESSION["login"] = true;
      
      $_SESSION["id"] = $row["id"];
      $_SESSION["username"] = $row["username"];
      $_SESSION["full_name"] = $row["full_name"];
      
      return true;
    } else {
      return false;
    }
  }
} 

function daftarDistributor () {
  global $koneksi;

  $query = "SELECT * FROM distributors";
  $result = mysqli_query($koneksi, $query);

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}


function tambahDistributor($data) {
  global $koneksi;

  $nama = mysqli_real_escape_string($koneksi, $data["name"]);
  $alamat = mysqli_real_escape_string($koneksi, $data["address"]);
  $telepon = mysqli_real_escape_string($koneksi, $data["phone"]);

  mysqli_query($koneksi, "INSERT INTO distributors VALUES ('', '$nama', '$alamat', '$telepon')");

  return mysqli_affected_rows($koneksi);
}

function ubahDistributor($distributor_id, $data) {
  global $koneksi;

  $nama = mysqli_real_escape_string($koneksi, $data["name"]);
  $alamat = mysqli_real_escape_string($koneksi, $data["address"]);
  $telepon = mysqli_real_escape_string($koneksi, $data["phone"]);

  mysqli_query($koneksi, "UPDATE distributors SET name = '$nama', address = '$alamat', phone = '$telepon' WHERE id = $distributor_id");

  return mysqli_affected_rows($koneksi);
}

function lihatDistributor ($distributor_id) {
  global $koneksi;

  $distributor = mysqli_query($koneksi, "SELECT * FROM distributors WHERE id = $distributor_id");

  if (mysqli_num_rows($distributor) == 0) {
    echo "<script>
            alert('Distributor tidak ditemukan!');
          </script>";

    return false;
  }

  return mysqli_fetch_assoc($distributor);
}

function hapusDistributor($distributor_id) {
  global $koneksi;

  $distributor = mysqli_query($koneksi, "SELECT * FROM distributors WHERE id = $distributor_id");

  if (mysqli_num_rows($distributor) == 0) {
    echo "<script>
            alert('Distributor tidak ditemukan!');
          </script>";
    return false;
  }

  mysqli_query($koneksi, "DELETE FROM distributors WHERE id = $distributor_id");

  return mysqli_affected_rows($koneksi);
}

// deskripsi fungsi
// digunakan untuk mendapatkan daftar kategori
// return array
function daftarKategori () {
  global $koneksi;

  $query = "SELECT * FROM categories";
  $result = mysqli_query($koneksi, $query);

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

// deskripsi fungsi
// digunakan untuk menambahkan kategori
// return integer

function tambahKategori($kategori) {
  global $koneksi;

  $kode = mysqli_real_escape_string($koneksi, $kategori["kode"]);
  $nama = mysqli_real_escape_string($koneksi, $kategori["nama"]);

  $cek_kategori = mysqli_query($koneksi, "SELECT * FROM categories WHERE name = '$nama' OR code = '$kode'");
  if (mysqli_fetch_assoc($cek_kategori)) {
    echo "<script>
            alert('Kategori sudah ada!');
          </script>";
    return false;
  }
  
  mysqli_query($koneksi, "INSERT INTO categories VALUES ('', '$kode', '$nama')");

  return mysqli_affected_rows($koneksi);
}

// deskripsi fungsi
// digunakan untuk melihat kategori
// return array
function lihatKategori ($kategori_id) {
  global $koneksi;

  $kategori = mysqli_query($koneksi, "SELECT * FROM categories WHERE id = $kategori_id");

  if (mysqli_num_rows($kategori) == 0) {
    echo "<script>
            alert('Kategori tidak ditemukan!');
          </script>";

    return false;
  }

  return mysqli_fetch_assoc($kategori);
}

// deskripsi fungsi
// digunakan untuk mengubah kategori
// return integer
function ubahKategori($kategori_id, $kategori) {
  global $koneksi;

  $kategori = mysqli_real_escape_string($koneksi, $kategori["nama"]);

  $cek_kategori = mysqli_query($koneksi, "SELECT * FROM categories WHERE name = '$kategori'");
  if (mysqli_fetch_assoc($cek_kategori)) {
    echo "<script>
            alert('Kategori sudah ada!');
          </script>";
    return false;
  }
  
  mysqli_query($koneksi, "UPDATE categories SET name = '$kategori' WHERE id = $kategori_id");

  return mysqli_affected_rows($koneksi);
}

// deskripsi fungsi
// digunakan untuk menghapus kategori
// return integer
function hapusKategori($kategori_id) {
  global $koneksi;

  $kategori = mysqli_query($koneksi, "SELECT * FROM categories WHERE id = $kategori_id");

  if (mysqli_num_rows($kategori) == 0) {
    echo "<script>
            alert('Kategori tidak ditemukan!');
          </script>";
    return false;
  }

  mysqli_query($koneksi, "DELETE FROM categories WHERE id = $kategori_id");

  return mysqli_affected_rows($koneksi);
}

function getTotalProduksi($kategori_id) {
  global $koneksi;

  $query = "SELECT SUM(quantity) AS total FROM items WHERE category_id = $kategori_id AND type = 'HASIL_PRODUKSI'";
  $result = mysqli_query($koneksi, $query);
  $row = mysqli_fetch_assoc($result);

  return $row["total"];
}

function getTotalBarangKeluar($kategori_id) {
  global $koneksi;

  $query = "SELECT SUM(quantity) AS total FROM items WHERE category_id = $kategori_id AND type = 'BARANG_KELUAR'";
  $result = mysqli_query($koneksi, $query);
  $row = mysqli_fetch_assoc($result);

  return $row["total"];
}

function tampilkanGrafikDasbor() {
  $categories = daftarKategori();

  $returnArray = [
    'kategori' => array_map(function($category) {
      $id_kategori = $category['id'];
      $total_produksi = getTotalProduksi($id_kategori);
      $total_barang_keluar = getTotalBarangKeluar($id_kategori);
      $stock = $total_produksi - $total_barang_keluar;

      return [
        'nama' => $category['name'],
        'total_produksi' => $total_produksi,
        'total_barang_keluar' => $total_barang_keluar,
        'stok' => $stock
      ];
    }, $categories),
  ];

  return json_encode($returnArray, true);
}

// deskripsi fungsi
// digunakan untuk mendapatkan daftar arsip
// return array
function daftarArsip($page = 1, $limit = 10, $search = "") {
  global $koneksi;
  
  $offset = ($page - 1) * $limit;

  $searchQuery = "";
  if (!empty($search)) {
    $searchQuery = " AND (categories.code LIKE '%" . $search . "%' OR categories.name LIKE '%" . $search . "%' OR items.quantity LIKE '%" . $search . "%' OR DATE(items.created_at) LIKE '%" . $search . "%' OR (distributors.name LIKE '%" . $search . "%' AND items.type = 'BARANG_KELUAR'))";
  }

  $query = "SELECT items.*, categories.id AS category_id, categories.name AS category_name, categories.code AS category_code, distributors.name AS distributor_name, distributors.address AS distributor_address, distributors.phone AS distributor_phone FROM items 
  JOIN categories ON items.category_id = categories.id
  LEFT JOIN distributors ON items.distributor_id = distributors.id
  WHERE 1" . $searchQuery . "
  ORDER BY items.created_at DESC
  LIMIT " . $limit . " OFFSET " . $offset;

  $result = mysqli_query($koneksi, $query);

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function jumlahArsip($search = "") {
  global $koneksi;

  $query = "SELECT COUNT(*) AS total FROM items
            JOIN categories ON items.category_id = categories.id
            LEFT JOIN distributors ON items.distributor_id = distributors.id
                  WHERE categories.code LIKE '%$search%' OR categories.name LIKE '%$search%' OR items.quantity LIKE '%$search%' OR DATE(items.created_at) LIKE '%$search%' OR items.type LIKE '%$search%' OR distributors.name LIKE '%$search%'";
              $result = mysqli_query($koneksi, $query);
  $row = mysqli_fetch_assoc($result);

  return $row["total"];
}

function jumlahDistributor ($search = "") {
  global $koneksi;

  $query = "SELECT COUNT(*) AS total FROM distributors WHERE name LIKE '%$search%' OR address LIKE '%$search%' OR phone LIKE '%$search%'";
  $result = mysqli_query($koneksi, $query);
  $row = mysqli_fetch_assoc($result);

  return $row["total"];
}

function daftarSemuaLaporan($type = null, $distributor_id = null, $date_start = null, $date_end = null) {
  global $koneksi;

  $query = "SELECT 
              DATE(items.created_at) AS waktu_produksi,
              categories.code AS kode,
              categories.name AS kategori,
              distributors.name AS distributor,
              items.type AS jenis_barang,
              CASE WHEN items.type = 'HASIL_PRODUKSI' THEN items.quantity ELSE 0 END AS hasil_produksi,
              CASE WHEN items.type = 'BARANG_KELUAR' THEN items.quantity ELSE 0 END AS barang_keluar
            FROM items
            JOIN categories ON items.category_id = categories.id
            LEFT JOIN distributors ON items.distributor_id = distributors.id";

  $conditions = [];

  if ($type !== null && $type !== "") {
    if ($type === "BARANG_KELUAR") {
      $conditions[] = "items.type = '$type'";
    } else {
      $conditions[] = "items.type = '$type'";
    }
  }

  if ($distributor_id !== null && $distributor_id !== "") {
    $conditions[] = "items.distributor_id = '$distributor_id'";
  }

  if ($date_start !== null && $date_start !== "") {
    $conditions[] = "DATE(items.created_at) >= '$date_start'";
  }

  if ($date_end !== null && $date_end !== "") {
    $conditions[] = "DATE(items.created_at) <= '$date_end'";
  }

  if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
  }

  $query .= " ORDER BY DATE(items.created_at)";

  $result = mysqli_query($koneksi, $query);

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

// deskripsi fungsi
// digunakan untuk menambahkan arsip
// return integer
function daftarLaporan($kategori_id, $type = null, $distributor_id = null, $date_start = null, $date_end = null) {
  global $koneksi;

  $query = "SELECT 
              DATE(items.created_at) AS waktu_produksi,
              categories.code AS kode,
              categories.name AS kategori,
              distributors.name AS distributor,
              items.type AS jenis_barang,
              items.quantity AS hasil_produksi,
              items.type AS barang_keluar
            FROM items
            JOIN categories ON items.category_id = categories.id
            LEFT JOIN distributors ON items.distributor_id = distributors.id
            WHERE items.category_id = '$kategori_id'";

  if ($type !== null && $type !== "") {
    if ($type === "BARANG_KELUAR") {
      $query .= " AND (items.type = '$type' OR items.type = 'HASIL_PRODUKSI')";
    } else {
      $query .= " AND items.type = '$type'";
    }
  }

  if ($distributor_id !== null && $distributor_id !== "") {
    if ($distributor_id === "NULL") {
      $query .= " AND items.distributor_id IS NULL";
    } else {
      $query .= " AND items.distributor_id = '$distributor_id'";
    }
  }

  if ($date_start !== null && $date_end !== null && $date_start !== "" && $date_end !== "") {
    $date_start = date('Y-m-d', strtotime($date_start));
    $date_end = date('Y-m-d', strtotime($date_end));
    $query .= " AND DATE(items.created_at) BETWEEN '$date_start' AND '$date_end'";
  }

  $query .= " ORDER BY waktu_produksi";

  $result = mysqli_query($koneksi, $query);

  $rows = [];
  $accumulatedTotalItems = 0;

  while ($row = mysqli_fetch_assoc($result)) {
    // Menambahkan total barang ke dalam array
    $row['barang_keluar'] = ($row['jenis_barang'] == 'BARANG_KELUAR' ? $row['hasil_produksi'] : 0);
    $row['hasil_produksi'] = ($row['jenis_barang'] == 'HASIL_PRODUKSI' ? $row['hasil_produksi'] : 0);
    
    $total_barang = $row['hasil_produksi'] - $row['barang_keluar'];
    $row['total_barang'] = $total_barang;
    // Menghitung akumulasi total barang
    $accumulatedTotalItems += $total_barang;
    $row['akumulasi_total_barang'] = $accumulatedTotalItems;

    // Menambahkan baris ke dalam array
    $rows[] = $row;
  }

  mysqli_free_result($result);

  return $rows;
}

// deskripsi fungsi
// digunakan untuk menambahkan arsip
// return integer
function tambahArsip($data) {
  global $koneksi;

  $admin_id = $_SESSION["id"];

  $kategori_id = mysqli_real_escape_string($koneksi, $data["kategori_id"]);

  $kategori = mysqli_query($koneksi, "SELECT * FROM categories WHERE id = $kategori_id");

  if (mysqli_num_rows($kategori) == 0) {
    echo "<script>
            alert('Kategori tidak ditemukan!');
          </script>";
    return false;
  }

  $distributor_id = isset($data["distributor_id"]) ? mysqli_real_escape_string($koneksi, $data["distributor_id"]) : null;

  if ($distributor_id !== null) {
    $distributor = mysqli_query($koneksi, "SELECT * FROM distributors WHERE id = $distributor_id");

    if (mysqli_num_rows($distributor) == 0) {
      echo "<script>
              alert('Distributor tidak ditemukan!');
            </script>";
      return false;
    }
  }
  
  $jumlah = mysqli_real_escape_string($koneksi, $data["jumlah"]);
  $tipe = mysqli_real_escape_string($koneksi, $data["tipe"]);
  $tanggal = mysqli_real_escape_string($koneksi, $data["tanggal"]);

  $query = "INSERT INTO items VALUES ('', '$kategori_id'";

  if ($distributor_id !== null) {
    $query .= ", '$distributor_id'";
  } else {
    $query .= ", null";
  }

  $query .= ", '$jumlah', '$tipe', '$admin_id', '$tanggal', NOW())";
  mysqli_query($koneksi, $query);

  if (mysqli_affected_rows($koneksi) == 0) {
    return false;
  }

  return mysqli_affected_rows($koneksi);
}

// deskripsi fungsi
// digunakan untuk melihat arsip
// return array
function lihatArsip ($arsip_id) {
  global $koneksi;

  $arsip = mysqli_query($koneksi, "SELECT * FROM items WHERE id = $arsip_id");

  if (mysqli_num_rows($arsip) == 0) {
    echo "<script>
            alert('Arsip tidak ditemukan!');
          </script>";

    return false;
  }

  return mysqli_fetch_assoc($arsip);
}

// deskripsi fungsi
// digunakan untuk mengubah arsip
// return integer
function ubahArsip($arsip_id, $data) {
  global $koneksi;

  $admin_id = $_SESSION["id"];

  $kategori_id = mysqli_real_escape_string($koneksi, $data["kategori_id"]);

  $kategori = mysqli_query($koneksi, "SELECT * FROM categories WHERE id = $kategori_id");

  if (mysqli_num_rows($kategori) == 0) {
    echo "<script>
            alert('Kategori tidak ditemukan!');
          </script>";
    return false;
  }

  $jumlah = mysqli_real_escape_string($koneksi, $data["jumlah"]);
  $tipe = mysqli_real_escape_string($koneksi, $data["tipe"]);
  $tanggal = mysqli_real_escape_string($koneksi, $data["tanggal"]);

  $query = "UPDATE items SET category_id = '$kategori_id', 
  quantity = '$jumlah', 
  type = '$tipe', 
  created_by = '$admin_id', 
  created_at = '$tanggal', 
  updated_at = NOW() 
  WHERE id = $arsip_id";

  mysqli_query($koneksi, $query);

  if(mysqli_affected_rows($koneksi) == 0) {
    echo "<script>
            alert('Arsip gagal diubah!');
          </script>";
    return false;
  }

  return mysqli_affected_rows($koneksi);
}

// deskripsi fungsi
// digunakan untuk menghapus arsip
// return integer
function hapusArsip($arsip_id) {
  global $koneksi;

  $arsip = mysqli_query($koneksi, "SELECT * FROM items WHERE id = $arsip_id");

  if (mysqli_num_rows($arsip) == 0) {
    echo "<script>
            alert('Arsip tidak ditemukan!');
          </script>";
    return false;
  }

  mysqli_query($koneksi, "DELETE FROM items WHERE id = $arsip_id");

  return mysqli_affected_rows($koneksi);
}

function tampilHari($hari) {
  $hari = date("l", strtotime($hari));
  $daftar_hari = [
    "Sunday" => "Minggu",
    "Monday" => "Senin",
    "Tuesday" => "Selasa",
    "Wednesday" => "Rabu",
    "Thursday" => "Kamis",
    "Friday" => "Jumat",
    "Saturday" => "Sabtu"
  ];
  
  if (array_key_exists($hari, $daftar_hari)) {
    return $daftar_hari[$hari];
  }
  
  return "Hari tidak ditemukan";
}

function tampilBulan($bulan) {
  $bulan = date("F", strtotime($bulan));
  $daftar_bulan = [
    "January" => "Januari",
    "February" => "Februari",
    "March" => "Maret",
    "April" => "April",
    "May" => "Mei",
    "June" => "Juni",
    "July" => "Juli",
    "August" => "Agustus",
    "September" => "September",
    "October" => "Oktober",
    "November" => "November",
    "December" => "Desember"
  ];
  
  if (array_key_exists($bulan, $daftar_bulan)) {
    return $daftar_bulan[$bulan];
  }
  
  return "Bulan tidak ditemukan";
}

function ubahProfil($data) {
  global $koneksi, $akun;

  $full_name = $data['full_name'];
  $username = $akun["username"];

  $query = "UPDATE admins SET full_name = '$full_name' WHERE username = '$username'";
  mysqli_query($koneksi, $query);

  return mysqli_affected_rows($koneksi);
}

function ambilAkun($username) {
  global $koneksi;

  $query = "SELECT * FROM admins WHERE username = '$username'";
  $result = mysqli_query($koneksi, $query);

  return mysqli_fetch_assoc($result);
}

function ubahPassword($data) {
  global $koneksi, $akun;

  $username = $akun["username"];
  $password_baru = $data['password_baru'];
  $password_lama = $data['password_lama'];

  $query = "SELECT * FROM admins WHERE username = '$username'";
  $result = mysqli_query($koneksi, $query);
  $row = mysqli_fetch_assoc($result);

  if (!password_verify($password_lama, $row["password"])) {
    echo "<script>
            alert('Password lama salah!');
          </script>";
    return false;
  }

  $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);

  $query = "UPDATE admins SET password = '$password_baru' WHERE username = '$username'";
  mysqli_query($koneksi, $query);

  return mysqli_affected_rows($koneksi);
}

function generateDummyArsip() {
  global $koneksi;

  $kategori = daftarKategori();
  $kategori_length = count($kategori);
  
  $distributor = daftarDistributor();
  $distributor_length = count($distributor);

  $array_tipe = ["HASIL_PRODUKSI", "BARANG_KELUAR"];
  
  for ($i = 0; $i < 3; $i++) {
    $kategori_id = $kategori[rand(0, $kategori_length - 1)]["id"];
    $distributor_id = $distributor[rand(0, $distributor_length - 1)]["id"];

    $tipe = $array_tipe[rand(0, 1)];
    var_dump($tipe . "<br>");
    $jumlah = rand(1, 100);
    $startDate = strtotime("-3 months");
    $endDate = time();
    $tanggal = date("Y-m-d", rand($startDate, $endDate));
    mysqli_query($koneksi, "INSERT INTO items VALUES ('', '$kategori_id', '$distributor_id', '$jumlah', '$tipe', '1', '$tanggal', NOW())");

    if (mysqli_affected_rows($koneksi) == 0) {
      var_dump("Gagal menambahkan data" . "<br>");
    } else {
      echo $i + 1 . "<br>";
    }
  }
}