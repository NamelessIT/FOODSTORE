<?php
require '../../config/db.php';

$sql = "SELECT role_name FROM role";
$result = $connect->query($sql);

$roles = array();
while ($row = $result->fetch_assoc()) {
    $roles[] = $row;
}

echo json_encode($roles);
?>