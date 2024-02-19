<?php
// Điểm bắt đầu sau khi tải lại trang 
session_start();
include("connection.php");
include("admin_sigin_data.php");
//  Thiết lập Session() qua bên này 


//  Tạo các trường kiếm tra thông tin nhập vào 
   // Tạo các biến rỗng => Dùng chung dc cho tất cả các hàm dưới
   $admin_name ='';
   $Email = '';
   $Phonenumber = '';
   $password = '';
   // Các biến thông báo lỗi  
   $errorAdminName = $errorAdminEmail = $errorAdminPhone = $errorAdminPassword = "";

    // Các biến lưu kết quả khi thành công
    $saveAdminName = $saveAdminEmail = $saveAdminPhone = $saveAdminPassword = "";


// Khi ấn nút save 
if(isset($_POST['save']))
{
    // Các các biến rỗng tạo trc đó bằng data của user 
    $admin_name = trim($_POST['admin_name']);
    $Email = trim($_POST['Email']);
    $Phonenumber = trim($_POST['sodienthoai']);
    $password = trim($_POST['password']);
    
    // Tạo biến đếm để kiểm tra điều kiện
    $dem = 0 ;

    // Check trường user name 
    if($admin_name == '')
    {
        $errorAdminName  ="Tên admin không được bỏ trống";
    }
    else if
    (strlen($admin_name)> 20 ){
        $errorAdminName =" Tên admin không được dài quá 20 ký tự"; 
    }
    else
    {
        $dem++;
        $saveAdminName = $admin_name ;
    }

    // Check trường Email 
    if($Email=="")
    {
        $errorAdminEmail = "Email không được bỏ trống. ";
       
    }
    else if(strpos($Email, '@gmail.com') === false){
        $errorAdminEmail = "Email phải có ký tự đuôi là @gmail.com";
    }
    else{
        $dem++;
        $saveAdminEmail = $Email ; 
    }


    // Check trường điện thoại
    if($Phonenumber == ""){
        $errorAdminPhone = "Số điện thoại không được để trống";
    }
    else if(strlen($Phonenumber)<10)
    {
        $errorAdminPhone = "Số điện thoại phải có 10 số";
    }
    else if(!preg_match('/^[0-9]+$/', $Phonenumber)){
        $errorAdminPhone = "Số điện thoại chỉ được chứa số";
    }
    else{
        $dem++;
        $saveAdminPhone  = $Phonenumber;
    }

    // Check trường mật khẩu 
    if($password ==""){
        $errorAdminPassword  = "Mật khẩu không được để trống";
    }
    else if(strlen($password)<5)
    {
        $errorAdminPassword = "Mật khẩu không được ít hơn 5 ký tự";
    }
    else {      
        $dem++; 
        $saveAdminPassword = $password;
    }

    if($dem == 4)
    {   

        // include("admin_sigin_data.php");
        // Tải lại trang web sau khi đã nén data vô table 
        ThucThiDuLieu();
        
    }


}

// Tạo hệ thống đưa data ra ngoài màn hình 
$query = "SELECT * FROM admin";
$query_run = mysqli_query($conn,$query);

// Khi user nhập nút xóa thì: 
if(isset($_POST['delete_stud']))
{
    // Hàm xóa thông tin được gọi đến 
        // Lưu ý: khi dùng hàm để gọi thì trong FORM ko cần có action làm gì nữa 
    NutXoaThongTin(); 
}

// Khi user nhấn nút cập nhật 
// if(isset($_POST['update_stud']))
// {
//     // câu lệch giúp đưa data từ phía table để thay đổi dữ liệu 
//     $saveAdminName = $_POST['update_admin_name'];
//     $saveAdminEmail = $_POST['update_admin_email'];
//     $saveAdminPhone  = $_POST['update_admin_phonenumber'];
//     $saveAdminPassword = $_POST['update_admin_password'];

//     $id =  $_POST['update_admin'];

// }


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href = "style1.css">
    <title>Thiết lập tài khoản admin</title>
</head>
<body>
  
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Thiết lập tài khoản admin
                            <!-- Khi ấn nút Back thì quay lại TRANG CHỦ -->
                            <a href="/FastFood/home2.php" class="btn btn-danger float-end">Quay về</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        
                        <!-- Đây là phần đưa báo thông tin thành công khi nhập dữ liệu xong -->
                        
                        <?php 
                            
                            // Nếu biến '$_SESSION' tồn tại AND nó khác rỗng 
                            if(isset($_SESSION['status']) && $_SESSION != '')
                            {
                                ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Thông báo!</strong> 
                                        <!-- Thêm thông báo => Biến Session sẽ dc gọi ra ở dưới này -->
                                        <?php echo $_SESSION['status'];?>

                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    
                                    </div> 
                                    
                                    



                                <?php
                                // unset giúp xóa bỏ biến 'status' để nếu dky thành công => Chỉ hiển thị thông báo 1 lần mà thôi
                                // Còn nếu ko có thì biến sẽ được hiển thị mãi mãi sau khi dky thành công cho dù có load trang lại thì vẫn thấy thông báo hiện ra
                                // Nên cần phải hiện ra thông báo trong 1 phiên làm việc sau đó xóa nó đi ngay trong phiên tiếp theo 
                                    unset($_SESSION['status']);
                            }  


                           

                        
                               
                        ?>    

                                                     
                    <!-- Đây là HTML nơi mà data của người dùng nhập vào -->
                        <form method="POST" enctype="multipart/form-data">
                           
                            <div class="mb-3">
                                <label>Tên admin</label>
                                <input type="text" name="admin_name"  class="form-control" value='<?php echo $saveAdminName ?>'>
                                <small style="color:red"><?php echo $errorAdminName;?> </small>

                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="text" name="Email"  class="form-control" value='<?php echo $saveAdminEmail ?>'>
                                <small style="color:red"><?php echo $errorAdminEmail;?> </small>

                            </div>

                            <div class="mb-3">
                                <label> Số điện thoại </label>
                                <input type="text" name="sodienthoai"  class="form-control"  value='<?php echo $saveAdminPhone ?>'>
                                <small style="color:red"><?php echo $errorAdminPhone;?> </small>
                            </div>

                            <div class="mb-3">
                                <label> Mật khẩu </label>
                                <input type="password" name="password"  class="form-control" value='<?php echo $saveAdminPassword ?>'>
                                <small style="color:red"><?php echo $errorAdminPassword;?> </small>
                            </div>
                            <!-- Nút bấm  -->
                            <div class="mb-3">
                                <!-- 2 hàm dùng cùng 1 nút ???  -->
                                <button type="submit" name="save" class="btn btn-primary"> Lưu thông tin </button>
                            </div>


                        </form>
                    <!-- Form kết thúc ở đây -->
                    
                    <!-- Table bắt đầu từ đây  -->
                    <table class="table">
                                <thead>
                                    <tr>
                                        <!-- <th> ID </th> -->
                                        <th> Tên </th>
                                        <th> Email  </th>
                                        <th> Số điện thoại </th>
                                        <!-- Nút nhấn  -->
                                        <th> Xóa </th>
                                        <th>Cập Nhật </th>
                                        
                                    </tr>
                                </thead>
                                    <tbody>
                                            <?php 
                                        
                                            
                                                // SQL sẽ kiểm tra các dòng coi có data hay chưa ? Đương nhiên có data thì phải > 0 
                                                if(mysqli_num_rows($query_run) > 0)
                                                {
                                                        // Biến $row đi vào bên trong $query_run ( nơi chứa các dữ liệu )
                                                         foreach($query_run as $row)
                                                         {
                                                            // Đây là phần print() ra data từ trong SQL 
                                                            ?>
                                                            <tr>
                                                                <!-- Các dữ liệu dưới đây đều là từ SQL mà ra -->
                                                                <td> <?php echo $row['admin_name']; ?>   </td> 
                                                                <td> <?php echo $row['email']; ?>        </td> 
                                                                <td> <?php echo $row['phonenumber']; ?>  </td> 
                                                                <!-- Đây là phần nút bấm  -->
                                                                <!-- <td> <a href="" class="btn btn-danger"> CẬP NHẬT </a> </td>  -->
                                                               

                                                                <!-- Xử lý data khi ấn nút XÓA -->
                                                                <td> 
                                                                    <form method = "POST" > 
                                                                        <!-- Lấy dữ liệu từ phía người dùng bằng thẻ input -->
                                                                        <input type="hidden" name="delete_admin" value = "<?php echo $row['admin_name'];?>" >
                                                                        <!-- Nhấn nút để xóa data khỏi màn hình -->
                                                                        <button type = "submit" name="delete_stud" class="btn btn-danger">XÓA ADMIN</button>                                                                                   
                                                                    </form>
                                                                </td>  
                                                                    
                                                                    <!-- Xét điều kiện khi viết cập nhật -->
                                                                <?php 
                                                                     $admin_name ='';
                                                                     $Email = '';
                                                                     $Phonenumber = '';
                                                                     $password = '';
                                                                     // Các biến thông báo lỗi  
                                                                     $errorAdminName = $errorAdminEmail = $errorAdminPhone = $errorAdminPassword = "";
                                                                  
                                                                      // Các biến lưu kết quả khi thành công
                                                                      $saveAdminName = $saveAdminEmail = $saveAdminPhone = $saveAdminPassword = "";
                                                                  
                                                                  
                                                                  // Khi ấn nút cập nhật => Lấy từ POST 
                                                                  if(isset($_POST['update_button']))
                                                                  {
                                                                      // Các các biến rỗng tạo trc đó bằng data của user 
                                                                      $admin_name = trim($_POST['update_admin_name']);
                                                                      $Email = trim($_POST['update_admin_email']);
                                                                      $Phonenumber = trim($_POST['update_admin_phonenumber']);
                                                                      $password = trim($_POST['update_admin_password']);
                                                                      
                                                                      // Tạo biến đếm để kiểm tra điều kiện
                                                                      $dem = 0 ;
                                                                  
                                                                      // Check trường user name 
                                                                      if($admin_name == '')
                                                                      {
                                                                          $errorAdminName  ="Tên admin không được bỏ trống";
                                                                      }
                                                                      else if
                                                                      (strlen($admin_name)> 20 ){
                                                                          $errorAdminName =" Tên admin không được dài quá 20 ký tự"; 
                                                                      }
                                                                      else
                                                                      {
                                                                          $dem++;
                                                                          $saveAdminName = $admin_name ;
                                                                      }
                                                                  
                                                                      // Check trường Email 
                                                                      if($Email=="")
                                                                      {
                                                                          $errorAdminEmail = "Email không được bỏ trống. ";
                                                                         
                                                                      }
                                                                      else if(strpos($Email, '@gmail.com') === false){
                                                                          $errorAdminEmail = "Email phải có ký tự đuôi là @gmail.com";
                                                                      }
                                                                      else{
                                                                          $dem++;
                                                                          $saveAdminEmail = $Email ; 
                                                                      }
                                                                  
                                                                  
                                                                      // Check trường điện thoại
                                                                      if($Phonenumber == ""){
                                                                          $errorAdminPhone = "Số điện thoại không được để trống";
                                                                      }
                                                                      else if(strlen($Phonenumber)<10)
                                                                      {
                                                                          $errorAdminPhone = "Số điện thoại phải có 10 số";
                                                                      }
                                                                      else if(!preg_match('/^[0-9]+$/', $Phonenumber)){
                                                                          $errorAdminPhone = "Số điện thoại chỉ được chứa số";
                                                                          
                                                                      }
                                                                      else{
                                                                          $dem++;
                                                                          $saveAdminPhone  = $Phonenumber;
                                                                      }
                                                                  
                                                                      // Check trường mật khẩu 
                                                                      if($password ==""){
                                                                          $errorAdminPassword  = "Mật khẩu không được để trống";
                                                                      }
                                                                      else if(strlen($password)<5)
                                                                      {
                                                                          $errorAdminPassword = "Mật khẩu không được ít hơn 5 ký tự";
                                                                      }
                                                                      else {      
                                                                          $dem++; 
                                                                          $saveAdminPassword = $password;
                                                                      }
                                                                  
                                                                      if($dem == 4)
                                                                      {   
                                                                  
                                                                          // include("admin_sigin_data.php");
                                                                          // Tải lại trang web sau khi đã nén data vô table 
                                                                          UpdateThongTin();
                                                                          
                                                                      }
                         
                                                                   
                                                                  
                                                                  
                                                                  }
                                                                    
                                                                ?> 
                                                                
                                                                 <!-- Xử lý data khi ấn nút CẬP NHẬT => 1 trang pop up ra màn hình -->
                                                                <td> 
                                                                    <form method = "POST" enctype="multipart/form-data"> 
                                                                        <!-- Lấy data từ phía user dùng thẻ input -->

                                                                        
                                                                    

                                                                        <!-- Xử lý nút Cập Nhật -->
                                                                        <!-- <input type="hidden" name="update_admin" value = "<?php echo $row['id_admin'];?>" > -->
                                                                        
                                                                        <!-- <button type = "submit" name="update_stud" class="btn btn-danger">CẬP NHẬT</button>  -->


                                                                        <button type="button" name="update_stud" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $row['id_admin'] ?>">CẬP NHẬT</button>
                                                                                     

                                                                                                    <!-- Đây là khởi đầu của POP-UP FORM -->
                                                                            <!-- Dưới đây là form để khi ấn submit thì các data bên trong của nó sẽ cung cấp qua cho bên trang khác   -->
                                                                        <form method = "POST" enctype="multipart/form-data">
                                                                            
                                                                            <div id="myModal<?php echo $row['id_admin'] ?>" class="modal fade" role="dialog">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật lại thông tin của admin</h1>
                                                                                        </div>
                                                                                        <div class="modal-body">

                                                                                            <!-- <input type="text" name="admin_name"  class="form-control" value='<?php echo $row['admin_name'] ?>'> -->
                                                                                            
                                                                                        <div class="mb-3">
                                                                                            <label>Tên admin</label>
                                                                                            <input type="text" name="update_admin_name"  Required class="form-control" value='<?php echo $row['admin_name']; ?>'>
                                                                                            <small style="color:red"><?php echo $errorAdminName;?> </small>

                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label>Email</label>
                                                                                            <input type="text" name="update_admin_email" Required class="form-control" value='<?php echo $row['email']; ?>'>
                                                                                            <small style="color:red"><?php echo $errorAdminEmail;?> </small>

                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label>Số điện thoại</label>
                                                                                            <input type="text" name="update_admin_phonenumber"  Required class="form-control" value='<?php echo $row['phonenumber']; ?>'>
                                                                                            <small style="color:red"><?php echo $errorAdminPhone;?> </small>

                                                                                        </div>

                                                                                        <input type="hidden" name="update_admin" value = "<?php echo $row['id_admin'];?>" >

                                                                                        <div class="mb-3">
                                                                                            <label>Mật khẩu</label>
                                                                                            <input type="text" name="update_admin_password" Required class="form-control" value='<?php echo $row['password']; ?>'>
                                                                                            <small style="color:red"><?php echo $errorAdminPassword;?> </small>

                                                                                        </div>

                                                                                                                        <!-- Chỗ ấn nút  -->
                                                                                        
                                                                                            <div class="modal-footer">
                                                                                                <button type="button" class="btn btn-secondary"  data-dismiss="modal">Hủy</button>
                                                                                                <button type="submit" name="update_button" class="btn btn-primary">Lưu lại</button>
                                                                                            </div>
                                                                        
                                                                                            
                                                                                        
                     
                                                                                            </div>
                                                                                        </div>
                                                                                            </div>
                                                                                    </div>
                                                                        </form>
                                                                                                 <!-- Đây là điểm kết thúc của POP_UP FORM -->



                                                                                                    <!-- Button trigger modal -->
                                                                        <!-- <button type="button" name="update_stud" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                            CẬP NHẬT
                                                                        </button> -->

                                                                            <!-- Modal -->
                                                                            <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật lại thông tin của admin</h1>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body"> -->


                                                                                    
                                                                    
                                                                                    <!-- From hiện thị bắt đầu -->
                                                                                 
<!-- 
                                                                                    <input type="hidden" name="update_admin_name" value = "<?php echo $row['admin_name'];?>">
                                                                                    <input type="hidden" name="update_admin_email" value = "<?php echo $row['email'];?>">
                                                                                    <input type="hidden" name="update_admin_phonenumber" value = "<?php echo $row['phonenumber'];?>">
                                                                                    <input type="hidden" name="update_admin_password" value = "<?php echo $row['password'];?>">





                                                                                        <div class="mb-3">
                                                                                            <label>Tên admin</label>
                                                                                            <input type="text" name="admin_name"  class="form-control" value='<?php echo $saveAdminName ?>'>
                                                                                            <small style="color:red"><?php echo $errorAdminName;?> </small>

                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label>Email</label>
                                                                                            <input type="text" name="Email"  class="form-control" value='<?php echo $saveAdminEmail ?>'>
                                                                                            <small style="color:red"><?php echo $errorAdminEmail;?> </small>

                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label> Số điện thoại </label>
                                                                                            <input type="text" name="sodienthoai"  class="form-control"  value='<?php echo $saveAdminPhone ?>'>
                                                                                            <small style="color:red"><?php echo $errorAdminPhone;?> </small>
                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label> Mật khẩu </label>
                                                                                            <input type="password" name="password"  class="form-control" value='<?php echo $saveAdminPassword ?>'>
                                                                                            <small style="color:red"><?php echo $errorAdminPassword;?> </small>
                                                                                        </div> -->
                                                                                    
                                                                                    <!-- Đây là nơi nó end -->
                                                                                <!-- </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Xóa</button>
                                                                                    <button type="button" class="btn btn-primary">Lưu lại</button>
                                                                                </div>
                                                                                </div> -->
                                                                            </div>
                                                                            </div>                           
                                                                    </form>
                                                                </td>
                                                            </tr>    
                                                            <?php

                                                         }   
                                                }
                                                
                                                else
                                                {
                                                    ?>
                                                        <tr>
                                                            <td>Không có tài khoản admin nào trong hệ thống</td>
                                                        </tr>    
                                                    <?php

                                                }
                                                                                                                             
                                            ?>
                                    </tbody>
                            </table>
                    <!-- Điểm kết thúc của table ở đây -->


                    </div>


                </div>
            </div>
        </div>
    </div>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
