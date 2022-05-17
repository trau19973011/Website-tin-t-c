
<div class="phan3">
    <div class="container">
        <div class="row">
         <?php foreach($tinchuyenmuc as $cate => $news): ?>
            <?php 
             if($news)
                {
             ?>
            <div class="col-md-3 goc1">
                <h3 class="title">
                    <img src="img/special.PNG" width="30" height="22" class="title-img"><a href="<?php echo base_url("news/index?id={$news[0]['id_cate']}"); ?>" class="link"><?php echo $cate; ?></a>
                </h3>        
                <img src="<?php echo $news[0]['logo']; ?>" width="262" height="172">
                <div class="tieudegoc">
                    <a href="<?php echo base_url("news/detail?id={$news[0]['id_news']}"); ?>">
                        <?php echo $news[0]['tieude']; ?>
                    </a>
                </div>
                <hr>
                <?php foreach($news as $key => $new): ?>
                    <?php
                    if($key == 0) continue; 
                    ?>
                    <div class="gocnho">
                        <img src="<?php echo $new['logo']; ?>" width="105px" height="70px">
                        <div class="tieudegoc-nho">
                            <a href="<?php echo base_url("news/detail?id={$new['id_news']}"); ?>" style="font-size: 13px"><?php echo $new['tieude']; ?></a>
                        </div>
                    </div>
                <?php   endforeach; ?>
            </div> <!-- end goc1 -->
            <?php } endforeach; ?>
        </div>
    </div>   
</div> <!-- Tin theo chuyên mục phần 1 -->
