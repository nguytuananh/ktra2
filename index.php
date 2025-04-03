<?php
include 'db.php';

// Cấu hình số sinh viên trên mỗi trang
$records_per_page = 4;

// Xác định trang hiện tại
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// Tính OFFSET (bắt đầu lấy dữ liệu từ đâu)
$offset = ($page - 1) * $records_per_page;

// Đếm tổng số sinh viên
$total_sql = "SELECT COUNT(*) AS total FROM SinhVien";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];

// Tính tổng số trang
$total_pages = ceil($total_records / $records_per_page);

// Lấy danh sách sinh viên với LIMIT và OFFSET
$sql = "SELECT * FROM SinhVien LIMIT $records_per_page OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sinh Viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

        h2 {
            color: #333;
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

        img {
            width: 80px;
            border-radius: 5px;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            margin: 5px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
        }

        .btn-edit { background: #28a745; }
        .btn-delete { background: #dc3545; }
        .btn-detail { background: #17a2b8; }
        .btn-add { background: #007bff; padding: 10px 15px; font-size: 16px; }

        /* CSS cho phân trang */
        .pagination {
            margin: 20px 0;
        }
        .pagination a {
            display: inline-block;
            padding: 8px 12px;
            margin: 2px;
            border: 1px solid #007bff;
            color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }
        .pagination a:hover {
            background: #007bff;
            color: white;
        }
        .pagination .current {
            background: #007bff;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h2>Danh sách Sinh Viên</h2>
    <table>
        <tr>
            <th>Mã SV</th>
            <th>Họ Tên</th>
            <th>Giới Tính</th>
            <th>Ngày Sinh</th>
            <th>Hình</th>
            <th>Mã Ngành</th>
            <th>Hành động</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['MaSV'] . "</td>";
                echo "<td>" . $row['HoTen'] . "</td>";
                echo "<td>" . $row['GioiTinh'] . "</td>";
                echo "<td>" . $row['NgaySinh'] . "</td>";
                echo "<td><img src='images/" . $row['Hinh'] . "'></td>";
                echo "<td>" . $row['MaNganh'] . "</td>";
                echo "<td>
                        <a href='detail.php?id=" . $row['MaSV'] . "' class='btn btn-detail'>Chi tiết</a>
                        <a href='edit.php?id=" . $row['MaSV'] . "' class='btn btn-edit'>Sửa</a>
                        <a href='delete.php?id=" . $row['MaSV'] . "' class='btn btn-delete' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\")'>Xóa</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Không có sinh viên nào!</td></tr>";
        }
        ?>
    </table>

    <a href="add.php" class="btn btn-add">+ Thêm Sinh Viên</a>

    <!-- PHÂN TRANG -->
    <div class="pagination">
        <?php
        if ($page > 1) {
            echo "<a href='index.php?page=" . ($page - 1) . "'>« Trước</a>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo "<a class='current'>$i</a>";
            } else {
                echo "<a href='index.php?page=$i'>$i</a>";
            }
        }

        if ($page < $total_pages) {
            echo "<a href='index.php?page=" . ($page + 1) . "'>Sau »</a>";
        }
        ?>
    </div>
</body>
</html>
