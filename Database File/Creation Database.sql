CREATE DATABASE IF NOT EXISTS `b7_28056591_yugioh` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `b7_28056591_yugioh`;

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `EventId` int(11) NOT NULL AUTO_INCREMENT,
  `EventName` varchar(100) NOT NULL,
  `EventAtShop` tinyint(1) NOT NULL,
  `EventShopId` int(11) NOT NULL,
  `EventStreet` varchar(100) NOT NULL,
  `EventNumber` varchar(8) NOT NULL,
  `EventCity` varchar(50) NOT NULL,
  `EventPostCode` int(8) NOT NULL,
  `EventCountry` varchar(30) NOT NULL,
  `EventDate` datetime NOT NULL,
  `EventMaxEntry` int(7) NOT NULL,
  `EventFixedPrice` tinyint(1) NOT NULL,
  `EventMinPrice` int(4) NOT NULL,
  `EventMaxPrice` int(4) NOT NULL,
  `EventGiftName` varchar(150) NOT NULL,
  `EventGiftLimite` smallint(3) NOT NULL,
  `EventGiftScale` int(4) NOT NULL,
  `EventInfo` varchar(500) DEFAULT NULL,
  `EventRemote` tinyint(1) NOT NULL,
  `EventType` varchar(15) NOT NULL DEFAULT 'OTS',
  PRIMARY KEY (`EventId`),
  KEY `fk_EventShopId` (`EventShopId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `participate`;
CREATE TABLE IF NOT EXISTS `participate` (
  `UserId` int(11) NOT NULL,
  `EventId` int(11) NOT NULL,
  `Payed` tinyint(1) NOT NULL,
  `PricePayed` int(11) NOT NULL,
  `PayementMethod` varchar(30) NOT NULL,
  `GiftReceive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserId`,`EventId`) USING BTREE,
  KEY `fkEventId` (`EventId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shop`;
CREATE TABLE IF NOT EXISTS `shop` (
  `ShopId` int(11) NOT NULL AUTO_INCREMENT,
  `ShopName` varchar(70) NOT NULL,
  `ShopStreet` varchar(100) NOT NULL,
  `ShopNumber` varchar(8) NOT NULL,
  `ShopCity` varchar(50) NOT NULL,
  `ShopPostCode` int(8) NOT NULL,
  `ShopCountry` varchar(30) NOT NULL,
  `ShopMail` varchar(100) NOT NULL,
  `ShopPhone` varchar(30) NOT NULL,
  PRIMARY KEY (`ShopId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `useraccount`;
CREATE TABLE IF NOT EXISTS `useraccount` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `UserPseudo` varchar(25) NOT NULL,
  `UserPassword` varchar(50) NOT NULL,
  `UserKonamiId` varchar(12) DEFAULT NULL,
  `UserLastName` varchar(70) NOT NULL,
  `UserFirstName` varchar(50) NOT NULL,
  `UserMail` varchar(100) NOT NULL,
  `UserPhone` varchar(30) DEFAULT NULL,
  `UserRole` varchar(10) NOT NULL,
  `UserShopId` int(11) DEFAULT NULL,
  PRIMARY KEY (`UserId`),
  KEY `fkUserShopId` (`UserShopId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `event`
  ADD CONSTRAINT `fk_EventShopId` FOREIGN KEY (`EventShopId`) REFERENCES `shop` (`ShopId`) ON DELETE CASCADE;

ALTER TABLE `participate`
  ADD CONSTRAINT `fkEventId` FOREIGN KEY (`EventId`) REFERENCES `event` (`EventId`) ON DELETE CASCADE,
  ADD CONSTRAINT `fkUserId` FOREIGN KEY (`UserId`) REFERENCES `useraccount` (`UserId`) ON DELETE CASCADE;

ALTER TABLE `useraccount`
  ADD CONSTRAINT `fkUserShopId` FOREIGN KEY (`UserShopId`) REFERENCES `shop` (`ShopId`) ON DELETE CASCADE;


