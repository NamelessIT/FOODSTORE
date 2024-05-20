<?php

require '../../config/db.php'; 

if (isset($_POST['action']) && $_POST['action'] == 'create') {
    $manv = '';
    $hoten = $_POST['name'];
    $diachi = $_POST['address'];
    $email = $_POST['email'];
    $dienthoai = $_POST['phone'];

    $sql = "INSERT INTO nhanvien (manv, hoten, diachi, email, dienthoai) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("issss", $manv, $hoten, $diachi, $email, $dienthoai);

    if ($stmt->execute()) {
        $them = 'success';
    } else {
        $them = 'fail';
    }

    $stmt->close();

    $response = array(
        'them' => $them,
    );

    echo json_encode($response);
}

?>