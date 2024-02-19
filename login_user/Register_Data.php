<?php 
    // Gọi dường dẫn kết nối ;
   
   
    // Tạo sự kiện khi user nhấn nút Sign In 
    
    // Phải đảm bảo tài khoảng nhập vào != với database sign in + user 

    function LuuData()
    {
        include("connection.php");
        $username  = $_POST['username'];
        $email  = $_POST['email'];
        $phonenumber  = $_POST['phonenumber'];
        $password  = $_POST['password'];
        $repassword = $_POST['repassword'];

        // Kiểm tra coi tên "tài khoản" và "email" bên trong DataBase có bị trùng khớp ko ( so biến trong datanase vs biến user nhập )
                // *** Nếu cần thì hãy nhớ thảy đổi từ "signin" để truy vấn database *** 
        $sql = "Select * from signin where username ='$username' ";
        $result = mysqli_query($conn, $sql);  
        // Hàm này sẽ đếm coi có đối tượng nào bị trùng với cái user nhập trong database hay không 
        $count_user = mysqli_num_rows($result);  

        // *** Nếu cần thì hãy nhớ thay đổi từ "signin" để truy vấn database *** 
        $sql = "Select * from signin where email ='$email' ";
        $result = mysqli_query($conn, $sql); 
        // Hàm này sẽ đếm coi có đối tượng nào bị trùng với cái user nhập trong database hay không 
        $count_email = mysqli_num_rows($result);  


        // Kiểm tra coi tên tk có trùng với table: admin hay không 
        $sql = "Select * from admin where admin_name ='$username' ";
        $result = mysqli_query($conn, $sql); 
        $count_user_admin = mysqli_num_rows($result); 
        // Kiểm tra coi tên Email có trùng với table: admin hay không 
        $sql = "Select * from admin where email ='$email' ";
        $result = mysqli_query($conn, $sql); 
        $count_email_admin = mysqli_num_rows($result); 






        // Khi đảm bảo rằng email và tên user ko bị trùng thì cho đăng ký thành công => Đây là trường hợp tên đăng ký ko trùng với cả table: user + admin
        if($count_user== 0 && $count_email== 0 && $count_user_admin==0 && $count_email_admin==0)
        { 
            // Bảo mật mật khẩu cho user -> Gây mẫu thuận cho bên trang LOGIN 
            // $hash = password_hash($password,PASSWORD_DEFAULT);

            // Tạo câu lệch để truy vấn bên trong SQL => Đưa các data sau khi đăng ký thành công vào databse 
                    // *** Nếu cần thì hãy nhớ thảy đổi từ "signin" để truy vấn database *** 
            $sql = "INSERT INTO signin(username,email,phonenumber,password)VALUES ('$username','$email','$phonenumber','$password')";
            $result = mysqli_query($conn, $sql); 
                // Nếu data truyển vào OK 
            if($result)
            {
                header("Location: Login.php");
                exit();
            }
            else
            {
                echo '<script>
                        alert("Hệ thống gặp trục trặc")
                        window.location.href = "Register.php";
                      </script>';
            }     
        }
    

        else
        {   
            // Khi TK đăng ký tồn tại bên trong database: user + admin
            if($count_user > 0 || $count_user_admin > 0 ) {
                echo '<script>
                        window.location.href = "Register.php";
                        alert("Username already exists!!")
                    </script>';
            }
            
            // Khi Email đăng ký tồn tại bên trong database: user + admin
            if($count_email > 0 || $count_email_admin > 0 ) {
                echo '<script>
                        window.location.href = "Register.php";
                        alert("Email already exists!!")
                    </script>';
            }
        }
    }
    
?>