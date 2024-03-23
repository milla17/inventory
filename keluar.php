<?php

require __DIR__ . "/__koneksi.php";

session_start();

if (!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

unset($_SESSION["login"]);
unset($_SESSION["id"]);
unset($_SESSION["username"]);
unset($_SESSION["full_name"]);

session_destroy();

header("Location: index.php");
?>