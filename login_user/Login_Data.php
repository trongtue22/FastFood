<?php

include("connection.php");

if(isset($_POST['submit']))
{
    // Gán các name của thẻ html cho các biến $ của PHP 
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    // Gán biến bên SQL qua bên PHP đã tạo ở trên => Lấy cả 1 câu lệch trên và lưu vào $sql 
        // Nói cách khác câu lệch dưới sẽ chạy thẳng vào bên trong SQL để làm lệch lấy data 
    $sql = "select * from signin where username = '$username' and password = '$password'";

    // Lấy câu lệch đã lưu ở bên trên + $conn (đường dẫn cho câu lệch tới nơi) 
    // Khi 2 câu lệch được kết hợp với nhau bằng lệch mysqli_query("câu lệch", "đường đi")
    $result1 = mysqli_query($conn, $sql); 
    // Lúc này $result đang gán kết quả được truy vấn trong database của lệch $sql

    $sql = "select * from admin where admin_name = '$username' and 	password = '$password'";
    $result2 = mysqli_query($conn, $sql); 
    // Chuyển các data trong $result (data chưa dùng dc) -> Mảng kết hợp để có thể sử dụng trực tiếp được
    // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);


    // Dùng để đếm coi bản nghi bên trong của $result có bao nhiều dòng => Nếu chỉ lấy dc 1 dòng có nghĩa là đã thành công  
    $count_user = mysqli_num_rows($result1);
    $count_admin = mysqli_num_rows($result2);
    
    if($count_user == 1){  
        // Nếu đăng nhập thành công thì chuyển qua trang tiếp theo 

        // Đây là HOME dành cho user 
        
        // Bỏ 1 từ /FastFood đi khi cần thiết 
        header("Location:/FastFood/home.php");
exit();
    } 
    elseif($count_admin == 1){
        // Đây là HOME dành cho admin 
        header("Location: /FastFood/home2.php");
    } 
    else {  
        // Lấy câu lệch mượn bên JAVA để thông báo lỗi  
        echo  '<script>
                    window.location.href = "Login.php";
                    alert("Login failed. Invalid username or password!!")
                </script>';
    }     

}
    










?>