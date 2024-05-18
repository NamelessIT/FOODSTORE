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
        $table .= '</tr>';
       }
   } else {
       $table .= '<tr><td colspan="4">Không có dữ liệu</td></tr>';
   }
   
   $table .= '</tbody></table>';
   
   echo $table;
?>