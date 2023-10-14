<?php
// Koneksi ke database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'apiphp';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari permintaan POST
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk mencari pengguna
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Pengguna ditemukan, ambil data pengguna
    $user = $result->fetch_assoc();

    // Kirim respons sukses beserta data pengguna
    $response = array('status' => 'success', 'message' => 'Login berhasil', 'user' => $user);
} else {
    // Pengguna tidak ditemukan, kirim respons gagal
    $response = array('status' => 'error', 'message' => 'Login gagal');
}

// Ubah respons menjadi format JSON
header('Content-Type: application/json');
echo json_encode($response);

// Tutup koneksi database
$conn->close();
?>
