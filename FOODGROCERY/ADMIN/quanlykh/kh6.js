// Lấy dữ liệu từ file get_customer_table.php và hiển thị trong div
fetch('quanlykh/ql_kh.php')
.then(response => response.json())
.then(data => {
    document.getElementById('KHACHHANG').innerHTML = data.table;
})
.catch(error => console.error('Error:', error));



// Thêm hàm để hiển thị modal xác nhận khóa tài khoản
function showLockModal(accountId) {
    // Tạo modal
    var modal = $('<div class="modal-KH" tabindex="-1" role="dialog">' +
      '<div class="modal-dialog-KH" role="document">' +
      '<div class="modal-content-KH">' +
      '<div class="modal-header">' +
      '<h2 class="modal-title">Khóa tài khoản</h2>' +
      '</div>' +
      '<div class="modal-body">' +
      '<p style="font-size: 1.2rem;">Bạn có chắc chắn muốn khóa tài khoản này?</p>' +
      '</div>' +
      '<div class="modal-footer">' +
      '<button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">Hủy</button>' +
      '<button type="button" class="btn btn-primary lock-confirm" data-account-id="' + accountId + '">Khóa</button>' +
      '</div>' +
      '</div>' +
      '</div>' +
      '</div>');
  
    // Thêm modal vào DOM
    $("body").append(modal);
  
    // Hiển thị modal
    modal.show();
  
    // Lắng nghe sự kiện khi nhấn nút "Khóa"
    $(".lock-confirm").click(function() {
      var accountId = $(this).data("account-id");
      lockAccount(accountId);
      modal.hide();
    });
  
    // Lắng nghe sự kiện khi nhấn nút "Hủy"
    $(".btn-cancel").click(function() {
      modal.hide();
    });
  }
  
  function lockAccount(accountId) {
    // Gửi yêu cầu AJAX lên server để cập nhật trạng thái tài khoản
    $.ajax({
      type: "POST",
      url: "quanlykh/ql_kh.php",
      data: { account_id: accountId, status: 1 },
      success: function(response) {
        // Cập nhật trạng thái tài khoản trên giao diện
        var lockButton = $(".lock-button_KH[onclick='showLockModal(" + accountId + ")']");
        lockButton.text("Gỡ khóa");
        lockButton.css("background-color", "rgb(14, 124, 7)");
        lockButton.attr("onclick", "showUnlockModal(" + accountId + ")");
        updateCustomerTable();
      },
      error: function(xhr, status, error) {
        alert("Đã xảy ra lỗi: " + error);
      }
    });
  }
  
  // Thêm hàm để hiển thị modal xác nhận gỡ khóa tài khoản
  function showUnlockModal(accountId) {
    // Tạo modal
    var modal = $('<div class="modal-KH" tabindex="-1" role="dialog">' +
      '<div class="modal-dialog-KH" role="document">' +
      '<div class="modal-content-KH">' +
      '<div class="modal-header">' +
      '<h2 class="modal-title">Gỡ khóa tài khoản</h2>' +
      '</div>' +
      '<div class="modal-body">' +
      '<p style="font-size: 1.2rem;">Bạn có chắc chắn muốn gỡ khóa tài khoản này?</p>' +
      '</div>' +
      '<div class="modal-footer">' +
      '<button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">Hủy</button>' +
      '<button type="button" class="btn btn-primary unlock-confirm" data-account-id="' + accountId + '">Gỡ khóa</button>' +
      '</div>' +
      '</div>' +
      '</div>' +
      '</div>');
  
    // Thêm modal vào DOM
    $("body").append(modal);
  
    // Hiển thị modal
    modal.show();
  
    // Lắng nghe sự kiện khi nhấn nút "Gỡ khóa"
    $(".unlock-confirm").click(function() {
      var accountId = $(this).data("account-id");
      unlockAccount(accountId);
      modal.hide();
    });
  
    // Lắng nghe sự kiện khi nhấn nút "Hủy"
    $(".btn-cancel").click(function() {
      modal.hide();
    });
  }
  
  function unlockAccount(accountId) {
    // Gửi yêu cầu AJAX lên server để cập nhật trạng thái tài khoản
    $.ajax({
      type: "POST",
      url: "quanlykh/ql_kh.php",
      data: { account_id: accountId, status: 0 },
      success: function(response) {
        // Cập nhật trạng thái tài khoản trên giao diện
        var unlockButton = $(".lock-button_KH[onclick='showUnlockModal(" + accountId + ")']");
        unlockButton.text("Khóa");
        unlockButton.attr("onclick", "showLockModal(" + accountId + ")");
        updateCustomerTable();
      },
      error: function(xhr, status, error) {
        alert("Đã xảy ra lỗi: " + error);
      }
    });
  }

  function updateCustomerTable() {
    // Fetch data from the server
    fetch('quanlykh/ql_kh.php')
      .then(response => response.json())
      .then(data => {
        // Update the table HTML
        document.getElementById('KHACHHANG').innerHTML = data.table;
      })
      .catch(error => console.error('Error:', error));
  }


  function showDeleteModal(makh,matk) {
    // Tạo modal
    var modal = $('<div class="modal-KH" tabindex="-1" role="dialog">' +
      '<div class="modal-dialog-KH" role="document">' +
      '<div class="modal-content-KH">' +
      '<div class="modal-header">' +
      '<h2 class="modal-title">Xóa tài khoản</h2>' +
      '</div>' +
      '<div class="modal-body">' +
      '<p style="font-size: 1.2rem;">Bạn có chắc chắn muốn xóa khách hàng này?</p>' +
      '</div>' +
      '<div class="modal-footer">' +
      '<button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">Hủy</button>' +
      '<button type="button" class="btn btn-danger delete-confirm" data-account-id="' + makh + '">Xóa</button>' +
      '</div>' +
      '</div>' +
      '</div>' +
      '</div>');
  
    // Thêm modal vào DOM
    $("body").append(modal);
  
    // Hiển thị modal
    modal.show();
  
    // Lắng nghe sự kiện khi nhấn nút "Xóa"
    $(".delete-confirm").click(function() {
      var makh = $(this).data("account-id");
      deleteKH(makh , matk);
      modal.hide();
    });
  
    // Lắng nghe sự kiện khi nhấn nút "Hủy"
    $(".btn-cancel").click(function() {
      modal.hide();
    });
  }
  
  function deleteKH(makh , matk) {
    // Gửi yêu cầu AJAX lên server để xóa tài khoản
    $.ajax({
      type: "POST",
      url: "quanlykh/ql_kh.php",
      data: { makh: makh, matk: matk, action: "delete" },
      success: function(response) {
        // // Cập nhật giao diện, ví dụ xóa dòng tương ứng trong bảng
        // $(".customer-row[data-account-id='" + accountId + "']").remove();
        updateCustomerTable()
      },
      error: function(xhr, status, error) {
        alert("Đã xảy ra lỗi: " + error);
      }
    });
  }


  document.getElementById('Find_KHACHHANG').addEventListener('keyup', (event) => {
  if (event.key === 'Enter') {
    const searchTerm = document.getElementById('Find_KHACHHANG').value.toLowerCase();

    $.ajax({
      url: 'quanlykh/ql_kh.php',
      type: 'POST',
      data: {
        q: searchTerm,
      },
      success: function(response) {
        try {
          const data = JSON.parse(response);
          document.getElementById("KHACHHANG").innerHTML = data.tabletim;
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
