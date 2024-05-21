<?php
    require '../config/db.php'; 
    session_start();
    
    
    if(!isset($_SESSION['mySession'])){
        header('Location: ../MAIN/trangchu.php');
        exit;
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./User2.css">
    <!-- <link rel="stylesheet" href="./css4/style1.css"> -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css">
    <link rel="icon" href="Logo/Untitled.png" type="image/x-icon" />
    <title>Document</title>
</head>

<body>
<!-- ------------------------------------------------ -->
<!-- <div class="checkout-page">
    <div class="checkout-header">
        <div class="checkout-return">
            <button>
            <img style="width:50px;height:30px;" src="./img/nutquaylai.png" alt="">
            </button>
        </div>
        <h2 class="checkout-title">Thanh toán</h2>
    </div>
    <main class="checkout-section container">
        <div class="checkout-col-left">
            <div class="checkout-row">
                <div class="checkout-col-title">
                    Thông tin đơn hàng
                </div>
                <div class="checkout-col-content">
                    <div class="content-group">
                        <p class="checkout-content-label">Hình thức nhận</p>
                        <div class="checkout-type-order">
                                <button class="type-order-btn active" id="giaotannoi">
                                <i class="fa-solid fa-motorcycle"></i>
                                 Giao tận nơi
                                </button>
                                
                        </div>
                    </div>
                    <div class="content-group">
                    <p class="checkout-content-label">Ngày giao hàng</p>
                    <div class="date-order">
        <a href="javascript:;" class="pick-date active" data-date="Mon May 20 2024 21:28:37 GMT+0700 (Indochina Time)">
        <span class="text">Hôm nay</span>
        <span class="date">20/5</span>
        </a>
</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div> -->
<!-- ------------------------------------------------ -->

<div id="SHOWCTHD"></div>
<!-- <div id="giohangnguoidung"></div> -->
<div class="user_information_container" id="thongttkkk">
        
</div>

        <div id="sidebarr" class="sidebar">
            <ul>
            <span class="user_infor_exitt1">            
    <img style="width:80px;height:80px;margin-left:70px;margin-bottom:20px;" src="./img/iconslose.png" alt="">
</span>
            <img style="width:242px;height:200px;margin-bottom:20px;" src="./img/theuser.png" alt="">
                <li class="QUANLYTRANGCHU ">TRANG CHỦ</li>
                <li class="QUANLYSANPHAM ">THÔNG TIN TÀI KHOẢN</li>
                <li class="QUANLYDONHANG ">TRẠNG THÁI ĐƠN HÀNG</li>
                <li class="QUANLYNGUOIDUNG">LỊCH SỬ MUA HÀNG</li>
                <li class="THONGKEDONHANG">ĐĂNG XUẤT</li>
                
            </ul>
        </div>

    <header>
        <div class="containerheader">
            <div class="trai">
            <span id="iddanhmuc" class="danhmuc" style="height: 100px;width: 100px;line-height: 104px;"><i class="fa-solid fa-bars"></i></span>
                <img src="./Logo/Badminton Comunity.png" alt="">
                <ul>
                    <li id="MENU_SP">MENU</li>
                    <li><a href="#">DEAL</a></li>
                    <li><a href="#">PROMOTION</a></li>
                    <li><a href="#">STORE</a></li>
                </ul>
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <!-- <button onclick="filfunction()" class="filter-btn"><i class="fa-solid fa-filter"></i><span>Lọc</span></button> -->
                    <input type="text" placeholder="Tìm kiếm">
                </div>
            </div>

            <div class="phai">
                <!-- <a href="#">TIẾNG VIỆT</a> -->
                <ul>
                    <li>
                        <span><i class="fa-solid fa-location-dot"></i></span>
                    </li>

                    <!-- <li>
                        <span><i class="fa-regular fa-user"></i></span>
                    </li> -->

                    <li>
                        <span><i class="fa-regular fa-bell"></i></span>
                    </li>

                    <li class="bamgiohang">
                        <!-- <a href="carttmp.php">             -->
                            <span><i class="fa-solid fa-cart-shopping"></i></span>
            <!-- </a> -->
                    </li>

                    <li>
                        <!-- <span class="danhmuc"><i class="fa-solid fa-bars"></i></span> -->
                        <?php
                    // require '/doanweb4'; 
                    echo '<div>';
                    echo $_COOKIE['username'];
                    echo '</div>';
                    ?>
                    </li>
                </ul>
            </div>

            <!-- <div class="horizontal_menu">
                <div class="coverunderhorizontal_menu">
                    <div class="underhorizontal_menu">
                        
                    </div>
                </div>
            </div> -->

            <!-- <div class="horizontal_menu1">
            <div class="coverunderhorizontal_menu1">
                <div class="underhorizontal_menu1">
                  
                </div>
            </div>
        </div> -->
        </div>
    </header>
    <div id="trangchinh"></div>
    <main class="tchinh">
        <div class="background_transfer_container">
            <div class="background_transfer">
                <!-- <div id="background_transfer_img1"><img src="pexels-cottonbro-studio-5740812.jpg" alt=""></div>
                <div id="background_transfer_img2"><img src="pexels-eric-anada-3660204.jpg" alt=""></div>
                <div id="background_transfer_img3"><img src="pexels-gonzalo-facello-1432039.jpg" alt=""></div>
                <div id="background_transfer_img4"><img src="pexels-jim-de-ramos-1277397.jpg" alt=""></div> -->
            </div>
            <div class="background-perdoc">
                <ul class="perdoc">
                    <li class="btn1"><a href="javascript:;" onclick="button1()"></a></li>
                    <li class="btn2"><a href="javascript:;" onclick="button2()"></a></li>
                    <li class="btn3"><a href="javascript:;" onclick="button3()"><a href=""></a></li>
                    <li class="btn4"><a href="javascript:;" onclick="button4()"><a href=""></a></li>
                </ul>
            </div>
        </div>

        <div class="logoslider">
            <img src="./img/loho.png" alt="">
        </div>

        <h3 class="nz-div-6">
            <span class="title-holder">SẢN PHẨM CỦA CHÚNG TÔI</span>
        </h3>

        <p style="font-weight: 900;font-size: 20px;text-align: center;">Thực đơn hấp dẫn của nhà hàng có tới hơn 150 món
            ăn chuẩn vị Việt Nam sẵn sàng cho bạn lựa chọn</p>

        <div class="product_catogory">
            <div class="product_catogory_item">
                <div class="picture">
                    <img src="./img/monman/imgmonman.jpg" alt="">
                </div>
                <div class="letter">
                    <h1>MÓN KHÔ</h1>
                </div>
            </div>

            <div class="product_catogory_item">
                <div class="picture">
                    <img src="./img/monnuoc/monnuoctong.jpg" alt="">
                </div>
                <div class="letter">
                    <h1>MÓN NƯỚC</h1>
                </div>
            </div>

            <div class="product_catogory_item">
                <div class="picture">
                    <img src="./img/lau.jpg" alt="">
                </div>
                <div class="letter">
                    <h1>MÓN LẨU</h1>
                </div>
            </div>

            <div class="product_catogory_item">
                <div class="picture">
                    <img src="./img/dav.jpg" alt="">
                </div>
                <div class="letter">
                    <h1>MÓN ĂN VẶT</h1>
                </div>
            </div>
            <div class="product_catogory_item">
                <div class="picture">
                    <img src="./img/nn.webp" alt="">
                </div>
                <div class="letter">
                    <h1>NƯỚC UỐNG</h1>
                </div>
            </div>


            <div class="product_catogory_item">
                <div class="picture">
                    <img src="./img/mtm.jpg" alt="">
                </div>
                <div class="letter">
                    <h1>MÓN KHÁC</h1>
                </div>
            </div>
        </div>



        <div class="slider_gioithieu">
            <!-- <div class="khung">
                <div class="anh1">
                    <img width="300px" height="300px" src="./img//com1.webp" alt="">
                    <div class="chu">
                        <h1 style="margin-left: 25px;">Sản phẩm chất lượng</h1>
                    </div>
                </div>
            </div> -->
            <div class="logoslider">
                <img src="./img/loho.png" alt="">
            </div>
            <h1 style="color: white;font-family: 900;font-size: 50px;text-align: center;margin-top: 20px;">Tại sao nên
                chọn Nhà hàng AKATSUKI</h1>
            <p style="color: white;font-weight: 900;margin-top: 10px;text-align: center;font-size: 20px;">Thực đơn chuẩn
                vị Việt Nam có hơn 50 món do chính tay đầu bếp giàu kinh nghiệm lựa chọn và được dọn lên nhanh chóng</p>
            <p style="color: white;font-weight: 900;margin-top: 10px;text-align: center;font-size: 20px;">như món mặn,
                món chay, món lẩu. nước uống, món khác</p>
            <!-- <div class="tongslidergioithieu">
                <div class="slidergioithieucon">
                    <div class="sl1">
                        <img src="./img//sbc.jpg" alt="">
                    </div>
                    <h1>Sản phẩm chất lượng</h1>
                </div>
            </div> -->
            <!-- <div class="slidercon">
                <div class="khung">
                    <div class="anh">
                        <img width="300px" height="300px" src="./img//com1.webp" alt="">
                        <div class="chu">
                            <h1 style="margin-left: 25px;">Sản phẩm chất lượng</h1>
                        </div>
                    </div>
                </div>

                <div class="khung">
                    <div class="anh">
                        <img width="300px" height="300px" src="./img/giao.jpg" alt="">
                        <div class="chu">
                            <h1 style="margin-left: 58px;">Giao hàng nhanh</h1>
                        </div>
                    </div>
                </div>

                <div class="khung">
                    <div class="anh">
                        <img width="300px" height="300px" src="./img/kh1.jpg" alt="">
                        <div class="chu">
                            <h1 style="margin-left: 80px;">Hỗ trợ mọi lúc</h1>
                        </div>
                    </div>
                </div>


            </div> -->

                <div class="containergioithieu">
                    <div class="khungioithieu">
                        <div class="khunganh">
                                <img src="./img/chef.png" alt="">
                        </div>
                        <div class="khungviet">
                            <p>
                                <span>                                
                                    Đặt chất lượng<br> lên hàng đầu
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="khungioithieu">
                        <div class="khunganh">
                                <img src="./img/anhfood.jpg" alt="">
                        </div>
                        <div class="khungviet">
                            <p>
                                <span>                                
                                    Hỗ trợ đặt hàng<br> Online dễ dàng
                                </span>
                            </p>
                        </div>
                    </div>


                    <div class="khungioithieu">
                        <div class="khunganh">
                                <img src="./img/parking.png" alt="">
                        </div>
                        <div class="khungviet">
                            <p>
                                <span>                                
                                    Có chỗ đậu xe<br> Ô tô miễn phí
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
        </div>

        <div class="sliderbuymany">
            <h3 class="nz-div-6">
                <span class="title-holder">Món ăn bán chạy nhất 3/2024</span>
            </h3>
            <p style="text-align: center;">Chúng tôi gợi ý cho bạn một số món ăn đã trở thành thương hiệu của chúng tôi và có doanh thu bán chạy
                nhất tháng 3/2024 </p>
            <!-- <div class="slidercon slbuymany">
                <div class="khung">
                    <div class="anh">
                        <img width="300px" height="300px" src="./img//com1.webp" alt="">
                        <div class="chu">
                            <h1 style="margin-left: 25px;">Sản phẩm chất lượng</h1>
                        </div>
                    </div>
                </div>

                <div class="khung">
                    <div class="anh">
                        <img width="300px" height="300px" src="./img/giao.jpg" alt="">
                        <div class="chu">
                            <h1 style="margin-left: 58px;">Giao hàng nhanh</h1>
                        </div>
                    </div>
                </div>

                <div class="khung">
                    <div class="anh">
                        <img width="300px" height="300px" src="./img/kh1.jpg" alt="">
                        <div class="chu">
                            <h1 style="margin-left: 80px;">Hỗ trợ mọi lúc</h1>
                        </div>
                    </div>
                </div>


            </div> -->
            <div class="product_catogory buymany">
                <div class="product_catogory_item">
                    <div class="picture">
                        <img src="./img/monman/suonbicha.jpg" alt="">
                    </div>
                    <div class="letter">
                        <h1>Cơm sườn bì chả</h1>
                    </div>
                </div>
    
                <div class="product_catogory_item">
                    <div class="picture">
                        <img src="./img/monman/bunthitnuong.jpg" alt="">
                    </div>
                    <div class="letter">
                        <h1>Bún thịt nướng</h1>
                    </div>
                </div>
    
                <div class="product_catogory_item">
                    <div class="picture">
                        <img src="./img/monnuoc/hutieunuoc.jpg" alt="">
                    </div>
                    <div class="letter">
                        <h1>Hủ tiếu khô</h1>
                    </div>
                </div>
    
                <div class="product_catogory_item">
                    <div class="picture">
                        <img src="./img/monanvat/banhtrangnuong.jpg" alt="">
                    </div>
                    <div class="letter">
                        <h1>Bánh tráng nướng</h1>
                    </div>
                </div>
                <div class="product_catogory_item">
                    <div class="picture">
                        <img src="./img/douong/tratac.jpg" alt="">
                    </div>
                    <div class="letter">
                        <h1>Trà tắc</h1>
                    </div>
                </div>
    
    
                <div class="product_catogory_item">
                    <div class="picture">
                        <img src="./img/douong/tradau.jpg" alt="">
                    </div>
                    <div class="letter">
                        <h1>Trà dâu</h1>
                    </div>
                </div>
            </div>
        </div>

        </div>


        <!-- -------------------------PHUOCKHANG -->
        <!-- <div id="bo_loc_tim_kiem">
                <form>
                    <h3>Bộ lọc tìm kiếm:</h3>
                    <div id="xep_gia">
                        <label for="combobox_gia">Xếp theo:</label>
                        <select id="combobox_gia">
                            <option value="">-- Chọn --</option>
                            <option value="desc">Giá từ cao đến thấp</option>
                            <option value="asc">Giá từ thấp đến cao</option>
                        </select>
                    </div>
                    <div id="chon_danh_muc">
                        <label for="combobox_danh_muc">Theo danh mục:</label>
                        <select id="combobox_sort">
                            
                        </select>
                    </div>
                    <div id="khoang_gia">
                        <div>Khoảng giá:</div>
                        <input type="text" id="khoangbatdau" placeholder="Từ" value>
                        <input type="text" id="khoangketthuc" placeholder="Đến" value>
                        <button type="submit">Áp dụng</button>
                    </div>
                </form>
            </div>

            <div id="container_sanpham">
                
            </div>
            <div id="pagination">
                
            </div>
            <div id="chitietsp">
                
            </div> -->
    </main>

    <div id="ttdh" class="billstatus">
<!-- <form  action="thuvienuser.php" method="post">   
          <table>
          <tr>
                    <th>Mã hóa đơn</th>
                    <th>Tên tài khoản</th>
                    <th>Tổng tiền</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                    <th>Xem chi tiết</th>

        </tr>



          </table>
</form> -->
</div>

    <!-- <div class="xemchitiethoadoncuakhach" >
        <div class="modal-container">
            <div class="chuchitiet">Chi tiết hóa đơn</div>
            <form action="xuly.php" method="post">   
          <table>
          <tr>
                    <th>Mã hóa đơn</th>
                    <th>Mã sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đồng giá</th>
                   

        </tr>
       
          </table>
        </form>
        </div>
    </div> -->

        <div class="footer">
            <div class="footer_trai">
                <h1>Nhà hàng thập cẩm AKATSUKI</h1>
                <p>&nbsp;&nbsp;Nhà hàng chúng tôi tự hào là một trong những nhà hàng nổi</p>
                <p>tiếng tại Thành phố Hồ Chí Minh, chuyên về các món ăn chuẩn</p>
                <p>hương vị thuần Việt</p>
                <br>
                <p>&nbsp;&nbsp;Chất lượng sản phẩm là yêu cầu tất yếu của chúng tôi để chế</p>
                <p>biến cho khách hàng. Qúy khách chắc chắn sẽ hài lòng về chất</p>
                <p>lượng sản phẩm và dịch vụ của chúng tôi</p>
            </div>

            <div class="footer_giua">
                <img  style=" width: 150px;height: 104px;" src="./img/loho.png" alt="">
                <div class="sdtfooter">
                    <span>0908273581</span>
                </div>
                <div class="footer_giua_icon">
                     <!-- <div class="giuaicon"> -->
                        <a href="https://web.facebook.com/caothuLQM">
                            <img  style=" width: 30px;height: 30px;" src="./img/facebook.png" alt="">
                        </a>
                      
                     <!-- </div> -->

                     <!-- <div class="giuaicon"> -->
                        <a href="">
                            <img  style=" width: 30px;height: 30px;" src="./img/gmail.png" alt="">
                        </a>
                     <!-- </div> -->

                     <!-- <div class="giuaicon"> -->
                        <a href="">
                            <img  style=" width: 30px;height: 30px;" src="./img/phone-call.png" alt="">
                        </a>
                     <!-- </div> -->

                     <!-- <div class="giuaicon"> -->
                        <a href="">
                            <img  style=" width: 30px;height: 30px;" src="./img/instagram.png" alt="">
                        </a>
                     <!-- </div> -->
                </div>
            </div>

            <div class="footer_phai">
                <!-- <img style=" width: 150px;height: 104px;" src="./img/chao.gif" alt=""> -->
                <h1>Thông tin liên hệ</h1>
                <ul>
                    <li><span>139 Nguyễn Du Quận 1 TPHCM</span></li>
                    <li><span>Điện thoại: 0908273581</span></li>
                    <li><span>Email: uzumakinaruto@gmail.com</span></li>
                </ul>
                <h1>Dowload app</h1>
                <img style="width: 134px;height: 40px;" src="./img/logo_appstore.png" alt="">           
                <img style="width: 134px;height: 40px;"src="./img/logo_playstore.png" alt="">

            </div>

            <!-- <div class="footer_phai1">
                <img src="./img//thanks.gif">
            </div> -->
        </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript">
        // product_catogory
        $('.buymany').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            dots: true,
            autoplay: true,
            arrows: true,
            prevArrow: "<button type='button' class='slick-prev slick-arrow'><i class='fa-solid fa-arrow-left'></i></button>",
            nextArrow: "<button type='button' class='slick-next slick-arrow'><i class='fa-solid fa-arrow-right'></i></button>"
        });
    </script>
    <script src="./User1.js"></script>
    
</body>

</html>