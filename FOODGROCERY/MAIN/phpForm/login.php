<?php

require '../../config/db.php';
session_start();
$_SESSION['mySession']=[];


if (isset($_POST['username_dn']) && isset($_POST['password_dn'])) {
    $username = $_POST['username_dn'];
    $password = $_POST['password_dn'];
    $usernameluu = $_POST['username_luu'];
    $passwordluu = $_POST['password_luu'];

    $sql = "SELECT * FROM account WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['mySession'][0] = $username;
        $_SESSION['mySession'][1] = $password;
        setcookie("username",$username,time()+(86400*1),'/');

        if ($usernameluu!=="" && $passwordluu!=="") {
            setcookie("user",$usernameluu,time()+(86400*7),'/');
            setcookie("pass",$passwordluu,time()+(86400*7),'/');
        } 

        // Kiểm tra và lấy dữ liệu từ bảng 'quyen'
        $quyenSql = "SELECT * FROM quyen WHERE username='$username'";
        $quyenResult = mysqli_query($connect, $quyenSql);
        
        if (mysqli_num_rows($quyenResult) == 1) {
            $quyenRow = mysqli_fetch_assoc($quyenResult);
            $rolename = $quyenRow['rolename'];

            // Kiểm tra và lấy dữ liệu từ bảng 'role'
            $roleSql = "SELECT * FROM role WHERE role_name='$rolename'";
            $roleResult = mysqli_query($connect, $roleSql);
            
            if (mysqli_num_rows($roleResult) == 1) {
                $roleRow = mysqli_fetch_assoc($roleResult);
                $response = array(
                    'status' => 'success',
                    'username' => $username,
                    'addproduct' => $roleRow['addproduct'],
                    'updateproduct' => $roleRow['updateproduct'],
                    'deleteproduct' => $roleRow['deleteproduct'],
                    'deletedproducts' => $roleRow['deletedproducts'],
                    'buy' => $roleRow['buy'],
                    'printbill' => $roleRow['printbill'],
                    'deletebill' => $roleRow['deletebill'],
                    'addpn' => $roleRow['addpn'],
                    'deletpn' => $roleRow['deletpn'],
                    'addaccount' => $roleRow['addaccount'],
                    'updateaccount' => $roleRow['updateaccount'],
                    'deleteaccount' => $roleRow['deleteaccount'],
                    'addrole' => $roleRow['addrole'],
                    'addcategories' => $roleRow['addcategories'],
                    'updatecategories' => $roleRow['updatecategories'],
                    'deletecategories' => $roleRow['deletecategories'],
                    'statistics' => $roleRow['statistics'],
                    'ishidden' => $roleRow['ishidden'],
                );
                echo json_encode($response);
                exit; // Kết thúc quá trình xử lý
            }
        }
        
        // Nếu không tìm thấy dữ liệu từ bảng 'quyen' hoặc 'role'
        // Thì vẫn cho phép đăng nhập với quyền mặc định
        $response = array(
            'status' => 'success',
            'username' => $username,
            'addproduct' => 2,
            'updateproduct' => 2,
            'deleteproduct' => 2,
            'deletedproducts' => 2,
            'buy' => 2,
            'printbill' => 2,
            'deletebill' => 2,
            'addpn' => 2,
            'deletpn' => 2,
            'addaccount' => 2,
            'updateaccount' => 2,
            'deleteaccount' => 2,
            'addrole' => 2,
            'addcategories' => 2,
            'updatecategories' => 2,
            'deletecategories' => 2,
            'statistics' => 2,
            'ishidden' => 2,
        );
        echo json_encode($response);
    } else {
        $response = array('status' => 'fail');
        echo json_encode($response);
    }
} else {
    $response = array('status' => 'fail');
    echo json_encode($response);
}

mysqli_close($connect);

?>
