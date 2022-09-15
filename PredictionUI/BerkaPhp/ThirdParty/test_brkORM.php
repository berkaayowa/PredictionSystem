<?php
/**
 * Created by PhpStorm.
 * User: f
 * Date: 2018-06-15
 * Time: 1:56 AM
 */

namespace BrkORM;


class Error {

    public static function Log($error)
    {

    }
}

class BrkOrmException extends \Exception {

    function __construct($msg)
    {
        parent::__construct($msg);
    }
}

?>

<?php
/**
 * Created by PhpStorm.
 * User: f
 * Date: 2018-06-12
 * Time: 5:33 AM
 */

namespace BrkORM;

class BrkORMDatabase {

    private static $driver;
    private static $dbInstance;
    private static $instance = null;
    private static $drivers = ['mysqli','pdo'];

    private function __construct() {

    }

    public static  function Driver($driver = null){

        $driver = strtolower($driver);

        if($driver != null && in_array($driver, self::$drivers)){
            $key = array_search($driver, self::$drivers);
            self::$driver = self::$drivers[$key];
        }
        else
            return null;

        if(self::$instance == null)
            self::$instance = new BrkORMDatabase();

        return  self::$instance;

    }

    public function Setup($server, $databaseName, $userName, $password, $changeLogTables = array())
    {
        if(self::$dbInstance == null) {
            try {
                switch (self::$driver) {
                    case 'mysqli':
                        self::$dbInstance = new MySqliDatabase($server, $userName, $password, $databaseName);
                        break;
                    case 'pdo':
                        self::$dbInstance = new PdoDatabase($server, $userName, $password, $databaseName);
                        break;
                }
                self::$dbInstance->setLogChangeTable($changeLogTables);
            } catch (\Exception $e) {

            }

        }

    }

    public static function GetDbInstance(){
        if(self::$dbInstance != null)
            return self::$dbInstance;
        else
            return null;
    }

    public static function IsConnected(){
        return self::$dbInstance != null ? true : false;
    }

    public static function ExecuteProcedure($procedureName, $params = array()) {

        $rows = array();

        try {

            $db = self::GetDbInstance();

            if($db != null) {

                $db = $db->object();

                $sql = 'CALL ' . $procedureName;
                $procParams = '';

                for ($i = 0; $i < sizeof($params); $i++) {

                    $val = $params[$i];

                    if ($params[$i] === null) {
                        $val = 'NULL';
                    }
                    else if (is_string($params[$i])) {
                        $val = "'".$params[$i]."'";
                    }

                    if ($i == sizeof($params) - 1) {
                        $procParams = $procParams.$val;
                    } else {
                        $procParams = $procParams.$val.',';
                    }
                }

                if (!empty($procParams)) {
                    $sql = $sql . '(' . $procParams . ')';
                }

                $stmt = $db->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();

                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }

                $stmt->close();

            }

        } catch (\Exception $e) {
            //die("Error occurred:" . $e->getMessage());
        }

        return $rows;
    }

}
?>

<?php
namespace BrkORM;

class MySqliDatabase
{
    private $db_connection;
    private $dbName ;
    private $logChangeTables = array();

    function __construct($server, $userName, $password, $databaseName) {

        $this->db_connection = new \mysqli(
            $server,
            $userName,
            $password,
            $databaseName
        );

        $this->dbName = $databaseName;

        if ($this->db_connection->connect_error) {
            die("Connection failed: " . $this->$db_connection->connect_error);
        } else {

        }

        $this->db_connection->set_charset('utf8');
    }

    function setLogChangeTable($tables = array()){
        $this->logChangeTables = $tables;
    }

    function getLogChangeTable() {
        return $this->logChangeTables;
    }

    /**
     * fetches all data from database
     * @access public
     * @param  [$query] query to be executed
     * @return [array] array of customers
     * @author berkaPhp
     */
    public function fetch($query) {

        try {

            $data = array();
            $result = $this->db_connection->query($query);
            if ($result->num_rows > 0) {
                while($row= $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
            return $data;

        } catch (\Exception $eror) {
            Error::Log($eror);
            return [];
        }

    }

    public function fetchWithPrepare($option) {

        $data = null;

        $query = isset($option['query']) ? $option['query'] : $option;

        try {

            if ($stmt = $this->db_connection->prepare($query)) {

                $fields = isset($option['fields']) ? $option['fields'] : array();
                $num_of_fields = sizeof($fields);
                $types = str_repeat("s", $num_of_fields);
                $bind = array();

                if($num_of_fields > 0) {

                    foreach($fields as $key => $value ) {
                        $bind[$key] = &$fields[$key];
                    }

                    array_unshift($bind, $types);
                    call_user_func_array(array($stmt, 'bind_param'), $bind);

                }

                /* execute query */
                if($stmt->execute()) {
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while($row= $result->fetch_assoc()) {
                            $data[] = $row;
                        }
                    }
                }

                $stmt->close();
                return $data;
            }
        } catch (\Exception $eror) {
            Error::Log($eror);
            return [];
        }

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
            Error::Log($eror);
            return false;
        }
    }

    public function updateWithPrepare($option) {

        try {

            if ($stmt = $this->db_connection->prepare($option['query'])) {
                $hasFeedback = false;

                $fields = isset($option['fields']) ? $option['fields'] : array();
                $num_of_fields = sizeof($fields);
                $types = str_repeat("s", $num_of_fields);
                $bind = array();

                if($num_of_fields > 0) {

                    foreach($fields as $key => $value ) {
                        $bind[$key] = &$fields[$key];
                    }

                    array_unshift($bind, $types);
                    call_user_func_array(array($stmt, 'bind_param'), $bind);

                }

                /* execute query */
                $stmt->execute();
                if($stmt->affected_rows > 0) {
                    $hasFeedback = [
                        'affected_rows' => $stmt->affected_rows,
                        'is_success' => $stmt->affected_rows > 0 ? true : false,
                        'insert_id' => $stmt->insert_id
                    ];

                }

                $stmt->close();
                return $hasFeedback;

            }

            return false;

        } catch (\Exception $eror) {
            Error::Log($eror);
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
            Error::Log($eror);
            return null;
        }
    }

    function getTableFields($table_name) {
        try {

            $query = "SELECT * FROM information_schema.columns WHERE table_schema = '".$this->dbName."' AND table_name = '".$table_name."'";
            //echo $query;

            $fields = $this->db_connection->query($query);

            $table_fields = array();

            if ($fields->num_rows > 0) {
                while($row= $fields->fetch_assoc()) {
                    $table_fields[$row['COLUMN_NAME']] = $row['DATA_TYPE'];
                }
            }


            return $table_fields;

        } catch (\Exception $eror) {
            Error::Log($eror);
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
            Error::Log($eror);
            return null;
        }

    }

    public function runQuery($query) {
        return $this->db_connection->query($query);
    }




}
?>

<?php
namespace BrkORM;
use PDO;

class PdoDatabase
{
    private $db_connection;
    private $logChangeTables = array();

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
            Error::Log($e);
        }

    }

    public function fetchWithPrepare($option) {
        $stmt = $this->processPDO($option);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;

    }

    function setLogChangeTable($tables = array()){
        $this->logChangeTables = $tables;
    }

    function getLogChangeTable() {
        return $this->logChangeTables;
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
            //return false;
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

    function GetPrimaryKey($table) {
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

<?php
/**
 * Created by PhpStorm.
 * User: f
 * Date: 2018-07-18
 * Time: 6:06 AM
 */

namespace BrkORM;

class BrkORMForeignTable extends \stdClass {

    private $table;

    function __construct($table = array())
    {
        if(sizeof($table) == 0)
            throw new BrkOrmException('ForeignTable could not be initialized ,no setting found');

        $this->table = $table;
    }

    function GetTest() {
        return 'berka';
    }

}
?>

<?php
/**
 * Created by PhpStorm.
 * User: Berka Ayowa
 * Date: 2018-06-13
 * Time: 8:22 PM
 */

namespace BrkORM;


/**
 * Class Entity
 * @package BrkORM
 */
class T
{
    private $query;
    private $primaryKey;
    private $entityName;
    private $primaryKeyName;

    private $entyTypes = array('FirstOrDefault'=>false, 'Json'=>false, 'List' => false);
    private $columns;
    private $parameters;
    private $properties;
    private $entityColumns;
    private $joinTables;
    private $columnsToSelect;
    private $columnAliens;
    private $whereArray;
    private $any = false;
    private $options;

    private static $instance = null;

    private function __construct($table, $primaryKey = null) {

        $this->query = "";
        $this->entityName = $table;
        $this->parameters = array();
        $this->properties = array();
        $this->columns = array();
        $this->entityColumns = array();
        $this->joinTables = array();
        $this->columnsToSelect = array();
        $this->columnAliens = array();
        $this->data = array();
        $this->whereArray = array();
        $this->options = array();

        if(!empty($this->entityName)) {
            $this->entityColumns = $this->GetTableColumns($this->entityName);
            $this->columns = $this->entityColumns;
            $this->primaryKeyName = $this->GetPrimaryKey($this->entityName);

            if ($primaryKey != null) {
                $this->primaryKey = $primaryKey;
                $this->Where($this->entityName.'.'.$this->primaryKeyName, '=', $primaryKey);
            }

        }

        if($primaryKey == null)
            $this->primaryKey = 0;

    }

    /**
     * @param $table
     * @param $expression
     * @param string $type
     * @return $this
     */
    public function Join($table, $expression, $type = 'INNER JOIN')
    {
        if(!is_array($table)) {

            $t = array();

            $t['Field'] = $this->GetTableColumns($table);
            $t['Expression'] = $expression;
            $t['Type'] = $type;
            $t['Name'] = $table;

            array_push($this->joinTables, $t);

        }else if(is_array($table) && sizeof($table) == 1) {

            $key = @array_keys($table)[0];

            if(!empty($key)) {

                $t = array();


                $t['Expression'] = $expression;
                $t['Type'] = $type;
                $t['Name'] = $key;
                $t['Alien'] = $table[$key];
                $t['Field'] = $this->GetTableColumns($key, ['Alien'=>$table[$key]]);

                array_push($this->joinTables, $t);
            }


        }

        return $this;
    }

    /**
     * @param $value
     * @param string $type
     * @return $this
     */
    public function OrderBy($value, $type = 'DESC')
    {
        $this->AddOption(" ORDER BY {$value} ".$type);
        return $this;
    }

    public function Limit($value, $offset = null)
    {
        if($offset == null) {

            $this->AddOption(" LIMIT {$value} ");
        }
        else{
            $this->AddOption(" LIMIT {$offset},{$value}");
        }
        return $this;
    }

    private function AddOption($value) {
        array_push($this->options, $value);
    }

    /**
     * @param $expression
     * @param $operator
     * @param $value
     * @return $this
     */
    public function Where($expression, $operator, $value)
    {
        switch(strtolower($operator)){
            case 'like':
                //$this->AddToWhereQuery(" " .$expression .' '. strtoupper($operator) ." %?% ");
                $this->AddToWhereQuery(" " .$expression .' '. strtoupper($operator) ." CONCAT('%',?,'%') " );
                break;
            Default :
                $this->AddToWhereQuery(" " .$expression .' '. $operator .' ? ');
        }

        $this->AddParam($value);
        return $this;
    }

    public function OrWhere($expression, $operator, $value)
    {
        if(sizeof($this->whereArray) > 0)
        {
            $lastElement  = $this->whereArray[sizeof($this->whereArray) - 1];
            switch(strtolower($operator)){
                case 'like':
                    $lastElement = $lastElement ." OR ".$expression.' '.$operator." %?% ";
                    break;
                Default :
                    $lastElement = $lastElement ." OR ".$expression.' '.$operator." ? ";
            }
            $this->whereArray[sizeof($this->whereArray) - 1] = $lastElement;
            $this->AddParam($value);
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function Nd()
    {
        $this->AddToWhereQuery("AND");
        return $this;
    }

    public function On($expression)
    {
        $this->AddToWhereQuery($expression);
        return $this;
    }

    public function All()
    {
        $this->AddToWhereQuery('*');
        return $this;
    }

    /**
     * @return boolean
     */
    public function IsAny()
    {
        return $this->any;
    }

    /**
     * @return int
     */
    public function Count()
    {
        $this->Fetch();
        return sizeof($this->data);
    }

    public function GetDataArray()
    {
        return $this->data;
    }

    public function ToJson()
    {
        return json_encode($this->data);
    }

    public function SetProperties($data)
    {
        if(!is_array($data) || sizeof($data) == 0)
            return false;

        foreach($data as $key => $value) {

            if(!isset($this->columns[$key]))
                continue;

            $this->{$key} = $this->ConvertValue($value, $this->columns[$key]['Type']);
            settype($this->{$key}, $this->columns[$key]['Type']);
        }

        return true;
    }

    private function ConvertValue($value, $type) {
        switch($type) {
            case 'bool':
                return $value == 'on' || $value == '1' ? true : false;
            default :
                return $value;
        }
    }

    /**
     * @return bool
     */
    public function Save()
    {

        $id = @$this->{$this->primaryKeyName};

        if($id > 0) {

            if(!$this->IsAny())
                return false;

            $option['query'] = $this->UpdateQuery()['query'];
            $option['fields'] = $this->GetParameters();

            array_push($option['fields'], $id);

            $option['query'].= " WHERE {$this->primaryKeyName} = ? ";
            $result = BrkORMDatabase::GetDbInstance()->updateWithPrepare($option);

            $this->LogChanges($result);

            $this->Reset();

            return $result != null ? true : false;

        } else {

            $option['query'] = $this->SaveQuery()['query'];
            $option['fields'] = $this->GetParameters();

            $result = BrkORMDatabase::GetDbInstance()->updateWithPrepare($option);

            if($result != null && isset($result['insert_id']))
            {
                @$this->{$this->primaryKeyName} = $result['insert_id'];
                $this->LogChanges($result);

                $this->Reset();
                return true;
            }

            return false;

        }

    }


    private function LogChanges($result){
        if($result) {

            $tables = BrkORMDatabase::GetDbInstance()->getLogChangeTable();

            if(sizeof($tables) == 0)
                return ;

            if(array_key_exists($this->entityName, $tables)) {

                try{

                    $t = @T::Create($tables[$this->entityName]);
                    @$t->SetProperties(get_object_vars($this));
                    @$t->Save();

                }catch (\Exception $e) {

                }

            }

        }
    }


    private function GetParameters() {

        for($i = 0; $i < sizeof($this->parameters); $i++) {

            if($this->parameters[$i] === false)
                $this->parameters[$i] = 0;
            else if($this->parameters[$i] === true)
                $this->parameters[$i] = 1;

        }

        return $this->parameters;
    }

    private function Reset() {
        $this->query = '';
        $this->parameters = array();
    }

    private function UpdateQuery()
    {
        $properties = get_object_vars($this);
        $matchedColumns = array();

        $query = "UPDATE {$this->entityName} SET";
        $bind = '';

        $columns = BrkORMDatabase::GetDbInstance()->getTableFields(strtolower($this->entityName));

        foreach($columns as $column => $value)
        {
            if(array_key_exists($column, $properties) && $column != $this->primaryKeyName)
            {
                if(true) {
                    $bind .= ' ' . $column . ' = ?,';
                    $pro = $properties[$column];
                    $this->AddParam($pro);
                    $matchedColumns[$column] = $properties[$column];
                }
            }
        }

        $bind = rtrim($bind, ',');

        $query.=" ".$bind;

        return ['query'=>$query, 'columns'=>$matchedColumns];
    }

    private function SaveQuery($tableName = '')
    {
        $properties = get_object_vars($this);
        $matchedColumns = array();

        $tableName = !empty($tableName) ? $tableName : $this->entityName;

        $query = "INSERT INTO {$tableName} ";
        $bindColumns = '';
        $bindValues = '';

        $columns = BrkORMDatabase::GetDbInstance()->getTableFields(strtolower($this->entityName));

        foreach($columns as $column => $value)
        {
            if(array_key_exists($column, $properties))
            {
                $matchedColumns[$column] = $properties[$column];
                $bindColumns.=$column.',';
                $bindValues.='?,';
                $this->AddParam($properties[$column]);
            }
        }

        $bindValues = rtrim($bindValues, ',');
        $bindColumns = rtrim($bindColumns, ',');

        $query.="({$bindColumns}) VALUES({$bindValues})";

        return ['query'=>$query, 'columns'=>$matchedColumns];

    }


    /**
     * @param $tableName
     * @param array $options
     * @return array
     */
    private function GetTableColumns($tableName, $options = array())
    {
        $hasAlien = false;

        if(sizeof($options)> 0 && !empty($options['Alien']))
            $hasAlien = true;

        $columns = BrkORMDatabase::GetDbInstance()->getTableFields($tableName);

        $tableColumns = array();

        if(sizeof($columns) == 0)
            throw new BrkOrmException('Error could not found table columns');

        if(!is_array($columns))
            throw new BrkOrmException('Error given columns for table {'.$tableName.'} is not an array objects');

        foreach($columns as $column => $value)
        {

            $value = preg_replace('@\(.*?\)@', '', $value);
            $type = '';

            switch(strtolower($value)){
                case 'int':
                    $type = $value;
                    break;
                case 'text':
                case 'varchar':
                case 'nvarchar':
                    $type = 'string';
                    break;
                case 'tinyint':
                case 'bit':
                    $type = 'bool';
                    break;
                case 'double':
                case 'decimal':
                    $type = 'double';
                    break;
                case 'datetime':
                    $type = 'string';
                    break;
                case 'date':
                    $type = 'string';
                    break;
                case 'time':
                    $type = 'string';
                    break;
            }

            $tableColumns[$column] = array(
                'Name' => $column, 'Alien' => "'".(!$hasAlien ? $tableName : $options['Alien']).'.'. $column."'",
                'Type' => $type,'ToSelect'=> true,
                'SelectionName'=> (!$hasAlien ? $tableName : $options['Alien']).'.'. $column,
                'Value'=> '','Table'=>array
                (
                    "Name"=>$tableName
                )
            );
        }

        return $tableColumns;
    }

    private function GetPrimaryKey($table) {
        try {

            return BrkORMDatabase::GetDbInstance()->GetPrimaryKey($table);

        } catch (\Exception $eror) {
            Error::log($eror);
            return null;
        }
    }

    private function AddParam($value)
    {
        array_push($this->parameters, $value);
    }

    public function Delete()
    {
        return true;
    }

    public function GetQuery()
    {
        return $this->query;
    }

    /**
     * @param array $columns
     * @return $this
     */
    public function Columns($columns = array())
    {
        $this->columnsToSelect = $columns;
        return $this;
    }

    private function GetFromJoin() {

    }

    /**
     * @return $this
     */
    private function Fetch() {

        $this->BuildQuery();
        $option['query'] = $this->query;
        $option['fields'] = $this->parameters;
        $this->data = BrkORMDatabase::GetDbInstance()->fetchWithPrepare($option);

        $this->Reset();

        if(sizeof($this->data) > 0)
            $this->any = true;

        return $this;
    }

    public function FetchFirstOrDefault() {

        $this->Fetch();

        if(sizeof($this->data) > 0) {
            $this->InitializeProperties(current($this->data), $this->joinTables);
        }

        return $this;
    }

    public function FetchLastOrDefault() {

        $this->Fetch();

        if(sizeof($this->data) > 0) {
            $this->InitializeProperties(end($this->data), $this->joinTables);
        }

        return $this;
    }

    public function FetchList($option = array()) {

        $this->Fetch();
        return  $this->ProcessListData($this->data, $option);

    }


    /**
     * @param $responseColumns
     * @param array $option
     * @return array
     */
    private function ProcessListData($responseColumns, $option = array())
    {

        $data = array();

        $key = $this->entityName.'.'.$this->primaryKeyName;

        if(is_array($responseColumns)) {
            foreach ($responseColumns as $column) {
                $id = isset($column[$key]) ? $column[$key] : 0;
                $obj = new T($this->entityName, $id);
                $obj->InitializeProperties($column, $this->joinTables);

                if(isset($option['assocArray']) && $option['assocArray'] == true)
                    $obj = (array) $obj;
                array_push($data, $obj);
            }
        }

        return $data;
    }

    private function ProcessData($responseColumns)
    {
        //$obj->InitializeProperties($column);

    }

    /**
     * @param $data
     */
    public function InitializeProperties($data, $joinTables = array())
    {
        if(sizeof($data) > 0)
        {
            $keys = array_keys($data);
            $refProperties = array();
            $refObjProperties = array();

            foreach($keys as $key)
            {
                $parts = array();

                if(strpos($key, '.') !== false )
                {
                    $parts = explode('.', $key);
                }

                if(sizeof($parts) > 0 && $parts[0] != $this->entityName)
                {
                    if(!in_array($parts[0], $refProperties))
                        array_push($refProperties, $parts[0]);
                }

            }

            if(sizeof($refProperties) > 0)
            {
                foreach($refProperties as $refProperty)
                {
                    foreach($joinTables as $table)
                    {
                        if($table['Name'] == $refProperty || isset($table['Alien']) && $table['Alien'] == $refProperty){
                            $refObjProperties[$refProperty] = new BrkORMForeignTable($table);
                            break;
                        }
                    }
                }
            }

            foreach($data as $key => $value)
            {
                $parts = array();

                if(strpos($key, '.') !== false )
                {
                    $parts = explode('.', $key);
                }

                if(sizeof($parts) > 0)
                {

                    //to look at
                    if($parts[0] == $this->entityName && !isset($this->columns[$parts[1]]))
                        continue;

                    // if(isset($this->columns[$parts[1]]))
                    //$col = $this->columns[$parts[1]] ;

                    if($parts[0] == $this->entityName) {

                        if(!property_exists(get_class($this), $parts[1])) {
                            $this->{$parts[1]} = $value ;
                            //settype($this->{$parts[1]}, $col['Type']);
                        }

                    }
                    else
                    {
                        if(isset($parts[0]) && !empty($parts[0])) {
                            $refObjProperties[$parts[0]]->{$parts[1]} = $value;
                            //settype($refObjProperties[$parts[0]]->{$parts[1]}, $col['Type']);
                        }
                    }
                }
                else
                {

                }

            }

            if(sizeof($refObjProperties) > 0)
            {
                foreach($refObjProperties as $refProperty)
                {
                    $key = array_search ($refProperty, $refObjProperties);
                    $this->{$key} = $refProperty;
                }
            }

        }
        else
        {
            //log and exception
        }
    }

    /**
     *
     */
    private function BuildQuery()
    {
        $this->FilterSpecificColumns();
        $columnQuery = 'SELECT ';
        if(sizeof($this->columns) > 0)
        {
            foreach($this->columns as $column)
            {
                if(!$column['ToSelect'])
                    continue;
                $columnQuery.= $column['SelectionName'].' AS '. $column['Alien'] .",";
            }
            $columnQuery = rtrim($columnQuery, ',');
            $query = '';
            $joinQuery = '';
            if(sizeof($this->joinTables) > 0)
            {
                $flag = false;
                foreach($this->joinTables as $table)
                {
                    $key = array_search ($table, $this->joinTables);
                    foreach($table['Field'] as $property) {
                        $pKey = array_search ($property, $table['Field']);
                        if($property['ToSelect'])
                        {
                            $flag = true;
                            $query.= $property['SelectionName'].' AS '. $property['Alien'] . ",";
                        }
                    }
                    $joinQuery.= ' '.$table['Type'].' '. $table['Name']. ' ' .(isset($table['Alien']) ? ' AS '.$table['Alien'] : '').' ON '.$table['Expression'].' ';
                }
                $query = rtrim($query, ',');
                $columnQuery.= $flag ? ','.$query : '';
            }
            $this->query = $columnQuery ." FROM ". $this->entityName . $joinQuery;
            $whereQuery = ' ';
            if(sizeof($this->whereArray) > 0) {
                $whereCount = 0;
                $whereQuery.= ' WHERE ';
                foreach ($this->whereArray as $line) {
                    if(end($this->whereArray) == $line && $whereCount == sizeof($this->whereArray) - 1)
                        $whereQuery.= $line." ";
                    else
                        $whereQuery.= $line . " AND ";
                    $whereCount++;
                }
            }
            $this->query = $this->query.$whereQuery;
            foreach($this->options as $option) {
                //echo $option;
                $this->query = $this->query.$option;
            }
            //echo $this->query; die();
        }
        else
        {
            //log and exception
        }
    }


    public function Aliens($columns = array())
    {
        $this->columnAliens = $columns;

        return $this;
    }

    private function AddToWhereQuery($value)
    {
        array_push($this->whereArray, $value);
    }

    private function ApplyAliens()
    {
//        if(sizeof($columns) > 0)
//        {
//            foreach($columns as $column => $alien)
//            {
//                if(sizeof($this->columns) > 0 && array_key_exists($column, $this->columns))
//                {
//                    $this->columns[$column]['Alien'] = $column .' AS '. $alien;
//                }
//                else
//                {
//
//                }
//            }
//        }
    }

    /**
     * @return $this
     */
    private function FilterSpecificColumns()
    {
        try
        {
            if(sizeof($this->columnsToSelect) > 0)
            {
                foreach($this->columnsToSelect as $column)
                {
                    $parts = array();

                    if(strpos($column, '.'))
                    {
                        $parts = explode('.', $column);
                    }

                    foreach($this->columns as $tabletColumn)
                    {
                        $key = array_search($tabletColumn, $this->columns);//key($this->columns);

                        if (!array_key_exists($key, $this->columnsToSelect) && end($parts) != $key && $key != $this->primaryKeyName)
                        {
                            if(sizeof($parts) > 1 && $parts[0] == $this->entityName && $tabletColumn['Name'] != $parts[1])
                                $this->columns[$key]['ToSelect'] = false;
                            else if(sizeof($parts) == 0 && $tabletColumn['Name'] != $column)
                                $this->columns[$key]['ToSelect'] = false;
//                            else if(sizeof($parts) > 0 && $tabletColumn['Name'] != $parts[1])
//                                $$this->columns[$key]['ToSelect'] = false;
                        }
                    }

                    foreach($this->joinTables as $table)
                    {
                        $key = array_search ($table, $this->joinTables);

                        if(!array_key_exists($key, $this->columnsToSelect) && end($parts) != $key)
                        {
                            foreach($table['Field'] as $property) {

                                $pKey  = array_search ($property, $table['Field']);

                                if(sizeof($parts) > 1 && $parts[0] == $key && $property['Name'] != $parts[1])
                                    $this->joinTables[$key]['Field'][$pKey]['ToSelect'] = false;
                                else if(sizeof($parts) == 0 && $property['Name'] != $column)
                                    $this->joinTables[$table]['Field'][$pKey]['ToSelect'] = false;
                                else if(sizeof($parts) > 0 && $property['Name'] != $parts[1] && $pKey !='Type')
                                {
                                    //$this->joinTables[$table]['Field'][$pKey]['ToSelect'] = false;
                                }

                            }
                        }

                    }
                }
            }

        }
        catch(\Exception $ex)
        {

        }

        return $this;
    }

    public static function Find($table, $id = null)
    {
        return self::GetInstance($table, $id);
    }

    /**
     * @param $table
     * @return T|null
     */
    public static function Create($table)
    {
        return self::GetInstance($table, null);
    }

    /**
     * @param $table
     * @param $id
     * @return T|null
     */
    private static function GetInstance($table, $id)
    {
//        if(self::$instance != null)
//            return self::$instance;
//        else
        // self::$instance = new T($table, $id);
        return new T($table, $id);
    }

    /**
     * @return $this
     */
    private function ConvertToProperty()
    {

        if(sizeof($this->columns) > 0)
        {
            foreach($this->columns as $column)
            {
                if($column['ToSelect'])
                {
                    $this->{$column['Name']} = $column['Value'];
                }

            }

        }
        else
        {
            //log and exception
        }

        return $this;
    }


}
?>