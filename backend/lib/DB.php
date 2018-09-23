<?php
class DB extends BaseClass
{
	/** @var PDO */
	private $db;
	
	public static $host 		= '';
	public static $dbName	= '';
	public static $user		= '';
	public static $pass		= '';
	
	public function __construct()
	{
		$dsn = sprintf('mysql:dbname=%s;host=%s', self::$dbName, self::$host);
		
		try {
			$this->db = new PDO($dsn, self::$user, self::$pass);	
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e) {
			$this->setHttpStatus(500);
			die('Connection failed: '.$e->getMessage());
		}
	}
	
	public function _query($query) {
		return $this->db->query($query);
	}
	
	public function _exec($query, $params = []) 
	{
		$statement = $this->db->prepare($query);
		$statement->execute($params);
		
		return $statement;
	}
	
	public function _rows($query, $params = [])
	{
		$result = $this->_exec($query, $params);
		return $result->fetchAll();
	}
	
	public function _row($query, $params = [])
	{
		$result = $this->_exec($query, $params);
		return $result->fetch();
	}
	
	public function _cell($query, $params = [])
	{
		$result = $this->_exec($query, $params);
		return $result->fetchColumn(0);
	}
	
	public function _array($query, $params = [])
	{
		$result = $this->_exec($query, $params);
		$array = [];
		
		while(($cell = $result->fetchColumn(0)) && $cell !== false) {
			$array[] = $cell;
		}
		
		return $array;
	}
	
	public function _rowsAsHash($query, $key, $params = [])
	{
		$rows = $this->_rows($query, $params);
		$hash = [];
		
		if($rows) {
			foreach($rows as $row) {
				$hash[$row[$key]] = $row;
			}
		}
		
		return $hash;
	}	
	
	public function _hash($query, $params = [])
	{
		$result = $this->_exec($query, $params);
		$rows = $result->fetchAll(PDO::FETCH_NUM);
		
		$hash = [];
		
		if($rows) {
			foreach($rows as $row) {
				$hash[$row[0]] = $row[1];
			}
		}
					
		return $hash;
	}
	
	public function _rowsAsHashArray($query, $key, $params = [])
	{
		$rows = $this->_rows($query, $params);
		$hash = [];
		
		if($rows) {
			foreach($rows as $row) {
				$hash[$row[$key]][] = $row;
			}
		}
		
		return $hash;
	}
	
	public function set($tableName, $data, $where = null) {
		return is_null($where) ? $this->insert($tableName, $data) : $this->update($tableName, $data, $where);
	}
	
	public function insert($tableName, $data)
	{
		$columns = '`'.join('`, `', array_keys($data)).'`';
		$values = array_values($data);
		$plcs = join(', ', array_fill(0, count($values), '?'));
		
		$sql = "INSERT INTO `$tableName` ($columns) VALUES ($plcs)";
		
		$query = $this->db->prepare($sql);
		$result = $query->execute($values);
		
		return $this->db->lastInsertId();
	}
	
	public function insertMore($tableName, $rows)
	{
		$columns = '`'.join('`, `', array_keys($rows[0])).'`';
		$plcs 	= join(', ', array_fill(0, count($rows[0]), '?'));
		$values 	= join(', ', array_fill(0, count($rows), "($plcs)"));
		
		$sql = "INSERT INTO `$tableName` ($columns) VALUES $values"; 
		
		$data = [];
		foreach($rows as $row) {
			$data = array_merge($data, array_values($row));
		}
		
		$query = $this->db->prepare($sql);
		$result = $query->execute($data);
		
		return true;
	}
	
	public function update($tableName, $data, $where)
	{
		$cols = [];
		$params = [];
		$whereSQL = [];
		foreach($data as $col => $value) {
			$cols[] = "`$col` = ?";
			$params[] = $value;
		}
		$cols = join(', ', $cols);
		
		foreach($where as $c => $p) {
			if($this->isFilled($p)) {
				$params[] = $p;
				$whereSQL[] = $c;
			}
		}
		$whereSQL = join(' AND ', $whereSQL);
		
		$sql = "UPDATE `$tableName` SET $cols WHERE $whereSQL";
		
		$query = $this->db->prepare($sql);
		$result = $query->execute($params);
		
		return $query->rowCount();
	}
	
	public function lastId()
	{
		return $this->db->lastInsertId();
	}
}
