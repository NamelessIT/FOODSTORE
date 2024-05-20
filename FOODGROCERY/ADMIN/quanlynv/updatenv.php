<?php

require '../../config/db.php'; 

if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $manv = $_POST['employeeId'];
    $hoten = $_POST['name'];
    $diachi = $_POST['address'];
    $email = $_POST['email'];
    $dienthoai =$_POST['phone'];

    $sql = "UPDATE nhanvien SET hoten = ?, diachi = ?, email = ?, dienthoai = ? WHERE manv = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssssi", $hoten, $diachi, $email, $dienthoai, $manv);

    if ($stmt->execute()) {
        $sua = 'success';
    } else {
        $sua = 'fail';
    }

    $stmt->close();

    $response = array(
        'sua' => $sua,
    );

    echo json_encode($response);
}

?>