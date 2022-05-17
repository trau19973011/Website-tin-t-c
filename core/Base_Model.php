<?php
	
	class Base_Model extends Core_Model
	{
		function find_by_id($where = [])
		{
			$wh = '';
			if($where)
			{
				foreach ($where as $key => $value) 
				{
					$wh .= " AND $key = :$key"; 
				}

				$wh = ' WHERE ' . trim($wh, ' AND');
			}
			$query = "SELECT * FROM {$this->table}".$wh;
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute($where); // Thuc thi query
			$data = $sth->fetch(PDO::FETCH_ASSOC); // Lấy 1 bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}

		function find_all($where = [], $orderby = NULL, $limit = NULL)
		{
			$orderby = isset($orderby) ? ' ORDER BY ' . $orderby : '';
			$limit = isset($limit) ? ' LIMIT ' . $limit : '';
			$wh = '';
			if($where)
			{
				foreach($where as $key => $value)
				{
					$wh .= " AND $key $value";
				}
				$wh = ' WHERE ' . trim($wh, ' AND');
			}
			$query = "SELECT * FROM {$this->table} " . $wh . $orderby . $limit;

			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(); // Thuc thi query
			$data = $sth->fetchAll(PDO::FETCH_ASSOC); // Lấy nhiều bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}

		function insert($data = [])
		{
			$field_list = '';
			$field = '';
			foreach($data as $key => $value)
			{
				$field_list .= ",$key";
				$field .= ",:$key";
			}
		
			$query = "INSERT INTO {$this->table}(" . trim($field_list, ',') . ") VALUES(" . trim($field, ',') . ")";
			$sth = $this->db->prepare($query); // Chuan bi query
			$check = $sth->execute($data); // Thuc thi query
			$sth->closeCursor(); // Đóng kết nối
			return $check;
		}

		function update($data = [], $where)
		{
			$field_list = '';

			foreach ($data as $key => $value)
			{
				$field_list .= ",$key = :$key";
			}

			$query = "UPDATE {$this->table} SET " . trim($field_list, ',') . " WHERE " . $where;
			$sth = $this->db->prepare($query); // Chuan bi query
			$check = $sth->execute($data); // Thuc thi query
			$sth->closeCursor(); // Đóng kết nối
			return $check;
		}

		function delete($id_name, $id)
		{
			$query = "DELETE FROM {$this->table} WHERE $id_name = :id";
			$sth = $this->db->prepare($query);
			$check = $sth->execute(['id' => $id]);
			$sth->closeCursor();
			return $check;
		}
		// Lấy nhiều bản ghi
		function select($select, $where = [])
		{
			$wh = '';
			if($where)
			{
				foreach($where as $key => $value)
				{
					$wh .= " AND $key $value";
				}
				$wh = ' WHERE ' . trim($wh, ' AND');
			}
			$query = "SELECT $select FROM {$this->table}" . $wh;
	
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(); // Thuc thi query
			$data = $sth->fetchAll(PDO::FETCH_ASSOC); // Lấy nhiều bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}
		function count_rows($where = [])
		{
			$wh = '';
			if($where)
			{
				foreach($where as $key => $value)
				{
					$wh .= " AND $key $value";
				}
				$wh = ' WHERE ' . trim($wh, ' AND');
			}
			return $this->db->query("select count(*) from {$this->table}" .$wh)->fetchColumn(); 
		}
	}