<?php
  $sql_danhmuc = "SELECT * FROM danhmuc ORDER BY id_danhmuc ASC";
  $query_danhmuc = mysqli_query($conn, $sql_danhmuc);
?>

<!-- Navbar 1 -->
<nav class="navbar navbar-default navbar-fixed-top custom-navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="../home.php">
      <img src="../images/logo.png" alt="Logo"></a>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#" data-toggle="modal" data-target="#myModal-user"><span class="glyphicon glyphicon-user"></span></a></li>
      <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
    </ul>
  </div>
  <!-- Navbar 2 -->
  <nav class="navbar navbar-default custom-navbar-2" data-spy="affix" data-offset-top="200">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
        <?php
          while($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
        ?>
          <li><a href="order.php?quanly=danhmuc&id=<?php echo $row_danhmuc['id_danhmuc'] ?>"> <?php echo $row_danhmuc['ten_danhmuc'] ?></a></li>
        <?php
        }
        ?>
        </ul>
      </div>
    </div>
  </nav> 
</nav> 


<div id="myModal-user" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Nội dung modal-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Đăng nhập tài khoản</h4>
      </div>

      <div class="modal-body">
        <!-- Đặt mã sidebar.php của bạn vào đây -->
        <!-- Đoạn code của sidebar.php tại đây -->
      </div>
    </div>
  </div>
</div>

