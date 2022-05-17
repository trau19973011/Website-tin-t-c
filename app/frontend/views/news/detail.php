
     <div class="content">
        <div class="container">
            <?php if($news) { ?>
            <div class="row">
                <div class="col-md-8 baiviet">
                    <h1 class="tieude"><?php echo $news['tieude']; ?></h1>
                    <p class="tacgia">
                        <span class="ten"> <?php echo $tacgia['tenhienthi']; ?> </span>
                        <?php $time = date('H:i d/m/Y', strtotime($news['ngaytao'])); ?>
                        <span class="thoigian">đăng lúc <?php echo $time; ?></span>
                    </p>
                    <h4 class="mota"><?php echo $news['mota']; ?></h4>
                    <div class="noidung"><?php echo $news['noidung']; ?></div>
                </div> <!-- end col-md-8 -->
                <div class="col-md-4">
                    <div class="ads">Quảng cáo </div>
                    <div class="ads">Quảng cáo </div>
                    <div class="tinlienquan">
                        <h3>Đọc tiếp</h3>
                        <?php foreach($news1 as $new): ?>
                        <div class="tin">
                            <img src="<?php echo $new['logo']; ?>" class="img-responsive">
                            <p class="mota"><a href="<?php echo base_url("news/detail?id={$new['id_news']}"); ?>"> <?php echo $new['tieude']; ?></a></p>
                        </div>       
                        <?php endforeach; ?>         
                    </div>
                </div>

            </div><!-- end row -->

            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 form-comment">
                            <form method="post" id="formComment">
                                <textarea name="comment" class="form-control" rows="3" placeholder="Bạn nghĩ gì về tin này?" id="comment"></textarea>
                                <input type="hidden" id="id_news" value="<?php echo $news['id_news']; ?>">
                                <div class="alert alert-danger hidden"></div>
                                <button class="btn btn-primary" name="ok" value="Gửi bình luận">Gửi bình luận</button>
                            </form>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div> <!-- form binh luan -->

            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 list-comment">
                            <?php foreach($comments as $comment): ?>
                            <?php $time = date('H:i d/m/Y', strtotime($comment['thoigian'])); ?>
                            <div class="comment">
                                <img src="img/user.png">
                                <div class="binhluan">
                                    <?php
                                        if($comment['level'] == 2)
                                        {
                                            $status = '<span class="label label-success">Tác giả</span>';
                                        }
                                        elseif($comment['level'] == 3)
                                        {
                                            $status = '<span class="label label-warning">Admin</span>';
                                        }
                                        elseif($comment['level'] == 1)
                                        {
                                            $status = '<span class="label label-primary">Thành viên</span>';
                                        }
                                     ?>
                                    <p class="ten"><?php echo $comment['tenhienthi'] . ' ' . $status; ?><span> <?php echo $time; ?></span></p>
                                    <p class="nd"><?php echo $comment['noidung']; ?> </p>
                                </div>
                            </div> 
                            <?php endforeach; ?>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div> <!-- danh sach binh luan -->
        <?php  } else echo '<div><h2>Bài viết không tồn tại</h2> <a href="' . base_url("home/index") .'">Quay lại trang chủ</a></div>';  ?>

        </div> <!-- end container -->
    </div> <!-- content -->