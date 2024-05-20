// var danhmucheader=document.querySelector('.danhmuc')
//  danhmucheader.addEventListener("click",function(){
//         header("Location: ../php/Form.php");
//         exit(); // Dòng này quan trọng để ngăn không cho code tiếp tục chạy
//  })

$(document).ready(function() {
  const toggleMenu = document.getElementById('toggle-menu');
  const menuOptions = document.getElementById('menu');

  toggleMenu.addEventListener('click', () => {
    menuOptions.style.display = "block";
  });

  // Thêm sự kiện click ở document
  $(document).click(function(event) {
    // Kiểm tra xem người dùng có nhấp chuột bên ngoài menu hay không
    if(!$(event.target).closest('#toggle-menu, #menu').length) {
      // Nếu có, ẩn menu
      menuOptions.style.display = "none";
    }
  });
});


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
  // btnimg1.addEventListener("click", button1)
  // btnimg2.addEventListener("click", button2)
  // btnimg3.addEventListener("click", button3)
  // btnimg4.addEventListener("click", button4)
  
  const thantrang=document.querySelector('main')
  
  document.addEventListener("DOMContentLoaded", function() {
    const menuItems = document.querySelectorAll("#menuList li");
    menuItems.forEach(function(item) {
        item.addEventListener("click", function(event) {
            event.preventDefault();
            const menuItemText = item.textContent.trim().toUpperCase();
            switch (menuItemText) {
                case "MENU":
                    thantrang.innerHTML = "";
                    break;
                case "DEAL":
                    console.log("Bạn đã chọn DEAL");
                    showDeals();
                    break;
                case "PROMOTION":
                    console.log("Bạn đã chọn PROMOTION");
                    showPromotions();
                    break;
                case "STORE":
                    console.log("Bạn đã chọn STORE");
                    showStoreInfo();
                    break;
                default:
                    console.log("Lựa chọn không hợp lệ");
                    break;
            }
        });
    });
  });
  
//   var clickuse=document.getElementById("user")
// var khungdangnhap=document.getElementById("wrapper")
// var khungdangky=document.getElementById("wrapper1")
// var nutdangn=document.getElementById("nutdn")
// var nutdangk=document.getElementById("nutdk")
// var menutrai=document.getElementById("left_menu")
// var khungmenutrai=document.getElementById("nav1");
// var nutdongmenutrai=document.querySelector('.dongmenu')
// var khungquanlynguoidung=document.querySelector('.quanlyngdung')
// var khungsanpham=document.getElementById("item_manager_click");
// var khunSanPham=document.querySelector('.sanpham')
// khunSanPham.style.display="none";


// khungsanpham.addEventListener("click",function(){
//     khunSanPham.style.display="block";
//     thantrang.style.display="none";
//     khungquanlynguoidung.style.display="none";
// })
// menutrai.addEventListener("click",function(){
//     khungmenutrai.style.display="block";
// })
// nutdangn.addEventListener("click",function(){
//     khungdangnhap.style.display="flex";
// })
// nutdangk.addEventListener("click",function(){
//     khungdangky.style.display="flex";
// })

// var quanlnguoidung=document.getElementById("qlnd")
// quanlnguoidung.addEventListener("click",function(){
//     thantrang.style.display="none";
//     khungquanlynguoidung.style.display="block";
// })
// var trovetrangchu=document.getElementById("qltc")
// trovetrangchu.addEventListener("click",function(){
//   thantrang.style.display="block";
//   khungquanlynguoidung.style.display="none";
//   khunSanPham.style.display="none";

// })


// nutdongmenutrai.addEventListener("click",function(){
//     khungmenutrai.style.display="none";

// })

// var khungcart= document.querySelector('.cart');
// var mocart=document.getElementById("cart")
// mocart.addEventListener("click",function(){
//     khungcart.style.right="0";
// })



// khungbill=document.querySelector('.hoadon');
// var mobill=getElementById("billstatusonclick");
// mobill.addEventListener("click",function(){
//     thantrang.style.display="none";
//     khungquanlynguoidung.style.display="none";
//     khunSanPham.style.display="none";
//     khungbill.style.display="block";

// })
// -----------------------
const btn=document.querySelectorAll('.muahang')
// console.log(btn);
btn.forEach(function(button,index){
button.addEventListener("click",function(event){{ 
    var btnItem=event.target
    var product=btnItem.parentElement.parentElement
    var productImg = product.querySelector('.item_img img').src
    var productName=product.querySelector('.item_name ').innerText
    var productPrice= product.querySelector('.item_price').innerText
    addcart(productPrice,productImg,productName)
    // console.log(productImg)
    // console.log(productName)
    // console.log(productPrice)

}})
})

var cartItem
var soluongsanphammua=0;
// -------------themvaogiohang--------------------
var addtr=document.createElement("tr")
function addcart(productPrice,productImg,productName){
    soluongsanphammua++;
    var addtr=document.createElement("tr")
      cartItem=document.querySelectorAll('.cart form tbody tr')
     for(var i=0;i<cartItem.length;i++){
        var productT=document.querySelectorAll('.title')
        if(productT[i].innerHTML==productName){
            alert("Sản phẩm đã có trong giỏ hàng")
            return;
        }
     }
     var trconten='<input style="display: none;" name="muabnsp" value="'+soluongsanphammua+'"></input><tr><td style="display: flex;align-items: center;"><img style="width: 70px" src="'+productImg+'" alt="Photo"><input name="layten" value="'+productName+'"  style="display:none;"></input><span class="title">'+productName+'</span></td><td><p><span class="prices">'+productPrice+'</span><sup>đ</sup></p><input  name="giatienn" value="'+productPrice+'"  style="display:none;"></input></td><td><input class="solsp" name="quantityproduc" type="number" value="1" min="1"></td><input style="display:none;" class="solsp1" type="number"  value="1" min="1"><td style="cursor: pointer;"><span class="cart-delete">Xóa</span></td></tr>'
     addtr.innerHTML=trconten
    var cartTable=document.querySelector('.cart tbody')
    cartTable.append(addtr)

    cartotal()
    deletecart()
}

// ---------------------------------------------------------

// --------------tongtien---------------------------------------
function cartotal(){
     cartItem=document.querySelectorAll('.cart form tbody tr')
    var totalC=0
    var totalA=0
    var totalD=0
    // var todalD1=0
    for(var i=0;i<cartItem.length;i++){
        var inputValue=cartItem[i].querySelector('.cart tbody tr .solsp').value 
        cartItem[i].querySelector('.cart tbody tr .solsp1').value=inputValue
        var productPrice= cartItem[i].querySelector('.prices').innerHTML
        totalA=inputValue*productPrice*1
        totalC=totalC + totalA
        totalD=totalC.toLocaleString('de-DE')
    }
    var cartTotalA=document.querySelector(".price-total span")
    var cartTotalB=document.querySelector(".price-total input")
    cartTotalB.value=totalD
    cartTotalA.innerHTML=totalD
    inputchange()
}
// --------------------------------------------------------------------


// --------------xoagiohang-----------------------------------------------
function deletecart(){
    for(var i=0;i<cartItem.length;i++){
        var productT=document.querySelectorAll('.cart-delete')
        productT[i].addEventListener("click",function(event){
            var cartDelete=event.target
            var cartitemR=cartDelete.parentElement.parentElement
            cartitemR.remove()
            cartotal()
        })
     }
}


// --------------thaydoisanpham
function inputchange(){
    cartItem=document.querySelectorAll('.cart form tbody tr')
    for(var i=0;i<cartItem.length;i++){
        var inputValue=cartItem[i].querySelector('.cart tbody tr td .solsp')
        // productT[i].addEventListener("click",function(event){
        //     var cartDelete=event.target
        //     var cartitemR=cartDelete.parentElement.parentElement
        //     cartitemR.remove()
        //     cartotal()
        // })

        inputValue.addEventListener("change",function(){
            cartotal()
        })
     }


}





// ----------------------------------------


//  var danhmucheader=document.querySelector('.danhmuc')
//  danhmucheader.addEventListener("click",function(){
        
//  })


//  var sidebarItems = document.querySelectorAll('.sidebar li');
//  var thongtintaikhoan=document.getElementById('thongttk')
//  thongtintaikhoan.classList.add('hidden')

// sidebarItems.forEach(function(item) {
//     item.addEventListener('click', function() {
//         var currentItem = this;
//         var currentOrder = parseInt(currentItem.style.order);

//         // Xóa lớp 'active' khỏi tất cả các li
//         sidebarItems.forEach(function(item) {
//             item.classList.remove('active');
//         });

//         // Thêm lớp 'active' vào li được click
//         currentItem.classList.add('active');

//         // Thêm hiệu ứng trượt vào div content
//         var contentDiv = document.querySelector('.content');

//         // Kiểm tra xem liệu mục được bấm có thứ tự thấp hơn mục hiện tại đang có background màu đen hay không
//         var currentActiveItem = document.querySelector('.sidebar li.active');
//         if (currentActiveItem && parseInt(currentActiveItem.style.order) > currentOrder) {
//             contentDiv.classList.remove('sliding-effect');
//             contentDiv.classList.add('sliding-effect', 'slide-up');
//         } else {
//             contentDiv.classList.remove('sliding-effect', 'slide-up');
//             void contentDiv.offsetWidth; // Kích hoạt reflow
//             contentDiv.classList.add('sliding-effect');
//         }
//     });
// });
// var Quanlysanpham=document.getElementById('QUANLYSANPHAM');
// var Quanlydonhang=document.getElementById('QUANLYDONHANG');
// var Quanlynguoidung=document.getElementById('QUANLYNGUOIDUNG');
// var Thongkedonhang=document.getElementById('THONGKEDONHANG');
// var Phieunhap=document.getElementById('QUANLYPHIEUNHAP');
// var thantrangg=document.querySelector('main')
// var moicondahmuc=document.getElementById('sidebarr')
// moicondahmuc.classList.add('hidden')
// var trangthaidonhang=document.getElementById("ttdh")
// trangthaidonhang.classList.add('hidden')
// var icondanhmuc=document.getElementById('iddanhmuc')
// icondanhmuc.addEventListener('click',function(){
//     moicondahmuc.classList.remove('hidden')
// })
// // Quanlysanpham.classList.remove('invisible');
// // Quanlydonhang.classList.remove('invisible');
// sidebarItems[0].addEventListener('click',function(){
//     // Quanlysanpham.classList.remove('invisible');
//     // Quanlydonhang.classList.add('invisible');
//     // Quanlynguoidung.classList.add('invisible');
//     // Thongkedonhang.classList.add('invisible');
//     // Phieunhap.classList.add('invisible');
//     // thantrangg.classList.add('hidden')
//     thongtintaikhoan.classList.remove('hidden')
// })
// sidebarItems[1].addEventListener('click',function(){
//     // Quanlysanpham.classList.add('invisible');
//     // Quanlydonhang.classList.remove('invisible');
//     // Quanlynguoidung.classList.add('invisible');
//     // Thongkedonhang.classList.add('invisible');
//     // Phieunhap.classList.add('invisible');
//     thongtintaikhoan.classList.add('hidden')
//     trangthaidonhang.classList.remove('hidden')
//     thantrangg.classList.add('hidden')

// })
// sidebarItems[2].addEventListener('click',function(){
//     // Quanlysanpham.classList.add('invisible');
//     // Quanlydonhang.classList.add('invisible');
//     // Quanlynguoidung.classList.remove('invisible');
//     // Thongkedonhang.classList.add('invisible');
//     // Phieunhap.classList.add('invisible');
// })
// sidebarItems[3].addEventListener('click',function(){
//     // Quanlysanpham.classList.add('invisible');
//     // Quanlydonhang.classList.add('invisible');
//     // Quanlynguoidung.classList.add('invisible');
//     // Thongkedonhang.classList.remove('invisible');
//     // Phieunhap.classList.add('invisible');
// })
// sidebarItems[4].addEventListener('click',function(){
//     // Quanlysanpham.classList.add('invisible');
//     // Quanlydonhang.classList.add('invisible');
//     // Quanlynguoidung.classList.add('invisible');
//     // Thongkedonhang.classList.add('invisible');
//     // Phieunhap.classList.remove('invisible');
//     moicondahmuc.classList.add('hidden')

// })

// // sidebarItems[5].addEventListener('click',function(){
// //     // window.location.href = 'http://localhost:3000/FOODGROCERY/index.php?page_layout=danhsach';
// //     alert('chưa có đường dẫn về trang chủ');
// //   })


// // ---------------------Trang thai don hang --------------------




// var nxctt=document.querySelector('.nutxemchitiet');
// var khungxemchitiet=document.querySelector('.xemchitiethoadoncuakhach')
// khungxemchitiet.style.display='none';

// nxctt.addEventListener("click",function(){
//     khungxemchitiet.style.display='flex';
// })