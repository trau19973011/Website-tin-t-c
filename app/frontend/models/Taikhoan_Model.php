<?php
	
	class Taikhoan_Model extends Base_Model
	{
		protected $table = 'taikhoan';

		function dangnhap($user, $pass)
		{
			$query = "SELECT * FROM {$this->table} WHERE taikhoan = :user AND matkhau = :pass";
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(['user' => $user, 'pass' => $pass]); // Thuc thi query
			$data = $sth->fetch(PDO::FETCH_ASSOC); // Lấy 1 bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}
	}