<?php
	namespace berkaPhp\database;
    use BerkaPhp\Error\Error;
    use BerkaPhp\Helper\Log;
    use PDO;

    class PdoDatabase
	{
		private $db_connection;

		function __construct($server, $userName, $password, $databaseName) {

            $dsn = "mysql:host=".$server.";dbname=".$databaseName.";charset=utf8";
            $options = [
                PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
            ];

            try {
                $this->db_connection = new PDO($dsn, $userName, $password, $options);
            } catch (\Exception $e) {
                Log::Error($e);
            }

		}

        public function fetchWithPrepare($option) {
            $stmt = $this->processPDO($option);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            return $result;

        }

	/**
	 * updates , adds data to the database
	 * return true if successfully executed
	 * else false
	 * @access public
	 * @param [$query] query to be executed
	 * @return [boolean] true or false
	 * @author berkaPhp
	 */
		public function update($query) {
			try {
				if (!$this->db_connection->query($query)) {
					return false;
				}
				return true;
			} catch (\Exception $eror) {
				Error::log($eror);
				return false;
			}
		}

        public function updateWithPrepare($option) {
            $stmt = $this->processPDO($option);
            $feedback = ($stmt->rowCount() > 0) ? true : false;
            $stmt->closeCursor();
            return $feedback;

        }

        private function processPDO($option) {

            try {

                if ($stmt = $this->db_connection->prepare($option['query'])) {

                    $fields = isset($option['fields']) ? $option['fields'] : array();
                    $num_of_fields = sizeof($fields);

                    $bind = array();

                    if ($num_of_fields > 0) {

                        foreach ($fields as $key => $value) {
                            $bind[$key] = &$fields[$key];
                        }

                    }

                    if (sizeof($bind) > 0) {
                        $stmt->execute($bind);
                    } else {
                        $stmt->execute();
                    }

                    return $stmt;

                }

                return null;

            } catch (\Exception $eror) {
                Error::log($eror);
                return false;
            }

        }


	/**
	 * gets a query and returns number of rows
	 * @access public
	 * @param [$query] query to be executed
	 * @return [integer]
	 * @author berkaPhp
	 */
		public function count($query) {
			$result = $this->db_connection->query($query);
			return $result->num_rows;
		}

		public function object() {
			return $this->db_connection;
		}

		function getPrimaryKey($table) {
			try {
				
				$result = $this->db_connection->query("SHOW INDEX FROM {$table} WHERE Key_name = 'PRIMARY'");
				if ($result->num_rows > 0) {
					$row= $result->fetch_assoc();

				}
				return $row['Column_name'];

			} catch (\Exception $eror) {
				Error::log($eror);
				return null;
			}
		}

		function getTableFields($table_name) {
			try {

				$fileds = $this->db_connection->query('DESCRIBE '.$table_name);
				$table_fields='';

				foreach ($fileds as $field => $value) {
					$table_fields[$value['Field']] = $value['Type'];
				}

				return $table_fields;

			} catch (\Exception $eror) {
				Error::log($eror);
				return [];
			}
		}

		function getTables() {
			try {

				$result = $this->db_connection->query("SHOW TABLES");
				$tableList = '';

				if ($result->num_rows > 0) {
					while($ccurrent_row = mysqli_fetch_array($result))
					{
						$tableList[] = $ccurrent_row[0];
					}
					return $tableList;
				}
				return null;

			} catch (\Exception $eror) {
				Error::log($eror);
				return null;
			}

		}

        public function runQuery($query) {
            return $this->db_connection->query($query);
        }

	}
?>