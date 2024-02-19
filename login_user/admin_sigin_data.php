<?php 

// include("connection.php");

function ThucThiDuLieu(){
  
    include("connection.php");

    $admin_name = $_POST['admin_name'];
    $Email = $_POST['Email'];
    $Phonenumber = $_POST['sodienthoai'];
    $password = $_POST['password'];
    $id =  $_POST['update_admin'];

    
    $saveAdminName = $_POST['update_admin_name'];
    $saveAdminEmail = $_POST['update_admin_email'];
    $saveAdminPhone  = $_POST['update_admin_phonenumber'];
    $saveAdminPassword = $_POST['update_admin_password'];
    
    
     // Kiểm tra coi tên "tài khoản" và "email" bên trong DataBase có bị trùng khớp ko ( so biến trong datanase vs biến user nhập )
        // *** Nếu cần thì hãy nhớ thảy đổi từ "signin" để truy vấn database *** 
        $sql = "Select * from signin where username ='$admin_name' ";
        $result = mysqli_query($conn, $sql);  
        // Hàm này sẽ đếm coi có đối tượng nào bị trùng với cái user nhập trong database hay không 
        $count_user = mysqli_num_rows($result);  
        
        // *** Nếu cần thì hãy nhớ thay đổi từ "signin" để truy vấn database *** 
        $sql = "Select * from signin where email ='$Email' ";
        $result = mysqli_query($conn, $sql); 
        // Hàm này sẽ đếm coi có đối tượng nào bị trùng với cái user nhập trong database hay không 
        $count_email = mysqli_num_rows($result);  
        
        // Kiểm tra coi tên tk có trùng với table: admin hay không 
        $sql = "Select * from admin where admin_name ='$admin_name' ";
        $result = mysqli_query($conn, $sql); 
        $count_user_admin = mysqli_num_rows($result); 
        // Kiểm tra coi tên Email có trùng với table: admin hay không 
        $sql = "Select * from admin where email ='$Email' ";
        $result = mysqli_query($conn, $sql); 
        $count_email_admin = mysqli_num_rows($result); 
   
    // Bên trong là đưa thông tin vào database => Thêm vào 
    if($count_user == 0 && $count_email== 0 && $count_user_admin==0 && $count_email_admin == 0)
    { 
        // Đưa data của user nhập ở trên vào table -> 'admin'
        $query = "INSERT INTO admin(admin_name,email,phonenumber,password) VALUES('$admin_name','$Email','$Phonenumber','$password')";
        // Khởi chạy câu lệch vào SQL 
        $query_run = mysqli_query($conn,$query);
        // Nếu câu lệch chạy thành công
        if($query_run)
        {
         // Tạo biến session ở đây
         $_SESSION['status'] = 'Đã tạo thêm tài khoản admin thành công';
        }
        else
        {
         $_SESSION['status'] = 'Tính năng thêm tài khoản gặp vấn đề';
        }
         // Sau khi xử lý trong if xong thì ra đây để load lại trang 
         header('Location:admin_sigin.php');
        // Giúp để đảm bảo rằng không có mã PHP nào được thực thi sau khi tải lại trang.    
         exit;
    }
    

    else
            {
                echo '<script>
                        alert("Vui lòng chọn tên admin và Email khác")
                        window.location.href = "admin_sigin.php";
                      </script>';
            }     



}



// Khi người dùng nhấn nút XÓA => Form có dạng POST sẽ nhận diện được 
function NutXoaThongTin()
    {
        // Gọi database ra để làm việc 
        include("connection.php");
        // Khi lấy data bên màn hình qua thì tạo biến lưu trữ
        // Nên nhớ khi xóa thì không cần dùng Id mà hãy dùng tên của data cho dù chúng có khóa chính hay không 
        $admin_name_id  = $_POST['delete_admin'];
        // Chạy câu lệch SQL với biến data thu được
        $query = "DELETE FROM admin where admin_name ='$admin_name_id'";
        $query_run = mysqli_query($conn,$query);
        // Dự đoán các TH khi câu lệch chạy     
        if($query_run)
        {
            // Thành công thì load lại trang
            $_SESSION['status'] = 'Bạn vừa xóa thành công một tài khoản admin';
        }
        else
        {
            $_SESSION['status'] = 'Việc thực thi xóa tài khoản admin thất bại';
        }
        // Sau khi lưu các session thì load lại trang 
        header('Location:admin_sigin.php');
        exit;
    
    }


// function UpdateThongTin()
// {
//     // Khi viết xong và ấn lưu thông tin  => Vô tình nút lưu này lại bị trùng 
//     if(isset($_POST['save']))
//     {
//         include("connection.php");
//         $query = "UPDATE admin SET admin_name = '$update_admin_name',email='$update_admin_email', phonenumber='$update_admin_phonenumber',password='$update_admin_password' WHERE id_admin='$update_id' " ;
//         $query_run = mysqli_query($conn,$query);
//         if($query_run)
//         {
//             $_SESSION['status'] = 'Bạn vừa cập nhật thành công một tài khoản admin';

//         }
//         else
//         {
//             $_SESSION['status'] = 'Bạn vừa cập nhật thất bại một tài khoản admin';
//         }
//         header('Location:admin_sigin.php');
//         exit;

       

//     }
// }



// Khi user nhấn vào nút update button 


function UpdateThongTin()
{


// if(isset($_POST['update_button']))
// {

    include("connection.php");
    $update_admin_name = $_POST['update_admin_name'];
    $update_admin_email = $_POST['update_admin_email'];
    $update_admin_phonenumber  = $_POST['update_admin_phonenumber'];
    $update_admin_password = $_POST['update_admin_password'];
    $update_id               = $_POST['update_admin'];
    

        // Kiểm tra coi tên "tài khoản" và "email" bên trong DataBase có bị trùng khớp ko ( so biến trong datanase vs biến user nhập )
        // *** Nếu cần thì hãy nhớ thảy đổi từ "signin" để truy vấn database *** 
        $sql = "Select * from signin where username ='$update_admin_name' ";
        $result = mysqli_query($conn, $sql);  
        // Hàm này sẽ đếm coi có đối tượng nào bị trùng với cái user nhập trong database hay không 
        $count_user = mysqli_num_rows($result);  
        
        // *** Nếu cần thì hãy nhớ thay đổi từ "signin" để truy vấn database *** 
        $sql = "Select * from signin where email ='$update_admin_email ' ";
        $result = mysqli_query($conn, $sql); 
        // Hàm này sẽ đếm coi có đối tượng nào bị trùng với cái user nhập trong database hay không 
        $count_email = mysqli_num_rows($result);  
        
        // // Kiểm tra coi tên tk có trùng với table: admin hay không 
        // $sql = "Select * from admin where admin_name ='$update_admin_name' ";
        // $result = mysqli_query($conn, $sql); 
        // $count_user_admin = mysqli_num_rows($result); 
        // // Kiểm tra coi tên Email có trùng với table: admin hay không 
        // $sql = "Select * from admin where email ='$update_admin_email' ";
        // $result = mysqli_query($conn, $sql); 
        // $count_email_admin = mysqli_num_rows($result); 



    if($count_user == 0 && $count_email== 0 )
    { 
                    $query = "UPDATE admin SET admin_name = '$update_admin_name',email='$update_admin_email', phonenumber='$update_admin_phonenumber',password='$update_admin_password' WHERE id_admin='$update_id' " ;
                    $query_run = mysqli_query($conn,$query);
                    if($query_run)
                    {
                            $_SESSION['status'] = 'Bạn vừa cập nhật thành công một tài khoản admin';
                            
                    }
                    else
                    {
                            $_SESSION['status'] = 'Bạn vừa cập nhật thất bại một tài khoản admin';
                            
                    }
                    // header('Location:admin_sigin.php');
                    // Dùng java để load lại trang để khỏi bị lỗi 
                    echo '<script>
                                window.location.href = "admin_sigin.php";
                             </script>';
                    
    }
    else
    {
        echo '<script>
                alert("Vui lòng chọn tên admin và Email khác")
                window.location.href = "admin_sigin.php";
              </script>';
    }     


}





// }





?>