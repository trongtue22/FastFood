<?php
    require("connectDatabase.php");
    $sql_danhmuc = "SELECT * FROM `danhmuc`";
    $query_danhmuc = mysqli_query($conn, $sql_danhmuc);

    $sql_monan = "SELECT * FROM `monan`, `danhmuc` WHERE monan.id_danhmuc = danhmuc.id_danhmuc ORDER BY idmonan DESC";
    $query_monan = mysqli_query($conn, $sql_monan);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Admin</title>
    <script>
        function xoaDanhmuc(){
            var conf = confirm(`Bạn có chắc chắn xóa danh mục này hay không?`);
            return conf;
        }
        function xoaMonan(){
            var conf = confirm(`Bạn có chắc chắn xóa món ăn này hay không?`);
            return conf;
        }
    </script>
   <nav class="navbar navbar-default navbar-fixed-top custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="trangChu.php">
            <img src="../images/logo.png" alt="Logo"></a>
        </div>
    </nav>
</head>
<body>
    <div class="manager">
    <h1>Quản lý danh sách món ăn</h1>
        <table id="productList">
        <button>
            <a href="category/addCategory.php">Thêm danh mục</a>
        </button>
            <tr>
                <th>Mã danh mục</th>
                <th>Tên danh mục</th>
                <th>Tùy chọn</th>
            </tr>
            <?php
                while($row = mysqli_fetch_array($query_danhmuc)){
            ?>      
            <tr>
                <td><?= $row["id_danhmuc"] ?> </td>  
                <td><?= $row["ten_danhmuc"] ?> </td>  
                <td><a href="category/updateCategory.php ?id=<?= $row["id_danhmuc"]?> " class="button1">Sửa</a>
                <a onclick="return xoaDanhmuc()" href="category/deleteCategory.php ?id=<?= $row["id_danhmuc"]?>" class="button1">Xóa</a>  
                </td>
            </tr>   
            <?php }?>  
             
        <table id="productList">
            <br>
            <br>
        <button>
            <a href="product/addProduct.php">Thêm món ăn</a>
        </button>
            <tr>
                <th>Danh mục</th>
                <th>Mã món ăn</th>
                <th>Tên món ăn</th>
                <th>Giá món ăn</th>
                <th>Hình ảnh</th>
                <th>Tùy chọn</th>
            </tr>
            <?php
                while($row = mysqli_fetch_array($query_monan)){
            ?> 
            <tr>
                <td><?= $row["ten_danhmuc"] ?> </td>   
                <td><?= $row["idmonan"] ?> </td>  
                <td><?= $row["tenmonan"] ?> </td>  
                <td><?= $row["gia"] ?> <u>đ</u></td>
                <td><img style="width: 200px; height: 200px"
                src="./product/images/<?= $row["imgURL"] ?>" alt=""></td>
                <td><a href="product/updateProduct.php ?id=<?= $row["idmonan"]?> " class="button1">Sửa</a>
                <a onclick="return xoaMonan()" href="product/deleteProduct.php ?id=<?= $row["idmonan"]?>" class="button1">Xóa</a>  
                </td>
            </tr>   
            <?php }?>     
        </table>
    </div>
</body>
</html>