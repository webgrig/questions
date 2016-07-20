<?php
class Posts{

	private $_db;
	public function __construct(){
		$this->_db = DB::getInstance();
	}

	public function getAllDb(){
		$sql = "SELECT id, title, full_text FROM `mega_posts`";
		$stmt = $this->_db->query($sql);
		$res = [];
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$res[] = $row;
		}
		if (empty($res)) {
			return false;
		}

		return $res;
	}

	public function getOneDb($id){
		$id = $this->_db->quote($id);
		$sql = "SELECT id, title, full_text FROM `mega_posts` WHERE id = $id";
		$stmt = $this->_db->query($sql);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$row) {
			return false;
		}
		return $row;
	}
}