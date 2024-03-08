<?php
// Konfigurasi database
$host = "localhost";
$user = "username_database";
$pass = "password_database";
$db   = "nama_database";

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Fungsi untuk membersihkan input pengguna
function clean_input($data) {
    global $conn;
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data);
}

// Memproses formulir login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = clean_input($_POST["username"]);
    $password = clean_input($_POST["password"]);

    // Mengambil data pengguna dari database
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Login berhasil
        echo "Login berhasil!";
        // Tambahkan logika redirect atau aktivitas setelah login di sini
    } else {
        // Login gagal
        echo "Login gagal. Periksa kembali username dan password Anda.";
    }
}

// Tutup koneksi database
$conn->close();
?>