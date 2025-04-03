<?php
include 'db.php';

if (isset($_GET['id'])) {
    $maSV = $_GET['id'];
    $sql = "DELETE FROM SinhVien WHERE MaSV = '$maSV'";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa sinh viên thành công!";
    } else {
        echo "Lỗi khi xóa: " . $conn->error;
    }
    $conn->close();
    header("Location: index.php"); // Quay lại trang danh sách sau khi xóa
    exit();
}
?>
