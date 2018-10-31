<?php
/*
Author:			This code was generated by DALGen version 1.0.0.0 available at https://github.com/H0r53/DALGen 
Date:			10/18/2017
Description:	Creates the DAL class for  projects table and respective stored procedures

*/



class Projects {

	// This is for local purposes only! In hosted environments the db_settings.php file should be outside of the webroot, such as: include("/outside-webroot/db_settings.php");
	protected static function getDbSettings() { return "DAL/db_localsettings.php"; }

	/******************************************************************/
	// Properties
	/******************************************************************/

	protected $ProjectID;
	protected $ProjectName;
	protected $ProjectDescription;
	protected $ImgURL;
	protected $ProjectURL;
	protected $ProjectLeadAccountID;
	protected $ProjectCategoryID;


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
			case 7:
				self::__constructFull( $argv[0], $argv[1], $argv[2], $argv[3], $argv[4], $argv[5], $argv[6] );
		}
	}


	public function __constructBase() {
		$this->ProjectID = 0;
		$this->ProjectName = "";
		$this->ProjectDescription = "";
		$this->ImgURL = "";
		$this->ProjectURL = "";
		$this->ProjectLeadAccountID = 0;
		$this->ProjectCategoryID = 0;
	}


	public function __constructPK($paramId) {
		$this->load($paramId);
	}


	public function __constructFull($paramProjectID,$paramProjectName,$paramProjectDescription,$paramImgURL,$paramProjectURL,$paramProjectLeadAccountID,$paramProjectCategoryID) {
		$this->ProjectID = $paramProjectID;
		$this->ProjectName = $paramProjectName;
		$this->ProjectDescription = $paramProjectDescription;
		$this->ImgURL = $paramImgURL;
		$this->ProjectURL = $paramProjectURL;
		$this->ProjectLeadAccountID = $paramProjectLeadAccountID;
		$this->ProjectCategoryID = $paramProjectCategoryID;
	}


	/******************************************************************/
	// Accessors / Mutators
	/******************************************************************/

	public function getProjectID(){
		return $this->ProjectID;
	}
	public function setProjectID($value){
		$this->ProjectID = $value;
	}
	public function getProjectName(){
		return $this->ProjectName;
	}
	public function setProjectName($value){
		$this->ProjectName = $value;
	}
	public function getProjectDescription(){
		return $this->ProjectDescription;
	}
	public function setProjectDescription($value){
		$this->ProjectDescription = $value;
	}
	public function getImgURL(){
		return $this->ImgURL;
	}
	public function setImgURL($value){
		$this->ImgURL = $value;
	}
	public function getProjectURL(){
		return $this->ProjectURL;
	}
	public function setProjectURL($value){
		$this->ProjectURL = $value;
	}
	public function getProjectLeadAccountID(){
		return $this->ProjectLeadAccountID;
	}
	public function setProjectLeadAccountID($value){
		$this->ProjectLeadAccountID = $value;
	}
	public function getProjectCategoryID(){
		return $this->ProjectCategoryID;
	}
	public function setProjectCategoryID($value){
		$this->ProjectCategoryID = $value;
	}


	/******************************************************************/
	// Public Methods
	/******************************************************************/


	public function load($paramId) {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_projects_Load(?)');
		$stmt->bind_param('i', $paramId);
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);

		while ($row = $result->fetch_assoc()) {
		 $this->setProjectID($row['ProjectID']);
		 $this->setProjectName($row['ProjectName']);
		 $this->setProjectDescription($row['ProjectDescription']);
		 $this->setImgURL($row['ImgURL']);
		 $this->setProjectURL($row['ProjectURL']);
		 $this->setProjectLeadAccountID($row['ProjectLeadAccountID']);
		 $this->setProjectCategoryID($row['ProjectCategoryID']);
		}
	}


	public function save() {
		if ($this->getProjectID() == 0)
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
		$stmt = $conn->prepare('CALL usp_projects_Add(?,?,?,?,?,?)');
		$arg1 = $this->getProjectName();
		$arg2 = $this->getProjectDescription();
		$arg3 = $this->getImgURL();
		$arg4 = $this->getProjectURL();
		$arg5 = $this->getProjectLeadAccountID();
		$arg6 = $this->getProjectCategoryID();
		$stmt->bind_param('ssssii',$arg1,$arg2,$arg3,$arg4,$arg5,$arg6);
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
		$stmt = $conn->prepare('CALL usp_projects_Update(?,?,?,?,?,?,?)');
		$arg1 = $this->getProjectID();
		$arg2 = $this->getProjectName();
		$arg3 = $this->getProjectDescription();
		$arg4 = $this->getImgURL();
		$arg5 = $this->getProjectURL();
		$arg6 = $this->getProjectLeadAccountID();
		$arg7 = $this->getProjectCategoryID();
		$stmt->bind_param('issssii',$arg1,$arg2,$arg3,$arg4,$arg5,$arg6,$arg7);
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
		$stmt = $conn->prepare('CALL usp_projects_LoadAll()');
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);
		if ($result->num_rows > 0) {
			$arr = array();
			while ($row = $result->fetch_assoc()) {
				$projects = new Projects($row['ProjectID'],$row['ProjectName'],$row['ProjectDescription'],$row['ImgURL'],$row['ProjectURL'],$row['ProjectLeadAccountID'],$row['ProjectCategoryID']);
				$arr[] = $projects;
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
		$stmt = $conn->prepare('CALL usp_projects_Remove(?)');
		$stmt->bind_param('i', $paramId);
		$stmt->execute();
	}


	public static function search($paramProjectID,$paramProjectName,$paramProjectDescription,$paramImgURL,$paramProjectURL,$paramProjectLeadAccountID,$paramProjectCategoryID) {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_projects_Search(?,?,?,?,?,?,?)');
		$arg1 = Projects::setNullValue($paramProjectID);
		$arg2 = Projects::setNullValue($paramProjectName);
		$arg3 = Projects::setNullValue($paramProjectDescription);
		$arg4 = Projects::setNullValue($paramImgURL);
		$arg5 = Projects::setNullValue($paramProjectURL);
		$arg6 = Projects::setNullValue($paramProjectLeadAccountID);
		$arg7 = Projects::setNullValue($paramProjectCategoryID);
		$stmt->bind_param('issssii',$arg1,$arg2,$arg3,$arg4,$arg5,$arg6,$arg7);
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);
		if ($result->num_rows > 0) {
			$arr = array();
			while ($row = $result->fetch_assoc()) {
				$projects = new Projects($row['ProjectID'],$row['ProjectName'],$row['ProjectDescription'],$row['ImgURL'],$row['ProjectURL'],$row['ProjectLeadAccountID'],$row['ProjectCategoryID']);
				$arr[] = $projects;
			}
			return $arr;
		}
		else {
			return array();
		}
	}
}
