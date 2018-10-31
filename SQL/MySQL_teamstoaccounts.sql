/*
Author:			This code was generated by DALGen version 1.0.0.0 available at https://github.com/H0r53/DALGen 
Date:			11/19/2017
Description:	Creates the teamstoaccounts table and respective stored procedures

*/


USE tasktracker;



-- -----------------
-- ----------------- Create table
-- -----------------



CREATE TABLE `tasktracker`.`teamstoaccounts` (
TeamToAccountID INT AUTO_INCREMENT,
TeamID INT,
AccountID INT,
CONSTRAINT pk_teamstoaccounts_TeamToAccountID PRIMARY KEY (TeamToAccountID)
,
CONSTRAINT fk_teamstoaccounts_TeamID_teams_TeamID FOREIGN KEY (TeamID) REFERENCES teams (TeamID)
,
CONSTRAINT fk_teamstoaccounts_AccountID_accounts_AccountID FOREIGN KEY (AccountID) REFERENCES accounts (AccountID)
);


-- -----------------
-- ----------------- Create default SCRUD sprocs for this table
-- -----------------


DELIMITER //
CREATE PROCEDURE `tasktracker`.`usp_teamstoaccounts_Load`
(
	 IN paramTeamToAccountID INT
)
BEGIN
	SELECT
		`teamstoaccounts`.`TeamToAccountID` AS `TeamToAccountID`,
		`teamstoaccounts`.`TeamID` AS `TeamID`,
		`teamstoaccounts`.`AccountID` AS `AccountID`
	FROM `teamstoaccounts`
	WHERE 		`teamstoaccounts`.`TeamToAccountID` = paramTeamToAccountID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `tasktracker`.`usp_teamstoaccounts_LoadAll`()
BEGIN
	SELECT
		`teamstoaccounts`.`TeamToAccountID` AS `TeamToAccountID`,
		`teamstoaccounts`.`TeamID` AS `TeamID`,
		`teamstoaccounts`.`AccountID` AS `AccountID`
	FROM `teamstoaccounts`;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `tasktracker`.`usp_teamstoaccounts_Add`
(
	 IN paramTeamID INT,
	 IN paramAccountID INT
)
BEGIN
	INSERT INTO `teamstoaccounts` (TeamID,AccountID)
	VALUES (paramTeamID, paramAccountID);
	-- ----------------- Return last inserted ID as result
	SELECT LAST_INSERT_ID() as id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `tasktracker`.`usp_teamstoaccounts_Update`
(
	IN paramTeamToAccountID INT,
	IN paramTeamID INT,
	IN paramAccountID INT
)
BEGIN
	UPDATE `teamstoaccounts`
	SET TeamID = paramTeamID
		,AccountID = paramAccountID
	WHERE		`teamstoaccounts`.`TeamToAccountID` = paramTeamToAccountID;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `tasktracker`.`usp_teamstoaccounts_Delete`
(
	IN paramTeamToAccountID INT
)
BEGIN
	DELETE FROM `teamstoaccounts`
	WHERE		`teamstoaccounts`.`TeamToAccountID` = paramTeamToAccountID;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `tasktracker`.`usp_teamstoaccounts_Search`
(
	IN paramTeamToAccountID INT,
	IN paramTeamID INT,
	IN paramAccountID INT
)
BEGIN
	SELECT
		`teamstoaccounts`.`TeamToAccountID` AS `TeamToAccountID`,
		`teamstoaccounts`.`TeamID` AS `TeamID`,
		`teamstoaccounts`.`AccountID` AS `AccountID`
	FROM `teamstoaccounts`
	WHERE
		COALESCE(teamstoaccounts.`TeamToAccountID`,0) = COALESCE(paramTeamToAccountID,teamstoaccounts.`TeamToAccountID`,0)
		AND COALESCE(teamstoaccounts.`TeamID`,0) = COALESCE(paramTeamID,teamstoaccounts.`TeamID`,0)
		AND COALESCE(teamstoaccounts.`AccountID`,0) = COALESCE(paramAccountID,teamstoaccounts.`AccountID`,0);
END //
DELIMITER ;


