/*
Author:			This code was generated by DALGen version 1.0.0.0 available at https://github.com/H0r53/DALGen 
Date:			10/18/2017
Description:	Creates the projectcategorytypes table and respective stored procedures

*/


USE smithadb;



--------------------------------------------------------------
-- Create table
--------------------------------------------------------------



CREATE TABLE `smithadb`.`projectcategorytypes` (
ProjectCategoryID INT AUTO_INCREMENT,
ProjectCategory VARCHAR(255),
Description VARCHAR(1025),
CONSTRAINT pk_projectcategorytypes_ProjectCategoryID PRIMARY KEY (ProjectCategoryID)
);


--------------------------------------------------------------
-- Create default SCRUD sprocs for this table
--------------------------------------------------------------


DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_projectcategorytypes_Load`
(
	 IN paramProjectCategoryID INT
)
BEGIN
	SELECT
		`projectcategorytypes`.`ProjectCategoryID` AS `ProjectCategoryID`,
		`projectcategorytypes`.`ProjectCategory` AS `ProjectCategory`,
		`projectcategorytypes`.`Description` AS `Description`
	FROM `projectcategorytypes`
	WHERE 		`projectcategorytypes`.`ProjectCategoryID` = paramProjectCategoryID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_projectcategorytypes_LoadAll`()
BEGIN
	SELECT
		`projectcategorytypes`.`ProjectCategoryID` AS `ProjectCategoryID`,
		`projectcategorytypes`.`ProjectCategory` AS `ProjectCategory`,
		`projectcategorytypes`.`Description` AS `Description`
	FROM `projectcategorytypes`;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_projectcategorytypes_Add`
(
	 IN paramProjectCategory VARCHAR(255),
	 IN paramDescription VARCHAR(1025)
)
BEGIN
	INSERT INTO `projectcategorytypes` (ProjectCategory,Description)
	VALUES (paramProjectCategory, paramDescription);
	-- Return last inserted ID as result
	SELECT LAST_INSERT_ID() as id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_projectcategorytypes_Update`
(
	IN paramProjectCategoryID INT,
	IN paramProjectCategory VARCHAR(255),
	IN paramDescription VARCHAR(1025)
)
BEGIN
	UPDATE `projectcategorytypes`
	SET ProjectCategory = paramProjectCategory
		,Description = paramDescription
	WHERE		`projectcategorytypes`.`ProjectCategoryID` = paramProjectCategoryID;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_projectcategorytypes_Delete`
(
	IN paramProjectCategoryID INT
)
BEGIN
	DELETE FROM `projectcategorytypes`
	WHERE		`projectcategorytypes`.`ProjectCategoryID` = paramProjectCategoryID;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_projectcategorytypes_Search`
(
	IN paramProjectCategoryID INT,
	IN paramProjectCategory VARCHAR(255),
	IN paramDescription VARCHAR(1025)
)
BEGIN
	SELECT
		`projectcategorytypes`.`ProjectCategoryID` AS `ProjectCategoryID`,
		`projectcategorytypes`.`ProjectCategory` AS `ProjectCategory`,
		`projectcategorytypes`.`Description` AS `Description`
	FROM `projectcategorytypes`
	WHERE
		COALESCE(projectcategorytypes.`ProjectCategoryID`,0) = COALESCE(paramProjectCategoryID,projectcategorytypes.`ProjectCategoryID`,0)
		AND COALESCE(projectcategorytypes.`ProjectCategory`,'') = COALESCE(paramProjectCategory,projectcategorytypes.`ProjectCategory`,'')
		AND COALESCE(projectcategorytypes.`Description`,'') = COALESCE(paramDescription,projectcategorytypes.`Description`,'');
END //
DELIMITER ;

