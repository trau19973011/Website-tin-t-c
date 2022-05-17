

<div class="phan2">
    <?php
        if($news)
        {
    ?>
    <div class="container">
        <h3 class="title">
            <img src="img/special.PNG" width="30" height="22" class="title-img"><a href="<?php echo base_url("news/index?id={$category['id_cate']}"); ?>" class="link"><?php echo $category['ten']; ?></a>
        </h3>        
   </div>

    <div class="container">
        <div class="row">
            <div class="col-md-9">
              <?php foreach($news as $new): ?>
                <?php $time = date('H:i d/m/Y', strtotime($new['ngaytao'])); ?>
                <div class="baivietphan2">
                    <div class="trai">
                        <img src="<?php echo $new['logo']; ?>" width="225" height="152">
                    </div>
                    <div class="phai">
                        <p class="title-main"> 
                            <a href="<?php echo base_url("news/detail?id={$new['id_news']}"); ?>"> <?php echo $new['tieude']; ?></a>
                        </p>
                        <p class="thoigian">
                         <?php echo $time ?> - <span><?php echo $category['ten']; ?></span>
                     </p>
                     <p class="title-small"><?php echo $new['mota']; ?></p>
                 </div>
             </div>     
                <?php endforeach; ?>
            </div><!--  end col-md-9 -->
            <div class="col-md-3">
                <div></div>
            </div><!--  end col-md-3 -->
        </div><!--  end row-->

        <div class="row">
           <?php echo $page; ?>
        </div>
    </div>
<?php } else echo '<div class="container"><h2>Chuyên mục không tồn tại</h2> <a href="' . base_url("home/index") .'" style="font-size: 16px">Quay lại trang chủ</a></div>'; ?>
</div>