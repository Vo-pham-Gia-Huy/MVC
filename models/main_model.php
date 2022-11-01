<?php
class Main_Model 
{
	protected $con;
    private static $instance = [];  

	public $table;
	protected function __construct(){
		$instanceDB = ConnectDb::getInstance();
		$this->con = $instanceDB->getConnection();
		if(!$this->table)	$this->setTableName();
	}
	public static function getInstance() {
		$called_class = get_called_class();
        if (!array_key_exists($called_class,self::$instance)) {
			self::$instance[$called_class] = new $called_class();
		}
        return self::$instance[$called_class];
    }

	public function setTableName($table=null){
		if($table) {
			$this->table=$table;
		} else {
			$cln = get_class($this);
			$clnf = str_split($cln, strrpos($cln, '_'))[0];
			if (strrpos($clnf,"y")) {
				if ((strrpos($clnf,"y") + 1) == strlen($clnf)) {
					$this->table = str_split($clnf, strrpos($clnf, 'y'))[0].'ies'; 
				} 
			} else {
				$this->table = $clnf.'s';
			}
		}
	}
	
	public function getTableName() {
		return $this->table;
	}
	public function checkExist($option) {
		$query = "SELECT count(id) FROM $this->table where $this->table.email='".$option['email']."' and $this->table.password='".$option['password']."'";
		echo $query;
		$result = mysqli_query($this->con,$query);
		return $result;
	}
	public function getAllTables() {
		$sql = "SHOW TABLES FROM ".DB_NAME;
		$query = mysqli_query($this->con,$sql);
		$result = [];
		if($query) {
			while($field = mysqli_fetch_row($query)) {
				array_push($result, $field[0]);
			}
		}
		return $result;
	}
	
	public function getAllFields($table) {
		$sql = "SHOW COLUMNS FROM ".$table;
		$fields = $this->con->query($sql);
		$result = [];
		if($fields) {
			while($field = mysqli_fetch_array($fields)) {
				array_push($result, $field['Field']);
			}
		}
		return $result;
	}
	
	/* CRUD data method */
	public function getAllRecords($fields='*', $options=null) {
		$conditions = '';
		if(isset($options['conditions'])) {
			$conditions .= ' where '.$options['conditions'];
		}
		$query = "SELECT ".$fields." FROM ".$this->table.$conditions;
		$result = mysqli_query($this->con,$query);
		return $result;
	}

	public function getRecord($id=null, $fields='*', $options=null) {
		$conditions = '';
		if(isset($options['conditions'])) {
			$conditions .= ' and '. $options['conditions'];
		}
		$query = "SELECT $fields FROM $this->table where id=$id".$conditions;
		$result = mysqli_query($this->con,$query);
		if($result) {
			//$record = mysqli_fetch_array($result);
			//$record = mysqli_fetch_row($result);
			$record = mysqli_fetch_assoc($result);
		} else $record=false;
		return $record;
	}
	
	public function delRecord($id=null, $conditions=null) {
		if($conditions)	$conditions = ' and '.$conditions;
		$query = "DELETE FROM $this->table WHERE id=$id".$conditions;
		return mysqli_query($this->con,$query);
	}
	
	public function addRecord($datas) {
		$fields = $values = '';
		$i=0;
		foreach($datas as $k=>$v) {
			if($i) {
				$fields .=',';
				$values .=',';
			}
			$fields .= $k;
			$values .= "'".$v."'";
			$i++;
		}
		$query = "INSERT INTO $this->table ($fields,updated) VALUES ($values,NOW())";
		echo $query;
		return mysqli_query($this->con,$query);
	}
	
	public function editRecord($id,$datas){
		$setDatas = '';
		$i=0;
		foreach($datas as $k=>$v) {
			if($i) {
				$setDatas .=',';
			}
			$setDatas .= $k."='".$v."'";
			$i++;
		}
        $query = "UPDATE $this->table SET $setDatas,updated=NOW() WHERE id='$id'";
		return mysqli_query($this->con,$query);
        //$result = mysqli_query($this->con,$query) or die("MySQL error: " . mysqli_error($this->con) . "<hr>\nQuery: $query");
    }
	public function getNumRows($options=null){
		$conditions = '';
		if(isset($options['conditions'])) {
			$conditions .= ' where '. $options['conditions'];
		}
		$query = "SELECT COUNT(id) FROM $this->table ".$conditions;
		$result = mysqli_query($this->con,$query);
		return $result;
	}
    public function getAllRecordsHasRelated($fields='*', $options=null) {
		$conditions = '';
		$limit = '';
		$join='';
		// $relatedFields='';
		// $relatedFields=$this->getAllFields($this->related['table']);
		if(isset($options['conditions'])) {
			$conditions .= ' where '.$options['conditions'];
		}
		if(isset($options['limit'])) {
			$limit .= $options['limit'];
		}
		if(isset($options['field'])){
			foreach($options['field'] as $v){
				$join.=','.$this->related['table'].'.'.$v.' as '.$this->related['table'].'_'.$v;
			}
		}else{
			$relatedFields=$this->getAllFields($this->related['table']);
			foreach($relatedFields as $v){
				$join.=','.$this->related['table'].'.'.$v.' as '.$this->related['table'].'_'.$v;
			}
		}
		// print_r($relatedFields);
		// echo $join;
		$query = "SELECT ".$this->table.".".$fields.$join." FROM ".$this->table. " Left JOIN ".$this->related['table']." ON ".$this->table.".".substr($this->related['table'],0,-1)."_id = ".$this->related['table'].".id".$conditions.$limit;
		// echo $conditions;
		// echo $query;
		$result = mysqli_query($this->con,$query);
		return $result;
	}
	public function getRecordHasRelated($id=null, $fields='*', $options=null) {
		$conditions = '';
		$join='';
		if(isset($options['conditions'])) {
			$conditions .= ' and '. $options['conditions'];
		}
		if(isset($options['field'])){
			foreach($options['field'] as $v){
				$join.=','.$this->related['table'].'.'.$v.' as '.$this->related['table'].'_'.$v;
			}
		}else{
			$relatedFields=$this->getAllFields($this->related['table']);
			foreach($relatedFields as $v){
				$join.=','.$this->related['table'].'.'.$v.' as '.$this->related['table'].'_'.$v;
			}
		}
		$query = "SELECT ".$this->table.".".$fields.$join." FROM ".$this->table.$conditions. " Left JOIN ".$this->related['table']." ON ".$this->table.".".substr($this->related['table'],0,-1)."_id = ".$this->related['table'].".id where ".$this->table.".id=$id".$conditions;
		$result = mysqli_query($this->con,$query);
		if($result) {
			//$record = mysqli_fetch_array($result);
			//$record = mysqli_fetch_row($result);
			$record = mysqli_fetch_assoc($result);
		} else $record=false;
		return $record;
	}
    public static function convertToList($mysqliObject) {
    	$arrReturn = [];
    	while($row = mysqli_fetch_array($mysqliObject)) {
    		$arrReturn[$row['id']] = $row[	'cat_name'];
    	}
    	return $arrReturn;
	}
}
