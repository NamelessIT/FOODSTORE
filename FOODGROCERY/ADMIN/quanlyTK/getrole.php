<?php
require '../../config/db.php';

$sql = "SELECT role_name FROM role WHERE role_name <> 'khách hàng'";
$result = $connect->query($sql);

$roles = array();
while ($row = $result->fetch_assoc()) {
    $roles[] = $row;
}

echo json_encode($roles);
?>