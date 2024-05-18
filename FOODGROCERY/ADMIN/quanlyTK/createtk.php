<?php
require '../../config/db.php';

$employeeId = $_POST['employeeId'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];
$ngaytao = date('Y-m-d');

// Thêm nhân viên vào bảng account
$sql = "INSERT INTO account (username, password, ngaytao) VALUES ('$username', '$password','$ngaytao')";
$result2 = mysqli_query($connect, $sql);

//Thêm matk vào bảng nhân viên
$sql1 = "UPDATE nhanvien SET matk = '$username' WHERE manv = '$employeeId'";
$result3 = mysqli_query($connect, $sql1);

// Thêm quyền vào bảng quyen
$sql = "INSERT INTO quyen (rolename, username) VALUES (?, ?)";
$stmt = $connect->prepare($sql);
$stmt->bind_param("ss", $role, $username);
$stmt->execute();

echo "success";
?>