<?php

class MaterialsModel extends Model {

    public function getMaterials() {
		$sql = "SELECT
					materials.id as id,
					materials.name as name_material,
                    materials.autor,
					materials.slug,
					materials.id_type,
					materials.id_category,
					type_materials.name as name_type,
					categories.name as name_category
				FROM materials
				LEFT JOIN type_materials ON (materials.id_type = type_materials.id)
				LEFT JOIN categories ON (materials.id_category = categories.id)
				";
		$result = array();
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']] = $row;
		}

		return $result;		
	}

	public function getTypeMaterials () {
		$sql = "SELECT * FROM type_materials";

		$result = array();
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']] = $row;
		}
		return $result;
	}

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

	public function addMaterial($typeMaterial, $category, $name, $autor, $description) {
		try {
			$sql = "INSERT INTO materials(name, autor, id_type, id_category, description, slug)
				VALUES(:nameMaterial, :autor, :typeMaterial, :category, :description, :slug)
				";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":nameMaterial", $name, PDO::PARAM_STR);
		$stmt->bindValue(":autor", $autor, PDO::PARAM_STR);
		$stmt->bindValue(":typeMaterial", $typeMaterial, PDO::PARAM_STR);
		$stmt->bindValue(":category", $category, PDO::PARAM_STR);
		$stmt->bindValue(":description", $description, PDO::PARAM_STR);
		$stmt->bindValue(":slug", $this->translit_slug($name), PDO::PARAM_STR);
		$stmt->execute();
		return true;
		} catch (Exception $ex) {
			return false;
		}
	}

	public function saveMaterial($typeMaterial, $category, $name, $autor, $description, $slug) {
		try {
		$sql = "UPDATE materials
				SET name = :nameMaterial, autor = :autor, id_type = :typeMaterial, id_category = :category, description = :description
				WHERE materials.id = (SELECT * FROM(SELECT id FROM materials WHERE slug = :slug) AS t1)
				";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":nameMaterial", $name, PDO::PARAM_STR);
		$stmt->bindValue(":autor", $autor, PDO::PARAM_STR);
		$stmt->bindValue(":typeMaterial", $typeMaterial, PDO::PARAM_STR);
		$stmt->bindValue(":category", $category, PDO::PARAM_STR);
		$stmt->bindValue(":description", $description, PDO::PARAM_STR);
		$stmt->bindValue(":slug", $slug, PDO::PARAM_STR);
		$stmt->execute();
		return true;
		} catch (Exception $ex) {
			return false;
		}
	}

	public function deleteMaterial($slug) {
		try {
			$sql = "DELETE FROM materials
				WHERE materials.id = (SELECT * FROM(SELECT materials.id FROM materials WHERE materials.slug = :slug) AS t1)
				";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(":slug", $slug, PDO::PARAM_STR);
			$stmt->execute();
			return true;
		} catch (Exception $ex) {
			return false;
		}
	}

	public function getMaterial($slug) {
		$sql = "SELECT
					materials.id as id,
					materials.name as name_material,
                    materials.autor,
					materials.slug,
					materials.id_type,
					materials.id_category,
					materials.description,
					type_materials.name as name_type,
					categories.name as name_category
				FROM materials
				LEFT JOIN type_materials ON (materials.id_type = type_materials.id)
				LEFT JOIN categories ON (materials.id_category = categories.id)
				WHERE materials.slug = :slug
				";
		$result = array();
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":slug", $slug, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC); 

		$sql = "SELECT
					tags_material.id,
					tags_material.id_tags,
					tags.name
				FROM tags_material
				LEFT JOIN tags ON (tags_material.id_tags = tags.id)
				WHERE tags_material.id_material = (SELECT id FROM materials WHERE slug = :slug)
				";	
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":slug", $slug, PDO::PARAM_STR);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result['tags_material'][$row['id_tags']] = $row;
		}

		$sql = "SELECT * FROM tags";	
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result['tags_all'][$row['id']] = $row;
		}

		return $result;		
	}

	public function getFindMaterial($str) {
		$sql = "SELECT
					materials.id as id,
					materials.name as name_material,
					materials.autor,
					materials.slug,
					materials.id_type,
					materials.id_category,
					type_materials.name as name_type,
					categories.name as name_category
				FROM materials
				LEFT JOIN type_materials ON (materials.id_type = type_materials.id)
				LEFT JOIN categories ON (materials.id_category = categories.id)
				WHERE (materials.name LIKE '%$str%') OR (materials.autor LIKE '%$str%') OR (categories.name LIKE '%$str%')
				";
		$result = array();
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']] = $row;
		}

		return $result;		
	}

	public function saveTagToMaterial($id_tags, $slug) {
		try {
			$sql = "SELECT id FROM materials WHERE slug = :slug";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(":slug", $slug, PDO::PARAM_STR);
			$stmt->execute();
			$id_material = $stmt->fetch(PDO::FETCH_ASSOC);
			
			$tags_material = array();
			$sql = "SELECT id, id_tags FROM tags_material WHERE id_material = :id_m";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(":id_m", $id_material['id'], PDO::PARAM_STR);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$tags_material[$row['id']] = $row;
			}
			if (!empty($tags_material)) {
				if (in_array($id_tags, array_column($tags_material, 'id_tags'))) {
					return false;
				} else {
					$sql = "INSERT INTO tags_material (id_tags, id_material)
					VALUES(:id_tag, :id_m)
							";
					$stmt = $this->db->prepare($sql);
					$stmt->bindValue(":id_tag", $id_tags, PDO::PARAM_INT);
					$stmt->bindValue(":id_m", $id_material['id'], PDO::PARAM_INT);
					$stmt->execute();
					return true;
				}
			} else {
				$sql = "INSERT INTO tags_material (id_tags, id_material)
				VALUES(:id_tag, :id_m)
						";
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(":id_tag", $id_tags, PDO::PARAM_INT);
				$stmt->bindValue(":id_m", $id_material['id'], PDO::PARAM_INT);
				$stmt->execute();
				return true;
			}
			
		} catch (Exception $ex) {
			return false;
		}
	}

	public function deleteTagFromMaterial($id) {
		try {
			$sql = "DELETE FROM tags_material
				WHERE tags_material.id = :id
				";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(":id", $id, PDO::PARAM_STR);
			$stmt->execute();
			return true;
		} catch (Exception $ex) {
			return false;
		}
	}

}

