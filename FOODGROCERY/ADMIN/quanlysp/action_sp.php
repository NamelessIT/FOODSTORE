<?php 
require '../../config/db.php'; 
//thêm dữ liệu vào database
if(isset($_POST['masp'])){
    $masp=$_POST['masp'];
    $tensp=$_POST['tensp'];
    $image=$_FILES['AnhSanPham']['name']; // Access uploaded file name from $_FILES
    $madm=$_POST['madm'];
    $dongia=$_POST['dongia'];
    $motasp=$_POST['motasp'];

    $target_dir = "../../image/"; // Directory where you want to store uploaded images
    $target_file = $target_dir . basename($_FILES["AnhSanPham"]["name"]);

    // Move uploaded file to the target directory
    move_uploaded_file($_FILES["AnhSanPham"]["tmp_name"], $target_file);

    mysqli_query($connect,"INSERT INTO sanpham (masp,tensp,image,dongia,madm,motasp,ishidden) 
    VALUES ('$masp','$tensp','$image','$dongia','$madm','$motasp',0)");
}


//edit dữ liệu từ database

if(isset($_POST['id'])){
    $masp_old=$_POST['id'];
    $text_new=$_POST['text'];
    $column_name=$_POST['column_name'];

    mysqli_query($connect,"UPDATE  sanpham SET $column_name='$text_new' WHERE masp='$masp_old'");
}


if (isset($_POST['id_image']) && isset($_POST['imageData'])) {
    $id_image=$_POST['id_image'];
    $image=$_FILES['imageData']['name']; // Access uploaded file name from $_FILES
    $column_name=$_POST['column_name'];


    $target_dir = "../../image/"; // Directory where you want to store uploaded images
    $target_file = $target_dir . basename($_FILES["imageData"]["name"]);

    // Move uploaded file to the target directory
    move_uploaded_file($_FILES["imageData"]["tmp_name"], $target_file);

    mysqli_query($connect,"UPDATE sanpham SET $column_name='$image' WHERE masp='$id_image'");
}


//xóa dữ liệu từ database

if(isset($_POST['id_xoa'])){
    $masp_del=$_POST['id_xoa'];


    mysqli_query($connect,"UPDATE  sanpham SET ishidden=1 WHERE masp='$masp_del'");
}

if(isset($_POST['id_xoa_hidden'])){
    $masp_del=$_POST['id_xoa_hidden'];


    mysqli_query($connect,"DELETE FROM sanpham WHERE masp='$masp_del'");
}

//khôi phục dữ liệu từ database

if(isset($_POST['id_back'])){
    $masp_back=$_POST['id_back'];


    mysqli_query($connect,"UPDATE  sanpham SET ishidden=0 WHERE masp='$masp_back'");
}



$output1='';
$sql_query1=mysqli_query($connect,"SELECT * FROM sanpham WHERE sanpham.ishidden=0 ");
// .= NỐI CHUỖI
$output1 .= '
    <table class="table" style="width: 100%">
        <thead class="thead_dark">
        <tr>
            <th>
                STT
            </th>
            <th>
                Mã sản phẩm
            </th>
            <th>
                Tên sản phẩm
            </th>
            <th>
                Ảnh
            </th>
            <th>
                Gía bán
            </th>
            <th>
                Loại
            </th>
            <th>
                Chi tiết
            </th>
            <th>
                Xóa
            </th>
        </tr>
        </thead>
';

if(mysqli_num_rows($sql_query1)>0){
    $i=0;
    while($row=mysqli_fetch_array($sql_query1)){
        $output1 .='
        <tr>
            <td class="seperate STT">
                '.$i++.'
            </td>
            <td class="seperate Masp" data-id2='.$row['masp'].' >
                '.$row['masp'].'
            </td>
            <td class="seperate Tensp" data-id2='.$row['masp'].' >
                '.$row['tensp'].'
            </td>
            <td class="seperate style="width:80px" >
                <img " src="../image/'.$row['image'].'" alt="Error" style="width:100px" >  
            </td>
            <td class="seperate " >
                '.$row['dongia'].'
            </td>
            <td class="seperate " >
                '.$row['madm'].'
            </td>
            <td class="seperate " >
                '.$row['motasp'].'
             </td>
            <td class="seperate ">
                <button class="Del_data" data-xoa='.$row['masp'].'>Xóa</button>
            </td>
        </tr>
        ';
    }
}
else{
    $output1 .='
        <tr>
            <td colspan="8">Dữ liệu chưa có</td> 
        </tr>
    ';
}

$output1 .='
    </table>
';

$output_hidden='';
$sql_query_hidden=mysqli_query($connect,"SELECT * FROM sanpham WHERE sanpham.ishidden=1 ");
// .= NỐI CHUỖI
$output_hidden .= '
    <table class="table" style="width: 100%">
        <thead class="thead_dark">
        <tr>
            <th>
                STT
            </th>
            <th>
                Mã sản phẩm
            </th>
            <th>
                Tên sản phẩm
            </th>
            <th>
                Ảnh
            </th>
            <th>
                Gía bán
            </th>
            <th>
                Loại
            </th>
            <th>
                Chi tiết
            </th>
            <th>
                Khôi phục
            </th>
            <th>
                Xóa
            </th>
        </tr>
        </thead>
';

if(mysqli_num_rows($sql_query_hidden)>0){
    $i=0;
    while($row=mysqli_fetch_array($sql_query_hidden)){
        $output_hidden .='
        <tr>
            <td class="seperate STT">
                '.$i++.'
            </td>
            <td class="seperate Masp" data-id2='.$row['masp'].' >
                '.$row['masp'].'
            </td>
            <td class="seperate Tensp" data-id2='.$row['masp'].' >
                '.$row['tensp'].'
            </td>
            <td class="seperate style="width:80px" >
                <img  src="../image/'.$row['image'].'" alt="Error" style="width:100px" contenteditable>  
            </td>
            <td class="seperate " >
                '.$row['dongia'].'
            </td>
            <td class="seperate " >
                '.$row['madm'].'
            </td>
            <td class="seperate " >
                '.$row['motasp'].'
             </td>
            <td class="seperate ">
             <button class="Back_hidden" data-back='.$row['masp'].'>KHÔI PHỤC</button>
            </td>
            <td class="seperate ">
                <button class="Del_data_hidden" data-xoa='.$row['masp'].'>Xóa</button>
            </td>
        </tr>
        ';
    }
}
else{
    $output_hidden .='
        <tr>
            <td colspan="8">Dữ liệu chưa có</td> 
        </tr>
    ';
}

$output_hidden .='
    </table>
';


//masp
$sql_masp="SELECT masp FROM sanpham ";
$query_masp=mysqli_query($connect,$sql_masp);
$list_masp=array();
    while ($row = mysqli_fetch_assoc($query_masp)) {
        // Thêm dòng dữ liệu vào mảng list_masp
        $list_masp[] = $row['masp'];
    }
//madm
$sql_madm="SELECT madm,tendm  FROM danhmuc WHERE ishidden=0";
$query_madm=mysqli_query($connect,$sql_madm);
$list_madm=array();
    while ($row = mysqli_fetch_assoc($query_madm)) {
        // Thêm dòng dữ liệu vào mảng list_madm
        $list_madm[] = $row;
    }
//masp có trong hóa đơn
$sql_masp_hoadon="SELECT masp FROM chitiethoadon ";
$query_masp_hoadon=mysqli_query($connect,$sql_masp_hoadon);
$list_masp_hoadon=array();
    while ($row = mysqli_fetch_assoc($query_masp_hoadon)) {
        // Thêm dòng dữ liệu vào mảng list_masp_hoadon
        $list_masp_hoadon[] = $row['masp'];
    }



//load dữ liệu từ database

$output='';
$sql_query=mysqli_query($connect,"SELECT * FROM sanpham WHERE sanpham.ishidden=0 ");
// .= NỐI CHUỖI
$output .= '
    <table class="table" style="width: 100%">
        <thead class="thead_dark">
        <tr>
            <th>
                STT
            </th>
            <th>
                Mã sản phẩm
            </th>
            <th>
                Tên sản phẩm
            </th>
            <th>
                Ảnh
            </th>
            <th>
                Gía bán
            </th>
            <th>
                Loại
            </th>
            <th>
                Chi tiết
            </th>
            <th>
                Xóa
            </th>
        </tr>
        </thead>
';

if(mysqli_num_rows($sql_query)>0){
    $i=0;
    while($row=mysqli_fetch_array($sql_query)){
        $output .='
        <tr style="margin:5px 0;">
            <td class="seperate STT">
                '.$i++.'
            </td>
            <td class="seperate Masp" data-id2='.$row['masp'].' contenteditable>
                '.$row['masp'].'
            </td>
            <td class="seperate Tensp" data-id2='.$row['masp'].' contenteditable>
                '.$row['tensp'].'
            </td>
            <td class="seperate style="width:80px" >
                <img class="Image" data-id2='.$row['masp'].' src="../image/'.$row['image'].'" alt="Error" style="width:100px" contenteditable>  
            </td>
            <td class="seperate Giaban" data-id2='.$row['masp'].' contenteditable>
                '.$row['dongia'].'
            </td>
            <td class="seperate Madm" style="position:relative" data-id2='.$row['masp'].' >
            <input  type="text" style="width: 50%;" data-id2='.$row['masp'].' value='.$row['madm'].' readonly required">    
                <div class="dropdown-content edit_content invisible" data-id2='.$row['masp'].' style="top:20%;display:block;scroll-behavior:auto;left:53%;min-width:90px;"> 
                   
                </div>
            </td>
            <td class="seperate Motasp" data-id2='.$row['masp'].' contenteditable>
                '.$row['motasp'].'
             </td>
            <td class="seperate ">
                <button class="Del_data" data-xoa='.$row['masp'].'>Xóa</button>
            </td>
        </tr>
        ';
    }
}
else{
    $output .='
        <tr>
            <td colspan="8">Dữ liệu chưa có</td> 
        </tr>
    ';
}

$output .='
    </table>
';



// echo $output1;
echo json_encode(array("output" => $output, 
                "output1" => $output1,
                "list_masp" => $list_masp,
                "list_madm"=>$list_madm,
                "list_masp_hoadon"=>$list_masp_hoadon,
                "output_hidden" => $output_hidden
            ));
?>
