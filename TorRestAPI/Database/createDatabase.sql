DROP DATABASE IF EXISTS Tor_IPsDB;

CREATE DATABASE Tor_IPsDB;

USE Tor_IPsDB;

CREATE TABLE HiddenIPs (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Address VARCHAR(200) UNIQUE NOT NULL
);

CREATE USER IF NOT EXISTS 'App_User' IDENTIFIED BY 'V&4Dp5C1TW78J';

GRANT INSERT, SELECT, UPDATE, DELETE
ON Tor_IPsDB.* TO 'App_User';