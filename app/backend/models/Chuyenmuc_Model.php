<?php 
	
	class Chuyenmuc_Model extends Base_Model
	{
		protected $table = 'chuyenmuc';

		function count_rows_search($search)
		{		
			$query = "select count(*) from {$this->table} where id_cate LIKE :search or ten LIKE :search";
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(['search' => '%'.$search.'%']); // Thuc thi query
			$data = (int)$sth->fetchColumn(); // Lấy nhiều bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}

		function search_cate($search,$start, $limit)
		{
			$query = "SELECT * FROM {$this->table} WHERE id_cate LIKE :search OR ten LIKE :search ORDER BY vitri ASC LIMIT $start, $limit";
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(['search' => '%'.$search.'%']); // Thuc thi query
			$data = $sth->fetchAll(PDO::FETCH_ASSOC); // Lấy nhiều bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}
	}