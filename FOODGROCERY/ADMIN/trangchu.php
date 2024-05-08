<?php
require '../config/db.php'; 


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

// Đóng kết nối
mysqli_close($connect);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link rel="stylesheet" href="style.css">
    <title>Admin</title>
</head>
<body>


    <div class="container">
        <div class="sidebar">
            <ul>
                <li class="QUANLYSANPHAM active">QUẢN LÝ SẢN PHẨM</li>
                <li class="QUANLYDONHANG ">QUẢN LÝ HÓA ĐƠN</li>
                <li class="QUANLYNGUOIDUNG">QUẢN LÝ NGƯỜI DÙNG</li>
                <li class="THONGKEDONHANG">THỐNG KÊ ĐƠN HÀNG</li>
                <li class="PHIẾU NHẬP">PHIẾU NHẬP</li>
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
            <input id="Find_SANPHAM" type="text" class="input_seacrh">
        </div>
        <br></br>
        <button class="Modal_Add" style="width:15%">Thêm sản phẩm</button>
        <br></br>
        <button id="SHOW_DM">xem danh mục</button>
        <br></br>
        <button class="edit" style="width:15%" >Sửa sản phẩm</button>
        <input type="file" id="Edit_Anh" class="invisible" >
        <div id="SANPHAM" >
        </div>
        <div style="background-color: black;width: 100%; height: 1px;margin: 8px 0;"></div>                   
        <h5>TÌM KIẾM SẢN PHẨM ĐÃ XÓA</h5>
        <input id="Find_SANPHAM_XOA" type="text">
        <div id="SANPHAM_XOA" >
                            
        </div>
    </div>

    <!-- MODAL  DANH MỤC SẢN PHẨM -->
    <div class="modal_dm invisible">
        <div class="modal-container container_dm animationTransmision">
            <button   button class="Modal_Add_dm" id="add_dm" style="width:15%; display:inline">Thêm danh mục</button>
            <input type="text" id="add_danh_muc">
            <div id="NOIDUNG_DANHMUC">
            </div>
        </div>

    </div>


        <!-- MODAL FOR ADD SẢN PHẨM -->
    <form method="POST" id="THEM_SAN_PHAM">
        <div class="modal-admin invisible">
            <div class="modal-container animationTransmision" style="width:70% ; min-height: 40%;">
                <div style="padding-bottom: 1%">
                    <div class="fa fa-times icon add-close" style="position: relative;">
                        <i></i>
                    </div>
                </div>
                <div class="modal-body" style="  justify-content: space-around;">
                <div class="img" style="display: flex;align-items: center;flex-direction: column; min-width: 10% ; min-height: 20%;">
                    <img id="preview" src="" title="Nhấn để thêm ảnh" style="max-width: 200px; margin-bottom: 0;">
                    <br>
                    <input style="padding-left: 18%" type="file" id="AnhSanPham" onchange="previewImage(event)">
                </div>
                    <div class="properties">
                        <div class="flex-box">
                            <h4 class="Title Tensp" style="margin: 8px 5px;">Tên Sản Phẩm:</h4>
                            <input id="TenSanPham" class="SoLuong" type="text" required placeholder="#abcdef">
                        </div>
                        <div class="flex-box" style="display: block ;">
                            <div class="dropdown OPTIONADMIN">
                                <h3 class="Title" style="margin-bottom: 15px;">TITLE:</h3>
                                <input id="TIEUDE" class="SoLuong" type="text" style="width: 100%;" readonly required>
                                <div class="dropdown-content OPTIONADMINCONTENT ">
                                
                                </div>
                            </div>
                        </div>
                        <div class="flex-box">
                            <h4 class="Title" style="margin: 5px 0;">GIÁ: </h4>
                            <input id="GiaBan" class="SoLuong" type="number" pattern="[1-9]+" placeholder="000.000đ" required>
                        </div>
                        <div class="flex-box">
                            <h4 class="Title" style="margin: 5px 0;">Mô tả sản phẩm: </h4>
                            <input id="motasp" class="SoLuong" type="text">
                        </div>
                        <button class="Accept" id="Add_sp_btn">XÁC NHẬN</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- END -->
                       


    <!-- END -->

    <!-- ADJUST -->

    <div class="modal-ADJUST invisible">
        <div class="modal-container_ADJUST animationTransmision">
            <div class="fa fa-times icon close">
                <i></i>
            </div>
            <div class="modal-body_ADJUST">
                <div class="img">
                    <img src="" title="Nhấn để thêm ảnh">
                </div>
                <div class="properties">
                    <div class="flex-box">
                        <h4 class="Title" style="margin: 8px 5px;">Mã Sản Phẩm </h4>
                        <input id="MaSanPham-SUA" class="SoLuong" type="number" pattern="[1-9]{4}" required
                            placeholder="#0000">
                    </div>
                    <div class="flex-box">
                        <div class="dropdown SUADROPDOWN">
                            <h3 class="Title" style="margin-bottom: 15px;">TITLE:</h3>
                            <input id="TIEUDE-SUA" class="SoLuong" type="text" style="width: 100%;" readonly required>
                            <div class="dropdown-content SUAcontent">
                                <li onclick="selectOptionTIEUDESUA('BÁNH')">BÁNH</li>
                                <li onclick="selectOptionTIEUDESUA('TRÀ')">TRÀ</li>
                                <li onclick="selectOptionTIEUDESUA('TRÀ SỮA')">TRÀ SỮA</li>
                                <li onclick="selectOptionTIEUDESUA('NƯỚC ÉP')">NƯỚC ÉP</li>
                                <li onclick="selectOptionTIEUDESUA('TOPPING')">TOPPING</li>
                            </div>
                        </div>
                    </div>
                    <div class="flex-box">
                        <h3 class="Title" style="margin-bottom: 15px;color: red;">NAME:</h3>
                        <input id="TenSanPham-SUA" class="SoLuong" type="text" required>
                    </div>
                    <div class="flex-box">
                        <h4 class="Title" style="margin: 5px 0;">GIÁ: </h4>
                        <input id="GiaBan-SUA" class="SoLuong" type="number" pattern="[1-9]+" placeholder="000.000đ">
                    </div>
                    <button class="ADJUST">XÁC NHẬN</button>
                </div>
            </div>
        </div>
    </div>

    <!-- KẾT THÚC -->

    <!-- MODAL QUANLYDONHANG -->
    <div id="QUANLYDONHANG" class="invisible">
        <div class="Title_ChucNang">
            <label>Quản Lý Hóa Đơn</label>
        </div>
        <div class="Cover_sepherate_line">
            <div class="sepherate_line"></div>
        </div>
        <div class="search_cover">
            <label>Tìm Kiếm</label>
            <input id="Find_DONHANG" type="text" class="input_seacrh">
        </div>
        <div id="CHART_SHOW" >
        </div>
        <div style="background-color: black;width: 100%; height: 1px;margin: 8px 0;"></div>                   
        <h5>TÌM KIẾM HÓA ĐƠN ĐÃ HOÀN THÀNH</h5>
        <input id="FindOLD" type="text">
        <div id="CHART_SHOWOLD" >
                            
        </div>
    </div>
    <!-- MODAL QUANLYNGUOIDUNG -->
    <div id="QUANLYNGUOIDUNG" class="invisible">
        <div class="Title_ChucNang">
            <label>Quản Lý Người Dùng</label>
        </div>
        <div class="Cover_sepherate_line">
            <div class="sepherate_line"></div>
        </div>
        <div class="search_cover">
            <label>Tìm Kiếm</label>
            <input id="Find_NGUOIDUNG" type="text" class="input_seacrh">
        </div>
        <br>
        <h5 class="title_count">SỐ LƯỢNG NGƯỜI DÙNG:</h5>
        <h5 class="user_count"></h5>
        <div id="USER_SHOW"></div>
    </div>

    <!-- modal phiếu nhâp -->
        <div id="QUANLYPHIEUNHAP" class="invisible">
        <div class="Title_ChucNang">
            <label>Quản Lý Phiếu Nhập</label>
        </div>
        <div class="Cover_sepherate_line">
            <div class="sepherate_line"></div>
        </div>
        <div class="search_cover" style="margin-bottom: 1%">
            <label>Tìm Kiếm</label>
            <input id="Find_PHIEUNHAP" type="text" class="input_seacrh">
        </div>
        <div style="margin-bottom: 5%;border-radius:5px">
                        <label>Mã nhân viên:</label> <br>
                        <input type="text" id="NV_PN" style="border-radius:5px" required readonly>
                        <div class="NV_PN" style="position:relative">
                        </div>
        </div>
        <div>
            <input type="date" id="Ngay_PN" style="border-radius:5px;margin-bottom: 5%;" required>
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
            <div class="SOLUONGMUA">
                <div id="SoLuongMua"></div>
                <div class="underline"></div>
                <div class="SoLuongMuaNumber"></div>
              </div>
              <div class="DOANHTHU">
                <div id="SoDoanhThu"></div>
                <div class="underline"></div>
                <div class="DoanhThuNumber"></div>
              </div>
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
<script src="js.js"></script>

</body>
</html>