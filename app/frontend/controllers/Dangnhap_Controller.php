<?php 
	
	class Dangnhap_Controller extends Base_Controller
	{
		function index()
		{

			$data = $this->dangnhap();

			// Gán title
			$this->title = 'Đăng nhập';

			$this->view->load('dangnhap/index', ['data' => $data]);
		}

		function logout()
		{
			session_destroy();
			redirect('home/index');
		}

		function dangnhap()
		{
			// Lấy url trang trước
			if(!isset($_SESSION['url']))
			{
				$_SESSION['url'] = $_SERVER['HTTP_REFERER'];
			}
			$url = $_SESSION['url'];

			$data = [];
			if(isset($_POST['ok']))
			{
				$user = postParameter('user');
				$pass = postParameter('pass');

				$check = $this->model->taikhoan->dangnhap($user, $pass);
				if($check)
				{
					$_SESSION['id_user'] = $check['id_user'];
					$_SESSION['user'] = $check['tenhienthi'];
					$_SESSION['level'] = $check['level'];
					header("location: $url");
					exit();
				}
				else
				{
					$data['error'] = 'Tài khoản hoặc mật khẩu không đúng';
				}
			}

			return $data;
		}
	}