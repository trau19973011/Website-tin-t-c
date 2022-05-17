<div class="tincapnhat">
    <div class="container">
        <div class="hot-news">
            <p>TIN HOT TRONG NGÀY</p>
            <ul>
                <?php foreach($hot_news as $value):  ?>
                <li class="hidden"><a href="<?php echo base_url("news/detail?id={$value['id_news']}"); ?>"> <?php echo $value['tieude']; ?> </a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <h3 class="title">
             <img src="img/special.PNG" width="30" height="22" class="title-img">TIN MỚI
        </h3>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-md-3 left">
               <?php foreach($news as $key => $new): ?>
                <?php
                if($key == 0)
                {
                    continue;
                }

                if($key == 6)
                {
                    break;
                }
                ?>
                <div class="boc-left">
                    <div class="img-left"><img src="<?php echo $new['logo']; ?>" width="120px" height="80px"></div>
                    <p class="title-small">
                        <a href="<?php echo base_url("news/detail?id={$new['id_news']}"); ?>"title=""><?php echo $new['tieude']; ?></a>
                    </p>
                </div>
                <?php endforeach; ?>
            </div><!--  end col-left -->

            <div class="col-md-6 middle">
                <div class="img-middle">
                   <img src="<?php echo $news[0]['logo']; ?>">
                </div>
                <h1 class="title-main">
                    <a href="<?php echo base_url("news/detail?id={$news[0]['id_news']}"); ?>"><?php echo $news[0]['tieude']; ?></a>
                </h1>  
                <p class="title-small" ><?php echo $news[0]['mota']; ?></p>
            </div> <!--  end col-middle -->

            <div class="col-md-3 right">
                <?php foreach($news as $key => $new): ?>
                    <?php
                    if($key < 6)
                    {
                        continue;
                    }
                    ?>
                    <div class="img" >
                        <img src="<?php echo $new['logo']; ?>"> 
                        <p class="title-small">
                           <a href="<?php echo base_url("news/detail?id={$new['id_news']}"); ?>"><?php echo $new['tieude']; ?></a>
                       </p>
                   </div>
               <?php endforeach; ?>          
            </div> <!--  end col-right -->
        </div><!--  end row -->
    </div><!--  end container -->
</div> <!-- cac tin moi nhat -->
