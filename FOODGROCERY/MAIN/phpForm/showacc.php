<?php
require '../../config/db.php';

if (isset($_POST['username'])) {
$username = $_POST['username'];

$sql = "
SELECT 
    'khachhang' AS bảng, 
    hoten, 
    diachi, 
    email, 
    dienthoai 
FROM khachhang 
WHERE matk = ?
UNION ALL
SELECT 
    'nhanvien' AS bảng,
    hoten, 
    diachi, 
    email, 
    dienthoai
FROM nhanvien
WHERE matk = ?
";

$stmt = $connect->prepare($sql);
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $name = $row["hoten"];
        $diachi = $row["diachi"];
        $email =  $row["email"];
        $dienthoai = $row["dienthoai"];
    }
    $status = 'success';

    $response = array (
        'status' => $status,
        'name' => $name,
        'diachi' => $diachi,
        'email' => $email,
        'dienthoai' => $dienthoai
    );

    echo json_encode($response);
} else {
  
}

$stmt->close();
$connect->close();
}

?>