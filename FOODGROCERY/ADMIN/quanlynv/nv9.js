
fetch('quanlynv/nv.php')
  .then(response => response.text())
  .then(data => {
    document.getElementById('NHANVIEN').innerHTML = data;
  })

function updateNVTable() {
  // Fetch data from the server
  fetch('quanlynv/nv.php')
    .then(response => response.text())
    .then(data => {
      // Update the table HTML
      document.getElementById('NHANVIEN').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}

// Lấy tham chiếu đến input tìm kiếm và button tìm kiếm
const searchInput = document.getElementById('search-input');
// Lắng nghe sự kiện keyup trên input tìm kiếm
searchInput.addEventListener('keyup', function () {
  // Gọi hàm tìm kiếm với giá trị của input tìm kiếm
  searchData(this.value);
});
// Hàm tìm kiếm dữ liệu
function searchData(searchTerm) {
  // Gọi API hoặc thực hiện tìm kiếm dữ liệu trên phía server
  fetch('quanlynv/nv.php?search=' + encodeURIComponent(searchTerm))
    .then(response => response.text())
    .then(data => {
      // Cập nhật nội dung của div #NhanVien với kết quả tìm kiếm
      document.getElementById('NHANVIEN').innerHTML = data;
      loadbtnsua();
    });
}



// Thêm sự kiện click vào nút "Hủy"
$(document).ready(function () {
  $("#cancel-btn-nv").on("click", function (event) {
    event.preventDefault();
    document.querySelector(".overlay-nv").classList.remove('show');
    document.querySelector(".form-container-nv").classList.remove('show');
  });
});


function loadbtnsua() {
  setTimeout(() => {
    const editButtons = document.querySelectorAll('.update-button_NV');
    console.log(editButtons.length);
    const hiddenInput = document.getElementById('hidden-input-nv');
  
    editButtons.forEach((button) => {
      button.addEventListener('click', () => {
        console.log('oke');
        // Lấy dữ liệu của dòng tương ứng với nút "Sửa"
        const row = button.closest('tr');
        const employeeId = row.cells[0].textContent;
        const fullName = row.cells[2].textContent;
        const address = row.cells[3].textContent;
        const email = row.cells[4].textContent;
        const phoneNumber = row.cells[5].textContent;
  
        document.getElementById('hidden-input-nv').value = employeeId;
        document.getElementById('name-nv').value = fullName;
        document.getElementById('address-nv').value = address;
        document.getElementById('email-nv').value = email;
        document.getElementById('phone-nv').value = phoneNumber;
  
  
        // Hiển thị form với dữ liệu đã lấy
        document.querySelector(".overlay-nv").classList.add('show');
        document.querySelector(".form-container-nv").classList.add('show');
      });
    });
  }, 500);
}


setTimeout(() => {
  const editButtons = document.querySelectorAll('.update-button_NV');
  console.log(editButtons.length);
  const hiddenInput = document.getElementById('hidden-input-nv');

  editButtons.forEach((button) => {
    button.addEventListener('click', () => {
      console.log('oke');
      // Lấy dữ liệu của dòng tương ứng với nút "Sửa"
      const row = button.closest('tr');
      const employeeId = row.cells[0].textContent;
      const fullName = row.cells[2].textContent;
      const address = row.cells[3].textContent;
      const email = row.cells[4].textContent;
      const phoneNumber = row.cells[5].textContent;

      document.getElementById('hidden-input-nv').value = employeeId;
      document.getElementById('name-nv').value = fullName;
      document.getElementById('address-nv').value = address;
      document.getElementById('email-nv').value = email;
      document.getElementById('phone-nv').value = phoneNumber;


      // Hiển thị form với dữ liệu đã lấy
      document.querySelector(".overlay-nv").classList.add('show');
      document.querySelector(".form-container-nv").classList.add('show');
    });
  });
}, 1000);

//cập nhật
const submitButton = document.querySelector('.submit-btn-nv');
submitButton.addEventListener('click', (event) => {
  event.preventDefault(); // Prevent the default form submission
  updateEmployeeData();
});

function updateEmployeeData() {
    const employeeId = document.getElementById('hidden-input-nv').value;
    console.log(employeeId);
    const name = document.getElementById('name-nv').value;
    const address = document.getElementById('address-nv').value;
    const email = document.getElementById('email-nv').value;
    const phone = document.getElementById('phone-nv').value;

    if (name == '' || address == '' || email == '' || phone == '') {
      alert('Vui lòng điền thông tin');
      return;
    }

    if (!validateEmail(email)) {
      alert('email không hợp lệ');
      return;
    }

    if (!validatePhoneNumber(phone)) {
      alert('Số điện thoại không hợp lệ');
      return;
    }

    $.ajax({
      type: 'POST',
      url: 'quanlynv/updatenv.php',
      data: { employeeId: employeeId, name: name, address: address, email: email, phone: phone, action: "update" },
      dataType: 'json',
      success: function (response) {
        console.log(response);
        if (response.sua === 'success') {
          alert('Sửa thành công');
          document.querySelector(".overlay-nv").classList.remove('show');
          document.querySelector(".form-container-nv").classList.remove('show');
          console.log('oke');
          updateNVTable();
          loadbtnsua();
        } else {
          console.log('not oke');
          alert('Sửa thất bại');
        }
      },
    });
 }





// Xóa
function showDeleteModal1(manv, matk) {
  // Tạo modal
  var modal = $('<div class="modal-NV" tabindex="-1" role="dialog">' +
    '<div class="modal-dialog-NV" role="document">' +
    '<div class="modal-content-NV">' +
    '<div class="modal-header">' +
    '<h2 class="modal-title">Xóa tài khoản</h2>' +
    '</div>' +
    '<div class="modal-body">' +
    '<p style="font-size: 1.2rem;">Bạn có chắc chắn muốn xóa nhân viên này này?</p>' +
    '</div>' +
    '<div class="modal-footer">' +
    '<button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">Hủy</button>' +
    '<button type="button" class="btn btn-danger delete-confirm" data-account-id="' + manv + '">Xóa</button>' +
    '</div>' +
    '</div>' +
    '</div>' +
    '</div>');

  // Thêm modal vào DOM
  $("body").append(modal);

  // Hiển thị modal
  modal.show();

  // Lắng nghe sự kiện khi nhấn nút "Xóa"
  $(".delete-confirm").click(function () {
    var manv = $(this).data("account-id");
    deleteAccount(manv, matk);
    modal.hide();
  });

  // Lắng nghe sự kiện khi nhấn nút "Hủy"
  $(".btn-cancel").click(function () {
    modal.hide();
  });
}

function deleteAccount(manv, matk) {
  // Gửi yêu cầu AJAX lên server để xóa tài khoản
  $.ajax({
    type: "POST",
    url: "quanlynv/nv.php",
    data: { manv: manv, matk: matk, action: "delete" },
    success: function (response) {
      updateNVTable();
    },
    error: function (xhr, status, error) {
      alert("Đã xảy ra lỗi: " + error);
    }
  });
}




$(document).ready(function () {
  // Thêm sự kiện click vào phần tử cần kích hoạt
  $(".add-button-nv").on("click", function () {
    document.querySelector(".overlay-nv").classList.add('show');
    document.querySelector(".form-container-nv-add").classList.add('show');
  });
  $("#cancel-btn-nv-add").on("click", function (event) {
    event.preventDefault();
    document.querySelector(".overlay-nv").classList.remove('show');
    document.querySelector(".form-container-nv-add").classList.remove('show');
  });
});



// thêm

$(document).ready(function () {
  $('.user-form-nv-add').submit(function (event) {
    event.preventDefault();

    var name = document.getElementById("name-nv-add").value;
    var address = document.getElementById("address-nv-add").value;
    var email = document.getElementById("email-nv-add").value;
    var phone = document.getElementById("phone-nv-add").value;

    if (name === '' || address === '' || email === '' || phone === '') {
      alert('Vui lòng điền thông tin');
      return;
    }

    if (!validateEmail(email)) {
      alert('email không hợp lệ');
      return;
    }

    if (!validatePhoneNumber(phone)) {
      alert('Số điện thoại không hợp lệ');
      return;
    }

    $.ajax({
      type: 'POST',
      url: 'quanlynv/addnv.php',
      data: { name: name, address: address, email: email, phone: phone, action: "create" },
      dataType: 'json',
      success: function (response) {
        console.log(response);
        if (response.them === 'success') {
          alert('Thêm thành công');
          document.querySelector(".overlay-nv").classList.remove('show');
          document.querySelector(".form-container-nv-add").classList.remove('show');
          console.log('oke');
          updateNVTable();
          loadbtnsua();
        } else {
          console.log('not oke');
          alert('Thêm thất bại');
        }
      },
    });
  })
});

function validateEmail(email) {
  var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regex.test(email);
}

function validatePhoneNumber(phoneNumber) {
  const phoneRegex = /^0\d{9}$/;
  return phoneRegex.test(phoneNumber);
}