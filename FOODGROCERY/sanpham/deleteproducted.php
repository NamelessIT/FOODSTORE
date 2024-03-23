<?php
    $masp=$_GET['masp'];
    $sql= "DELETE FROM sanpham  WHERE masp='$masp'";
    $query=mysqli_query($connect,$sql);
    header('location:index.php?page_layout=danhsach');
?>