<?php 
	
	class Ajax_Controller extends Core_Controller
	{
		function add_comment()
		{		
			if(isset($_POST['action']) && $_POST['action'] == 'add_comment')
			{
				// Biến thông báo
				$success = '<script> $("#formComment .alert").attr("class", "alert alert-success"); </script>';
				$error = '<script> $("#formComment .alert").attr("class", "alert alert-danger"); </script>';
				if(isset($_SESSION['id_user']))
				{
					$id = postParameter('id');
					$comment = postParameter('comment');
					if(!preg_match('/^[\W\w]{6,100}$/', $comment))
					{
						echo $error.'Nội dung bình luận không hợp lệ: Phải từ 6 - 100 kí tự';
					}
					else
					{
						$check = $this->model->binhluan->insert(['noidung' => $comment, 'id_news' => $id, 'id_user' => $_SESSION['id_user']]);

						if($check)
						{
							echo $success . 'Bình luận thành công, vui lòng đợi xét duyệt !';
						}
					}		
				}
				else
				{
					echo $error.'Bạn phải đăng nhập mới sử dụng được chức năng này ' . '<a href="'. base_url('dangnhap/index') .'">Đăng nhập ngay</a>';
					
				}
			}
		}
	}