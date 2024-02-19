<?php 
    require("../connectDatabase.php");
    $iddanhmuc =(int) $_GET['id'];
    $sql_danhmuc = "SELECT * FROM `danhmuc` WHERE `id_danhmuc` = '$iddanhmuc'";
    $query_danhmuc = mysqli_query($conn,$sql_danhmuc);
    $row = mysqli_fetch_array($query_danhmuc);
    if(isset($_POST['submit'])){
        $tendanhmuc =  $_POST['ten'];
        if(isset($tendanhmuc)){
            $sql_danhmuc = "UPDATE `danhmuc` SET `ten_danhmuc` =  '$tendanhmuc'
            WHERE `danhmuc`.`id_danhmuc` = '$iddanhmuc'";
            mysqli_query($conn, $sql_danhmuc);
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
        <form action="" method="POST" enctype="multipart/form-data">
        <h2>Cập nhật danh mục</h2>
        <br>
            <div>
                <label for="ten">Tên danh mục: </label>
                <input type="text" id='ten' name="ten" value="<?= $row["ten_danhmuc"]?>">
            </div>
            <div>
            <button type="submit" name="submit">
                Cập nhật danh mục
            </button>  
        </form>
    </div>
</body>
</html>
