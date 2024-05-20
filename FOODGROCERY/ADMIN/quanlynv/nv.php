
<?php  

 require '../../config/db.php'; 

 $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Truy vấn dữ liệu từ bảng "nhanvien" với điều kiện tìm kiếm
$sql = "SELECT * 
FROM nhanvien
WHERE hoten LIKE '%$searchTerm%'
   OR manv LIKE '%$searchTerm%'
   OR matk LIKE '%$searchTerm%'
   OR diachi LIKE '%$searchTerm%'
   OR email LIKE '%$searchTerm%'
   OR dienthoai LIKE '%$searchTerm%'";

//   $sql = "SELECT * FROM nhanvien";
  $result = $connect->query($sql);
 
 $table = '<table class="nhanvien-table" style="border-collapse: collapse; width: 100%;">
 <thead>
     <tr>
         <th>Mã Nhân Viên</th>
         <th>Mã tài khoản</th>
         <th>Họ tên</th>
         <th>Địa chỉ</th>
         <th>Email</th>
         <th>Số điện thoại</th>
         <th>sửa</th>
         <th>Xóa</th>
     </tr>
 </thead>
 <tbody>';

// Hiển thị dữ liệu trong bảng HTML
if ($result->num_rows > 0) {
 while($row = $result->fetch_assoc()) {
  $table .= '<tr>';
  $table .= '<td>' . (is_null($row["manv"]) ? "null" : $row["manv"]) . '</td>';
  $table .= '<td>' . (is_null($row["matk"]) ? "null" : $row["matk"]) . '</td>';
  $table .= '<td>' . (is_null($row["hoten"]) ? "null" : $row["hoten"]) . '</td>';
  $table .= '<td>' . (is_null($row["diachi"]) ? "null" : $row["diachi"]) . '</td>';
  $table .= '<td>' . (is_null($row["email"]) ? "null" : $row["email"]) . '</td>';
  $table .= '<td>' . (is_null($row["dienthoai"]) ? "null" : $row["dienthoai"]) . '</td>';
  $table .= '<td><button class="update-button_NV">sửa</button></td>';
  $table .= '<td><button class="delete-button_NV" onclick="showDeleteModal1('.$row["manv"].', \''.$row["matk"].'\')">Xóa</button></td>';
  $table .= '</tr>';
 }
} else {
    $table .= "<tr><td colspan='8'>Không có dữ liệu</td></tr>";
}

$table .= "</tbody></table>";
echo $table;


if (isset($_POST['action'])) {

    $action = $_POST['action'];

    if ($action == "delete") {
        // Xử lý xóa dữ liệu
        $manv = $_POST['manv'];
        $matk = $_POST['matk'];
        $sql = "DELETE FROM nhanvien WHERE manv = $manv";
        $sql2 = "DELETE FROM account WHERE username = '$matk'";
        
        $connect->query($sql);
        $connect->query($sql2);
    }
}



mysqli_close($connect);
?>  
