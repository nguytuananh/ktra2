<?php
include 'db.php';

// Lấy danh sách học phần
$sql = "SELECT * FROM HocPhan";
$result = $conn->query($sql);

// Xử lý đăng ký học phần
if (isset($_POST['register'])) {
    $maSV = $_POST['MaSV'];
    $maHP = $_POST['MaHP'];

    // Kiểm tra xem sinh viên đã đăng ký học phần này chưa
    $check_sql = "SELECT * FROM SinhVien_HocPhan WHERE MaSV = '$maSV' AND MaHP = '$maHP'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "Bạn đã đăng ký học phần này rồi!";
    } else {
        // Thực hiện đăng ký
        $register_sql = "INSERT INTO SinhVien_HocPhan (MaSV, MaHP) VALUES ('$maSV', '$maHP')";
        if ($conn->query($register_sql) === TRUE) {
            echo "Đăng ký học phần thành công!";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký học phần</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #007bff;
            color: white;
        }

        tr:hover {
            background: #f1f1f1;
        }

        .btn-register {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-register:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Danh sách Học Phần</h2>
    <table>
        <tr>
            <th>Mã Học Phần</th>
            <th>Tên Học Phần</th>
            <th>Số Tín Chỉ</th>
            <th>Giảng Viên</th>
            <th>Đăng Ký</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['MaHP'] . "</td>";
                echo "<td>" . $row['TenHP'] . "</td>";
                echo "<td>" . $row['SoTC'] . "</td>";
                echo "<td>" . $row['GiangVien'] . "</td>";
                echo "<td>
                        <form method='POST' action='hocphan.php'>
                            <input type='hidden' name='MaSV' value='SV001'> <!-- Mã sinh viên cần lấy động -->
                            <input type='hidden' name='MaHP' value='" . $row['MaHP'] . "'>
                            <button type='submit' name='register' class='btn-register'>Đăng ký</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Không có học phần nào!</td></tr>";
        }
        ?>
    </table>
</body>
</html>

