<?php $url = str_replace('admin.php', '', BASE_URL);  ?>
<!DOCTYPE html>
<html>
<head>
    <title>Quản trị</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo $url . '/public/bootstrap-3.3.7-dist/css/bootstrap.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $url . '/public/css/style.css'; ?>">
    <script src="<?php echo $url . '/public/ckeditor/ckeditor.js'; ?>"></script>
</head>
<body>
	<!-- header -->
	<div class="container-fluid">
		<div class="page-header">
			<h1>Newspage <small>Administration</small></h1>
		</div><!-- div.page-header -->
	</div><!-- div.container -->

	<div class="container-fluid main">
		<div class="row">
			<div class="col-md-3 sidebar">
				<div class="list-group">
					<div class="list-group-item">
						<div class="media">
							<a class="pull-left">
								<img src="img/profile.png" class="media-object" width="64px" height="64px">
							</a>								
							<div class="media-body">
								<h4 class="media-heading"><?php echo $_SESSION['user']; ?></h4>
								<?php if($_SESSION['level'] == 3) echo '<span class="label label-warning">Quản trị viên</label'; elseif($_SESSION['level'] == 2) echo '<span class="label label-success">Tác giả</label>';?></span>
							</div>
						</div>
						 
					</div>
					<a href="<?php echo BASE_URL; ?>" class="list-group-item active">
						 <span class="glyphicon glyphicon-dashboard"></span> Bảng điều khiển
					</a>
					<a href="<?php echo base_url("news/index"); ?>" class="list-group-item">
						<span class="glyphicon glyphicon-edit"></span> Bài viết
					</a>
					<?php
						if($_SESSION['level'] == 3)
						{
					 ?>
					<a href="<?php echo base_url("user/index"); ?>" class="list-group-item">
						<span class="glyphicon glyphicon-user"></span> Tài khoản
					</a>
					<a href="<?php echo base_url("category/index"); ?>" class="list-group-item">
						 <span class="glyphicon glyphicon-tag"></span> Chuyên mục
					</a>					
					<a href="<?php echo base_url("comment/index"); ?>" class="list-group-item">
						 <span class="glyphicon glyphicon-comment"></span> Bình luận
					</a>
					<?php } ?>
					<a href="<?php echo base_url("dangxuat/index"); ?>" class="list-group-item">
						<span class="glyphicon glyphicon-off"></span> Thoát
					</a>
				</div>
			</div> <!-- end sidebar -->

			<div class="col-md-9">
				<?php echo $content; ?>
			</div><!-- end content -->
		</div>
	</div>

    <script src="<?php echo $url . '/public/bootstrap-3.3.7-dist/js/jquery-3.2.1.js'; ?>"></script>
    <script src="<?php echo $url . '/public/bootstrap-3.3.7-dist/js/bootstrap.js'; ?>"></script>
    <script src="<?php echo $url . '/public/bootstrap-3.3.7-dist/js/1.js'; ?>"></script>

	<?php
		// Kích hoạt tab
		if(!empty($_GET['module']))
		{
			echo '<script> $(".sidebar a:eq(1)").removeClass("active"); </script>';
			if($_GET['module'] == 'news')
			{
				echo '<script> $(".sidebar a:eq(2)").addClass("active"); </script>';
			}
			elseif($_GET['module'] == 'user')
			{
				echo '<script> $(".sidebar a:eq(3)").addClass("active"); </script>';
			}
			elseif($_GET['module'] == 'category')
			{
				echo '<script> $(".sidebar a:eq(4)").addClass("active"); </script>';
			}			
			elseif($_GET['module'] == 'comment')
			{
				echo '<script> $(".sidebar a:eq(5)").addClass("active"); </script>';
			}
		}
	 ?>
</body>
</html>
