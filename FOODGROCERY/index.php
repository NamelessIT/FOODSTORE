<?php
    require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOOD GROCERY</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <?php
    if(isset($_GET['page_layout'])){
        switch($_GET['page_layout']){
            case 'danhsach':
                require_once 'sanpham/products.php';
                break;
            case 'add':
                require_once 'sanpham/add.php';
                break;
            case 'update':
                require_once 'sanpham/update.php';
                break;
            case 'delete':
                require_once 'sanpham/delete.php';
                break;
            case 'back':
                require_once 'sanpham/back.php';
                break;
            case 'deleted':
                require_once 'sanpham/deleteproducted.php';
                break;
            case 'thongke':
                require_once 'hoadon,nhap,xuat/thongke.php';
                break;    
            default:
                require_once 'sanpham/products.php';
        }
    }
    else{
        require_once 'sanpham/products.php';

    }
    ?>
</body>
</html>