$_DOMAIN = 'http://localhost:8080/webtintuc/'

/***** HOME INDEX *****/
var i = 0;
setInterval(function(){
	if(i == 5)
	{
		i = 0;
	}
	$('.hot-news ul li').addClass('hidden');
	$li = $('.hot-news ul li:eq(' + i  + ')');
	$li.removeClass('hidden');
	i++;
},2000);

/***** END HOME INDEX *****/

// Bỏ margin của thẻ p chứa img trong bài viết.
$('.content p img').parent().css({'margin': '0'});

/***** COMMENT *****/
$('#formComment button').on('click', function(){
	$this = $('#formComment button');

	$this.html('Đang tải...');

	$comment = $('#formComment #comment').val();
	$id = $('#formComment #id_news').val();
	$.ajax({
		url: $_DOMAIN + '?module=ajax&action=add_comment',
		type: 'POST',
		data: {
			id: $id,
			action: 'add_comment',
			comment : $comment
		},
		success: function(data){
			$('#formComment .alert').removeClass('hidden');
			$('#formComment .alert').html(data);
			$this.html('Gửi bình luận');
		},
		error: function()
		{
			$('#formComment .alert').removeClass('hidden');
			$('#formComment .alert').html('Không thể bình luận vào lúc này');
			$this.html('Gửi bình luận');
		}
	});
	return false;
});
$('#formComment textarea').on('click', function(){
	$('#formComment .alert').addClass('hidden');
});

/***** END COMMENT *****/

/***** ẨN THÔNG BÁO LỖI *****/
$('.formAlert input').on('click', function(){
	$('.formAlert .alert').addClass('hidden');
	$('.formAlert .label').addClass('hidden');
});
$('.formAlert textarea').on('click', function(){
	$('.formAlert .alert').addClass('hidden');
});

/***** END *****/

/**************** ADMIN ***************/
/* CHECK BOX */
$('.list input[type="checkbox"]:eq(0)').on('change', function(){
	$('.list input[type="checkbox"]').prop('checked', $(this).prop('checked'));
});

/* XÓA BÀI VIẾT */
// Xóa nhiều bài viết
$('#del_post_list').on('click', function(){
	$confirm = confirm('Bạn có chắc chắn muốn xóa các bài viết đã chọn ?');

	if($confirm == true)
	{
		$id_news = [];
		$('#list_post input[type="checkbox"]:checked').each(function(i){
			$id_news[i] = $(this).val();
		});

		if($id_news.length == 0)
		{
			alert('Vui lòng chọn ít nhất 1 bài viết');
		}
		else
		{
			$.ajax({
				url: $_DOMAIN + 'admin.php?module=ajax&action=del_post_list',
				type: 'POST',
				data: {
					id_news: $id_news,
					action: 'del_post_list'
				},
				success: function(data){
					location.reload();
				},
				error: function(){
					alert('Đã có lỗi xảy ra vui lòng thử lại sau');
				}
			});
		}
	}
	else
	{
		return false;
	}
});
// XÓA 1 BÀI VIẾT
$('.del-post-list').on('click', function(){
	$confirm = confirm('Bạn có chắc chắn muốn xóa bài viết này ?');

	if($confirm == true)
	{
		$id_news = $(this).attr('data-id');

			$.ajax({
				url: $_DOMAIN + 'admin.php?module=ajax&action=del_post',
				type: 'POST',
				data: {
					id_news: $id_news,
					action: 'del_post'
				},
				success: function(data){
					location.reload();
				},
				error: function(){
					alert('Đã có lỗi xảy ra vui lòng thử lại sau');
				}
			});
	}
	else
	{
		return false;
	}
});

/* XÓA HÌNH ẢNH */
// Xóa nhiều hình ảnh
$('#del_img_list').on('click', function(){
	$confirm = confirm('Bạn có chắc chắn muốn xóa các ảnh này ?');

	if($confirm == true)
	{
		$id_img = [];

		$('.list input[type=checkbox]:checked').each(function(i){
			$id_img[i] = $(this).val();
		});

		if($id_img.length == 0)
		{
			alert('Vui lòng chọn ít nhất 1 ảnh');
		}
		else
		{
			$.ajax({
				url: $_DOMAIN + 'admin.php?module=ajax&action=del_list_img',
				type: 'POST',
				data: {
					id_img: $id_img,
					action: 'del_list_img'
				},
				success: function(data){
					location.reload();
				},
				error: function(){
					alert('Đã có lỗi xảy ra vui lòng thử lại sau');
				}
			});
		}
	}
	return false;
});
// Xóa 1 hình ảnh
$('.del-img').on('click', function(){
	$confirm = confirm('Bạn có chắc chắn muốn xoá ảnh này ?');

	if($confirm == true)
	{
		$id_img = $(this).attr('data-id');

			$.ajax({
				url: $_DOMAIN + 'admin.php?module=ajax&action=del_img',
				type: 'POST',
				data: {
					id_img: $id_img,
					action: 'del_img'
				},
				success: function(data){
					location.reload();
				},
				error: function(){
					alert('Đã có lỗi xảy ra vui lòng thử lại sau');
				}
			});
	}
	return false;
});

/* XÓA USER */
// Xóa nhiều user
$('#del_user_list').on('click',function(){
	$confirm = confirm('Bạn có chắc chắn muốn xóa các tài khoản này ?');

	if($confirm == true)
	{
		$id_user = [];

		$('.list input[type=checkbox]:checked').each(function(i){
			$id_user[i] = $(this).val();
		});

		if($id_user.length == 0)
		{
			alert('Vui lòng chhọn ít nhất 1 tài khoản');
		}
		else
		{
			$.ajax({
				url: $_DOMAIN + 'admin.php?module=ajax&action=del_user_list',
				type: 'POST',
				data: {
					action: 'del_user_list',
					id_user: $id_user
				},
				success: function(data){
					location.reload();
				},
				error: function(){
					alert('Đã có lỗi xảy ra vui lòng thử lại sau');
				}
			});
		}
	}
	return false;
});
// Xóa 1 user
$('.del-user').on('click',function(){
	$confirm = confirm('Bạn có chắc chắn muốn xóa tài khoản này ?');

	if($confirm == true)
	{
		$id_user = $(this).attr('data-id');

		$.ajax({
			url: $_DOMAIN + 'admin.php?module=ajax&action=del_user',
			type: 'POST',
			data: {
				action: 'del_user',
				id_user: $id_user
			},
			success: function(data){
				location.reload();
			},
			error: function(){
				alert('Đã có lỗi xảy ra vui lòng thử lại sau');
			}
		});
	}
	return false;
});

/* XÓA CHUYÊN MỤC */
// Xóa nhiều chuyên mục
$('#del_cate_list').on('click',function(){
	$confirm = confirm('Bạn có chắc chắn muốn xóa các chuyên mục này ?');

	if($confirm == true)
	{
		$id_cate = [];

		$('.list input[type=checkbox]:checked').each(function(i){
			$id_cate[i] = $(this).val();
		});

		if($id_cate.length == 0)
		{
			alert('Vui lòng chhọn ít nhất 1 chuyên mục');
		}
		else
		{
			$.ajax({
				url: $_DOMAIN + 'admin.php?module=ajax&action=del_cate_list',
				type: 'POST',
				data: {
					action: 'del_cate_list',
					id_cate: $id_cate
				},
				success: function(data){
					location.reload();
				},
				error: function(){
					alert('Đã có lỗi xảy ra vui lòng thử lại sau');
				}
			});
		}
	}
	return false;
});
// Xóa 1 chuyên mục
$('.del-cate').on('click',function(){
	$confirm = confirm('Bạn có chắc chắn muốn xóa chuyên mục này ?');

	if($confirm == true)
	{
		$id_cate = $(this).attr('data-id');

		$.ajax({
			url: $_DOMAIN + 'admin.php?module=ajax&action=del_cate',
			type: 'POST',
			data: {
				action: 'del_cate',
				id_cate: $id_cate
			},
			success: function(data){
				location.reload();
			},
			error: function(){
				alert('Đã có lỗi xảy ra vui lòng thử lại sau');
			}
		});
	}
	return false;
});

/* BÌNH LUẬN */ 
// Xóa nhiều bình luận
$('#del_comment_list').on('click',function(){
	$confirm = confirm('Bạn có chắc chắn muốn xóa các bình luận này ?');

	if($confirm == true)
	{
		$id_cm = [];

		$('.list input[type=checkbox]:checked').each(function(i){
			$id_cm[i] = $(this).val();
		});

		if($id_cm.length == 0)
		{
			alert('Vui lòng chhọn ít nhất 1 bình luận');
		}
		else
		{
			$.ajax({
				url: $_DOMAIN + 'admin.php?module=ajax&action=del_comment_list',
				type: 'POST',
				data: {
					action: 'del_comment_list',
					id_cm: $id_cm
				},
				success: function(data){
					location.reload();
				},
				error: function(){
					alert('Đã có lỗi xảy ra vui lòng thử lại sau');
				}
			});
		}
	}
	return false;
});
// Xóa 1 bình luận
$('.del-comment').on('click',function(){
	$confirm = confirm('Bạn có chắc chắn muốn xóa bình luận này ?');

	if($confirm == true)
	{
		$id_cm = $(this).attr('data-id');

			$.ajax({
				url: $_DOMAIN + 'admin.php?module=ajax&action=del_comment',
				type: 'POST',
				data: {
					action: 'del_comment',
					id_cm: $id_cm
				},
				success: function(data){
					location.reload();
				},
				error: function(){
					alert('Đã có lỗi xảy ra vui lòng thử lại sau');
				}
			});
	}
	return false;
});
// Duyệt nhiều bình luận
$('#accept_comment_list').on('click',function(){
	$confirm = confirm('Bạn có muốn duyệt các bình luận này ?');

	if($confirm == true)
	{
		$id_cm = [];

		$('.list input[type=checkbox]:checked').each(function(i){
			$id_cm[i] = $(this).val();
		});

		if($id_cm.length == 0)
		{
			alert('Vui lòng chhọn ít nhất 1 bình luận');
		}
		else
		{
			$.ajax({
				url: $_DOMAIN + 'admin.php?module=ajax&action=accept_comment_list',
				type: 'POST',
				data: {
					action: 'accept_comment_list',
					id_cm: $id_cm
				},
				success: function(data){
					location.reload();
				},
				error: function(){
					alert('Đã có lỗi xảy ra vui lòng thử lại sau');
				}
			});
		}
	}
	return false;
});
// Duyệt 1 bình luận
$('.accept-comment').on('click',function(){
	$confirm = confirm('Bạn có muốn duyệt bình luận này ?');

	if($confirm == true)
	{
		$id_cm = $(this).attr('data-id');

			$.ajax({
				url: $_DOMAIN + 'admin.php?module=ajax&action=accept_comment',
				type: 'POST',
				data: {
					action: 'accept_comment',
					id_cm: $id_cm
				},
				success: function(data){
					location.reload();
				},
				error: function(){
					alert('Đã có lỗi xảy ra vui lòng thử lại sau');
				}
			});
	}
	return false;
});