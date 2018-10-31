<?php
/*
Author:			This code was generated by DALGen version 1.0.0.0 available at https://github.com/H0r53/DALGen 
Date:			10/18/2017
Description:	Creates the DAL class for  tasktypes table and respective stored procedures

*/



class Tasktypes {

	// This is for local purposes only! In hosted environments the db_settings.php file should be outside of the webroot, such as: include("/outside-webroot/db_settings.php");
	protected static function getDbSettings() { return "DAL/db_localsettings.php"; }

	/******************************************************************/
	// Properties
	/******************************************************************/

	protected $TaskTypeID;
	protected $TaskType;
	protected $Description;


	/******************************************************************/
	// Constructors
	/******************************************************************/
	public function __construct() {
		$argv = func_get_args();
		switch( func_num_args() ) {
			case 0:
				self::__constructBase();
				break;
			case 1:
				self::__constructPK( $argv[0] );
				break;
			case 3:
				self::__constructFull( $argv[0], $argv[1], $argv[2] );
		}
	}


	public function __constructBase() {
		$this->TaskTypeID = 0;
		$this->TaskType = "";
		$this->Description = "";
	}


	public function __constructPK($paramId) {
		$this->load($paramId);
	}


	public function __constructFull($paramTaskTypeID,$paramTaskType,$paramDescription) {
		$this->TaskTypeID = $paramTaskTypeID;
		$this->TaskType = $paramTaskType;
		$this->Description = $paramDescription;
	}


	/******************************************************************/
	// Accessors / Mutators
	/******************************************************************/

	public function getTaskTypeID(){
		return $this->TaskTypeID;
	}
	public function setTaskTypeID($value){
		$this->TaskTypeID = $value;
	}
	public function getTaskType(){
		return $this->TaskType;
	}
	public function setTaskType($value){
		$this->TaskType = $value;
	}
	public function getDescription(){
		return $this->Description;
	}
	public function setDescription($value){
		$this->Description = $value;
	}


	/******************************************************************/
	// Public Methods
	/******************************************************************/


	public function load($paramId) {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_tasktypes_Load(?)');
		$stmt->bind_param('i', $paramId);
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);

		while ($row = $result->fetch_assoc()) {
		 $this->setTaskTypeID($row['TaskTypeID']);
		 $this->setTaskType($row['TaskType']);
		 $this->setDescription($row['Description']);
		}
	}


	public function save() {
		if ($this->getTaskTypeID() == 0)
			$this->insert();
		else
			$this->update();
	}

	/******************************************************************/
	// Private Methods
	/******************************************************************/



	private function insert() {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_tasktypes_Add(?,?)');
		$arg1 = $this->getTaskType();
		$arg2 = $this->getDescription();
		$stmt->bind_param('ss',$arg1,$arg2);
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);
		while ($row = $result->fetch_assoc()) {
			// By default, the DALGen generated INSERT procedure returns the scope identity as id
			$this->load($row['id']);
		}
	}


	private function update() {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_tasktypes_Update(?,?,?)');
		$arg1 = $this->getTaskTypeID();
		$arg2 = $this->getTaskType();
		$arg3 = $this->getDescription();
		$stmt->bind_param('iss',$arg1,$arg2,$arg3);
		$stmt->execute();
	}

	private static function setNullValue($value){
		if ($value == "")
			return null;
		else
			return $value;
	}

	/******************************************************************/
	// Static Methods
	/******************************************************************/



	public static function loadall() {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_tasktypes_LoadAll()');
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);
		if ($result->num_rows > 0) {
			$arr = array();
			while ($row = $result->fetch_assoc()) {
				$tasktypes = new Tasktypes($row['TaskTypeID'],$row['TaskType'],$row['Description']);
				$arr[] = $tasktypes;
			}
			return $arr;
		}
		else {
			return array();
		}
	}


	public static function remove($paramId) {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_tasktypes_Remove(?)');
		$stmt->bind_param('i', $paramId);
		$stmt->execute();
	}


	public static function search($paramTaskTypeID,$paramTaskType,$paramDescription) {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_tasktypes_Search(?,?,?)');
		$arg1 = Tasktypes::setNullValue($paramTaskTypeID);
		$arg2 = Tasktypes::setNullValue($paramTaskType);
		$arg3 = Tasktypes::setNullValue($paramDescription);
		$stmt->bind_param('iss',$arg1,$arg2,$arg3);
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);
		if ($result->num_rows > 0) {
			$arr = array();
			while ($row = $result->fetch_assoc()) {
				$tasktypes = new Tasktypes($row['TaskTypeID'],$row['TaskType'],$row['Description']);
				$arr[] = $tasktypes;
			}
			return $arr;
		}
		else {
			return array();
		}
	}
}
