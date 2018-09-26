<?php

	class DatabaseTable
	{

		protected $objConnection;

		protected $table;

		protected function save($pairs){

      $field_names_array = array_keys($pairs);
      $field_names = implode(',', $field_names_array);
      $values = "'" . implode("','", $pairs) . "'";

			$sql = "INSERT INTO $this->table ($field_names) VALUES ($values)";
			return $this->objConnection->query($sql);
		}

		public function delete($pairs, $id){

			$field_names_array = array_keys($pairs);

			$sql = "DELETE FROM $this->table WHERE $field_names_array[0] = $id";
			return $this->objConnection->query($sql);
		}

		public function update($pairs, $id){

			$field_names_array = array_keys($pairs);

			$sql = "UPDATE $this->table SET ";
			foreach ($pairs as $field_name => $value) {
				if($field_name == $field_names_array[0]){
					continue;
				}
				$sql .= "$field_name = '$value', " ;
			}
			$sql = rtrim($sql, ', ');
			$sql .= " WHERE $field_names_array[0] = $id";

			return $this->objConnection->query($sql);
		}

	}

?>
