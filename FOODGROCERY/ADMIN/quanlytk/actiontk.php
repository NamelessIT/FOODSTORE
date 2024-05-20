<?php
require '../../config/db.php'; 

if (isset($_POST['action'])) {

$action = $_POST['action'];

if ($action == "delete") {
    $username = $_POST['usernamedel'];

    // Xóa dữ liệu trong bảng account và quyen
    $sql2 = "UPDATE account SET recovery = 1 WHERE username = '$username'";
    $result2 = $connect->query($sql2);

    if ($result2) {
        $delete1 = 'success';
        $update1 = 'nooooo';
        $recover1 = 'noooo';
    } else {
        $delete1 = 'fail';
        $update1 = 'nooooo';
        $recover1 = 'noooo';
    }
}

if ($action == "update") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql3 = "UPDATE account SET password = '$password' WHERE username = '$username'";
    $result3 = $connect->query($sql3);

    $sql4 = "UPDATE quyen SET rolename = '$role' WHERE username = '$username'";
    $result4 = $connect->query($sql4);

    if ($result3 && $result4) {
        $update1 = 'success';
        $delete1 = 'noooo';
        $recover1 = 'noooo';
    } else {
        $recover1 = 'noooo';
        $update1 = 'fail';
        $delete1 = 'noooo';
    }
}

if ($action == "recover") {
    $username = $_POST['username'];

    // Xóa dữ liệu trong bảng account và quyen
    $sql2 = "UPDATE account SET recovery = 0 WHERE username = '$username'";
    $result = $connect->query($sql2);

    if ($result) {
        $recover1 = 'success';
        $delete1 = 'nooooo';
        $update1 = 'nooooo';
    } else {
        $recover1 = 'fail';
        $delete1 = 'nooooo';
        $update1 = 'nooooo';
    }
}

$response = array(
    'update' => $update1,
    'delete' => $delete1,
    'recover' => $recover1,
);

echo json_encode($response);
}

?>