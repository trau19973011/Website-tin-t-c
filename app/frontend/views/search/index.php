
<div class="phan2">

    <div class="container">
        <h3 class="title">
           <img src="img/special.PNG" width="30" height="22" class="title-img"> KẾT QUẢ TÌM KIẾM
       </h3>
        <p style="padding-left: 32px; font-size: 16px;"><?php echo isset($error['error']) ? $error['error'] : ''; ?></p>
   </div>

    <div class="container">
        <div class="row">
            <div class="col-md-9">
             <?php
             if($news)
             {
                 foreach($news as $new):
            ?>
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
                         <?php echo $time ?> - <span><?php echo $new['ten']; ?></span>
                     </p>
                     <p class="title-small"><?php echo $new['mota']; ?></p>
                 </div>
             </div>     
            <?php endforeach; } ?>
            </div><!--  end col-md-9 -->
            <div class="col-md-3">
                <div></div>
            </div><!--  end col-md-3 -->
        </div><!--  end row -->
        
        <div class="row">
           <?php echo $page; ?>
        </div>
    </div> <!--  end container -->
</div>
