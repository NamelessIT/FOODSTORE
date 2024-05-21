<?php

require '../../config/db.php';

// Lấy dữ liệu từ AJAX request
if (isset($_POST['username'])) {
    $username = $_POST['username'];

    // Kiểm tra xem username là của khách hàng hay nhân viên
    $sql_check = "SELECT * FROM nhanvien WHERE matk = ?";
    $stmt_check = $connect->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo 'success';
    } else {
        echo 'fail';
    }


    $connect->close();
}
?>