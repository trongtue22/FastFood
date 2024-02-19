<?php
    if (!isset($_GET['id'])) {
    // Truy vấn để lấy danh mục đầu tiên
    $sql_first_danhmuc = "SELECT * FROM `danhmuc` ORDER BY id_danhmuc ASC LIMIT 1";
    $query_first_danhmuc = mysqli_query($conn, $sql_first_danhmuc);
    $row_first_danhmuc = mysqli_fetch_array($query_first_danhmuc);

    // Gán giá trị id của danh mục đầu tiên vào biến $_GET['id']
    $_GET['id'] = $row_first_danhmuc['id_danhmuc'];
    }

    // Tiếp tục truy vấn và hiển thị danh sách sản phẩm
    $sql_monan = "SELECT * FROM `monan` WHERE monan.id_danhmuc = '$_GET[id]' ORDER BY idmonan ASC";
    $query_monan = mysqli_query($conn, $sql_monan);

    $sql_danhmuc = "SELECT * FROM `danhmuc` WHERE danhmuc.id_danhmuc = '$_GET[id]' LIMIT 1";
    $query_danhmuc = mysqli_query($conn, $sql_danhmuc);
    $row_title = mysqli_fetch_array($query_danhmuc);    
?>

<!-- Main -->
<div class="container-2">   
    <div class="title-main"><?php echo $row_title['ten_danhmuc'] ?></div>  
        <div id="section" class="container-fluid">
            <ul class="product">
            <?php
                while($row_monan = mysqli_fetch_array($query_monan)){
            ?>
            <li>
                <a href="#" data-toggle="modal" data-target="#myModal-garan1">
                <img src="../admincp/product/images/<?php echo $row_monan['imgURL'] ?>"> 
                <p class="title_monan"><?php echo $row_monan['tenmonan'] ?></p>
                <br>
                <p class="price_monan"><?php echo number_format($row_monan['gia'],0,',','.') ?> <u>đ</u></p>
                </a>
            </li> 
            <?php
            }
            ?>
            </ul> 
        </div> 
    </div> 
</div><br><br>

<div id="myModal-garan1" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Nội dung modal-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">  </h4>
      </div>

      <div class="modal-body">

      </div>
    </div>
  </div>
</div>