

CREATE TABLE `pagination` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `Pagination` int(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;


INSERT INTO pagination VALUES
("1","5");




CREATE TABLE `todolist` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `List` varchar(255) NOT NULL,
  `Date` datetime DEFAULT NULL,
  `Status` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;


INSERT INTO todolist VALUES
("29","Buy groceries","2021-11-14 00:00:00","Completed"),
("30","Pay bills","2021-11-14 00:00:00","Completed"),
("31","Take dog for a walk","2021-11-14 00:00:00","Completed"),
("32","Fix broken chair","2021-11-14 00:00:00","Completed"),
("41","Take dog for a walk","2021-11-14 15:12:42","Completed"),
("42","Buy groceries","2021-11-14 15:12:44","Completed"),
("43","Fix broken chair","2021-11-14 15:12:46","Completed"),
("44","Take dog for a walk","2021-11-14 15:12:48","Completed"),
("45","Buy groceries","2021-11-14 15:12:50","Completed"),
("46","Take dog for a walk","2021-11-14 15:12:55","Completed"),
("47","Buy groceries","2021-11-14 15:13:44","Completed"),
("49","Take dog for a walk","2021-11-14 15:24:08","To Do"),
("50","Fix broken chair","2021-11-14 15:24:12","Completed");


