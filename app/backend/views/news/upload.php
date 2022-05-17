<div class="list">
	<h3>Hình ảnh cho bài viết</h3>
	<a href="<?php echo base_url("news/upload?id={$_GET['id']}") ?>" class="btn btn-default">
		<span class="glyphicon glyphicon-repeat"></span> Reload
	</a>
	<?php
		$url = str_replace('admin.php', '', BASE_URL);
		if($images) 
		{
	 ?> 
	<a class="btn btn-danger" id="del_img_list">
		<span class="glyphicon glyphicon-trash"></span> Xoá
	</a> 
	<div class="checkbox"><label><input type="checkbox"> Chọn/Bỏ chọn tất cả</label></div>
	<div class="row">
		 <?php 	
		 	foreach ($images as $value): 
		 		// Kiểm tra ảnh có tồn tại k
		 		if(file_exists(BASE_PATH . "/{$value['url']}"))
		 		{
		 			$status = '<label class="label label-success">Tồn tại</label>';
		 		}
		 		else
		 		{
		 			$status = '<label class="label label-danger">Hỏng</label>';
		 		}
		 		// Kiểm tra dung lượng
		 		if($value['size'] < 1024)
		 		{
		 			$size = $value['size'] . ' B';
		 		}
		 		elseif($value['size'] < 1048576)
		 		{
		 			$size = round($value['size']/1024) . ' KB';
		 		}
		 		else
		 		{
		 			$size = round($value['size']/1024/1024) . ' MB';
		 		}
		 		// Kiểm tra type
		 		$type = explode('/', $value['type']);
		 ?>
	 		<div class="col-md-3">
	            <div class="thumbnail">
	                <a href="">
	                    <img src="<?php echo $url . $value['url']; ?>" style="height: 160px;">
	                </a>
	                <div class="caption">
	                    <div class="input-group">
	                        <span class="input-group-addon">
	                            <input type="checkbox" name="id_img[]" value="<?php echo $value['id_img']; ?>">
	                        </span>
	                        <input type="text" class="form-control" value="<?php echo $url . "{$value['url']}"; ?>" disabled="">
	                        <span class="input-group-btn">
	                            <button class="btn btn-danger del-img" data-id="<?php echo $value['id_img']; ?>">
	                                <span class="glyphicon glyphicon-trash"></span>
	                            </button>
	                        </span>
	                    </div>
	                    <p style="margin-top: 10px">Trạng thái: <?php echo $status; ?></p>
	                    <p>Dung lượng: <?php echo $size; ?></p>
	                    <p>Định dạng: <?php echo strtoupper($type[1]); ?></p>
	                </div>
	            </div>
	        </div>   
		<?php endforeach; } else echo '<p class="error"> Không có hình ảnh nào</p>';?>

		<div class="col-md-12 form-up-img" style="margin-top: 32px">
	        <form method="POST" id="formUpImg" enctype="multipart/form-data">
	            <div class="form-group">
	                <label>Chọn hình ảnh</label>
	                <div class="alert alert-info">Mỗi lần upload tối đa 10 file ảnh. Mỗi file có dung lượng không vượt quá 5MB và có đuôi định dạng là .jpg, .png, .gif., </div>
	                <input type="file" class="form-control" accept="image/*" name="img_up[]" multiple="true">
	            </div>

	            <?php
	            	echo isset($error['soluong']) ? "<p class='error'><span class='glyphicon glyphicon-arrow-right'></span> {$error['soluong']}</p>" : '';
	            	echo isset($error['size']) ? "<p class='error'><span class='glyphicon glyphicon-arrow-right'></span> {$error['size']}</p>" : '';
	            	echo isset($error['type']) ? "<p class='error'><span class='glyphicon glyphicon-arrow-right'></span> {$error['type']}</p>" : '';
	           	?>
	            <div class="form-group">
	                <button type="submit" class="btn btn-primary">Upload</button>
	                <button class="btn btn-default" type="reset">Chọn lại</button>
	            </div>
	        </form>
	    </div>
	</div>
</div>
