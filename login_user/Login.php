<?php 
  include ('Login_Data.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="login_style.css">
    <!--  -->
    
    <!-- Icon link Awesome: ICON here-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Dùng cho icon mắt -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  
  <title>Login form </title>
   </head>
  <body>

    <!-- Login form started here!  -->
    <div class="loginform" style="height: auto;">
        <h4 class="text-center"> Đăng Nhập </h4>
        <div class="container">  
          
            <form class="mx-auto" method = "POST">

                <!-- Đây là phần user name -->
                <div class="mb-3">  
                  <label for="exampleInputUserName" class="form-label">Tên tài khoản</label>
                  <!-- Icon for Username here -->
                  <i class="fa-solid fa-user"></i>   
                  <input type="text" class="form-control" id="exampleInputUserName" name="username" required    >
                </div>

                <!-- Đây là phần mật khẩu -->
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                  <!-- Icon for password here (sometime it doesn't work just delete the "text" in front of "fa")-->
                  <i class="fa fa-lock"></i>
                  
                  <div class="MatKhau">
                    <!-- Input này chỉ cho nhập tối đa 20 ký tự để né việc nó bị đẩy qua icon -->
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password"  required maxlength="20">
                          <!-- ICON-eyes nằm ở đây -->
                    <i class="far fa-eye" id="togglePassword" style="cursor: pointer;"></i>  
                    
                  </div> 
                  

                  <!-- Đây là phần chọn đăng ký OR quay về home -->
                  <label><a href="Register.php" class="DangKy">Tạo tài khoản</a></label> <br>
                  <label><a href="/FastFood/home.php" class="TrangChu">Trang chủ</a></label>  </a>        
                </div>

                
                <!-- <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
                
                
                <!-- Đây là nút login -->
                <button type="submit" class="btn btn-primary col-lg-12 col-12" id="button" name="submit">Đăng Nhập</button>
            </form>

                    <!-- Đây là phần Java cho Icon eye hiện thị mật khẩu (nhớ phải viết java bên trong form login)-->
                     
                     <script>
                      // Khai báo với kiểu data là const ( hằng số) với tên biến là togglePassword
                        const togglePassword = document.querySelector('#togglePassword');
                      // Khai báo với kiểu const ( hằng số) với tên biến là  password
                        const password = document.querySelector('#exampleInputPassword1');
                        togglePassword.addEventListener('click', function (e) {
                        // toggle the type attribute
                        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                        password.setAttribute('type', type);
                        // toggle the eye slash icon
                       
                        this.classList.toggle('fa-eye-slash');});

                        // Ấn vô login để chuyển hướng qua trang khác 

                        // document.querySelector('form').addEventListener('submit', function(event) {
                        //  event.preventDefault(); // Ngăn chặn hành vi mặc định của biểu mẫu (gửi dữ liệu)

                        //             // Chuyển hướng tới trang mục tiêu
                        // window.location.href = 'Register.html'; 
                                      // });
                    </script>

        </div>         
    </div> 
<!-- Login form end here -->




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   
  </body>
</html>