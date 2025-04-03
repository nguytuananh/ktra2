<?php
include 'db.php';

if (isset($_GET['id'])) {
    $maSV = $_GET['id'];
    $sql = "SELECT * FROM SinhVien WHERE MaSV = '$maSV'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSV = $_POST['maSV'];
    $hoTen = $_POST['hoTen'];
    $gioiTinh = $_POST['gioiTinh'];
    $ngaySinh = $_POST['ngaySinh'];
    $hinh = $_POST['hinh'];
    $maNganh = $_POST['maNganh'];

    $sql = "UPDATE SinhVien 
            SET HoTen='$hoTen', GioiTinh='$gioiTinh', NgaySinh='$ngaySinh', Hinh='$hinh', MaNganh='$maNganh' 
            WHERE MaSV='$maSV'";

    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật sinh viên thành công!";
        header("Location: index.php"); // Quay lại danh sách sau khi cập nhật
        exit();
    } else {
        echo "Lỗi cập nhật: " . $conn->error;
    }
}
?>

<h2>Chỉnh sửa thông tin sinh viên</h2>
<form method="post">
    MaSV: <input type="text" name="maSV" value="<?php echo $row['MaSV']; ?>" readonly><br>
    Họ Tên: <input type="text" name="hoTen" value="<?php echo $row['HoTen']; ?>"><br>
    Giới Tính: <input type="text" name="gioiTinh" value="<?php echo $row['GioiTinh']; ?>"><br>
    Ngày Sinh: <input type="date" name="ngaySinh" value="<?php echo $row['NgaySinh']; ?>"><br>
    Hình: <input type="text" name="hinh" value="<?php echo $row['Hinh']; ?>"><br>
    Mã Ngành: <input type="text" name="maNganh" value="<?php echo $row['MaNganh']; ?>"><br>
    <input type="submit" value="Cập nhật">
</form>
<a href="index.php">Quay lại danh sách</a>
