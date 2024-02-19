<?php
    require("../connectDatabase.php");

    if (isset($_POST["submit"])) {
        $tendanhmuc = $_POST["ten"];

        $sql_danhmuc = "INSERT INTO `danhmuc` (`ten_danhmuc`)
                VALUES ('$tendanhmuc')";

    if (mysqli_query($conn, $sql_danhmuc)) {
        echo "<script>alert('Bạn đã thêm thành công')</script>";
        header("Location:../admin.php");
    exit();
    } else {
        echo "Error: " . $sql_danhmuc . "<br>" . mysqli_error($conn);
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
    <title>Thêm món ăn</title>
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
        <h2>Thêm danh mục</h2>
        <br>
            <div>
                <label for="ten">Tên danh mục: </label>
                <input type="text" id='ten' name="ten" >
            </div>
            <button type="submit" name="submit">
                Thêm danh mục
            </button>   
        </form>
    </div>
</body>
</html>
