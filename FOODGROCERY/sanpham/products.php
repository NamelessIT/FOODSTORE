<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    
</body>
</html>


<?php
    $sql="SELECT * FROM sanpham,danhmuc  WHERE sanpham.madm=danhmuc.madm and sanpham.ishidden=0";
    $query=mysqli_query($connect,$sql);

    $sql_masp="SELECT masp FROM chitiethoadon ";
    $query_masp=mysqli_query($connect,$sql_masp);
    $list_masp=array();
    while($row=mysqli_fetch_assoc($query_masp)){
        $list_masp[]=$row['masp'];
    }

?>
<div class="container_products">
    <div class="products">
        <div class="products_header">
            <h2>Danh sách sản phẩm</h2>
        </div>
        <div class="products_body">
            <table class="table">
                <thead class="thead_dark">
                    <tr>
                        <th>
                            STT
                        </th>
                        <th>
                            Mã sản phẩm
                        </th>
                        <th>
                            Tên sản phẩm
                        </th>
                        <th>
                            Ảnh
                        </th>
                        <th>
                            Gía bán
                        </th>
                        <th>
                            Loại
                        </th>
                        <th>
                            Chi tiết
                        </th>
                        <th>
                            Sửa
                        </th>
                        <th>
                            Xóa
                        </th>
                    </tr>
                </thead>
                <tbody>     
                    <?php
                    $i=0;
                    while($row=mysqli_fetch_assoc($query)){?>
                        <tr>
                            <td>
                                <?php echo $i++;?>
                            </td>
                            <td class="seperate Masp">
                                <?php echo $row['masp'];?>
                            </td>
                            <td class="seperate">
                                <?php echo $row['tensp'];?>
                            </td >
                            <td class="image_product seperate">
                                <img src="image/<?php echo $row['image'];?>" alt="Error">  
                            </td>
                            <td class="seperate">
                                <?php echo $row['dongia'];?>
                            </td>
                            <td class="seperate">
                                <?php echo $row['tendm'];?>
                            </td>
                            <td class="seperate">
                                <?php echo $row['motasp'];?>
                            </td>
                            <td class="Update">
                                <div>Sửa</div>
                            </td>
                            <script>
                                var updatebtn=document.querySelectorAll('.Update');
                                var list_masp = <?php echo json_encode($list_masp); ?>;
                                updatebtn.forEach(element => {
                                    element.addEventListener('click',function(){
                                    var enteredMasp=element.closest('tr').querySelector('.Masp').textContent.trim();
                                    if (list_masp && checkMaspExistence(list_masp, enteredMasp)) {
                                            alert('sản phẩm này đã tồn tại trong hóa đơn');
                                        } else {
                                            window.location.href = "index.php?page_layout=update&masp="+enteredMasp;

                                        }
                                })
                                });

                                function checkMaspExistence(list_masp, enteredMasp) {
                                        return list_masp.includes(enteredMasp);
                                    }
                            </script>
                            <td class="Delete">
                            <a href="index.php?page_layout=delete&masp=<?php echo $row['masp'];?>">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>                 
                </tbody>
            </table>
            <a class="btn add_product" href="index.php?page_layout=add" >Thêm sản phẩm</a>
        </div>
    </div>
</div>
<div style="margin: 25px ;"></div>
<!-- nếu không phải là user thì cho phép xem -->
<a class="btn add_product" href="index.php?page_layout=thongke" >Giao diện hóa đơn</a>
<?php require_once 'sanpham/productshidden.php';?>