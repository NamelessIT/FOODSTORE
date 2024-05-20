<?php
require '../config/db.php'; 

session_start();

if (isset($_COOKIE['user']) && isset($_COOKIE['pass'])) {
    $usernameluu = $_COOKIE['user'];
    $passwordluu = $_COOKIE['pass'];
} else {
    $usernameluu = "";
    $passwordluu = "";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="./trangchu.css">
    <link rel="stylesheet" href="./form4.css">
    <link rel="icon" href="Logo/Untitled.png" type="image/x-icon" />
    <title>Document</title>
</head>

<body>

    <header>
        <div class="containerheader">
            <div class="trai">
                <img src="./img/loho.png" alt="Logo" style="width: 11vw; height:17vh;margin-left: 5%">
                <div style="display: flex">
                <ul class="ul_tab">
                    <li><a href="#">MENU</a></li>
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
            </div>

            <div class="phai">
                <!-- <a href="#">TIẾNG VIỆT</a> -->
                <ul>
                    <li>
                        <span><i class="fa-solid fa-location-dot" style="cursor: pointer; margin-left: 27%"></i></span>
                    </li>

                    <li style="width: 2.5vw">
                    <a href="carttmp.php">            
                            <span><i class="fa-solid fa-cart-shopping" style="cursor: pointer;margin: 0 0 0 16%"></i></span>
                        </a>
                    </li>
                    
                    <li>
                        <span><i class="fa-solid fa-bell" style="cursor: pointer"></i></span>
                    </li>


                    <?php
                     if (!isset($_SESSION['mySession'])) {
                        echo '<li class="nguoidung" id="btn_form_dn">
                        <span><i class="fa-solid fa-user" style="cursor: pointer"></i></span>
                        </li>';
                    }
                    ?>

                    <?php
                        if (isset($_SESSION['mySession'])) {
                        $tenDangNhap = $_SESSION['mySession'][0];
                        echo '<li id="toggle-menu">
                        <span style="cursor: pointer" id="menu__bar"><i class="fa-solid fa-bars" style="margin-top: 1%"></i></span>
                        <div id="menu">
                            <ul>
                                <li>
                                    <button onclick="goToMainPage()">Trang chính</button>
                                </li>
                                <li>
                                    <button  id="btn_show-info">Tài khoản</button>
                                </li>
                                <li>
                                    <button id="btn_dangxuat_menu" name="dangxuat">Đăng Xuất</button>
                                </li>
                            </ul>
                        </div>
                    </li>';
                    }
                    ?>
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

    <main>
        <!-- <div class="background_transfer_container">
            <div class="background_transfer">
              <div class="background_transfer_img"><img src="./img/ha5.jpg" alt=""></div>
              <div class="background_transfer_img"><img src="./img/ha1.jpg" alt=""></div>
              <div class="background_transfer_img"><img src="./img/ha2.jpg" alt=""></div>
              <div class="background_transfer_img"><img src="./img/ha3.jpg" alt=""></div>
              <div class="background_transfer_img"><img src="./img/ha4.jpg" alt=""></div>
            </div>
            <div class="background_transfer_button">
              <button id="slide_prev"><</button>
              <button id="slide_next">></button>
            </div>
            <ul class="dots">
              <li class="active"></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
            </ul>
        </div> -->

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
                <span class="title-holder">Món ăn bán chạy nhất 6/2024</span>
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
    </main>


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



<div class="user__signup__login">

<div class="form_cover">

    <div id="div_overlay"></div>
    
    <div class="wrapper">
        <span id="icon-close">
            <ion-icon name="close"></ion-icon>
        </span>

        <div class="form-box form-box_login">
            <h2>Đăng nhập</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" name="form_dn" id="loginForm">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="username_dn" id="input_username_login" value="<?php echo $usernameluu; ?>">
                    <label id="label_username_login">Tên đăng nhập:</label>
                    <label style="font-size: 0.8em ;top: 120%;color: red ; position: absolute;" class = "error_username_login">* Vui lòng điền thông tin</label>
                </div>
                <div class="input-box">
                    <span class="icon" id="show-pass-login" style="cursor: pointer;"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password_dn" id="input_password_login" value="<?php echo $passwordluu; ?>">
                    <label id="label_password_login">Mật khẩu:</label>
                    <label style="font-size: 0.8em ;top: 120%;color: red ; position: absolute;" class = "error_password_login">* Vui lòng điền thông tin</label>
                </div>
                <div class="error_login">* Tên đăng nhập hoặc mật khẩu không chính xác</div>
                <div id="remember-forget">
                    <label><input type="checkbox" name="remember" id="remember-checkbox">Ghi nhớ đăng nhập</label>
                    <a href="#">Quên mật khẩu ?</a>
                </div>
                <button type="submit" class="btn btn_login" name="dangnhap">Đăng nhập</button>
                <div class="login_To_register">
                    <p>Bạn chưa có tài khoản ? <a href="#" id="register-link">Đăng ký</a></p>
                </div>
            </form>
        </div>

        <div class="form-box form-box_register">
            <h2>Đăng ký</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" name="form_dk" id="regisForm">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="username_dk" id="input_username_regis">
                    <label id="label_username_regis">Tên đăng nhập:</label>
                    <label style="font-size: 0.8em ;top: 120%;color: red ; position: absolute;" class = "error_username_regis">* Vui lòng điền thông tin</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="text" name="email" id="input_email_regis">
                    <label id="label_email_regis">Email:</label>
                    <label style="font-size: 0.8em ;top: 120%;color: red ; position: absolute;" class = "error_email_regis">* Vui lòng điền thông tin</label>
                </div>
                <div class="input-box">
                    <span class="icon" id="show-pass-regis" style="cursor: pointer;"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password_dk" id="input_password_regis">
                    <label id="label_password_regis">Mật khẩu:</label>
                    <label style="font-size: 0.8em ;top: 120%;color: red ; position: absolute;" class = "error_password_regis">* Vui lòng điền thông tin</label>
                </div>
                <div class="input-box">
                    <span class="icon" id="show-repass-regis" style="cursor: pointer;"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="repassword_dk" id="input_repassword_regis">
                    <label id="label_repassword_regis">Xác nhận mật khẩu:</label>
                    <label style="font-size: 0.8em ;top: 120%;color: red ; position: absolute;" class = "error_repasssword_regis">* Vui lòng điền thông tin</label>
                </div>
                <div id="agree-with">
                    <label><input type="checkbox" id="checkbox_regis">Tôi đồng ý với các <a href="#">điều khoản</a>và<a href="#">dịch vụ</a></label>
                </div>
                <div class="error_regis">* Vui lòng đồng ý với các điều khoản và dịch vụ</div>
                <button type="submit" class="btn btn_regis" name="dangky">Đăng ký</button>
                <div class="register_To_login">
                    <p>Tôi đã có tài khoản <a href="#" id="login-link">Đăng nhập</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<div class="user_info">

    <div class="form_cover">

        <div id="div_overlay_info"></div>
        
        <div class="wrapper_info">
            <span id="icon-close_info">
                <ion-icon name="close"></ion-icon>
            </span>

            <div class="form-box form-box_info">
                <h2>Thông Tin Tài Khoản</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" name="form_tt" id="infoForm">
                    <div class="input-box">
                        <label id="username_info">Tên tài khoản:</label>
                        <div style="display: flex;">
                            <input type="text" name="username_info" id="input_username_info" readonly>
                        </div>
                    </div>
                    <div class="input-box">
                        <label id="username_info">Họ và tên:</label>
                        <div style="display: flex; width: 107.5%;">
                            <input type="text" name="name_info" id="input_name_info" readonly>
                            <span class="icon" id="sua_nameKH" style="cursor: pointer;"><ion-icon name="create-outline"></ion-icon></span>
                        </div>
                    </div>
                    <div class="input-box">
                        <label id="username_info">Địa chỉ Email:</label>
                        <div style="display: flex;width: 107.5%;">
                            <input type="text" name="email_info" id="input_email_info" readonly>
                            <span class="icon" id="sua_emailKH" style="cursor: pointer;"><ion-icon name="create-outline"></ion-icon></span>
                            <label style="font-size: 0.8em ;top: 120%;color: red ; position: absolute;" class = "error_email_info">* Vui lòng điền thông tin</label>
                        </div>
                    </div>
                    <div class="input-box">
                        <label id="username_info">Địa chỉ:</label>
                        <div style="display: flex;width: 107.5%;">
                            <input type="text" name="diachi_info" id="input_diachi_info" readonly>
                            <span class="icon" id="sua_diachiKH" style="cursor: pointer;"><ion-icon name="create-outline"></ion-icon></span>
                        </div>
                    </div>
                    <div class="input-box">
                        <label id="username_info">Số điện thoại:</label>
                        <div style="display: flex;width: 107.5%;">
                            <input type="text" name="sdt_info" id="input_sdt_info" readonly>
                            <span class="icon" id="sua_sdtKH" style="cursor: pointer;"><ion-icon name="create-outline"></ion-icon></span>
                            <label style="font-size: 0.8em ;top: 120%;color: red ; position: absolute;" class = "error_sdt_info">* Vui lòng điền thông tin</label>
                        </div>
                    </div>
                    <div class="input-box">
                        
                    </div>
                    <button type="submit" class="btn_info" name="dangky">Xác nhận</button>
                </form>
            </div>

        </div>
    </div>
    </div>


    <div id="signup_alert"></div>


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
    <script src="./chinhthuc4.js"></script>
    <script src="./form3.js"></script>

    <script>
    function goToMainPage() {
        window.location.href = './User.php';
     }
</script>
    
</body>

</html>