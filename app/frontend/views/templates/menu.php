<div class="menu">
    <div class="container">
            <a href="index.php"><span class="glyphicon glyphicon-home"></span></a>
    <?php foreach($categories as $category): ?>
    <a href="<?php echo base_url("news/index?id={$category['id_cate']}"); ?>"><?php echo $category['ten']; ?></a>
    <?php endforeach; ?>
    <div class="search">
        <form>
            <input type="hidden" name="module" value="search">
            <input type="hidden" name="action" value="index">
            <input type="text" name="s" placeholder="Nhập nội dung cần tìm">        
            <button type="submit"><span class="glyphicon glyphicon-search" style=""></span></button>
        </form>
    </div>
    <div class="user">
        <?php
            if(isset($_SESSION['user']))
            {
         ?>
         <span style="color: #FFF"><?php echo $_SESSION['user']; ?></span>
        <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <span class="caret"></span>
             </button>
             <ul class="dropdown-menu dropdown-menu-right">
                <?php
                  if($_SESSION['level'] == 2 || $_SESSION['level'] == 3)
                  {
                 ?>
                <li><a href="<?php echo BASE_URL . '/admin.php'; ?>">Quản trị</a></li>  
                <?php } ?> 
                <li><a href="<?php echo base_url('dangnhap/logout'); ?>">Đăng xuất</a></li>    
            </ul>
        </div>
        <?php 
            }
            else
            {
        ?>
        <span class="glyphicon glyphicon-user"></span>
        <!-- Single button -->
        <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <span class="caret"></span>
             </button>
             <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="<?php echo base_url('dangky/index'); ?>">Đăng ký</a></li>
                <li><a href="<?php echo base_url('dangnhap/index'); ?>">Đăng nhập</a></li>       
            </ul>
        </div>
         <?php } ?>
    </div>
    </div>
</div> <!-- menu -->