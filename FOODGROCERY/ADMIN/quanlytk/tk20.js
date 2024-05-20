// Lấy dữ liệu từ file get_customer_table.php và hiển thị trong div
fetch('quanlytk/qltk.php')
  .then(response => response.json())
  .then(data => {
    document.getElementById('TAIKHOAN').innerHTML = data.nv;
    document.getElementById('TAIKHOAN2').innerHTML = data.kh;
  })
  .catch(error => {
    console.error('Error:', error);
    // Thêm xử lý lỗi ở đây
  });

function updateTKTable() {
    // Fetch data from the server
    fetch('quanlytk/qltk.php')
      .then(response => response.json())
      .then(data => {
        // Update the table HTML
        document.getElementById('TAIKHOAN').innerHTML = data.nv;
        document.getElementById('TAIKHOAN2').innerHTML = data.kh;
      })
      .catch(error => console.error('Error:', error));
}


  
    fetch('quanlytk/count.php')
      .then(response => response.json())
      .then(data => {
        document.getElementById('nv_count').textContent = "Số lượng tài khoản Nhân viên: "+ data.nv;
        document.getElementById('kh_count').textContent = "Số lượng tài khoản Khách hàng: "+ data.kh;
      })
      .catch(error => {
        console.error('Error:', error);
        // Thêm xử lý lỗi ở đây
      });




      $(document).ready(function() {
        // Hiển thị form khi nhấn nút "Thêm mới"
        $('#showFormtk').click(function() {
            document.querySelector('.form-Container-tk').classList.add('active');
            document.getElementById('overlay_form_them').style.display="block";
        });

        $('#close-btn').click(function() {
            document.querySelector('.form-Container-tk').classList.remove('active');
            document.getElementById('overlay_form_them').style.display="none";
        });
    
        // Lấy danh sách nhân viên chưa có account
        $.ajax({
            url: 'quanlytk/getnv.php',
            type: 'GET',
            success: function(data) {
                var employees = JSON.parse(data);
                var employeeSelect = $('#employeenv');
                employeeSelect.empty();
                employeeSelect.append('<option value="" style="text-align: center;">Chọn nhân viên</option>');
                $.each(employees, function(index, employee) {
                    employeeSelect.append('<option value="' + employee.manv + '">' + employee.manv + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy danh sách nhân viên:', error);
            }
        });
    
        // Lấy danh sách các quyền
        $.ajax({
            url: 'quanlytk/getrole.php',
            type: 'GET',
            success: function(data) {
                var roles = JSON.parse(data);
                var roleSelect = $('#rolenv');
                roleSelect.empty();
                roleSelect.append('<option value="" style="text-align: center;">Chọn quyền</option>');
                $.each(roles, function(index, role) {
                    roleSelect.append('<option value="' + role.role_name + '">' + role.role_name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy danh sách quyền:', error);
            }
        });
    
        // Xử lý form khi nhấn nút "Tạo"
        $('#createAccountForm').submit(function(event) {
            event.preventDefault();
            var employeeId = $('#employeenv').val();
            var username = $('#usernamenv').val();
            var password = $('#passwordnv').val();
            var role = $('#rolenv').val();
    
            $.ajax({
                url: 'quanlytk/createtk.php',
                type: 'POST',
                data: {
                    employeeId: employeeId,
                    username: username,
                    password: password,
                    role: role
                },
                success: function(response) {
                    alert('Tạo account thành công!');
                    document.querySelector('.form-Container-tk').classList.remove('active');
                    document.getElementById('overlay_form_them').style.display="none";
                },
                error: function(xhr, status, error) {
                    alert('Lỗi khi tạo account: ' + error);
                }
            });
        });
    });      



function showDeleteModalTK(username) {
    // Tạo modal
    var modal = $('<div class="modal-TK" tabindex="-1" role="dialog">' +
      '<div class="modal-dialog-TK" role="document">' +
      '<div class="modal-content-TK">' +
      '<div class="modal-header">' +
      '<h2 class="modal-title">Xóa tài khoản</h2>' +
      '</div>' +
      '<div class="modal-body">' +
      '<p style="font-size: 1.2rem;">Bạn có chắc chắn muốn xóa tài khoản này?</p>' +
      '</div>' +
      '<div class="modal-footer">' +
      '<button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">Hủy</button>' +
      '<button type="button" class="btn btn-danger delete-confirmtk" data-account-id="' + username + '">Xóa</button>' +
      '</div>' +
      '</div>' +
      '</div>' +
      '</div>');
  
    // Thêm modal vào DOM
    $("body").append(modal);
  
    // Hiển thị modal
    modal.show();
  
    // Lắng nghe sự kiện khi nhấn nút "Xóa"
    $(".delete-confirmtk").click(function() {
      var makh = $(this).data("account-id");
      deleteAccount(username);
      modal.hide();
    });
  
    // Lắng nghe sự kiện khi nhấn nút "Hủy"
    $(".btn-cancel").click(function() {
      modal.hide();
    });
  }

  function deleteAccount(username) {
    // Gửi yêu cầu AJAX lên server để xóa tài khoản
    $.ajax({
      type: "POST",
      url: "quanlytk/actiontk.php",
      data: { username: username, action: "delete" },
      success: function(data) {
        var response = JSON.parse(data);
        var delete2 = response.delete;
        if (delete2 === 'success') {
          console.log('Xóa thành công');
          updateTKTable();
        }
      },
      error: function(xhr, status, error) {
        alert("Đã xảy ra lỗi: " + error);
      }
    });
  }


  function showRecoverModalTK(username) {
    // Tạo modal
    var modal = $('<div class="modal-TK" tabindex="-1" role="dialog">' +
      '<div class="modal-dialog-TK" role="document">' +
      '<div class="modal-content-TK">' +
      '<div class="modal-header">' +
      '<h2 class="modal-title">Khôi phục tài khoản</h2>' +
      '</div>' +
      '<div class="modal-body">' +
      '<p style="font-size: 1.2rem;">Bạn có chắc chắn muốn xóa tài khoản này?</p>' +
      '</div>' +
      '<div class="modal-footer">' +
      '<button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">Hủy</button>' +
      '<button type="button" class="btn btn-danger recover-confirmtk" data-account-id="' + username + '">Khôi phục</button>' +
      '</div>' +
      '</div>' +
      '</div>' +
      '</div>');
  
    // Thêm modal vào DOM
    $("body").append(modal);
  
    // Hiển thị modal
    modal.show();
  
    // Lắng nghe sự kiện khi nhấn nút "Xóa"
    $(".recover-confirmtk").click(function() {
      var makh = $(this).data("account-id");
      recoverAccount(username);
      modal.hide();
    });
  
    // Lắng nghe sự kiện khi nhấn nút "Hủy"
    $(".btn-cancel").click(function() {
      modal.hide();
    });
  }

  function recoverAccount(username) {
    // Gửi yêu cầu AJAX lên server để xóa tài khoản
    $.ajax({
      type: "POST",
      url: "quanlytk/actiontk.php",
      data: { username: username, action: "recover" },
      success: function(data) {
        var response = JSON.parse(data);
        var recover2 = response.recover;
        if (recover2 === 'success') {
          console.log('Khôi phục thành công');
          updateTKTable();
        }
      },
      error: function(xhr, status, error) {
        alert("Đã xảy ra lỗi: " + error);
      }
    });
  }



  var originalPassword = '';
  var originalRole = '';

  $('#close-btn-sua').click(function() {
    document.querySelector('.form-Container-tk-sua').classList.remove('active');
    document.getElementById('overlay_form_sua').style.display="none";
  });

  setTimeout(() => {
    // 1. Lấy tham chiếu đến các nút "Sửa" trong bảng
  const editBtns = document.querySelectorAll('.update-button_TK');
  // 2. Gán sự kiện click cho các nút "Sửa"
  editBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    // 3. Lấy dữ liệu từ bảng tương ứng với dòng chứa nút "Sửa" đó
    const row = btn.closest('tr');
    const username = row.cells[0].textContent;
    const password = row.cells[1].textContent;
    const vaitro = row.cells[3].textContent;

    originalPassword = password;
    originalRole = vaitro;

    // 4. Điền dữ liệu vào các trường tương ứng trong form
    document.getElementById('usernamenv-sua').value = username;
    document.getElementById('passwordnv-sua').value = password;
    document.getElementById('rolenv-sua').value = vaitro;

    document.querySelector('.form-Container-tk-sua').classList.add('active');
    document.getElementById('overlay_form_sua').style.display="block";
  });
});
}, 1000); // Thêm 1 giây delay

function loadbtnSua() {
  $('#close-btn-sua').click(function() {
    document.querySelector('.form-Container-tk-sua').classList.remove('active');
    document.getElementById('overlay_form_sua').style.display="none";
  });

  setTimeout(() => {
    // 1. Lấy tham chiếu đến các nút "Sửa" trong bảng
  const editBtns = document.querySelectorAll('.update-button_TK');
  // 2. Gán sự kiện click cho các nút "Sửa"
  editBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    // 3. Lấy dữ liệu từ bảng tương ứng với dòng chứa nút "Sửa" đó
    const row = btn.closest('tr');
    const username = row.cells[0].textContent;
    const password = row.cells[1].textContent;
    const vaitro = row.cells[3].textContent;

    originalPassword = password;
    originalRole = vaitro;

    // 4. Điền dữ liệu vào các trường tương ứng trong form
    document.getElementById('usernamenv-sua').value = username;
    document.getElementById('passwordnv-sua').value = password;
    document.getElementById('rolenv-sua').value = vaitro;

    document.querySelector('.form-Container-tk-sua').classList.add('active');
    document.getElementById('overlay_form_sua').style.display="block";
  });
});
}, 1000); // Thêm 1 giây delay
}

$(document).ready(function() {
  $.ajax({
    url: 'quanlytk/getrole.php',
    type: 'GET',
    success: function(data) {
        var roles = JSON.parse(data);
        var roleSelect = $('#rolenv-sua');
        roleSelect.empty();
        roleSelect.append('<option value="" style="text-align: center;">Chọn quyền</option>');
        $.each(roles, function(index, role) {
            roleSelect.append('<option value="' + role.role_name + '">' + role.role_name + '</option>');
        });
    },
    error: function(xhr, status, error) {
        console.error('Lỗi khi lấy danh sách quyền:', error);
    }
});
});    



// Lắng nghe sự kiện submit
$('#updateAccountForm').on('submit', function(event) {
  event.preventDefault(); // Ngăn chặn form submit
  const usernameInput = $('#usernamenv-sua');
  const passwordInput = $('#passwordnv-sua');
  const roleSelect = $('#rolenv-sua');

  // Kiểm tra sự thay đổi
  const isChanged = (
    passwordInput.val() !== originalPassword ||
    roleSelect.val() !== originalRole
  );

  if (isChanged) {
    // Cập nhật thông tin
    updateAccount(
      usernameInput.val(),
      passwordInput.val(),
      roleSelect.val()
    );
  } else {
    alert('Không có gì thay đổi');
  }
});

// Gọi AJAX để cập nhật thông tin
function updateAccount(username,password, role) {
  $.ajax({
    url: 'quanlytk/actiontk.php',
    type: 'POST',
    data: {
      username: username,
      password: password,
      role: role,
      action: "update",
    },
    success: function(data) {
      console.log(data);
      var response = JSON.parse(data);
      var update = response.update;
      if (update === 'success') {
        document.querySelector('.form-Container-tk-sua').classList.remove('active');
        document.getElementById('overlay_form_sua').style.display="none";
        updateTKTable();
        loadbtnSua();
        console.log('Cập nhật thành công');
      } else {
        console.log('Cập nhật thất bại');
      }
    },
    error: function(xhr, status, error) {
      alert('Lỗi khi cập nhật: ' + error);
    }
  });
}


document.getElementById('Find_NGUOIDUNG').addEventListener('keyup', (event) => {
  if (event.key === 'Enter') {
    const searchTerm = document.getElementById('Find_NGUOIDUNG').value.toLowerCase();

    $.ajax({
      url: 'quanlytk/qltk.php',
      type: 'POST',
      data: {
        q: searchTerm,
      },
      success: function(response) {
        try {
          const data = JSON.parse(response);
          document.getElementById("TAIKHOAN").innerHTML = data.tabletknv;
          document.getElementById("TAIKHOAN2").innerHTML = data.tabletkkh;
        } catch (e) {
          console.error('Error parsing response:', e);
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error making AJAX request:', textStatus, errorThrown);
      }
    });
  }
});