<?php require '../../config/db.php'; 
$sql = "SELECT COUNT(*) AS total_accounts1 FROM account a JOIN quyen q ON a.username = q.username WHERE q.rolename <> 'khách hàng' AND q.rolename <> 'admin'"; 
$result = $connect->query($sql); 
if ($result->num_rows > 0) { 
    $row = $result->fetch_assoc(); $total_accounts1 = $row['total_accounts1']; 
} 
    else { 
        $total_accounts1 = 0; 
    } 


    $sql2 = "SELECT COUNT(*) AS total_accounts2 FROM account a JOIN quyen q ON a.username = q.username WHERE q.rolename = 'khách hàng'"; 
    $result2 = $connect->query($sql2); 
    if ($result2->num_rows > 0) { 
        $row = $result2->fetch_assoc(); $total_accounts2 = $row['total_accounts2']; 
        } else { 
            $total_accounts2 = 0; 
            } 
            
            $response = array( 'nv' => $total_accounts1, 'kh' => $total_accounts2, ); 
            echo json_encode($response); ?>