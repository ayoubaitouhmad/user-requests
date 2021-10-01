-- MariaDB dump 10.19  Distrib 10.4.20-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_user_requests
-- ------------------------------------------------------
-- Server version	10.4.20-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `admin_id` varchar(100) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_password` varchar(100) NOT NULL DEFAULT '123456789',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `admin_name` varchar(100) DEFAULT NULL,
  `admin_photo` text DEFAULT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `admin_phone` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_admin_username_uindex` (`admin_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger insertAdminPrefrences
    after insert
    on admin
    for each row
BEGIN
    insert  into  admin_settings (admin) values (NEW.admin_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `admin_notification`
--

DROP TABLE IF EXISTS `admin_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `admin` varchar(100) DEFAULT NULL,
  `user` varchar(100) NOT NULL,
  `type` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`notification_id`),
  KEY `FK_adminNotification_admin` (`admin`),
  KEY `FK_adminNotification_type` (`type`),
  KEY `FK_adminNotification_user` (`user`),
  CONSTRAINT `FK_adminNotification_admin` FOREIGN KEY (`admin`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_adminNotification_type` FOREIGN KEY (`type`) REFERENCES `notification_type` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_adminNotification_user` FOREIGN KEY (`user`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger TR_set_user_notification
    before insert
    on admin_notification
    for each row
BEGIN
    SET @notify_new_request =
            (select notifiy_when_user_send_request from user_settings where user_settings.user = NEW.user);
    SET @notify_feedback =
            (select notifiy_when_admin_send_feedback from user_settings where user_settings.user = NEW.user);
    SET @notify_securuty =
            (select notifiy_when_securuty_info_changed from user_settings where user_settings.user = NEW.user);
    SET @type = NEW.type;

    IF (@type = 2 and @notify_new_request = 0)
    THEN
        SET NEW.status = 1;
    END IF;


    IF (@type = 3 and @notify_feedback = 0)
    THEN
        SET NEW.status = 1;

    END IF;

    IF (@type = 4 and @notify_securuty = 0)
    THEN
        SET NEW.status = 1;

    END IF;


END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `admin_settings`
--

DROP TABLE IF EXISTS `admin_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_settings` (
  `admin` varchar(100) NOT NULL,
  `hide_notification` tinyint(1) DEFAULT 0,
  `toggle_sidebar` tinyint(1) DEFAULT 0,
  `notifiy_when_new_request` tinyint(1) DEFAULT 1,
  `notifiy_when_new_registre` tinyint(1) DEFAULT 1,
  UNIQUE KEY `sdadmin_settings_admin_uindex` (`admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `months`
--

DROP TABLE IF EXISTS `months`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `months` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `months_name_uindex` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notification_type`
--

DROP TABLE IF EXISTS `notification_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(100) NOT NULL,
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `UQ_notificationType__type_name` (`type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request` (
  `request_id` varchar(100) NOT NULL COMMENT 'primary key',
  `request_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'request date',
  `request_pretext` text DEFAULT NULL,
  `request_response` text DEFAULT NULL COMMENT 'request response',
  `request_status` varchar(225) DEFAULT 'pending',
  `request_type` varchar(50) NOT NULL COMMENT 'request type',
  `user_id` varchar(100) NOT NULL COMMENT 'foreign key from user table',
  PRIMARY KEY (`request_id`),
  KEY `FK_request__user` (`user_id`),
  CONSTRAINT `FK_request__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `request_types`
--

DROP TABLE IF EXISTS `request_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'create time',
  `deleted_at` datetime DEFAULT NULL COMMENT 'update time',
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `request_types_role_name_uindex` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` varchar(100) NOT NULL,
  `user_fullname` varchar(100) NOT NULL,
  `user_address` varchar(100) DEFAULT NULL,
  `user_ville` varchar(100) DEFAULT NULL,
  `user_gender` char(1) DEFAULT NULL,
  `user_dateOfBirth` date DEFAULT NULL,
  `user_phoneNumber` varchar(15) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_photo` varchar(100) DEFAULT NULL,
  `user_role` varchar(100) DEFAULT NULL,
  `user_compteEtat` varchar(100) DEFAULT 'inactive',
  `user_secretQuestion` varchar(100) DEFAULT NULL,
  `user_Response` varchar(100) DEFAULT NULL,
  `user_req_number` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_user_email_uindex` (`user_email`),
  UNIQUE KEY `user_user_phoneNumber_uindex` (`user_phoneNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER insertUserPrefrences AFTER INSERT ON user
    FOR EACH ROW
BEGIN
   insert  into  user_settings (user) values (NEW.user_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `user_notification`
--

DROP TABLE IF EXISTS `user_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `user` varchar(100) NOT NULL,
  `type` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`notification_id`),
  KEY `FK_userNotification__notificationType` (`type`),
  KEY `FK_userNotification__user` (`user`),
  CONSTRAINT `FK_userNotification__notificationType` FOREIGN KEY (`type`) REFERENCES `notification_type` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_userNotification__user` FOREIGN KEY (`user`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger TR_set_admin_notification
    before insert
    on user_notification
    for each row
BEGIN
    SET @notify_new_request = (select notifiy_when_new_request from admin_settings limit  1);
    SET @notify_new_user= (select notifiy_when_new_registre from admin_settings  limit  1);

    SET  @type  = NEW.type;

    IF(@type = 1 and @notify_new_user = 0)
    THEN
        SET NEW.status = 1;
    END IF;

    IF(@type = 2 and @notify_new_request = 0)
    THEN
        SET NEW.status = 1;
    END IF;


END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `user_roles_role_name_uindex` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_settings`
--

DROP TABLE IF EXISTS `user_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_settings` (
  `user` varchar(100) NOT NULL,
  `notifiy_when_admin_send_feedback` tinyint(1) DEFAULT 1,
  `notifiy_when_user_send_request` tinyint(1) DEFAULT 1,
  `notifiy_when_securuty_info_changed` tinyint(1) DEFAULT 1,
  `hide_notification` tinyint(1) DEFAULT 0,
  `toggle_sidebar` tinyint(1) DEFAULT 0,
  `notify_when_account_change` tinyint(1) DEFAULT 1,
  UNIQUE KEY `users_settings_user_uindex` (`user`),
  CONSTRAINT `FK__usersettings__user` FOREIGN KEY (`user`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `view_getcountrequestsbytype`
--

DROP TABLE IF EXISTS `view_getcountrequestsbytype`;
/*!50001 DROP VIEW IF EXISTS `view_getcountrequestsbytype`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_getcountrequestsbytype` (
  `type` tinyint NOT NULL,
  `count` tinyint NOT NULL,
  `percentage` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_getlastfouruser`
--

DROP TABLE IF EXISTS `view_getlastfouruser`;
/*!50001 DROP VIEW IF EXISTS `view_getlastfouruser`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_getlastfouruser` (
  `user_fullname` tinyint NOT NULL,
  `user_dateOfBirth` tinyint NOT NULL,
  `user_photo` tinyint NOT NULL,
  `user_gender` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_getnotificationcounttoday`
--

DROP TABLE IF EXISTS `view_getnotificationcounttoday`;
/*!50001 DROP VIEW IF EXISTS `view_getnotificationcounttoday`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_getnotificationcounttoday` (
  `count(*)` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_getrequestcounttoday`
--

DROP TABLE IF EXISTS `view_getrequestcounttoday`;
/*!50001 DROP VIEW IF EXISTS `view_getrequestcounttoday`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_getrequestcounttoday` (
  `count(*)` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_getuserscounttoday`
--

DROP TABLE IF EXISTS `view_getuserscounttoday`;
/*!50001 DROP VIEW IF EXISTS `view_getuserscounttoday`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_getuserscounttoday` (
  `count(*)` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_getusersrolecountbyuser`
--

DROP TABLE IF EXISTS `view_getusersrolecountbyuser`;
/*!50001 DROP VIEW IF EXISTS `view_getusersrolecountbyuser`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_getusersrolecountbyuser` (
  `role` tinyint NOT NULL,
  `count` tinyint NOT NULL,
  `percentage` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `viewgetlastfourrequests`
--

DROP TABLE IF EXISTS `viewgetlastfourrequests`;
/*!50001 DROP VIEW IF EXISTS `viewgetlastfourrequests`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `viewgetlastfourrequests` (
  `user_id` tinyint NOT NULL,
  `user_fullname` tinyint NOT NULL,
  `user_photo` tinyint NOT NULL,
  `count` tinyint NOT NULL,
  `request_date` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `viewrequestbymonthcuryear`
--

DROP TABLE IF EXISTS `viewrequestbymonthcuryear`;
/*!50001 DROP VIEW IF EXISTS `viewrequestbymonthcuryear`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `viewrequestbymonthcuryear` (
  `name` tinyint NOT NULL,
  `COUNT(request.request_id)` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `visitors`
--

DROP TABLE IF EXISTS `visitors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(100) NOT NULL,
  `date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=905 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Final view structure for view `view_getcountrequestsbytype`
--

/*!50001 DROP TABLE IF EXISTS `view_getcountrequestsbytype`*/;
/*!50001 DROP VIEW IF EXISTS `view_getcountrequestsbytype`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_getcountrequestsbytype` AS select `rr`.`name` AS `type`,count(`r`.`request_id`) AS `count`,cast(count(`r`.`request_id`) * 100 / (select count(0) from `request`) as decimal(10,0)) AS `percentage` from (`request_types` `rr` left join `request` `r` on(`rr`.`name` = `r`.`request_type`)) group by `rr`.`name` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_getlastfouruser`
--

/*!50001 DROP TABLE IF EXISTS `view_getlastfouruser`*/;
/*!50001 DROP VIEW IF EXISTS `view_getlastfouruser`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_getlastfouruser` AS select `u`.`user_fullname` AS `user_fullname`,`u`.`user_dateOfBirth` AS `user_dateOfBirth`,`u`.`user_photo` AS `user_photo`,`u`.`user_gender` AS `user_gender` from `user` `u` where `u`.`deleted_at` is null group by `u`.`user_fullname`,`u`.`user_dateOfBirth`,`u`.`user_role`,`u`.`user_gender`,`u`.`created_at` order by `u`.`created_at` desc limit 4 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_getnotificationcounttoday`
--

/*!50001 DROP TABLE IF EXISTS `view_getnotificationcounttoday`*/;
/*!50001 DROP VIEW IF EXISTS `view_getnotificationcounttoday`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_getnotificationcounttoday` AS select count(0) AS `count(*)` from `user_notification` where cast(`user_notification`.`created_at` as date) = curdate() */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_getrequestcounttoday`
--

/*!50001 DROP TABLE IF EXISTS `view_getrequestcounttoday`*/;
/*!50001 DROP VIEW IF EXISTS `view_getrequestcounttoday`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_getrequestcounttoday` AS select count(0) AS `count(*)` from `request` where cast(`request`.`request_date` as date) = curdate() */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_getuserscounttoday`
--

/*!50001 DROP TABLE IF EXISTS `view_getuserscounttoday`*/;
/*!50001 DROP VIEW IF EXISTS `view_getuserscounttoday`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_getuserscounttoday` AS select count(0) AS `count(*)` from `user` where cast(`user`.`created_at` as date) = curdate() and `user`.`deleted_at` is null */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_getusersrolecountbyuser`
--

/*!50001 DROP TABLE IF EXISTS `view_getusersrolecountbyuser`*/;
/*!50001 DROP VIEW IF EXISTS `view_getusersrolecountbyuser`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_getusersrolecountbyuser` AS select `r`.`role_name` AS `role`,count(`u`.`user_id`) AS `count`,cast(count(`u`.`user_id`) * 100 / sum(count(`u`.`user_id`)) over () as signed) AS `percentage` from (`user_roles` `r` left join `user` `u` on(`r`.`role_name` = `u`.`user_role`)) where `u`.`deleted_at` is null group by `r`.`role_name` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `viewgetlastfourrequests`
--

/*!50001 DROP TABLE IF EXISTS `viewgetlastfourrequests`*/;
/*!50001 DROP VIEW IF EXISTS `viewgetlastfourrequests`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `viewgetlastfourrequests` AS select `u`.`user_id` AS `user_id`,`u`.`user_fullname` AS `user_fullname`,`u`.`user_photo` AS `user_photo`,(select count(`rr`.`request_id`) from (`user` `uu` join `request` `rr`) where `uu`.`user_id` = `rr`.`user_id` and `rr`.`user_id` = `u`.`user_id`) AS `count`,`r`.`request_date` AS `request_date` from (`request` `r` join `user` `u`) where `r`.`user_id` = `u`.`user_id` group by `u`.`user_fullname`,`r`.`request_date` order by `r`.`request_date` desc limit 4 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `viewrequestbymonthcuryear`
--

/*!50001 DROP TABLE IF EXISTS `viewrequestbymonthcuryear`*/;
/*!50001 DROP VIEW IF EXISTS `viewrequestbymonthcuryear`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `viewrequestbymonthcuryear` AS select `m`.`name` AS `name`,count(`request`.`request_id`) AS `COUNT(request.request_id)` from (`months` `m` left join `request` on(monthname(`request`.`request_date`) = `m`.`name` and year(`request`.`request_date`) = year(curdate()))) group by field(`m`.`name`,'January','February','March','April','May','June','July','August','September','October','November','December') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-01 21:20:23
