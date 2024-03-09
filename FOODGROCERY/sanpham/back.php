<?php
    $masp=$_GET['masp'];
    $sql= "UPDATE sanpham SET ishidden=0 WHERE masp='$masp' AND ishidden=1";
    $query=mysqli_query($connect,$sql);
    header('location:index.php?page_layout=danhsach');
?>