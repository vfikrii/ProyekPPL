<?php
$servername = "localhost";
$username = "spkahpsu_hary";
$password = "spkahpsu_hary";
$dbname = "spkahpsu_hary";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


