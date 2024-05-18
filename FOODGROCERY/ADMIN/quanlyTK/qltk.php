<?php
   require '../../config/db.php'; 
   
   // Lấy dữ liệu từ bảng "Account"
   $sql = "SELECT a.username, a.password, a.ngaytao, q.rolename 
            FROM account a
            LEFT JOIN quyen q ON a.username = q.username";
   $result = $connect->query($sql);

   // Tạo bảng HTML 
   $table ='<table class="account-table" style="border-collapse: collapse; width: 100%;">
       <thead>
           <tr>
               <th>Username</th>
               <th>Password</th>
               <th>Ngày tạo</th>
               <th>Vai trò</th>
               <th>Xóa tài khoản</th>
           </tr>
       </thead>
       <tbody>';
   
   // Hiển thị dữ liệu trong bảng HTML
   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
        $table .= '<tr>';
        $table .= '<td>' . (is_null($row["username"]) ? "null" : $row["username"]) . '</td>';
        $table .= '<td>' . (is_null($row["password"]) ? "null" : $row["password"]) . '</td>';
        $table .= '<td>' . (is_null($row["ngaytao"]) ? "null" : $row["ngaytao"]) . '</td>';
        $table .= '<td>' . (is_null($row["rolename"]) ? "null" : $row["rolename"]) . '</td>';
        $table .= '<td><button class="delete-button_TK" onclick="showDeleteModalTK(\''.$row["username"].'\')">Xóa</button></td>';
        $table .= '</tr>';
       }
   } else {
       $table .= '<tr><td colspan="4">Không có dữ liệu</td></tr>';
   }
   
   $table .= '</tbody></table>';
   
   echo $table;


   if (isset($_POST['action'])) {

    $action = $_POST['action'];

    if ($action == "delete") {
        $username = $_POST['username'];
    
        // Kiểm tra username có trong bảng nhanvien không
        $sql_check_nhanvien = "SELECT COUNT(*) FROM nhanvien WHERE matk = '$username'";
        $result_nhanvien = $connect->query($sql_check_nhanvien);
        $count_nhanvien = $result_nhanvien->fetch_row()[0];
    
        // Kiểm tra username có trong bảng khachhang không
        $sql_check_khachhang = "SELECT COUNT(*) FROM khachhang WHERE matk = '$username'";
        $result_khachhang = $connect->query($sql_check_khachhang);
        $count_khachhang = $result_khachhang->fetch_row()[0];
    
        // Xử lý xóa dữ liệu
        if ($count_nhanvien > 0) {
            // Username có trong bảng nhanvien
            $sql = "UPDATE nhanvien SET matk = NULL WHERE matk = '$username'";
            $connect->query($sql);
        } elseif ($count_khachhang > 0) {
            // Username có trong bảng khachhang
            $sql = "UPDATE khachhang SET matk = NULL WHERE matk = '$username'";
            $connect->query($sql);
        }
    
        // Xóa dữ liệu trong bảng account và quyen
        $sql2 = "DELETE FROM quyen WHERE username = '$username'";
        $sql3 = "DELETE FROM account WHERE username = '$username'";
        $connect->query($sql2);
        $connect->query($sql3);
    }
}

?>