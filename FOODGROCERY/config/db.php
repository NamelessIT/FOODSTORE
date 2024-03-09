<?php
// try {
    //code...
    $connect=mysqli_connect('localhost','root','','foodgrocery');
// } catch (\Throwable $th) {
    //throw $th;
    // echo "ket noi database that bai";
// }
    if($connect){
        echo 'kết nối thành công';
    }
?>