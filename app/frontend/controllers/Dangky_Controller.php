<?php
	
	class Dangky_Controller extends Base_Controller
	{
		function index()
		{	
			$data = $this->dangky();

			// Gán title
			$this->title = 'Đăng ký';

			$this->view->load('dangky/index', ['data' => $data]);
		}

		function dangky()
		{
			$data = [];

			if(isset($_POST['ok']))
			{
				$user = postParameter('user');
				$pass = postParameter('pass');
				$email = postParameter('email');
				$sodt = postParameter('sodt');
				$tenhienthi = postParameter('tenhienthi');

				// Kiểm tra user
				if(!preg_match('/^[a-z]{1}[a-z0-9]{5,31}$/', $user))
				{
					$data['err_user'] = 'Tài khoản không hợp lệ';
				}
				if(!preg_match('/^[\w\W]{6,50}$/', $pass))
				{
					$data['err_pass'] = 'Mật khẩu không hợp lệ';
				}
				if(!preg_match('/^([a-z0-9.]{3,50})@([a-z]+)\.([a-z]+)$/', $email))
				{
					$data['err_email'] = 'Email không hợp lệ';
				}
				if(!preg_match('/^[0][78935]([0-9]{8})$/', $sodt))
				{
					$data['err_sodt'] = 'Số điện thoại không hợp lệ';
				}
				if(!preg_match('/^[a-zA-Z\s]{3,32}$/', $tenhienthi))
				{
					$data['err_tenhienthi'] = 'Tên hiển thị không hợp lệ';
				}

				if(!$data)
				{
					$check = $this->model->taikhoan->find_by_id('taikhoan', $user);
					if($check)
					{
						$data['err_user'] = 'Tài khoản đã tồn tại';
					}
					else
					{
						$insert = $this->model->taikhoan->insert(['taikhoan' => $user, 'matkhau' => $pass, 'dienthoai' => $sodt, 'email' => $email, 'tenhienthi' => $tenhienthi]);
						if($insert)
						{
							$_POST['user'] = $_POST['pass'] = $_POST['email'] = $_POST['sodt'] = $_POST['tenhienthi'] = '';
							$data['success'] = "Đăng ký thành công ! " . '<a href="'. base_url('dangnhap/index') .'"> Đăng nhập ngay </a>';
						}
					}
					
				}
			}

			return $data;
		}
	}