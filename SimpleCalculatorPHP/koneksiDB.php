<?php
    $url_host = "localhost";
    $username = "root";
    $password = "";
    $database = "uts_tbd";

    $koneksi = mysqli_connect($url_host, $username, $password);
    mysqli_select_db($koneksi, $database) or die ("Database Tidak Ditemukan");
?>