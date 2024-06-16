<?php
// Kết nối đến cơ sở dữ liệu (sử dụng mysqli)
$servername = "localhost";
$username = "root";
$password = "";
$database = "newstyle";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Truy vấn dữ liệu từ bảng 'orders'
$query = "SELECT orderdate, quantity FROM `orders`";
$result = mysqli_query($conn, $query);

// Tạo một mảng để lưu trữ dữ liệu
$data = array();

// Lặp qua kết quả và lấy dữ liệu
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);

// Trả về dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
