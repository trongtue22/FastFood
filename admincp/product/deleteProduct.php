<?php 
    require('../connectDatabase.php');
    $id = (int) $_GET['id'];
    $image = "SELECT imgURL  FROM `monan` WHERE `monan`.`idmonan` = $id";
    $query_monan = mysqli_query($conn, $image);
    $after = mysqli_fetch_assoc($query_monan);
   
    // DELETE file img
    if (file_exists("./images/".$after['imgURL'])) {
        unlink("./images/".$after['imgURL']);

    }
    $sql_monan = "DELETE FROM `monan` WHERE `monan`.`idmonan` = $id";
    mysqli_query($conn,$sql_monan);
    header("location:../admin.php");
?>