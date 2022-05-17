<?php
	
	class Taikhoan_Model extends Base_Model
	{
		protected $table = 'taikhoan';


		function list_user($start, $limit)
		{
			$query = "SELECT * FROM {$this->table} WHERE level != 3 ORDER BY level DESC LIMIT $start, $limit";
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(); // Thuc thi query
			$data = $sth->fetchAll(PDO::FETCH_ASSOC); // Lấy nhiều bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}

		function search_user($search,$start, $limit)
		{
			$query = "SELECT * FROM {$this->table} WHERE (taikhoan LIKE :search OR level LIKE :search OR id_user LIKE :search) AND level != 3 ORDER BY level DESC LIMIT $start, $limit";
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(['search' => '%'.$search.'%']); // Thuc thi query
			$data = $sth->fetchAll(PDO::FETCH_ASSOC); // Lấy nhiều bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}

		function count_rows_search($search)
		{
			$query = "select count(*) FROM {$this->table} WHERE (taikhoan LIKE :search OR level LIKE :search OR id_user LIKE :search) AND level != 3";
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(['search' => '%'.$search.'%']); // Thuc thi query
			$data = (int)$sth->fetchColumn(); 
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}
	}