<?php
/*
Author:			This code was generated by DALGen version 1.0.0.0 available at https://github.com/H0r53/DALGen 
Date:			10/18/2017
Description:	Creates the DAL class for  commentstatustypes table and respective stored procedures

*/



class Commentstatustypes {

	// This is for local purposes only! In hosted environments the db_settings.php file should be outside of the webroot, such as: include("/outside-webroot/db_settings.php");
	protected static function getDbSettings() { return "DAL/db_localsettings.php"; }

	/******************************************************************/
	// Properties
	/******************************************************************/

	protected $CommentStatusTypeID;
	protected $CommentStatusType;
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
		$this->CommentStatusTypeID = 0;
		$this->CommentStatusType = "";
		$this->Description = "";
	}


	public function __constructPK($paramId) {
		$this->load($paramId);
	}


	public function __constructFull($paramCommentStatusTypeID,$paramCommentStatusType,$paramDescription) {
		$this->CommentStatusTypeID = $paramCommentStatusTypeID;
		$this->CommentStatusType = $paramCommentStatusType;
		$this->Description = $paramDescription;
	}


	/******************************************************************/
	// Accessors / Mutators
	/******************************************************************/

	public function getCommentStatusTypeID(){
		return $this->CommentStatusTypeID;
	}
	public function setCommentStatusTypeID($value){
		$this->CommentStatusTypeID = $value;
	}
	public function getCommentStatusType(){
		return $this->CommentStatusType;
	}
	public function setCommentStatusType($value){
		$this->CommentStatusType = $value;
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
		$stmt = $conn->prepare('CALL usp_commentstatustypes_Load(?)');
		$stmt->bind_param('i', $paramId);
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);

		while ($row = $result->fetch_assoc()) {
		 $this->setCommentStatusTypeID($row['CommentStatusTypeID']);
		 $this->setCommentStatusType($row['CommentStatusType']);
		 $this->setDescription($row['Description']);
		}
	}


	public function save() {
		if ($this->getCommentStatusTypeID() == 0)
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
		$stmt = $conn->prepare('CALL usp_commentstatustypes_Add(?,?)');
		$arg1 = $this->getCommentStatusType();
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
		$stmt = $conn->prepare('CALL usp_commentstatustypes_Update(?,?,?)');
		$arg1 = $this->getCommentStatusTypeID();
		$arg2 = $this->getCommentStatusType();
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
		$stmt = $conn->prepare('CALL usp_commentstatustypes_LoadAll()');
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);
		if ($result->num_rows > 0) {
			$arr = array();
			while ($row = $result->fetch_assoc()) {
				$commentstatustypes = new Commentstatustypes($row['CommentStatusTypeID'],$row['CommentStatusType'],$row['Description']);
				$arr[] = $commentstatustypes;
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
		$stmt = $conn->prepare('CALL usp_commentstatustypes_Remove(?)');
		$stmt->bind_param('i', $paramId);
		$stmt->execute();
	}


	public static function search($paramCommentStatusTypeID,$paramCommentStatusType,$paramDescription) {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_commentstatustypes_Search(?,?,?)');
		$arg1 = Commentstatustypes::setNullValue($paramCommentStatusTypeID);
		$arg2 = Commentstatustypes::setNullValue($paramCommentStatusType);
		$arg3 = Commentstatustypes::setNullValue($paramDescription);
		$stmt->bind_param('iss',$arg1,$arg2,$arg3);
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);
		if ($result->num_rows > 0) {
			$arr = array();
			while ($row = $result->fetch_assoc()) {
				$commentstatustypes = new Commentstatustypes($row['CommentStatusTypeID'],$row['CommentStatusType'],$row['Description']);
				$arr[] = $commentstatustypes;
			}
			return $arr;
		}
		else {
			return array();
		}
	}
}
