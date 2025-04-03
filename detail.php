<?php
include 'db.php';

if (isset($_GET['id'])) {
    $maSV = $_GET['id'];
    $sql = "SELECT * FROM SinhVien WHERE MaSV = '$maSV'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<h2>Chi Tiết Sinh Viên</h2>
<p><strong>Mã Sinh Viên:</strong> <?php echo $row['MaSV']; ?></p>
<p><strong>Họ Tên:</strong> <?php echo $row['HoTen']; ?></p>
<p><strong>Giới Tính:</strong> <?php echo $row['GioiTinh']; ?></p>
<p><strong>Ngày Sinh:</strong> <?php echo $row['NgaySinh']; ?></p>
<p><strong>Hình Ảnh:</strong> <br>
    <img src="images/<?php echo $row['Hinh']; ?>" alt="Hình ảnh sinh viên" width="150"></p>
<p><strong>Mã Ngành:</strong> <?php echo $row['MaNganh']; ?></p>

<a href="index.php">Quay lại danh sách</a>
