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
    $sql="SELECT * FROM sanpham,danhmuc  WHERE sanpham.madm=danhmuc.madm and sanpham.ishidden=1";
    $query=mysqli_query($connect,$sql);
?>
<div class="container_products">
    <div class="products">
        <div class="products_header">
            <h2>Danh sách sản phẩm đã xóa</h2>
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
                            Khôi phục
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
                            <td class="seperate">
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
                            <td class="back">
                            <a href="index.php?page_layout=back&masp=<?php echo $row['masp'];?>">Khôi phục</a>
                            </td>
                        </tr>
                    <?php } ?>                 
                </tbody>
            </table>
        </div>
    </div>
</div>