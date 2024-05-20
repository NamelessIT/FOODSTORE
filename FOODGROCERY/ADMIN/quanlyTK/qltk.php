<?php
   require '../../config/db.php'; 

   // Lấy dữ liệu từ bảng "Account" không phải "khách hàng"
   $sql1 = "SELECT a.username, a.password, a.ngaytao, a.recovery ,q.rolename
           FROM account a
           LEFT JOIN quyen q ON a.username = q.username
           WHERE q.rolename <> 'khách hàng' AND q.rolename <> 'admin'";
   $result1 = $connect->query($sql1);
   
   // Tạo bảng HTML cho dữ liệu không phải "khách hàng"
   $table1 ='<table class="account-table" style="border-collapse: collapse; width: 100%;">
       <thead>
           <tr>
               <th>Tên đăng nhập</th>
               <th>Mật khẩu</th>
               <th>Ngày tạo</th>
               <th>Vai trò</th>
               <th>Sửa tài khoản</th>
               <th>Xóa tài khoản</th>
           </tr>
       </thead>
       <tbody>';
   
   // Hiển thị dữ liệu trong bảng HTML cho dữ liệu không phải "khách hàng"
   if ($result1->num_rows > 0) {
       while($row = $result1->fetch_assoc()) {
        $table1 .= '<tr>';
        $table1 .= '<td>' . (is_null($row["username"]) ? "null" : $row["username"]) . '</td>';
        $table1 .= '<td>' . (is_null($row["password"]) ? "null" : $row["password"]) . '</td>';
        $table1 .= '<td>' . (is_null($row["ngaytao"]) ? "null" : $row["ngaytao"]) . '</td>';
        $table1 .= '<td>' . (is_null($row["rolename"]) ? "null" : $row["rolename"]) . '</td>';
        $table1 .= '<td><button class="update-button_TK">Sửa</button></td>';
        if ($row["recovery"] == 1) {
            $table1 .= '<td><button class="recover-button_TK" onclick="showRecoverModalTK(\''.$row["username"].'\')">Khôi phục</button></td>';
        }
        else {
            $table1 .= '<td><button class="delete-button_TK" onclick="showDeleteModalTK(\''.$row["username"].'\')">Xóa</button></td>';
        }
        $table1 .= '</tr>';
       }
   } else {
       $table1 .= '<tr><td colspan="6">Không có dữ liệu</td></tr>';
   }
   
   $table1 .= '</tbody></table>';

   
   // Lấy dữ liệu từ bảng "Account" chỉ với rolename là "khách hàng"
   $sql2 = "SELECT a.username, a.password, a.ngaytao, a.recovery ,q.rolename
           FROM account a
           LEFT JOIN quyen q ON a.username = q.username
           WHERE q.rolename = 'khách hàng'";
   $result2 = $connect->query($sql2);
   
   // Tạo bảng HTML cho dữ liệu "khách hàng"
   $table2 ='<table class="account-table" style="border-collapse: collapse; width: 100%;">
       <thead>
           <tr>
               <th>Tên đăng nhập</th>
               <th>Mật khẩu</th>
               <th>Ngày tạo</th>
               <th>Vai trò</th>
               <th>Xóa tài khoản</th>
           </tr>
       </thead>
       <tbody>';
   
   // Hiển thị dữ liệu trong bảng HTML cho dữ liệu "khách hàng"
   if ($result2->num_rows > 0) {
       while($row = $result2->fetch_assoc()) {
        $table2 .= '<tr>';
        $table2 .= '<td>' . (is_null($row["username"]) ? "null" : $row["username"]) . '</td>';
        $table2 .= '<td>' . (is_null($row["password"]) ? "null" : $row["password"]) . '</td>';
        $table2 .= '<td>' . (is_null($row["ngaytao"]) ? "null" : $row["ngaytao"]) . '</td>';
        $table2 .= '<td>' . (is_null($row["rolename"]) ? "null" : $row["rolename"]) . '</td>';
        if ($row["recovery"] == 1) {
            $table2 .= '<td><button class="recover-button_TK" onclick="showRecoverModalTK(\''.$row["username"].'\')">Khôi phục</button></td>';
        }
        else {
            $table2 .= '<td><button class="delete-button_TK" onclick="showDeleteModalTK(\''.$row["username"].'\')">Xóa</button></td>';
        }
        $table2 .= '</tr>';
       }
   } else {
       $table2 .= '<tr><td colspan="5">Không có dữ liệu</td></tr>';
   }
   
   $table2 .= '</tbody></table>';


   $tabletknv='';
   $tabletkkh='';

   if (isset($_POST['q'])) {
    $searchTerm = $_POST['q'];

    $sql3 = "SELECT a.username, a.password, a.ngaytao, a.recovery, q.rolename
    FROM account a
    LEFT JOIN quyen q ON a.username = q.username
    WHERE q.rolename <> 'khách hàng' AND q.rolename <> 'admin' AND (a.username LIKE '%$searchTerm%' OR q.rolename LIKE '%$searchTerm%' OR a.ngaytao LIKE '%$searchTerm%')";
    $result3 = $connect->query($sql3);

    // Tạo bảng HTML cho dữ liệu không phải "khách hàng"
   $tabletknv ='<table class="account-table" style="border-collapse: collapse; width: 100%;">
   <thead>
       <tr>
           <th>Tên đăng nhập</th>
           <th>Mật khẩu</th>
           <th>Ngày tạo</th>
           <th>Vai trò</th>
           <th>Sửa tài khoản</th>
           <th>Xóa tài khoản</th>
       </tr>
   </thead>
   <tbody>';

// Hiển thị dữ liệu trong bảng HTML cho dữ liệu không phải "khách hàng"
if ($result3->num_rows > 0) {
   while($row = $result3->fetch_assoc()) {
    $tabletknv .= '<tr>';
    $tabletknv .= '<td>' . (is_null($row["username"]) ? "null" : $row["username"]) . '</td>';
    $tabletknv .= '<td>' . (is_null($row["password"]) ? "null" : $row["password"]) . '</td>';
    $tabletknv .= '<td>' . (is_null($row["ngaytao"]) ? "null" : $row["ngaytao"]) . '</td>';
    $tabletknv .= '<td>' . (is_null($row["rolename"]) ? "null" : $row["rolename"]) . '</td>';
    $tabletknv .= '<td><button class="update-button_TK">Sửa</button></td>';
    if ($row["recovery"] == 1) {
        $tabletknv .= '<td><button class="recover-button_TK" onclick="showRecoverModalTK(\''.$row["username"].'\')">Khôi phục</button></td>';
    }
    else {
        $tabletknv .= '<td><button class="delete-button_TK" onclick="showDeleteModalTK(\''.$row["username"].'\')">Xóa</button></td>';
    }
    $tabletknv .= '</tr>';
   }
} else {
   $tabletknv .= '<tr><td colspan="6">Không có dữ liệu</td></tr>';
}

$tabletknv .= '</tbody></table>';
    
$sql4 = "SELECT a.username, a.password, a.ngaytao, a.recovery, q.rolename
FROM account a
LEFT JOIN quyen q ON a.username = q.username
WHERE q.rolename = 'khách hàng' AND (a.username LIKE '%$searchTerm%' OR q.rolename LIKE '%$searchTerm%' OR a.ngaytao LIKE '%$searchTerm%')";

$result4 = $connect->query($sql4);
   
   // Tạo bảng HTML cho dữ liệu "khách hàng"
   $tabletkkh ='<table class="account-table" style="border-collapse: collapse; width: 100%;">
       <thead>
           <tr>
               <th>Tên đăng nhập</th>
               <th>Mật khẩu</th>
               <th>Ngày tạo</th>
               <th>Vai trò</th>
               <th>Xóa tài khoản</th>
           </tr>
       </thead>
       <tbody>';
   
   // Hiển thị dữ liệu trong bảng HTML cho dữ liệu "khách hàng"
   if ($result4->num_rows > 0) {
       while($row = $result4->fetch_assoc()) {
        $tabletkkh .= '<tr>';
        $tabletkkh .= '<td>' . (is_null($row["username"]) ? "null" : $row["username"]) . '</td>';
        $tabletkkh .= '<td>' . (is_null($row["password"]) ? "null" : $row["password"]) . '</td>';
        $tabletkkh .= '<td>' . (is_null($row["ngaytao"]) ? "null" : $row["ngaytao"]) . '</td>';
        $tabletkkh .= '<td>' . (is_null($row["rolename"]) ? "null" : $row["rolename"]) . '</td>';
        if ($row["recovery"] == 1) {
            $tabletkkh .= '<td><button class="recover-button_TK" onclick="showRecoverModalTK(\''.$row["username"].'\')">Khôi phục</button></td>';
        }
        else {
            $tabletkkh .= '<td><button class="delete-button_TK" onclick="showDeleteModalTK(\''.$row["username"].'\')">Xóa</button></td>';
        }
        $tabletkkh .= '</tr>';
       }
   } else {
       $tabletkkh .= '<tr><td colspan="5">Không có dữ liệu</td></tr>';
   }
   
   $tabletkkh .= '</tbody></table>';

}


$response = array(
    'nv' => $table1,
    'kh' => $table2,
    'tabletknv' => $tabletknv,
    'tabletkkh' => $tabletkkh,
);

echo json_encode($response);
?>