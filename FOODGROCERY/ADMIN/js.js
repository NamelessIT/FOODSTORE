// thongke.js
var sidebarItems = document.querySelectorAll('.sidebar li');

sidebarItems.forEach(function(item) {
    item.addEventListener('click', function() {
        var currentItem = this;
        var currentOrder = parseInt(currentItem.style.order);

        // Xóa lớp 'active' khỏi tất cả các li
        sidebarItems.forEach(function(item) {
            item.classList.remove('active');
        });

        // Thêm lớp 'active' vào li được click
        currentItem.classList.add('active');

        // Thêm hiệu ứng trượt vào div content
        var contentDiv = document.querySelector('.content');

        // Kiểm tra xem liệu mục được bấm có thứ tự thấp hơn mục hiện tại đang có background màu đen hay không
        var currentActiveItem = document.querySelector('.sidebar li.active');
        if (currentActiveItem && parseInt(currentActiveItem.style.order) > currentOrder) {
            contentDiv.classList.remove('sliding-effect');
            contentDiv.classList.add('sliding-effect', 'slide-up');
        } else {
            contentDiv.classList.remove('sliding-effect', 'slide-up');
            void contentDiv.offsetWidth; // Kích hoạt reflow
            contentDiv.classList.add('sliding-effect');
        }
    });
});
var Quanlysanpham=document.getElementById('QUANLYSANPHAM');
var Quanlydonhang=document.getElementById('QUANLYDONHANG');
var Quanlynguoidung=document.getElementById('QUANLYNGUOIDUNG');
var Thongkedonhang=document.getElementById('THONGKEDONHANG');
Quanlysanpham.classList.remove('invisible');
// Quanlydonhang.classList.remove('invisible');
sidebarItems[0].addEventListener('click',function(){
    Quanlysanpham.classList.remove('invisible');
    Quanlydonhang.classList.add('invisible');
    Thongkedonhang.classList.add('invisible');
    Quanlynguoidung.classList.add('invisible');
})
sidebarItems[1].addEventListener('click',function(){
    Quanlysanpham.classList.add('invisible');
    Quanlydonhang.classList.remove('invisible');
    Thongkedonhang.classList.add('invisible');
    Quanlynguoidung.classList.add('invisible');
})
sidebarItems[2].addEventListener('click',function(){
    Quanlysanpham.classList.add('invisible');
    Quanlydonhang.classList.add('invisible');
    Quanlynguoidung.classList.remove('invisible');
    Thongkedonhang.classList.add('invisible');
})
sidebarItems[3].addEventListener('click',function(){
    Quanlysanpham.classList.add('invisible');
    Quanlydonhang.classList.add('invisible');
    Quanlynguoidung.classList.add('invisible');
    Thongkedonhang.classList.remove('invisible');
})

sidebarItems[4].addEventListener('click',function(){
    // window.location.href = 'http://localhost:3000/FOODGROCERY/index.php?page_layout=danhsach';
    alert('chưa có đường dẫn về trang chủ');
  })


// QUAN LY SAN PHAM

//Biến show sản phẩm từ database
var Container_products=document.getElementById('SANPHAM');
var Container_products_hidden=document.getElementById('SANPHAM_XOA')


var Modalthemsp=document.querySelector('.modal-admin');
var closeModalthemsp=document.querySelector('.add-close');
var themsp=document.querySelector('.Modal_Add');
themsp.addEventListener('click',function(){
    Modalthemsp.classList.remove('invisible');

})
closeModalthemsp.addEventListener('click',function(){
    Modalthemsp.classList.add('invisible');
    clear_input();
})

// thêm sản phẩm
const input_madm = document.getElementById('TIEUDE');
const show_madm = document.querySelector('.OPTIONADMINCONTENT');
const out_input_madm = document.querySelector('.OPTIONADMIN');
input_madm.addEventListener('click', function (event) {
    show_madm.style.display = 'block';
    show_madm
    event.stopPropagation();
})
out_input_madm.addEventListener('click', function () {
    show_madm.style.display = 'none';
})
let dm;
function selectOption(option1,option2) {
    document.getElementById("TIEUDE").value = option1;
    dm=option2;
}


//LOAD ẢNH PREVIEW
function previewImage(event) {
    var input = event.target;
    var reader = new FileReader();

    reader.onload = function() {
        var dataURL = reader.result;
        var preview = document.getElementById('preview');
        preview.src = dataURL;
    };

    reader.readAsDataURL(input.files[0]);
}


//NÚT BẤM INSERT
var masp=document.getElementById('MaSanPham');
var tensp=document.getElementById('TenSanPham');
var AnhSanPham=document.getElementById('AnhSanPham');
var madm=document.getElementById('TIEUDE');
var dongia=document.getElementById('GiaBan');
var motasp=document.getElementById('motasp');
let list_sp=[];
let len=0;

//check masp đã tồn tại hay chưa
function update_list_masp(callback) {
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            list_sp = responseData.list_masp;
            len = list_sp.length;
            callback(); // Gọi hàm callback sau khi AJAX hoàn thành
        }
    });
}

//kiểm tra id có trong phiếu nhập chưa, nếu rồi thì không cho sửa trùng
function check_already_masp_and_add(masp) {
    update_list_masp(function() {
        for (let i = 0; i < len; i++) {
            if (list_sp[i] === masp) {
                console.log("Mã sản phẩm đã tồn tại.");
                alert("Mã sản phẩm đã tồn tại");
                document.getElementById('MaSanPham').value='';
                return; // Kết thúc hàm nếu mã sản phẩm đã tồn tại
            }
        }
        console.log("Mã sản phẩm chưa tồn tại.");
        // Nếu không tìm thấy mã sản phẩm, tiếp tục xử lý
        var tensp = document.getElementById('TenSanPham').value;
        var AnhSanPham = document.getElementById('AnhSanPham').files[0];
        console.log(AnhSanPham);
        var madm = dm;
        var dongia = document.getElementById('GiaBan').value;
        var motasp = document.getElementById('motasp').value;

        var formData = new FormData();
        formData.append('masp', masp);
        formData.append('tensp', tensp);
        formData.append('AnhSanPham', AnhSanPham);
        formData.append('madm', madm);
        formData.append('dongia', dongia);
        formData.append('motasp', motasp);

        // Đưa sản phẩm vào bằng lệnh gửi lên server
        $.ajax({
            url: "quanlysp/action_sp.php",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert('Đã thêm thành công');
                clear_input();
                fetch_data();
                fetch_data_hidden();
            },
            error: function(xhr, status, error) {
                // Xử lý lỗi
                console.error(xhr.responseText);
            }
        });
    });
}




var add_products_btn = document.getElementById('Add_sp_btn');
add_products_btn.addEventListener('click', function(event){
    event.preventDefault(); // Prevent default form submission behavior
    var masp = document.getElementById('MaSanPham').value;
    check_already_masp_and_add(masp);
});

function clear_input(){
    masp.value='';
    tensp.value='';
    AnhSanPham.value='';
    document.getElementById('preview').src='';
    madm.value='';
    dongia.value='';
    motasp.value='';
}


//sửa sản phẩm 
const MASP = document.getElementById('TIEUDE-SUA');
const SHOWOPTIONSUA = document.querySelector('.SUAcontent');
const OUTSIDESUA = document.querySelector('.SUADROPDOWN');
MASP.addEventListener('click', function (event) {
    SHOWOPTIONSUA.style.display = 'block';
    event.stopPropagation();
})
OUTSIDESUA.addEventListener('click', function () {
    SHOWOPTIONSUA.style.display = 'none';
})
function selectOptionTIEUDESUA(option) {
    document.getElementById("TIEUDE-SUA").value = option;
}


//SỬA SẢN PHẨM
var btn_edit=document.querySelector('.edit');
btn_edit.addEventListener('click',function(){
    if(btn_edit.classList.contains('running')){
        fetch_data();
        btn_edit.textContent="Sửa sản phẩm";
        btn_edit.classList.remove("running");
    }
    else{
        fetch_data_edit();
        btn_edit.textContent="Xong";
        btn_edit.classList.add("running");
    }

})
// id là số lấy từ stt
//const id=element.closest('tr').querySelector('.Masp').textContent.trim();
//nhớ kiểm tra sản phẩm đó có trong hóa đơn chưa nếu rồi không cho sửa
//kiểm tra id có trrong phiếu nhập chưa nếu rồi thì không cho sửa trùng
function edit_data(id, text, column_name) {
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        data: { id: id, text: text, column_name: column_name },
        success: function(data) {
            alert('Sửa dữ liệu thành công');
            // Assuming fetch_data() is defined elsewhere
            fetch_data_edit();
        }
    });
}

// thay bằng edit
let list_sp_cthd=[];
let len_cthd=0;
//check masp đã tồn tại hay chưa
function update_list_masp_cthd(callback) {
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            list_sp_cthd = responseData.list_masp_hoadon;
            len_cthd = list_sp_cthd.length;
            callback(); // Gọi hàm callback sau khi AJAX hoàn thành
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            // Xử lý lỗi ở đây nếu cần
        }
    });
}
// check mã danh mục đã tồn tại trong sản phẩm hay chưa
let list_madm_sp=[];
let len_madm_sp=0;
function update_list_madm_sp(callback) {
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            list_madm_sp = responseData.list_madm_sp;
            len_madm_sp = list_madm_sp.length;
            callback(); // Gọi hàm callback sau khi AJAX hoàn thành
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            // Xử lý lỗi ở đây nếu cần
        }
    });
}
let list_madm_all=[];
let len_madm_all=0;
function update_list_madm_all(callback) {
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            list_madm_all = responseData.list_madm_all;
            len_madm_all = list_madm_all.length;
            callback(); // Gọi hàm callback sau khi AJAX hoàn thành
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            // Xử lý lỗi ở đây nếu cần
        }
    });
}

function check_already_masp_cthd(masp, text, column_name) {
    update_list_masp_cthd(function() {
        for (let i = 0; i < len_cthd; i++) {      
            if (list_sp_cthd[i].trim() === masp.toString().trim()) {
                alert("Mã sản phẩm đã tồn tại trong hóa đơn, không thể sửa");
                fetch_data_edit();
                return; // Kết thúc hàm nếu mã sản phẩm đã tồn tại
            }
        }
        $.ajax({
            url: "quanlysp/action_sp.php",
            method: "POST",
            data: { id: masp, text: text, column_name: column_name },
            success: function(data) {
                alert('Sửa dữ liệu thành công');
                // Assuming fetch_data() is defined elsewhere
                fetch_data_edit();
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                // Xử lý lỗi ở đây nếu cần
            }
        });
    });
}

// Sửa tên
$(document).on('blur', '.Tensp', function() {
    var id = $(this).data('id2');
    var text = $(this).text();
    // check_already_masp_cthd(id, text, "tensp");
    check_already_masp_cthd(id,text,"tensp");
});

// sửa mã
$(document).on('blur','.Masp',function(){
    var id =$(this).data('id2');
    var text=$(this).text();
    check_already_masp_cthd(id,text,"masp");
})
// sửa giá bán
$(document).on('blur','.Giaban',function(){
    var id_int =$(this).data('id2');
    var text=$(this).text();
    if(isNaN(text)) {
        alert("Giá bán phải là một số.");
        return; // Dừng việc xử lý tiếp theo
    }
    // Chuyển đổi text thành số nguyên
    var dongia = parseInt(text);
    check_already_masp_cthd(id_int, dongia, "dongia");
})
// sửa ma danh mục

//ĐÓNG OPTION MÃ DANH MỤC
$(document).on('click', function(event) {
    // Kiểm tra xem click có xảy ra trong dropdown-content không
    if (!$(event.target).closest('.edit_content').length) {
        // Nếu không, thêm lớp invisible vào tất cả các dropdown-content
        $('.edit_content').addClass('invisible');
    }
});
let text='';
let list_madm=[];
$(document).on('click', '.Madm', function(event) {
    // Dừng sự lan truyền của sự kiện click để không gây ra xử lý đóng dropdown-content ở mức độ document
    event.stopPropagation();
    
    // Lấy data-id2 của .Madm được bấm
    var id = $(this).data('id2');
    
    // Đóng tất cả các dropdown-content khác trước khi mở dropdown-content mới
    $('.edit_content').addClass('invisible');
    
    // Tìm dropdown-content tương ứng với data-id2 và loại bỏ lớp invisible
    $('.edit_content[data-id2="' + id + '"]').removeClass('invisible');
    
    // Gửi yêu cầu Ajax để lấy danh sách danh mục sản phẩm từ máy chủ
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        data: { get_madm: true },
        success: function(response) {
            var responseData = JSON.parse(response);
            var list_madm = responseData.list_madm;
            var len_madm = list_madm.length;
            var dropdownContent = $('.edit_content[data-id2="' + id + '"]');
            
            // Xóa bỏ nội dung hiện tại của dropdown-content
            dropdownContent.empty();
            
            // Thêm các tùy chọn danh mục vào dropdown-content
            for (var i = 0; i < len_madm; i++) {
                dropdownContent.append('<li onclick="selectOption_edit(\'' + list_madm[i].tendm + '\',\'' + list_madm[i].madm + '\')">' + list_madm[i].tendm + '</li>');
            }

        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            // Xử lý lỗi ở đây nếu cần
        }
    });
});


function selectOption_edit(option1, option2) {
    var id = $('.edit_content:not(.invisible)').data('id2');
    $('input[data-id2="' + id + '"]').val(option1.trim());
    text = option2.trim();
    check_already_masp_cthd(id,text,"madm");
}   


// sửa mô tả sp
$(document).on('blur','.Motasp',function(){
    var id =$(this).data('id2');
    var text=$(this).text();
    check_already_masp_cthd(id,text,"motasp");
})
// sửa ảnh
$(document).on('click', '.Image', function() {
    var id_image = $(this).data('id2');
    var input=document.getElementById('Edit_Anh');
    input.addEventListener('change', function() {
        var imageData = document.getElementById('Edit_Anh').files[0];

            edit_data_image(id_image, imageData, "image");
    });
    input.click();
});

function edit_data_image(id_image, imageData, column_name) {
    var formData = new FormData();
    formData.append('id_image', id_image);
    formData.append('imageData', imageData);
    formData.append('column_name', column_name);
    console.log(imageData);
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            fetch_data_edit();
        }
    });
}


//XÓA SẢN PHẨM
// check có trong hóa đơn không
$(document).on('click','.Del_data',function(){
    var id_xoa =$(this).data('xoa');
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        data: { id_xoa: id_xoa},
        success: function(response) {
            alert('XOá dữ liệu thành công');
            if(btn_edit.classList.contains('running')){
                fetch_data_edit();
            }
            else{
                fetch_data();
            }
            fetch_data_hidden();
        }
    });
})

$(document).on('click','.Del_data_hidden',function(){
    var id_xoa_hidden =$(this).data('xoa');
    update_list_masp_cthd(function() {
        for (let i = 0; i < len_cthd; i++) {      
            if (list_sp_cthd[i].trim() === id_xoa_hidden.toString().trim()) {
                alert("Mã sản phẩm đã tồn tại trong hóa đơn, không thể sửa");
                fetch_data_edit();
                return; // Kết thúc hàm nếu mã sản phẩm đã tồn tại
            }
        }
        $.ajax({
            url: "quanlysp/action_sp.php",
            method: "POST",
            data: { id_xoa_hidden: id_xoa_hidden},
            success: function(response) {
                alert('XOá dữ liệu thành công');
                // Assuming fetch_data() is defined elsewhere
                fetch_data();
                fetch_data_hidden();
            }
        });
    });
})

//KHÔI PHỤC SẢN PHẨM ĐÃ XÓA

$(document).on('click','.Back_hidden',function(){
    var id_back =$(this).data('back');
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        data: { id_back: id_back},
        success: function(response) {
            alert('Khôi phục dữ liệu thành công');
            // Assuming fetch_data() is defined elsewhere
            if(btn_edit.classList.contains('running')){
                fetch_data_edit();
            }
            else{
                fetch_data();
            }
            fetch_data_hidden();
        }
    });
})


//LOAD SẢN PHẨM
//lấy dữ liệu từ database
function fetch_data(){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            var output1 = responseData.output1;
            Container_products.innerHTML = output1; 
        }
    });
}
function fetch_data_hidden(){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            var output_hidden = responseData.output_hidden;
            Container_products_hidden.innerHTML = output_hidden; 
        }
    });
}
function fetch_data_edit(){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            var output = responseData.output;
            Container_products.innerHTML = output; 
        }
    });
}
//load danh mục
var NOIDUNG_DANHMUC=document.getElementById('NOIDUNG_DANHMUC');
function fetch_data_dm(){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            var output_dm = responseData.output_dm;
            NOIDUNG_DANHMUC.innerHTML = output_dm; 
        }
    });
}
var btn_show_dm=document.getElementById('SHOW_DM');
var modal_dm=document.querySelector('.modal_dm');
var container_dm=document.querySelector('.container_dm');
btn_show_dm.addEventListener('click',function(){
    modal_dm.classList.remove('invisible');
    fetch_data_dm();   
})
    // Sử dụng sự kiện mousedown thay vì click
    document.addEventListener('mousedown', function(event){
        // Nếu người dùng click bên ngoài container_dm và không phải là modal_dm
        if(!container_dm.contains(event.target)) {
            // Ẩn modal_dm
            modal_dm.classList.add('invisible');
        }
    });
// modal_dm.addEventListener('click',function(){
//     modal_dm.classList.add('invisible');
// })

//thêm danh mục
var btn_dm=document.getElementById('add_dm');
var value_dm=document.getElementById('add_danh_muc');
btn_dm.addEventListener('click',function(){
    let check=0;
    alert("có bấm");
    var new_dm=value_dm.value.trim();
    update_list_madm_all(function() {
        for (let i = 0; i < len_madm_all; i++) {      
            console.log(list_madm_all[i].tendm+" "+new_dm+" "+check);
            if (list_madm_all[i].tendm.trim() === new_dm.trim()) {
                $.ajax({
                    url: "quanlysp/action_sp.php",
                    method: "POST",
                    data: { edit_dm: new_dm},
                    success: function(response) {
                        console.log("thành công");
                        fetch_data_dm();
                        check=-1;
                        return; // Kết thúc hàm nếu mã sản phẩm đã tồn tại
                    }
                });

            }
            else if(check===len_madm_all-1){
                $.ajax({
                    url: "quanlysp/action_sp.php",
                    method: "POST",
                    data: { tendm: new_dm},
                    success: function(response) {
                        console.log('THÊM dữ liệu thành công');
                        // Assuming fetch_data() is defined elsewhere
                        fetch_data_dm();
                        return;
                    }
                });
    
            }
            check+=1;
        }


    });
});



    // xóa danh mục
    $(document).on('click','.Del_dm',function(){
        alert("có bấm");
        var id_xoa_hidden =$(this).data('dm');
        update_list_madm_sp(function() {
            for (let i = 0; i < len_madm_sp; i++) {      
                console.log(list_madm_sp[i].madm+" "+id_xoa_hidden);
                if (list_madm_sp[i].madm.toString().trim() === id_xoa_hidden.toString().trim()) {
                    $.ajax({
                        url: "quanlysp/action_sp.php",
                        method: "POST",
                        data: { id_xoa_dm: id_xoa_hidden},
                        success: function(response) {
                            alert("thành công");
                            fetch_data_dm();
                            return; // Kết thúc hàm nếu mã sản phẩm đã tồn tại
                        }
                    });

                }
                else{
                        $.ajax({
                            url: "quanlysp/action_sp.php",
                            method: "POST",
                            data: { id_xoa_dm_notin_sp: id_xoa_hidden},
                            success: function(response) {
                                alert('XOá dữ liệu thành công');
                                // Assuming fetch_data() is defined elsewhere
                                fetch_data_dm();
                                return;
                            }
                        });

                }
            }


        });
    })

window.addEventListener('load', function() {
    fetch_data(); // Gọi hàm để tải sản phẩm khi trang được load
    fetch_data_hidden();
    fetch_data_dm();
});



