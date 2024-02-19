<?php 
    include("connection.php");
    include("Register_Data.php");
    // Các biến để hứng data của user 
    $username = "";
    $email = "";
    $phonenumber = '';
    $password = '';
    $Repassword = "";
    // Giữ data đúng của các trường input mà người dùng nhập true 
    $saveUser = $saveEmail = $savePassword = $savePhone = "";

    // Các biến thông báo để hiện thị
    $errorUser = $errorEmail= $errorPhone= $errorPassword = $errorRePassword  = "";

    if (isset($_POST['submit'])) {
        $username= trim($_POST['username']);
        $email = trim($_POST['email']);
        $phonenumber = trim($_POST['phonenumber']);
        $password = trim($_POST['password']);
        $Repassword = trim($_POST['repassword']);
        $dem = 0 ; 
        
        // Trường UserName
        if($username==""){
            
            $errorUser = "User Name không được bỏ trống. ";
            
           
        }
        else if(strlen($username)>20 ){
            $errorUser = "User Name phải nhỏ hơn 20 ký tự ";
        }
        else{
            $saveUser = $username ;
            $dem++;
        }
        // Trường Email 
        if($email==""){
            $errorEmail = "Email không được bỏ trống. ";
           
        }
        else if(strpos($email, '@gmail.com') === false){
            $errorEmail = "Email phải có ký tự đuôi là @gmail.com";
        }
        else{
            $saveEmail = $email;
            $dem++;
        }
        // Trường điện thoại 

        if($phonenumber==""){
            $errorPhone = "PhoneNumber không được để trống";
        }
        else if(strlen($phonenumber)<10){
            $errorPhone = "PhoneNumber phải có 10 số";
        }
        else if(!preg_match('/^[0-9]+$/', $phonenumber)){
            $errorPhone = "PhoneNumber chỉ được chứa số";
        }
        else{
            $savePhone = $phonenumber;
            $dem++;
        }
        // Trường mật khẩu
        if($password ==""){
            $errorPassword = "Password không được để trống";
        }
        else if(strlen($password)<5){
            $errorPassword = "Password không được ít hơn 5 ký tự";
        }
        else {
            $savePassword = $password;
            $dem++; 
        }
        // Trường nhập lại mật khẩu 
        if($Repassword == ""){
            $errorRePassword = "Không được để trống";
        }
        else if($password!=$Repassword){
            $errorRePassword = "Không khớp với password";
        }
        else{
            $dem++;
        }
        // Khi user nhập hết các trường Input ( 5 cái )
        if($dem==5)
        {   
            // Khi kiểm tra xong 5 input thì tiến thẳng vào kho nhập data 
            // include("Register_Data.php"); 
            LuuData();
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Register_style.css">

        <!-- link liên kết để tạo các icon -->
        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Create Account</title>
</head>
<body>
    <!-- Form sign in  -->
    <div class="sign_in">
        <!-- Tạo header cho form sign in bằng cách dùng header làm tiêu để cho form -->
        <div class="header">
                <h2> Đăng ký tài khoản </h2>
        </div>
        <!-- action="Register_Data.php" -->
        <!-- Tạo form cha bên trong chứa các Input cho user nhập -->
        
        <!-- action="Register_Data.php" -->
         <form class="form" id="form" method="POST" >
                <!-- Tạo form con bao quanh các phần tử input UserName  -->
                <div class="form-control">
                    <!-- Phần input cho UserName -->
                    <label for="UserName">Tên tài khoản </label>
                
                    <!--  Dùng autocomplete="off" để tắt hộ trợ gợi ý các tên đã từng nhập trước đó -->
                    
                    <input type="text" id="UserName" name="username" class="custom-input" value='<?php echo $saveUser ?>'>

                    
                    <!-- Phần icon cho UserName -->
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <!-- Đặt thông báo cho ô input với cỡ chữ (small) -->
                    <!-- <small>Error message</small>  -->
                    
                    
                    <small style="color:red"> <?php echo $errorUser ; ?> </small>



                </div>

                <!-- Phần form của Email -->
                <div class="form-control ">
                    <!-- Phần text cho input Email  -->
                    <label for="Email">Email</label>
                    <!-- Phần input cho Email -->
                    <input type="text" id="Email"  class="custom-input" name="email" autocomplete="off" value='<?php echo $saveEmail ?>' >
                     <!-- Phần icon cho Email -->
                     
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <!-- Đặt thông báo cho ô input với cỡ chữ (small) -->
                    <!-- <small>Error message</small>  -->
                    <small style="color:red"> <?php echo $errorEmail ; ?> </small>
                </div>

                <!-- Phần form Số điện thoại -->
                <div class="form-control">
                    <!-- Phần text cho số điện thoại -->
                    <label for="">Số điện thoại</label>
                    <!-- Phần input cho Số điện thoại -->
                    <input type="text" id="PhoneNumber"  class="custom-input" name="phonenumber" autocomplete="off" value='<?php echo $savePhone ?>'>
                     <!-- Phần icon cho Số điện thoại -->
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <!-- Đặt thông báo cho ô input với cỡ chữ (small) -->
                    <!-- <small>Error message</small>  -->
                    <small style="color:red"> <?php echo $errorPhone ; ?> </small>

                </div>

                <!-- Phần form cho Password  -->
                <div class="form-control">
                    <!-- Phần input cho Password -->
                    <label for="">Mật khẩu</label>
                    <input type="password" id="Password"  class="custom-input" name="password" autocomplete="off" value='<?php echo $savePassword ?>'>
                     <!-- Phần icon cho Password -->
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <!-- Đặt thông báo cho ô input với cỡ chữ (small) -->
                    <!-- <small>Error message</small>  -->
                    <small style="color:red"> <?php echo $errorPassword ; ?> </small>
                </div>

                <!-- Phần form cho Password check -->
                <div class="form-control">
                    <!-- Phần input cho Password check -->
                    <label for="">Nhập lại mật khẩu</label>
                    <input type="password" id="Password_check"  class="custom-input"name="repassword" autocomplete="off">
                     <!-- Phần icon cho Password check -->
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <!-- Đặt thông báo cho ô input với cỡ chữ (small) -->
                    <!-- <small>Error message</small>  -->
                    <small style="color:red"> <?php echo $errorRePassword ; ?> </small>
                    
                </div>
                
                <!-- Thẻ để quay về Home và Login -->
                <div class="CardTurnHome">
                  <label><a href="Login.php" class="Login">Đăng nhập</a></label> <br>
                  <label><a href="/FastFood/home.php" class="TrangChu">Trang chủ</a></label>  </a> 
                </div>

                <!-- Phần nút để ấn đăng ký -->
                <button id="button" type="submit" value="SignIn" name = "submit"> Đăng ký </button>

        </form> 

        
    
    </div>
    <!-- Form sign in dừng ở đây -->
    
    
</body>
</html>