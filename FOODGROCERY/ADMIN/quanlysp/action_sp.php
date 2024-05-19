<?php 
require '../../config/db.php'; 
//thêm dữ liệu vào database
if(isset($_POST['tensp'])){
    $tensp=$_POST['tensp'];
    $image=$_FILES['AnhSanPham']['name']; // Access uploaded file name from $_FILES
    $madm=$_POST['madm'];
    $dongia=$_POST['dongia'];
    $motasp=$_POST['motasp'];

    $target_dir = "../../image/"; // Directory where you want to store uploaded images
    $target_file = $target_dir . basename($_FILES["AnhSanPham"]["name"]);

    // Move uploaded file to the target directory
    move_uploaded_file($_FILES["AnhSanPham"]["tmp_name"], $target_file);

    mysqli_query($connect,"INSERT INTO sanpham (tensp,image,dongia,madm,motasp,ishidden) 
    VALUES ('$tensp','$image','$dongia','$madm','$motasp',0)");
    $masp = mysqli_insert_id($connect);
    // Thêm thông tin sản phẩm vào bảng kho
    mysqli_query($connect,"INSERT INTO kho (masp, soluong) VALUES ('$masp', 0)");

}
if(isset($_POST['tendm'])){
    $tendm=$_POST['tendm'];
    mysqli_query($connect,"INSERT INTO danhmuc (tendm,ishidden) VALUES ('$tendm',0)");
}
// thêm phiếu nhập và chitietphieunhap vào database
if(isset($_POST['rowCount'])){
    $rowCount = $_POST['rowCount'];
    $tableData = $_POST['tableData'];
    $tongtien = $_POST['tongtien'];
    $manv=$_POST['manv'];
    $ngaynhap=json_decode($_POST['ngaynhap']);

    mysqli_query($connect,"INSERT INTO phieunhap (manv,tongtien,ngaynhap) 
    VALUES ('$manv','$tongtien','$ngaynhap')");
    $ma_phieunhap = mysqli_insert_id($connect);
    // Thêm chitietphieunhap
    foreach ($tableData as $rowData) {
        mysqli_query($connect,"INSERT INTO chitietphieunhap (mapn,masp,soluong,gianhap,tongtien) VALUES ('$ma_phieunhap','$rowData[0]','$rowData[1]','$rowData[2]','$rowData[3]')");
        mysqli_query($connect,"UPDATE kho SET SOLUONG = SOLUONG + '$rowData[1]' WHERE masp = '$rowData[0]'");
    }

}
// mảng thể hiện quyền
$role = array();
$addproduct = $updateproduct = $deleteproduct = $deletedproducts = $buy = $printbill = $deletebill = $addpn = $deletpn = $addaccount = $updateaccount = $deleteaccount = $addrole = $addcategories = $updatecategories = $deletecategories = $statistics = 0;
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $mysqli_query_role = mysqli_query($connect, "SELECT * FROM account,quyen,role WHERE account.username='$username' AND account.username=quyen.username AND role.role_name=quyen.rolename");
    while ($row = mysqli_fetch_assoc($mysqli_query_role)) {
        // Tạo biến tương ứng với các cột ngoại trừ username, password, rolename, ishidden
        $addproduct = ($row['addproduct'] != 0) ? 1 : ($row['addproduct'] == 0 ? 0 : 1);
        $updateproduct = ($row['updateproduct'] != 0) ? 1 : ($row['updateproduct'] == 0 ? 0 : 1);
        $deleteproduct = ($row['deleteproduct'] != 0) ? 1 : ($row['deleteproduct'] == 0 ? 0 : 1);
        $deletedproducts = ($row['deletedproducts'] != 0) ? 1 : ($row['deletedproducts'] == 0 ? 0 : 1);
        $buy = ($row['buy'] != 0) ? 1 : ($row['buy'] == 0 ? 0 : 1);
        $printbill = ($row['printbill'] != 0) ? 1 : ($row['printbill'] == 0 ? 0 : 1);
        $deletebill = ($row['deletebill'] != 0) ? 1 : ($row['deletebill'] == 0 ? 0 : 1);
        $addpn = ($row['addpn'] != 0) ? 1 : ($row['addpn'] == 0 ? 0 : 1);
        $deletpn = ($row['deletpn'] != 0) ? 1 : ($row['deletpn'] == 0 ? 0 : 1);
        $addaccount = ($row['addaccount'] != 0) ? 1 : ($row['addaccount'] == 0 ? 0 : 1);
        $updateaccount = ($row['updateaccount'] != 0) ? 1 : ($row['updateaccount'] == 0 ? 0 : 1);
        $deleteaccount = ($row['deleteaccount'] != 0) ? 1 : ($row['deleteaccount'] == 0 ? 0 : 1);
        $addrole = ($row['addrole'] != 0) ? 1 : ($row['addrole'] == 0 ? 0 : 1);
        $addcategories = ($row['addcategories'] != 0) ? 1 : ($row['addcategories'] == 0 ? 0 : 1);
        $updatecategories = ($row['updatecategories'] != 0) ? 1 : ($row['updatecategories'] == 0 ? 0 : 1);
        $deletecategories = ($row['deletecategories'] != 0) ? 1 : ($row['deletecategories'] == 0 ? 0 : 1);
        $statistics = ($row['statistics'] != 0) ? 1 : ($row['statistics'] == 0 ? 0 : 1);
    }
}
        // Thêm các biến vào mảng $role
        $role[] = array(
            'addproduct' => $addproduct,
            'updateproduct' => $updateproduct,
            'deleteproduct' => $deleteproduct,
            'deletedproducts' => $deletedproducts,
            'buy' => $buy,
            'printbill' => $printbill,
            'deletebill' => $deletebill,
            'addpn' => $addpn,
            'deletpn' => $deletpn,
            'addaccount' => $addaccount,
            'updateaccount' => $updateaccount,
            'deleteaccount' => $deleteaccount,
            'addrole' => $addrole,
            'addcategories' => $addcategories,
            'updatecategories' => $updatecategories,
            'deletecategories' => $deletecategories,
            'statistics' => $statistics
        );
$nhanvien = array();
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $mysqli_query_role = mysqli_query($connect, "SELECT * FROM account,nhanvien WHERE account.username=nhanvien.matk AND account.username='$username'");
    while ($row = mysqli_fetch_assoc($mysqli_query_role)) {
        $nhanvien=$row;
    }
}

//edit dữ liệu từ database

if(isset($_POST['id'])){
    $masp_old=$_POST['id'];
    $text_new=$_POST['text'];
    $column_name=$_POST['column_name'];

    mysqli_query($connect,"UPDATE  sanpham SET $column_name='$text_new' WHERE masp='$masp_old'");
}

if (isset($_POST['id_image'])) {
    $id_image=$_POST['id_image'];
    $image=$_FILES['AnhSanPham']['name'];


    $target_dir = "../../image/"; // Directory where you want to store uploaded images
    $target_file = $target_dir . basename($_FILES["AnhSanPham"]["name"]);

    // Move uploaded file to the target directory
    move_uploaded_file($_FILES["AnhSanPham"]["tmp_name"], $target_file);
    mysqli_query($connect,"UPDATE sanpham SET image='$image' WHERE masp='$id_image'");
}

if(isset($_POST['edit_dm'])){
    $tendm=$_POST['edit_dm'];
    mysqli_query($connect,"UPDATE  danhmuc SET ishidden=0 WHERE tendm='$tendm'");
}


//xóa dữ liệu từ database

if(isset($_POST['id_xoa'])){
    $masp_del=$_POST['id_xoa'];


    mysqli_query($connect,"UPDATE  sanpham SET ishidden=1 WHERE masp='$masp_del'");
    mysqli_query($connect,"UPDATE  kho SET soluong=0 WHERE masp='$masp_del'");
}

if(isset($_POST['id_xoa_hidden'])){
    $masp_del=$_POST['id_xoa_hidden'];


    mysqli_query($connect,"DELETE FROM sanpham WHERE masp='$masp_del'");
    mysqli_query($connect,"DELETE FROM kho WHERE masp='$masp_del'");

}

//xóa phiếu nhập
if(isset($_POST['ma_phieu_nhap_xoa'])){
    $mapn=$_POST['ma_phieu_nhap_xoa'];
    $result = mysqli_query($connect, "SELECT masp, soluong FROM chitietphieunhap WHERE mapn='$mapn'");

    while($row = mysqli_fetch_assoc($result)) {
        $masp = $row['masp'];
        $soluong = $row['soluong'];

        mysqli_query($connect, "UPDATE kho 
        SET SOLUONG = CASE 
                        WHEN (SOLUONG > '$soluong') THEN SOLUONG - '$soluong' 
                        ELSE 0 
                    END 
        WHERE masp = '$masp'");
    }

    mysqli_query($connect,"DELETE FROM phieunhap WHERE mapn='$mapn'");
}

//xóa danh mục
if(isset($_POST['id_xoa_dm'])){
    $madm_del=$_POST['id_xoa_dm'];


    mysqli_query($connect,"UPDATE  danhmuc SET ishidden=1 WHERE madm='$madm_del'");
}
if(isset($_POST['id_xoa_dm_notin_sp'])){
    $madm_del=$_POST['id_xoa_dm_notin_sp'];


    mysqli_query($connect,"DELETE FROM danhmuc WHERE madm='$madm_del'");
}

//khôi phục dữ liệu từ database

if(isset($_POST['id_back'])){
    $masp_back=$_POST['id_back'];


    mysqli_query($connect,"UPDATE  sanpham SET ishidden=0 WHERE masp='$masp_back'");
}



$output1='';
if(isset($_POST['COT_SP'])){
    $cot_sp=$_POST['COT_SP'];
    $sort=$_POST['SORT_SP'];
    if($sort=='true'){
        $sql_query1=mysqli_query($connect,"SELECT * FROM sanpham,danhmuc,kho WHERE sanpham.ishidden=0 and sanpham.madm=danhmuc.madm and kho.masp=sanpham.masp ORDER BY $cot_sp DESC");
        
    }
    else{
        $sql_query1=mysqli_query($connect,"SELECT * FROM sanpham,danhmuc,kho WHERE sanpham.ishidden=0 and sanpham.madm=danhmuc.madm and kho.masp=sanpham.masp ORDER BY $cot_sp ASC");
    }
    // .= NỐI CHUỖI
    $output1 .= '
        <table class="table" style="width: 100%">
            <thead class="thead_dark">
            <tr>
                <th>
                    STT
                </th>
                <th class="sortable_sp '. ($cot_sp == "sanpham.masp" ? 'click' : '') . '" data-tk_sp="sanpham.masp" '. ($cot_sp == "sanpham.masp" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Mã sản phẩm
                </th>
                <th class="sortable_sp '. ($cot_sp == "sanpham.tensp" ? 'click' : '') . '" data-tk_sp="sanpham.tensp" '. ($cot_sp == "sanpham.tensp" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Tên sản phẩm
                </th>
                <th class="sortable_sp '. ($cot_sp == "sanpham.image" ? 'click' : '') . '" data-tk_sp="sanpham.image" '. ($cot_sp == "sanpham.image" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Ảnh
                </th>
                <th class="sortable_sp '. ($cot_sp == "kho.SOLUONG" ? 'click' : '') . '" data-tk_sp="kho.SOLUONG" '. ($cot_sp == "kho.SOLUONG" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Số lượng
                </th>
                <th class="sortable_sp '. ($cot_sp == "sanpham.dongia" ? 'click' : '') . '" data-tk_sp="sanpham.dongia" '. ($cot_sp == "sanpham.dongia" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Gía bán
                </th>
                <th class="sortable_sp '. ($cot_sp == "danhmuc.madm" ? 'click' : '') . '" data-tk_sp="danhmuc.madm" '. ($cot_sp == "danhmuc.madm" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
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
                '.$row['SOLUONG'].'
                </td>
                <td class="seperate " >
                    '.$row['dongia'].'
                </td>
                <td class="seperate " >
                    '.$row['tendm'].'
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
}

//output kết quả search
$output1_search='';
if(isset($_POST['SEARCH'])){
    $search=$_POST['SEARCH'];
    $cot_sp=$_POST['COT_SP'];
    $sort=$_POST['SORT_SP'];
    if($sort=='true'){
        $sql_query1 = mysqli_query($connect, "SELECT * FROM sanpham, danhmuc,kho WHERE sanpham.ishidden=0 AND sanpham.madm=danhmuc.madm AND sanpham.masp=kho.masp AND 
                                (sanpham.masp LIKE '%$search%' 
                                OR sanpham.tensp LIKE '%$search%' 
                                OR sanpham.image LIKE '%$search%' 
                                OR sanpham.dongia LIKE '%$search%'  
                                OR sanpham.motasp LIKE '%$search%'
                                OR danhmuc.tendm LIKE '%$search%') 
                                ORDER BY $cot_sp DESC");
        
    }
    else{
        $sql_query1 = mysqli_query($connect, "SELECT * FROM sanpham, danhmuc,kho WHERE sanpham.ishidden=0 AND sanpham.madm=danhmuc.madm AND sanpham.masp=kho.masp AND 
                                (sanpham.masp LIKE '%$search%' 
                                OR sanpham.tensp LIKE '%$search%' 
                                OR sanpham.image LIKE '%$search%' 
                                OR sanpham.dongia LIKE '%$search%'  
                                OR sanpham.motasp LIKE '%$search%'
                                OR danhmuc.tendm LIKE '%$search%')
                                ORDER BY $cot_sp ASC");
    }
    // .= NỐI CHUỖI
    $output1_search .= '
        <table class="table" style="width: 100%">
            <thead class="thead_dark">
            <tr>
                <th>
                    STT
                </th>
                <th class="sortable_sp '. ($cot_sp == "sanpham.masp" ? 'click' : '') . '" data-tk_sp="sanpham.masp" '. ($cot_sp == "sanpham.masp" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Mã sản phẩm
                </th>
                <th class="sortable_sp '. ($cot_sp == "sanpham.tensp" ? 'click' : '') . '" data-tk_sp="sanpham.tensp" '. ($cot_sp == "sanpham.tensp" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Tên sản phẩm
                </th>
                <th class="sortable_sp '. ($cot_sp == "sanpham.image" ? 'click' : '') . '" data-tk_sp="sanpham.image" '. ($cot_sp == "sanpham.image" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Ảnh
                </th>
                <th class="sortable_sp '. ($cot_sp == "kho.SOLUONG" ? 'click' : '') . '" data-tk_sp="kho.SOLUONG" '. ($cot_sp == "kho.SOLUONG" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                Số lượng
                </th>
                <th class="sortable_sp '. ($cot_sp == "sanpham.dongia" ? 'click' : '') . '" data-tk_sp="sanpham.dongia" '. ($cot_sp == "sanpham.dongia" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Gía bán
                </th>
                <th class="sortable_sp '. ($cot_sp == "danhmuc.madm" ? 'click' : '') . '" data-tk_sp="danhmuc.madm" '. ($cot_sp == "danhmuc.madm" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
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
            $output1_search .='
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
                '.$row['SOLUONG'].'
                </td>
                <td class="seperate " >
                    '.$row['dongia'].'
                </td>
                <td class="seperate " >
                    '.$row['tendm'].'
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
        $output1_search .='
            <tr>
                <td colspan="8">Dữ liệu chưa có</td> 
            </tr>
        ';
    }
    
    $output1_search .='
        </table>
    ';
}

$output_hidden='';
if(isset($_POST['COT_SP_HIDDEN'])){
    $cot_sp=$_POST['COT_SP_HIDDEN'];
    $sort=$_POST['SORT_SP_HIDDEN'];
    if($sort=='true'){
        $sql_query_hidden=mysqli_query($connect,"SELECT * FROM sanpham,danhmuc WHERE sanpham.ishidden=1 and sanpham.madm=danhmuc.madm ORDER BY $cot_sp DESC");
        
    }
    else{
        $sql_query_hidden=mysqli_query($connect,"SELECT * FROM sanpham,danhmuc WHERE sanpham.ishidden=1 and sanpham.madm=danhmuc.madm ORDER BY $cot_sp ASC");
    }
// .= NỐI CHUỖI
$output_hidden .= '
    <table class="table" style="width: 100%">
        <thead class="thead_dark">
        <tr>
            <th>
                STT
            </th>
            <th class="sortable_sp_hidden '. ($cot_sp == "sanpham.masp" ? 'click' : '') . '" data-tk_sp_hidden="sanpham.masp" '. ($cot_sp == "sanpham.masp" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                Mã sản phẩm
            </th>
            <th class="sortable_sp_hidden '. ($cot_sp == "sanpham.tensp" ? 'click' : '') . '" data-tk_sp_hidden="sanpham.tensp" '. ($cot_sp == "sanpham.tensp" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                Tên sản phẩm
            </th>
            <th class="sortable_sp_hidden '. ($cot_sp == "sanpham.image" ? 'click' : '') . '" data-tk_sp_hidden="sanpham.image" '. ($cot_sp == "sanpham.image" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                Ảnh
            </th>
            <th class="sortable_sp_hidden '. ($cot_sp == "sanpham.dongia" ? 'click' : '') . '" data-tk_sp_hidden="sanpham.dongia" '. ($cot_sp == "sanpham.dongia" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                Gía bán
            </th>
            <th class="sortable_sp_hidden '. ($cot_sp == "danhmuc.madm" ? 'click' : '') . '" data-tk_sp_hidden="danhmuc.madm" '. ($cot_sp == "danhmuc.madm" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
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
}


$output_hidden_search='';
if(isset($_POST['SEARCH_Xoa'])){
    $search=$_POST['SEARCH_Xoa'];
    $cot_sp=$_POST['COT_SP_HIDDEN'];
    $sort=$_POST['SORT_SP_HIDDEN'];
    if($sort=='true'){
        $sql_query_hidden = mysqli_query($connect, "SELECT * FROM sanpham, danhmuc WHERE sanpham.ishidden=1 AND sanpham.madm=danhmuc.madm AND 
                                (sanpham.masp LIKE '%$search%' 
                                OR sanpham.tensp LIKE '%$search%' 
                                OR sanpham.image LIKE '%$search%' 
                                OR sanpham.dongia LIKE '%$search%'  
                                OR sanpham.motasp LIKE '%$search%'
                                OR danhmuc.tendm LIKE '%$search%') 
                                ORDER BY $cot_sp DESC");
    }
    else{
        $sql_query_hidden = mysqli_query($connect, "SELECT * FROM sanpham, danhmuc WHERE sanpham.ishidden=1 AND sanpham.madm=danhmuc.madm AND 
                                (sanpham.masp LIKE '%$search%' 
                                OR sanpham.tensp LIKE '%$search%' 
                                OR sanpham.image LIKE '%$search%' 
                                OR sanpham.dongia LIKE '%$search%'  
                                OR sanpham.motasp LIKE '%$search%'
                                OR danhmuc.tendm LIKE '%$search%') 
                                ORDER BY $cot_sp ASC");
    }
// .= NỐI CHUỖI
$output_hidden_search .= '
    <table class="table" style="width: 100%">
        <thead class="thead_dark">
        <tr>
            <th>
                STT
            </th>
            <th class="sortable_sp_hidden '. ($cot_sp == "sanpham.masp" ? 'click' : '') . '" data-tk_sp_hidden="sanpham.masp" '. ($cot_sp == "sanpham.masp" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                Mã sản phẩm
            </th>
            <th class="sortable_sp_hidden '. ($cot_sp == "sanpham.tensp" ? 'click' : '') . '" data-tk_sp_hidden="sanpham.tensp" '. ($cot_sp == "sanpham.tensp" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                Tên sản phẩm
            </th>
            <th class="sortable_sp_hidden '. ($cot_sp == "sanpham.image" ? 'click' : '') . '" data-tk_sp_hidden="sanpham.image" '. ($cot_sp == "sanpham.image" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                Ảnh
            </th>
            <th class="sortable_sp_hidden '. ($cot_sp == "sanpham.dongia" ? 'click' : '') . '" data-tk_sp_hidden="sanpham.dongia" '. ($cot_sp == "sanpham.dongia" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                Gía bán
            </th>
            <th class="sortable_sp_hidden '. ($cot_sp == "danhmuc.madm" ? 'click' : '') . '" data-tk_sp_hidden="danhmuc.madm" '. ($cot_sp == "danhmuc.madm" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
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
        $output_hidden_search .='
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
    $output_hidden_search .='
        <tr>
            <td colspan="8">Dữ liệu chưa có</td> 
        </tr>
    ';
}

$output_hidden_search .='
    </table>
';
}

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
//madm không ẩn
$sql_madm_all="SELECT *  FROM danhmuc ";
$query_madm_all=mysqli_query($connect,$sql_madm_all);
$list_madm_all=array();
    while ($row = mysqli_fetch_assoc($query_madm_all)) {
        // Thêm dòng dữ liệu vào mảng list_madm
        $list_madm_all[] = $row;
    }
//madm trong sản phẩm
$sql_madm_sp="SELECT *  FROM sanpham,danhmuc WHERE sanpham.madm=danhmuc.madm";
$query_madm_sp=mysqli_query($connect,$sql_madm_sp);
$list_madm_sp=array();
    while ($row = mysqli_fetch_assoc($query_madm_sp)) {
        // Thêm dòng dữ liệu vào mảng list_madm
        $list_madm_sp[] = $row;
    }
//masp có trong hóa đơn
$sql_masp_hoadon="SELECT masp FROM chitiethoadon ";
$query_masp_hoadon=mysqli_query($connect,$sql_masp_hoadon);
$list_masp_hoadon=array();
    while ($row = mysqli_fetch_assoc($query_masp_hoadon)) {
        // Thêm dòng dữ liệu vào mảng list_masp_hoadon
        $list_masp_hoadon[] = $row['masp'];
    }
// masp có trong phiếu nhập
$sql_masp_phieunhap="SELECT masp FROM chitietphieunhap ";
$query_masp_phieunhap=mysqli_query($connect,$sql_masp_phieunhap);
$list_masp_phieunhap=array();
    while ($row = mysqli_fetch_assoc($query_masp_phieunhap)) {
        // Thêm dòng dữ liệu vào mảng list_masp_phieunhap
        $list_masp_phieunhap[] = $row['masp'];
    }
//masp+tênsp
$list_masp_tensp='';
$sql_query_dm=mysqli_query($connect,"SELECT * FROM sanpham WHERE sanpham.ishidden=0");
// .= NỐI CHUỖI
$list_masp_tensp .= '
    <table class="table" style="width: 100%;position: absolute;background-color:#fff;border-radius:15px;border: 1px #333 solid;">
        <thead class="thead_dark">
        </thead>
        <tr style="margin:5px 0;">
    </tr>
';

if(mysqli_num_rows($sql_query_dm)>0){
    $i=0;
    while($row=mysqli_fetch_array($sql_query_dm)){
        $list_masp_tensp .='
        <tr style="margin:5px 0;">
            <td class="seperate TenSP_PN" data-masppn="'.$row['masp'].'" data-tensppn="'.$row['tensp'].'" data-tiensppn="'.$row['dongia'].'" style="text-align:center">
                '.$row['masp'].'-'.$row['tensp'].'
            </td>
        </tr>
        ';
    }
}
else{
    $list_masp_tensp .='
        <tr>
            <td colspan="8">Dữ liệu chưa có</td> 
        </tr>
    ';
}

$list_masp_tensp .='
    </table>
';
//nhân viên
$list_manv_tennv='';
$sql_query_nv=mysqli_query($connect,"SELECT * FROM nhanvien ");
// .= NỐI CHUỖI
$list_manv_tennv .= '
    <table class="table" style="width: 19%;position: absolute;background-color:#fff;border-radius:15px;border: 1px #333 solid;">
        <thead class="thead_dark">
        </thead>
        <tr style="margin:5px 0;">
    </tr>
';

if(mysqli_num_rows($sql_query_nv)>0){
    while($row=mysqli_fetch_array($sql_query_nv)){
        $list_manv_tennv .='
        <tr style="margin:5px 0;">
            <td class="seperate NhanVien_PN" data-manv="'.$row['manv'].'" data-tennv="'.$row['hoten'].'" style="text-align:center">
                '.$row['manv'].'-'.$row['hoten'].'
            </td>
        </tr>
        ';
    }
}
else{
    $list_manv_tennv .='
        <tr>
            <td colspan="1">Dữ liệu chưa có</td> 
        </tr>
    ';
}

$list_manv_tennv .='
    </table>
';


//load dữ liệu từ database
//output sửa
$output='';
$sql_query=mysqli_query($connect,"SELECT * FROM sanpham,danhmuc WHERE sanpham.ishidden=0 and sanpham.madm=danhmuc.madm");
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
            <td class="seperate style="width:80px;" >
                <img class="Image" data-id2='.$row['masp'].' src="../image/'.$row['image'].'" alt="Error" style="width:100px" contenteditable>  
            </td>
            <td class="seperate Giaban" data-id2='.$row['masp'].' contenteditable>
                '.$row['dongia'].'
            </td>
            <td class="seperate Madm" style="position:relative" data-id2='.$row['masp'].' >
            <input  type="text" style="width: 50%;" data-id2='.$row['masp'].' value='.$row['tendm'].' readonly required">    
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

//output for danh mục
$output_dm='';
$sql_query_dm=mysqli_query($connect,"SELECT * FROM danhmuc WHERE danhmuc.ishidden=0");
// .= NỐI CHUỖI
$output_dm .= '
    <table class="table" style="width: 100%">
        <thead class="thead_dark">
        <tr>
            <th>
                STT
            </th>
            <th>
                Tên danh mục
            </th>
            <th>
                Xóa
            </th>
        </tr>
        </thead>
';

if(mysqli_num_rows($sql_query_dm)>0){
    $i=0;
    while($row=mysqli_fetch_array($sql_query_dm)){
        $output_dm .='
        <tr style="margin:5px 0;">
            <td class="seperate STT">
                '.$i++.'
            </td>
            <td class="seperate Tendm" >
                '.$row['tendm'].'
            </td>
            <td class="seperate Del_dm" style="display: flex;justify-content: center;" data-dm='.$row['madm'].'>
                <button >Xóa</button>
            </td>
        </tr>
        ';
    }
}
else{
    $output_dm .='
        <tr>
            <td colspan="8">Dữ liệu chưa có</td> 
        </tr>
    ';
}

$output_dm .='
    </table>
';

$output_dm_THONGKE='';
$sql_query_dm=mysqli_query($connect,"SELECT * FROM danhmuc WHERE danhmuc.ishidden=0");
// .= NỐI CHUỖI
$output_dm_THONGKE .= '
    <table class="table" style="width: 100%">
        <thead class="thead_dark">
        </thead>
        <tr style="margin:5px 0;">
        <td class="seperate Tendm_thongke" data-tk="Tất cả" >
            Tất cả
        </td>
    </tr>
';

if(mysqli_num_rows($sql_query_dm)>0){
    $i=0;
    while($row=mysqli_fetch_array($sql_query_dm)){
        $output_dm_THONGKE .='
        <tr style="margin:5px 0;">
            <td class="seperate Tendm_thongke" data-tk="'.$row['tendm'].'" >
                '.$row['tendm'].'
            </td>
        </tr>
        ';
    }
}
else{
    $output_dm_THONGKE .='
        <tr>
            <td colspan="8">Dữ liệu chưa có</td> 
        </tr>
    ';
}

$output_dm_THONGKE .='
    </table>
';

$output_phieu_nhap='';
$sql_query_phieu_nhap=mysqli_query($connect,"SELECT * FROM phieunhap ");
// .= NỐI CHUỖI
$output_phieu_nhap .= '
    <table class="table" style="width: 100%">
        <thead class="thead_dark">
        <tr>
            <th>
                STT
            </th>
            <th>
                Mã phiếu nhập
            </th>
            <th>
                Mã nhân viên
            </th>
            <th>
                Tổng tiền
            </th>
            <th>
                Ngày nhập
            </th>
            <th>
                Xóa
            </th>
        </tr>
        </thead>
';

if(mysqli_num_rows($sql_query_phieu_nhap)>0){
    $i=0;
    while($row=mysqli_fetch_array($sql_query_phieu_nhap)){
        $output_phieu_nhap .='
        <tr style="margin:5px 0;" class="SHOW_CT" data-id_phieunhap='.$row['mapn'].'>
            <td class="seperate STT">
                '.$i++.'
            </td>
            <td class="seperate">
                '.$row['mapn'].'
            </td>
            <td class="seperate">
                '.$row['manv'].'
            </td>
            <td class="seperate">
            '.$row['tongtien'].'
            </td>
            <td class="seperate" >
            '.$row['ngaynhap'].'
            </td>
            <td class="seperate ">
                <button class="Del_phieu_nhap " data-id_phieunhap='.$row['mapn'].' data-ngnpn='.$row['ngaynhap'].'>Xóa</button>
            </td>
        </tr>
        ';
    }
}
else{
    $output_phieu_nhap .='
        <tr>
            <td colspan="4">Dữ liệu chưa có</td> 
        </tr>
    ';
}

$output_phieu_nhap .='
    </table>
';

$output_phieu_nhap_search='';
if(isset($_POST['SEARCH_PN'])){
$search=$_POST['SEARCH_PN'];
$Ngay_Start = $_POST['Ngay_Start'];
$Ngay_End = $_POST['Ngay_End'];
$sql_query_phieu_nhap = "SELECT * FROM phieunhap WHERE ";

// Kiểm tra điều kiện SEARCH_PN và Ngay_Start, Ngay_End
if (!empty($search) && empty($Ngay_Start) && empty($Ngay_End)) {
    // Nếu SEARCH_PN có giá trị, nhưng Ngay_Start và Ngay_End không, thực hiện truy vấn theo chỉ tiêu tìm kiếm
    $sql_query_phieu_nhap .= "(phieunhap.mapn LIKE '%$search%' 
                        OR phieunhap.manv LIKE '%$search%' 
                        OR phieunhap.tongtien LIKE '%$search%' 
                        OR phieunhap.ngaynhap LIKE '%$search%')";
} elseif (empty($search) && !empty($Ngay_Start) && !empty($Ngay_End)) {
    // Nếu SEARCH_PN không có giá trị, nhưng Ngay_Start và Ngay_End có giá trị, thực hiện truy vấn theo khoảng ngày
    $sql_query_phieu_nhap .= "phieunhap.ngaynhap BETWEEN '$Ngay_Start' AND '$Ngay_End'";
} elseif (!empty($search) && !empty($Ngay_Start) && !empty($Ngay_End)) {
    // Nếu cả SEARCH_PN và Ngay_Start, Ngay_End đều có giá trị, thực hiện truy vấn theo cả hai chỉ tiêu
    $sql_query_phieu_nhap .= "phieunhap.ngaynhap BETWEEN '$Ngay_Start' AND '$Ngay_End' AND 
                        (phieunhap.mapn LIKE '%$search%' 
                        OR phieunhap.manv LIKE '%$search%' 
                        OR phieunhap.tongtien LIKE '%$search%' 
                        OR phieunhap.ngaynhap LIKE '%$search%')";
} else {
    // Trường hợp còn lại, không có điều kiện nào được áp dụng
    $sql_query_phieu_nhap .= "1"; // Đây là một điều kiện giả để trả về tất cả các hàng
}

$sql_query_phieu_nhap = mysqli_query($connect, $sql_query_phieu_nhap);
// .= NỐI CHUỖI
$output_phieu_nhap_search .= '
    <table class="table" style="width: 100%">
        <thead class="thead_dark">
        <tr>
            <th>
                STT
            </th>
            <th>
                Mã phiếu nhập
            </th>
            <th>
                Mã nhân viên
            </th>
            <th>
                Tổng tiền
            </th>
            <th>
                Ngày nhập
            </th>
            <th>
                Xóa
            </th>
        </tr>
        </thead>
';

if(mysqli_num_rows($sql_query_phieu_nhap)>0){
    $i=0;
    while($row=mysqli_fetch_array($sql_query_phieu_nhap)){
        $output_phieu_nhap_search .='
        <tr style="margin:5px 0;" class="SHOW_CT" data-id_phieunhap='.$row['mapn'].'>
            <td class="seperate STT">
                '.$i++.'
            </td>
            <td class="seperate">
                '.$row['mapn'].'
            </td>
            <td class="seperate">
                '.$row['manv'].'
            </td>
            <td class="seperate">
            '.$row['tongtien'].'
            </td>
            <td class="seperate">
            '.$row['ngaynhap'].'
            </td>
            <td class="seperate ">
                <button class="Del_phieu_nhap" data-id_phieunhap='.$row['mapn'].'>Xóa</button>
            </td>
        </tr>
        ';
    }
}
else{
    $output_phieu_nhap_search .='
        <tr>
            <td colspan="4">Dữ liệu chưa có</td> 
        </tr>
    ';
}

$output_phieu_nhap_search .='
    </table>
';
}
//chitietphieunhap


$output_chi_tiet_phieu_nhap='';
if(isset($_POST['ma_phieu_nhap'])){
    $mapn=$_POST['ma_phieu_nhap'];
$sql_query_chi_tiet_phieu_nhap=mysqli_query($connect,"SELECT * FROM chitietphieunhap,sanpham WHERE mapn=$mapn AND sanpham.masp=chitietphieunhap.masp");
// .= NỐI CHUỖI
$output_chi_tiet_phieu_nhap .= '
    <table class="table" style="width: 100%">
        <thead class="thead_dark">
        <tr>
            <th>
                Mã phiếu nhập
            </th>
            <th>
                Mã sản phẩm
            </th>
            <th>
                Tên sản phẩm
            </th>
            <th>
                số lượng
            </th>
            <th>
                giá nhập
            </th>
            <th>
                Tổng tiền
            </th>
        </tr>
        </thead>
';

if(mysqli_num_rows($sql_query_chi_tiet_phieu_nhap)>0){
    while($row=mysqli_fetch_array($sql_query_chi_tiet_phieu_nhap)){
        $output_chi_tiet_phieu_nhap .='
        <tr style="margin:5px 0;">
            <td class="seperate">
                '.$row['mapn'].'
            </td>
            <td class="seperate">
                '.$row['masp'].'
            </td>
            <td class="seperate">
            '.$row['tensp'].'
            </td>
            <td class="seperate">
            '.$row['soluong'].'
            </td>
            <td class="seperate">
            '.$row['gianhap'].'
            </td>
            <td class="seperate">
            '.$row['tongtien'].'
            </td>
        </tr>
        ';
    }
}
else{
    $output_chi_tiet_phieu_nhap .='
        <tr>
            <td colspan="4">Dữ liệu chưa có</td> 
        </tr>
    ';
}

$output_chi_tiet_phieu_nhap .='
    </table>
';
}
//output thống kê 
//tuần
$output_thongke_tuan_SUM='';
if(isset($_POST['option'])){
    $option = $_POST['option'];
    $response = array();
    $max_value = 1;
    for ($week = 1; $week <= 4; $week++) {
        $sql = "SELECT SUM(tongtien) AS total FROM hoadon WHERE ROUND(WEEK(ngay, 3)/4-1,0) = $week AND MONTH(ngay) = $option";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        $response["week_$week"] = $row['total'] ?? 0;
        $max_value = max($max_value, $response["week_$week"]);
    }
    $output_thongke_tuan_SUM .= '<div class="chart-layout">';
    foreach ($response as $key => $value) {
        $output_thongke_tuan_SUM .= '
            <div class="chart_layout_item" style="--percent:' . ($value / $max_value * 100) . '%;align-self:flex-end;width:60px;color:#333;text-align:center;height:var(--percent);background-color:#EF5122">' . $value . '</div>
        ';
    }

    $output_thongke_tuan_SUM .= '</div>'; // Đóng thẻ div.chart-layout
}

$output_thongke_tuan_AVERAGE='';
if(isset($_POST['option'])){
    $option = $_POST['option'];
    $response = array();
    $max_value = 1;
    for ($week = 1; $week <= 4; $week++) {
        $sql = "SELECT ROUND(AVG(tongtien),2) AS total FROM hoadon WHERE ROUND(WEEK(ngay, 3)/4-1,0) = $week AND MONTH(ngay) = $option";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        $response["week_$week"] = $row['total'] ?? 0;
        $max_value = max($max_value, $response["week_$week"]);
    }
    $output_thongke_tuan_AVERAGE .= '<div class="chart-layout">';
    foreach ($response as $key => $value) {
        $output_thongke_tuan_AVERAGE .= '
            <div class="chart_layout_item" style="--percent:' . ($value / $max_value * 100) . '%;align-self:flex-end;width:60px;color:#333;text-align:center;height:var(--percent);background-color:#EF5122">' . $value . '</div>
        ';
    }

    $output_thongke_tuan_AVERAGE .= '</div>'; // Đóng thẻ div.chart-layout
}

$output_thongke_tuan_COUNT='';
if(isset($_POST['option'])){
    $option = $_POST['option'];
    $response = array();
    $max_value = 1;
    for ($week = 1; $week <= 4; $week++) {
        $sql = "SELECT COUNT(*) AS total FROM hoadon WHERE ROUND(WEEK(ngay, 3)/4-1,0) = $week AND MONTH(ngay) = $option";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        $response["week_$week"] = $row['total'] ?? 0;
        $max_value = max($max_value, $response["week_$week"]);
    }
    $output_thongke_tuan_COUNT .= '<div class="chart-layout">';
    foreach ($response as $key => $value) {
        $output_thongke_tuan_COUNT .= '
            <div class="chart_layout_item" style="--percent:' . ($value / $max_value * 100) . '%;align-self:flex-end;width:60px;color:#333;text-align:center;height:var(--percent);background-color:#EF5122">' . $value . '</div>
        ';
    }

    $output_thongke_tuan_COUNT .= '</div>'; // Đóng thẻ div.chart-layout
}

$output_thongke_tuan_MAX='';
if(isset($_POST['option'])){
    $option = $_POST['option'];
    $response = array();
    $max_value = 1;
    for ($week = 1; $week <= 4; $week++) {
        $sql = "SELECT MAX(tongtien) AS total FROM hoadon WHERE ROUND(WEEK(ngay, 3)/4-1,0) = $week AND MONTH(ngay) = $option";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        $response["week_$week"] = $row['total'] ?? 0;
        $max_value = max($max_value, $response["week_$week"]);
    }
    $output_thongke_tuan_MAX .= '<div class="chart-layout">';
    foreach ($response as $key => $value) {
        $output_thongke_tuan_MAX .= '
            <div class="chart_layout_item" style="--percent:' . ($value / $max_value * 100) . '%;align-self:flex-end;width:60px;color:#333;text-align:center;height:var(--percent);background-color:#EF5122">' . $value . '</div>
        ';
    }

    $output_thongke_tuan_MAX .= '</div>'; // Đóng thẻ div.chart-layout
}

$output_thongke_tuan_MIN='';
if(isset($_POST['option'])){
    $option = $_POST['option'];
    $response = array();
    $max_value = 1;
    for ($week = 1; $week <= 4; $week++) {
        $sql = "SELECT MIN(tongtien) AS total FROM hoadon WHERE ROUND(WEEK(ngay, 3)/4-1,0) = $week AND MONTH(ngay) = $option";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        $response["week_$week"] = $row['total'] ?? 0;
        $max_value = max($max_value, $response["week_$week"]);
    }
    $output_thongke_tuan_MIN .= '<div class="chart-layout">';
    foreach ($response as $key => $value) {
        $output_thongke_tuan_MIN .= '
            <div class="chart_layout_item" style="--percent:' . ($value / $max_value * 100) . '%;align-self:flex-end;width:60px;color:#333;text-align:center;height:var(--percent);background-color:#EF5122">' . $value . '</div>
        ';
    }

    $output_thongke_tuan_MIN .= '</div>'; // Đóng thẻ div.chart-layout
}
//NĂM
$output_thongke_year_SUM='';
    $response = array();
    $max_value = 1;
    for ($month = 1; $month <= 12; $month++) {
        $sql = "SELECT SUM(tongtien) AS total FROM hoadon WHERE  MONTH(ngay) = $month";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        $response["month_$month"] = $row['total'] ?? 0;
        $max_value = max($max_value, $response["month_$month"]);
    }
    $output_thongke_year_SUM .= '<div class="chart-layout">';
    foreach ($response as $key => $value) {
        $output_thongke_year_SUM .= '
            <div class="chart_layout_item" style="--percent:' . ($value / $max_value * 100) . '%;align-self:flex-end;width:60px;color:#333;text-align:center;height:var(--percent);background-color:#EF5122">' . $value . '</div>
        ';
    }

    $output_thongke_year_SUM .= '</div>'; // Đóng thẻ div.chart-layout



    $output_thongke_year_AVG='';
    $response = array();
    $max_value = 1;
    for ($month = 1; $month <= 12; $month++) {
        $sql = "SELECT ROUND(AVG(tongtien),2) AS total FROM hoadon WHERE  MONTH(ngay) = $month";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        $response["month_$month"] = $row['total'] ?? 0;
        $max_value = max($max_value, $response["month_$month"]);
    }
    $output_thongke_year_AVG .= '<div class="chart-layout">';
    foreach ($response as $key => $value) {
        $output_thongke_year_AVG .= '
            <div class="chart_layout_item" style="--percent:' . ($value / $max_value * 100) . '%;align-self:flex-end;width:60px;color:#333;text-align:center;height:var(--percent);background-color:#EF5122">' . $value . '</div>
        ';
    }

    $output_thongke_year_AVG .= '</div>'; // Đóng thẻ div.chart-layout

    $output_thongke_year_COUNT='';
    $response = array();
    $max_value = 1;
    for ($month = 1; $month <= 12; $month++) {
        $sql = "SELECT COUNT(*) AS total FROM hoadon WHERE  MONTH(ngay) = $month";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        $response["month_$month"] = $row['total'] ?? 0;
        $max_value = max($max_value, $response["month_$month"]);
    }
    $output_thongke_year_COUNT .= '<div class="chart-layout">';
    foreach ($response as $key => $value) {
        $output_thongke_year_COUNT .= '
            <div class="chart_layout_item" style="--percent:' . ($value / $max_value * 100) . '%;align-self:flex-end;width:60px;color:#333;text-align:center;height:var(--percent);background-color:#EF5122">' . $value . '</div>
        ';
    }

    $output_thongke_year_COUNT .= '</div>'; // Đóng thẻ div.chart-layout


    $output_thongke_year_MAX='';
    $response = array();
    $max_value = 1;
    for ($month = 1; $month <= 12; $month++) {
        $sql = "SELECT MAX(tongtien) AS total FROM hoadon WHERE  MONTH(ngay) = $month";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        $response["month_$month"] = $row['total'] ?? 0;
        $max_value = max($max_value, $response["month_$month"]);
    }
    $output_thongke_year_MAX .= '<div class="chart-layout">';
    foreach ($response as $key => $value) {
        $output_thongke_year_MAX .= '
            <div class="chart_layout_item" style="--percent:' . ($value / $max_value * 100) . '%;align-self:flex-end;width:60px;color:#333;text-align:center;height:var(--percent);background-color:#EF5122">' . $value . '</div>
        ';
    }

    $output_thongke_year_MAX .= '</div>'; // Đóng thẻ div.chart-layout


    $output_thongke_year_MIN='';
    $response = array();
    $max_value = 1;
    for ($month = 1; $month <= 12; $month++) {
        $sql = "SELECT MIN(tongtien) AS total FROM hoadon WHERE  MONTH(ngay) = $month";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        $response["month_$month"] = $row['total'] ?? 0;
        $max_value = max($max_value, $response["month_$month"]);
    }
    $output_thongke_year_MIN .= '<div class="chart-layout">';
    foreach ($response as $key => $value) {
        $output_thongke_year_MIN .= '
            <div class="chart_layout_item" style="--percent:' . ($value / $max_value * 100) . '%;align-self:flex-end;width:60px;color:#333;text-align:center;height:var(--percent);background-color:#EF5122">' . $value . '</div>
        ';
    }

    $output_thongke_year_MIN .= '</div>'; // Đóng thẻ div.chart-layout


// thống kê top các sản phẩm CÙNG LOẠI
// ///////////////////////////////////////////////////////
$output_top='';
if(isset($_POST['DANHMUC'])){
    $danhmuc=$_POST['DANHMUC'];
    $start = $_POST['START'];
    $end=$_POST['END'];
    $cot=$_POST['COT1'];
    $sort=$_POST['SORT1'];
    if($sort=='true'){
        if($danhmuc!='Tất cả'){
            $sql_query=mysqli_query($connect,"SELECT sanpham.masp,danhmuc.tendm, sanpham.tensp, SUM(chitiethoadon.soluong) AS tong_soluong
                                            FROM hoadon, chitiethoadon, sanpham ,danhmuc
                                            WHERE hoadon.mahd = chitiethoadon.mahd 
                                                AND hoadon.trangthai = 1 
                                                AND sanpham.masp = chitiethoadon.masp
                                                AND sanpham.madm=danhmuc.madm
                                                AND hoadon.ngay BETWEEN '$start' AND '$end'
                                                AND danhmuc.tendm='$danhmuc'
                                            GROUP BY sanpham.masp
                                            ORDER BY $cot ASC;");
            
            }
            else{
                $sql_query=mysqli_query($connect,"SELECT sanpham.masp,danhmuc.tendm, sanpham.tensp, SUM(chitiethoadon.soluong) AS tong_soluong
                FROM hoadon, chitiethoadon, sanpham ,danhmuc
                WHERE hoadon.mahd = chitiethoadon.mahd 
                    AND hoadon.trangthai = 1 
                    AND sanpham.masp = chitiethoadon.masp
                    AND sanpham.madm=danhmuc.madm
                    AND hoadon.ngay BETWEEN '$start' AND '$end'
                GROUP BY sanpham.masp
                ORDER BY tong_soluong ASC;");    
            }
    }
    else{
        if($danhmuc!='Tất cả'){
            $sql_query=mysqli_query($connect,"SELECT sanpham.masp,danhmuc.tendm, sanpham.tensp, SUM(chitiethoadon.soluong) AS tong_soluong
                                            FROM hoadon, chitiethoadon, sanpham ,danhmuc
                                            WHERE hoadon.mahd = chitiethoadon.mahd 
                                                AND hoadon.trangthai = 1 
                                                AND sanpham.masp = chitiethoadon.masp
                                                AND sanpham.madm=danhmuc.madm
                                                AND hoadon.ngay BETWEEN '$start' AND '$end'
                                                AND danhmuc.tendm='$danhmuc'
                                            GROUP BY sanpham.masp
                                            ORDER BY $cot DESC;");
            
            }
            else{
                $sql_query=mysqli_query($connect,"SELECT sanpham.masp,danhmuc.tendm, sanpham.tensp, SUM(chitiethoadon.soluong) AS tong_soluong
                FROM hoadon, chitiethoadon, sanpham ,danhmuc
                WHERE hoadon.mahd = chitiethoadon.mahd 
                    AND hoadon.trangthai = 1 
                    AND sanpham.masp = chitiethoadon.masp
                    AND sanpham.madm=danhmuc.madm
                    AND hoadon.ngay BETWEEN '$start' AND '$end'
                GROUP BY sanpham.masp
                ORDER BY tong_soluong DESC;");    
            }        
    }
    // .= NỐI CHUỖI
    $output_top .= '
        <table class="table" style="width: 100%">
            <thead class="thead_dark">
            <tr>
                <th>
                    TOP
                </th>
                <th class="sortable_tk_filter '. ($cot == "sanpham.masp" ? 'click' : '') . '" data-tk_filter="sanpham.masp" '. ($cot == "sanpham.masp" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Mã sản phẩm
                </th>
                <th class="sortable_tk_filter '. ($cot == "sanpham.tensp" ? 'click' : '') . '" data-tk_filter="sanpham.tensp" '. ($cot == "sanpham.tensp" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Tên sản phẩm
                </th>
                <th class="sortable_tk_filter '. ($cot == "danhmuc.tendm" ? 'click' : '') . '" data-tk_filter="danhmuc.tendm" '. ($cot == "danhmuc.tendm" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Loại
                </th>
                <th class="sortable_tk_filter '. ($cot == "tong_soluong" ? 'click' : '') . '" data-tk_filter="tong_soluong" '. ($cot == "tong_soluong" && $sort=='false' ?  'style="background-color:#ccc"' : '') . '>
                    Số lượng đã bán
                </th>
            </tr>
            </thead>
    ';
    
    if(mysqli_num_rows($sql_query)>0){
        $i=1;
        while($row=mysqli_fetch_array($sql_query)){
            $output_top .='
            <tr style="margin:5px 0;">
                <td class="seperate STT">
                    '.$i++.'
                </td>
                <td class="seperate Masp">
                    '.$row['masp'].'
                </td>
                <td class="seperate Tensp">
                    '.$row['tensp'].'
                </td>
                <td class="seperate Madm">
                    '.$row['tendm'].'
                </td>            
                <td class="seperate SoLuong">
                    '.$row['tong_soluong'].'
                </td>
            </tr>
            ';
        }
    }
    else{
        $output_top .='
            <tr>
                <td colspan="5">Dữ liệu chưa có</td> 
            </tr>
        ';
    }
    
    $output_top .='
        </table>
    ';    
}


//thống kê top sản phẩm CÙNG LOẠI lợi nhuận cao nhât
$output_top_loinhuan='';
if(isset($_POST['DANHMUC'])){
    $danhmuc=$_POST['DANHMUC'];
    $start = $_POST['START'];
    $end=$_POST['END'];
    $cot=$_POST['COT2'];
    $sort=$_POST['SORT2'];
    if($sort=='true'){
        if($danhmuc!='Tất cả'){
        $sql_query=mysqli_query($connect,"SELECT sanpham.masp,danhmuc.tendm, sanpham.tensp, SUM(chitiethoadon.soluong*chitiethoadon.dongia) AS tong_soluong
                                        FROM hoadon, chitiethoadon, sanpham ,danhmuc
                                        WHERE hoadon.mahd = chitiethoadon.mahd 
                                            AND hoadon.trangthai = 1 
                                            AND sanpham.masp = chitiethoadon.masp
                                            AND sanpham.madm=danhmuc.madm
                                            AND hoadon.ngay BETWEEN '$start' AND '$end'
                                            AND danhmuc.tendm='$danhmuc'
                                        GROUP BY sanpham.masp
                                        ORDER BY $cot ASC;");

        }
        else{
            $sql_query=mysqli_query($connect,"SELECT sanpham.masp,danhmuc.tendm, sanpham.tensp, SUM(chitiethoadon.soluong*chitiethoadon.dongia) AS tong_soluong
            FROM hoadon, chitiethoadon, sanpham ,danhmuc
            WHERE hoadon.mahd = chitiethoadon.mahd 
                AND hoadon.trangthai = 1 
                AND sanpham.masp = chitiethoadon.masp
                AND sanpham.madm=danhmuc.madm
                AND hoadon.ngay BETWEEN '$start' AND '$end'
            GROUP BY sanpham.masp
            ORDER BY tong_soluong ASC;");    
        }
    }
    else{
        if($danhmuc!='Tất cả'){
            $sql_query=mysqli_query($connect,"SELECT sanpham.masp,danhmuc.tendm, sanpham.tensp, SUM(chitiethoadon.soluong*chitiethoadon.dongia) AS tong_soluong
                                            FROM hoadon, chitiethoadon, sanpham ,danhmuc
                                            WHERE hoadon.mahd = chitiethoadon.mahd 
                                                AND hoadon.trangthai = 1 
                                                AND sanpham.masp = chitiethoadon.masp
                                                AND sanpham.madm=danhmuc.madm
                                                AND hoadon.ngay BETWEEN '$start' AND '$end'
                                                AND danhmuc.tendm='$danhmuc'
                                            GROUP BY sanpham.masp
                                            ORDER BY $cot DESC;");
    
            }
            else{
                $sql_query=mysqli_query($connect,"SELECT sanpham.masp,danhmuc.tendm, sanpham.tensp, SUM(chitiethoadon.soluong*chitiethoadon.dongia) AS tong_soluong
                FROM hoadon, chitiethoadon, sanpham ,danhmuc
                WHERE hoadon.mahd = chitiethoadon.mahd 
                    AND hoadon.trangthai = 1 
                    AND sanpham.masp = chitiethoadon.masp
                    AND sanpham.madm=danhmuc.madm
                    AND hoadon.ngay BETWEEN '$start' AND '$end'
                GROUP BY sanpham.masp
                ORDER BY tong_soluong DESC;");    
            }        
    }

// .= NỐI CHUỖI
$output_top_loinhuan .= '
    <table class="table" style="width: 100%">
        <thead class="thead_dark">
        <tr>
            <th>
                TOP
            </th>    
            <th class="sortable_tk_filter_TIEN '. ($cot == "sanpham.masp" ? 'click' : '') . '" data-tk_filter="sanpham.masp" '. ($cot == "sanpham.masp" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                Mã sản phẩm
            </th>
            <th class="sortable_tk_filter_TIEN '. ($cot == "sanpham.tensp" ? 'click' : '') . '" data-tk_filter="sanpham.tensp" '. ($cot == "sanpham.tensp" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                Tên sản phẩm
            </th>
            <th class="sortable_tk_filter_TIEN '. ($cot == "danhmuc.tendm" ? 'click' : '') . '" data-tk_filter="danhmuc.tendm" '. ($cot == "danhmuc.tendm" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                Loại
            </th>
            <th class="sortable_tk_filter_TIEN '. ($cot == "tong_soluong" ? 'click' : '') . '" data-tk_filter="tong_soluong" '. ($cot == "tong_soluong" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                Tiền kiếm được
            </th>
        </tr>
        </thead>
';

if(mysqli_num_rows($sql_query)>0){
    $i=1;
    while($row=mysqli_fetch_array($sql_query)){
        $output_top_loinhuan .='
        <tr style="margin:5px 0;">
            <td class="seperate STT">
                '.$i++.'
            </td>
            <td class="seperate Masp">
                '.$row['masp'].'
            </td>
            <td class="seperate Tensp">
                '.$row['tensp'].'
            </td>
            <td class="seperate Madm">
                '.$row['tendm'].'
            </td>            
            <td class="seperate SoLuong">
                '.$row['tong_soluong'].'
            </td>
        </tr>
        ';
    }
}
else{
    $output_top_loinhuan .='
        <tr>
            <td colspan="5">Dữ liệu chưa có</td> 
        </tr>
    ';
}

$output_top_loinhuan .='
    </table>
';    
}
//top danh mục bán chạy nhất
$output_top_dm='';
if(isset($_POST['START'])){
    $start = $_POST['START'];
    $end=$_POST['END'];
    $cot=$_POST['COT1'];
    $sort=$_POST['SORT1'];
    if($sort=='true'){
    $sql_query=mysqli_query($connect,"SELECT danhmuc.madm,danhmuc.tendm, SUM(chitiethoadon.soluong) AS tong_soluong
                                        FROM hoadon, chitiethoadon, sanpham ,danhmuc
                                        WHERE hoadon.mahd = chitiethoadon.mahd 
                                            AND hoadon.trangthai = 1 
                                            AND sanpham.masp = chitiethoadon.masp
                                            AND sanpham.madm=danhmuc.madm
                                            AND hoadon.ngay BETWEEN '$start' AND '$end'
                                        GROUP BY danhmuc.madm
                                        ORDER BY $cot ASC;");
    }
    else{
        $sql_query=mysqli_query($connect,"SELECT danhmuc.madm,danhmuc.tendm, SUM(chitiethoadon.soluong) AS tong_soluong
        FROM hoadon, chitiethoadon, sanpham ,danhmuc
        WHERE hoadon.mahd = chitiethoadon.mahd 
            AND hoadon.trangthai = 1 
            AND sanpham.masp = chitiethoadon.masp
            AND sanpham.madm=danhmuc.madm
            AND hoadon.ngay BETWEEN '$start' AND '$end'
        GROUP BY danhmuc.madm
        ORDER BY $cot DESC;");        
    }
    // .= NỐI CHUỖI
    $output_top_dm .= '
        <table class="table" style="width: 100%">
            <thead class="thead_dark">
            <tr>
                <th>
                    TOP
                </th>    
                <th class="sortable_tk '. ($cot == "danhmuc.madm" ? 'click' : '') . '" data-tk_filter="danhmuc.madm" '. ($cot == "danhmuc.madm" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                Mã danh mục
                </th>
                <th class="sortable_tk '. ($cot == "danhmuc.tendm" ? 'click' : '') . '" data-tk_filter="danhmuc.tendm" '. ($cot == "danhmuc.tendm" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Tên danh mục
                </th>
                <th class="sortable_tk '. ($cot == "tong_soluong" ? 'click' : '') . '" data-tk_filter="tong_soluong" '. ($cot == "tong_soluong" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Số lượng đã bán
                </th>
            </tr>
            </thead>
    ';

    if(mysqli_num_rows($sql_query)>0){
        $i=1;
        while($row=mysqli_fetch_array($sql_query)){
            $output_top_dm .='
            <tr style="margin:5px 0;">
                <td class="seperate STT">
                    '.$i++.'
                </td>
                <td class="seperate Masp">
                    '.$row['madm'].'
                </td>
                <td class="seperate Tensp">
                    '.$row['tendm'].'
                </td>         
                <td class="seperate SoLuong">
                    '.$row['tong_soluong'].'
                </td>
            </tr>
            ';
        }
    }
    else{
        $output_top_dm .='
            <tr>
                <td colspan="4">Dữ liệu chưa có</td> 
            </tr>
        ';
    }
}
//top danh mục có lợi nhuận nhất
    $output_top_dm_loinhuan='';
    if(isset($_POST['START'])){
        $start = $_POST['START'];
        $end=$_POST['END'];
        $cot=$_POST['COT2'];
        $sort=$_POST['SORT2'];
        if($sort=='true'){
        $sql_query=mysqli_query($connect,"SELECT danhmuc.madm,danhmuc.tendm, SUM(chitiethoadon.soluong*chitiethoadon.dongia) AS tong_soluong
                                        FROM hoadon, chitiethoadon, sanpham ,danhmuc
                                        WHERE hoadon.mahd = chitiethoadon.mahd 
                                            AND hoadon.trangthai = 1 
                                            AND sanpham.masp = chitiethoadon.masp
                                            AND sanpham.madm=danhmuc.madm
                                            AND hoadon.ngay BETWEEN '$start' AND '$end'
                                        GROUP BY danhmuc.madm
                                        ORDER BY $cot ASC;");
        }
        else{
            $sql_query=mysqli_query($connect,"SELECT danhmuc.madm,danhmuc.tendm, SUM(chitiethoadon.soluong*chitiethoadon.dongia) AS tong_soluong
            FROM hoadon, chitiethoadon, sanpham ,danhmuc
            WHERE hoadon.mahd = chitiethoadon.mahd 
                AND hoadon.trangthai = 1 
                AND sanpham.masp = chitiethoadon.masp
                AND sanpham.madm=danhmuc.madm
                AND hoadon.ngay BETWEEN '$start' AND '$end'
            GROUP BY danhmuc.madm
            ORDER BY $cot DESC;");            
        }
    // .= NỐI CHUỖI
    $output_top_dm_loinhuan .= '
        <table class="table" style="width: 100%">
            <thead class="thead_dark">
            <tr>
                <th>
                    TOP
                </th>
                <th class="sortable_tk_TIEN '. ($cot == "danhmuc.madm" ? 'click' : '') . '" data-tk_filter="danhmuc.madm" '. ($cot == "danhmuc.madm" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Mã danh mục
                </th>
                <th class="sortable_tk_TIEN '. ($cot == "danhmuc.tendm" ? 'click' : '') . '" data-tk_filter="danhmuc.tendm" '. ($cot == "danhmuc.tendm" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Tên danh mục
                </th>
                <th class="sortable_tk_TIEN '. ($cot == "tong_soluong" ? 'click' : '') . '" data-tk_filter="tong_soluong" '. ($cot == "tong_soluong" && $sort=='false' ? 'style="background-color:#ccc"' : '') . '>
                    Tiền kiếm được
                </th>
            </tr>
            </thead>
    ';

    if(mysqli_num_rows($sql_query)>0){
        $i=1;
        while($row=mysqli_fetch_array($sql_query)){
            $output_top_dm_loinhuan .='
            <tr style="margin:5px 0;">
                <td class="seperate STT">
                    '.$i++.'
                </td>
                <td class="seperate Masp">
                    '.$row['madm'].'
                </td>
                <td class="seperate Tensp">
                    '.$row['tendm'].'
                </td>         
                <td class="seperate SoLuong">
                    '.$row['tong_soluong'].'
                </td>
            </tr>
            ';
        }
    }
    else{
        $output_top_dm_loinhuan .='
            <tr>
                <td colspan="4">Dữ liệu chưa có</td> 
            </tr>
        ';
    }
}
// -----------------
$ouput_hoadon='';
        $sql_hoadon=mysqli_query($connect,"SELECT * FROM hoadon");            
// .= NỐI CHUỖI

$ouput_hoadon .= '    <div class="chuchitiet">TẤT CẢ ĐƠN HÀNG</div>
';
$ouput_hoadon .= '
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

if(mysqli_num_rows($sql_hoadon)>0){
    $i=1;
    while($row=mysqli_fetch_array($sql_hoadon)){
        $date = new DateTime($row['ngay']);
    $formattedDate = $date->format('d-m-Y');
        $ouput_hoadon .='
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
        if($row['trangthai']==0){
            $ouput_hoadon .='  <td class="seperate " style="text-align: center;">
            Chưa xử lý
        </td>';
        }if($row['trangthai']==1){
            $ouput_hoadon .='  <td class="seperate " style="text-align: center;">
            Đã xử lý
        </td>';
        }if($row['trangthai']==2){
            $ouput_hoadon .='  <td class="seperate " style="text-align: center;">
            Đang được xử lý
        </td>';
        }if($row['trangthai']==3){
            $ouput_hoadon .='  <td class="seperate " style="text-align: center;">
            Đơn khách hàng bỏ
        </td>';
        }
        $ouput_hoadon .=' <td class="seperate " >
        <button class="laythongtinhd" data-tmp=0  data-mhd='.$row['mahd'].' data-mkh='.$row['makh'].'>Xem</button>
    </td>
</tr>
';
    }
}
else{
    $ouput_hoadon .='
        <tr>
            <td colspan="4">Dữ liệu chưa có</td> 
        </tr>
    ';
}

// ---------------chitiethoadon
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
            </tr>
';
    $sql_cthoadon=mysqli_query($connect,"SELECT * FROM chitiethoadon WHERE mahd=$mahdd");            

if(mysqli_num_rows($sql_cthoadon)>0){
    $tongtienn=0;
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
}

        $outputct .='<td class="seperate ">
                '.$row['soluong'].'
                 </td>         
            <td class="seperate ">
                '.$row['dongia'].'
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
        if($row4['trangthai']==2){
        $outputct .= '<button class="btn_hthd"  data-ttmp='.$tmp.' data-mhddd='.$row4['mahd'].' data-mkhhh='.$row4['makh'].'>Hoàn thành hóa đơn</button>';
        } if($row4['trangthai']==0){
            $outputct .= '<button style="margin-right:30px;" class="bthd-ddxl"  data-ttmp='.$tmp.' data-mhdddd='.$row4['mahd'].' data-mkhhhh='.$row4['makh'].'>Cho hóa đơn xử lý</button>';
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

// echo
$output2_search='';
if(isset($_POST['SEARCH_hd'])){
    $search=$_POST['SEARCH_hd'];
    $output2_search .= '
    <table class="table" style="width: 100%">
        <thead class="thead_dark">
        <tr>
            <th>
                TOP
            </th>
            <th>
                Mã danh mục
            </th>
            <th>
                Tên danh mục
            </th>
            <th>
                Tiền kiếm được
            </th>
            <th>Xem chi tiết</th>
        </tr>
        </thead>
';
    $sql_query3 = mysqli_query($connect, "SELECT * FROM hoadon WHERE hoadon.isDelete=0  AND 
    (hoadon.mahd LIKE '%$search%' 
    OR hoadon.makh LIKE '%$search%' 
    OR hoadon.manv LIKE '%$search%'  ) ");
    if(mysqli_num_rows($sql_query3)>0){
        while($row=mysqli_fetch_array($sql_query3)){
            $output2_search .='
            <tr style="margin:5px 0;">
                <td class="seperate STT">
                    '.$i++.'
                </td>
                <td class="seperate ">
                    '.$row['mahd'].'
                </td>
                <td class="seperate ">
                    '.$row['makh'].'
                </td>         
                <td class="seperate ">
                    '.$row['manv'].'
                </td>
                <td class="seperate ">
                    <button class="laythongtinhd" data-mhd='.$row['mahd'].' data-mkh='.$row['makh'].'>Xem</button>
                </td>
            </tr>
            ';
        }
    }
    else{
        $output2_search .='
            <tr>
                <td colspan="8">Dữ liệu chưa có</td> 
            </tr>
        ';
    }
    
    $output2_search .='
        </table>
    ';
}




$ouput_hoadon1='';
        $sql_hoadonn=mysqli_query($connect,"SELECT * FROM hoadon WHERE trangthai=1");            
// .= NỐI CHUỖI
$ouput_hoadon1 .= '    <div class="chuchitiet">ĐƠN HÀNG ĐÃ ĐƯỢC XỬ LÝ</div>
';
$ouput_hoadon1 .= '
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

if(mysqli_num_rows($sql_hoadonn)>0){
    $i=1;
    while($row=mysqli_fetch_array($sql_hoadonn)){
        $date = new DateTime($row['ngay']);
    $formattedDate = $date->format('d-m-Y');
        $ouput_hoadon1 .='
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
            $ouput_hoadon1 .='  <td class="seperate " style="text-align: center;">
            Đã xử lý
        </td>';
        $ouput_hoadon1 .=' <td class="seperate " >
        <button class="laythongtinhd" data-tmp=1  data-mhd='.$row['mahd'].' data-mkh='.$row['makh'].'>Xem</button>
    </td>
</tr>
';
    }
}
else{
    $ouput_hoadon1 .='
        <tr>
            <td colspan="4">Dữ liệu chưa có</td> 
        </tr>
    ';
}




$ouput_hoadon2='';
        $sql_hoadonnn=mysqli_query($connect,"SELECT * FROM hoadon WHERE trangthai=2");            
// .= NỐI CHUỖI
$ouput_hoadon2 .= '    <div class="chuchitiet">ĐƠN HÀNG ĐANG ĐƯỢC XỬ LÝ</div>
';
$ouput_hoadon2 .= '
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

if(mysqli_num_rows($sql_hoadonnn)>0){
    $i=1;
    while($row=mysqli_fetch_array($sql_hoadonnn)){
        $date = new DateTime($row['ngay']);
    $formattedDate = $date->format('d-m-Y');
        $ouput_hoadon2 .='
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
            $ouput_hoadon2 .='  <td class="seperate " style="text-align: center;">
            Đang được xử lý
        </td>';
        $ouput_hoadon2 .=' <td class="seperate " >
        <button class="laythongtinhd" data-tmp=2  data-mhd='.$row['mahd'].' data-mkh='.$row['makh'].'>Xem</button>
    </td>
</tr>
';
    }
}
else{
    $ouput_hoadon2 .='
        <tr>
            <td colspan="4">Dữ liệu chưa có</td> 
        </tr>
    ';
}


$ouput_hoadon3='';
        $sql_hoadonnn=mysqli_query($connect,"SELECT * FROM hoadon WHERE trangthai=0");            
// .= NỐI CHUỖI
$ouput_hoadon3 .= '    <div class="chuchitiet">ĐƠN HÀNG ĐANG ĐƯỢC XỬ LÝ</div>
';
$ouput_hoadon3 .= '
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

if(mysqli_num_rows($sql_hoadonnn)>0){
    $i=1;
    while($row=mysqli_fetch_array($sql_hoadonnn)){
        $date = new DateTime($row['ngay']);
    $formattedDate = $date->format('d-m-Y');
        $ouput_hoadon3 .='
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
            $ouput_hoadon3 .='  <td class="seperate " style="text-align: center;">
            Đơn hàng chưa được xử lý
        </td>';
        $ouput_hoadon3 .=' <td class="seperate " >
        <button class="laythongtinhd" data-tmp=2  data-mhd='.$row['mahd'].' data-mkh='.$row['makh'].'>Xem</button>
    </td>
</tr>
';
    }
}
else{
    $ouput_hoadon3 .='
        <tr>
            <td colspan="4">Dữ liệu chưa có</td> 
        </tr>
    ';
}

$ouput_hoadon4='';
        $sql_hoadonnn=mysqli_query($connect,"SELECT * FROM hoadon WHERE trangthai=3");            
// .= NỐI CHUỖI
$ouput_hoadon4 .= '    <div class="chuchitiet">ĐƠN HÀNG ĐANG ĐƯỢC XỬ LÝ</div>
';
$ouput_hoadon4 .= '
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

if(mysqli_num_rows($sql_hoadonnn)>0){
    $i=1;
    while($row=mysqli_fetch_array($sql_hoadonnn)){
        $date = new DateTime($row['ngay']);
    $formattedDate = $date->format('d-m-Y');
        $ouput_hoadon4 .='
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
            $ouput_hoadon4 .='  <td class="seperate " style="text-align: center;">
            Khách hàng đã hủy
        </td>';
        $ouput_hoadon4 .=' <td class="seperate " >
        <button class="laythongtinhd" data-tmp=2  data-mhd='.$row['mahd'].' data-mkh='.$row['makh'].'>Xem</button>
    </td>
</tr>
';
    }
}
else{
    $ouput_hoadon4 .='
        <tr>
            <td colspan="4">Dữ liệu chưa có</td> 
        </tr>
    ';
}



if(isset($_POST['mhddd'])){
    $mahoadon=$_POST['mhddd'];
    mysqli_query($connect,"UPDATE  hoadon SET trangthai=1 WHERE mahd='$mahoadon'");

}
if(isset($_POST['mhdddd'])){
    $mahoadonn=$_POST['mhdddd'];
    mysqli_query($connect,"UPDATE  hoadon SET trangthai=2 WHERE mahd='$mahoadonn'");

}
if(isset($_POST['mhddddd'])){
    $mahoadonnn=$_POST['mhddddd'];
    mysqli_query($connect,"UPDATE  hoadon SET trangthai=3 WHERE mahd='$mahoadonnn'");

}
// echo $output;//////////////////////////////////////////////

$response_array = array(
    "output" => $output,
    "output1" => $output1,
    "output1_search"=>$output1_search,
    "list_masp" => $list_masp,
    "list_madm" => $list_madm,
    "list_madm_all" => $list_madm_all,
    "list_madm_sp" => $list_madm_sp,
    "list_masp_hoadon" => $list_masp_hoadon,
    "list_masp_phieunhap"=>$list_masp_phieunhap,
    "list_masp_tensp"=>$list_masp_tensp,
    "output_hidden" => $output_hidden,
    "output_hidden_search"=>$output_hidden_search,
    "output_dm" => $output_dm,
    "output_dm_THONGKE"=>$output_dm_THONGKE,
    "output_thongke_tuan_SUM"=>$output_thongke_tuan_SUM,
    "output_thongke_tuan_AVERAGE"=>$output_thongke_tuan_AVERAGE,
    "output_thongke_tuan_COUNT"=>$output_thongke_tuan_COUNT,
    "output_thongke_tuan_MAX"=>$output_thongke_tuan_MAX,
    "output_thongke_tuan_MIN"=>$output_thongke_tuan_MIN,
    "output_thongke_year_SUM"=>$output_thongke_year_SUM,
    "output_thongke_year_AVG"=>$output_thongke_year_AVG,
    "output_thongke_year_COUNT"=>$output_thongke_year_COUNT,
    "output_thongke_year_MAX"=>$output_thongke_year_MAX,
    "output_thongke_year_MIN"=>$output_thongke_year_MIN,
    "output_top"=>$output_top,
    "output_top_dm"=>$output_top_dm,
    "output_top_loinhuan"=>$output_top_loinhuan,
    "output_top_dm_loinhuan"=>$output_top_dm_loinhuan,
    "list_manv_tennv"=>$list_manv_tennv,
    //lưu ý khi nhân viên đăng nhập thì không cho chọn ,chỉ có quản lý mới được phép chọn nhân viên trong phiếu nhập hoặc hóa đơn
    "output_phieu_nhap"=>$output_phieu_nhap,
    "output_phieu_nhap_search"=>$output_phieu_nhap_search,
    "output_chi_tiet_phieu_nhap"=>$output_chi_tiet_phieu_nhap,
    "role"=>$role,
    "nhanvien"=>$nhanvien,
    "ouput_hoadon"=>$ouput_hoadon,
    "outputct"=>$outputct,
    "output2_search"=>$output2_search,
    "ouput_hoadon1"=>$ouput_hoadon1,
    "ouput_hoadon2"=>$ouput_hoadon2,
    "ouput_hoadon3"=>$ouput_hoadon3,
    "ouput_hoadon4"=>$ouput_hoadon4,
);
// Trả về dữ liệu dưới dạng JSON
echo json_encode($response_array);
?>

