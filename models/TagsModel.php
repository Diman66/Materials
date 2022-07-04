<?php

class TagsModel extends Model {

    public function getTags() {
		$sql = "SELECT * FROM tags";
		
        $result = array();
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']] = $row;
		}

		return $result;		
	}
}