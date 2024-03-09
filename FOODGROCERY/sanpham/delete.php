<?php
    $masp=$_GET['masp'];
    $sql= "UPDATE sanpham SET ishidden=1 WHERE masp='$masp' AND ishidden=0";
    $query=mysqli_query($connect,$sql);
    header('location:index.php?page_layout=danhsach');
?>