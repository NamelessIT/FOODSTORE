<?php
require '../../config/db.php';

$sql = "SELECT manv, matk 
        FROM nhanvien
         WHERE matk IS NULL OR matk NOT IN (SELECT username FROM account)";
$result = $connect->query($sql);

$employees = array();
while ($row = $result->fetch_assoc()) {
    $employees[] = $row;
}

echo json_encode($employees);
?>