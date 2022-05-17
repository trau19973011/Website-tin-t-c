<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="public/bootstrap-3.3.7-dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . '/public/css/style.css'; ?>">
</head>
<body>
	<div class="tong">

		<?php echo $menu; ?>
		
		<?php echo $content; ?>

		<?php echo $footer; ?>

	</div>
    <script src="Public/bootstrap-3.3.7-dist/js/jquery-3.2.1.js"></script>
    <script src="Public/bootstrap-3.3.7-dist/js/bootstrap.js"></script>
    <script src="Public/bootstrap-3.3.7-dist/js/1.js"></script>
</body>
</html>
