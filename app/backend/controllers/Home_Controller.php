<?php
	
	class Home_Controller extends Base_Controller
	{
		function index()
		{
			$id = $_SESSION['id_user'];
			$news = [];
			$img = [];
			$cate = [];
			$user = [];
			$comment = [];
			if($_SESSION['level'] == 3)
			{
				// Thống kê bài viết
				$news[] = $this->model->tintuc->count_rows();
				$news[] = $this->model->tintuc->count_rows(['xetduyet' => '= 2']);
				$news[] = $this->model->tintuc->count_rows(['xetduyet' => '= 1']);

				// Thống kê hình ảnh
				$img[] = $this->model->hinhanh->count_rows();
				$size = 0;
				$error_img = 0;
				$size_arr = $this->model->hinhanh->select('size');
				

				foreach ($size_arr as $key => $value) 
				{
					$size += $value['size'];
				}

				if($size < 1024)
				{
					$img[] = $size . ' B';
				}
				elseif($size < 1048576)
				{
					$img[] = round($size / 1024) . ' KB';
				}
				elseif($size < 1073741824)
				{
					$img[] = round($size / 1024 / 1024) . ' MB';
				}
				else
				{
					$img[] = round($size / 1024 / 1024 / 1024) . ' GB';
				}

				$img_error = $this->model->hinhanh->select('url');
				foreach ($img_error as $key => $value) 
				{
					if(!file_exists(BASE_PATH . '/'.$value['url']))
					{
						$error_img++;
					}
				}
				$img[] = $error_img;

				// Thống kê chuyên mục
				$cate[] = $this->model->chuyenmuc->count_rows();	
				$cate[] = $this->model->chuyenmuc->count_rows(['trangthai' => '= 2']);	
				$cate[] = $this->model->chuyenmuc->count_rows(['trangthai' => '= 1']);	

				// Thống kê tài khoản
				$user[] = $this->model->taikhoan->count_rows();
				$user[] = $this->model->taikhoan->count_rows(['level' => '= 2']);
				$user[] = $this->model->taikhoan->count_rows(['level' => '= 1']);
				
				// Thống kê bình luận
				$comment[] = $this->model->binhluan->count_rows();
				$comment[] = $this->model->binhluan->count_rows(['xetduyet' => '= 2']);
				$comment[] = $this->model->binhluan->count_rows(['xetduyet' => '= 1']);
			}
			elseif($_SESSION['level'] == 2)
			{
				$news[] = $this->model->tintuc->count_rows(['id_user' => '= '.$id]);
				$news[] = $this->model->tintuc->count_rows(['id_user' => '= '.$id, 'xetduyet' => '= 2']);
				$news[] = $this->model->tintuc->count_rows(['id_user' => '= '.$id, 'xetduyet' => '= 1']);

				// Thống kê hình ảnh
				$img[] = $this->model->hinhanh->count_rows(['id_user' => '= '.$id]);
				$size = 0;
				$error_img = 0;

				$size_arr = $this->model->hinhanh->select('size', ['id_user' => '= '.$id]);
				foreach ($size_arr as $key => $value) 
				{
					$size += $value['size'];
				}

				if($size < 1024)
				{
					$img[] = $size . ' B';
				}
				elseif($size < 1048576)
				{
					$img[] = round($size / 1024) . ' KB';
				}
				elseif($size < 1073741824)
				{
					$img[] = round($size / 1024 / 1024) . ' MB';
				}
				else
				{
					$img[] = round($size / 1024 / 1024 / 1024) . ' GB';
				}

				$img_error = $this->model->hinhanh->select('url', ['id_user' => '= '.$id]);
				foreach ($img_error as $key => $value) 
				{
					if(!file_exists(BASE_PATH . '/'.$value['url']))
					{
						$error_img++;
					}
				}
				$img[] = $error_img;
			}
			$this->view->load('home/index', ['news' => $news, 'img' => $img, 'cate' => $cate, 'user' => $user, 'comment' => $comment]);
		}
	}