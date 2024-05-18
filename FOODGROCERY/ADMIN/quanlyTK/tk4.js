// Lấy dữ liệu từ file get_customer_table.php và hiển thị trong div
fetch('quanlyTK/qltk.php')
.then(response => response.text())
.then(data => {
    document.getElementById('TAIKHOAN').innerHTML = data;
})
.catch(error => console.error('Error:', error));

function updateCustomerTable() {
    // Fetch data from the server
    fetch('quanlyTK/qltk.php')
      .then(response => response.text())
      .then(data => {
        // Update the table HTML
        document.getElementById('TAIKHOAN').innerHTML = data;
      })
      .catch(error => console.error('Error:', error));
  }


  
    fetch('quanlyTK/count.php')
      .then(response => response.text())
      .then(data => {
        document.getElementById('user_count').textContent = "Số Lượng Tài Khoản: "+ data;
      })
      .catch(error => console.error('Error:', error));




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
            url: 'quanlyTK/getnv.php',
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
            url: 'quanlyTK/getrole.php',
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
                url: 'quanlyTK/createtk.php',
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

