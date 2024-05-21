<?php

require '../../config/db.php';

// Lấy dữ liệu từ AJAX request
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // Kiểm tra xem username là của khách hàng hay nhân viên
    $sql_check = "SELECT * FROM nhanvien WHERE matk = ?";
    $stmt_check = $connect->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Là tài khoản của nhân viên
        $sql = "UPDATE nhanvien
                SET hoten = ?,
                    email = ?,
                    diachi = ?,
                    dienthoai = ?
                WHERE matk = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $address, $phone, $username);
    } else {
        // Là tài khoản của khách hàng
        $sql = "UPDATE khachhang
                SET hoten = ?,
                    email = ?,
                    diachi = ?,
                    dienthoai = ?
                WHERE matk = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $address, $phone, $username);
    }

    // Thực hiện câu truy vấn
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "fail";
    }

    $connect->close();
}
?>