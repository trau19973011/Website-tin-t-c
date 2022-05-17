 <a href="<?php echo base_url('news/index'); ?>" class="btn btn-default">
    <span class="glyphicon glyphicon-arrow-left"></span> Trở về
</a> 
<a href="<?php echo base_url("news/upload?id={$news['id_news']}"); ?>" class="btn btn-default" target="_blank">
	 <span class="glyphicon glyphicon-picture"></span> Upload
</a>
<?php
	// Hiển thị lại nội dung vừa nhập
	$tieude = isset($_POST['title']) ? $_POST['title'] : '';
	$mota = isset($_POST['mota']) ? $_POST['mota'] : '';
	$logo = isset($_POST['logo']) ? $_POST['logo'] : '';
	$noidung = isset($_POST['noidung']) ? $_POST['noidung'] : '';
 ?>
<p class="form-edit-post">
        <form method="POST" id="formEditPost" class="formAlert">
            <div class="form-group">
                <label>Trạng thái bài viết</label>
                <?php if($_SESSION['level'] == 3) { ?>
                <div class="radio">
                	<label>
                		<input type="radio" name="status" value="2" <?php if($news['xetduyet'] == 2) echo 'checked'; ?>> Xuất bản
                	</label>
                </div>
                <div class="radio">
                	<label>
                		<input type="radio" name="status" value="1" <?php if($news['xetduyet'] == 1) echo 'checked'; ?>> Ẩn
                	</label>
                </div>
            	<?php 
            		} 
            		elseif($_SESSION['level'] == 2) 
            		{ 

						if($news['xetduyet'] == 1) echo '<br><label class="label label-warning">Chưa duyệt</label>';
						elseif($news['xetduyet'] == 2) echo '<br><label class="label label-success">Đã duyệt</label>';
            	    }
            	?>
            </div>
             <div class="form-group">
                <label>Tiêu đề bài viết</label>
                <input type="text" class="form-control" value="<?php echo !empty($news['tieude']) ? $news['tieude'] : $tieude; ?>" name="title">
                <?php echo isset($error['title']) ? $error['title'] : ''; ?>
            </div>
            <div class="form-group">
                <label>Mô tả bài viết</label>
                <textarea name="mota" class="form-control"><?php echo !empty($news['mota']) ? $news['mota'] : $mota; ?></textarea>
                  <?php echo isset($error['mota']) ? $error['mota'] : ''; ?>
            </div>
            <div class="form-group">
                <label>Ảnh đại diện</label>
                <input type="text" class="form-control" value="<?php echo !empty($news['logo']) ? $news['logo'] : $logo; ?>" name="logo" id="logo">
                  <?php echo isset($error['logo']) ? $error['logo'] : ''; ?>

            </div>            
            <div class="form-group">
                <label>Chuyên mục</label>
                <select class="form-control" name="cate">
                <?php foreach($cate as $value): ?>
                	<option value="<?php echo $value['id_cate']; ?>" <?php if($value['id_cate'] == $news['id_cate']) echo 'selected'; ?> ><?php echo $value['ten']; ?></option>
                <?php endforeach; ?>
               	</select>
            </div>
            <div class="form-group">
                <label>Nội dung bài viết</label>
                <textarea name="noidung" class="form-control"><?php echo !empty($news['noidung']) ? $news['noidung'] : $noidung; ?></textarea>
                  <?php echo isset($error['noidung']) ? $error['noidung'] : ''; ?>
                <script type="text/javascript">
                	CKEDITOR.replace('noidung');
                </script>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" value="ok" class="btn btn-primary">Lưu thay đổi</button>
            </div>
            <div class="alert alert-danger hidden"></div>
        </form>
    </p>