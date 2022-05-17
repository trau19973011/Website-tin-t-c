<?php 
	
	class Ajax_Controller extends Core_Controller
	{
		// Xóa nhiều bài viết
		function del_post_list()
		{
			if(isset($_POST['action']) && $_POST['action'] == 'del_post_list')
			{
				foreach ($_POST['id_news'] as $id_news) 
				{
					$check_id_news = $this->model->tintuc->select('id_news', ['id_news' => '= '.(int)$id_news]);
					if($check_id_news)
					{

						// Xóa hình ảnh của bài viết
						$check_id_img = $this->model->hinhanh->select('id_img,url', ['id_news' => '= '.(int)$id_news]);
						if($check_id_img)
						{
							foreach ($check_id_img as $value) 
							{
								if(file_exists(BASE_PATH . "/{$value['url']}"))
								{
									unlink(BASE_PATH . "/{$value['url']}");
								}
							}
						}
						// Xóa bài viết
						$this->model->tintuc->delete('id_news', $id_news);
					}
				}
				
			}
			else
			{
				redirect('home/index');
			}
		}
		// Xóa 1 bài viết
		function del_post()
		{
			if(isset($_POST['action']) && $_POST['action'] == 'del_post')
			{
				$id_news = postParameter('id_news');
				$check_id_news = $this->model->tintuc->select('id_news', ['id_news' => '= '.(int)$id_news]);
				if($check_id_news)
				{
					// Xóa hình ảnh của bài viết
					$check_id_img = $this->model->hinhanh->select('id_img,url', ['id_news' => '= '.(int)$id_news]);
					if($check_id_img)
					{
						foreach ($check_id_img as $value) 
						{
							if(file_exists(BASE_PATH . "/{$value['url']}"))
							{
								unlink(BASE_PATH . "/{$value['url']}");
							}
						}
					}
					$this->model->tintuc->delete('id_news', $id_news);
				}
				
			}
			else
			{
				redirect('home/index');
			}
		}

		// Xóa nhiều ảnh
		function del_list_img()
		{
			if(isset($_POST['action']) && $_POST['action'] == 'del_list_img')
			{
				foreach($_POST['id_img'] as $value)
				{
					$check = $this->model->hinhanh->select('id_img,url', ['id_img' => '= '.(int)$value]);
					if($check)
					{
						if(file_exists(BASE_PATH . "/{$check[0]['url']}"))
						{
							unlink(BASE_PATH . "/{$check[0]['url']}");
						}
						$this->model->hinhanh->delete('id_img', $value);
					}
				}
			}
			else
			{
				redirect('home/index');
			}
		}
		// Xóa 1 ảnh
		function del_img()
		{	

			if(isset($_POST['action']) && $_POST['action'] == 'del_img')
			{
				$id_img = postParameter('id_img');
				$check = $this->model->hinhanh->select('id_img,url', ['id_img' => '= '.(int)$id_img]);
				if($check)
				{
					if(file_exists(BASE_PATH . "/{$check[0]['url']}"))
					{
						unlink(BASE_PATH . "/{$check[0]['url']}");
					}
					$this->model->hinhanh->delete('id_img', $id_img);
				}
			}
			else
			{
				redirect('home/index');
			}
		}

		// Xóa nhiều user
		function del_user_list()
		{
			if(isset($_POST['action']) && $_POST['action'] == 'del_user_list')
			{
				foreach($_POST['id_user'] as $id_user)
				{
					$check = $this->model->taikhoan->select('id_user',['id_user' => '= '.(int)$id_user]);
					if($check)
					{
						// Xóa hình ảnh của các user
						$imgs = $this->model->hinhanh->select('url', ['id_user' => '= '.(int)$id_user]);
						if($imgs)
						{
							foreach ($imgs as$value) 
							{
								if(file_exists(BASE_PATH . "/{$value['url']}"))
								{
									unlink(BASE_PATH . "/{$value['url']}");
								}
							}
						}
						// Xoa tai khoan
						$this->model->taikhoan->delete('id_user', $id_user);
					}
				}
			}
			else
			{
				redirect('home/index');
			}
		}
		// Xóa 1 user
		function del_user()
		{
			if(isset($_POST['action']) && $_POST['action'] == 'del_user')
			{
				$id_user = (int)postParameter('id_user');
				$check = $this->model->taikhoan->select('id_user',['id_user' => '= '.$id_user]);
				if($check)
				{
					// Xóa hình ảnh của user
					$imgs = $this->model->hinhanh->select('url', ['id_user' => '= '.$id_user]);
					if($imgs)
					{
						foreach($imgs as $value)
						{
							if(file_exists(BASE_PATH . "/{$value['url']}"))
							{
								unlink(BASE_PATH . "/{$value['url']}");
							}
						}
					}
					// Xóa user
					$this->model->taikhoan->delete('id_user', $id_user);
				}
			}
			else
			{
				redirect('home/index');
			}
		}

		// Xóa nhiều chuyên mục
		function del_cate_list()
		{
			if(isset($_POST['action']) && $_POST['action'] == 'del_cate_list')
			{
				foreach($_POST['id_cate'] as $id_cate)
				{
					$check = $this->model->chuyenmuc->select('id_cate',['id_cate' => '= '.(int)$id_cate]);
					if($check)
					{
						// Xoa chuyên mục
						$this->model->chuyenmuc->delete('id_cate', $id_cate);
					}
				}
			}
			else
			{
				redirect('home/index');
			}
		}
		// Xóa 1 chuyên mục
		function del_cate()
		{
			if(isset($_POST['action']) && $_POST['action'] == 'del_cate')
			{
				$id_cate = (int)postParameter('id_cate');

				$check = $this->model->chuyenmuc->select('id_cate',['id_cate' => '= '.$id_cate]);
				if($check)
				{
					// Xoa chuyên mục
					$this->model->chuyenmuc->delete('id_cate', $id_cate);
				}
			}
			else
			{
				redirect('home/index');
			}
		}

		// Xóa nhiều comment
		function del_comment_list()
		{
			if(isset($_POST['action']) && $_POST['action'] == 'del_comment_list')
			{
				foreach($_POST['id_cm'] as $id_cm)
				{
					$check = $this->model->binhluan->select('id_cm',['id_cm' => '= '.(int)$id_cm]);
					if($check)
					{
						// Xoa chuyên mục
						$this->model->binhluan->delete('id_cm', $id_cm);
					}
				}
			}
			else
			{
				redirect('home/index');
			}
		}
		// Xóa 1 comment
		function del_comment()
		{
			if(isset($_POST['action']) && $_POST['action'] == 'del_comment')
			{
				$id_cm = (int)postParameter('id_cm');
				$check = $this->model->binhluan->select('id_cm',['id_cm' => '= '.$id_cm]);
				if($check)
				{
					// Xoa chuyên mục
					$this->model->binhluan->delete('id_cm', $id_cm);
				}
			}
			else
			{
				redirect('home/index');
			}
		}
		// Duyệt nhiều comment
		function accept_comment_list()
		{
			if(isset($_POST['action']) && $_POST['action'] == 'accept_comment_list')
			{
				foreach($_POST['id_cm'] as $id_cm)
				{
					$check = $this->model->binhluan->select('id_cm',['id_cm' => '= '.(int)$id_cm]);
					if($check)
					{
						// Duyệt chuyên mục
						$this->model->binhluan->update(['xetduyet' => 2], "id_cm = $id_cm");
					}
				}
			}
			else
			{
				redirect('home/index');
			}
		}
		// Duyệt 1 comment
		function accept_comment()
		{
			if(isset($_POST['action']) && $_POST['action'] == 'accept_comment')
			{
				$id_cm = (int)postParameter('id_cm');
				$check = $this->model->binhluan->select('id_cm',['id_cm' => '= '.$id_cm]);
				if($check)
				{
					// Duyệt chuyên mục
					$this->model->binhluan->update(['xetduyet' => 2], "id_cm = $id_cm");
				}
			}
			else
			{
				redirect('home/index');
			}
		}
	}