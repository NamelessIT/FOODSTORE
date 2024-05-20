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

$table2 = '';

if (isset($_POST['q'])) {
        $searchTerm = $_POST['q'];


$sql2 = "SELECT * FROM khachhang WHERE matk LIKE '%$searchTerm%' OR makh LIKE '%$searchTerm%' OR hoten LIKE '%$searchTerm%' OR diachi LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%' OR dienthoai LIKE '%$searchTerm%'";
$result2 = $connect->query($sql2);

$table2 = '<table class="khachhang-table" style="border-collapse: collapse; width: 100%;">
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

if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
        $table2 .= '<tr>';
        $table2 .= '<td>' . (is_null($row2["makh"]) ? "null" : $row2["makh"]) . '</td>';
        $table2 .= '<td>' . (is_null($row2["matk"]) ? "null" : $row2["matk"]) . '</td>';
        $table2 .= '<td>' . (is_null($row2["hoten"]) ? "null" : $row2["hoten"]) . '</td>';
        $table2 .= '<td>' . (is_null($row2["diachi"]) ? "null" : $row2["diachi"]) . '</td>';
        $table2 .= '<td>' . (is_null($row2["email"]) ? "null" : $row2["email"]) . '</td>';
        $table2 .= '<td>' . (is_null($row2["dienthoai"]) ? "null" : $row2["dienthoai"]) . '</td>';
        $table2 .= '<td>' . (is_null($row2["tttk"]) ? "null" : $row2["tttk"]) . '</td>';

        if($row2["tttk"] == 0) {
            $table2 .= '<td><button class="lock-button_KH" onclick="showLockModal('.$row2["makh"].')">Khóa</button></td>';
        } 
        if($row2["tttk"] == 1){
            $table2 .= '<td><button class="lock-button_KH" onclick="showUnlockModal('.$row2["makh"].')" style="background-color: rgb(14, 124, 7)">Gỡ Khóa</button></td>';
        }

        $table2 .= '<td><button class="delete-button_KH" onclick="showDeleteModal('.$row2["makh"].', \''.$row2["matk"].'\')">Xóa</button></td>';
        $table2 .= '</tr>';
    }
} else {
    $table2 .= "<tr><td colspan='9'>Không có dữ liệu</td></tr>";
}

$table2 .= "</tbody></table>";
   }

$response = array(
    'table' =>  $table,
    'tabletim' => $table2,
   );

echo json_encode($response);


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