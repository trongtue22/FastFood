<?php 
    require("../connectDatabase.php");
    $idmonan =(int) $_GET['id'];
    $sql_monan = "SELECT * FROM `monan` WHERE `idmonan` = '$idmonan'";
    $query_monan = mysqli_query($conn,$sql_monan);
    $row = mysqli_fetch_array($query_monan);
    $img = $row['imgURL'];
    if(isset($_POST['submit'])){
        $danhmuc = $_POST["danhmuc"];
        $gia =  $_POST['gia'];
        $tenmonan =  $_POST['ten'];
        $mota =  $_POST['mota'];
        $hinhanh=$_FILES['hinhanh']['name'];
        $target_dir = "./images/";
        if($hinhanh){
            if (file_exists("./images/".$img)) {
                unlink("./images/".$img);
            } 
            $target_file = $target_dir.$hinhanh ;
        }else{
            $target_file = $target_dir.$img ;
            $hinhanh = $img;
        }
        if(isset($tenmonan) && isset($gia) && isset($mota) && isset($hinhanh) && isset($danhmuc)){
            move_uploaded_file($_FILES["hinhanh"]["tmp_name"],$target_file);
            $sql_monan = "UPDATE `monan` SET `tenmonan` =  '$tenmonan', `gia` =  '$gia', 
             `mota` = '$mota', `imgURL` = '$hinhanh', `id_danhmuc` =  '$danhmuc'
            WHERE `monan`.`idmonan` = '$idmonan';";
            mysqli_query($conn, $sql_monan);
            header("Location:../admin.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Cập nhật món ăn</title>
    <nav class="navbar navbar-default navbar-fixed-top custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="../admin.php">
            <img src="../../images/logo.png" alt="Logo"></a>
        </div>
    </nav>
</head>
<body>
    <div class="add">
        <form action="" method="POST" enctype="multipart/form-data" id="product_update">
        <h2>Cập nhật món ăn</h2>
        <br>
            <div>
                <label for="danhmuc">Tên danh mục: </label>
                <select name="danhmuc">
                    <?php
                        $sql_monan = "SELECT * FROM danhmuc ORDER BY ten_danhmuc DESC";
                        $query_monan = mysqli_query($conn, $sql_monan);
                        while($row_danhmuc = mysqli_fetch_array($query_monan)){
                            if($row_danhmuc['id_danhmuc']==$row['id_danhmuc']){
                    ?>
                    <option selected value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['ten_danhmuc'] ?></option>
                    <?php
                        }else{
                    ?>
                    <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['ten_danhmuc'] ?></option>
                    <?php   
                        }
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="ten">Tên món ăn: </label>
                <input type="text" id='ten' name="ten" value="<?= $row["tenmonan"]?>">
            </div>
            <div>
                <label for="gia">Giá món ăn: </label>
                <input type="number" id='gia' name="gia"  value="<?= $row["gia"]?>">
            </div>
            <div>
                <img style="width:200px;height: 200px;" src='./images/<?= $row["imgURL"]?>' alt="">
            </div>
            <div>
                <label for="file">Hình ảnh: </label>
                <input type="file"  id="file" name="hinhanh" value="Choose File">
            </div>
            <div>
                <label for="mota">Mô tả: </label>
                <textarea name="mota" id='mota'  cols="30" rows="10"><?= $row["mota"]?></textarea>
            </div>
            <button type="submit" name="submit">
                Cập nhật món ăn
            </button>  
        </form>
    </div>
</body>
</html>
