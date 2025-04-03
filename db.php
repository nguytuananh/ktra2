<?php
$servername = "localhost";
$username = "root"; // Nếu có mật khẩu thì nhập vào
$password = "";
$database = "quanly_sinhvien"; // Đổi tên chính xác

$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
