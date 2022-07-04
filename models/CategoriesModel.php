<?php

class CategoriesModel extends Model {

    public function getCategories() {
		$sql = "SELECT * FROM categories";
		
        $result = array();
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']] = $row;
		}

		return $result;		
	}
}