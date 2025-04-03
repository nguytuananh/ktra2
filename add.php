<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSV = $_POST['maSV'];
    $hoTen = $_POST['hoTen'];
    $gioiTinh = $_POST['gioiTinh'];
    $ngaySinh = $_POST['ngaySinh'];
    $hinh = $_POST['hinh'];
    $maNganh = $_POST['maNganh'];

    $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh)
            VALUES ('$maSV', '$hoTen', '$gioiTinh', '$ngaySinh', '$hinh', '$maNganh')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm sinh viên thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<form method="post" action="add.php">
    MaSV: <input type="text" name="maSV"><br>
    HoTen: <input type="text" name="hoTen"><br>
    GioiTinh: <input type="text" name="gioiTinh"><br>
    NgaySinh: <input type="date" name="ngaySinh"><br>
    Hinh: <input type="text" name="hinh"><br>
    MaNganh: <input type="text" name="maNganh"><br>
    <input type="submit" value="Thêm sinh viên">
</form>
