<?php
require '../../config/db.php';

if (isset($_POST['username_dk']) && isset($_POST['password_dk']) && isset($_POST['email'])) {
    $id = "";
    $tttk = 0;
    $username = $_POST['username_dk'];
    $password = $_POST['password_dk'];
    $email = $_POST['email'];
    $ngaytao = date('Y-m-d');
    $rolename = "khachhang";

    // Kiểm tra tên đăng nhập đã tồn tại
    $sql_check_username = "SELECT * FROM account WHERE username = '$username'";
    $result_check_username = mysqli_query($connect, $sql_check_username);
    if (mysqli_num_rows($result_check_username) > 0) {
        $response = array('status' => 'fail', 'message' => '* Tên đăng nhập đã tồn tại');
        echo json_encode($response);
        exit;
    }

    // Thực hiện lưu thông tin đăng ký
    $sql1 = "INSERT INTO khachhang (makh, matk, email, tttk) VALUES ('$id', '$username', '$email', '$tttk')";
    $sql2 = "INSERT INTO account (username, password, ngaytao) VALUES ('$username', '$password','$ngaytao')";
    $sql3 = "INSERT INTO quyen (rolename,username) VALUES ('$rolename','$username')";

    $result2 = mysqli_query($connect, $sql2);
    $result1 = mysqli_query($connect, $sql1);
    $result3 = mysqli_query($connect, $sql3);

    if ($result1 && $result2 && $result3 &&mysqli_affected_rows($connect) > 0) {
        $response = array('status' => 'success', 'message' => 'Đăng ký thành công');
        echo json_encode($response);
    } else {
        $response = array('status' => 'fail', 'message' => 'Đăng ký thất bại');
        echo json_encode($response);
    }
} else {
    $response = array('status' => 'fail', 'message' => 'Đăng ký thất bại');
    echo json_encode($response);
}

mysqli_close($connect);
?>