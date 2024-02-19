<?php 
    require('../connectDatabase.php');
    $id = (int) $_GET['id'];
    $sql_danhmuc = "DELETE FROM `danhmuc` WHERE `danhmuc`.`id_danhmuc` = $id";

    mysqli_query($conn,$sql_danhmuc);
    header("location:../admin.php");
?>