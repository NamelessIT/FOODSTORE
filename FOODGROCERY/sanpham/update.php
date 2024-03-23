<?php
        $sqlall="SELECT * FROM danhmuc ";
        $queryall=mysqli_query($connect,$sqlall);

        $masp=$_GET['masp'];
        $sql="SELECT * FROM sanpham,danhmuc  WHERE sanpham.madm=danhmuc.madm and sanpham.ishidden=0 and masp='$masp'";
        $query=mysqli_query($connect,$sql);


    while($row=mysqli_fetch_assoc($query)){
        $tensp=$row['tensp'];
        $image=$row['image'];
        $dongia=$row['dongia'];
        $tendm=$row['tendm'];
        $motasp=$row['motasp'];
    }

    $sql_masp="SELECT masp FROM sanpham ";
    $query_masp=mysqli_query($connect,$sql_masp);
    $list_masp=array();
    while($row=mysqli_fetch_assoc($query_masp)){
        $list_masp[]=$row['masp'];
    }
    
    //kiểm tra xem sản phẩm có trong hóa đơn chưa , nếu rồi thì không cho update chỉ được insert
    // if(isset($_POST['sbm'])){
    //     $sqlhoadon="SELECT * FROM chitiethoadon";
    //     $queryhoadon=mysqli_query($connect,$sqlhoadon);
    //     while($row=mysqli_fetch_assoc($queryhoadon)){
    //         $masphd=$row['masp'];
    //         if($masphd==$masp){
    //             echo "Sản phẩm này đã có trong hóa đơn, không thể update";
    //         }
            
    //     }

    // }
    // $sql= "UPDATE sanpham SET ishidden=1 WHERE masp='$masp' AND ishidden=0";
    // $query=mysqli_query($connect,$sql);
    // header('location:index.php?page_layout=danhsach');
?>

<div class="container_add">
    <div class="add_products">
        <div class="header_add_products">
            <h2>Thêm sản phẩm</h2>
        </div>
        <div class="body_add_products">
            <form method="POST" enctype="multipart/form-data" id="addForm">
                <div class="form_group">
                    <label for="">Mã sản phẩm</label>
                    <input type="text" name="masp" class="form_control" value="<?php echo $masp?>" id="MASP" required>
                </div>

                <div class="form_group">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" name="tensp" class="form_control" value="<?php echo $tensp?>" required>
                    
                </div>
                <div class="form_group">
                    <label for="">Ảnh sản phẩm</label>
                    <input type="file" name="image" value="<?php echo $image?>" class="form_control">
                    
                </div>
                <div class="form_group">
                    <label for="">Gía sản phẩm</label>
                    <input type="number" name="dongia" value="<?php echo $dongia?>" class="form_control" required>
                    
                </div>
                <div class="form_group">
                    <label for="">Danh mục sản phẩm</label>
                    <select name="madm" class="form_control" >
                    <?php
                            while($row=mysqli_fetch_assoc($queryall)){?>
                                <option value="<?php echo $row['madm'];?>"><?php echo mb_strtoupper($row['tendm'], 'UTF-8');?></option>
                    <?php } ?>
                    </select>
                    
                </div>
                <div class="form_group">
                    <label for="">Chi tiết sản phẩm</label>
                    <input type="text" name="motasp" value="<?php echo $motasp?>" class="form_control">
                    
                </div>
                
                <button name="sbm" type="submit" class="btn btn_add">SỬA</button>
                <a  class="btn btn_back" href="index.php?page_layout=danhsach'">Quay về</a>

            </form>
                <script>
                    var list_masp = <?php echo json_encode($list_masp); ?>;
                    var masp=<?php echo json_decode($masp);?>;
                    const form = document.getElementById('addForm');
                    const input_masp = document.getElementById('MASP');
                    const submit = document.querySelector('.btn_add');

                    submit.addEventListener('click', function (event) {
                        var enteredMasp = input_masp.value;
                        
                        if (list_masp && checkMaspExistence(list_masp, enteredMasp,masp)) {
                            event.preventDefault();
                            console.log('Mã sản phẩm đã tồn tại');
                            // Don't submit the form if the MASP already exists
                        } else {
                            // Submit the form if the MASP is valid
                            event.submit;
                        }
                    });

                    function checkMaspExistence(list_masp, enteredMasp,masp) {
                        if(masp!==enteredMasp){
                            return list_masp.includes(enteredMasp);
                        }
                    }
                </script>
        </div>
    </div>
</div>