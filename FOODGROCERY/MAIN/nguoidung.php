<?php 
// require '../../config/db.php'; 
// if (isset($_COOKIE['username'])) {
//     $username = $_COOKIE['username'];
    
// }
$connect=mysqli_connect('localhost','root','','foodgrocery');

$outputttdh='';
// .= NỐI CHUỖI
$outputttdh .= '    <div class="chuchitiet">ĐƠN HÀNG ĐANG ĐƯỢC XỬ LÝ</div>
';
$outputttdh .= '
    <table class="table" style="width: 100%">
        <thead class="thead_dark">
        <tr>
            <th>
                Mã hóa đơn
            </th>
            <th>
                Mã khách hàng
            </th>
            <th>
                Mã nhân viên
            </th>
            <th>
                Ngày tạo
            </th>
            <th>
                Tổng tiền
            </th>
            <th>Trạng thái đơn hàng</th>

            <th>Xem chi tiết</th>
        </tr>
        </thead>
';
$sql_laymakh=mysqli_query($connect,"SELECT makh FROM khachhang WHERE hoten='" . $_COOKIE['username'] . "'");            
while($row1=mysqli_fetch_array($sql_laymakh)){
    $makhachhang =$row1['makh'] ;        
    $sql_trangthaihd=mysqli_query($connect,"SELECT * FROM hoadon WHERE makh=$makhachhang AND trangthai=0");            
if(mysqli_num_rows($sql_trangthaihd)>0){
    $i=1;
    while($row=mysqli_fetch_array($sql_trangthaihd)){
        $date = new DateTime($row['ngay']);
    $formattedDate = $date->format('d-m-Y');
        $outputttdh .='
        <tr style="margin:5px 0;">
           
            <td class="seperate " style="text-align: center;">
                '.$row['mahd'].'
            </td>
            <td class="seperate " style="text-align: center;">
                '.$row['makh'].'
            </td>         
            <td class="seperate " style="text-align: center;">
                '.$row['manv'].'
            </td>
            <td class="seperate " style="text-align: center;">
                '.$formattedDate.'
            </td>
            <td class="seperate " style="text-align: center;">
            '.$row['tongtien'].'
        </td>';
        //     $outputttdh .='  <td class="seperate " style="text-align: center;">
        //     Khách hàng đã hủy
        // </td>';
        if($row['trangthai']==0){
    $outputttdh .='  <td class="seperate " style="text-align: center;">
            Chưa được xử lý
        </td>';       
     }
        if($row['trangthai']==1){
            $outputttdh .='  <td class="seperate " style="text-align: center;">
            Đã xử lý
        </td>';       
     }
        if($row['trangthai']==2){
            $outputttdh .='  <td class="seperate " style="text-align: center;">
            Đang được xử lý
        </td>';       
     }
        if($row['trangthai']==3){
            $outputttdh .='  <td class="seperate " style="text-align: center;">
            Hóa đơn đã hủy
        </td>';       
     }
        $outputttdh .=' <td class="seperate " >
        <button class="laythongtinhd" data-tmp=2  data-mhd='.$row['mahd'].' data-mkh='.$row['makh'].'>Xem</button>
    </td>
</tr>
';
    }
}}
// $username = $_COOKIE['username'];

// else{
//     $outputttdh .='
//         <tr>
//             <td colspan="4">Dữ liệu chưa có</td> 
//         </tr>
//     ';
// }

$outputct='';
if(isset($_POST['mahd'])){
    $mahdd = $_POST['mahd'];
    $makhh=$_POST['makh'];
    $tmp=$_POST['tmp'];

    // $sql_cthoadon=mysqli_query($connect,"SELECT * FROM chitiethoadon,khachhang WHERE mahd=$mahd AND makh=$makh");            
// .= NỐI CHUỖI
$outputct .= '<div class="xemchitiethoadoncuakhach" >
    <div class="modal-container" style="overflow-y: auto;overflow-x: auto;">
    <div class="chuchitiet">Chi tiết hóa đơn</div>
    <h2>Mã hóa đơn: '.$mahdd.'</h2>
';
$sql_cthoadon1=mysqli_query($connect,"SELECT * FROM khachhang WHERE makh=$makhh");            
if(mysqli_num_rows($sql_cthoadon1)>0){
    while($row1=mysqli_fetch_array($sql_cthoadon1)){
    $outputct .='<h2>Người mua hàng: '. $row1['hoten'] .'</h2>
                <h2>Số điện thoại: '. $row1['dienthoai'] .'</h2>
                <h2>Địa chỉ: '. $row1['diachi'] .'</h2>
';
$sql_cthoadonnn=mysqli_query($connect,"SELECT * FROM hoadon WHERE mahd=$mahdd");            
while($roww=mysqli_fetch_array($sql_cthoadonnn)){
    $date2 = new DateTime($roww['ngay']);
        $formattedDate2 = $date2->format('d-m-Y');
        $outputct .= '<h2> Ngày tạo đơn: ' . $formattedDate2 . '</h2>';
        // $outputct .= '<h2>Tình trạng: '.$roww['trangthai'].'</h2>';
        if($roww['trangthai']==0){
            $outputct .= '<h2>Tình trạng: Chưa được xử lý</h2>';
        }
        if($roww['trangthai']==1){
            $outputct .= '<h2>Tình trạng: Đã được xử lý</h2>';
        }
        if($roww['trangthai']==2){
            $outputct .= '<h2>Tình trạng: Đang được xử lý</h2>';
        }
        if($roww['trangthai']==3){
            $outputct .= '<h2>Tình trạng: Khách hàng bỏ đơn</h2>';
        }
    }
    }
}
$outputct .= '<table>';

$outputct .='<tr style="margin:5px 0;" class="">
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
            </tr>
';
    $sql_cthoadon=mysqli_query($connect,"SELECT * FROM chitiethoadon WHERE mahd=$mahdd");            

if(mysqli_num_rows($sql_cthoadon)>0){
    $tongtienn=0;
    $thanhtiensp=0;
    while($row=mysqli_fetch_array($sql_cthoadon)){
        $outputct .='<tr style="margin:5px 0;" class="">
            <td class="seperate ">
                '.$row['masp'].'
            </td>';
            $sql_ctho1 = mysqli_query($connect, "SELECT * FROM sanpham WHERE masp='".$row['masp']."'");
while($row3 = mysqli_fetch_array($sql_ctho1)) {
    $outputct .= '<td class="seperate ">
        '.$row3['tensp'].'
    </td>';
    $thanhtiensp=$row3['dongia'];
}
        $outputct .='<td class="seperate ">
                '.$row['soluong'].'
                 </td>         
            <td class="seperate ">
                '.$row['dongia'].'
            </td> ';
            $outputct .='
            <td class="seperate ">
                '.$thanhtiensp.'
            </td> 
             </tr>
            </div>
            </div>';
        $tongtienn += $row['dongia'];
    }
    $outputct .= '</table>';
    $outputct .= '<h2>Tổng tiền: ' . $tongtienn . '</h2>';
    $outputct .= '<div class="cacchucnangnut">';
    $outputct .= '<button class="btn-dong">Đóng lại</button>';
    $sql_cthoadonn=mysqli_query($connect,"SELECT * FROM hoadon WHERE mahd=$mahdd");            
    while($row4 = mysqli_fetch_array($sql_cthoadonn)) {
        if($row4['trangthai']==0){
            // $outputct .= '<button style="margin-right:30px;" class="bthd-ddxl"  data-ttmp='.$tmp.' data-mhdddd='.$row4['mahd'].' data-mkhhhh='.$row4['makh'].'>Cho hóa đơn xử lý</button>';
            $outputct .= '<button class="bthd-hdh"  data-ttmp='.$tmp.' data-mhddddd='.$row4['mahd'].' data-mkhhhhh='.$row4['makh'].'>Hủy hóa đơn</button>';
        }
    }

}
else{
    $outputct .='
    </div>
        <tr>
            <td colspan="4">Dữ liệu chưa có</td> 
        </tr>
    ';
}
}

$outputtk='';
$outputtk .='
<div class="user_infor">
<span class="user_infor_exit"><i class="fa-solid fa-xmark"></i></span>
<i class="fa-solid fa-xmark"></i>
</span>
';

$sql_laythongtintk=mysqli_query($connect,"SELECT * FROM khachhang WHERE matk='" . $_COOKIE['username'] . "'");            
while($rolay=mysqli_fetch_array($sql_laythongtintk)){
    $outputtk .='
        <h1>Thông tin tài khoản</h1>
        <div>Tên tài khoản: '.$rolay['matk'].'</div>
        <div>Tên: '.$rolay['hoten'].'</div>
        <div>Địa chỉ: '.$rolay['diachi'].'</div>
    ';
}
$sql_laythongtintkk=mysqli_query($connect,"SELECT * FROM account WHERE username='" . $_COOKIE['username'] . "'");            
while($rolayy=mysqli_fetch_array($sql_laythongtintkk)){
    $datee1 = new DateTime($rolayy['ngaytao']);
    $formattedDatee1 = $datee1->format('d-m-Y');
    $outputtk .='
        <div>Ngày tạo: '.$formattedDatee1.'</div>
    ';
}
$outputtk .='
    </div>
';


$outputlsmh='';
// .= NỐI CHUỖI
$outputlsmh .= '    <div class="chuchitiet">ĐƠN HÀNG ĐANG ĐƯỢC XỬ LÝ</div>
';
$outputlsmh .= '
    <table class="table" style="width: 100%">
        <thead class="thead_dark">
        <tr>
            <th>
                Mã hóa đơn
            </th>
            <th>
                Mã khách hàng
            </th>
            <th>
                Mã nhân viên
            </th>
            <th>
                Ngày tạo
            </th>
            <th>
                Tổng tiền
            </th>
            <th>Trạng thái đơn hàng</th>

            <th>Xem chi tiết</th>
        </tr>
        </thead>
';
$sql_laymakh=mysqli_query($connect,"SELECT makh FROM khachhang WHERE hoten='" . $_COOKIE['username'] . "'");            
while($row1=mysqli_fetch_array($sql_laymakh)){
    $makhachhang =$row1['makh'] ;        
    $sql_trangthaihd=mysqli_query($connect,"SELECT * FROM hoadon WHERE makh=$makhachhang");            
if(mysqli_num_rows($sql_trangthaihd)>0){
    $i=1;
    while($row=mysqli_fetch_array($sql_trangthaihd)){
        $date = new DateTime($row['ngay']);
    $formattedDate = $date->format('d-m-Y');
        $outputlsmh .='
        <tr style="margin:5px 0;">
           
            <td class="seperate " style="text-align: center;">
                '.$row['mahd'].'
            </td>
            <td class="seperate " style="text-align: center;">
                '.$row['makh'].'
            </td>         
            <td class="seperate " style="text-align: center;">
                '.$row['manv'].'
            </td>
            <td class="seperate " style="text-align: center;">
                '.$formattedDate.'
            </td>
            <td class="seperate " style="text-align: center;">
            '.$row['tongtien'].'
        </td>';
        //     $outputlsmh .='  <td class="seperate " style="text-align: center;">
        //     Khách hàng đã hủy
        // </td>';
        if($row['trangthai']==0){
    $outputlsmh .='  <td class="seperate " style="text-align: center;">
            Chưa được xử lý
        </td>';       
     }
        if($row['trangthai']==1){
            $outputlsmh .='  <td class="seperate " style="text-align: center;">
            Đã xử lý
        </td>';       
     }
        if($row['trangthai']==2){
            $outputlsmh .='  <td class="seperate " style="text-align: center;">
            Đang được xử lý
        </td>';       
     }
        if($row['trangthai']==3){
            $outputlsmh .='  <td class="seperate " style="text-align: center;">
            Hóa đơn đã hủy
        </td>';       
     }
        $outputlsmh .=' <td class="seperate " >
        <button class="laythongtinhd" data-tmp=2  data-mhd='.$row['mahd'].' data-mkh='.$row['makh'].'>Xem</button>
    </td>
</tr>
';
    }
}}

if(isset($_POST['mhddddd'])){
    $mahoadonnn=$_POST['mhddddd'];
    mysqli_query($connect,"UPDATE  hoadon SET trangthai=3 WHERE mahd='$mahoadonnn'");

}


// ----------------TAO GIO HANG
$outputgiohang='';
$outputgiohang .='
<section class="cart">
    <i class="fa-solid fa-circle-xmark"></i>
    <h2>Giỏ hàng</h2>
<form action="ly.php" method="post">
        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Gía</th>
                    <th>Số Lượng</th>
                    <th>Chọn</th>

                </tr>
            </thead>

            <tbody class="tbodyy">
                   

            </tbody>
        </table>
        <div class="price-total">
            <p>Tổng tiền: <span>0</span><sup>đ</sup></p></p>
        
             <input id="tongtiensp"  name="giaca" value="0" style="display:none;"></input>

        </div>
        <button type="submit" name="chotd">Chốt đơn</button>
        <script type="text/javascript">
            function Kq(){
                alert("Bạn đã chốt đơn thành công");
            }
        </script>
</form>
</section>
';
// ----------------------
$response_array = array(
    "outputttdh" => $outputttdh,
    "outputct"=>$outputct,
    "outputlsmh" => $outputlsmh,
    "outputtk"=>$outputtk,
    "outputgiohang"=>$outputgiohang,
);
// Trả về dữ liệu dưới dạng JSON
echo json_encode($response_array);
?>

