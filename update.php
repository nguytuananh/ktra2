<?php
include('db.php');

// Kiểm tra nếu có ID được truyền vào URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Lấy dữ liệu sinh viên từ cơ sở dữ liệu
    $sql = "SELECT * FROM students WHERE id=$id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
    } else {
        echo "Không tìm thấy sinh viên!";
        exit;
    }

    // Xử lý khi form được gửi
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        
        // Cập nhật thông tin sinh viên
        $sql = "UPDATE students SET name='$name', email='$email' WHERE id=$id";
        
        if ($conn->query($sql) === TRUE) {
            echo "Cập nhật thành công!";
            header("Location: index.php"); // Chuyển hướng về danh sách sinh viên
            exit;
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }
} else {
    echo "Không có ID sinh viên!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Sinh Viên</title>
</head>
<body>
    <h2>Chỉnh Sửa Sinh Viên</h2>
    <form method="POST" action="update.php?id=<?php echo $id; ?>">
        <label for="name">Tên:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>

        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
