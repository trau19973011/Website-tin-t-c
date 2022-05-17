
	<div class="row">
		<div class="col-md-4">
			<div class="alert alert-info">
				<h1><?php echo $news[0]; ?></h1>
          		<p>Tổng bài viết</p>
        	</div>
		</div>		
		<div class="col-md-4">
			<div class="alert alert-success">
				<h1><?php echo $news[1]; ?></h1>
          		<p>Bài viết xuất bản</p>
        	</div>
		</div>		
		<div class="col-md-4">
			<div class="alert alert-warning">
				<h1><?php echo $news[2]; ?></h1>
          		<p>Chưa xét duyệt</p>
        	</div>
		</div>
	</div> <!-- thong ke bai viet -->

	<?php
		if($_SESSION['level'] == 3)
		{
	 ?>
	 <div class="row">
	 	<div class="col-md-4">
	 		<div class="alert alert-info">
	 			<h1><?php echo $cate[0]; ?></h1>
	 			<p>Tổng chuyên mục</p>
	 		</div>
	 	</div>		
	 	<div class="col-md-4">
	 		<div class="alert alert-success">
	 			<h1><?php echo $cate[1]; ?></h1>
	 			<p>Chuyên mục hiển thị</p>
	 		</div>
	 	</div>		
	 	<div class="col-md-4">
	 		<div class="alert alert-warning">
	 			<h1><?php echo $cate[2]; ?></h1>
	 			<p>Chuyên mục ẩn</p>
	 		</div>
	 	</div>
	 </div> <!-- thong ke chuyen muc --> 
	 <div class="row">
	 	<div class="col-md-4">
	 		<div class="alert alert-info">
	 			<h1><?php echo $user[0]; ?></h1>
	 			<p>Tổng tài khoản</p>
	 		</div>
	 	</div>		
	 	<div class="col-md-4">
	 		<div class="alert alert-success">
	 			<h1><?php echo $user[1]; ?></h1>
	 			<p>Tác giả</p>
	 		</div>
	 	</div>		
	 	<div class="col-md-4">
	 		<div class="alert alert-warning">
	 			<h1><?php echo $user[2]; ?></h1>
	 			<p>Thành viên</p>
	 		</div>
	 	</div>
	 </div> <!-- thong ke tai khoan -->	 
	 <div class="row">
	 	<div class="col-md-4">
	 		<div class="alert alert-info">
	 			<h1><?php echo $comment[0]; ?></h1>
	 			<p>Tổng bình luận</p>
	 		</div>
	 	</div>		
	 	<div class="col-md-4">
	 		<div class="alert alert-success">
	 			<h1><?php echo $comment[1]; ?></h1>
	 			<p>Đã xét duyệt</p>
	 		</div>
	 	</div>		
	 	<div class="col-md-4">
	 		<div class="alert alert-warning">
	 			<h1><?php echo $comment[2]; ?></h1>
	 			<p>Chưa xét duyệt</p>
	 		</div>
	 	</div>
	 </div> <!-- thong ke binh luan -->

	<?php } ?>
	<div class="row">
		<div class="col-md-4">
			<div class="alert alert-info">
				<h1><?php echo $img[0]; ?></h1>
          		<p>Tổng hình ảnh</p>
        	</div>
		</div>		
		<div class="col-md-4">
			<div class="alert alert-success">
				<h1><?php echo $img[1]; ?></h1>
          		<p>Tổng dung lượng</p>
        	</div>
		</div>		
		<div class="col-md-4">
			<div class="alert alert-warning">
				<h1><?php echo $img[2]; ?></h1>
          		<p>Tổng ảnh lỗi</p>
        	</div>
		</div>
	</div> <!-- thong ke hinh anh -->
