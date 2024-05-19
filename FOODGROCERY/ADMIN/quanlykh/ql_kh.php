<?php
   require '../../config/db.php'; 
   
   // Lấy dữ liệu từ bảng "Khách hàng"
   $sql = "SELECT * FROM khachhang";
   $result = $connect->query($sql);
   
   // Tạo bảng HTML
   $table = '<table class="khachhang-table" style="border-collapse: collapse; width: 100%;">
       <thead>
           <tr>
               <th>Mã KH</th>
               <th>Mã tài khoản</th>
               <th>Họ tên</th>
               <th>Địa chỉ</th>
               <th>Email</th>
               <th>Điện thoại</th>
               <th>Trạng thái</th>
               <th>Khóa</th>
               <th>Xóa</th>
           </tr>
       </thead>
       <tbody>';
   
   // Hiển thị dữ liệu trong bảng HTML
   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
        $table .= '<tr>';
        $table .= '<td>' . (is_null($row["makh"]) ? "null" : $row["makh"]) . '</td>';
        $table .= '<td>' . (is_null($row["matk"]) ? "null" : $row["matk"]) . '</td>';
        $table .= '<td>' . (is_null($row["hoten"]) ? "null" : $row["hoten"]) . '</td>';
        $table .= '<td>' . (is_null($row["diachi"]) ? "null" : $row["diachi"]) . '</td>';
        $table .= '<td>' . (is_null($row["email"]) ? "null" : $row["email"]) . '</td>';
        $table .= '<td>' . (is_null($row["dienthoai"]) ? "null" : $row["dienthoai"]) . '</td>';
        $table .= '<td>' . (is_null($row["tttk"]) ? "null" : $row["tttk"]) . '</td>';

        if($row["tttk"] == 0) {
            $table .= '<td><button class="lock-button_KH" onclick="showLockModal('.$row["makh"].')">Khóa</button></td>';
        } 
        if($row["tttk"] == 1){
            $table .= '<td><button class="lock-button_KH" onclick="showUnlockModal('.$row["makh"].')" style="background-color: rgb(14, 124, 7)">Gỡ Khóa</button></td>';
        }

        $table .= '<td><button class="delete-button_KH" onclick="showDeleteModal('.$row["makh"].', \''.$row["matk"].'\')">Xóa</button></td>';
        $table .= '</tr>';
       }
   } else {
       $table .= "<tr><td colspan='9'>Không có dữ liệu</td></tr>";
   }
   
   $table .= "</tbody></table>";
   
   echo $table;


if (isset($_POST['account_id']) && isset($_POST['status'])) {
    
    // Lấy thông tin từ yêu cầu AJAX
    $account_id = $_POST['account_id'];
    $status = $_POST['status'];

    // Cập nhật trạng thái tài khoản trong database
    $sql = "UPDATE khachhang SET tttk = ? WHERE makh = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ii", $status, $account_id);
    $stmt->execute();

}

if (isset($_POST['action'])) {

    $action = $_POST['action'];

    if ($action == "delete") {
        // Xử lý xóa dữ liệu
        $makh = $_POST['makh'];
        $matk = $_POST['matk'];
        $sql = "DELETE FROM khachhang WHERE makh = $makh";
        $sql2 = "DELETE FROM account WHERE username = '$matk'";
        
        $connect->query($sql);
        $connect->query($sql2);
    }
}
   
mysqli_close($connect);
?>