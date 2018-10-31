
CREATE DATABASE tasktracker;
CREATE USER 'taskwebapp'@'localhost' IDENTIFIED BY 'password';
GRANT SELECT ON `tasktracker`.* TO `taskwebapp`@'localhost';
GRANT EXECUTE ON `tasktracker`.* TO `taskwebapp`@'localhost';
