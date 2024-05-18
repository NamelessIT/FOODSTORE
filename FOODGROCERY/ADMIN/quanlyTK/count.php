<?php
require '../../config/db.php';

$sql = "SELECT COUNT(*) AS total_accounts FROM account";
$result = $connect->query($sql);
$row = $result->fetch_assoc();

$total_accounts = $row['total_accounts'];

echo $total_accounts;
?>