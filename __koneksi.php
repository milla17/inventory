<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

define('BASE_URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . ":" . $_SERVER['SERVER_PORT'] . "/apps-sufi/");

session_start();

$setting = [
    "host" => "localhost",
    "username" => "root",
    "password" => "",
    "database" => "db_inventory"
];

$koneksi = mysqli_connect(
    $setting["host"],
    $setting["username"],
    $setting["password"],
    $setting["database"]
);

$login = false;
$akun = null;

if (mysqli_connect_errno()) {
    die("Database koneksi gagal: " .
        mysqli_connect_error() .
        " (" . mysqli_connect_errno() . ")"
    );
}

if (isset($_SESSION["login"])) {
    $login = true;
    $username = $_SESSION["username"] ?? "";

    $query = "SELECT * FROM admins WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $akun = mysqli_fetch_assoc($result);
    } else {
        $login = false;
    }
}