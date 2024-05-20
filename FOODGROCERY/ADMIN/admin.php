<?php
require '../config/db.php'; 
session_start();


$sql="SELECT madm,tendm  FROM danhmuc WHERE ishidden=0";
$query=mysqli_query($connect,$sql);
$list_dm=array();
// Kiểm tra nếu có kết quả trả về từ truy vấn
if (mysqli_num_rows($query) > 0) {
    // Lặp qua mỗi dòng kết quả
    while ($row = mysqli_fetch_assoc($query)) {
        // Thêm dòng dữ liệu vào mảng list_dm
        $list_dm[] = $row;
    }
} else {
    // Trường hợp không có dữ liệu trả về từ truy vấn
    echo "Không có dữ liệu được tìm thấy.";
}


    if(!isset($_SESSION['mySession'])){
        header('Location: ../MAIN/trangchu.php');
        exit;
    }

// Đóng kết nối
mysqli_close($connect);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="quanlykh/kh2.css">
    <link rel="stylesheet" href="quanlytk/tk5.css">
    <link rel="stylesheet" href="quanlynv/nv.css">
    <title>Admin</title>
</head>
<body>


    <div class="container">
        <div class="sidebar" style="overflow: hidden">
            <ul>
                <li class="QUANLYSANPHAM active">QUẢN LÝ SẢN PHẨM</li>
                <li class="QUANLYDONHANG ">QUẢN LÝ HÓA ĐƠN</li>
                <li class="QUANLYTAIKHOAN">QUẢN LÝ TÀI KHOẢN</li>
                <li class="THONGKEDONHANG">THỐNG KÊ ĐƠN HÀNG</li>
                <li class="PHIẾU NHẬP">PHIẾU NHẬP</li>
                <li class="QUANLYKHACHHANG">QUẢN LÝ KHÁCH HÀNG</li>
                <li class="QUANLYNHANVIEN">QUẢN LÝ NHÂN VIÊN</li>
                <li class="TROVE">TRỞ VỀ</li>
            </ul>
        </div>
        <div class="content">
            <!-- Nội dung của trang -->
                <!--MODAL QUẢN LÝ SẢN PHẨM  -->
    <div id="QUANLYSANPHAM" class="invisible">
        <div class="Title_ChucNang">
            <label>Quản Lý Sản Phẩm</label>
        </div>
        <div class="Cover_sepherate_line">
            <div class="sepherate_line"></div>
        </div>
        <div class="search_cover">
            <label>Tìm Kiếm</label>
            <input id="Find_SANPHAM" type="text" class="input_seacrh" placeholder="Tìm kiếm...">
        </div>
        <div style="display: flex ; margin: 1% 0">
        <button class="Modal_Add ADD_SP_BTN" style="width:15%; margin-right: 1%;">Thêm sản phẩm</button>
        <button id="SHOW_DM" style="margin-right: 1%;">xem danh mục</button>
        <button class="edit" style="width:15%;margin-right: 1%;" >Sửa sản phẩm</button>
        </div>
        <input type="file" id="Edit_Anh" class="invisible" >
        <div id="SANPHAM" >
        </div>
        <div style="background-color: black;width: 100%; height: 1px;margin: 8px 0;"></div>
        <div style="display: flex; align-items: center;">                  
        <h4 style="margin-right: .5%;">Tìm kiếm sản phẩm đã xóa </h4>
        <input id="Find_SANPHAM_XOA" type="text" placeholder="Tìm kiếm...">
        </div> 
        <div id="SANPHAM_XOA" >
                            
        </div>

        <div id="THONGBAO" class="invisible">
        <p>Bạn có chắc chắn muốn xóa không?</p>
        <button id="confirmButton">Có</button>
        <button id="cancelButton">Không</button>
    </div>
    </div>

    <!-- MODAL  DANH MỤC SẢN PHẨM -->
    <div class="modal_dm invisible">
        <div class="modal-container container_dm animationTransmision">
            <button   button class="Modal_Add_dm" id="add_dm" style="width:15%; display:inline">Thêm danh mục</button>
            <input type="text" id="add_danh_muc">
            <div id="NOIDUNG_DANHMUC" style="max-height: 220px; overflow: auto;">
            </div>
        </div>

    </div>


        <!-- MODAL FOR ADD SẢN PHẨM -->
    <form method="POST" id="THEM_SAN_PHAM">
        <div class="modal-admin invisible">
            <div class="modal-container animationTransmision" style="max-width:70% ; max-height: 45%;">
                <div>
                    <div class="fa fa-times icon add-close" style="position: absolute;">
                        <i></i>
                    </div>
                </div>
                <div class="modal-body">
                <div class="img" style="display: flex;align-items: center;flex-direction: column; ">
                    <img id="preview" src="" title="Nhấn để thêm ảnh" style="margin-bottom: 0; max-width: 200px; max-height: 15vh;">
                    <br>
                    <input type="file" id="AnhSanPham" onchange="previewImage(event)" style="margin:0 0 2% 17%">
                </div>
                    <div class="properties" style="padding-right: 5%">
                        <div class="flex-box">
                            <h4 class="Title Tensp">Tên Sản Phẩm:</h4>
                            <input id="TenSanPham" class="SoLuong" type="text" required placeholder="#abcdef">
                        </div>
                        <div class="flex-box" style="display: block">
                            <div class="dropdown OPTIONADMIN">
                            <div class="flex-box">
                                <h3 class="Title">Danh mục:</h3>
                                <input id="TIEUDE" class="SoLuong" type="text" style="width: 100%;" readonly required>
                                </div>
                                <div class="dropdown-content OPTIONADMINCONTENT " style="top: 5.5vh">
                                
                                </div>
                            </div>
                        </div>
                        <div class="flex-box">
                            <h4 class="Title">GIÁ: </h4>
                            <input id="GiaBan" class="SoLuong" type="number" pattern="[1-9]+" placeholder="000.000đ" required>
                        </div>
                        <div class="flex-box">
                            <h4 class="Title">Mô tả sản phẩm: </h4>
                            <input id="motasp" class="SoLuong" type="text">
                        </div>
                        <button class="Accept" id="Add_sp_btn" style="margin: 1% 0 1% 23%;">XÁC NHẬN</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- END -->
                       


    <!-- END -->


    <!-- MODAL QUANLYDONHANG -->
    <div id="QUANLYDONHANG" class="invisible">
        <div class="Title_ChucNang">
            <label>Quản Lý Hóa Đơn</label>
        </div>
        <div class="Cover_sepherate_line">
            <div class="sepherate_line"></div>
        </div>
        <div class="dropdown DONHANGG">
            <input id="TYPE_DONHANG" class="SoLuong" type="text" style="display:block;margin-bottom:15px"  readonly  required>
                            <div class="dropdown-content-DONHANG invisible" >
                                <li onclick="selectdon('TẤT CẢ ĐƠN')">TẤT CẢ</li>
                                <li onclick="selectdon('ĐƠN HÀNG ĐÃ ĐƯỢC XỬ LÝ')">ĐƠN HÀNG ĐÃ ĐƯỢC XỬ LÝ</li>
                                <li onclick="selectdon('ĐƠN HÀNG ĐANG ĐƯỢC XỬ LÝ')">ĐƠN HÀNG ĐANG ĐƯỢC XỬ LÝ</li>
                                <li onclick="selectdon('ĐƠN HÀNG CHƯA ĐƯỢC XỬ LÝ')">ĐƠN HÀNG CHƯA ĐƯỢC XỬ LÝ</li>
                                <li onclick="selectdon('ĐƠN HÀNG ĐÃ HỦY')">ĐƠN HÀNG ĐÃ HỦY</li>

                            </div>
        </div>
        <div class="search_cover">
            <label>Tìm Kiếm</label>
            <input id="Find_DONHANG" type="text" class="input_seacrh" placeholder='Nhập mã cần tìm'>
        </div>
        <div id="CHART_SHOW" >
        </div>
        <!-- <br> -->
        <div id="HOADON">
        </div>
        <div id="HOADON1" class="invisible">
        </div>
        <div id="HOADON2" class="invisible">
        </div>
        <div id="HOADON3" class="invisible">
        </div>
        <div id="HOADON4" class="invisible">
        </div>
        <div id="HOADON5" class="invisible">
        </div>
        <div style="background-color: black;width: 100%; height: 1px;margin: 8px 0;"></div>                   
        <!-- <h5>TÌM KIẾM HÓA ĐƠN ĐÃ HOÀN THÀNH</h5>
        <input id="FindOLD" type="text"> -->
        <div id="CHART_SHOWOLD" >
                            
        </div>
    </div>
    <div id="SHOWCTHD"></div>

     <!-- MODAL QUANLYKHACHHANG -->
    <div id="QUANLYKHACHHANG" class="invisible">
        <div class="Title_ChucNang">
            <label>Quản Lý Khách Hàng</label>
        </div>
        <div class="Cover_sepherate_line">
            <div class="sepherate_line"></div>
        </div>
        <div class="search_cover">
            <label>Tìm Kiếm</label>
            <input id="Find_KHACHHANG" type="text" class="input_seacrh" placeholder="Tìm kiếm...">
        </div>
        <br></br>
        <div id="KHACHHANG">
        </div>
        <div style="background-color: black;width: 100%; height: 1px;margin: 8px 0;"></div>
    </div>


    <!--- MODAL QUANLYNHANVIEN -->
    <div id="QUANLYNHANVIEN" class="invisible">
        <div class="Title_ChucNang">
            <label>Quản Lý Nhân Viên</label>
        </div>
        <div class="Cover_sepherate_line">
            <div class="sepherate_line"></div>
        </div>
        <div class="search_cover">
            <label style="margin-right: .5%">Tìm Kiếm</label>
            <input id="search-input" type="text"  placeholder="Tìm kiếm...">
        </div>
        <div id="nv-count" style="font-weight: bold; font-size: 1.1em; margin: 1vh 0;"></div>
        <div style="display: flex; align-items: center">
        <label style="margin-right: .5%">Thêm nhân viên</label>
        <button class="add-button-nv" style="width: 10%;margin-top: .5%;background-color: rgb(58, 164, 12);color: white;font-weight: bold;cursor: pointer">Thêm mới</button>
        </div>
        <div class="overlay-nv"></div>
        <div class="form-container-nv">
        <form class="user-form-nv">
            <div style="display: flex; justify-content: center;">
            <h2>Sửa Đổi Thông Tin Nhân Viên</h2>
            </div>
        <label for="name">Họ tên:</label>
        <input type="text" id="name-nv" name="name">

        <label for="address">Địa chỉ:</label>
        <input type="text" id="address-nv" name="address">
    
        <label for="email">Email:</label>
        <input type="text" id="email-nv" name="email">

        <label for="phone">Số điện thoại:</label>
        <input type="text" id="phone-nv" name="phone">

        <input type="hidden" id="hidden-input-nv">
    
        <div style="display: flex; justify-content: center;margin-top: 3%">
        <button id="cancel-btn-nv">Hủy</button>
        <button class="submit-btn-nv"type="submit">Sửa</button>
    </div>
  </form>
</div>

<div class="form-container-nv-add">
        <form class="user-form-nv-add">
            <div style="display: flex; justify-content: center;">
            <h2>Thêm Nhân Viên Mới</h2>
            </div>
        <label for="name">Họ tên:</label>
        <input type="text" id="name-nv-add" name="name">

        <label for="address">Địa chỉ:</label>
        <input type="text" id="address-nv-add" name="address">
    
        <label for="email">Email:</label>
        <input type="text" id="email-nv-add" name="email">

        <label for="phone">Số điện thoại:</label>
        <input type="text" id="phone-nv-add" name="phone">

        <div style="display: flex; justify-content: center;margin-top: 3%">
        <button id="cancel-btn-nv-add">Hủy</button>
        <button class="submit-btn-nv" type="submit">Thêm</button>
    </div>
  </form>
</div>

        <div id="NHANVIEN"></div>
        <div style="background-color: black;width: 100%; height: 1px;margin: 8px 0;"></div>
    </div>           

    <!-- MODAL QUANLYTAIKHOAN -->
    <div id="QUANLYTAIKHOAN" class="invisible">
        <div class="Title_ChucNang">
            <label>Quản Lý Tài Khoản</label>
        </div>
        <div class="Cover_sepherate_line">
            <div class="sepherate_line"></div>
        </div>
        <div class="search_cover">
            <label>Tìm Kiếm</label>
            <input id="Find_NGUOIDUNG" type="text" class="input_seacrh"  placeholder="Tìm kiếm...">
        </div>
        <br>
            <div id="nv_count" style="font-size: 1.1em;font-weight: bold;border-bottom: 1px solid;width:max-content; margin-bottom: 1%;"></div>
            <div id="kh_count" style="font-size: 1.1em;font-weight: bold;border-bottom: 1px solid;width:max-content;margin-bottom: 2%;"></div>
        <div style="display: flex">
            <div style="font-size: 1.1em;font-weight: bold;margin-right: 1%;">Thêm tài khoản nhân viên: </div>
            <button id="showFormtk" class="add_account" style="width: 10%;background-color: greenyellow;font-weight: bold;cursor: pointer">Thêm</button>
        </div>
        <div id="overlay_form_them"></div>
        <div class="form-Container-tk">
        <span id="close-btn">&times;</span>
        <h2>Tạo Tài Khoản</h2>
        <form id="createAccountForm">
            <div style="display: flex">
            <label for="employee" style="margin-right: 5px;">Chọn nhân viên:</label>
            <select id="employeenv" name="employee" style="border: 1px solid black;"></select>
            </div>
            <br>
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="usernamenv" name="username">
            <br>
            <label for="password">Mật khẩu:</label>
            <input type="text" id="passwordnv" name="password">
            <br>
            <div style="display: flex">
            <label for="role" style="margin-right: 5px;">Chọn quyền:</label>
            <select id="rolenv" name="role" style="border: 1px solid black;"></select>
            </div>
            <br>
            <button type="submit">Tạo</button>
        </form>
    </div>
        <h4>Bảng tài khoản nhân viên:</h4>
        <div id="TAIKHOAN">
        </div>
        <div style="background-color: black;width: 100%; height: 1px;margin: 8px 0;"></div>
        <h4>Bảng tài khoản khách hàng:</h4>
        <div id="TAIKHOAN2">
        </div>
        <div style="background-color: black;width: 100%; height: 1px;margin: 8px 0;"></div>
        
        <div id="overlay_form_sua"></div>
        <div class="form-Container-tk-sua">
        <span id="close-btn-sua">&times;</span>
        <h2>Sửa Tài Khoản</h2>
        <form id="updateAccountForm">
            <input type="text" id="usernamenv-sua" name="username" style="display: none;">
            <br>
            <label for="username">Mật khẩu:</label>
            <input type="text" id="passwordnv-sua" name="username">
            <br>
            <div style="display: flex">
            <label for="role" style="margin-right: 5px;">Chọn quyền:</label>
            <select id="rolenv-sua" name="role" style="border: 1px solid black;"></select>
            </div>
            <br>
            <button type="submit">Cập nhật</button>
        </form>
    </div>
    </div>            

    <!-- modal phiếu nhâp -->
        <div id="QUANLYPHIEUNHAP" class="invisible">
        <div class="Title_ChucNang">
            <label>Quản Lý Phiếu Nhập</label>
        </div>
        <div class="Cover_sepherate_line">
            <div class="sepherate_line"></div>
        </div>
        <div style="margin-bottom: 2%;border-radius:5px; display: flex" class="chon_nhanvien">
                        <label>Mã nhân viên:</label> <br>
                        <input type="text" id="NV_PN" style="border-radius:5px; margin-left: .5%" required readonly>
                        <div class="NV_PN" style="position:relative">
                        </div>
        </div>
        <div>
            <input type="date" id="Ngay_PN" style="border-radius:5px;margin-bottom: 2%;" required>
        </div>
        <button class="Modal_Add ADD-PN" style="width:15%"  id="btn_showFormAddPN">Nhập sản phẩm</button>
        <div id="PHIEUNHAP" >
            <table id="tableCHITIETPHIEUNHAP" class="table" style="width: 100%;">
                <thead class="thead_dark">
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá nhập</th>
                    <th>Tổng tiền</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody id="menuCHITIETPHIEUNHAP"></tbody>
            </table>
        </div>
        <button  style="width:15%;margin:20px 0"  id="btn_ADDPN">Tạo phiếu nhập</button>
        <div class="search_cover search_phieunhap" style="margin-bottom: 1%">
            <label>Tìm Kiếm</label>
            <input id="Find_PHIEUNHAP" type="text" class="input_seacrh" placeholder="Tìm kiếm...">
        </div>
        <input type="date" id="Ngay_PN_start" style="border-radius:5px;margin-bottom: 3%;" required>
        <input type="date" id="Ngay_PN_end" style="border-radius:5px;margin-bottom: 3%;" required>
        <div id="SHOWPHIEUNHAP"></div>
        <button class="invisible BTN_BACK" style="display:block">Quay lại</button>
        <div id="SHOWCHITIETPHIEUNHAP"></div>
    </div>
    
    <!-- modal add Phiếu nhập -->
    <div id="div_bao_FormAdd_PN" class="invisible">

    <div id="div_phu_den" style=" height: 100%;width: 100%;top: 0;left: 0;background-color: rgba(0, 0, 0, 0.5);position: fixed;z-index: 50;" class="invisible"></div>

    <div style="position: absolute; z-index: 50 ;  width: 100%; height: 100%; display: flex; position: fixed; left: 45.5%; top: 25%;">
    <form id="FormAddPN">
        <div style="border: orange 4px solid; border-radius: 10px; width: 120%; padding: 10px 0 10px 0; background-color: #fff;">
            <div style="display: flex; justify-content: center; padding-bottom: 1%;">
                <label style="font-size: 1.4rem;font-weight: bold;">Thêm Phiếu Nhập:</label>
            </div>
            <div style="width: 100%; height: 0.5vh;background-color: rgb(236, 164, 29);;"></div>
            <div style="margin: 0 0 10px 0; display: flex; justify-content: space-evenly;">
                <div style="padding-left: 2%; margin-top: 1%;">
                    <div class="div_bao_input_pn" style="margin-bottom: 5%;">
                        <label>Tên sản phẩm:</label> <br>
                        <input type="text" id="SP_PN" required readonly>
                        <div class="SP_PN" style="position:relative">
                        </div>
                    </div>
                    <div class="div_bao_input_pn">
                        <label>Số lượng nhập:</label> <br>
                        <input type="number" id="SOLUONG_SP_PN" required>
                    </div>
                </div>
                <div style="padding-right: 2%; margin-top: 1%;">
                    <div class="div_bao_input_pn" style="margin-bottom: 5%;">
                        <label>Giá nhập:</label> <br>
                        <input type="number" id="TIEN_SP_PN" required>
                    </div>
                    <div class="div_bao_input_pn">
                        <label>Thành tiền:</label> <br>
                        <input type="text" id="THANHTIEN_SP_PN">
                    </div>
                </div>
            </div>
            <div style="width: 100%; justify-content: space-evenly; display: flex;">
                <button  id="btn_closeFormAddPN" style="box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);">Thoát</button>
                <button id="btn_xacnhan_them_pn" style="box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);">Xác nhận</button>
            </div>
        </div>
    </form>
</div>
</div>

    <!-- MODAL THONGKEDONHANG -->
    <div id="THONGKEDONHANG" class="invisible">
        <div class="Title_ChucNang">
            <label>Thống Kê Đơn Hàng</label>
        </div>
        <div class="Cover_sepherate_line">
            <div class="sepherate_line"></div>
        </div>
        <div class="THONGKEDONHANG">
        </div>
    <div class="Filter">

        <!-- <input id="start-day" type="date">
        <input id="end-day" type="date"> -->
        <div class="dropdown THONGKE">
            <input id="TYPE_THONGKE" class="SoLuong" type="text" style="display:block;margin-bottom:15px"  readonly  required>
                            <div class="dropdown-content-THONGKE invisible" >
                                <li onclick="selectOptionType('TẤT CẢ')">TẤT CẢ</li>
                                <li onclick="selectOptionType('TỔNG')">TỔNG</li>
                                <li onclick="selectOptionType('TRUNG BÌNH')">TRUNG BÌNH</li>
                                <li onclick="selectOptionType('SỐ LƯỢNG')">SỐ LƯỢNG</li>
                                <li onclick="selectOptionType('MIN')">MIN</li>
                                <li onclick="selectOptionType('MAX')">MAX</li>
                            </div>
        </div>
        <div style="display:flex;">
        <div style="display:flex; margin-right: .5%;">
            <input type="checkbox" id="week">
            <label style="font-size: 1.1rem">tuần</label>
        </div>
        <div style="display:flex; margin-right: .5%;">
            <input type="checkbox" id="month">
            <label style="font-size: 1.1rem">tháng</label>
        </div>
        <div style="display:flex;">
            <input type="checkbox" id="time" >
            <label style="font-size: 1.1rem">thời gian</label>
        </div>
        </div>
        <input type="date" id="start_time" class="invisible" style="display: block;text-align:center;"   required >
        <input type="date" id="end_time" class="invisible" style="display: block;text-align:center;"   required >
        <div class="invisible Filter_time">
            <input type="checkbox" id="filter_product" >
            <h5 style="display:inline;">Tất cả</h5>
            <input type="checkbox" id="filter_product_dm">
            <h5 style="display:inline;">Loại sản phẩm</h5>
        </div>
        <div class="dropdown THONGKE " >
        <input id="TYPE_THONGKE_LOAI" class="SoLuong" type="text" style="margin: 10px 0 0 0;"  readonly  required>
            <div class="dropdown-content-THONGKE-danhmuc invisible" >

            </div>
        </div>
        <!-- <button class="FilterAccept">LỌC</button> -->
        <div class="dropdown MONTH">
            <br>
        <div style="display: flex;">
            <label class="text_month invisible" style="font-size: 1.1rem; font-weight: 550;">Chọn tháng:</label>
            <input type="text" id="month_for_week" class="invisible" style="display: block;text-align:center; margin-left: 1%;" readonly  required >
        </div>
        <div class="dropdown-content-MONTH invisible" >
                                <li onclick="selectOption_MONTH('1')">1</li>
                                <li onclick="selectOption_MONTH('2')">2</li>
                                <li onclick="selectOption_MONTH('3')">3</li>
                                <li onclick="selectOption_MONTH('4')">4</li>
                                <li onclick="selectOption_MONTH('5')">5</li>
                                <li onclick="selectOption_MONTH('6')">6</li>
                                <li onclick="selectOption_MONTH('7')">7</li>
                                <li onclick="selectOption_MONTH('8')">8</li>
                                <li onclick="selectOption_MONTH('9')">9</li>
                                <li onclick="selectOption_MONTH('10')">10</li>
                                <li onclick="selectOption_MONTH('11')">11</li>
                                <li onclick="selectOption_MONTH('12')">12</li>
                            </div>
        </div>
        <div id="SHOWOUT">
            <div id="SUM">

            </div>
            <div id="AVG">

            </div>
            <div id="COUNT">

            </div>
            <div id="MAX">

            </div>
            <div id="MIN">

            </div>
        </div>
        <div id="DETAIL"></div>
    </div>
    </div>
        </div>
    </div>


                          

    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js7.js"></script>
<script src="quanlytk/tk24.js"></script>
<script src="quanlykh/kh6.js"></script>
<script src="quanlynv/nv9.js"></script>
</body>
</html>