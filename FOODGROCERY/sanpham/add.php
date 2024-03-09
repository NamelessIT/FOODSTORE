<?php
    $sql="SELECT * FROM danhmuc ";
    $query=mysqli_query($connect,$sql);

    $sql_masp="SELECT masp FROM sanpham ";
    $query_masp=mysqli_query($connect,$sql_masp);
    $list_masp=array();
    while($row=mysqli_fetch_assoc($query_masp)){
        $list_masp[]=$row['masp'];
    }

    if(isset($_POST['sbm'])){
        $masp=$_POST['masp'];
        $tensp=$_POST['tensp'];

        $image=$_FILES['image']['name'];
        $image_tmp=$_FILES['image']['tmp_name'];

        $dongia=$_POST['dongia'];
        $madm=$_POST['madm'];
        $motasp=$_POST['motasp'];
        $ishidden=0;

        // $check_maspsql="SELECT * FROM sanpham WHERE masp='$masp'";
        // $check_maspquery=mysqli_query($connect,$check_maspsql);
        // if(mysqli_num_rows($check_maspquery)>0){
        //     echo  'Mã sản phẩm đã tồn tại';
        //     header('location:index.php?page_layout=them');
        // }
        // else{
            $sql="INSERT INTO sanpham (masp,tensp,image,dongia,madm,motasp,ishidden)
            VALUES ( '$masp','$tensp','$image','$dongia','$madm','$motasp','$ishidden')";
            $query=mysqli_query($connect,$sql);
            move_uploaded_file($image_tmp,'image/'.$image);
            header('location:index.php?page_layout=danhsach');
        // }


    }
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
                    <input type="text" name="masp" class="form_control" id="MASP" required>
                </div>

                <div class="form_group">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" name="tensp" class="form_control" required>
                    
                </div>
                <div class="form_group">
                    <label for="">Ảnh sản phẩm</label>
                    <input type="file" name="image" class="form_control">
                    
                </div>
                <div class="form_group">
                    <label for="">Gía sản phẩm</label>
                    <input type="number" name="dongia" class="form_control" required>
                    
                </div>
                <div class="form_group">
                    <label for="">Danh mục sản phẩm</label>
                    <select name="madm" class="form_control">
                        <?php
                            while($row=mysqli_fetch_assoc($query)){?>
                                <option value="<?php echo $row['madm'];?>"><?php echo mb_strtoupper($row['tendm'], 'UTF-8');?></option>
                        <?php } ?>
                    </select>
                    
                </div>
                <div class="form_group">
                    <label for="">Chi tiết sản phẩm</label>
                    <input type="text" name="motasp" class="form_control">
                    
                </div>
                
                <button name="sbm" type="submit" class="btn btn_add">Thêm</button>
            </form>
                <script>
                    var list_masp = <?php echo json_encode($list_masp); ?>;

                    const form = document.getElementById('addForm');
                    const input_masp = document.getElementById('MASP');
                    const submit = document.querySelector('.btn_add');

                    submit.addEventListener('click', function (event) {
                        var enteredMasp = input_masp.value;
                        
                        if (list_masp && checkMaspExistence(list_masp, enteredMasp)) {
                            event.preventDefault();
                            console.log('Mã sản phẩm đã tồn tại');
                            // Don't submit the form if the MASP already exists
                        } else {
                            // Submit the form if the MASP is valid
                            event.submit;
                        }
                    });

                    function checkMaspExistence(list_masp, enteredMasp) {
                        return list_masp.includes(enteredMasp);
                    }
                </script>
        </div>
    </div>
</div>