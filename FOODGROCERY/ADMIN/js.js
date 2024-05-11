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
var Phieunhap=document.getElementById('QUANLYPHIEUNHAP');
Quanlysanpham.classList.remove('invisible');
// Quanlydonhang.classList.remove('invisible');
sidebarItems[0].addEventListener('click',function(){
    Quanlysanpham.classList.remove('invisible');
    Quanlydonhang.classList.add('invisible');
    Quanlynguoidung.classList.add('invisible');
    Thongkedonhang.classList.add('invisible');
    Phieunhap.classList.add('invisible');
})
sidebarItems[1].addEventListener('click',function(){
    Quanlysanpham.classList.add('invisible');
    Quanlydonhang.classList.remove('invisible');
    Quanlynguoidung.classList.add('invisible');
    Thongkedonhang.classList.add('invisible');
    Phieunhap.classList.add('invisible');
})
sidebarItems[2].addEventListener('click',function(){
    Quanlysanpham.classList.add('invisible');
    Quanlydonhang.classList.add('invisible');
    Quanlynguoidung.classList.remove('invisible');
    Thongkedonhang.classList.add('invisible');
    Phieunhap.classList.add('invisible');
})
sidebarItems[3].addEventListener('click',function(){
    Quanlysanpham.classList.add('invisible');
    Quanlydonhang.classList.add('invisible');
    Quanlynguoidung.classList.add('invisible');
    Thongkedonhang.classList.remove('invisible');
    Phieunhap.classList.add('invisible');
})
sidebarItems[4].addEventListener('click',function(){
    Quanlysanpham.classList.add('invisible');
    Quanlydonhang.classList.add('invisible');
    Quanlynguoidung.classList.add('invisible');
    Thongkedonhang.classList.add('invisible');
    Phieunhap.classList.remove('invisible');
})

sidebarItems[5].addEventListener('click',function(){
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
var tensp=document.getElementById('TenSanPham');
var AnhSanPham=document.getElementById('AnhSanPham');
var madm=document.getElementById('TIEUDE');
var dongia=document.getElementById('GiaBan');
var motasp=document.getElementById('motasp');

dongia.addEventListener('input',function(){
    if(dongia.value<0){
        dongia.value=0;
        return;
    }
})


//kiểm tra id có trong phiếu nhập chưa, nếu rồi thì không cho sửa trùng
function check_already_masp_and_add() {
        // Nếu không tìm thấy mã sản phẩm, tiếp tục xử lý
        var tensp = document.getElementById('TenSanPham').value;
        var AnhSanPham = document.getElementById('AnhSanPham').files[0];
        console.log(AnhSanPham);
        var madm = dm;
        var dongia = document.getElementById('GiaBan').value;
        var motasp = document.getElementById('motasp').value;

        var formData = new FormData();
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
}




var add_products_btn = document.getElementById('Add_sp_btn');
add_products_btn.addEventListener('click', function(event){
    event.preventDefault(); // Prevent default form submission behavior
    check_already_masp_and_add();
});

function clear_input(){
    tensp.value='';
    AnhSanPham.value='';
    document.getElementById('preview').src='';
    madm.value='';
    dongia.value='';
    motasp.value='';
}


//sửa sản phẩm 
// const MASP = document.getElementById('TIEUDE-SUA');
// const SHOWOPTIONSUA = document.querySelector('.SUAcontent');
// const OUTSIDESUA = document.querySelector('.SUADROPDOWN');
// MASP.addEventListener('click', function (event) {
//     SHOWOPTIONSUA.style.display = 'block';
//     event.stopPropagation();
// })
// OUTSIDESUA.addEventListener('click', function () {
//     SHOWOPTIONSUA.style.display = 'none';
// })
// function selectOptionTIEUDESUA(option) {
//     document.getElementById("TIEUDE-SUA").value = option;
// }


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
let list_sp_ctpn=[];
let len_cthd=0;
let len_ctpn=0;
//check masp đã tồn tại hay chưa
function update_list_masp_cthd(callback) {
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            list_sp_cthd = responseData.list_masp_hoadon;
            list_sp_ctpn=responseData.list_masp_phieunhap;
            len_cthd = list_sp_cthd.length;
            len_ctpn=list_sp_ctpn.length;
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
                    if(btn_edit.classList.contains('running')){
                        fetch_data_edit();
                    }
                    else{
    
                        fetch_data();
                    }
                    return; // Kết thúc hàm nếu mã sản phẩm đã tồn tại
                }
            }
            for (let i = 0; i < len_ctpn; i++) {      
                if (list_sp_ctpn[i].trim() === masp.toString().trim()) {
                    alert("Mã sản phẩm đã tồn tại trong phiếu nhập, không thể sửa");
                    if(btn_edit.classList.contains('running')){
                        fetch_data_edit();
                    }
                    else{
    
                        fetch_data();
                    }
                    return; // Kết thúc hàm nếu mã sản phẩm đã tồn tại
                }
            }
            console.log(Number.isInteger(parseInt(text)));
            if(Number.isInteger(parseInt(text))){
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
            }
            else{
                fetch_data_edit();
            }
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
        var AnhSanPham = document.getElementById('Edit_Anh').files[0];;
            edit_data_image(id_image, AnhSanPham);
    });
    input.click();
});

function edit_data_image(id_image, AnhSanPham) {
    var formData = new FormData();
    formData.append('id_image', id_image);
    formData.append('AnhSanPham', AnhSanPham);

    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            fetch_data_edit();
            var responseData = JSON.parse(data);
            var output1 = responseData.output_check;
            document.getElementById('SANPHAM_XOA').innerHTML = output1; 
        }
    });
}


//XÓA SẢN PHẨM
// check có trong hóa đơn không
$(document).on('click','.Del_data',function(){
    var id_xoa =$(this).data('xoa');
    document.getElementById('THONGBAO').classList.remove('invisible');
    document.getElementById('confirmButton').addEventListener('click',function(){
        $.ajax({
            url: "quanlysp/action_sp.php",
            method: "POST",
            data: { id_xoa: id_xoa},
            success: function(response) {
                document.getElementById('THONGBAO').classList.add('invisible');
                if(btn_edit.classList.contains('running')){
                    fetch_data_edit();
                }
                else if(Find_SANPHAM.value!=''){
                    fetch_data_search();
                }
                else{
                    fetch_data();
                }
                fetch_data_hidden();
            }
        });
    })
    document.getElementById('cancelButton').addEventListener('click',function(){
        document.getElementById('THONGBAO').classList.add('invisible');
        return;  
    })
})

$(document).on('click','.Del_data_hidden',function(){
    var id_xoa_hidden =$(this).data('xoa');
    update_list_masp_cthd(function() {
        for (let i = 0; i < len_cthd; i++) {      
            if (list_sp_cthd[i].trim() === id_xoa_hidden.toString().trim()) {
                alert("Mã sản phẩm đã tồn tại trong hóa đơn, không thể sửa");
                if(btn_edit.classList.contains('running')){
                    fetch_data_edit();
                }
                else{

                    fetch_data();
                }               
                 return; // Kết thúc hàm nếu mã sản phẩm đã tồn tại
            }
        }
        for (let i = 0; i < len_ctpn; i++) {      
            if (list_sp_ctpn[i].trim() === id_xoa_hidden.toString().trim()) {
                alert("Mã sản phẩm đã tồn tại trong phiếu nhập, không thể sửa");
                if(btn_edit.classList.contains('running')){
                    fetch_data_edit();
                }
                else{

                    fetch_data();
                }
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
            else if(Find_SANPHAM.value!=''){
                fetch_data_search();
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
let cot_sp='sanpham.masp';
let sort_sp='false';
let cot_sp_hidden='sanpham.masp';
let sort_sp_hidden='false';
function fetch_data(){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        data:{COT_SP : cot_sp,SORT_SP:sort_sp},
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
        data:{COT_SP_HIDDEN : cot_sp_hidden,SORT_SP_HIDDEN:sort_sp_hidden},
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


$(document).on('click','.sortable_sp',function(){
    var cot=$(this).data('tk_sp');
    cot_sp=cot;
    if($(this).hasClass('click')){
        if(sort_sp=='false'){
            sort_sp='true';
        }
        else if(sort_sp=='true'){
            sort_sp='false';
        }
    }
    else{
        sort_sp='false';
    }
    if(Find_SANPHAM.value!=''){
        fetch_data_search();
    }
    else{
        fetch_data();
    }
})

$(document).on('click','.sortable_sp_hidden',function(){
    var cot=$(this).data('tk_sp_hidden');
    cot_sp_hidden=cot;
    if($(this).hasClass('click')){
        if(sort_sp_hidden=='false'){
            sort_sp_hidden='true';
        }
        else if(sort_sp_hidden=='true'){
            sort_sp_hidden='false';
        }
    }
    else{
        sort_sp_hidden='false';
    }
    if(Find_SANPHAM.value!=''){
        fetch_data_search_xoa();
    }
    else{
        fetch_data_hidden();
    }
})
//load danh mục
var NOIDUNG_DANHMUC=document.getElementById('NOIDUNG_DANHMUC');
var danhmuc_cho_sanpham=document.querySelector('.OPTIONADMINCONTENT');
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
function fetch_data_tendm(){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            var list_tendm = ""; // Khởi tạo một chuỗi để chứa tên danh mục

            // Duyệt qua mảng danh mục và thêm tên mỗi danh mục vào chuỗi
            for (var i = 0; i < responseData.list_madm.length; i++) {
                list_tendm += '<li class="option_dm" data-name="' + responseData.list_madm[i]['tendm'] + '" data-idname="' + responseData.list_madm[i]['madm'] + '">' + responseData.list_madm[i]['tendm'] + '</li>';
            }

            // Hiển thị danh sách tên danh mục
            danhmuc_cho_sanpham.innerHTML = list_tendm; 
        }
    });
}
$(document).on('click','.option_dm',function(){
    var name=$(this).data('name');
    var madm=$(this).data('idname');
    selectOption(name,madm);
})
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
                        fetch_data_tendm();
                        check=0;
                        return; // Kết thúc hàm nếu mã sản phẩm đã tồn tại
                    }
                });

            }
            else if(check===len_madm_all-1 && new_dm!=''){
                $.ajax({
                    url: "quanlysp/action_sp.php",
                    method: "POST",
                    data: { tendm: new_dm},
                    success: function(response) {
                        console.log('THÊM dữ liệu thành công');
                        // Assuming fetch_data() is defined elsewhere
                        fetch_data_dm();
                        fetch_data_tendm();
                        return;
                    }
                });
    
            }
            check+=1;
        }
        if(len_madm_all===0){
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


    });
});



    // xóa danh mục
    $(document).on('click','.Del_dm',function(){
        let check=0;
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
                            check-=1;
                            return; // Kết thúc hàm nếu mã sản phẩm đã tồn tại
                        }
                    });

                }
                else if(check===len_madm_sp-1){
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
                check+=1;
            }
            if(len_madm_sp===0){
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
        });
    })
    // tìm sản phẩm
    var Find_SANPHAM=document.getElementById('Find_SANPHAM');
    var Find_SANPHAM_XOA=document.getElementById('Find_SANPHAM_XOA');
    Find_SANPHAM.addEventListener('keypress',function(event){
        if (event.keyCode === 13) {
            fetch_data_search();
        }
    })
    Find_SANPHAM_XOA.addEventListener('keypress',function(event){
        if (event.keyCode === 13) {
                fetch_data_search_xoa();
        }
    })
    function fetch_data_search(){
        const search=Find_SANPHAM.value;
        if (Find_SANPHAM.value !== '') {
            $.ajax({
                url: "quanlysp/action_sp.php",
                method: "POST",
                data: { SEARCH:search,COT_SP : cot_sp,SORT_SP:sort_sp},
                success: function(response) {
                    Container_products.innerHTML='';
                    var responseData = JSON.parse(response);
                    var output1_search = responseData.output1_search;
                    Container_products.innerHTML = output1_search; 
                }
            });
        }else{
            Container_products.innerHTML='';
            fetch_data();
        }
    }
    function fetch_data_search_xoa(){
        const search=Find_SANPHAM_XOA.value;
        if (Find_SANPHAM_XOA.value !== '') {
            $.ajax({
                url: "quanlysp/action_sp.php",
                method: "POST",
                data: { SEARCH_Xoa:search,COT_SP_HIDDEN : cot_sp_hidden,SORT_SP_HIDDEN:sort_sp_hidden},
                success: function(response) {
                    Container_products_hidden.innerHTML='';
                    var responseData = JSON.parse(response);
                    var output_hidden_search = responseData.output_hidden_search;
                    Container_products_hidden.innerHTML = output_hidden_search; 
                }
            });
        }else{
            Container_products_hidden.innerHTML='';
            fetch_data_hidden();
        }
    }



// THỐNG KÊ
const LOC_THONGKE=document.getElementById('TYPE_THONGKE');
const LOC_DM=document.getElementById('TYPE_THONGKE_LOAI');
// const Filter_thongke_dm=document.querySelector('.FilterAccept');
const menu_THONGKE=document.querySelector('.dropdown-content-THONGKE');
const menu_THONGKE_DM=document.querySelector('.dropdown-content-THONGKE-danhmuc');
const outside_THONGKE=document.querySelector('.THONGKE');

const timeCheckbox=document.getElementById('time');
const weekCheckbox = document.getElementById('week');
const monthCheckbox = document.getElementById('month');
const textcheckbox=document.querySelector('.text_month');
const month_for_week=document.getElementById('month_for_week');
const start_time=document.getElementById('start_time');
const end_time=document.getElementById('end_time');
const bieudo_tuan_sum=document.getElementById('SUM');
const bieudo_tuan_avg=document.getElementById('AVG');
const bieudo_tuan_count=document.getElementById('COUNT');
const bieudo_tuan_max=document.getElementById('MAX');
const bieudo_tuan_min=document.getElementById('MIN');

const LOC_MONTH=document.getElementById('month_for_week');
const monthDropdown = document.querySelector('.MONTH');
const menu_MONTH=document.querySelector('.dropdown-content-MONTH');


LOC_THONGKE.addEventListener('click',function(event){
    menu_THONGKE.classList.remove('invisible');
    event.stopPropagation();
})
LOC_DM.addEventListener('click',function(event){
    menu_THONGKE_DM.classList.remove('invisible');
    fetch_data_dm_THONGKE();
    event.stopPropagation();
})
document.addEventListener('click',function(event){
    const target=event.target;
    if(!menu_THONGKE_DM.contains(target)){
        menu_THONGKE_DM.classList.add('invisible');
    }
})
outside_THONGKE.addEventListener('click',function(){
    menu_THONGKE.classList.add('invisible');
})

function selectOptionType(option) {
    document.getElementById("TYPE_THONGKE").value = option;
    console.log(option);
    clearElement();
    var option2=document.getElementById("month_for_week").value;
    if(option2){
        if(option==="TẤT CẢ"){
            fetch_data_month_SUM(option2);
            fetch_data_month_AVERAGE(option2);
            fetch_data_month_COUNT(option2);
            fetch_data_month_MAX(option2);
            fetch_data_month_MIN(option2);
        }
        else if(option==="TỔNG"){
            fetch_data_month_SUM(option2);
        }
        else if(option==="TRUNG BÌNH"){
            fetch_data_month_AVERAGE(option2);
        }
        else if(option==="SỐ LƯỢNG"){
            fetch_data_month_COUNT(option2);
        }
        else if(option==="MIN"){
            fetch_data_month_MIN(option2);   
        }
        else if(option==="MAX"){
            fetch_data_month_MAX(option2);   
        }
    }
    else if(monthCheckbox.checked===true){
        if(option==="TẤT CẢ"){
            fetch_data_year_SUM();
            fetch_data_year_AVG();
            fetch_data_year_COUNT();
            fetch_data_year_MAX();
            fetch_data_year_MIN();
        }
        else if(option==="TỔNG"){
            fetch_data_year_SUM();

        }
        else if(option==="TRUNG BÌNH"){
            fetch_data_year_AVG();
        }
        else if(option==="SỐ LƯỢNG"){
            fetch_data_year_COUNT();
        }
        else if(option==="MIN"){
            fetch_data_year_MIN();
        }
        else if(option==="MAX"){
            fetch_data_year_MAX();
        }
    }
}


//checkbox
var Filter_time=document.querySelector('.Filter_time');
var filter_product=document.getElementById('filter_product');
var filter_product_dm=document.getElementById('filter_product_dm');

weekCheckbox.addEventListener('click', function() {
    if (weekCheckbox.checked) {
        clearElement();
        Filter_time.classList.add('invisible');
        menu_THONGKE.classList.add('invisible');
        menu_THONGKE_DM.classList.add('invisible');
        start_time.classList.add('invisible');
        end_time.classList.add('invisible');
        LOC_DM.classList.add('invisible');
        // Filter_thongke_dm.classList.add('invisible');
        LOC_THONGKE.classList.remove('invisible');
        timeCheckbox.checked=false;
        monthCheckbox.checked = false;
        month_for_week.classList.remove('invisible');
        textcheckbox.classList.remove('invisible');
    }
    else{
        menu_THONGKE.classList.add('invisible');
        Filter_time.classList.add('invisible');
        menu_THONGKE_DM.classList.add('invisible');
        start_time.classList.add('invisible');
        end_time.classList.add('invisible');
        LOC_DM.classList.add('invisible');
        // Filter_thongke_dm.classList.add('invisible');
        LOC_THONGKE.classList.remove('invisible');
        weekCheckbox.checked=true;
    }
});
monthCheckbox.addEventListener('click', function() {
    if (monthCheckbox.checked) {
        clearElement();
        Filter_time.classList.add('invisible');
        menu_THONGKE.classList.add('invisible');
        menu_THONGKE_DM.classList.add('invisible');
        start_time.classList.add('invisible');
        end_time.classList.add('invisible');
        LOC_DM.classList.add('invisible');
        // Filter_thongke_dm.classList.add('invisible');
        LOC_THONGKE.classList.remove('invisible');
        weekCheckbox.checked = false;
        timeCheckbox.checked=false;
        month_for_week.classList.add('invisible');
        month_for_week.value='';
        textcheckbox.classList.add('invisible');
    }
    else{
        Filter_time.classList.add('invisible');
        menu_THONGKE.classList.add('invisible');
        menu_THONGKE_DM.classList.add('invisible');
        start_time.classList.add('invisible');
        end_time.classList.add('invisible');
        LOC_THONGKE.classList.remove('invisible');
        LOC_DM.classList.add('invisible');
        // Filter_thongke_dm.classList.add('invisible');
        monthCheckbox.checked=true;
    }
    if(LOC_THONGKE.value==="TẤT CẢ"){
        fetch_data_year_SUM();
        fetch_data_year_AVG();
        fetch_data_year_COUNT();
        fetch_data_year_MAX();
        fetch_data_year_MIN();
    }
    else if(LOC_THONGKE.value==="TỔNG"){
        fetch_data_year_SUM();
    }
    else if(LOC_THONGKE.value==="TRUNG BÌNH"){
        fetch_data_year_AVG();
    }
    else if(LOC_THONGKE.value==="SỐ LƯỢNG"){
        fetch_data_year_COUNT();
    }
    else if(LOC_THONGKE.value==="MAX"){
        fetch_data_year_MAX();
    }
    else if(LOC_THONGKE.value==="MIN"){
        fetch_data_year_MIN();
    }
});

timeCheckbox.addEventListener('click', function() {
    if (timeCheckbox.checked) {
        Filter_time.classList.remove('invisible');
        menu_THONGKE.classList.add('invisible');
        menu_THONGKE_DM.classList.add('invisible');
        start_time.classList.remove('invisible');
        end_time.classList.remove('invisible');
        LOC_THONGKE.classList.add('invisible');
        LOC_DM.classList.add('invisible');
        // Filter_thongke_dm.classList.add('invisible');
        clearElement();
        weekCheckbox.checked = false;
        monthCheckbox.checked=false;
        document.querySelector('.text_month').classList.add('invisible');
        month_for_week.classList.add('invisible');
        start_time.classList.remove('invisible');
        end_time.classList.remove('invisible');
    }
    else{
        Filter_time.classList.remove('invisible');
        menu_THONGKE.classList.add('invisible');
        menu_THONGKE_DM.classList.add('invisible');
        start_time.classList.remove('invisible');
        end_time.classList.remove('invisible');
        LOC_DM.classList.add('invisible');
        // Filter_thongke_dm.classList.add('invisible');
        LOC_THONGKE.classList.add('invisible');
        timeCheckbox.checked=true;
    }

})

filter_product.addEventListener('click', function() {
    if (filter_product.checked) {
        fetch_data_top_products();
        clearElement()
        filter_product_dm.checked=false;
        LOC_DM.classList.add('invisible');
        // Filter_thongke_dm.classList.add('invisible');
        
    }
    else{
        fetch_data_top_products();
        filter_product.checked=true;
        LOC_DM.classList.add('invisible');
        // Filter_thongke_dm.classList.add('invisible');
    }
})
filter_product_dm.addEventListener('click',function(){
    if (filter_product_dm.checked) {
        fetch_data_top_products_cungloai_dm();
        clearElement()
        filter_product.checked=false;
        LOC_DM.classList.remove('invisible');
        // Filter_thongke_dm.classList.remove('invisible');
    }
    else{
        fetch_data_top_products_cungloai_dm();
        filter_product_dm.checked=true;
        LOC_DM.classList.remove('invisible');
        // Filter_thongke_dm.classList.remove('invisible');
    }
})

LOC_MONTH.addEventListener('click',function(event){
    menu_MONTH.classList.remove('invisible');
    event.stopPropagation();
})
document.addEventListener('click',function(event){
    if (!monthDropdown.contains(event.target)) {
        // Thêm lớp invisible vào dropdown-content-MONTH
        menu_MONTH.classList.add('invisible');
    }
})



function fetch_data_dm_THONGKE(){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            var output_dm_THONGKE = responseData.output_dm_THONGKE;
            menu_THONGKE_DM.innerHTML = output_dm_THONGKE; 
        }
    });
}


function selectOption_MONTH(option) {
    document.getElementById("month_for_week").value = option;
    console.log(option);
    clearElement();
    if(document.getElementById("TYPE_THONGKE").value=="TẤT CẢ"){
            fetch_data_month_SUM(option);
            fetch_data_month_AVERAGE(option);
            fetch_data_month_COUNT(option);
            fetch_data_month_MAX(option);
            fetch_data_month_MIN(option);
    }
    else if(document.getElementById("TYPE_THONGKE").value==="TỔNG"){
        fetch_data_month_SUM(option);
    }
    else if(document.getElementById("TYPE_THONGKE").value==="TRUNG BÌNH"){
        fetch_data_month_AVERAGE(option);
    }
    else if(document.getElementById("TYPE_THONGKE").value==="SỐ LƯỢNG"){
        fetch_data_month_COUNT(option);
    }
    else if(document.getElementById("TYPE_THONGKE").value==="MAX"){
        fetch_data_month_MAX(option);
    }
    else if(document.getElementById("TYPE_THONGKE").value==="MIN"){
        fetch_data_month_MIN(option);
    }
    // thêm if vào
}
function clearElement() {
    DETAIL.innerHTML='';
    bieudo_tuan_sum.innerHTML='';
    bieudo_tuan_avg.innerHTML='';
    bieudo_tuan_count.innerHTML='';
    bieudo_tuan_max.innerHTML='';
    bieudo_tuan_min.innerHTML='';
}

function fetch_data_month_SUM(option){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        data: { option: option},
        success: function(response) {
            var responseData = JSON.parse(response);
            var output_thongke_tuan_SUM = responseData.output_thongke_tuan_SUM;
            bieudo_tuan_sum.innerHTML = output_thongke_tuan_SUM; 
        }
    });
}
function fetch_data_month_AVERAGE(option){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        data: { option: option},
        success: function(response) {
            var responseData = JSON.parse(response);
            var output_thongke_tuan_AVERAGE = responseData.output_thongke_tuan_AVERAGE;
            bieudo_tuan_avg.innerHTML = output_thongke_tuan_AVERAGE; 
        }
    });
}
function fetch_data_month_COUNT(option){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        data: { option: option},
        success: function(response) {
            var responseData = JSON.parse(response);
            var output_thongke_tuan_COUNT = responseData.output_thongke_tuan_COUNT;
            bieudo_tuan_count.innerHTML = output_thongke_tuan_COUNT; 
        }
    });
}
function fetch_data_month_MAX(option){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        data: { option: option},
        success: function(response) {
            var responseData = JSON.parse(response);
            var output_thongke_tuan_MAX = responseData.output_thongke_tuan_MAX;
            bieudo_tuan_max.innerHTML = output_thongke_tuan_MAX; 
        }
    });
}
function fetch_data_month_MIN(option){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        data: { option: option},
        success: function(response) {
            var responseData = JSON.parse(response);
            var output_thongke_tuan_MIN = responseData.output_thongke_tuan_MIN;
            bieudo_tuan_min.innerHTML = output_thongke_tuan_MIN; 
        }
    });
}
function fetch_data_year_SUM(){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            var output_thongke_year_SUM = responseData.output_thongke_year_SUM;
            bieudo_tuan_sum.innerHTML = output_thongke_year_SUM; 
        }
    });
}

function fetch_data_year_AVG(){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            var output_thongke_year_SUM = responseData.output_thongke_year_AVG;
            bieudo_tuan_avg.innerHTML = output_thongke_year_SUM; 
        }
    });
}

function fetch_data_year_COUNT(){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            var output_thongke_year_SUM = responseData.output_thongke_year_COUNT;
            bieudo_tuan_count.innerHTML = output_thongke_year_SUM; 
        }
    });
}

function fetch_data_year_MAX(){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            var output_thongke_year_SUM = responseData.output_thongke_year_MAX;
            bieudo_tuan_max.innerHTML = output_thongke_year_SUM; 
        }
    });
}

function fetch_data_year_MIN(){
    $.ajax({
        url: "quanlysp/action_sp.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            var output_thongke_year_SUM = responseData.output_thongke_year_MIN;
            bieudo_tuan_min.innerHTML = output_thongke_year_SUM; 
        }
    });
}
$(document).on('click', '.Tendm_thongke', function() {
    var tendm=$(this).data('tk');
    document.getElementById('TYPE_THONGKE_LOAI').value=tendm;
    menu_THONGKE_DM.classList.add('invisible');
    fetch_data_top_products_cungloai_dm();

});
start_time.addEventListener('change',function(){
    if(filter_product_dm.checked==true){
        fetch_data_top_products_cungloai_dm();
    }
    else if(filter_product.checked==true){
        fetch_data_top_products();
    }
})
end_time.addEventListener('change',function(){
    if(filter_product_dm.checked==true){
        fetch_data_top_products_cungloai_dm();
    }
    else if(filter_product.checked==true){
        fetch_data_top_products();
    }
})
var DETAIL=document.getElementById('DETAIL');
var SHOWOUT=document.getElementById('SHOWOUT');
let sapxeptheocotbang1='tong_soluong';
let sapxeptheocotbang2='tong_soluong';
let ascordes1='false';
let ascordes2='false';
function fetch_data_top_products(){
    if(end_time.value!='' && start_time.value!='' && start_time.value < end_time.value &&filter_product.checked==true){
        var start=start_time.value;
        var end=end_time.value;
        $.ajax({
            url: "quanlysp/action_sp.php",
            method: "POST",
            data: {START:start,END:end,COT1:sapxeptheocotbang1,COT2:sapxeptheocotbang2,SORT1:ascordes1,SORT2:ascordes2},
            success: function(response) {
                var responseData = JSON.parse(response);
                var output_top = responseData.output_top_dm;
                var output_top_loinhuan=responseData.output_top_dm_loinhuan;
                var combinedHTML = `
                <div>
                    ${output_top}
                </div>
                <div>
                    ${output_top_loinhuan}
                </div>
                `;

                // Gán chuỗi HTML đã tạo vào phần tử có id là DETAIL
                DETAIL.innerHTML = combinedHTML;
            }
        });
    }
}
function fetch_data_top_products_cungloai_dm(){
    if(LOC_DM.value!='' && end_time.value!='' && start_time.value!='' && start_time.value < end_time.value){
        var DM=LOC_DM.value;
        var start=start_time.value;
        var end=end_time.value;
        $.ajax({
            url: "quanlysp/action_sp.php",
            method: "POST",
            data: {DANHMUC:DM,START:start,END:end,COT1:sapxeptheocotbang1,COT2:sapxeptheocotbang2,SORT1:ascordes1,SORT2:ascordes2},
            success: function(response) {
                var responseData = JSON.parse(response);
                var output_top_dm = responseData.output_top;
                var output_top_dm_loinhuan=responseData.output_top_loinhuan;
                // Tạo một chuỗi HTML kết hợp cả hai giá trị
                var combinedHTML = `
                <div>
                    ${output_top_dm}
                </div>
                <div>
                    ${output_top_dm_loinhuan}
                </div>
                `;

                // Gán chuỗi HTML đã tạo vào phần tử có id là DETAIL
                DETAIL.innerHTML = combinedHTML;
            }
        });
    }
}
$(document).on('click','.sortable_tk',function(){
    var cot=$(this).data('tk_filter');
    sapxeptheocotbang1=cot;
    if($(this).hasClass('click')){
        if(ascordes1=='false'){
            ascordes1='true';
        }
        else if(ascordes1=='true'){
            ascordes1='false';
        }
    }
    else{
        ascordes1='false';
    }
    fetch_data_top_products();
})
$(document).on('click','.sortable_tk_TIEN',function(){
    var cot=$(this).data('tk_filter');
    sapxeptheocotbang2=cot;
    if($(this).hasClass('click')){
        if(ascordes2=='false'){
            ascordes2='true';
        }
        else if(ascordes2=='true'){
            ascordes2='false';
        }
    }
    else{
        ascordes2='false';
    }
    fetch_data_top_products();
})
//
$(document).on('click','.sortable_tk_filter',function(){
    var cot=$(this).data('tk_filter');
    sapxeptheocotbang1=cot;
    if($(this).hasClass('click')){
        if(ascordes1=='false'){
            ascordes1='true';
        }
        else if(ascordes1=='true'){
            ascordes1='false';
        }
    }
    else{
        ascordes1='false';
    }
    fetch_data_top_products_cungloai_dm();
})
$(document).on('click','.sortable_tk_filter_TIEN',function(){
    var cot=$(this).data('tk_filter');
    sapxeptheocotbang2=cot;
    if($(this).hasClass('click')){
        if(ascordes2=='false'){
            ascordes2='true';
        }
        else if(ascordes2=='true'){
            ascordes2='false';
        }
    }
    else{
        ascordes2='false';
    }
    fetch_data_top_products_cungloai_dm();
})




window.addEventListener('load', function() {
    selectOptionType('TẤT CẢ');
    show_madm.style.display = 'none';
    weekCheckbox.click();
    filter_product.click();
    fetch_data(); // Gọi hàm để tải sản phẩm khi trang được load
    fetch_data_hidden();
    fetch_data_phieu_nhap();
    fetch_data_tendm();
    fetch_data_dm();
    var today = new Date();
    var formattedDate = today.toISOString().substr(0, 10);
    document.getElementById('Ngay_PN').value = formattedDate;
});
class CHITIETPHIEUNHAP {
    constructor(CHART_BOX,masp,soluong,gianhap,tongtien) {
      this.CHART_BOX = CHART_BOX;
      this.masp=masp;
      this.soluong=soluong;
      this.gianhap=gianhap;
      this.tongtien=tongtien;

      this.element = document.createElement('tr');
      this.element.classList.add('ChiTietPN');
      this.element.CHITIETPHIEUNHAP = this;

      const masp_PN=document.createElement('td');
      masp_PN.classList.add('masp_PN');
      masp_PN.textContent=masp;

      const soluong_PN=document.createElement('td');
      soluong_PN.classList.add('soluong_PN');
      soluong_PN.textContent=soluong;

      const gianhap_PN=document.createElement('td');
      gianhap_PN.classList.add('gianhap_PN');
      gianhap_PN.textContent=gianhap;

      const tongtien_PN=document.createElement('td');
      tongtien_PN.classList.add('tongtien_PN');
      tongtien_PN.textContent=tongtien;

      const btn_xoa=document.createElement('button');
      btn_xoa.classList.add('xoa_PN');
      btn_xoa.textContent='xóa';
      btn_xoa.style.width='100%';

      this.CHART_BOX.appendChild(this.element);
      this.element.appendChild(masp_PN);
      this.element.appendChild(soluong_PN);
      this.element.appendChild(gianhap_PN);
      this.element.appendChild(tongtien_PN);
      this.element.appendChild(btn_xoa);
    
      }
      getMasp(){
        return this.masp;
      }
      getSoluong(){
        return this.soluong;
      }
      SetSoluong(soluongmoi){
        this.soluong=soluongmoi;
      }
      getGianhap(){
        return this.gianhap;
      }
      remove(){
        this.element.remove();
      }
    }



    var showFormButton = document.getElementById('btn_showFormAddPN');
    var myForm = document.getElementById('div_bao_FormAdd_PN');
    var divPhuden = document.getElementById('div_phu_den');

    showFormButton.addEventListener('click', function () {
        myForm.classList.remove('invisible');
        divPhuden.classList.remove('invisible')
    });
    var formPhieuNhap=document.getElementById('FormAddPN');
    var PHIEUNHAP_TABLE=document.getElementById('PHIEUNHAP');
    var closeFormButton = document.getElementById('btn_closeFormAddPN');
    var myForm = document.getElementById('div_bao_FormAdd_PN');
    var divPhuden = document.getElementById('div_phu_den');
    var add_CHITIETPHIEUNHAP=document.getElementById('btn_xacnhan_them_pn');
    var chooseSP_PN=document.getElementById('SP_PN');
    var chooseNV_PN=document.getElementById('NV_PN');
    var gianhap=document.getElementById('TIEN_SP_PN');
    var soluongnhap=document.getElementById('SOLUONG_SP_PN');
    var thanhtiennhap=document.getElementById('THANHTIEN_SP_PN');
    var menuSP_PN=document.querySelector('.SP_PN');
    var menuNV_PN=document.querySelector('.NV_PN');
    var menuCHITIETPHIEUNHAP=document.getElementById('menuCHITIETPHIEUNHAP');
    formPhieuNhap.addEventListener("submit", function(event) {
        event.preventDefault();
      });

    let masp_CHITIETPN;
    let manv;
    let save_tien;
    chooseSP_PN.addEventListener('click',function(){
        menuSP_PN.classList.remove('invisible');
        $.ajax({
            url: "quanlysp/action_sp.php",
            method: "POST",
            success: function(response) {
                var responseData = JSON.parse(response);
                var list_masp_tensp = responseData.list_masp_tensp;
                menuSP_PN.innerHTML=list_masp_tensp;
            }
        });
    })
    chooseNV_PN.addEventListener('click',function(){
        menuNV_PN.classList.remove('invisible');
        $.ajax({
            url: "quanlysp/action_sp.php",
            method: "POST",
            success: function(response) {
                var responseData = JSON.parse(response);
                var list_manv_tennv = responseData.list_manv_tennv;
                menuNV_PN.innerHTML=list_manv_tennv;
            }
        });
    })
    document.addEventListener('click',function(event){ 
        var targetElement = event.target; // Phần tử được click
        if (!chooseNV_PN.contains(targetElement) && !menuNV_PN.contains(targetElement)) {
            menuNV_PN.classList.add('invisible'); // Thêm lớp 'invisible' vào .SP_PN
        }
    })
    document.addEventListener('click',function(event){ 
        var targetElement = event.target; // Phần tử được click
        if (!menuSP_PN.contains(targetElement) && !chooseSP_PN.contains(targetElement)) {
            menuSP_PN.classList.add('invisible'); // Thêm lớp 'invisible' vào .SP_PN
        }
    })
    $(document).on('click','.NhanVien_PN',function(){
        var tennv=$(this).data('tennv');
        var manv_pn=$(this).data('manv');
        chooseNV_PN.value=tennv;
        menuNV_PN.classList.add('invisible');
        manv=manv_pn;
    })
    $(document).on('click','.TenSP_PN',function(){
        var masp=$(this).data('masppn');
        var tensp=$(this).data('tensppn');
        var tien=$(this).data('tiensppn');
        masp_CHITIETPN=masp;
        chooseSP_PN.value=tensp;
        menuSP_PN.classList.add('invisible');
        gianhap.value=tien;
        soluongnhap.value=1;
        save_tien=gianhap.value;
        thanhtiennhap.value=gianhap.value;
    })
    soluongnhap.addEventListener('input',function(){
        var soluong=soluongnhap.value;
        if(soluong<1){
            soluongnhap.value=1;
            return;
        }
        var dongia=gianhap.value;
        thanhtiennhap.value=soluong*dongia;
    })
    gianhap.addEventListener('input',function(){
        var soluong=soluongnhap.value;
        var dongia=gianhap.value;
        if(dongia>save_tien || dongia<0){
            gianhap.value=save_tien;
            thanhtiennhap.value=soluong*gianhap.value;
            return;
        }
        thanhtiennhap.value=soluong*dongia;
    })
    function load_CHITIETPHIEUNHAP(item){
        
        const masp=item.getMasp();
        const soluong=item.getSoluong();
        const gianhap=item.getGianhap();
        const newCHITETPHIEUNHAP=new CHITIETPHIEUNHAP(
            menuCHITIETPHIEUNHAP,
            masp,
            soluong,
            gianhap,
            soluong*gianhap
        )
        item.remove();
    }
    function check_CHITIETPHIEUNHAP(masp_CHITIETPN,gianhap,soluong){
        for (let i = 0; i < menuCHITIETPHIEUNHAP.children.length; i++) {
            let item = menuCHITIETPHIEUNHAP.children[i].CHITIETPHIEUNHAP;
            if (item.getMasp() === masp_CHITIETPN && item.getGianhap() === gianhap) {
                item.SetSoluong(parseInt(item.getSoluong())+parseInt(soluong));  
                load_CHITIETPHIEUNHAP(item);              
                return true;
            }
        }
        return false;
    }
    add_CHITIETPHIEUNHAP.addEventListener('click',function(event){
        if(check_CHITIETPHIEUNHAP(masp_CHITIETPN,gianhap.value,soluongnhap.value)===true){
            console.log('đã tồn tại');
        }
        else{
            const newCHITETPHIEUNHAP=new CHITIETPHIEUNHAP(
                menuCHITIETPHIEUNHAP,
                masp_CHITIETPN,
                soluongnhap.value,
                gianhap.value,
                thanhtiennhap.value
            )
        }
        // Thêm sự kiện click vào nút "xóa"
        var btn_xoas=document.querySelectorAll('.xoa_PN');
        btn_xoas.forEach(btn_xoa => {            
            btn_xoa.addEventListener('click', function(event) {
                // Tìm phần tử cha có class là "ChiTietPN"
                const chiTietPNElement = this.closest('.ChiTietPN');
                
                // Kiểm tra nếu tìm thấy phần tử cha thì xóa nó đi
                if (chiTietPNElement) {
                    chiTietPNElement.remove();
                }
            });
        });
    })

    


    closeFormButton.addEventListener('click', function (event) {
        event.preventDefault();
        myForm.classList.add('invisible');
        divPhuden.classList.add('invisible');
        chooseSP_PN.value='';
        soluongnhap.value='';
        gianhap.value='';
        thanhtiennhap.value='';
    });
    var btn_addPN=document.getElementById('btn_ADDPN');
    var ngay_Nhap=document.getElementById('Ngay_PN');
    btn_addPN.addEventListener('click', function() {
        var div_PHIEUNHAP = document.getElementById('menuCHITIETPHIEUNHAP');
        if (div_PHIEUNHAP.children.length > 0) {
            const tableData = [];
            let tongtien_from_chitiet = 0;
            const rowCount = menuCHITIETPHIEUNHAP.querySelectorAll('tr').length;
            menuCHITIETPHIEUNHAP.querySelectorAll('tr').forEach(row => {
                const rowData = [];
                const cells = row.querySelectorAll('td');
                const tongtien = row.querySelector('.tongtien_PN');
                tongtien_from_chitiet += parseInt(tongtien.textContent);
                cells.forEach(cell => {
                    rowData.push(cell.textContent);
                });
                tableData.push(rowData);
            });
            // Gửi AJAX sau khi đã lặp qua tất cả các dòng trong bảngs
            if(chooseNV_PN.value!=''){
                $.ajax({
                    url: 'quanlysp/action_sp.php',
                    method: 'POST',
                    data: {
                        rowCount: rowCount,
                        tableData: tableData,
                        tongtien: tongtien_from_chitiet,
                         manv:manv,
                         ngaynhap:JSON.stringify(ngay_Nhap.value)
                    },
                    success: function(response) {
                        fetch_data_phieu_nhap();
                        alert('đã thêm thành công');
                        if(Find_SANPHAM.value!=''){
                            fetch_data_search();
                        }
                        else{
                            fetch_data();
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('có lỗi xảy ra , không thêm phiếu nhập thành công');
                    }
                });
            }
            else{
                alert('vui lòng chọn nhân viên đã ghi phiếu nhập');
            }
        } else {
            // Xử lý khi không có phần tử con trong div PHIEUNHAP
            alert('Phiếu nhập trống');
        }
    });
    var showphieunhap=document.getElementById('SHOWPHIEUNHAP');
    var showchitietphieunhap=document.getElementById('SHOWCHITIETPHIEUNHAP');
    var btn_back=document.querySelector('.BTN_BACK');
    function fetch_data_phieu_nhap(){
        $.ajax({
            url: 'quanlysp/action_sp.php',
            method: 'POST',
            success:function(response){
                var responseData = JSON.parse(response);
                var output_phieu_nhap = responseData.output_phieu_nhap;
                showphieunhap.innerHTML=output_phieu_nhap;
            }
        })
    }
    function fetch_data_chi_tiet_phieu_nhap(ma_phieu_nhap){
        $.ajax({
            url: 'quanlysp/action_sp.php',
            method: 'POST',
            data:{ma_phieu_nhap:ma_phieu_nhap},
            success:function(response){
                var responseData = JSON.parse(response);
                var output_chi_tiet_phieu_nhap = responseData.output_chi_tiet_phieu_nhap;
                showchitietphieunhap.innerHTML=output_chi_tiet_phieu_nhap;
            }
        })
    }
    $(document).on('click','.SHOW_CT',function(){
        var mapn=$(this).data('id_phieunhap');
        btn_back.classList.remove('invisible');
        showphieunhap.classList.add('invisible');
        showchitietphieunhap.classList.remove('invisible');
        showFormButton.classList.add('invisible');
        PHIEUNHAP_TABLE.classList.add('invisible');
        btn_addPN.classList.add('invisible');
        console.log('load chi tiết phiếu nhập');
        fetch_data_chi_tiet_phieu_nhap(mapn);
    })
    $(document).on('click','.Del_phieu_nhap',function(event){
        event.stopPropagation();
        var ngapnhap=$(this).data('ngnpn');
        
        var mapn=$(this).data('id_phieunhap');
        $.ajax({
            url: 'quanlysp/action_sp.php',
            method: 'POST',
            data:{ma_phieu_nhap_xoa:mapn},
            success:function(response){
                fetch_data_phieu_nhap();
                if(Find_SANPHAM.value!=''){
                    fetch_data_search();
                }
                else{
                    fetch_data();
                }
            }
        })
    })
    btn_back.addEventListener('click',function(){
        showchitietphieunhap.innerHTML='';
        btn_addPN.classList.remove('invisible');
        showFormButton.classList.remove('invisible');
        showchitietphieunhap.classList.add('invisible');
        PHIEUNHAP_TABLE.classList.remove('invisible');
        btn_back.classList.add('invisible');
        showphieunhap.classList.remove('invisible');
    })
    var Find_PHIEUNHAP=document.getElementById('Find_PHIEUNHAP');
    var ngay_phieunhap_start=document.getElementById('Ngay_PN_start');
    var ngay_phieunhap_end=document.getElementById('Ngay_PN_end');

    Find_PHIEUNHAP.addEventListener('keypress',function(event){
        if (event.keyCode === 13) {
            if (Find_PHIEUNHAP.value !== '') {
                fetch_data_phieu_nhap_search();
            }
            else{
                fetch_data_phieu_nhap();
            }
        }
    })
    ngay_phieunhap_end.addEventListener('input',function(){
        fetch_data_phieu_nhap_search();
    })
    ngay_phieunhap_start.addEventListener('input',function(){
        fetch_data_phieu_nhap_search();
    })
    function fetch_data_phieu_nhap_search(){
        const search=Find_PHIEUNHAP.value;
        if (Find_PHIEUNHAP.value !== '' || (ngay_phieunhap_start.value!=='' && ngay_phieunhap_end.value!=='')) {
            $.ajax({
                url: "quanlysp/action_sp.php",
                method: "POST",
                data: { SEARCH_PN:search,Ngay_Start:ngay_phieunhap_start.value,Ngay_End:ngay_phieunhap_end.value},
                success: function(response) {
                    showphieunhap.innerHTML='';
                    var responseData = JSON.parse(response);
                    var output_phieu_nhap_search = responseData.output_phieu_nhap_search;
                    showphieunhap.innerHTML = output_phieu_nhap_search; 
                }
            });
        }else{
            showphieunhap.innerHTML='';
            fetch_data_phieu_nhap();
        }
    }
