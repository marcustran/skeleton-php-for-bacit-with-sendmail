
-- Must run this before testing the site!!!!

drop schema if EXISTS eksamen2020;
create schema eksamen2020;
use eksamen2020;
CREATE TABLE member (
    memberID int UNIQUE AUTO_INCREMENT ,
    userName varchar(255),
    password varchar(255),
    email VARCHAR (255),
    firstName varchar(255),
    lastName varchar(255),
    streetName VARCHAR (255),
    city VARCHAR (255),
    postalCode INT (10),
    gender VARCHAR (255),
    DoB DATE ,
    phone INT (255),
    regDate DATETIME DEFAULT CURRENT_TIMESTAMP ,
    `name` varchar(255),
    status ENUM("Active", "Inactive") DEFAULT "Active",
    PRIMARY KEY (memberID),
    UNIQUE KEY `userName` (`userName`)
);
CREATE TABLE activities(
    activityID int UNIQUE AUTO_INCREMENT,
    startDate DATE,
    endDate DATE,
    activityDescription VARCHAR (255),
    PRIMARY KEY (activityID)
);

CREATE TABLE activities_bridge(
    activityID int ,
    memberID int ,
    FOREIGN KEY (activityID) REFERENCES activities(activityID),
    FOREIGN KEY (memberID) REFERENCES member(memberID)

);

CREATE TABLE interest(
    interestID int UNIQUE AUTO_INCREMENT,
    interestName VARCHAR (255) UNIQUE,  
    PRIMARY KEY (interestID)
);


CREATE TABLE interest_bridge(
    interestID int ,
    memberID int ,
    FOREIGN KEY (interestID) REFERENCES interest(interestID),
    FOREIGN KEY (memberID) REFERENCES member(memberID)

);