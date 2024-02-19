<?php 
    // Đây là phần kết nối tới database cần dùng 
    $db_severname = "localhost";
    $db_username  = "root";
    $db_password = "";
    $db_tablename = "dbfastfood";
    // *** Nếu cần thì hãy nhớ thảy đổi từ "$db_tablename" cho khớp với table đã tạo *** 
    $conn = new mysqli($db_severname,$db_username,$db_password, $db_tablename );

        // Kiểm tra dường dẫn kết nối 
    if($conn->connect_error)
    {
        die("Connection failed".$conn->connect_error );
    } 
    else{
    echo ""; 
    }



?>