<?php
	namespace BerkaPhp\Model;
	use BerkaPhp\Database\DB;
    use BerkaPhp\Database\QueryBuilder;
    use BerkaPhp\Helper\Check;
    use BerkaPhp\Helper\FileStream;

    interface Model {
		public function Fetch();
		public function FetchBy($tags);
		public function Update($data);
	}

    abstract class BerkaPhpModel implements Model
	{
		protected $table_name;
		protected $primary_key;
		protected $contains;
		protected $validate;
		private $db;
		private $query;
		private $result;
		protected $keys;

		function __construct($value)
		{
			$this->db = DB::GetDbInstance();
			$this->contains = null;
			$this->table_name = $value;
		}

		/* fetches all data from database
		* @access public
		* @param  [$query] array f parameters
		* @return [array] array of data fetched from DB
		* @author berkaPhp
		*/
		public function Fetch($params = [], $join = array()) {
			$data = $this->BeforeFetch(array('params'=>$params, 'join'=>$join));
			$this->query = QueryBuilder::select($this->table_name, $this->primary_key, $this->contains, $data['params'], $this->keys, $data['join']);
			$this->result = $this->db->fetchWithPrepare($this->query);
			
			return $this->AfterFetch($this->result);
		}

		public function FetchWhere($params = [], $join = array()) {
            $data = $this->BeforeFetch(array('params'=>$params, 'join'=>$join));
			$this->query = QueryBuilder::select_where($this->table_name, $this->primary_key, $this->contains, $data['params'], $this->keys, $data['join']);
			$this->result = $this->db->fetchWithPrepare($this->query);

			return $this->AfterFetch($this->result);
		}

		/* fetches all data from database
		* that match conditions in tags
		* @access public
		* @param  [$query] array f conditions
		* @return [array] array of data fetched from DB
		* @author berkaPhp
		*/
		public function FetchBy($params, $join = array()) {
            $data = $this->BeforeFetch(array('params'=>$params, 'join'=>$join));
			$this->query = QueryBuilder::select_by($this->table_name, $this->primary_key, $this->contains, $data['params'], $this->keys, $data['join']);
			$this->result = $this->db->fetchWithPrepare($this->query);
			return $this->AfterFetch($this->result);
		}

		/* fetches all data from database
		* that matches conditions like in tag
		* @access public
		* @param  [$query] array f conditions
		* @return [array] array of data fetched from DB
		* @author berkaPhp
		*/
		public function FetchLike($params, $join = array()) {
            $data = $this->BeforeFetch(array('params'=>$params, 'join'=>$join));
			$this->query = QueryBuilder::select_like($this->table_name, $this->primary_key, $this->contains, $data['params'], $this->keys, $data['join']);
			$this->result = $this->db->fetchWithPrepare($this->query);
			return $this->AfterFetch($this->result);
		}

		/* Add data into database
		* @access public
		* @param  [$query] array f data to be added
		* @return [array] true or false
		* @author berkaPhp
		*/
		public function Add($data) {

			$data_table = $this->BeforeSave($this->filterData($data));
			$this->query = QueryBuilder::add($this->table_name, $data_table);
			$result = $this->AfterSave($this->db->updateWithPrepare($this->query));

			return $result;
		}

		/* Update data in database
		* @access public
		* @param array f fields and
		* vaule to be updated
		* @return [array] true or false
		* @author berkaPhp
		*/
		public function Update($data, $params = array()) {

			$data_table = $this->BeforeUpdate($this->filterData($data));
            $data_table = $this->BeforeSave($data_table);
			$this->query = QueryBuilder::update($this->table_name, $data_table, $this->primary_key, $params);
			$result = $this->AfterUpdate($this->db->updateWithPrepare($this->query));

			return $result;
		}

		/* delete data from database
		* @access public
		* @param  value to search for deleting
		* @return true or false
		* @author berkaPhp
		*/
		public function Delete($value) {

			$value = $this->BeforeDelete($value);
			$this->query = QueryBuilder::delete($this->table_name, $value, $this->primary_key);

			return $this->AfterDelete($this->db->update($this->query));
		}

		/* fetches all table fields
		* @access public
		* @return array of fields
		* @author berkaPhp
		*/
		public function Fields() {
			return $this->db->getTableFields($this->table_name);
		}

		/* filter data to be sent to database
		* checks if data mathe the table fields
		* type
		* @access private
		* @param  array of data to be validated
		* @return [array] array of validated data
		* @author berkaPhp
		*/
		private function filterData($data) {

			$table = $this->Fields();
			$validated_data = null;

			foreach ($table as $field => $type) {

                $type = strtolower($type);

                if(substr($type,0,4) == "blob" || strpos("blob", $type ) !== false) {

                    if(array_key_exists($field, $_FILES)) {

                        $file = FileStream::fetchFileBase64($field);

                        if($file !== null) {
                            $validated_data[$field] = $file['data'];
                        }

                    } elseif(array_key_exists($field,$data)) {
                        $validated_data[$field] = trim($data[$field]) == "" ? null : $data[$field];
                    }

                } elseif(substr($type,0,7) == "tinyint" || strpos("tinyint", $type ) !== false) {

                    if (array_key_exists($field, $data)) {

                        if (strtolower($data[$field]) == 'on' || strtolower($data[$field]) == 'true' || strtolower($data[$field]) == Check::True()) {
                            $validated_data[$field] = 1;
                        } else {
                            $validated_data[$field] = 0;
                        }

                    } else {
                        $validated_data[$field] = 0;
                    }

                } else {

                    if(array_key_exists($field,$data)) {
                        if(substr($type,0,3) == 'int') {
                            $validated_data[$field] = (int)$data[$field];
                        } else {
                            $validated_data[$field] = trim($data[$field]) == "" ? null : $data[$field];
                        }
                    }

                }

			}

			if ($validated_data == null) {
				die('Error empty filter data does not match table fields');
			}

			return $validated_data;

		}

        private function filterDataFromDB() {

        }

		/* get number of rows from the table
		* @return integer number of rows
		* @author berkaPhp
		*/
		public function numOfRows() {
			$this->result->num_rows;
		}

        public function _fetchBy($params, $join = array()) {
			$this->query = QueryBuilder::select_by($this->table_name, $this->primary_key, $this->contains, $params, $this->keys, $join);
            return $this->db->fetchWithPrepare($this->query);
        }

        public function CountRows() {
            $this->result->num_rows;
		}
		
		protected function BeforeSave($data) {
			return $data;
		}

		protected function AfterSave($result) {
			return $result;
		}

		protected function BeforeFetch($data) {
			return $data;
		}

		protected function AfterFetch($data) {
			return $data;
		}

		protected function BeforeUpdate($data) {
			return $data;
		}

		protected function AfterUpdate($data) {
			return $data;
		}

		protected function BeforeDelete($data) {
			return $data;
		}

		protected function AfterDelete($data) {
			return $data;
		}

	}
?>