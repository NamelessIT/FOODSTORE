const images = [
    './img/ha5.jpg',
    './img/ha1.jpg',
    './img/ha2.jpg',
    './img/ha3.jpg'
    ];
   const interval = 3000
    const anhdauimgElement = document.querySelector('.background_transfer')
    const btntong= document.querySelectorAll(".background-perdoc .perdoc li")
    let currentImageIndex = 0
    function changeBackgroundImage() {
    anhdauimgElement.style.backgroundImage = `url('${images[currentImageIndex]}')`
    const t = btntong[currentImageIndex];
  //  t.style.backgroundColor = "red";
  //  t.style.backgroundColor="red";
   for (let i = 0; i < btntong.length; i++) {
       if (i === currentImageIndex) continue;  
       const t = btntong[i];
       t.style.backgroundColor = "gray";
     } 
    currentImageIndex++
    if (currentImageIndex === images.length) {
    currentImageIndex = 0
  }
    }
    changeBackgroundImage()
    setInterval(changeBackgroundImage, interval)
    const btnimg1= document.querySelector(".btn1")
    const btnimg2 = document.querySelector(".btn2")
    const btnimg3= document.querySelector(".btn3")
    const btnimg4= document.querySelector(".btn4")
   function button1(){
       const tmp = document.querySelector('.btn1');
       tmp.style.backgroundColor = "red";
       const mangthu1 = document.querySelectorAll('.background-perdoc .perdoc li');
       for (let i = 0; i < mangthu1.length; i++) {
         if (i === 0) continue;  
         const t = mangthu1[i];
         t.style.backgroundColor = "gray";
       }
       anhdauimgElement.style.backgroundImage= `url('${images[0]}')`
       currentImageIndex=0;
       changeBackgroundImage()
   }
    function button2(){
       const tmp = document.querySelector('.btn2');
       tmp.style.backgroundColor = "red";
       const mangthu1 = document.querySelectorAll('.background-perdoc .perdoc li');
       for (let i = 0; i < mangthu1.length; i++) {
         if (i === 1) continue;  
         const t = mangthu1[i];
         t.style.backgroundColor = "gray";
       }
   anhdauimgElement.style.backgroundImage= `url('${images[1]}')`
   currentImageIndex=1;
   changeBackgroundImage()
  }
  function button3(){
   const tmp = document.querySelector('.btn3');
       tmp.style.backgroundColor = "red";
       const mangthu1 = document.querySelectorAll('.background-perdoc .perdoc li');
       for (let i = 0; i < mangthu1.length; i++) {
         if (i === 2) continue;  
         const t = mangthu1[i];
         t.style.backgroundColor = "gray";
       }
   anhdauimgElement.style.backgroundImage= `url('${images[2]}')`
   currentImageIndex=2;
   changeBackgroundImage()
  }
  function button4(){
   const tmp = document.querySelector('.btn4');
       tmp.style.backgroundColor = "red";
       const mangthu1 = document.querySelectorAll('.background-perdoc .perdoc li');
       for (let i = 0; i < mangthu1.length; i++) {
         if (i === 3) continue;  
         const t = mangthu1[i];
         t.style.backgroundColor = "gray";
       }
   anhdauimgElement.style.backgroundImage= `url('${images[3]}')`
   currentImageIndex=3;
   changeBackgroundImage()
  }
btnimg1.addEventListener("click", button1)
  btnimg2.addEventListener("click", button2)
  btnimg3.addEventListener("click", button3)
  btnimg4.addEventListener("click", button4)


var khungtrangchinh=document.querySelector('main');
var formmain=document.querySelector('.sidebar');
formmain.classList.add('forman');
var caidanhmuc=document.querySelector('.danhmuc');
var khungthongtk= document.getElementById('thongttkkk');
khungthongtk.style.display='none';
caidanhmuc.addEventListener("click",function(){
    formmain.classList.remove('forman');
})
function hientrangthaidonhang(){
    $.ajax({
        url: "nguoidung.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            var outputttdh = responseData.outputttdh;
            document.getElementById('trangchinh').innerHTML = outputttdh; 
        }
    });
}
function hienlichsumuahang(){
    $.ajax({
        url: "nguoidung.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            var outputlsmh = responseData.outputlsmh;
            document.getElementById('trangchinh').innerHTML = outputlsmh; 
        }
    });
}

function hienthongtintaikhoan(){
    $.ajax({
        url: "nguoidung.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            var outputtk = responseData.outputtk;
            document.getElementById('thongttkkk').innerHTML = outputtk; 
        }
    });
}

function load_cthd(tmp,mahd,makh) {
    $.ajax({
        url: "nguoidung.php",
        method: "POST",
        data: { mahd: mahd, makh: makh,tmp:tmp},
        success: function(data) {
            var responseData = JSON.parse(data);
            var outputct = responseData.outputct;
            document.getElementById('SHOWCTHD').innerHTML = outputct; 
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            // Xử lý lỗi ở đây nếu cần
        }
    });
}
function xacnhanhuyhang(ttmp, mhddddd, mkhhhhh){
    let data = new FormData();
    data.append('ttmp', ttmp);
    data.append('mhddddd', mhddddd); // sửa từ 'mahdd' thành 'mahd'
    data.append('mkhhhhh', mkhhhhh); // sửa từ 'makhh' thành 'makh'

    // Gửi yêu cầu POST đến tệp PHP
    fetch('nguoidung.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.text()) // Xử lý phản hồi từ máy chủ
    .then(result => {
        hientrangthaidonhang(); // Gọi hàm fetch_data_hienhd() sau khi yêu cầu hoàn tất

    })
    .catch(error => {
        console.error('Error:', error);
    });
}
$(document).on('click', '.laythongtinhd', function() {
    var tmp = $(this).data('tmp');
    var mahd = $(this).data('mhd');
    var makh = $(this).data('mkh');

    // console.log(tmp);
    // var text = $(this).text();
    // check_already_masp_cthd(id, text, "tensp");
    load_cthd(tmp,mahd,makh);
});
$(document).on('click', '.btn-dong', function() {
    document.getElementById('SHOWCTHD').innerHTML='';
});
$(document).on('click', '.bthd-hdh', function() {
    var ttmp = $(this).data('ttmp');
    var mhddddd = $(this).data('mhddddd');
    var mkhhhhh = $(this).data('mkhhhhh');
    // var text = $(this).text();
    // check_already_masp_cthd(id, text, "tensp");
    xacnhanhuyhang(ttmp,mhddddd,mkhhhhh);
    document.getElementById('SHOWCTHD').innerHTML='';
});
document.querySelector('.QUANLYDONHANG').addEventListener("click",function(){
    khungthongtk.style.display='none';
  hientrangthaidonhang();
  khungtrangchinh.classList.add('forman');
})

document.querySelector('.QUANLYNGUOIDUNG').addEventListener("click",function(){
    khungthongtk.style.display='none';
    hienlichsumuahang();
    khungtrangchinh.classList.add('forman');
})

  document.querySelector('.QUANLYSANPHAM').addEventListener("click",function(){
    hienthongtintaikhoan();
    khungthongtk.style.display='block';
})
$(document).on('click', '.user_infor_exit', function() {
    khungthongtk.style.display='none';
});


document.querySelector('.QUANLYTRANGCHU').addEventListener("click",function(){
    // hienthongtintaikhoan();
    khungtrangchinh.classList.remove('forman');
    document.getElementById('trangchinh').innerHTML = '';
})

document.querySelector('.user_infor_exitt1').addEventListener("click",function(){
    formmain.classList.add('forman');
})



document.querySelector('.bamgiohang').addEventListener("click",function(){
    hiengiohangcho();
})
function hiengiohangcho(){
    $.ajax({
        url: "nguoidung.php",
        method: "POST",
        success: function(response) {
            var responseData = JSON.parse(response);
            var outputgiohang = responseData.outputgiohang;
            document.getElementById('giohangnguoidung').innerHTML = outputgiohang; 
        }
    });
}