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
            <ul style="padding-left: 2vw;">
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
            <div class="modal-container animationTransmision">
                <div class="fa fa-times icon add-close">
                    <i></i>
                </div>
                <div class="modal-body">
                <div class="img">
                    <input type="file" id="AnhSanPham" onchange="previewImage(event)">
                    <img id="preview" src="" title="Nhấn để thêm ảnh">
                </div>
                    <div class="properties">
                        <div class="flex-box">
                            <h4 class="Title Masp" style="margin: 8px 5px;">Mã Sản Phẩm </h4>
                            <input id="MaSanPham" class="SoLuong" type="text" required
                                placeholder="#0000">
                        </div>
                        <div class="flex-box">
                            <h4 class="Title Tensp" style="margin: 8px 5px;">Tên Sản Phẩm </h4>
                            <input id="TenSanPham" class="SoLuong" type="text" required
                                placeholder="#abcdef">
                        </div>
                        <div class="flex-box" style="display: block ;">
                            <div class="dropdown OPTIONADMIN">
                                <h3 class="Title" style="margin-bottom: 15px;">TITLE:</h3>
                                <input id="TIEUDE" class="SoLuong" type="text" style="width: 100%;" readonly required>
                                <div class="dropdown-content OPTIONADMINCONTENT">
                                <?php foreach ($list_dm as $row): ?>
                                    <li onclick="selectOption('<?php echo $row['tendm'] ; ?>','<?php echo $row['madm']; ?>')" ><?php echo htmlspecialchars($row['tendm']); ?></li>
                                <?php endforeach; ?>
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
        <h5>TÌM KIẾM HÓA ĐƠN</h5>
        <input id="Find" type="text">
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
        <h5 class="title_count">SỐ LƯỢNG NGƯỜI DÙNG:</h5>
        <h5 class="user_count"></h5>
        <div id="USER_SHOW"></div>
    </div>

        <!-- Modal phiếu nhâp -->
        <div id="QUANLYPHIEUNHAP" class="invisible">
        <div class="Title_ChucNang">
            <label>Quản Lý Phiếu Nhập</label>
        </div>
        <div class="Cover_sepherate_line">
            <div class="sepherate_line"></div>
        </div>
        <div class="search_cover">
            <label>Tìm Kiếm</label>
            <input id="Find_PN" type="text" class="input_seacrh">
        </div>
        <br></br>
        <button class="Modal_Add ADD-PN" style="width:15%; margin-bottom:1vh">Thêm phiếu nhập</button>
        <!-- <br></br>
        <button id="SHOW_DM">xem danh mục</button>
        <br></br> -->
        <div id="PHIEUNHAP" >

        <!-- Bảng cho phiếu nhập -->
        <table style="width: 100%;border-collapse: collapse;">
        <thead>
            <tr>
                <th style=" border: 1px solid black;padding: 8px;background-color: #f2f2f2;">Mã phiếu nhập</th>
                <th style=" border: 1px solid black;padding: 8px;background-color: #f2f2f2;">Tổng tiền</th>
                <th style=" border: 1px solid black;padding: 8px;background-color: #f2f2f2;">Ngày nhập</th>
                <th style=" border: 1px solid black;padding: 8px;background-color: #f2f2f2;">Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style=" text-align: center;border: 1px solid black;padding: 8px;">P001</td>
                <td style=" text-align: center;border: 1px solid black;padding: 8px;">1000000</td>
                <td style=" text-align: center;border: 1px solid black;padding: 8px;">2024-04-01</td>
                <td style=" text-align: center;border: 1px solid black;padding: 8px;"><button>Xem</button></td>
            </tr>
        </tbody>
        </table>

        <br></br>
        <!-- Bảng cho sản phẩm -->
        <table style="width: 100%;border-collapse: collapse">
        <thead>
            <tr>
                <th style="background-color: #f2f2f2; border: 1px solid black; padding: 8px;">Mã sản phẩm</th>
                <th style="background-color: #f2f2f2; border: 1px solid black; padding: 8px;">Tên sản phẩm</th>
                <th style="background-color: #f2f2f2; border: 1px solid black; padding: 8px;">Ảnh</th>
                <th style="background-color: #f2f2f2; border: 1px solid black; padding: 8px;">Đơn giá</th>
                <th style="background-color: #f2f2f2; border: 1px solid black; padding: 8px;">Mã danh mục</th>
                <th style="background-color: #f2f2f2; border: 1px solid black; padding: 8px;">Mô tả</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style=" text-align: center;border: 1px solid black;padding: 8px;">SP001</td>
                <td style=" text-align: center;border: 1px solid black;padding: 8px;">Sản phẩm 1</td>
                <td style=" text-align: center;border: 1px solid black;padding: 8px;"><img src="#" alt="Ảnh sản phẩm 1"></td>
                <td style=" text-align: center;border: 1px solid black;padding: 8px;">1000000</td>
                <td style=" text-align: center;border: 1px solid black;padding: 8px;">DM001</td>
                <td style=" text-align: center;border: 1px solid black;padding: 8px;">Mô tả sản phẩm 1</td>
            </tr>
        </tbody>
    </table>

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
                <p>Số lượng mua</p>
                <div class="underline"></div>
                <div class="SoLuongMuaNumber"></div>
              </div>
              <div class="DOANHTHU">
                <div id="SoDoanhThu"></div>
                <p>Doanh thu</p>
                <div class="underline"></div>
                <div class="DoanhThuNumber"></div>
              </div>
        </div>
    <div class="Filter">

        <!-- <input id="start-day" type="date">
        <input id="end-day" type="date"> -->
        <div class="dropdown THONGKE">
            <input id="TYPE_THONGKE" class="SoLuong" type="text"  readonly  required>
                            <div class="dropdown-content-THONGKE invisible" >
                                <li onclick="selectOption('TẤT CẢ')">TẤT CẢ</li>
                                <li onclick="selectOption('TỔNG')">TỔNG</li>
                                <li onclick="selectOption('TRUNG BÌNH')">TRUNG BÌNH</li>
                                <li onclick="selectOption('SỐ LƯỢNG')">SỐ LƯỢNG</li>
                                <li onclick="selectOption('MIN')">MIN</li>
                                <li onclick="selectOption('MAX')">MAX</li>
                            </div>
        </div>
        <div class="dropdown THONGKE">
            <input id="TYPE_THONGKE_LOAI" class="SoLuong" type="text"  readonly  required>
                            <div class="dropdown-content-THONGKE-danhmuc invisible" >

                            </div>
        </div>
        <button class="FilterAccept">LỌC</button>
        <h5>tổng,trung bình,đếm,min,max số lượng hóa đơn trong thời gian đó</h5>
        <input type="checkbox" id="week" >
        <h5 style="display:inline;">tuần</h5>
        <input type="checkbox" id="month">
        <h5 style="display:inline;">tháng</h5>
        <input type="checkbox" id="time" >
        <h5 style="display:inline;">thời gian</h5>
        <input type="date" id="start_time" class="invisible" style="display: block;text-align:center;"   required >
        <input type="date" id="end_time" class="invisible" style="display: block;text-align:center;"   required >
        <div class="dropdown MONTH">
        <h5 class="text_month invisible">Chọn tháng</h5>
        <input type="text" id="month_for_week" class="invisible" style="display: block;text-align:center;" readonly  required >
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