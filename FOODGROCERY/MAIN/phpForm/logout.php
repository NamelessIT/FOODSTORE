<?php
session_start();

if(isset($_SESSION['mySession'])){
    unset($_SESSION['mySession']);
}

setcookie('mySession', '', time() - 3600, '/');

// Xóa phiên
if(session_destroy()){
    echo 'success';
} else {
    echo 'error';
}

setcookie("username", "", time() - 3600,'/'); // Xóa cookie "username"

// // Xóa cookie phiên sau 1 giờ
// if(isset($_COOKIE[session_name()])) {
//     setcookie(session_name(), '', time() + 3600, '/');
// }

?>