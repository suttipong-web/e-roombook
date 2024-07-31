/*
Navicat MySQL Data Transfer

Source Server         : XamppServer
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : eroombook

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-07-31 13:07:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for action_status
-- ----------------------------
DROP TABLE IF EXISTS `action_status`;
CREATE TABLE `action_status` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `action_en` varchar(20) DEFAULT NULL,
  `action_th` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of action_status
-- ----------------------------
INSERT INTO `action_status` VALUES ('1', 'approved', 'อนุมัติ');
INSERT INTO `action_status` VALUES ('2', 'canceled', 'ไม่อนุมัติ');
INSERT INTO `action_status` VALUES ('3', 'ForwardDean', 'ส่งต่อผู้บริหาร');

-- ----------------------------
-- Table structure for adminroom_type
-- ----------------------------
DROP TABLE IF EXISTS `adminroom_type`;
CREATE TABLE `adminroom_type` (
  `type_id` smallint(4) NOT NULL,
  `type_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of adminroom_type
-- ----------------------------
INSERT INTO `adminroom_type` VALUES ('1', 'เจ้าหน้าที่ผู้ดูแลประจำห้อง');
INSERT INTO `adminroom_type` VALUES ('2', 'Admin ความคุมการอนุมัติ');

-- ----------------------------
-- Table structure for admin_roooms
-- ----------------------------
DROP TABLE IF EXISTS `admin_roooms`;
CREATE TABLE `admin_roooms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `roomID` int(11) NOT NULL,
  `cmuitaccount` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `adminroom_type_id` smallint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_roooms
-- ----------------------------
INSERT INTO `admin_roooms` VALUES ('1', '11', 'suttipong.r@cmu.ac.th', '4120', '0', null, '2024-07-23 20:26:22');
INSERT INTO `admin_roooms` VALUES ('6', '11', 'akaradate.p@cmu.ac.th', '4120', '0', '2024-07-23 20:45:38', '2024-07-23 20:45:38');
INSERT INTO `admin_roooms` VALUES ('7', '11', 'winai.k@cmu.ac.th', '14120', '0', '2024-07-23 20:49:23', '2024-07-23 20:49:23');
INSERT INTO `admin_roooms` VALUES ('9', '13', 'suttipong.r@cmu.ac.th', '4120', '2', '2024-07-27 17:12:01', '2024-07-27 17:12:01');

-- ----------------------------
-- Table structure for booking_assign2
-- ----------------------------
DROP TABLE IF EXISTS `booking_assign2`;
CREATE TABLE `booking_assign2` (
  `id` int(11) NOT NULL,
  `cmuitaccount` varchar(120) DEFAULT NULL,
  `bookingID` bigint(20) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `is_send_email` tinyint(1) DEFAULT 0,
  `is_send_line` tinyint(1) DEFAULT 0,
  `is_confirm` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of booking_assign2
-- ----------------------------

-- ----------------------------
-- Table structure for booking_assigns
-- ----------------------------
DROP TABLE IF EXISTS `booking_assigns`;
CREATE TABLE `booking_assigns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cmuitaccount` varchar(255) NOT NULL,
  `bookingID` bigint(20) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `is_send_email` tinyint(1) NOT NULL DEFAULT 0,
  `is_send_line` tinyint(1) NOT NULL DEFAULT 0,
  `is_confirm` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of booking_assigns
-- ----------------------------
INSERT INTO `booking_assigns` VALUES ('3', 'suttipong.r@cmu.ac.th', '16', '0', '0', '0', '0', '2024-07-22 03:55:37', '2024-07-22 03:55:37');
INSERT INTO `booking_assigns` VALUES ('4', 'akaradate.p@cmu.ac.th', '16', '0', '0', '0', '0', '2024-07-22 03:57:18', '2024-07-22 03:57:18');
INSERT INTO `booking_assigns` VALUES ('5', 'sittipong.b@cmu.ac.th', '26', '0', '0', '0', '0', '2024-07-28 09:01:43', '2024-07-28 09:01:43');
INSERT INTO `booking_assigns` VALUES ('6', 'suttipong.r@cmu.ac.th', '26', '0', '0', '0', '0', '2024-07-28 09:02:11', '2024-07-28 09:02:11');

-- ----------------------------
-- Table structure for booking_rooms
-- ----------------------------
DROP TABLE IF EXISTS `booking_rooms`;
CREATE TABLE `booking_rooms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_no` varchar(50) NOT NULL,
  `roomID` int(10) DEFAULT 0,
  `booking_date` char(10) DEFAULT NULL,
  `schedule_startdate` date DEFAULT NULL,
  `schedule_enddate` date DEFAULT NULL,
  `booking_time_start` time DEFAULT NULL,
  `booking_time_finish` time DEFAULT NULL,
  `booking_subject` varchar(255) DEFAULT NULL,
  `booking_subject_sec` varchar(255) DEFAULT NULL,
  `booking_Instructor` varchar(255) DEFAULT NULL,
  `booking_booker` varchar(255) DEFAULT NULL,
  `booking_ofPeople` smallint(6) NOT NULL DEFAULT 0,
  `booking_department` varchar(255) DEFAULT NULL,
  `booking_autio` tinyint(1) NOT NULL DEFAULT 0,
  `booking_lcd` tinyint(1) NOT NULL DEFAULT 0,
  `booking_computer` tinyint(1) NOT NULL DEFAULT 0,
  `booking_zoom` varchar(255) DEFAULT NULL,
  `bookingToken` varchar(255) DEFAULT NULL,
  `booking_status` tinyint(4) NOT NULL DEFAULT 0,
  `booking_type` varchar(15) NOT NULL DEFAULT '',
  `booking_AdminAction` varchar(20) DEFAULT '',
  `booking_DeanAction` varchar(20) DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `booking_at` timestamp NULL DEFAULT NULL,
  `booking_cancel` tinyint(1) DEFAULT 0,
  `booker_cmuaccount` varchar(255) DEFAULT NULL,
  `booking_food` tinyint(1) DEFAULT 0,
  `booking_camera` tinyint(1) DEFAULT 0,
  `booking_email` varchar(255) DEFAULT NULL,
  `booking_phone` varchar(100) DEFAULT NULL,
  `admin_action_date` datetime DEFAULT NULL,
  `dean_action_date` datetime DEFAULT NULL,
  `admin_action_acount` varchar(255) DEFAULT '',
  `dean_action_acount` varchar(255) DEFAULT NULL,
  `booking_fileurl` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of booking_rooms
-- ----------------------------
INSERT INTO `booking_rooms` VALUES ('2', '1719283893', '2', null, '2024-07-09', '2024-07-09', '11:30:00', '13:00:00', 'ประชุม', null, null, '1323', '1', '1', '0', '0', '0', '1', 'fcf7fbd86be9f3b326c2b3f74582ed95', '1', '0', 'canceled', '0', '12123', '2024-06-25 02:51:33', '1', null, '1', '1', 'suttipong.r@cmu.ac.th', '053944120', '2024-06-29 07:29:02', '0000-00-00 00:00:00', 'suttipong.r@cmu.ac.th', null, null, '1', '2024-06-25 02:51:33', '2024-06-25 02:51:33');
INSERT INTO `booking_rooms` VALUES ('9', '1719285260', '2', null, '2024-07-09', '2024-07-09', '09:00:00', '10:30:00', 'ประชุมติดตามระบบ E-Project', null, null, 'หน่วยงานเทนโน ฯ', '10', '10', '0', '0', '1', '1', 'd95d6df6524fa7b190046bc55e91ba9c', '1', '0', 'approved', '0', 'test', '2024-06-25 03:14:20', '0', null, '1', '1', 'suttipong.r@cmu.ac.th', '053944120', '2024-06-29 07:26:10', '0000-00-00 00:00:00', 'suttipong.r@cmu.ac.th', null, null, '1', '2024-06-25 03:14:20', '2024-06-25 03:14:20');
INSERT INTO `booking_rooms` VALUES ('10', '1719286608', '3', null, '2024-07-11', '2024-07-11', '09:00:00', '09:00:00', '1111321', null, null, 'AOd', '11', '5525', '0', '0', '1', '1', 'e6fe6cb86c6347047138039ea75ac5c9', '1', '0', 'canceled', '0', 'test ssend', '2024-06-25 03:36:48', '1', null, '1', '1', 'suttipong.r@cmu.ac.th', '053944120', '2024-06-29 07:35:28', null, 'suttipong.r@cmu.ac.th', null, null, '1', '2024-06-25 03:36:48', '2024-06-25 03:36:48');
INSERT INTO `booking_rooms` VALUES ('11', '1719287560', '3', null, '2024-07-12', '2024-07-12', '09:00:00', '09:00:00', '1111321', null, null, 'AOd', '11', '5525', '0', '0', '1', '1', 'b3b60f3e56c0e6ae279e9bfe00b11915', '2', '0', 'ForwardDean', '0', 'test ssend', '2024-06-25 03:52:40', '0', null, '1', '1', 'suttipong.r@cmu.ac.th', '053944120', '2024-06-29 07:38:34', null, 'suttipong.r@cmu.ac.th', null, null, '1', '2024-06-25 03:52:40', '2024-06-25 03:52:40');
INSERT INTO `booking_rooms` VALUES ('12', '1719288310', '2', null, '2024-07-12', '2024-07-12', '11:00:00', '12:00:00', 'ประชุม999 ประชุมติดตามระบบ E-Project', null, null, 'AOd', '1', '12', '0', '0', '1', '1', '545f314f6d62f98f30c8ba8867c8dae7', '0', '0', '', '0', 'test', '2024-06-25 04:05:10', '0', null, '1', '1', 'suttipong.r@cmu.ac.th', '053944120', null, null, null, null, null, '1', '2024-06-25 04:05:10', '2024-06-25 04:05:10');
INSERT INTO `booking_rooms` VALUES ('13', '1719288738', '2', null, '2024-07-12', '2024-07-12', '13:00:00', '15:30:00', 'หารือกับสมาคม นศ.เก่า เรื่องการจัดกิจกรรมระหว่างสมาคมและคณะ หารือกับสมาคม นศ.เก่า เรื่องการจัดกิจกรรมระหว่างสมาคมและคณะ', null, null, 'AOd333', '12', null, '0', '0', '1', '1', '087a0f18cd3890a01807b71cfa9a3722', '1', '0', 'canceled', '0', '23858282828', '2024-06-25 04:12:18', '1', null, '1', '1', 'suttipong.r@cmu.ac.th', '053944120', '2024-06-29 13:53:09', null, 'suttipong.r@cmu.ac.th', null, null, '1', '2024-06-25 04:12:18', '2024-06-25 04:12:18');
INSERT INTO `booking_rooms` VALUES ('14', '1719298867', '2', null, '2024-07-13', '2024-07-13', '16:00:00', '17:00:00', 'ประชุม88844', null, null, 'AOd', '123', '123', '0', '0', '1', '1', '3116c765babee8bee2198b2ca7032f6b', '1', '0', 'approved', '0', '313213', '2024-06-25 07:01:07', '0', null, '1', '1', 'suttipong.r@cmu.ac.th', '053944120', '2024-06-29 12:40:44', null, 'suttipong.r@cmu.ac.th', null, null, '1', '2024-06-25 07:01:07', '2024-06-25 07:01:07');
INSERT INTO `booking_rooms` VALUES ('15', '1720415923', '1', null, '2024-07-10', '2024-07-10', '11:30:00', '14:30:00', 'ประชุม', null, null, '1323', '4141', '411', '0', '0', '1', '0', '12c6ff48e99c2490cc368648a57e6ad2', '1', '0', '', '', '41414', '2024-07-08 05:18:43', '0', null, '1', '0', null, null, null, null, '', null, null, '1', '2024-07-08 05:18:43', '2024-07-08 05:18:43');
INSERT INTO `booking_rooms` VALUES ('16', '1720426761', '1', null, '2024-07-10', '2024-07-10', '11:30:00', '13:00:00', 'หารือกับสมาคม นศ.เก่า เรื่องการจัดกิจกรรมระหว่างสมาคมและคณะ', null, null, 'นายสุทธิพงค์ ริโปนยอง', '10', 'เทคโนโลยี', '0', '0', '1', '0', 'd0c949ca3e5378633c8a29690a965431', '1', '0', 'approved', '', '1010', '2024-07-08 08:19:21', '0', null, '0', '0', null, null, '2024-07-08 08:19:42', null, 'suttipong.r@cmu.ac.th', null, null, '1', '2024-07-08 08:19:21', '2024-07-08 08:19:21');
INSERT INTO `booking_rooms` VALUES ('17', '1721034133', '3', '15/07/2024', '2024-07-15', '2024-07-15', '16:00:00', '17:00:00', 'ประชุม', null, null, 'สุทธิพงค์ ริโปนยอง', '10', 'เทคโนโลยี', '0', '0', '0', null, '399b4fe7a185056102183ce944290275', '0', '0', '', '', 'test', '2024-07-15 09:02:13', '0', 'suttipong.r@cmu.ac.th', '0', '0', 'suttipong.r@cmu.ac.th', null, null, null, '', null, null, '1', '2024-07-15 09:02:13', '2024-07-15 09:02:13');
INSERT INTO `booking_rooms` VALUES ('19', '1721036409', '3', '16/07/2024', '2024-07-16', '2024-07-16', '11:30:00', '14:00:00', 'ประชุม', null, null, 'สุทธิพงค์ ริโปนยอง', '10', 'IT', '0', '0', '0', null, '607e83a93615fd543cc6a8c31f7675b8', '0', '0', '', '', '1010101', '2024-07-15 09:40:09', '0', 'suttipong.r@cmu.ac.th', '0', '0', 'suttipong.r@cmu.ac.th', '1010101', null, null, '', null, null, '1', '2024-07-15 09:40:09', '2024-07-15 09:40:09');
INSERT INTO `booking_rooms` VALUES ('20', '1721141916', '3', '17/07/2024', '2024-07-17', '2024-07-17', '10:00:00', '12:00:00', 'ite', null, null, 'สุทธิพงค์ ริโปนยอง', '10', 'it', '0', '0', '0', null, 'dc3fdd92f5c2e818b77d014e155d4a9d', '1', 'eng', '', '', 'test', '2024-07-16 14:58:36', '0', 'suttipong.r@cmu.ac.th', '0', '0', 'suttipong.r@cmu.ac.th', '10', null, null, '', null, '', '1', '2024-07-16 14:58:36', '2024-07-16 14:58:36');
INSERT INTO `booking_rooms` VALUES ('21', '1721141962', '3', '17/07/2024', '2024-07-17', '2024-07-17', '08:00:00', '09:30:00', 'ประชุม999999999', null, null, 'สุทธิพงค์ ริโปนยอง', '10', 'it', '0', '0', '0', null, '41a653d8e80484762b016b2bfd1c044d', '1', 'eng', '', '', null, '2024-07-16 14:59:22', '0', 'suttipong.r@cmu.ac.th', '0', '0', 'suttipong.r@cmu.ac.th', null, null, null, '', null, '', '1', '2024-07-16 14:59:22', '2024-07-16 14:59:22');
INSERT INTO `booking_rooms` VALUES ('22', '1721303935', '3', '18/07/2024', '2024-07-18', '2024-07-18', '19:30:00', '20:00:00', 'ssssssssss ssssss sa', null, null, 'Aod', '100', 'it', '0', '0', '0', null, 'aca619506139c0d47f5cab2853b6c548', '0', 'general', '', '', null, '2024-07-18 11:58:55', '0', null, '0', '0', 'stimulus.ad@gmail.com', '4120', null, null, '', null, '1721303934.pdf', '1', '2024-07-18 11:58:55', '2024-07-18 11:58:55');
INSERT INTO `booking_rooms` VALUES ('23', '1721390843', '3', '20/07/2024', '2024-07-20', '2024-07-20', '08:30:00', '09:30:00', 'ประชุมuuuuuu uu uuu', null, null, 'สุทธิพงค์ ริโปนยอง', '2', 'it', '0', '0', '0', null, '01aaaa96a9a3f4cf888479513e1503d1', '1', 'eng', '', '', 'test', '2024-07-19 12:07:23', '0', 'suttipong.r@cmu.ac.th', '0', '0', 'suttipong.r@cmu.ac.th', '4120', null, null, '', null, '', '1', '2024-07-19 12:07:23', '2024-07-19 12:07:23');
INSERT INTO `booking_rooms` VALUES ('24', '1721391843', '3', '19/07/2024', '2024-07-19', '2024-07-19', '10:00:00', '12:00:00', 'ประชุมiukki igkkk kk', null, null, 'สุทธิพงค์ ริโปนยอง', '10', 'it', '0', '0', '0', null, 'f4b6d0e8de3b023100b2eed058e3c363', '1', 'general', 'approved', '', 'tesr', '2024-07-19 12:24:03', '0', 'suttipong.r@cmu.ac.th', '0', '0', 'suttipong.r@cmu.ac.th', '4120', '2024-07-19 13:50:34', null, 'suttipong.r@cmu.ac.th', null, '1721391843.pdf', '1', '2024-07-19 12:24:03', '2024-07-19 12:24:03');
INSERT INTO `booking_rooms` VALUES ('25', '1721481271', '3', '21/07/2024', '2024-07-21', '2024-07-21', '12:00:00', '13:00:00', 'ประชุม gsdsgsgsdfg', null, null, 'สุทธิพงค์ ริโปนยอง', '111', 'it', '0', '0', '0', null, 'b496a140d8efa22e90addfc606dca68d', '1', 'eng', '', '', '12312', '2024-07-20 13:14:31', '0', 'suttipong.r@cmu.ac.th', '0', '0', 'suttipong.r@cmu.ac.th', '4120', null, null, '', null, '', '1', '2024-07-20 13:14:31', '2024-07-20 13:14:31');
INSERT INTO `booking_rooms` VALUES ('26', '1722104273', '13', '27/07/2024', '2024-07-27', '2024-07-27', '14:30:00', '16:30:00', 'ประชุม9999', null, null, 'สุทธิพงค์ ริโปนยอง', '10', 'it', '0', '0', '0', null, 'd9d5fd94b45cd18a09459f342440143f', '0', 'general', '', '', null, '2024-07-27 18:17:53', '0', 'suttipong.r@cmu.ac.th', '0', '0', 'suttipong.r@cmu.ac.th', '4120', '2024-07-28 08:50:17', null, 'suttipong.r@cmu.ac.th', null, '1722104273.pdf', '1', '2024-07-27 18:17:53', '2024-07-27 18:17:53');

-- ----------------------------
-- Table structure for cmu_oauth
-- ----------------------------
DROP TABLE IF EXISTS `cmu_oauth`;
CREATE TABLE `cmu_oauth` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cmuitaccount` varchar(254) NOT NULL,
  `prename_TH` varchar(254) DEFAULT NULL,
  `firstname_TH` varchar(254) DEFAULT NULL,
  `lastname_TH` varchar(254) DEFAULT NULL,
  `positionName` varchar(254) DEFAULT NULL,
  `positionName2` varchar(254) DEFAULT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT 0,
  `isDean` tinyint(4) NOT NULL DEFAULT 0,
  `password` varchar(254) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cmu_oauth
-- ----------------------------

-- ----------------------------
-- Table structure for customer_payment
-- ----------------------------
DROP TABLE IF EXISTS `customer_payment`;
CREATE TABLE `customer_payment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_ref1` varchar(100) DEFAULT NULL,
  `payment_ref2` varchar(20) DEFAULT NULL,
  `orderInv` varchar(32) NOT NULL,
  `bookingID` int(11) NOT NULL,
  `customerName` varchar(254) DEFAULT NULL,
  `customerEmail` varchar(100) DEFAULT NULL,
  `customerPhone` varchar(100) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `customerTaxid` varchar(20) DEFAULT NULL,
  `customerAddress` varchar(255) DEFAULT NULL,
  `totalAmount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `is_confirm` tinyint(1) NOT NULL DEFAULT 0,
  `payment_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of customer_payment
-- ----------------------------

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `dep_id` smallint(4) NOT NULL AUTO_INCREMENT,
  `dep_name` varchar(200) NOT NULL,
  `dep_parent` smallint(4) NOT NULL,
  `title` varchar(10) NOT NULL,
  `dep_title` varchar(200) NOT NULL,
  `id_del` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`dep_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES ('1', 'สำนักงานคณะ', '0', 'eng', 'สำนักงานคณะ', null);
INSERT INTO `department` VALUES ('2', 'งานบริการการศึกษา', '1', 'ES', 'งานบริการการศึกษา', null);
INSERT INTO `department` VALUES ('6', 'งานบริหารงานวิจัยฯ', '1', 'RI', 'งานวิจัยฯ', null);
INSERT INTO `department` VALUES ('7', 'งานนโยบายและแผน', '1', 'PP', 'งานนโยบายและแผน', null);
INSERT INTO `department` VALUES ('8', 'งานบริหารทั่วไป', '1', 'AD', 'งานบริหารทั่วไป', null);
INSERT INTO `department` VALUES ('13', 'งานการเงินการคลังและพัสดุ', '1', 'FS', 'งานการเงินการคลังและพัสดุ', null);
INSERT INTO `department` VALUES ('14', 'ภาควิชาวิศวกรรมคอมพิวเตอร์', '0', '', 'ภาควิชาคอมพิวเตอร์', null);
INSERT INTO `department` VALUES ('15', 'ภาควิชาวิศวกรรมเครื่องกล', '0', '', 'ภาควิชาเครื่องกล', null);
INSERT INTO `department` VALUES ('16', 'ภาควิชาวิศวกรรมไฟฟ้า', '0', '', 'ภาควิชาไฟฟ้า', null);
INSERT INTO `department` VALUES ('17', 'ภาควิชาวิศวกรรมโยธา', '0', '', 'ภาควิชาโยธา', null);
INSERT INTO `department` VALUES ('18', 'ภาควิชาวิศวกรรมสิ่งแวดล้อม', '0', '', 'ภาควิชาสิ่งแวดล้อม', null);
INSERT INTO `department` VALUES ('19', 'ภาควิชาวิศวกรรมเหมืองแร่', '0', '', 'ภาควิชาเหมืองแร่', null);
INSERT INTO `department` VALUES ('20', 'ภาควิชาวิศวกรรมอุตสาหการ', '0', '', 'ภาควิชาอุตสาหการ', null);
INSERT INTO `department` VALUES ('21', 'ศูนย์วิศวกรรมชีวการแพทย์', '0', '', 'ศูนย์วิศวกรรมชีวการแพทย์', null);
INSERT INTO `department` VALUES ('22', 'เงินบริจาค-ทุนการศึกษา', '0', '', 'เงินบริจาค-ทุนการศึกษา', null);
INSERT INTO `department` VALUES ('23', 'เงินบริจาค-สนับสนุนการศึกษา', '0', '', 'เงินบริจาค-สนับสนุนการศึกษา', null);
INSERT INTO `department` VALUES ('24', 'เงินบริจาค-New Campus', '0', '', 'เงินบริจาค-New Campus', null);
INSERT INTO `department` VALUES ('25', 'เงินบริจาค-สโมสรนักศึกษา', '0', '', 'เงินบริจาค-สโมสรนักศึกษา', null);
INSERT INTO `department` VALUES ('26', 'เงินบริจาค-อื่นๆ', '0', '', 'เงินบริจาค-อื่นๆ', null);
INSERT INTO `department` VALUES ('27', 'สาขาวิทยาการข้อมูล', '0', 'DS', 'สาขาวิทยาการข้อมูล', null);
INSERT INTO `department` VALUES ('32', 'Entaneer Academy', '0', '', 'Entaneer Academy', null);
INSERT INTO `department` VALUES ('28', 'งานพัฒนาคุณภาพนักศึกษา', '1', '', 'งานพัฒนาคุณภาพนักศึกษา', null);
INSERT INTO `department` VALUES ('30', 'หลักสูตรวิศวกรรมหุ่นยนต์ฯ', '0', '', 'หลักสูตรวิศวกรรมหุ่นยนต์ฯ', null);
INSERT INTO `department` VALUES ('29', 'งานพัฒนาเทคโนโลยีฯ', '1', '', 'งานพัฒนาเทคโนโลยีฯ', null);
INSERT INTO `department` VALUES ('31', 'ศูนย์การศึกษานานาชาติฯ', '0', '', 'ศูนย์การศึกษานานาชาติฯ', null);
INSERT INTO `department` VALUES ('34', 'วิศวกรรมบูรณาการ', '0', 'IGE', 'วิศวกรรมบูรณาการ', null);

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employees
-- ----------------------------
INSERT INTO `employees` VALUES ('1', 'Suttipong', 'CMU', '0898351335', '2024-06-18 07:49:13', '2024-06-18 07:49:13');
INSERT INTO `employees` VALUES ('2', 'AOD', 'Eng', '0991406262', '2024-06-18 07:51:12', '2024-06-18 07:51:12');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for listdays
-- ----------------------------
DROP TABLE IF EXISTS `listdays`;
CREATE TABLE `listdays` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dayTitle` varchar(255) DEFAULT NULL,
  `dayList` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of listdays
-- ----------------------------
INSERT INTO `listdays` VALUES ('1', 'Mo', 'Mon', null, null);
INSERT INTO `listdays` VALUES ('2', 'Tu', 'Tue', null, null);
INSERT INTO `listdays` VALUES ('3', 'We', 'Wed', null, null);
INSERT INTO `listdays` VALUES ('4', 'Th', 'Thu', null, null);
INSERT INTO `listdays` VALUES ('5', 'Fr', 'Fri', null, null);
INSERT INTO `listdays` VALUES ('6', 'Sa', 'Sat', null, null);
INSERT INTO `listdays` VALUES ('7', 'Su', 'Sun', null, null);
INSERT INTO `listdays` VALUES ('8', 'MTU', 'Mon,Tue', null, null);
INSERT INTO `listdays` VALUES ('9', 'MWe', 'Mon,Wed', null, null);
INSERT INTO `listdays` VALUES ('10', 'MTh', 'Mon,Thu', null, null);
INSERT INTO `listdays` VALUES ('11', 'MF', 'Mon,Fri', null, null);
INSERT INTO `listdays` VALUES ('12', 'Msa', 'Mon,Sat', null, null);
INSERT INTO `listdays` VALUES ('13', 'Msu', 'Mon,Sun', null, null);
INSERT INTO `listdays` VALUES ('14', 'TuW', 'Tue,Wed', null, null);
INSERT INTO `listdays` VALUES ('15', 'TuTh', 'Tue,Thu', null, null);
INSERT INTO `listdays` VALUES ('16', 'TuF', 'Tue,Fri', null, null);
INSERT INTO `listdays` VALUES ('17', 'TuSa', 'Tue,Sat', null, null);
INSERT INTO `listdays` VALUES ('18', 'TuSu', 'Tue,Sun', null, null);
INSERT INTO `listdays` VALUES ('19', 'WTh', 'Wed,Thu', null, null);
INSERT INTO `listdays` VALUES ('20', 'WF', 'Wed,Fri', null, null);
INSERT INTO `listdays` VALUES ('21', 'WSa', 'Wed,Sat', null, null);
INSERT INTO `listdays` VALUES ('22', 'WSa', 'Wed,Sun', null, null);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('4', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `migrations` VALUES ('5', '2024_06_22_155543_create_rooms_table', '1');
INSERT INTO `migrations` VALUES ('6', '2024_06_22_155638_room_type_table', '1');
INSERT INTO `migrations` VALUES ('7', '2024_06_22_155805_create_place_table', '1');
INSERT INTO `migrations` VALUES ('9', '2024_06_22_155916_create_cmu_oauth_table', '1');
INSERT INTO `migrations` VALUES ('11', '2024_06_22_155945_create_booking_rooms_table', '2');
INSERT INTO `migrations` VALUES ('13', '2014_10_12_000000_create_users_table', '3');
INSERT INTO `migrations` VALUES ('14', '2024_07_01_063309_create_booking_assigns_table', '4');
INSERT INTO `migrations` VALUES ('15', '2024_07_02_063122_create_schedule_table', '5');
INSERT INTO `migrations` VALUES ('16', '2024_07_02_075802_create_room_schedules_table', '6');
INSERT INTO `migrations` VALUES ('17', '2024_07_10_062357_create_listdays_table', '7');
INSERT INTO `migrations` VALUES ('18', '2024_07_11_144023_create_room_galleries_table', '8');
INSERT INTO `migrations` VALUES ('19', '2024_07_22_165242_create_admin_roooms_table', '9');
INSERT INTO `migrations` VALUES ('20', '2024_06_22_155841_create_customer_payment_table', '10');
INSERT INTO `migrations` VALUES ('21', '2024_07_31_055013_create_payments_table', '11');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for payments
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_ref1` varchar(100) DEFAULT NULL,
  `payment_ref2` varchar(20) DEFAULT NULL,
  `bookingID` int(11) NOT NULL,
  `customerName` varchar(254) DEFAULT NULL,
  `customerEmail` varchar(100) DEFAULT NULL,
  `customerPhone` varchar(100) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `customerTaxid` varchar(20) DEFAULT NULL,
  `customerAddress` varchar(255) DEFAULT NULL,
  `totalAmount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `is_confirm` tinyint(1) NOT NULL DEFAULT 0,
  `payment_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES ('1', null, null, '26', null, '10@fsdfs.fdgdf', '', null, '1', null, '2000.00', '0', '0', null, '2024-07-31 05:58:28', '2024-07-31 05:58:28');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for place
-- ----------------------------
DROP TABLE IF EXISTS `place`;
CREATE TABLE `place` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `placeName` varchar(254) NOT NULL,
  `decription` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of place
-- ----------------------------
INSERT INTO `place` VALUES ('1', 'อาคาร 30 ปี', null, null, null);
INSERT INTO `place` VALUES ('2', 'อาคาร RTT', null, null, null);

-- ----------------------------
-- Table structure for rooms
-- ----------------------------
DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `roomToken` varchar(255) NOT NULL,
  `roomFullName` varchar(255) NOT NULL,
  `roomTitle` varchar(255) DEFAULT NULL,
  `roomSize` varchar(255) DEFAULT NULL,
  `roomTypeId` int(11) NOT NULL DEFAULT 0,
  `placeId` int(11) NOT NULL DEFAULT 0,
  `thumbnail` varchar(255) DEFAULT NULL,
  `roomDetail` varchar(255) DEFAULT NULL,
  `is_open` tinyint(1) NOT NULL DEFAULT 1,
  `is_status` tinyint(1) NOT NULL DEFAULT 0,
  `room_admin_email` varchar(255) DEFAULT NULL,
  `room_price` int(10) DEFAULT 0,
  `room_wh` varchar(100) DEFAULT NULL,
  `room_itemlist` varchar(254) DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of rooms
-- ----------------------------
INSERT INTO `rooms` VALUES ('1', '', 'ห้องประชุมสำนักงานคณบดี (ห้องกระจก)', null, '7', '1', '1', '1719204526.jpg', 'สำนักงานคณบดี ชั้น 6 อาคาร 30 ปี', '0', '0', null, '0', null, null, null, '2024-06-24 04:50:41');
INSERT INTO `rooms` VALUES ('2', '', 'ห้องประชุมตียาภรณ์', null, '15', '1', '1', '1719204497.jpg', 'สำนักงานเลขานุการ ชั้น 6 อาคาร 30 ปี', '1', '0', null, '0', null, null, null, '2024-06-24 04:48:18');
INSERT INTO `rooms` VALUES ('3', '', 'ห้องประชุม 2', null, '80', '1', '1', '1719204467.jpg', 'สำนักงานเลขานุการ ชั้น 7 อาคาร 30 ปี', '1', '0', null, '0', null, null, null, '2024-06-24 04:47:47');
INSERT INTO `rooms` VALUES ('4', '', 'ห้องประชุม 3', null, '20', '1', '1', '1719204439.jpg', 'สำนักงานเลขานุการ ชั้น 7 อาคาร 30 ปี', '1', '0', null, '0', null, null, null, '2024-06-24 04:47:19');
INSERT INTO `rooms` VALUES ('5', '', 'ห้องประชุม 4', null, '80', '1', '1', '1719204424.jpg', 'สำนักงานเลขานุการ ชั้น 7 อาคาร 30 ปี (สามารถใช้เป็นห้องรับประทานอาหารได้)', '1', '0', null, '0', null, null, null, '2024-06-24 04:47:04');
INSERT INTO `rooms` VALUES ('6', '', 'ห้องประชุมสำนักงานคณะ (ข้างห้อง วสท.1)', null, '10', '1', '1', '1719204404.jpg', 'ห้องประชุมสำนักงานคณะ ชั้น 6 อาคาร 30 ปี', '1', '0', null, '0', null, null, null, '2024-06-24 04:46:44');
INSERT INTO `rooms` VALUES ('7', '', 'หอเกียรติยศ', null, '15', '1', '1', '1719204384.jpg', 'หอเกียรติยศ ชั้น 6 อาคาร 30 ปี', '0', '0', null, '0', null, null, null, '2024-06-24 04:46:24');
INSERT INTO `rooms` VALUES ('8', '', 'ห้องคอมพิวเตอร์ 314', 'Lab314', '50', '2', '1', '1719222208.jpg', 'ชั้น 3 อาคาร 30 ปี', '1', '0', null, '0', null, null, null, '2024-06-30 05:34:16');
INSERT INTO `rooms` VALUES ('9', 'c0c04d3ac5d0184fc44530ae51824e2f', 'Lab303', '303', '12', '2', '1', '1719898298.jpg', '123456', '1', '0', null, '0', null, null, '2024-06-25 05:21:42', '2024-07-02 05:31:38');
INSERT INTO `rooms` VALUES ('10', '7158d436dd44018bfd3ed1a7ffeb0c22', 'ห้องเรียน 2-404', 'ห้องเรียน2-404', '50', '2', '1', '1719898272.jpg', null, '1', '0', null, '0', '1*1', '4,5,7,9', '2024-06-30 07:32:55', '2024-07-27 15:33:00');
INSERT INTO `rooms` VALUES ('11', '369b2c11ca3249180d4e9b22c016f697', 'ห้องเรียน 3-312', 'ห้องเรียน3-312', '80', '3', '1', '1719898240.jpg', 'ห้องคอมพิวเตอร์', '1', '0', null, '0', '200*200', '1,3,4,6,8,9', '2024-07-02 05:30:40', '2024-07-27 15:12:25');
INSERT INTO `rooms` VALUES ('13', '2763a1500aee412083462d7ca48a6cef', 'ห้องประชุมRtt3', 'ห้องประชุมRtt3', '40', '1', '2', '1722096613.jpg', null, '1', '0', null, '0', null, '1,4,5,7', '2024-07-27 16:09:13', '2024-07-27 16:10:14');

-- ----------------------------
-- Table structure for room_galleries
-- ----------------------------
DROP TABLE IF EXISTS `room_galleries`;
CREATE TABLE `room_galleries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `roomID` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of room_galleries
-- ----------------------------

-- ----------------------------
-- Table structure for room_items
-- ----------------------------
DROP TABLE IF EXISTS `room_items`;
CREATE TABLE `room_items` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of room_items
-- ----------------------------
INSERT INTO `room_items` VALUES ('1', 'เครื่องเสียง');
INSERT INTO `room_items` VALUES ('2', 'คอมพิวเตอร์อาจารย์');
INSERT INTO `room_items` VALUES ('3', 'คอมพิวเตอร์นักศึกษา');
INSERT INTO `room_items` VALUES ('4', 'โปรเจคเตอร์');
INSERT INTO `room_items` VALUES ('5', 'ทีวี');
INSERT INTO `room_items` VALUES ('6', 'พัดลม');
INSERT INTO `room_items` VALUES ('7', 'เครื่องปรับอากาศ');
INSERT INTO `room_items` VALUES ('8', 'กระดาน');
INSERT INTO `room_items` VALUES ('9', 'Scinet');

-- ----------------------------
-- Table structure for room_schedules
-- ----------------------------
DROP TABLE IF EXISTS `room_schedules`;
CREATE TABLE `room_schedules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `courseNO` varchar(255) DEFAULT NULL,
  `courseTitle` varchar(255) DEFAULT NULL,
  `courseSec` varchar(255) DEFAULT NULL,
  `Stdamount` int(11) DEFAULT 0,
  `schedule_startdate` date DEFAULT NULL,
  `schedule_enddate` date DEFAULT NULL,
  `booking_time_start` time DEFAULT NULL,
  `booking_time_finish` time DEFAULT NULL,
  `roomNo` varchar(255) DEFAULT NULL,
  `roomID` int(11) DEFAULT 0,
  `lecturer` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_confirm` tinyint(1) DEFAULT 0,
  `admin_confirm` tinyint(1) DEFAULT 0,
  `is_confirm_date` datetime DEFAULT NULL,
  `admin_confirm_date` datetime DEFAULT NULL,
  `staffupdated` datetime DEFAULT NULL,
  `straff_account` varchar(255) DEFAULT NULL,
  `schedule_repeatday` varchar(20) DEFAULT NULL,
  `courseofyear` char(4) DEFAULT NULL,
  `terms` tinyint(1) DEFAULT 0,
  `is_import_excel` tinyint(1) DEFAULT 0,
  `is_duplicate` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of room_schedules
-- ----------------------------
INSERT INTO `room_schedules` VALUES ('2', 'MAth01', 'COMAWE01', '1', '55', '2024-07-03', '2024-07-27', '08:30:00', '10:00:00', null, '9', 'TESC2', '213', '0', '0', null, null, null, 'suttipong.r@cmu.ac.th', 'We', '2567', '1', '0', '0', '2024-07-02 09:57:52', '2024-07-03 09:19:24');
INSERT INTO `room_schedules` VALUES ('4', 'C3055', 'HTML5', '1', '100', '2024-07-05', '2024-09-30', '13:00:00', '14:30:00', null, '8', 'TESCA', 'test', '0', '0', null, null, null, 'suttipong.r@cmu.ac.th', 'TuF', '2567', '1', '0', '0', '2024-07-03 09:15:22', '2024-07-03 09:15:22');
INSERT INTO `room_schedules` VALUES ('67', 'C30221', 'COMAWE', '002', '50', '2024-07-01', '2024-07-24', '16:00:00', '19:30:00', null, '11', 'Aod', 'ทดสอบ', '0', '0', null, null, null, 'suttipong.r@cmu.ac.th', 'Tu', '2567', '1', '0', '0', '2024-07-08 05:51:26', '2024-07-08 05:53:00');
INSERT INTO `room_schedules` VALUES ('68', '254182', 'Introdution to Engergy', '001', '10', '2024-07-01', '2024-10-31', '13:00:00', '14:30:00', '2-404', '10', 'ผ.ศ.ดร.เก่งกมล วิรัตน์เกษม', null, '0', '0', null, null, null, 'suttipong.r@cmu.ac.th', 'TuF', '2567', '1', '1', '0', '2024-07-08 08:22:32', '2024-07-08 08:22:32');
INSERT INTO `room_schedules` VALUES ('69', '254182', 'Introdution to Engergy', '801', '14', '2024-07-01', '2024-10-31', '13:00:00', '14:20:00', '2-404', '10', 'ผ.ศ.ดร.เก่งกมล วิรัตน์เกษม', null, '0', '0', null, null, null, 'suttipong.r@cmu.ac.th', 'MTh', '2567', '1', '1', '0', '2024-07-08 08:22:32', '2024-07-08 08:22:32');
INSERT INTO `room_schedules` VALUES ('70', '254184', 'Prot tech For inddes', '001', '34', '2024-07-01', '2024-10-31', '09:30:00', '12:30:00', 'lab314', '8', 'ผ.ศ.ดร.เวชยันต์ รางศรี', 'ขอห้อง', '0', '0', null, null, null, 'suttipong.r@cmu.ac.th', 'Mo', '2567', '1', '1', '0', '2024-07-08 08:22:32', '2024-07-08 08:22:32');
INSERT INTO `room_schedules` VALUES ('71', '12321', 'rwerwerw', '001', '1000', '2024-07-01', '2024-10-31', '10:30:00', '11:03:11', 'lab314', '8', 'AA', null, '0', '0', null, null, null, 'suttipong.r@cmu.ac.th', 'Mo', '2567', '1', '1', '1', null, null);

-- ----------------------------
-- Table structure for room_type
-- ----------------------------
DROP TABLE IF EXISTS `room_type`;
CREATE TABLE `room_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `roomtypeName` varchar(200) NOT NULL,
  `decription` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of room_type
-- ----------------------------
INSERT INTO `room_type` VALUES ('1', 'ห้องประชุม', null, null, null);
INSERT INTO `room_type` VALUES ('2', 'ห้องเรียน', null, null, null);
INSERT INTO `room_type` VALUES ('3', 'ห้องคอมพิวเตอร์', null, null, null);
INSERT INTO `room_type` VALUES ('4', 'ห้องสโลบ', null, null, null);

-- ----------------------------
-- Table structure for schedule
-- ----------------------------
DROP TABLE IF EXISTS `schedule`;
CREATE TABLE `schedule` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `courseNO` varchar(255) NOT NULL,
  `courseTitle` varchar(255) DEFAULT NULL,
  `courseSec` varchar(255) DEFAULT NULL,
  `Stdamount` int(11) NOT NULL DEFAULT 0,
  `onDays` varchar(255) NOT NULL,
  `onTimes` varchar(255) NOT NULL,
  `roomNo` varchar(255) NOT NULL,
  `roomID` bigint(20) DEFAULT NULL,
  `lecturer` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_confirm` tinyint(1) NOT NULL DEFAULT 0,
  `admin_confirm` tinyint(1) NOT NULL DEFAULT 0,
  `is_confirm_date` datetime DEFAULT NULL,
  `admin_confirm_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of schedule
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_apikey
-- ----------------------------
DROP TABLE IF EXISTS `tbl_apikey`;
CREATE TABLE `tbl_apikey` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `apiweb` varchar(10) DEFAULT NULL,
  `clientID` varchar(50) DEFAULT NULL,
  `clientSecret` varchar(50) DEFAULT NULL,
  `description` varchar(254) DEFAULT NULL,
  `redirect_uri` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tbl_apikey
-- ----------------------------
INSERT INTO `tbl_apikey` VALUES ('1', 'cmuoauth', 'nP2KgMxA05UV7VAq4uhQMDGN2xNfqhpjNbzZeQqM', 'U6bZTJ81TZnnUgPUgqTW9skTSKg5wNjreH6RCT4u', 'oauth.cmu.ac.th', 'http://127.0.0.1:8000/callback_booking');

-- ----------------------------
-- Table structure for tbl_members
-- ----------------------------
DROP TABLE IF EXISTS `tbl_members`;
CREATE TABLE `tbl_members` (
  `user_id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `fname` varchar(50) NOT NULL DEFAULT '',
  `lname` varchar(50) NOT NULL DEFAULT '',
  `is_dean` tinyint(1) DEFAULT 0,
  `position_work` varchar(250) DEFAULT NULL,
  `position` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `tel` varchar(15) NOT NULL DEFAULT '',
  `img` varchar(255) NOT NULL DEFAULT '',
  `Ulevel` int(1) NOT NULL DEFAULT 0,
  `tmp_pass` varchar(100) DEFAULT NULL,
  `cmuitaccount` varchar(50) DEFAULT NULL,
  `cmuitaccount_name` varchar(100) DEFAULT NULL,
  `prename_TH` varchar(100) DEFAULT NULL,
  `firstname_TH` varchar(100) DEFAULT NULL,
  `lastname_TH` varchar(100) DEFAULT NULL,
  `itaccounttype_id` varchar(20) DEFAULT NULL,
  `itaccounttype_TH` varchar(20) DEFAULT NULL,
  `groupId` smallint(4) DEFAULT 0,
  `dep_id` smallint(4) DEFAULT NULL,
  `is_manage_sequence` tinyint(1) DEFAULT 0,
  `is_finance` tinyint(1) DEFAULT 0,
  `is_step_flow` tinyint(1) DEFAULT 0,
  `is_step_secretary` tinyint(1) DEFAULT 0,
  `is_step_dean` tinyint(1) DEFAULT 0,
  `typeposition_id` tinyint(1) NOT NULL DEFAULT 0,
  `is_step_plan` tinyint(1) NOT NULL DEFAULT 0,
  `lineToken` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=358 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of tbl_members
-- ----------------------------
INSERT INTO `tbl_members` VALUES ('1', '', '', 'อัฐนันต์', 'วรรณชัย', '0', 'อาจารย์ ดร.', '', 'autanan.w@cmu.ac.th', '', '', '0', null, 'autanan.w@cmu.ac.th', null, 'นาย', 'อัฐนันต์', 'วรรณชัย', null, null, '0', '35', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('2', '', '', 'นรพนธ์', 'วิเชียรสาร', '0', 'อาจารย์ ดร.', '', 'norrapon.v@cmu.ac.th', '', '', '0', null, 'norrapon.v@cmu.ac.th', null, 'นาย', 'นรพนธ์', 'วิเชียรสาร', null, null, '0', '35', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('3', '', '', 'กิตติยา', 'ทุ่นศิริ', '0', 'อาจารย์ ดร.', '', 'kittiya.thunsiri@cmu.ac.th', '', '', '0', null, 'kittiya.thunsiri@cmu.ac.th', null, 'นางสาว', 'กิตติยา', 'ทุ่นศิริ', null, null, '0', '35', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('4', '', '', 'วิชัย', 'ฉัตรทินวัฒน์', '0', 'รองศาสตราจารย์', '', 'wichai.chattinnawat@cmu.ac.th', '', '', '0', null, 'wichai.chattinnawat@cmu.ac.th', null, 'นาย', 'วิชัย', 'ฉัตรทินวัฒน์', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('5', '', '', 'อรรฆพจน์', 'วงศ์พึ่งไชย', '0', 'อาจารย์', '', 'akkapoj.w@cmu.ac.th', '', '', '0', null, 'akkapoj.w@cmu.ac.th', null, 'นาย', 'อรรฆพจน์', 'วงศ์พึ่งไชย', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('6', '', '', 'ณรงค์', 'เพชรชารี', '0', 'อาจารย์', '', 'narong.petcharee@cmu.ac.th', '', '', '0', null, 'narong.petcharee@cmu.ac.th', null, 'นาย', 'ณรงค์', 'เพชรชารี', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('7', '', '', 'ฐากร', 'โอภาสสุวรรณ', '0', 'อาจารย์ ดร.', '', 'takron.op@cmu.ac.th', '', '', '0', null, 'takron.op@cmu.ac.th', null, 'นาย', 'ฐากร', 'โอภาสสุวรรณ', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('8', '', '', 'ภวิกา', 'มงคลกิจทวีผล', '0', 'อาจารย์ ดร.', '', 'phavika.m@cmu.ac.th', '', '', '0', null, 'phavika.m@cmu.ac.th', null, 'นางสาว', 'ภวิกา', 'มงคลกิจทวีผล', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('9', '', '', 'โพธิ', 'จ้าวไพศาล', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'poti.chao@cmu.ac.th', '', '', '0', null, 'poti.chao@cmu.ac.th', null, 'นาย', 'โพธิ', 'จ้าวไพศาล', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('10', '', '', 'ทินกร', 'ปงธิยา', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'tinnakorn.phongthiya@cmu.ac.th', '', '', '0', null, 'tinnakorn.phongthiya@cmu.ac.th', null, 'นาย', 'ทินกร', 'ปงธิยา', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('11', '', '', 'นิวิท', 'เจริญใจ', '0', 'รองศาสตราจารย์', '', 'nivit.c@cmu.ac.th', '', '', '0', null, 'nivit.c@cmu.ac.th', null, 'นาย', 'นิวิท', 'เจริญใจ', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('12', '', '', 'พงษ์สวัสดิ์', 'เปรมเพ็ชร', '0', 'อาจารย์ ดร.', '', 'pongsawat.p@cmu.ac.th', '', '', '0', null, 'pongsawat.p@cmu.ac.th', null, 'นาย', 'พงษ์สวัสดิ์', 'เปรมเพ็ชร', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('13', '', '', 'สาลินี', 'สันติธีรากุล', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'salinee.s@cmu.ac.th', '', '', '0', null, 'salinee.s@cmu.ac.th', null, 'นางสาว', 'สาลินี', 'สันติธีรากุล', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('14', '', '', 'อภิชาต', 'โสภาแดง', '0', 'รองศาสตราจารย์', '', 'apichat.s@cmu.ac.th', '', '', '0', null, 'apichat.s@cmu.ac.th', null, 'นาย', 'อภิชาต', 'โสภาแดง', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('15', '', '', 'ชนม์เจริญ', 'แสวงรัตน์', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'choncharoen.s@cmu.ac.th', '', '', '0', null, 'choncharoen.s@cmu.ac.th', null, 'นาย', 'ชนม์เจริญ', 'แสวงรัตน์', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('16', '', '', 'นิรันดร์', 'พิสุทธอานนท์', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'nirand.p@cmu.ac.th', '', '', '0', null, 'nirand.p@cmu.ac.th', null, 'นาย', 'นิรันดร์', 'พิสุทธอานนท์', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('17', '', '', 'อรรถพล', 'สมุทคุปติ์', '1', 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', 'uttapol.s@cmu.ac.th', '', '', '0', null, 'uttapol.s@cmu.ac.th', null, 'นาย', 'อรรถพล', 'สมุทคุปติ์', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('18', '', '', 'วิมลิน สุขถมยา', 'เหล่าศิริถาวร', '0', 'รองศาสตราจารย์', '', 'wimalin.l@cmu.ac.th', '', '', '0', null, 'wimalin.l@cmu.ac.th', null, 'นาง', 'วิมลิน สุขถมยา', 'เหล่าศิริถาวร', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('19', '', '', 'อนิรุท', 'ไชยจารุวณิช', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'anirut.c@cmu.ac.th', '', '', '0', null, 'anirut.c@cmu.ac.th', null, 'นาย', 'อนิรุท', 'ไชยจารุวณิช', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('20', '', '', 'รัฐพล', 'ปิ่นนราทิพย์', '0', 'อาจารย์ ดร.', '', 'rattapol.pinn@cmu.ac.th', '', '', '0', null, 'rattapol.pinn@cmu.ac.th', null, 'นาย', 'รัฐพล', 'ปิ่นนราทิพย์', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('21', '', '', 'วัสสนัย', 'วรรธนัจฉริยา', '1', 'รองศาสตราจารย์', 'ผู้ช่วยคณบดี', 'wassanai.w@cmu.ac.th', '', '', '0', null, 'wassanai.w@cmu.ac.th', null, 'นาย', 'วัสสนัย', 'วรรธนัจฉริยา', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('22', '', '', 'วสวัชร', 'นาคเขียว', '1', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมอุตสาหการ', 'wasawat.n@cmu.ac.th', '', '', '0', null, 'wasawat.n@cmu.ac.th', null, 'นาย', 'วสวัชร', 'นาคเขียว', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('23', '', '', 'อดิเรก', 'ใบสุขันธ์', '0', 'อาจารย์ ดร.', '', 'adirek.b@cmu.ac.th', '', '', '0', null, 'adirek.b@cmu.ac.th', null, 'นาย', 'อดิเรก', 'ใบสุขันธ์', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('24', '', '', 'วริษา', 'นาคเขียว', '0', 'รองศาสตราจารย์', '', 'warisa.w@cmu.ac.th', '', '', '0', null, 'warisa.w@cmu.ac.th', null, 'นาง', 'วริษา', 'นาคเขียว', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('25', '', '', 'ชมพูนุท', 'เกษมเศรษฐ์', '0', 'รองศาสตราจารย์', '', 'chompoonoot.kasemset@cmu.ac.th', '', '', '0', null, 'chompoonoot.kasemset@cmu.ac.th', null, 'นางสาว', 'ชมพูนุท', 'เกษมเศรษฐ์', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('26', '', '', 'รุ่งฉัตร', 'ชมภูอินไหว', '0', 'รองศาสตราจารย์ ดร.', '', 'rungchat.chompu@cmu.ac.th', '', '', '0', null, 'rungchat.chompu@cmu.ac.th', null, 'นางสาว', 'รุ่งฉัตร', 'ชมภูอินไหว', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('27', '', '', 'วรพจน์', 'เสรีรัฐ', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'worapod.s@cmu.ac.th', '', '', '0', null, 'worapod.s@cmu.ac.th', null, 'นาย', 'วรพจน์', 'เสรีรัฐ', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('28', '', '', 'กรกฎ ใยบัวเทศ', 'ทิพยาวงศ์', '1', 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 'korrakot.t@cmu.ac.th', '', '', '0', null, 'korrakot.t@cmu.ac.th', null, 'นาง', 'กรกฎ ใยบัวเทศ', 'ทิพยาวงศ์', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('29', '', '', 'วาปี', 'มโนภินิเวศ', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'wapee.m@cmu.ac.th', '', '', '0', null, 'wapee.m@cmu.ac.th', null, 'นางสาว', 'วาปี', 'มโนภินิเวศ', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('30', '', '', 'ศักดิ์เกษม', 'ระมิงค์วงศ์', '0', 'รองศาสตราจารย์ ดร.', '', 'sakgasem.ramingwong@cmu.ac.th', '', '', '0', null, 'sakgasem.ramingwong@cmu.ac.th', null, 'นาย', 'ศักดิ์เกษม', 'ระมิงค์วงศ์', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('31', '', '', 'คมกฤต', 'เล็กสกุล', '0', 'รองศาสตราจารย์ ดร.', '', 'komgrit.lek@cmu.ac.th', '', '', '0', null, 'komgrit.lek@cmu.ac.th', null, 'นาย', 'คมกฤต', 'เล็กสกุล', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('32', '', '', 'เศรษฐ์', 'สัมภัตตะกุล', '0', 'รองศาสตราจารย์ ดร.', '', 'sate.s@cmu.ac.th', '', '', '0', null, 'sate.s@cmu.ac.th', null, 'นาย', 'เศรษฐ์', 'สัมภัตตะกุล', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('33', '', '', 'อลงกต ลิ้มเจริญ', 'แก้วโชติช่วงกูล', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'alonggot.l@cmu.ac.th', '', '', '0', null, 'alonggot.l@cmu.ac.th', null, 'นาง', 'อลงกต ลิ้มเจริญ', 'แก้วโชติช่วงกูล', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('34', '', '', 'ธัญญานุภาพ', 'อานันทนะ', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'tanyanuparb.a@cmu.ac.th', '', '', '0', null, 'tanyanuparb.a@cmu.ac.th', null, 'นาย', 'ธัญญานุภาพ', 'อานันทนะ', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('35', '', '', 'ชวิศ', 'บุญมี', '0', 'รองศาสตราจารย์ ดร.', '', 'chawis.boonmee@cmu.ac.th', '', '', '0', null, 'chawis.boonmee@cmu.ac.th', null, 'นาย', 'ชวิศ', 'บุญมี', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('36', '', '', 'พริม', 'ฟองสมุทร', '0', 'อาจารย์ผู้ช่วย', '', 'prim.fong@cmu.ac.th', '', '', '0', null, 'prim.fong@cmu.ac.th', null, 'นางสาว', 'พริม', 'ฟองสมุทร', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('37', '', '', 'เจณชวิศ', 'เจริญใจ', '0', 'อาจารย์ผู้ช่วย', '', 'jenschwich.c@cmu.ac.th', '', '', '0', null, 'jenschwich.c@cmu.ac.th', null, 'นาย', 'เจณชวิศ', 'เจริญใจ', null, null, '0', '20', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('38', '', '', 'ณัฐนันท์', 'พรหมสุข', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'natthanan.p@cmu.ac.th', '', '', '0', null, 'natthanan.p@cmu.ac.th', null, 'นาย', 'ณัฐนันท์', 'พรหมสุข', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('39', '', '', 'กำพล', 'วรดิษฐ์', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'kampol.w@cmu.ac.th', '', '', '0', null, 'kampol.w@cmu.ac.th', null, 'นาย', 'กำพล', 'วรดิษฐ์', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('40', '', '', 'ลัชนา', 'ระมิงค์วงศ์', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'lachana.ramingwong@cmu.ac.th', '', '', '0', null, 'lachana.ramingwong@cmu.ac.th', null, 'นาง', 'ลัชนา', 'ระมิงค์วงศ์', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('41', '', '', 'ยุทธพงษ์', 'สมจิต', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'yuthapong.somchit@cmu.ac.th', '', '', '0', null, 'yuthapong.somchit@cmu.ac.th', null, 'นาย', 'ยุทธพงษ์', 'สมจิต', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('42', '', '', 'นริศรา', 'เอี่ยมคณิตชาติ', '0', 'รองศาสตราจารย์ ดร.', '', 'narissara.e@cmu.ac.th', '', '', '0', null, 'narissara.e@cmu.ac.th', null, 'นางสาว', 'นริศรา', 'เอี่ยมคณิตชาติ', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('43', '', '', 'ศันสนีย์', 'เอื้อพันธ์วิริยะกุล', '0', 'รองศาสตราจารย์ ดร.', '', 'sansanee.a@cmu.ac.th', '', '', '0', null, 'sansanee.a@cmu.ac.th', null, 'นางสาว', 'ศันสนีย์', 'เอื้อพันธ์วิริยะกุล', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('44', '', '', 'สรรพวรรธน์', 'กันตะบุตร', '0', 'รองศาสตราจารย์ ดร.', '', 'sanpawat.k@cmu.ac.th', '', '', '0', null, 'sanpawat.k@cmu.ac.th', null, 'นาย', 'สรรพวรรธน์', 'กันตะบุตร', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('45', '', '', 'นษิ', 'ตันติธารานุกุล', '0', 'อาจารย์ ดร.', '', 'nasi.t@cmu.ac.th', '', '', '0', null, 'nasi.t@cmu.ac.th', null, 'นาย', 'นษิ', 'ตันติธารานุกุล', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('46', '', '', 'กานต์', 'ปทานุคม', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'karn.patanukhom@cmu.ac.th', '', '', '0', null, 'karn.patanukhom@cmu.ac.th', null, 'นาย', 'กานต์', 'ปทานุคม', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('47', '', '', 'ศศิน', 'จันทร์พวงทอง', '0', 'อาจารย์ ดร.', '', 'sasin.ja@cmu.ac.th', '', '', '0', null, 'sasin.ja@cmu.ac.th', null, 'นาย', 'ศศิน', 'จันทร์พวงทอง', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('48', '', '', 'ปฏิเวธ', 'วุฒิสารวัฒนา', '0', 'รองศาสตราจารย์ ดร.', '', 'patiwet.w@cmu.ac.th', '', '', '0', null, 'patiwet.w@cmu.ac.th', null, 'นาย', 'ปฏิเวธ', 'วุฒิสารวัฒนา', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('49', '', '', 'อัญญา อาภาวัชรุตม์', 'วีรประพันธ์', '0', 'รองศาสตราจารย์ ดร.', '', 'anya.a@cmu.ac.th', '', '', '0', null, 'anya.a@cmu.ac.th', null, 'นาง', 'อัญญา อาภาวัชรุตม์', 'วีรประพันธ์', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('50', '', '', 'ภาสกร', 'แช่มประเสริฐ', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'paskorn.c@cmu.ac.th', '', '', '0', null, 'paskorn.c@cmu.ac.th', null, 'นาย', 'ภาสกร', 'แช่มประเสริฐ', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('51', '', '', 'นวดนย์', 'คุณเลิศกิจ', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'navadon.k@cmu.ac.th', '', '', '0', null, 'navadon.k@cmu.ac.th', null, 'นาย', 'นวดนย์', 'คุณเลิศกิจ', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('52', '', '', 'ชินวัตร', 'อิศราดิสัยกุล', '0', 'อาจารย์ ดร.', '', 'chinawat.i@cmu.ac.th', '', '', '0', null, 'chinawat.i@cmu.ac.th', null, 'นาย', 'ชินวัตร', 'อิศราดิสัยกุล', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('53', '', '', 'กนก', 'ก๋องหล้า', '0', 'อาจารย์', '', 'kanok.k@cmu.ac.th', '', '', '0', null, 'kanok.k@cmu.ac.th', null, 'นาย', 'กนก', 'ก๋องหล้า', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('54', '', '', 'เกษมสิทธิ์', 'ตียพันธ์', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'kasemsit.t@cmu.ac.th', '', '', '0', null, 'kasemsit.t@cmu.ac.th', null, 'นาย', 'เกษมสิทธิ์', 'ตียพันธ์', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('55', '', '', 'ตรัสพงศ์', 'ไทยอุปถัมภ์', '0', 'รองศาสตราจารย์ ดร.', '', 'trasapong.t@cmu.ac.th', '', '', '0', null, 'trasapong.t@cmu.ac.th', null, 'นาย', 'ตรัสพงศ์', 'ไทยอุปถัมภ์', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('56', '', '', 'อานันท์', 'สีห์พิทักษ์เกียรติ', '0', 'อาจารย์ ดร.', '', 'arnan.s@cmu.ac.th', '', '', '0', null, 'arnan.s@cmu.ac.th', null, 'นาย', 'อานันท์', 'สีห์พิทักษ์เกียรติ', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('57', '', '', 'ธนาทิพย์', 'จันทร์คง', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'thanatip.ch@cmu.ac.th', '', '', '0', null, 'thanatip.ch@cmu.ac.th', null, 'นางสาว', 'ธนาทิพย์', 'จันทร์คง', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('58', '', '', 'พฤษภ์', 'บุญมา', '1', 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', 'pruet.b@cmu.ac.th', '', '', '0', null, 'pruet.b@cmu.ac.th', null, 'นาย', 'พฤษภ์', 'บุญมา', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('59', '', '', 'ศักดิ์กษิต', 'ระมิงค์วงศ์', '0', 'รองศาสตราจารย์ ดร.', '', 'sakgasit.ramingwong@cmu.ac.th', '', '', '0', null, 'sakgasit.ramingwong@cmu.ac.th', null, 'นาย', 'ศักดิ์กษิต', 'ระมิงค์วงศ์', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('60', '', '', 'จักรพงศ์', 'นาทวิชัย', '0', 'รองศาสตราจารย์ ดร.', '', 'juggapong.n@cmu.ac.th', '', '', '0', null, 'juggapong.n@cmu.ac.th', null, 'นาย', 'จักรพงศ์', 'นาทวิชัย', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('61', '', '', 'Kenneth  John', 'Cosh', '0', 'รองศาสตราจารย์ ดร.', '', 'kenneth.c@cmu.ac.th', '', '', '0', null, 'kenneth.c@cmu.ac.th', null, 'นาย', 'Kenneth  John', 'Cosh', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('62', '', '', 'โดม', 'โพธิกานนท์', '0', 'ผู้ช่วยศาสตราจารย์', '', 'dome.potikanond@cmu.ac.th', '', '', '0', null, 'dome.potikanond@cmu.ac.th', null, 'นาย', 'โดม', 'โพธิกานนท์', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('63', '', '', 'สันติ', 'พิทักษ์กิจนุกูร', '1', 'รองศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมคอมพิวเตอร์', 'santi.p@cmu.ac.th', '', '', '0', null, 'santi.p@cmu.ac.th', null, 'นาย', 'สันติ', 'พิทักษ์กิจนุกูร', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('64', '', '', 'เจนจิรา ', 'ใจมั่ง  ', '0', 'อาจารย์ ดร.', '', ' jenjira.j@cmu.ac.th', '', '', '0', null, ' jenjira.j@cmu.ac.th', null, 'นางสาว', 'เจนจิรา ', 'ใจมั่ง  ', null, null, '0', '14', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('65', '', '', 'วงกต', 'วงศ์อภัย', '0', 'รองศาสตราจารย์', '', 'wongkot.w@cmu.ac.th', '', '', '0', null, 'wongkot.w@cmu.ac.th', null, 'นาย', 'วงกต', 'วงศ์อภัย', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('66', '', '', 'ขจรเดช', 'พิมพ์พิไล', '0', 'อาจารย์', '', 'kajorndej.p@cmu.ac.th', '', '', '0', null, 'kajorndej.p@cmu.ac.th', null, 'นาย', 'ขจรเดช', 'พิมพ์พิไล', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('67', '', '', 'มานะ', 'แซ่ด่าน', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'mana.saedan@cmu.ac.th', '', '', '0', null, 'mana.saedan@cmu.ac.th', null, 'นาย', 'มานะ', 'แซ่ด่าน', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('68', '', '', 'ยศธนา', 'คุณาทร', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'yottana.k@cmu.ac.th', '', '', '0', null, 'yottana.k@cmu.ac.th', null, 'นาย', 'ยศธนา', 'คุณาทร', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('69', '', '', 'อารีย์', 'อัจฉริยวิริยะ', '0', 'รองศาสตราจารย์ ดร.', '', 'aree.a@cmu.ac.th', '', '', '0', null, 'aree.a@cmu.ac.th', null, 'นาง', 'อารีย์', 'อัจฉริยวิริยะ', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('70', '', '', 'สมชาย', 'พัฒนา', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'somchai.pattana@cmu.ac.th', '', '', '0', null, 'somchai.pattana@cmu.ac.th', null, 'นาย', 'สมชาย', 'พัฒนา', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('71', '', '', 'เดช', 'ดำรงศักดิ์', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'det.d@cmu.ac.th', '', '', '0', null, 'det.d@cmu.ac.th', null, 'นาย', 'เดช', 'ดำรงศักดิ์', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('72', '', '', 'อิทธิชัย', 'ปรีชาวุฒิพงศ์', '0', 'รองศาสตราจารย์ ดร.', '', 'itthichai.p@cmu.ac.th', '', '', '0', null, 'itthichai.p@cmu.ac.th', null, 'นาย', 'อิทธิชัย', 'ปรีชาวุฒิพงศ์', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('73', '', '', 'เวชยันต์', 'รางศรี', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'wetchayan.rangsri@cmu.ac.th', '', '', '0', null, 'wetchayan.rangsri@cmu.ac.th', null, 'นาย', 'เวชยันต์', 'รางศรี', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('74', '', '', 'กอดขวัญ', 'นามสงวน', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'kodkwan.nam@cmu.ac.th', '', '', '0', null, 'kodkwan.nam@cmu.ac.th', null, 'นาง', 'กอดขวัญ', 'นามสงวน', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('75', '', '', 'วัชรพงษ์', 'ธัชยพงษ์', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'watcharapong.t@cmu.ac.th', '', '', '0', null, 'watcharapong.t@cmu.ac.th', null, 'นาย', 'วัชรพงษ์', 'ธัชยพงษ์', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('76', '', '', 'อนุศาล', 'เพิ่มสุวรรณ', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'anusan.p@cmu.ac.th', '', '', '0', null, 'anusan.p@cmu.ac.th', null, 'นาย', 'อนุศาล', 'เพิ่มสุวรรณ', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('77', '', '', 'ศิวะ', 'อัจฉริยวิริยะ', '0', 'รองศาสตราจารย์ ดร.', '', 'siva.a@cmu.ac.th', '', '', '0', null, 'siva.a@cmu.ac.th', null, 'นาย', 'ศิวะ', 'อัจฉริยวิริยะ', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('78', '', '', 'ชัชวาลย์', 'ชัยชนะ', '1', 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', 'chatchawan.c@cmu.ac.th', '', '', '0', null, 'chatchawan.c@cmu.ac.th', null, 'นาย', 'ชัชวาลย์', 'ชัยชนะ', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('79', '', '', 'ณัฐ', 'วรยศ', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'nat.v@cmu.ac.th', '', '', '0', null, 'nat.v@cmu.ac.th', null, 'นาย', 'ณัฐ', 'วรยศ', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('80', '', '', 'ณัฐวุฒิ', 'เนียมสอน', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'natawut.neamsorn@cmu.ac.th', '', '', '0', null, 'natawut.neamsorn@cmu.ac.th', null, 'นาย', 'ณัฐวุฒิ', 'เนียมสอน', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('81', '', '', 'ธรณิศวร์', 'ดีทายาท', '0', 'รองศาสตราจารย์ ดร.', '', 'thoranis.dee@cmu.ac.th', '', '', '0', null, 'thoranis.dee@cmu.ac.th', null, 'นาย', 'ธรณิศวร์', 'ดีทายาท', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('82', '', '', 'ใฝ่ฝัน', 'ตัณฑกิตติ', '0', 'อาจารย์ ดร.', '', 'faifan.tantakitti@cmu.ac.th', '', '', '0', null, 'faifan.tantakitti@cmu.ac.th', null, 'นางสาว', 'ใฝ่ฝัน', 'ตัณฑกิตติ', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('83', '', '', 'ระดม', 'พงษ์วุฒิธรรม', '0', 'ศาสตราจารย์ ดร.', '', 'radom.p@cmu.ac.th', '', '', '0', null, 'radom.p@cmu.ac.th', null, 'นาย', 'ระดม', 'พงษ์วุฒิธรรม', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('84', '', '', 'กัญญา', 'รัตนะมงคลกุล', '0', 'อาจารย์ ดร.', '', 'kanya.r@cmu.ac.th', '', '', '0', null, 'kanya.r@cmu.ac.th', null, 'นางสาว', 'กัญญา', 'รัตนะมงคลกุล', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('85', '', '', 'อนุชา', 'พรมวังขวา', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'anucha.prom@cmu.ac.th', '', '', '0', null, 'anucha.prom@cmu.ac.th', null, 'นาย', 'อนุชา', 'พรมวังขวา', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('86', '', '', 'นภัสวรรณ', 'วงษ์มงคล', '0', 'อาจารย์ ดร.', '', 'napassawan.k@cmu.ac.th', '', '', '0', null, 'napassawan.k@cmu.ac.th', null, 'นาง', 'นภัสวรรณ', 'วงษ์มงคล', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('87', '', '', 'ณัฐวิทย์', 'พรหมมา', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'nattawit.p@cmu.ac.th', '', '', '0', null, 'nattawit.p@cmu.ac.th', null, 'นาย', 'ณัฐวิทย์', 'พรหมมา', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('88', '', '', 'ภิญโญ', 'พวงมะลิ', '1', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมเครื่องกล', 'pinyo.puangmali@cmu.ac.th', '', '', '0', null, 'pinyo.puangmali@cmu.ac.th', null, 'นาย', 'ภิญโญ', 'พวงมะลิ', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('89', '', '', 'นคร', 'ทิพยาวงศ์', '0', 'ศาสตราจารย์ ดร.', '', 'nakorn.t@cmu.ac.th', '', '', '0', null, 'nakorn.t@cmu.ac.th', null, 'นาย', 'นคร', 'ทิพยาวงศ์', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('90', '', '', 'ปวรุตม์', 'จงชาญสิทโธ', '1', 'รองศาสตราจารย์ ดร.', 'รองคณบดี', 'pawarut.j@cmu.ac.th', '', '', '0', null, 'pawarut.j@cmu.ac.th', null, 'นาย', 'ปวรุตม์', 'จงชาญสิทโธ', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('91', '', '', 'เก่งกมล', 'วิรัตน์เกษม', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'kengkamon.w@cmu.ac.th', '', '', '0', null, 'kengkamon.w@cmu.ac.th', null, 'นาย', 'เก่งกมล', 'วิรัตน์เกษม', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('92', '', '', 'กลยุทธ', 'ปัญญาวุธโธ', '0', 'รองศาสตราจารย์ ดร.', '', 'konlayutt.p@cmu.ac.th', '', '', '0', null, 'konlayutt.p@cmu.ac.th', null, 'นาย', 'กลยุทธ', 'ปัญญาวุธโธ', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('93', '', '', 'จักรพงษ์', 'จำรูญ', '1', 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 'chakkapong.ch@cmu.ac.th', '', '', '0', null, 'chakkapong.ch@cmu.ac.th', null, 'นาย', 'จักรพงษ์', 'จำรูญ', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('94', '', '', 'ธงชัย', 'ฟองสมุทร', '1', 'รองศาสตราจารย์ ดร.', 'คณบดี', 'thongchai.f@cmu.ac.th', '', '', '0', null, 'thongchai.f@cmu.ac.th', null, 'นาย', 'ธงชัย', 'ฟองสมุทร', null, null, '0', '15', '0', '0', '1', '0', '1', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('95', '', '', 'รามณรงค์', 'วณีสอน', '0', 'อาจารย์ ดร.', '', 'ramnarong.wanison@cmu.ac.th', '', '', '0', null, 'ramnarong.wanison@cmu.ac.th', null, 'นาย', 'รามณรงค์', 'วณีสอน', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('96', '', '', 'Matthew', 'Owen Thomas Cole', '0', 'ศาสตราจารย์ ดร.', '', 'matthew.o@cmu.ac.th', '', '', '0', null, 'matthew.o@cmu.ac.th', null, 'นาย', 'Matthew', 'Owen Thomas Cole', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('97', '', '', 'ภัทราพร', 'กมลเพ็ชร', '1', 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', 'patrapon.k@cmu.ac.th', '', '', '0', null, 'patrapon.k@cmu.ac.th', null, 'นาง', 'ภัทราพร', 'กมลเพ็ชร', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('98', '', '', 'ชาย', 'รังสิยากูล', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'chaiy.rungsiyakull@cmu.ac.th', '', '', '0', null, 'chaiy.rungsiyakull@cmu.ac.th', null, 'นาย', 'ชาย', 'รังสิยากูล', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('99', '', '', 'พฤทธ์', 'สกุลช่างสัจจะทัย', '0', 'รองศาสตราจารย์ ดร.', '', 'phrut.s@cmu.ac.th', '', '', '0', null, 'phrut.s@cmu.ac.th', null, 'นาย', 'พฤทธ์', 'สกุลช่างสัจจะทัย', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('100', '', '', 'อรรถกร', 'อาสนคำ', '0', 'รองศาสตราจารย์ ดร.', '', 'attakorn.asana@cmu.ac.th', '', '', '0', null, 'attakorn.asana@cmu.ac.th', null, 'นาย', 'อรรถกร', 'อาสนคำ', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('101', '', '', 'ธีระพงษ์', 'ว่องรัตนะไพศาล', '0', 'รองศาสตราจารย์ ดร.', '', 'theeraphong.wong@cmu.ac.th', '', '', '0', null, 'theeraphong.wong@cmu.ac.th', null, 'นาย', 'ธีระพงษ์', 'ว่องรัตนะไพศาล', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('102', '', '', 'วัชพล', 'โรจนรัตนางกูร', '0', 'รองศาสตราจารย์ ดร.', '', 'watchapon.roj@cmu.ac.th', '', '', '0', null, 'watchapon.roj@cmu.ac.th', null, 'นาย', 'วัชพล', 'โรจนรัตนางกูร', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('103', '', '', 'นิติ', 'คำเมืองลือ', '0', 'รองศาสตราจารย์ ดร.', '', 'niti.k@cmu.ac.th', '', '', '0', null, 'niti.k@cmu.ac.th', null, 'นาย', 'นิติ', 'คำเมืองลือ', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('104', '', '', 'วิบูลย์', 'ช่างเรือ', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'viboon.c@cmu.ac.th', '', '', '0', null, 'viboon.c@cmu.ac.th', null, 'นาย', 'วิบูลย์', 'ช่างเรือ', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('105', '', '', 'James', 'C. Moran', '0', 'รองศาสตราจารย์ ดร.', '', 'james.moran@cmu.ac.th', '', '', '0', null, 'james.moran@cmu.ac.th', null, 'นาย', 'James', 'C. Moran', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('106', '', '', 'ดามร', 'บัณฑุรัตน์', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'damorn.b@cmu.ac.th', '', '', '0', null, 'damorn.b@cmu.ac.th', null, 'นาย', 'ดามร', 'บัณฑุรัตน์', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('107', '', '', 'วรเดช', 'มโนสร้อย', '0', 'รองศาสตราจารย์ ดร.', '', 'woradej.manosroi@cmu.ac.th', '', '', '0', null, 'woradej.manosroi@cmu.ac.th', null, 'นาย', 'วรเดช', 'มโนสร้อย', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('108', '', '', 'พนา', 'สุทธกูล', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'pana.s@cmu.ac.th', '', '', '0', null, 'pana.s@cmu.ac.th', null, 'นาย', 'พนา', 'สุทธกูล', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('109', '', '', 'ยุทธนา', 'โมนะ', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'yuttana.mona@cmu.ac.th', '', '', '0', null, 'yuttana.mona@cmu.ac.th', null, 'นาย', 'ยุทธนา', 'โมนะ', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('110', '', '', 'ประดิษฐ์', 'เทอดทูล', '0', 'ศาสตราจารย์ ดร.', '', 'pradit.terdtoon@cmu.ac.th', '', '', '0', null, 'pradit.terdtoon@cmu.ac.th', null, 'นาย', 'ประดิษฐ์', 'เทอดทูล', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('111', '', '', 'พฤกษ์', 'อักกะรังสี', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'pruk.a@cmu.ac.th', '', '', '0', null, 'pruk.a@cmu.ac.th', null, 'นาย', 'พฤกษ์', 'อักกะรังสี', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('112', '', '', 'กฤต', 'สุจริตธรรม', '0', 'อาจารย์ ดร.', '', 'krit.s@cmu.ac.th', '', '', '0', null, 'krit.s@cmu.ac.th', null, 'นาย', 'กฤต', 'สุจริตธรรม', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('113', '', '', 'ณัฐนี', 'วรยศ', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'nattanee.v@cmu.ac.th', '', '', '0', null, 'nattanee.v@cmu.ac.th', null, 'นางสาว', 'ณัฐนี', 'วรยศ', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('114', '', '', 'อาภิรักษ์', 'หกพันนา', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'arpiruk.hok@cmu.ac.th', '', '', '0', null, 'arpiruk.hok@cmu.ac.th', null, 'นาย', 'อาภิรักษ์', 'หกพันนา', null, null, '0', '15', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('115', '', '', 'พีรพนธ์', 'อนุสารสุนทร', '0', 'อาจารย์', '', 'perapon.a@cmu.ac.th', '', '', '0', null, 'perapon.a@cmu.ac.th', null, 'นาย', 'พีรพนธ์', 'อนุสารสุนทร', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('116', '', '', 'พีรพล', 'จิราพงศ์', '1', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมไฟฟ้า', 'peerapol.j@cmu.ac.th', '', '', '0', null, 'peerapol.j@cmu.ac.th', null, 'นาย', 'พีรพล', 'จิราพงศ์', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('117', '', '', 'ธนะพงษ์', 'ธนะศักดิ์ศิริ', '0', 'รองศาสตราจารย์', '', 'thanaphong.thanasak@cmu.ac.th', '', '', '0', null, 'thanaphong.thanasak@cmu.ac.th', null, 'นาย', 'ธนะพงษ์', 'ธนะศักดิ์ศิริ', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('118', '', '', 'นิพนธ์', 'ธีรอำพน', '0', 'ศาสตราจารย์ ดร.', '', 'nipon.t@cmu.ac.th', '', '', '0', null, 'nipon.t@cmu.ac.th', null, 'นาย', 'นิพนธ์', 'ธีรอำพน', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('119', '', '', 'กสิณ', 'ประกอบไวทยกิจ', '0', 'ผู้ช่วยศาสตราจารย์', '', 'kasin.p@cmu.ac.th', '', '', '0', null, 'kasin.p@cmu.ac.th', null, 'นาย', 'กสิณ', 'ประกอบไวทยกิจ', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('120', '', '', 'ธราดล', 'โกมลมิศร์', '0', 'ผู้ช่วยศาสตราจารย์', '', 'tharadol.k@cmu.ac.th', '', '', '0', null, 'tharadol.k@cmu.ac.th', null, 'นาย', 'ธราดล', 'โกมลมิศร์', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('121', '', '', 'เสริมศักดิ์', 'เอื้อตรงจิตต์', '0', 'รองศาสตราจารย์ ดร.', '', 'sermsak.uatrongjit@cmu.ac.th', '', '', '0', null, 'sermsak.uatrongjit@cmu.ac.th', null, 'นาย', 'เสริมศักดิ์', 'เอื้อตรงจิตต์', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('122', '', '', 'บุญศรี', 'แก้วคำอ้าย', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'boonsri.k@cmu.ac.th', '', '', '0', null, 'boonsri.k@cmu.ac.th', null, 'นางสาว', 'บุญศรี', 'แก้วคำอ้าย', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('123', '', '', 'สมบูรณ์', 'นุชประยูร', '0', 'รองศาสตราจารย์ ดร.', '', 'somboon.nuchprayoon@cmu.ac.th', '', '', '0', null, 'somboon.nuchprayoon@cmu.ac.th', null, 'นาย', 'สมบูรณ์', 'นุชประยูร', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('124', '', '', 'ดลเดช', 'ตันตระวิวัฒน์', '0', 'รองศาสตราจารย์ ดร.', '', 'doldet.tantraviwat@cmu.ac.th', '', '', '0', null, 'doldet.tantraviwat@cmu.ac.th', null, 'นาย', 'ดลเดช', 'ตันตระวิวัฒน์', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('125', '', '', 'สุทธิชัย', 'เปรมฤดีปรีชาชาญ', '0', 'รองศาสตราจารย์ ดร.', '', 'suttichai.p@cmu.ac.th', '', '', '0', null, 'suttichai.p@cmu.ac.th', null, 'นาย', 'สุทธิชัย', 'เปรมฤดีปรีชาชาญ', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('126', '', '', 'เกษมศักดิ์', 'อุทัยชนะ', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'kasemsak.u@cmu.ac.th', '', '', '0', null, 'kasemsak.u@cmu.ac.th', null, 'นาย', 'เกษมศักดิ์', 'อุทัยชนะ', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('127', '', '', 'อุกฤษฏ์', 'มั่นคง', '1', 'รองศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 'ukrit.m@cmu.ac.th', '', '', '0', null, 'ukrit.m@cmu.ac.th', null, 'นาย', 'อุกฤษฏ์', 'มั่นคง', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('128', '', '', 'วิศรุต', 'อัจฉริยวิริยะ', '0', 'อาจารย์ ดร.', '', 'witsarut.a@cmu.ac.th', '', '', '0', null, 'witsarut.a@cmu.ac.th', null, 'นาย', 'วิศรุต', 'อัจฉริยวิริยะ', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('129', '', '', 'สิโรตม์', 'คุณกิตติ', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'sirote.khunkitti@cmu.ac.th', '', '', '0', null, 'sirote.khunkitti@cmu.ac.th', null, 'นาย', 'สิโรตม์', 'คุณกิตติ', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('130', '', '', 'ปณิดา', 'ธารารักษ์', '0', 'อาจารย์ ดร.', '', 'panida.th@cmu.ac.th', '', '', '0', null, 'panida.th@cmu.ac.th', null, 'นางสาว', 'ปณิดา', 'ธารารักษ์', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('131', '', '', 'ยุทธนา', 'ขำสุวรรณ์', '0', 'ศาสตราจารย์ ดร.', '', 'yuttana.k@cmu.ac.th', '', '', '0', null, 'yuttana.k@cmu.ac.th', null, 'นาย', 'ยุทธนา', 'ขำสุวรรณ์', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('132', '', '', 'วัชริน', 'ศรีรัตนาวิชัยกุล', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'watcharin.s@cmu.ac.th', '', '', '0', null, 'watcharin.s@cmu.ac.th', null, 'นาย', 'วัชริน', 'ศรีรัตนาวิชัยกุล', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('133', '', '', 'ณัตพงศ์', 'สมจิตร', '0', 'อาจารย์ ดร.', '', 'nutapong.somjit@cmu.ac.th', '', '', '0', null, 'nutapong.somjit@cmu.ac.th', null, 'นาย', 'ณัตพงศ์', 'สมจิตร', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('134', '', '', 'ปารเมศ', 'วิระสันติ', '0', 'รองศาสตราจารย์ ดร.', '', 'paramet.w@cmu.ac.th', '', '', '0', null, 'paramet.w@cmu.ac.th', null, 'นาย', 'ปารเมศ', 'วิระสันติ', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('135', '', '', 'สรพล', 'กิจศิริสิน', '0', 'อาจารย์ ดร.', '', 'soraphon.k@cmu.ac.th', '', '', '0', null, 'soraphon.k@cmu.ac.th', null, 'นาย', 'สรพล', 'กิจศิริสิน', null, null, '0', '16', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('136', '', '', 'เชี่ยวชาญ', 'ลีลาสุขเสรี', '1', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมเหมืองแร่', 'cheowchan.l@cmu.ac.th', '', '', '0', null, 'cheowchan.l@cmu.ac.th', null, 'นาย', 'เชี่ยวชาญ', 'ลีลาสุขเสรี', null, null, '0', '19', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('137', '', '', 'สุทธิเทพ', 'รมยเวศม์', '0', 'ผู้ช่วยศาสตราจารย์', '', 'suttithep.r@cmu.ac.th', '', '', '0', null, 'suttithep.r@cmu.ac.th', null, 'นาย', 'สุทธิเทพ', 'รมยเวศม์', null, null, '0', '19', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('138', '', '', 'สุพฤทธิ์', 'ตั้งพฤทธิ์กุล', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'suparit.t@cmu.ac.th', '', '', '0', null, 'suparit.t@cmu.ac.th', null, 'นาย', 'สุพฤทธิ์', 'ตั้งพฤทธิ์กุล', null, null, '0', '19', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('139', '', '', 'ธีรภัทร์', 'ต่อสวย', '0', 'อาจารย์', '', 'teerapat.t@cmu.ac.th', '', '', '0', null, 'teerapat.t@cmu.ac.th', null, 'นาย', 'ธีรภัทร์', 'ต่อสวย', null, null, '0', '19', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('140', '', '', 'ทัศษุดา', 'ทักษะวสุ', '0', 'อาจารย์ ดร.', '', 'tadsuda.t@cmu.ac.th', '', '', '0', null, 'tadsuda.t@cmu.ac.th', null, 'นางสาว', 'ทัศษุดา', 'ทักษะวสุ', null, null, '0', '19', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('141', '', '', 'คมสูรย์', 'สมประสงค์', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'komsoon.s@cmu.ac.th', '', '', '0', null, 'komsoon.s@cmu.ac.th', null, 'นาย', 'คมสูรย์', 'สมประสงค์', null, null, '0', '19', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('142', '', '', 'ชนะพล', 'เจริญธนาวรกุล', '0', 'อาจารย์ ดร.', '', 'chanapol.c@cmu.ac.th', '', '', '0', null, 'chanapol.c@cmu.ac.th', null, 'นาย', 'ชนะพล', 'เจริญธนาวรกุล', null, null, '0', '19', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('143', '', '', 'พุทธิพล', 'ดำรงชัย', '0', 'รองศาสตราจารย์ ดร.', '', 'puttipol.d@cmu.ac.th', '', '', '0', null, 'puttipol.d@cmu.ac.th', null, 'นาย', 'พุทธิพล', 'ดำรงชัย', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('144', '', '', 'ไพศาล', 'จั่วทอง', '0', 'อาจารย์', '', 'paisan.jourtong@cmu.ac.th', '', '', '0', null, 'paisan.jourtong@cmu.ac.th', null, 'นาย', 'ไพศาล', 'จั่วทอง', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('145', '', '', 'ปุ่น', 'เที่ยงบูรณธรรม', '0', 'รองศาสตราจารย์ ดร.', '', 'poon.th@cmu.ac.th', '', '', '0', null, 'poon.th@cmu.ac.th', null, 'นาย', 'ปุ่น', 'เที่ยงบูรณธรรม', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('146', '', '', 'ชยานนท์', 'หรรษภิญโญ', '0', 'รองศาสตราจารย์ ดร.', '', 'chayanon.h@cmu.ac.th', '', '', '0', null, 'chayanon.h@cmu.ac.th', null, 'นาย', 'ชยานนท์', 'หรรษภิญโญ', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('147', '', '', 'ดำรงศักดิ์', 'รินชุมภู', '0', 'รองศาสตราจารย์ ดร.', '', 'damrongsak.r@cmu.ac.th', '', '', '0', null, 'damrongsak.r@cmu.ac.th', null, 'นาย', 'ดำรงศักดิ์', 'รินชุมภู', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('148', '', '', 'นที', 'สุริยานนท์', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'natee.suriyanon@cmu.ac.th', '', '', '0', null, 'natee.suriyanon@cmu.ac.th', null, 'นาย', 'นที', 'สุริยานนท์', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('149', '', '', 'สุริยะ', 'ทองมุณี', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'suriyah.t@cmu.ac.th', '', '', '0', null, 'suriyah.t@cmu.ac.th', null, 'นาย', 'สุริยะ', 'ทองมุณี', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('150', '', '', 'เศรษฐพงศ์', 'เศรษฐบุปผา', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'sethapong.s@cmu.ac.th', '', '', '0', null, 'sethapong.s@cmu.ac.th', null, 'นาย', 'เศรษฐพงศ์', 'เศรษฐบุปผา', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('151', '', '', 'ธวัชชัย', 'ตันชัยสวัสดิ์', '1', 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', 'tawatchai.t@cmu.ac.th', '', '', '0', null, 'tawatchai.t@cmu.ac.th', null, 'นาย', 'ธวัชชัย', 'ตันชัยสวัสดิ์', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('152', '', '', 'พุทธรักษ์', 'จรัสพันธุ์กุล', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'bhuddarak.c@cmu.ac.th', '', '', '0', null, 'bhuddarak.c@cmu.ac.th', null, 'นาย', 'พุทธรักษ์', 'จรัสพันธุ์กุล', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('153', '', '', 'พีรวัฒน์', 'ปลาเงิน', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'pheerawat.p@cmu.ac.th', '', '', '0', null, 'pheerawat.p@cmu.ac.th', null, 'นาย', 'พีรวัฒน์', 'ปลาเงิน', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('154', '', '', 'วรากร', 'ตันตระพงศธร', '0', 'อาจารย์ ดร.', '', 'warakorn.tan@cmu.ac.th', '', '', '0', null, 'warakorn.tan@cmu.ac.th', null, 'นาย', 'วรากร', 'ตันตระพงศธร', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('155', '', '', 'พีรพงศ์', 'จิตเสงี่ยม', '0', 'รองศาสตราจารย์ ดร.', '', 'peerapong.j@cmu.ac.th', '', '', '0', null, 'peerapong.j@cmu.ac.th', null, 'นาย', 'พีรพงศ์', 'จิตเสงี่ยม', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('156', '', '', 'เกรียงไกร', 'อรุโณทยานันท์', '1', 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 'kriangkrai.a@cmu.ac.th', '', '', '0', null, 'kriangkrai.a@cmu.ac.th', null, 'นาย', 'เกรียงไกร', 'อรุโณทยานันท์', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('157', '', '', 'ปิติวัฒน์', 'วัฒนชัย', '0', 'รองศาสตราจารย์ ดร.', '', 'pitiwat.w@cmu.ac.th', '', '', '0', null, 'pitiwat.w@cmu.ac.th', null, 'นาย', 'ปิติวัฒน์', 'วัฒนชัย', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('158', '', '', 'ชินพัฒน์', 'บัวชาติ', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'chinapat.b@cmu.ac.th', '', '', '0', null, 'chinapat.b@cmu.ac.th', null, 'นาย', 'ชินพัฒน์', 'บัวชาติ', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('159', '', '', 'ธีวรา', 'สุวรรณ', '0', 'รองศาสตราจารย์ ดร.', '', 'teewara.s@cmu.ac.th', '', '', '0', null, 'teewara.s@cmu.ac.th', null, 'นาย', 'ธีวรา', 'สุวรรณ', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('160', '', '', 'ชนะ', 'สินทรัพย์วโรดม', '0', 'อาจารย์ ดร.', '', 'chana.sinsabvarodom@cmu.ac.th', '', '', '0', null, 'chana.sinsabvarodom@cmu.ac.th', null, 'นาย', 'ชนะ', 'สินทรัพย์วโรดม', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('161', '', '', 'ธนพร', 'สุปริยศิลป์', '0', 'รองศาสตราจารย์ ดร.', '', 'thanaporn.s@cmu.ac.th', '', '', '0', null, 'thanaporn.s@cmu.ac.th', null, 'นางสาว', 'ธนพร', 'สุปริยศิลป์', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('162', '', '', 'นพดล', 'กรประเสริฐ', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'nopadon.k@cmu.ac.th', '', '', '0', null, 'nopadon.k@cmu.ac.th', null, 'นาย', 'นพดล', 'กรประเสริฐ', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('163', '', '', 'ทรงยศ', 'กิจธรรมเกษร', '1', 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 'songyot.k@cmu.ac.th', '', '', '0', null, 'songyot.k@cmu.ac.th', null, 'นาย', 'ทรงยศ', 'กิจธรรมเกษร', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('164', '', '', 'ปรีดา', 'พิชยาพันธ์', '1', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมโยธา', 'preda.p@cmu.ac.th', '', '', '0', null, 'preda.p@cmu.ac.th', null, 'นาย', 'ปรีดา', 'พิชยาพันธ์', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('165', '', '', 'ปิยะพงษ์', 'วงค์เมธา', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'piyapong.wongmatar@cmu.ac.th', '', '', '0', null, 'piyapong.wongmatar@cmu.ac.th', null, 'นาย', 'ปิยะพงษ์', 'วงค์เมธา', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('166', '', '', 'กิตติคุณ', 'จิตไพโรจน์', '0', 'อาจารย์ ดร.', '', 'kittikun.j@cmu.ac.th', '', '', '0', null, 'kittikun.j@cmu.ac.th', null, 'นาย', 'กิตติคุณ', 'จิตไพโรจน์', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('167', '', '', 'อรรถวิทย์', 'อุปโยคิน', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'auttawit.u@cmu.ac.th', '', '', '0', null, 'auttawit.u@cmu.ac.th', null, 'นาย', 'อรรถวิทย์', 'อุปโยคิน', null, null, '0', '17', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('168', '', '', 'ภาคภูมิ', 'รักร่วม', '1', 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 'pharkphum.r@cmu.ac.th', '', '', '0', null, 'pharkphum.r@cmu.ac.th', null, 'นาย', 'ภาคภูมิ', 'รักร่วม', null, null, '0', '18', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('169', '', '', 'พิมพ์ลักษณ์', 'กิจจนะพานิช', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'pimluck.k@cmu.ac.th', '', '', '0', null, 'pimluck.k@cmu.ac.th', null, 'นางสาว', 'พิมพ์ลักษณ์', 'กิจจนะพานิช', null, null, '0', '18', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('170', '', '', 'ปฏิรูป', 'ผลจันทร์', '1', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมสิ่งแวดล้อม', 'patiroop.p@cmu.ac.th', '', '', '0', null, 'patiroop.p@cmu.ac.th', null, 'นาย', 'ปฏิรูป', 'ผลจันทร์', null, null, '0', '18', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('171', '', '', 'สรัลนุช', 'ภู่พิสิฐ', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'sarunnoud.p@cmu.ac.th', '', '', '0', null, 'sarunnoud.p@cmu.ac.th', null, 'นางสาว', 'สรัลนุช', 'ภู่พิสิฐ', null, null, '0', '18', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('172', '', '', 'ณภัทร', 'จักรวัฒนา', '0', 'รองศาสตราจารย์ ดร.', '', 'napat.ja@cmu.ac.th', '', '', '0', null, 'napat.ja@cmu.ac.th', null, 'นาย', 'ณภัทร', 'จักรวัฒนา', null, null, '0', '18', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('173', '', '', 'สิริชัย', 'คุณภาพดีเลิศ', '0', 'รองศาสตราจารย์ ดร.', '', 'sirichai.k@cmu.ac.th', '', '', '0', null, 'sirichai.k@cmu.ac.th', null, 'นาย', 'สิริชัย', 'คุณภาพดีเลิศ', null, null, '0', '18', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('174', '', '', 'อรรณพ', 'วงศ์เรือง', '0', 'รองศาสตราจารย์ ดร.', '', 'aunnop.w@cmu.ac.th', '', '', '0', null, 'aunnop.w@cmu.ac.th', null, 'นาย', 'อรรณพ', 'วงศ์เรือง', null, null, '0', '18', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('175', '', '', 'พวงรัตน์', 'แก้วล้อม', '0', 'ศาสตราจารย์ ดร.', '', 'puangrat.k@cmu.ac.th', '', '', '0', null, 'puangrat.k@cmu.ac.th', null, 'นางสาว', 'พวงรัตน์', 'แก้วล้อม', null, null, '0', '18', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('176', '', '', 'เสาหฤท', 'นิตยวรรธนะ', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'saoharit.n@cmu.ac.th', '', '', '0', null, 'saoharit.n@cmu.ac.th', null, 'นางสาว', 'เสาหฤท', 'นิตยวรรธนะ', null, null, '0', '18', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('177', '', '', 'สุลักษณ์', 'สุมิตสวรรค์', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'sulak.sumit@cmu.ac.th', '', '', '0', null, 'sulak.sumit@cmu.ac.th', null, 'นาย', 'สุลักษณ์', 'สุมิตสวรรค์', null, null, '0', '18', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('178', '', '', 'ปรัตถกร', 'สิทธิสม', '0', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'prattakorn.s@cmu.ac.th', '', '', '0', null, 'prattakorn.s@cmu.ac.th', null, 'นาย', 'ปรัตถกร', 'สิทธิสม', null, null, '0', '18', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('179', '', '', 'รัฐพล', 'พรประสิทธิ์', '0', 'นักวิจัย', '', 'rattapol.p@cmu.ac.th', '', '', '0', null, 'rattapol.p@cmu.ac.th', null, 'นาย', 'รัฐพล', 'พรประสิทธิ์', null, null, '0', '6', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('180', '', '', 'ชาลิณี ', 'พิพัฒนพิภพ', '0', 'อาจารย์ ดร.', '', 'chalinee.m@cmu.ac.th', '', '', '0', null, 'chalinee.m@cmu.ac.th', null, 'นางสาว', 'ชาลิณี ', 'พิพัฒนพิภพ', null, null, '0', '35', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('181', '', '', 'คุณานนต์', 'จงชาญสิทโธ', '0', 'อาจารย์ ดร.', '', 'อยู่ระหว่างการจัดทำคำสั่งบรรจุ', '', '', '0', null, 'อยู่ระหว่างการจัดทำคำสั่งบรรจุ', null, 'นาย', 'คุณานนต์', 'จงชาญสิทโธ', null, null, '0', '0', '0', '0', '0', '0', '0', '1', '0', null);
INSERT INTO `tbl_members` VALUES ('182', '', '', 'พรรณี', 'โศจิธรรมพร', '1', 'นักจัดการงานทั่วไป', 'เลขานุการคณะ', 'phannee.sojit@cmu.ac.th', '', '', '0', null, 'phannee.sojit@cmu.ac.th', null, 'นาง', 'พรรณี', 'โศจิธรรมพร', null, null, '0', '1', '0', '0', '1', '1', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('183', '', '', 'สนธยา', 'สุขสามัคคี', '0', 'พนักงานช่าง', '', 'sonthaya.s@cmu.ac.th', '', '', '0', null, 'sonthaya.s@cmu.ac.th', null, 'นาย', 'สนธยา', 'สุขสามัคคี', null, null, '0', '20', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('184', '', '', 'วุฒินันท์', 'อินทยศ', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'wuttinun.in@cmu.ac.th', '', '', '0', null, 'wuttinun.in@cmu.ac.th', null, 'นาย', 'วุฒินันท์', 'อินทยศ', null, null, '0', '20', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('185', '', '', 'เจตนิพัทธ์', 'สามตา', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'chetniphat.samta@cmu.ac.th', '', '', '0', null, 'chetniphat.samta@cmu.ac.th', null, 'นาย', 'เจตนิพัทธ์', 'สามตา', null, null, '0', '20', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('186', '', '', 'พรพรรณ', 'คำมั่น', '0', 'นักจัดการงานทั่วไป', '', 'ponpun.k@cmu.ac.th', '', '', '0', null, 'ponpun.k@cmu.ac.th', null, 'นางสาว', 'พรพรรณ', 'คำมั่น', null, null, '0', '20', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('187', '', '', 'นรินทร์', 'จักร์ปั๋น', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'narin.c@cmu.ac.th', '', '', '0', null, 'narin.c@cmu.ac.th', null, 'นาย', 'นรินทร์', 'จักร์ปั๋น', null, null, '0', '20', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('188', '', '', 'ณัฐวุฒิ', 'รินโน', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'nattawoot.rinno@cmu.ac.th', '', '', '0', null, 'nattawoot.rinno@cmu.ac.th', null, 'นาย', 'ณัฐวุฒิ', 'รินโน', null, null, '0', '20', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('189', '', '', 'วิมุทิตา', 'ปัญโญใหญ่', '0', 'นักจัดการงานทั่วไป', '', 'wimutita.p@cmu.ac.th', '', '', '0', null, 'wimutita.p@cmu.ac.th', null, 'นางสาว', 'วิมุทิตา', 'ปัญโญใหญ่', null, null, '0', '20', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('190', '', '', 'ธัญญาลักษณ์', 'กิติวิริยะชัย', '0', 'นักจัดการงานทั่วไป', '', 'thunyaluk.kiti@cmu.ac.th', '', '', '0', null, 'thunyaluk.kiti@cmu.ac.th', null, 'นางสาว', 'ธัญญาลักษณ์', 'กิติวิริยะชัย', null, null, '0', '20', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('191', '', '', 'ศักดินนท์', 'นันทนา', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'sakdinon.nantana@cmu.ac.th', '', '', '0', null, 'sakdinon.nantana@cmu.ac.th', null, 'นาย', 'ศักดินนท์', 'นันทนา', null, null, '0', '20', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('192', '', '', 'วุฒิพงศ์', 'คำวงค์', '0', 'นักจัดการงานทั่วไป', '', 'wutipong.k@cmu.ac.th', '', '', '0', null, 'wutipong.k@cmu.ac.th', null, 'นาย', 'วุฒิพงศ์', 'คำวงค์', null, null, '0', '20', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('193', '', '', 'รัตติยากร', 'ชาตตนนท์', '0', 'นักจัดการงานทั่วไป', '', 'rattiyakorn.c@cmu.ac.th', '', '', '0', null, 'rattiyakorn.c@cmu.ac.th', null, 'นางสาว', 'รัตติยากร', 'ชาตตนนท์', null, null, '0', '20', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('194', '', '', 'นัยนา', 'ยะสิงห์สาร', '0', 'นักจัดการงานทั่วไป', '', 'naiyana.y@cmu.ac.th', '', '', '0', null, 'naiyana.y@cmu.ac.th', null, 'นางสาว', 'นัยนา', 'ยะสิงห์สาร', null, null, '0', '20', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('195', '', '', 'พรสุดา', 'เสาร์สิงห์', '0', 'นักจัดการงานทั่วไป', '', 'pornsuda.s@cmu.ac.th', '', '', '0', null, 'pornsuda.s@cmu.ac.th', null, 'นางสาว', 'พรสุดา', 'เสาร์สิงห์', null, null, '0', '20', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('196', '', '', 'วิภาวรรณ', 'พันดวง', '0', 'นักจัดการงานทั่วไป', '', 'wipawarn.m@cmu.ac.th', '', '', '0', null, 'wipawarn.m@cmu.ac.th', null, 'นาง', 'วิภาวรรณ', 'พันดวง', null, null, '0', '14', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('197', '', '', 'พรพิมล', 'พรมมินทร์', '0', 'นักจัดการงานทั่วไป', '', 'pornpimol.p@cmu.ac.th', '', '', '0', null, 'pornpimol.p@cmu.ac.th', null, 'นาง', 'พรพิมล', 'พรมมินทร์', null, null, '0', '14', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('198', '', '', 'สิทธิชน', 'อังคุตรานนท์', '0', 'นักวิชาการคอมพิวเตอร์', '', 'sittichon.a@cmu.ac.th', '', '', '0', null, 'sittichon.a@cmu.ac.th', null, 'นาย', 'สิทธิชน', 'อังคุตรานนท์', null, null, '0', '14', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('199', '', '', 'อภิชาติ', 'รอดเรือน', '0', 'นักจัดการงานทั่วไป', '', 'aphichat.r@cmu.ac.th', '', '', '0', null, 'aphichat.r@cmu.ac.th', null, 'นาย', 'อภิชาติ', 'รอดเรือน', null, null, '0', '14', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('200', '', '', 'ธิดากร', 'สิริชลวรา', '0', 'พนักงานบริการทั่วไป', '', 'waraporn.tipsorn@cmu.ac.th', '', '', '0', null, 'waraporn.tipsorn@cmu.ac.th', null, 'นางสาว', 'ธิดากร', 'สิริชลวรา', null, null, '0', '14', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('201', '', '', 'เพียงตา', 'อภิวงศ์', '0', 'นักจัดการงานทั่วไป', '', 'piangta.a@cmu.ac.th', '', '', '0', null, 'piangta.a@cmu.ac.th', null, 'นางสาว', 'เพียงตา', 'อภิวงศ์', null, null, '0', '14', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('202', '', '', 'อุรพี', 'ธรรมโยธิน', '0', 'นักจัดการงานทั่วไป', '', 'urapee.t@cmu.ac.th', '', '', '0', null, 'urapee.t@cmu.ac.th', null, 'นางสาว', 'อุรพี', 'ธรรมโยธิน', null, null, '0', '14', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('203', '', '', 'ณฐพรหม', 'ปัญจมา', '0', 'ช่างอิเล็กทรอนิกส์', '', 'nathaprom.p@cmu.ac.th', '', '', '0', null, 'nathaprom.p@cmu.ac.th', null, 'นาย', 'ณฐพรหม', 'ปัญจมา', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('204', '', '', 'ปนัดดา', 'ตุ้ยอุ่นเรือน', '0', 'นักจัดการงานทั่วไป', '', 'panutda.t@cmu.ac.th', '', '', '0', null, 'panutda.t@cmu.ac.th', null, 'นางสาว', 'ปนัดดา', 'ตุ้ยอุ่นเรือน', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('205', '', '', 'มรกต', 'อภิวงศ์งาม', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'morakot.apiwongngam@cmu.ac.th', '', '', '0', null, 'morakot.apiwongngam@cmu.ac.th', null, 'นาย', 'มรกต', 'อภิวงศ์งาม', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('206', '', '', 'อัศวิน', 'ปศุศฤทธากร', '0', 'วิศวกร', '', 'aswin.p@cmu.ac.th', '', '', '0', null, 'aswin.p@cmu.ac.th', null, 'นาย', 'อัศวิน', 'ปศุศฤทธากร', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('207', '', '', 'ณฐพล', 'ทองสอน', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'natapon.t@cmu.ac.th', '', '', '0', null, 'natapon.t@cmu.ac.th', null, 'นาย', 'ณฐพล', 'ทองสอน', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('208', '', '', 'นิภาวรรณ์', 'คำวัง', '0', 'นักจัดการงานทั่วไป', '', 'nipawan.k@cmu.ac.th', '', '', '0', null, 'nipawan.k@cmu.ac.th', null, 'นางสาว', 'นิภาวรรณ์', 'คำวัง', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('209', '', '', 'นรเศรษฐ์', 'บานนิกุล', '0', 'วิศวกร', '', 'norrasaet.b@cmu.ac.th', '', '', '0', null, 'norrasaet.b@cmu.ac.th', null, 'นาย', 'นรเศรษฐ์', 'บานนิกุล', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('210', '', '', 'อาภัสรา', 'คล้ายณรงค์', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'apasara.k@cmu.ac.th', '', '', '0', null, 'apasara.k@cmu.ac.th', null, 'นางสาว', 'อาภัสรา', 'คล้ายณรงค์', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('211', '', '', 'ผุสดี', 'จันทร์เอี่ยม', '0', 'นักจัดการงานทั่วไป', '', 'pusadee.ch@cmu.ac.th', '', '', '0', null, 'pusadee.ch@cmu.ac.th', null, 'นางสาว', 'ผุสดี', 'จันทร์เอี่ยม', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('212', '', '', 'ณัฐพงศ์', 'กันธะเรียน', '0', 'นักวิชาการคอมพิวเตอร์', '', 'nattapong.g@cmu.ac.th', '', '', '0', null, 'nattapong.g@cmu.ac.th', null, 'นาย', 'ณัฐพงศ์', 'กันธะเรียน', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('213', '', '', 'กาญจนา', 'แปงสุตา', '0', 'นักจัดการงานทั่วไป', '', 'kanjarna.pang@cmu.ac.th', '', '', '0', null, 'kanjarna.pang@cmu.ac.th', null, 'นางสาว', 'กาญจนา', 'แปงสุตา', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('214', '', '', 'ธวัชชัย', 'ธรรมขันแก้ว', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'thawatchai.t@cmu.ac.th', '', '', '0', null, 'thawatchai.t@cmu.ac.th', null, 'นาย', 'ธวัชชัย', 'ธรรมขันแก้ว', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('215', '', '', 'วราลักษณ์', 'เหล็กสมบูรณ์', '0', 'นักจัดการงานทั่วไป', '', 'waraluck.l@cmu.ac.th', '', '', '0', null, 'waraluck.l@cmu.ac.th', null, 'นาง', 'วราลักษณ์', 'เหล็กสมบูรณ์', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('216', '', '', 'วรางคณา', 'สุกชัยเจริญพร', '0', 'นักจัดการงานทั่วไป', '', 'warangkana.sukch@cmu.ac.th', '', '', '0', null, 'warangkana.sukch@cmu.ac.th', null, 'นางสาว', 'วรางคณา', 'สุกชัยเจริญพร', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('217', '', '', 'สุขภวัฒ', 'ศิริมูล', '0', 'พนักงานบริการทั่วไป', '', 'sukphawat.siri@cmu.ac.th', '', '', '0', null, 'sukphawat.siri@cmu.ac.th', null, 'นาย', 'สุขภวัฒ', 'ศิริมูล', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('218', '', '', 'วัชระ', 'โฉมศรี', '0', 'พนักงานช่าง', '', 'watchara.chomesri@cmu.ac.th', '', '', '0', null, 'watchara.chomesri@cmu.ac.th', null, 'นาย', 'วัชระ', 'โฉมศรี', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('219', '', '', 'นริศ', 'เมืองแก่น', '0', 'พนักงานช่าง', '', 'narid.m@cmu.ac.th', '', '', '0', null, 'narid.m@cmu.ac.th', null, 'นาย', 'นริศ', 'เมืองแก่น', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('220', '', '', 'วิษณุ', 'ตันไพจิตร', '0', 'พนักงานช่าง', '', 'visanu.t@cmu.ac.th', '', '', '0', null, 'visanu.t@cmu.ac.th', null, 'นาย', 'วิษณุ', 'ตันไพจิตร', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('221', '', '', 'วัชรพงษ์', 'สมศรี', '0', 'พนักงานช่าง', '', 'watcharapong.somsri@cmu.ac.th', '', '', '0', null, 'watcharapong.somsri@cmu.ac.th', null, 'นาย', 'วัชรพงษ์', 'สมศรี', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('222', '', '', 'ทรงกลด', 'มายาง', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'songklot.m@cmu.ac.th', '', '', '0', null, 'songklot.m@cmu.ac.th', null, 'นาย', 'ทรงกลด', 'มายาง', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('223', '', '', 'อนัญญา', 'ลัทธิกุล', '0', 'นักจัดการงานทั่วไป', '', 'ananya.l@cmu.ac.th', '', '', '0', null, 'ananya.l@cmu.ac.th', null, 'นางสาว', 'อนัญญา', 'ลัทธิกุล', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('224', '', '', 'นพดล', 'หวลสัตย์', '0', 'พนักงานสถานที่', '', 'nopphadon.h@cmu.ac.th', '', '', '0', null, 'nopphadon.h@cmu.ac.th', null, 'นาย', 'นพดล', 'หวลสัตย์', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('225', '', '', 'อิสราภรณ์', 'ลายเขียว', '0', 'นักจัดการงานทั่วไป', '', 'aitsaraporn.l@cmu.ac.th', '', '', '0', null, 'aitsaraporn.l@cmu.ac.th', null, 'นางสาว', 'อิสราภรณ์', 'ลายเขียว', null, null, '0', '15', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('226', '', '', 'ประเสริฐ', 'มาวิมล', '0', 'วิศวกรไฟฟ้า', '', 'prasert.m@cmu.ac.th', '', '', '0', null, 'prasert.m@cmu.ac.th', null, 'นาย', 'ประเสริฐ', 'มาวิมล', null, null, '0', '16', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('227', '', '', 'ประยูร', 'บัวรินทร์', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'prayoon.b@cmu.ac.th', '', '', '0', null, 'prayoon.b@cmu.ac.th', null, 'นาย', 'ประยูร', 'บัวรินทร์', null, null, '0', '16', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('228', '', '', 'ประยูรศักดิ์', 'พรายจันทร์', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'prayoonsak.p@cmu.ac.th', '', '', '0', null, 'prayoonsak.p@cmu.ac.th', null, 'นาย', 'ประยูรศักดิ์', 'พรายจันทร์', null, null, '0', '16', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('229', '', '', 'แสงเดือน', 'โปธา', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'sangdaun.p@cmu.ac.th', '', '', '0', null, 'sangdaun.p@cmu.ac.th', null, 'นางสาว', 'แสงเดือน', 'โปธา', null, null, '0', '16', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('230', '', '', 'อุไรวรรณ', 'ไชยถา', '0', 'นักจัดการงานทั่วไป', '', 'uraiwan.ch@cmu.ac.th', '', '', '0', null, 'uraiwan.ch@cmu.ac.th', null, 'นางสาว', 'อุไรวรรณ', 'ไชยถา', null, null, '0', '16', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('231', '', '', 'สุชาดา', 'มหาไม้', '0', 'วิศวกร', '', 'suchada.ma@cmu.ac.th', '', '', '0', null, 'suchada.ma@cmu.ac.th', null, 'ว่าที่ร้อยตรีหญิง', 'สุชาดา', 'มหาไม้', null, null, '0', '16', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('232', '', '', 'ราเมศ', 'นันทจันทร์', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'ramest.nantajan@cmu.ac.th', '', '', '0', null, 'ramest.nantajan@cmu.ac.th', null, 'นาย', 'ราเมศ', 'นันทจันทร์', null, null, '0', '16', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('233', '', '', 'นัฐนันท์', 'บุตรศักดิ์', '0', 'นักจัดการงานทั่วไป', '', 'nuttanan.bu@cmu.ac.th', '', '', '0', null, 'nuttanan.bu@cmu.ac.th', null, 'นางสาว', 'นัฐนันท์', 'บุตรศักดิ์', null, null, '0', '16', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('234', '', '', 'มัฒนา', 'เครืออุ่นเรือน', '0', 'พนักงานบริการทั่วไป', '', 'matana.k@cmu.ac.th', '', '', '0', null, 'matana.k@cmu.ac.th', null, 'นางสาว', 'มัฒนา', 'เครืออุ่นเรือน', null, null, '0', '16', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('235', '', '', 'สุวิทย์', 'สิทธิชัยวงศ์', '0', 'พนักงานสถานที่', '', 'suwit.s@cmu.ac.th', '', '', '0', null, 'suwit.s@cmu.ac.th', null, 'นาย', 'สุวิทย์', 'สิทธิชัยวงศ์', null, null, '0', '16', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('236', '', '', 'ดั่งฤทัย', 'อินมณี', '0', 'นักจัดการงานทั่วไป', '', 'dungruthai.i@cmu.ac.th', '', '', '0', null, 'dungruthai.i@cmu.ac.th', null, 'นางสาว', 'ดั่งฤทัย', 'อินมณี', null, null, '0', '16', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('237', '', '', 'ศุภกานต์', 'ธิเตจ๊ะ', '0', 'นักวิทยาศาสตร์', '', 'suppagarn.t@cmu.ac.th', '', '', '0', null, 'suppagarn.t@cmu.ac.th', null, 'นาย', 'ศุภกานต์', 'ธิเตจ๊ะ', null, null, '0', '19', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('238', '', '', 'ศิวดล', 'สุภาเปี้ย', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'siwadol.s@cmu.ac.th', '', '', '0', null, 'siwadol.s@cmu.ac.th', null, 'นาย', 'ศิวดล', 'สุภาเปี้ย', null, null, '0', '19', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('239', '', '', 'สุทิน', 'เมทา', '0', 'พนักงานบริการทั่วไป', '', 'suthin.meta@cmu.ac.th', '', '', '0', null, 'suthin.meta@cmu.ac.th', null, 'นาย', 'สุทิน', 'เมทา', null, null, '0', '19', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('240', '', '', 'ปุณณิฐฐา', 'ธัญญาพิชญะนันท์', '0', 'นักจัดการงานทั่วไป', '', 'phoonnistha.t@cmu.ac.th', '', '', '0', null, 'phoonnistha.t@cmu.ac.th', null, 'นางสาว', 'ปุณณิฐฐา', 'ธัญญาพิชญะนันท์', null, null, '0', '19', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('241', '', '', 'เครือวัลย์', 'บุญเกิด', '0', 'พนักงานบริการทั่วไป', '', 'khrueawan.b@cmu.ac.th', '', '', '0', null, 'khrueawan.b@cmu.ac.th', null, 'นาง', 'เครือวัลย์', 'บุญเกิด', null, null, '0', '19', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('242', '', '', 'กิตติทัศน์', 'ผ่องศรีธนสกุล', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'kittithat.ph@cmu.ac.th', '', '', '0', null, 'kittithat.ph@cmu.ac.th', null, 'นาย', 'กิตติทัศน์', 'ผ่องศรีธนสกุล', null, null, '0', '17', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('243', '', '', 'สุทธิพงศ์', 'คำดี', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'suttipong.k@cmu.ac.th', '', '', '0', null, 'suttipong.k@cmu.ac.th', null, 'นาย', 'สุทธิพงศ์', 'คำดี', null, null, '0', '17', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('244', '', '', 'ธนโชติ', 'เมืองใจ', '0', 'วิศวกร', '', 'thanachot.m@cmu.ac.th', '', '', '0', null, 'thanachot.m@cmu.ac.th', null, 'นาย', 'ธนโชติ', 'เมืองใจ', null, null, '0', '17', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('245', '', '', 'ณรงค์', 'ศรีวิชัย', '0', 'พนักงานช่าง', '', 'narong.sri@cmu.ac.th', '', '', '0', null, 'narong.sri@cmu.ac.th', null, 'นาย', 'ณรงค์', 'ศรีวิชัย', null, null, '0', '17', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('246', '', '', 'ผดุงศักดิ์', 'ปันครอง', '0', 'พนักงานบริการทั่วไป', '', 'phadungsak.p@cmu.ac.th', '', '', '0', null, 'phadungsak.p@cmu.ac.th', null, 'นาย', 'ผดุงศักดิ์', 'ปันครอง', null, null, '0', '17', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('247', '', '', 'เสน่ห์', 'แก้วพงค์ธิ', '0', 'พนักงานบริการทั่วไป', '', 'sane.k@cmu.ac.th', '', '', '0', null, 'sane.k@cmu.ac.th', null, 'นาย', 'เสน่ห์', 'แก้วพงค์ธิ', null, null, '0', '17', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('248', '', '', 'สุทธิพงษ์', 'กันทา', '0', 'พนักงานบริการทั่วไป', '', 'sutthipong.kantha@cmu.ac.th', '', '', '0', null, 'sutthipong.kantha@cmu.ac.th', null, 'นาย', 'สุทธิพงษ์', 'กันทา', null, null, '0', '17', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('249', '', '', 'บุญมี', 'เจิมจันทร์', '0', 'พนักงานบริการทั่วไป', '', 'boonmee.j@cmu.ac.th', '', '', '0', null, 'boonmee.j@cmu.ac.th', null, 'นาย', 'บุญมี', 'เจิมจันทร์', null, null, '0', '17', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('250', '', '', 'เกศิณี', 'เรือนคำ', '0', 'วิศวกร', '', 'kasinee.r@cmu.ac.th', '', '', '0', null, 'kasinee.r@cmu.ac.th', null, 'นางสาว', 'เกศิณี', 'เรือนคำ', null, null, '0', '17', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('251', '', '', 'วินัย', 'เรือนปัญโญ', '0', 'พนักงานบริการทั่วไป', '', 'winai.r@cmu.ac.th', '', '', '0', null, 'winai.r@cmu.ac.th', null, 'นาย', 'วินัย', 'เรือนปัญโญ', null, null, '0', '17', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('252', '', '', 'นิจวรีย์', 'ยศสอน', '0', 'นักจัดการงานทั่วไป', '', 'nitwaree.y@cmu.ac.th', '', '', '0', null, 'nitwaree.y@cmu.ac.th', null, 'นางสาว', 'นิจวรีย์', 'ยศสอน', null, null, '0', '17', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('253', '', '', 'ณัฐธิชา', 'ทองหลอม', '0', 'นักจัดการงานทั่วไป', '', 'natticha.th@cmu.ac.th', '', '', '0', null, 'natticha.th@cmu.ac.th', null, 'นางสาว', 'ณัฐธิชา', 'ทองหลอม', null, null, '0', '17', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('254', '', '', 'เกศสุนี', 'ทองเมฆ', '0', 'นักจัดการงานทั่วไป', '', 'gatesunee.th@cmu.ac.th', '', '', '0', null, 'gatesunee.th@cmu.ac.th', null, 'นางสาว', 'เกศสุนี', 'ทองเมฆ', null, null, '0', '17', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('255', '', '', 'พรสวรรค์', 'ขัติยศ', '0', 'นักวิทยาศาสตร์', '', 'pornsawan.k@cmu.ac.th', '', '', '0', null, 'pornsawan.k@cmu.ac.th', null, 'นางสาว', 'พรสวรรค์', 'ขัติยศ', null, null, '0', '18', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('256', '', '', 'นรเทพ', 'พลวณิช', '0', 'นักวิทยาศาสตร์', '', 'noratep.p@cmu.ac.th', '', '', '0', null, 'noratep.p@cmu.ac.th', null, 'นาง', 'นรเทพ', 'พลวณิช', null, null, '0', '18', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('257', '', '', 'สรวิศิษฐ์', 'นิลพรรณ', '0', 'นักจัดการงานทั่วไป', '', 'sorawisit.n@cmu.ac.th', '', '', '0', null, 'sorawisit.n@cmu.ac.th', null, 'นาย', 'สรวิศิษฐ์', 'นิลพรรณ', null, null, '0', '18', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('258', '', '', 'กอบกุล', 'ชัยรักษ์', '0', 'พนักงานบริการทั่วไป', '', 'kobkul.m@cmu.ac.th', '', '', '0', null, 'kobkul.m@cmu.ac.th', null, 'นาง', 'กอบกุล', 'ชัยรักษ์', null, null, '0', '18', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('259', '', '', 'นารีรัตน์', 'เหมโลหะ', '0', 'นักวิทยาศาสตร์', '', 'nareerat.h@cmu.ac.th', '', '', '0', null, 'nareerat.h@cmu.ac.th', null, 'นางสาว', 'นารีรัตน์', 'เหมโลหะ', null, null, '0', '18', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('260', '', '', 'รตนพร', 'พงษ์มณี', '0', 'นักจัดการงานทั่วไป', '', 'ratanaporn.p@cmu.ac.th', '', '', '0', null, 'ratanaporn.p@cmu.ac.th', null, 'นางสาว', 'รตนพร', 'พงษ์มณี', null, null, '0', '18', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('261', '', '', 'อัจฉราวรรณ', 'อินทรส', '0', 'นักจัดการงานทั่วไป', 'หัวหน้างานบริหารทั่วไป', 'atcharawan.i@cmu.ac.th', '', '', '0', null, 'atcharawan.i@cmu.ac.th', null, 'นาง', 'อัจฉราวรรณ', 'อินทรส', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('262', '', '', 'ภัทราวิจิตร', 'มณีประเสริฐ', '0', 'นักจัดการงานทั่วไป', '', 'pattaravijit.m@cmu.ac.th', '', '', '0', null, 'pattaravijit.m@cmu.ac.th', null, 'นางสาว', 'ภัทราวิจิตร', 'มณีประเสริฐ', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('263', '', '', 'อนุชิต', 'เนตรศิลป์', '0', 'คนสวน', '', 'anuchit.n@cmu.ac.th', '', '', '0', null, 'anuchit.n@cmu.ac.th', null, 'นาย', 'อนุชิต', 'เนตรศิลป์', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('264', '', '', 'ชานนท์', 'แก้วบุญเรือง', '0', 'วิศวกร', '', 'chanon.ka@cmu.ac.th', '', '', '0', null, 'chanon.ka@cmu.ac.th', null, 'นาย', 'ชานนท์', 'แก้วบุญเรือง', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('265', '', '', 'เกียรติชัย', 'บุญทารักษ์', '0', 'นักจัดการงานทั่วไป', '', 'kiattichai.b@cmu.ac.th', '', '', '0', null, 'kiattichai.b@cmu.ac.th', null, 'นาย', 'เกียรติชัย', 'บุญทารักษ์', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('266', '', '', 'พิกุล', 'อินตากุล', '0', 'นักจัดการงานทั่วไป', '', 'pikul.in@cmu.ac.th', '', '', '0', null, 'pikul.in@cmu.ac.th', null, 'นางสาว', 'พิกุล', 'อินตากุล', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('267', '', '', 'กมลพร', 'มณีวรรณ', '0', 'นักจัดการงานทั่วไป', '', 'kamonporn.m@cmu.ac.th', '', '', '0', null, 'kamonporn.m@cmu.ac.th', null, 'นางสาว', 'กมลพร', 'มณีวรรณ', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('268', '', '', 'นัทธพงศ์', 'เสนรังษี', '0', 'นักจัดการงานทั่วไป', '', 'nuttapong.s@cmu.ac.th', '', '', '0', null, 'nuttapong.s@cmu.ac.th', null, 'นาย', 'นัทธพงศ์', 'เสนรังษี', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('269', '', '', 'วนิตย์', 'เลิศตระกูล', '0', 'รองศาสตราจารย์', '', 'wanit.lerttrakul@cmu.ac.th', '', '', '0', null, 'wanit.lerttrakul@cmu.ac.th', null, 'นาย', 'วนิตย์', 'เลิศตระกูล', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('270', '', '', 'บุญแวว', 'มหาวัน', '0', 'พนักงานบริการทั่วไป', '', 'bunwaeo.m@cmu.ac.th', '', '', '0', null, 'bunwaeo.m@cmu.ac.th', null, 'นาง', 'บุญแวว', 'มหาวัน', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('271', '', '', 'จักรกฤช', 'กุนนา', '0', 'พนักงานบริการทั่วไป', '', 'jakkrit.kunna@cmu.ac.th', '', '', '0', null, 'jakkrit.kunna@cmu.ac.th', null, 'นาย', 'จักรกฤช', 'กุนนา', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('272', '', '', 'นุกุล', 'บัวคำปัน', '0', 'พนักงานช่าง', '', 'nukul.b@cmu.ac.th', '', '', '0', null, 'nukul.b@cmu.ac.th', null, 'นาย', 'นุกุล', 'บัวคำปัน', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('273', '', '', 'อรพิน', 'ประภาวิลัย', '0', 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานบริหารงานทั่วไป', 'orapin.pra@cmu.ac.th', '', '', '0', null, 'orapin.pra@cmu.ac.th', null, 'นาง', 'อรพิน', 'ประภาวิลัย', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('274', '', '', 'สมพร', 'พรมมินทร์', '0', 'พนักงานช่าง', '', 'somporn.pomin@cmu.ac.th', '', '', '0', null, 'somporn.pomin@cmu.ac.th', null, 'ว่าที่ร้อยตรี', 'สมพร', 'พรมมินทร์', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('275', '', '', 'วิชิตา', 'ท้าวหน่อ', '0', 'วิศวกร', '', 'wichita.t@cmu.ac.th', '', '', '0', null, 'wichita.t@cmu.ac.th', null, 'นางสาว', 'วิชิตา', 'ท้าวหน่อ', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('276', '', '', 'อนุรักษ์', 'แก้วบุญเรือง', '0', 'พนักงานบริการฝีมือ (ด้านเทคนิคและเครื่องยนต์)', '', 'aussatakorn.keaw@cmu.ac.th', '', '', '0', null, 'aussatakorn.keaw@cmu.ac.th', null, 'นาย', 'อนุรักษ์', 'แก้วบุญเรือง', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('277', '', '', 'วันเพ็ญ', 'แซ่หลู่', '0', 'พนักงานบริการทั่วไป', '', 'wanpen.saelu@cmu.ac.th', '', '', '0', null, 'wanpen.saelu@cmu.ac.th', null, 'นางสาว', 'วันเพ็ญ', 'แซ่หลู่', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('278', '', '', 'สดายุ', 'คำทอง', '0', 'นักจัดการงานทั่วไป', '', 'sadayu.k@cmu.ac.th', '', '', '0', null, 'sadayu.k@cmu.ac.th', null, 'นาง', 'สดายุ', 'คำทอง', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('279', '', '', 'ปิติรัตน์', 'นันทวาศ', '0', 'พนักงานบริการทั่วไป', '', 'pitirat.nan@cmu.ac.th', '', '', '0', null, 'pitirat.nan@cmu.ac.th', null, 'นาย', 'ปิติรัตน์', 'นันทวาศ', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('280', '', '', 'ศศิกานต์', 'กองค้า', '0', 'นักจัดการงานทั่วไป', '', 'sasikan.k@cmu.ac.th', '', '', '0', null, 'sasikan.k@cmu.ac.th', null, 'นางสาว', 'ศศิกานต์', 'กองค้า', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('281', '', '', 'ชานนท์', 'ทินหนุน', '0', 'พนักงานบริการฝีมือ (ด้านเทคนิคและเครื่องยนต์)', '', 'chanon.t@cmu.ac.th', '', '', '0', null, 'chanon.t@cmu.ac.th', null, 'นาย', 'ชานนท์', 'ทินหนุน', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('282', '', '', 'วรพงษ์', 'ดาวเลิศ', '0', 'พนักงานช่าง', '', 'worapong.d@cmu.ac.th', '', '', '0', null, 'worapong.d@cmu.ac.th', null, 'นาย', 'วรพงษ์', 'ดาวเลิศ', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('283', '', '', 'มณีรัตน์', 'เงินก่ำ', '0', 'นักจัดการงานทั่วไป', '', 'maneerat.n@cmu.ac.th', '', '', '0', null, 'maneerat.n@cmu.ac.th', null, 'นางสาว', 'มณีรัตน์', 'เงินก่ำ', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('284', '', '', 'ชนิกานต์', 'ใจนวล', '0', 'นักจัดการงานทั่วไป', '', 'chanikan.jai@cmu.ac.th', '', '', '0', null, 'chanikan.jai@cmu.ac.th', null, 'นางสาว', 'ชนิกานต์', 'ใจนวล', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('285', '', '', 'ปฏิภาณ', 'วงศ์เทพ', '0', 'พนักงานบริการทั่วไป', '', 'patipan.w@cmu.ac.th', '', '', '0', null, 'patipan.w@cmu.ac.th', null, 'นาย', 'ปฏิภาณ', 'วงศ์เทพ', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('286', '', '', 'สงกรานต์', 'สุวรรณคำ', '0', 'พนักงานบริการทั่วไป', '', 'songkran.s@cmu.ac.th', '', '', '0', null, 'songkran.s@cmu.ac.th', null, 'นาง', 'สงกรานต์', 'สุวรรณคำ', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('287', '', '', 'จักรกริช', 'กวงแหวน', '0', 'นักจัดการงานทั่วไป', '', 'jakkrit.ku@cmu.ac.th', '', '', '0', null, 'jakkrit.ku@cmu.ac.th', null, 'นาย', 'จักรกริช', 'กวงแหวน', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('288', '', '', 'รัชชานนท์', 'มงคลวัจน์', '0', 'วิศวกร', '', 'ratchanon.m@cmu.ac.th', '', '', '0', null, 'ratchanon.m@cmu.ac.th', null, 'นาย', 'รัชชานนท์', 'มงคลวัจน์', null, null, '0', '8', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('289', '', '', 'สินีนุช', 'พรหมมิจิตร', '0', 'นักการเงินและบัญชี', '', 'sineenuch.p@cmu.ac.th', '', '', '0', null, 'sineenuch.p@cmu.ac.th', null, 'นางสาว', 'สินีนุช', 'พรหมมิจิตร', null, null, '0', '13', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('290', '', '', 'ณัฐวรรณ', 'วรินทร์รักษ์', '0', 'นักการเงินและบัญชี', '', 'nattawan.v@cmu.ac.th', '', '', '0', null, 'nattawan.v@cmu.ac.th', null, 'นางสาว', 'ณัฐวรรณ', 'วรินทร์รักษ์', null, null, '0', '13', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('291', '', '', 'เชษฐ์ดนัย', 'พราหมณ์บุญมี', '0', 'พนักงานพัสดุ', '', 'chetdanai.p@cmu.ac.th', '', '', '0', null, 'chetdanai.p@cmu.ac.th', null, 'นาย', 'เชษฐ์ดนัย', 'พราหมณ์บุญมี', null, null, '0', '13', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('292', '', '', 'ปรียาภัทร', 'ปาคำ', '0', 'นักการเงินและบัญชี', '', 'preeyapat.p@cmu.ac.th', '', '', '0', null, 'preeyapat.p@cmu.ac.th', null, 'นางสาว', 'ปรียาภัทร', 'ปาคำ', null, null, '0', '13', '1', '1', '1', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('293', '', '', 'วสันต์', 'ฉายหิรัญ', '0', 'นักจัดการงานทั่วไป', '', 'wasan.ch@cmu.ac.th', '', '', '0', null, 'wasan.ch@cmu.ac.th', null, 'นาย', 'วสันต์', 'ฉายหิรัญ', null, null, '0', '13', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('294', '', '', 'สุทธิลักษณ์', 'จักร์ปั๋น', '0', 'นักจัดการงานทั่วไป', '', 'suttiluk.c@cmu.ac.th', '', '', '0', null, 'suttiluk.c@cmu.ac.th', null, 'นางสาว', 'สุทธิลักษณ์', 'จักร์ปั๋น', null, null, '0', '13', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('295', '', '', 'พชรพล', 'อินทกุล', '0', 'นักจัดการงานทั่วไป', '', 'phacharaphon.i@cmu.ac.th', '', '', '0', null, 'phacharaphon.i@cmu.ac.th', null, 'นาย', 'พชรพล', 'อินทกุล', null, null, '0', '13', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('296', '', '', 'นฤมล', 'กาวิละวงค์', '0', 'นักการเงินและบัญชี', '', 'naruemon.kawi@cmu.ac.th', '', '', '0', null, 'naruemon.kawi@cmu.ac.th', null, 'นางสาว', 'นฤมล', 'กาวิละวงค์', null, null, '0', '13', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('297', '', '', 'ยุพินพร', 'โนนจุ้ย', '0', 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานการเงินฯ', 'yuphinporn.nondjuy@cmu.ac.th', '', '', '0', null, 'yuphinporn.nondjuy@cmu.ac.th', null, 'นาง', 'ยุพินพร', 'โนนจุ้ย', null, null, '0', '13', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('298', '', '', 'สุวิมล', 'มะธุ', '0', 'นักการเงินและบัญชี', 'ผู้ช่วยหัวหน้างานการเงินฯ', 'suwimon.mathu@cmu.ac.th', '', '', '0', null, 'suwimon.mathu@cmu.ac.th', null, 'นางสาว', 'สุวิมล', 'มะธุ', null, null, '0', '13', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('299', '', '', 'วราลี', 'ช่างย้อม', '0', 'นักการเงินและบัญชี', 'หัวหน้างานการเงินฯ', 'waralee.c@cmu.ac.th', '', '', '0', null, 'waralee.c@cmu.ac.th', null, 'นาง', 'วราลี', 'ช่างย้อม', null, null, '0', '13', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('300', '', '', 'ภรณี', 'สรรพศรี', '0', 'นักจัดการงานทั่วไป', '', 'poranee.s@cmu.ac.th', '', '', '0', null, 'poranee.s@cmu.ac.th', null, 'นางสาว', 'ภรณี', 'สรรพศรี', null, null, '0', '13', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('301', '', '', 'ธัชพงศ์', 'เต็มป๊ก', '0', 'นักจัดการงานทั่วไป', '', 'tachchaphong.t@cmu.ac.th', '', '', '0', null, 'tachchaphong.t@cmu.ac.th', null, 'นาย', 'ธัชพงศ์', 'เต็มป๊ก', null, null, '0', '13', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('302', '', '', 'ยุพิณ', 'บัวคำปัน', '0', 'นักการเงินและบัญชี', '', 'yupin.b@cmu.ac.th', '', '', '0', null, 'yupin.b@cmu.ac.th', null, 'นางสาว', 'ยุพิณ', 'บัวคำปัน', null, null, '0', '13', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('303', '', '', 'ณิชนันทน์', 'กันชะนะ', '0', 'นักการเงินและบัญชี', '', 'nidchanun.kan@cmu.ac.th', '', '', '0', null, 'nidchanun.kan@cmu.ac.th', null, 'นางสาว', 'ณิชนันทน์', 'กันชะนะ', null, null, '0', '13', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('304', '', '', 'กันตินันท์', 'คำราพิช', '0', 'นักจัดการงานทั่วไป', '', 'kantinan.k@cmu.ac.th', '', '', '0', null, 'kantinan.k@cmu.ac.th', null, 'นางสาว', 'กันตินันท์', 'คำราพิช', null, null, '0', '13', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('305', '', '', 'ทิพวรรณ', 'บุญหล้า', '0', 'นักจัดการงานทั่วไป', '', 'tippawan.b@cmu.ac.th', '', '', '0', null, 'tippawan.b@cmu.ac.th', null, 'นางสาว', 'ทิพวรรณ', 'บุญหล้า', null, null, '0', '7', '1', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('306', '', '', 'ธัญนันท์', 'มาดี', '0', 'นักจัดการงานทั่วไป', '', 'tanyanan.m@cmu.ac.th', '', '', '0', null, 'tanyanan.m@cmu.ac.th', null, 'นางสาว', 'ธัญนันท์', 'มาดี', null, null, '0', '7', '1', '0', '0', '0', '0', '2', '1', null);
INSERT INTO `tbl_members` VALUES ('307', '', '', 'มฤฉัตร', 'เจริญทรัพย์', '0', 'นักจัดการงานทั่วไป', 'หัวหน้างานนโยบายและแผนฯ', 'maruechat.c@cmu.ac.th', '', '', '0', null, 'maruechat.c@cmu.ac.th', null, 'นาง', 'มฤฉัตร', 'เจริญทรัพย์', null, null, '0', '7', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('308', '', '', 'พิมลพร', 'อภิรมย์ชัยกุล', '0', 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานนโยบายและแผนฯ', 'pimonporn.m@cmu.ac.th', '', '', '0', null, 'pimonporn.m@cmu.ac.th', null, 'นางสาว', 'พิมลพร', 'อภิรมย์ชัยกุล', null, null, '0', '7', '0', '0', '1', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('309', '', '', 'ชลธิชา', 'แก้วบุญเรือง', '0', 'นักจัดการงานทั่วไป', '', 'chonthicha.kaew@cmu.ac.th', '', '', '0', null, 'chonthicha.kaew@cmu.ac.th', null, 'นางสาว', 'ชลธิชา', 'แก้วบุญเรือง', null, null, '0', '7', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('310', '', '', 'สุทัศน์', 'ขันเลข', '0', 'นักวิชาการศึกษา', 'หัวหน้างานบริการการศึกษา', 'sutat.k@cmu.ac.th', '', '', '0', null, 'sutat.k@cmu.ac.th', null, 'นาย', 'สุทัศน์', 'ขันเลข', null, null, '0', '2', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('311', '', '', 'ภิญญาพัชญ์', 'ยุตบุตร', '0', 'นักจัดการงานทั่วไป', '', 'apisada.y@cmu.ac.th', '', '', '0', null, 'apisada.y@cmu.ac.th', null, 'นางสาว', 'ภิญญาพัชญ์', 'ยุตบุตร', null, null, '0', '2', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('312', '', '', 'กาญจนา', 'นะพรานบุญ', '0', 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานริการการศึกษา', 'kanchana.na@cmu.ac.th', '', '', '0', null, 'kanchana.na@cmu.ac.th', null, 'นาง', 'กาญจนา', 'นะพรานบุญ', null, null, '0', '2', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('313', '', '', 'ณัฐอารี', 'ตุ่นจาอ้าย', '0', 'นักจัดการงานทั่วไป', '', 'somtawin.t@cmu.ac.th', '', '', '0', null, 'somtawin.t@cmu.ac.th', null, 'นางสาว', 'ณัฐอารี', 'ตุ่นจาอ้าย', null, null, '0', '2', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('314', '', '', 'สุภาพร', 'หลวงธิ', '0', 'นักจัดการงานทั่วไป', '', 'supaporn.luangthi@cmu.ac.th', '', '', '0', null, 'supaporn.luangthi@cmu.ac.th', null, 'นางสาว', 'สุภาพร', 'หลวงธิ', null, null, '0', '2', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('315', '', '', 'ณิชนันทน์', 'ปัญญาชลรักษ์', '0', 'นักจัดการงานทั่วไป', '', 'nitchanan.p@cmu.ac.th', '', '', '0', null, 'nitchanan.p@cmu.ac.th', null, 'นางสาว', 'ณิชนันทน์', 'ปัญญาชลรักษ์', null, null, '0', '2', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('316', '', '', 'รพีภัทร', 'รินดวงดี', '0', 'บรรณารักษ์', '', 'raphiphat.r@cmu.ac.th', '', '', '0', null, 'raphiphat.r@cmu.ac.th', null, 'นางสาว', 'รพีภัทร', 'รินดวงดี', null, null, '0', '2', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('317', '', '', 'ไพลิน', 'สิงห์เปา', '0', 'เจ้าหน้าที่สำนักงาน', '', 'pailin.s@cmu.ac.th', '', '', '0', null, 'pailin.s@cmu.ac.th', null, 'นางสาว', 'ไพลิน', 'สิงห์เปา', null, null, '0', '2', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('318', '', '', 'ธัญชนก', 'มายาง', '0', 'นักจัดการงานทั่วไป', '', 'tanchanok.mayang@cmu.ac.th', '', '', '0', null, 'tanchanok.mayang@cmu.ac.th', null, 'นาง', 'ธัญชนก', 'มายาง', null, null, '0', '2', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('319', '', '', 'รัชพล', 'เครือทอง', '0', 'นักจัดการงานทั่วไป', '', 'ratchapol.k@cmu.ac.th', '', '', '0', null, 'ratchapol.k@cmu.ac.th', null, 'นาย', 'รัชพล', 'เครือทอง', null, null, '0', '2', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('320', '', '', 'กิตติศักดิ์', 'ตุ่นกันทา', '0', 'นักจัดการงานทั่วไป', '', 'kittisak.t@cmu.ac.th', '', '', '0', null, 'kittisak.t@cmu.ac.th', null, 'นาย', 'กิตติศักดิ์', 'ตุ่นกันทา', null, null, '0', '2', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('321', '', '', 'ทัศพร', 'จันทนานุวัฒน์กุล', '0', 'นักจัดการงานทั่วไป', '', 'tassaporn.c@cmu.ac.th', '', '', '0', null, 'tassaporn.c@cmu.ac.th', null, 'นางสาว', 'ทัศพร', 'จันทนานุวัฒน์กุล', null, null, '0', '2', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('322', '', '', 'อลงกต', 'เทพคำอ้าย', '0', 'นักจัดการงานทั่วไป', '', 'alongkoat.thep@cmu.ac.th', '', '', '0', null, 'alongkoat.thep@cmu.ac.th', null, 'นาย', 'อลงกต', 'เทพคำอ้าย', null, null, '0', '6', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('323', '', '', 'ณัฐพร', 'ใจพุทธ', '0', 'นักจัดการงานทั่วไป', 'หัวหน้างานบริหารงานวิจัยฯ', 'nattaporn.j@cmu.ac.th', '', '', '0', null, 'nattaporn.j@cmu.ac.th', null, 'นางสาว', 'ณัฐพร', 'ใจพุทธ', null, null, '0', '6', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('324', '', '', 'กิตติภพ', 'พรหมเผ่า', '0', 'วิศวกร', '', 'kittiphop.pr@cmu.ac.th', '', '', '0', null, 'kittiphop.pr@cmu.ac.th', null, 'นาย', 'กิตติภพ', 'พรหมเผ่า', null, null, '0', '6', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('325', '', '', 'วรธิดา', 'อุดมสม', '0', 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานงานวิจัยฯ', 'waratida.u@cmu.ac.th', '', '', '0', null, 'waratida.u@cmu.ac.th', null, 'นางสาว', 'วรธิดา', 'อุดมสม', null, null, '0', '6', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('326', '', '', 'มนตรี', 'มาแสน', '0', 'วิศวกร', '', 'moltri.marsaen@cmu.ac.th', '', '', '0', null, 'moltri.marsaen@cmu.ac.th', null, 'นาย', 'มนตรี', 'มาแสน', null, null, '0', '6', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('327', '', '', 'ศศิณา', 'สิทธิชมภู', '0', 'นักจัดการงานทั่วไป', '', 'sasinar.s@cmu.ac.th', '', '', '0', null, 'sasinar.s@cmu.ac.th', null, 'นางสาว', 'ศศิณา', 'สิทธิชมภู', null, null, '0', '6', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('328', '', '', 'ทรงศักดิ์', 'ขลังวิชา', '0', 'นักจัดการงานทั่วไป', '', 'songsak.k@cmu.ac.th', '', '', '0', null, 'songsak.k@cmu.ac.th', null, 'นาย', 'ทรงศักดิ์', 'ขลังวิชา', null, null, '0', '6', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('329', '', '', 'อริศรา', 'กัลยาณวุฒิ', '0', 'นักจัดการงานทั่วไป', '', 'arisara.ka@cmu.ac.th', '', '', '0', null, 'arisara.ka@cmu.ac.th', null, 'นางสาว', 'อริศรา', 'กัลยาณวุฒิ', null, null, '0', '6', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('330', '', '', 'สุกัญญา', 'พิบูลย์', '0', 'นักจัดการงานทั่วไป', 'หัวหน้างานพัฒนาคุณภาพฯ', 'sukanya.pi@cmu.ac.th', '', '', '0', null, 'sukanya.pi@cmu.ac.th', null, 'นาง', 'สุกัญญา', 'พิบูลย์', null, null, '0', '28', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('331', '', '', 'เนตรนภา', 'สาระแปง', '0', 'นักจัดการงานทั่วไป', '', 'natnapa.s@cmu.ac.th', '', '', '0', null, 'natnapa.s@cmu.ac.th', null, 'นางสาว', 'เนตรนภา', 'สาระแปง', null, null, '0', '28', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('332', '', '', 'ชนากานต์', 'ปันต๊ะถา', '0', 'นักจัดการงานทั่วไป', '', 'chanakan.pa@cmu.ac.th', '', '', '0', null, 'chanakan.pa@cmu.ac.th', null, 'นางสาว', 'ชนากานต์', 'ปันต๊ะถา', null, null, '0', '28', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('333', '', '', 'นัฏพันธุ์', 'นันทวาศ', '0', 'นักจัดการงานทั่วไป', 'หัวหน้างานพัฒนาเทคโนฯ', 'nattapan.n@cmu.ac.th', '', '', '0', null, 'nattapan.n@cmu.ac.th', null, 'นาย', 'นัฏพันธุ์', 'นันทวาศ', null, null, '0', '29', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('334', '', '', 'อัครเดช', 'ประกอบของ', '0', 'นักจัดการงานทั่วไป', '', 'akaradate.p@cmu.ac.th', '', '', '0', null, 'akaradate.p@cmu.ac.th', null, 'นาย', 'อัครเดช', 'ประกอบของ', null, null, '0', '29', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('335', '', '', 'วินัย', 'คำสุรินทร์', '0', 'นักวิชาการคอมพิวเตอร์', '', 'winai.k@cmu.ac.th', '', '', '0', null, 'winai.k@cmu.ac.th', null, 'นาย', 'วินัย', 'คำสุรินทร์', null, null, '0', '29', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('336', '', '', 'นิวัฒน์', 'เจริญรัตนเดชะกูล', '0', 'นักวิชาการคอมพิวเตอร์', '', 'niwat.j@cmu.ac.th', '', '', '0', null, 'niwat.j@cmu.ac.th', null, 'นาย', 'นิวัฒน์', 'เจริญรัตนเดชะกูล', null, null, '0', '29', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('337', '', '', 'ปัฐมกานต์', 'ระเบ็ง', '0', 'นักจัดการงานทั่วไป', '', 'patthamakarn.r@cmu.ac.th', '', '', '0', null, 'patthamakarn.r@cmu.ac.th', null, 'นาง', 'ปัฐมกานต์', 'ระเบ็ง', null, null, '0', '29', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('338', '', '', 'สิทธิพงษ์', 'บุญเพ็ชร', '0', 'นักจัดการงานทั่วไป', '', 'sittipong.b@cmu.ac.th', '', '', '0', null, 'sittipong.b@cmu.ac.th', null, 'นาย', 'สิทธิพงษ์', 'บุญเพ็ชร', null, null, '0', '29', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('339', '', '', 'สุทธิพงค์', 'ริโปนยอง', '0', 'นักวิชาการคอมพิวเตอร์', '', 'suttipong.r@cmu.ac.th', '', '', '0', null, 'suttipong.r@cmu.ac.th', null, 'นาย', 'สุทธิพงค์', 'ริโปนยอง', null, null, '0', '29', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('340', '', '', 'เฉลิมพร', 'กุรานา', '0', 'นักจัดการงานทั่วไป', '', 'chalermporn.gurana@cmu.ac.th', '', '', '0', null, 'chalermporn.gurana@cmu.ac.th', null, 'นาง', 'เฉลิมพร', 'กุรานา', null, null, '0', '32', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('341', '', '', 'ณัฐวีณ์', 'ไชยริศรี', '0', 'นักจัดการงานทั่วไป', '', 'nattavee.ch@cmu.ac.th', '', '', '0', null, 'nattavee.ch@cmu.ac.th', null, 'นางสาว', 'ณัฐวีณ์', 'ไชยริศรี', null, null, '0', '32', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('342', '', '', 'สารัช', 'ศรีบูรณ์', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'sarach.sri@cmu.ac.th', '', '', '0', null, 'sarach.sri@cmu.ac.th', null, 'นาย', 'สารัช', 'ศรีบูรณ์', null, null, '0', '32', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('343', '', '', 'ธัญมล', 'วรรณละเอียด', '0', 'นักจัดการงานทั่วไป', '', 'tunyamon.wa@cmu.ac.th', '', '', '0', null, 'tunyamon.wa@cmu.ac.th', null, 'นางสาว', 'ธัญมล', 'วรรณละเอียด', null, null, '0', '32', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('344', '', '', 'อรกัญญา', 'พุทธวงค์', '0', 'นักจัดการงานทั่วไป', '', 'aurakanya.p@cmu.ac.th', '', '', '0', null, 'aurakanya.p@cmu.ac.th', null, 'นางสาว', 'อรกัญญา', 'พุทธวงค์', null, null, '0', '32', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('345', '', '', 'ธนาวุฒิ', 'ธีรเกียรติกุล', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'thanawut.th@cmu.ac.th', '', '', '0', null, 'thanawut.th@cmu.ac.th', null, 'นาย', 'ธนาวุฒิ', 'ธีรเกียรติกุล', null, null, '0', '32', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('346', '', '', 'บัญชา', 'สุวรรณพิทักษ์', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'bancha.s@cmu.ac.th', '', '', '0', null, 'bancha.s@cmu.ac.th', null, 'นาย', 'บัญชา', 'สุวรรณพิทักษ์', null, null, '0', '32', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('347', '', '', 'กรทิพย์', 'ชัยยานนท์', '0', 'นักจัดการงานทั่วไป', '', 'kornthip.c@cmu.ac.th', '', '', '0', null, 'kornthip.c@cmu.ac.th', null, 'นางสาว', 'กรทิพย์', 'ชัยยานนท์', null, null, '0', '31', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('348', '', '', 'ณัฏฐนันท์', 'พันธุ์บุญปลูก', '0', 'นักจัดการงานทั่วไป', '', 'nuttasri.senaluang@cmu.ac.th', '', '', '0', null, 'nuttasri.senaluang@cmu.ac.th', null, 'นางสาว', 'ณัฏฐนันท์', 'พันธุ์บุญปลูก', null, null, '0', '31', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('349', '', '', 'ธีร์นภัส', 'ปรากฏมาก', '0', 'นักจัดการงานทั่วไป', '', 'teenaphat.p@cmu.ac.th', '', '', '0', null, 'teenaphat.p@cmu.ac.th', null, 'นาย', 'ธีร์นภัส', 'ปรากฏมาก', null, null, '0', '31', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('350', '', '', 'ปาลิตา', 'อุ่นแก้ว', '0', 'นักจัดการงานทั่วไป', '', 'palita.aun@cmu.ac.th', '', '', '0', null, 'palita.aun@cmu.ac.th', null, 'นางสาว', 'ปาลิตา', 'อุ่นแก้ว', null, null, '0', '31', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('351', '', '', 'จิราธร', 'วรรณสุยะ', '0', 'นักจัดการงานทั่วไป', '', 'jirathorn.w@cmu.ac.th', '', '', '0', null, 'jirathorn.w@cmu.ac.th', null, 'นางสาว', 'จิราธร', 'วรรณสุยะ', null, null, '0', '27', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('352', '', '', 'อนุชา', 'ปินทรายมูล', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'anucha.pinsaimoon@cmu.ac.th', '', '', '0', null, 'anucha.pinsaimoon@cmu.ac.th', null, 'นาย', 'อนุชา', 'ปินทรายมูล', null, null, '0', '27', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('353', '', '', 'จิรชาติ', 'ใคร้มา', '0', 'พนักงานปฏิบัติงานช่วยสอน', '', 'jerachard.k@cmu.ac.th', '', '', '0', null, 'jerachard.k@cmu.ac.th', null, 'นาย', 'จิรชาติ', 'ใคร้มา', null, null, '0', '27', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('354', '', '', 'พัชริดา', 'อินทรีย์', '0', 'นักจัดการงานทั่วไป', '', 'patcharida.insee@cmu.ac.th', '', '', '0', null, 'patcharida.insee@cmu.ac.th', null, 'นางสาว', 'พัชริดา', 'อินทรีย์', null, null, '0', '27', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('355', '', '', 'เบญราวาห์', 'เรือนทิพย์', '0', 'นักจัดการงานทั่วไป', '', 'benrava.r@cmu.ac.th', '', '', '0', null, 'benrava.r@cmu.ac.th', null, 'นางสาว', 'เบญราวาห์', 'เรือนทิพย์', null, null, '0', '27', '0', '0', '0', '0', '0', '2', '0', null);
INSERT INTO `tbl_members` VALUES ('356', '', '', 'นิชนันท์', 'ประไพตระกูล', '0', 'นักจัดการงานทั่วไป', '', 'nitchanan.pr@cmu.ac.th', '', '', '0', null, 'nitchanan.pr@cmu.ac.th', null, 'นางสาว', 'นิชนันท์', 'ประไพตระกูล', null, null, '0', '27', '0', '0', '0', '0', '0', '2', '0', null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `isDean` tinyint(1) NOT NULL DEFAULT 0,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `cmuitaccount_name` varchar(255) DEFAULT NULL,
  `prename_TH` varchar(255) DEFAULT NULL,
  `firstname_TH` varchar(255) NOT NULL DEFAULT '',
  `lastname_TH` varchar(255) DEFAULT NULL,
  `itaccounttype_id` varchar(10) NOT NULL DEFAULT '0',
  `itaccounttype_TH` varchar(255) DEFAULT NULL,
  `positionName` varchar(255) DEFAULT NULL,
  `positionName2` varchar(255) DEFAULT NULL,
  `dep_id` int(11) DEFAULT 0,
  `last_activity` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `typeposition_id` tinyint(1) DEFAULT 0,
  `lineToken` varchar(255) DEFAULT NULL,
  `is_step_secretary` tinyint(1) DEFAULT 0,
  `is_step_dean` tinyint(1) DEFAULT NULL,
  `is_step_eng` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=359 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', null, 'suttipong.r@cmu.ac.th', null, 'b986700c627db479a4d9460b75de7222', '1', '1', null, null, '2024-07-31 05:56:00', 'suttipong.r', 'นาย', 'สุทธิพงค์', 'ริโปนยอง', 'MISEmpAcc', 'บุคลากร', null, null, '0', '2024-07-31 05:56:00', '0', 'mMb96Ki0GrXKg21z4XARen0Hf32PL3imHuvOsxRFKCX', '0', null, null);
INSERT INTO `users` VALUES ('3', null, 'autanan.w@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อัฐนันต์', 'วรรณชัย', '', '', 'อาจารย์ ดร.', '', '35', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('4', null, 'norrapon.v@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นรพนธ์', 'วิเชียรสาร', '', '', 'อาจารย์ ดร.', '', '35', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('5', null, 'kittiya.thunsiri@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'กิตติยา', 'ทุ่นศิริ', '', '', 'อาจารย์ ดร.', '', '35', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('6', null, 'wichai.chattinnawat@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วิชัย', 'ฉัตรทินวัฒน์', '', '', 'รองศาสตราจารย์', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('7', null, 'akkapoj.w@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อรรฆพจน์', 'วงศ์พึ่งไชย', '', '', 'อาจารย์', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('8', null, 'narong.petcharee@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ณรงค์', 'เพชรชารี', '', '', 'อาจารย์', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('9', null, 'takron.op@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ฐากร', 'โอภาสสุวรรณ', '', '', 'อาจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('10', null, 'phavika.m@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ภวิกา', 'มงคลกิจทวีผล', '', '', 'อาจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('11', null, 'poti.chao@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'โพธิ', 'จ้าวไพศาล', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('12', null, 'tinnakorn.phongthiya@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ทินกร', 'ปงธิยา', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('13', null, 'nivit.c@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นิวิท', 'เจริญใจ', '', '', 'รองศาสตราจารย์', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('14', null, 'pongsawat.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'พงษ์สวัสดิ์', 'เปรมเพ็ชร', '', '', 'อาจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('15', null, 'salinee.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'สาลินี', 'สันติธีรากุล', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('16', null, 'apichat.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อภิชาต', 'โสภาแดง', '', '', 'รองศาสตราจารย์', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('17', null, 'choncharoen.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ชนม์เจริญ', 'แสวงรัตน์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('18', null, 'nirand.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นิรันดร์', 'พิสุทธอานนท์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('19', null, 'uttapol.s@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'อรรถพล', 'สมุทคุปติ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('20', null, 'wimalin.l@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'วิมลิน สุขถมยา', 'เหล่าศิริถาวร', '', '', 'รองศาสตราจารย์', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('21', null, 'anirut.c@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อนิรุท', 'ไชยจารุวณิช', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('22', null, 'rattapol.pinn@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'รัฐพล', 'ปิ่นนราทิพย์', '', '', 'อาจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('23', null, 'wassanai.w@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'วัสสนัย', 'วรรธนัจฉริยา', '', '', 'รองศาสตราจารย์', 'ผู้ช่วยคณบดี', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('24', null, 'wasawat.n@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'วสวัชร', 'นาคเขียว', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมอุตสาหการ', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('25', null, 'adirek.b@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อดิเรก', 'ใบสุขันธ์', '', '', 'อาจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('26', null, 'warisa.w@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'วริษา', 'นาคเขียว', '', '', 'รองศาสตราจารย์', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('27', null, 'chompoonoot.kasemset@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ชมพูนุท', 'เกษมเศรษฐ์', '', '', 'รองศาสตราจารย์', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('28', null, 'rungchat.chompu@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'รุ่งฉัตร', 'ชมภูอินไหว', '', '', 'รองศาสตราจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('29', null, 'worapod.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วรพจน์', 'เสรีรัฐ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('30', null, 'korrakot.t@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาง', 'กรกฎ ใยบัวเทศ', 'ทิพยาวงศ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('31', null, 'wapee.m@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'วาปี', 'มโนภินิเวศ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('32', null, 'sakgasem.ramingwong@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ศักดิ์เกษม', 'ระมิงค์วงศ์', '', '', 'รองศาสตราจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('33', null, 'komgrit.lek@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'คมกฤต', 'เล็กสกุล', '', '', 'รองศาสตราจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('34', null, 'sate.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'เศรษฐ์', 'สัมภัตตะกุล', '', '', 'รองศาสตราจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('35', null, 'alonggot.l@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'อลงกต ลิ้มเจริญ', 'แก้วโชติช่วงกูล', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('36', null, 'tanyanuparb.a@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ธัญญานุภาพ', 'อานันทนะ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('37', null, 'chawis.boonmee@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ชวิศ', 'บุญมี', '', '', 'รองศาสตราจารย์ ดร.', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('38', null, 'prim.fong@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'พริม', 'ฟองสมุทร', '', '', 'อาจารย์ผู้ช่วย', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('39', null, 'jenschwich.c@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'เจณชวิศ', 'เจริญใจ', '', '', 'อาจารย์ผู้ช่วย', '', '20', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('40', null, 'natthanan.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ณัฐนันท์', 'พรหมสุข', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('41', null, 'kampol.w@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'กำพล', 'วรดิษฐ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('42', null, 'lachana.ramingwong@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'ลัชนา', 'ระมิงค์วงศ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('43', null, 'yuthapong.somchit@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ยุทธพงษ์', 'สมจิต', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('44', null, 'narissara.e@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'นริศรา', 'เอี่ยมคณิตชาติ', '', '', 'รองศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('45', null, 'sansanee.a@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ศันสนีย์', 'เอื้อพันธ์วิริยะกุล', '', '', 'รองศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('46', null, 'sanpawat.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สรรพวรรธน์', 'กันตะบุตร', '', '', 'รองศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('47', null, 'nasi.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นษิ', 'ตันติธารานุกุล', '', '', 'อาจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('48', null, 'karn.patanukhom@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'กานต์', 'ปทานุคม', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('49', null, 'sasin.ja@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ศศิน', 'จันทร์พวงทอง', '', '', 'อาจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('50', null, 'patiwet.w@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ปฏิเวธ', 'วุฒิสารวัฒนา', '', '', 'รองศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('51', null, 'anya.a@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'อัญญา อาภาวัชรุตม์', 'วีรประพันธ์', '', '', 'รองศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('52', null, 'paskorn.c@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ภาสกร', 'แช่มประเสริฐ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('53', null, 'navadon.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นวดนย์', 'คุณเลิศกิจ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('54', null, 'chinawat.i@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ชินวัตร', 'อิศราดิสัยกุล', '', '', 'อาจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('55', null, 'kanok.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'กนก', 'ก๋องหล้า', '', '', 'อาจารย์', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('56', null, 'kasemsit.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'เกษมสิทธิ์', 'ตียพันธ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('57', null, 'trasapong.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ตรัสพงศ์', 'ไทยอุปถัมภ์', '', '', 'รองศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('58', null, 'arnan.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อานันท์', 'สีห์พิทักษ์เกียรติ', '', '', 'อาจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('59', null, 'thanatip.ch@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ธนาทิพย์', 'จันทร์คง', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('60', null, 'pruet.b@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'พฤษภ์', 'บุญมา', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('61', null, 'sakgasit.ramingwong@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ศักดิ์กษิต', 'ระมิงค์วงศ์', '', '', 'รองศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('62', null, 'juggapong.n@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'จักรพงศ์', 'นาทวิชัย', '', '', 'รองศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('63', null, 'kenneth.c@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'Kenneth  John', 'Cosh', '', '', 'รองศาสตราจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('64', null, 'dome.potikanond@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'โดม', 'โพธิกานนท์', '', '', 'ผู้ช่วยศาสตราจารย์', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('65', null, 'santi.p@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'สันติ', 'พิทักษ์กิจนุกูร', '', '', 'รองศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมคอมพิวเตอร์', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('66', null, ' jenjira.j@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'เจนจิรา ', 'ใจมั่ง  ', '', '', 'อาจารย์ ดร.', '', '14', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('67', null, 'wongkot.w@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วงกต', 'วงศ์อภัย', '', '', 'รองศาสตราจารย์', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('68', null, 'kajorndej.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ขจรเดช', 'พิมพ์พิไล', '', '', 'อาจารย์', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('69', null, 'mana.saedan@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'มานะ', 'แซ่ด่าน', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('70', null, 'yottana.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ยศธนา', 'คุณาทร', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('71', null, 'aree.a@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'อารีย์', 'อัจฉริยวิริยะ', '', '', 'รองศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('72', null, 'somchai.pattana@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สมชาย', 'พัฒนา', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('73', null, 'det.d@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'เดช', 'ดำรงศักดิ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('74', null, 'itthichai.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อิทธิชัย', 'ปรีชาวุฒิพงศ์', '', '', 'รองศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('75', null, 'wetchayan.rangsri@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'เวชยันต์', 'รางศรี', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('76', null, 'kodkwan.nam@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'กอดขวัญ', 'นามสงวน', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('77', null, 'watcharapong.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วัชรพงษ์', 'ธัชยพงษ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('78', null, 'anusan.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อนุศาล', 'เพิ่มสุวรรณ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('79', null, 'siva.a@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ศิวะ', 'อัจฉริยวิริยะ', '', '', 'รองศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('80', null, 'chatchawan.c@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'ชัชวาลย์', 'ชัยชนะ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('81', null, 'nat.v@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ณัฐ', 'วรยศ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('82', null, 'natawut.neamsorn@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ณัฐวุฒิ', 'เนียมสอน', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('83', null, 'thoranis.dee@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ธรณิศวร์', 'ดีทายาท', '', '', 'รองศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('84', null, 'faifan.tantakitti@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ใฝ่ฝัน', 'ตัณฑกิตติ', '', '', 'อาจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('85', null, 'radom.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ระดม', 'พงษ์วุฒิธรรม', '', '', 'ศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('86', null, 'kanya.r@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'กัญญา', 'รัตนะมงคลกุล', '', '', 'อาจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('87', null, 'anucha.prom@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อนุชา', 'พรมวังขวา', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('88', null, 'napassawan.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'นภัสวรรณ', 'วงษ์มงคล', '', '', 'อาจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('89', null, 'nattawit.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ณัฐวิทย์', 'พรหมมา', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('90', null, 'pinyo.puangmali@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'ภิญโญ', 'พวงมะลิ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมเครื่องกล', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('91', null, 'nakorn.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นคร', 'ทิพยาวงศ์', '', '', 'ศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('92', null, 'pawarut.j@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'ปวรุตม์', 'จงชาญสิทโธ', '', '', 'รองศาสตราจารย์ ดร.', 'รองคณบดี', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('93', null, 'kengkamon.w@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'เก่งกมล', 'วิรัตน์เกษม', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('94', null, 'konlayutt.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'กลยุทธ', 'ปัญญาวุธโธ', '', '', 'รองศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('95', null, 'chakkapong.ch@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'จักรพงษ์', 'จำรูญ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('96', null, 'thongchai.f@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'ธงชัย', 'ฟองสมุทร', '', '', 'รองศาสตราจารย์ ดร.', 'คณบดี', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('97', null, 'ramnarong.wanison@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'รามณรงค์', 'วณีสอน', '', '', 'อาจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('98', null, 'matthew.o@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'Matthew', 'Owen Thomas Cole', '', '', 'ศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('99', null, 'patrapon.k@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาง', 'ภัทราพร', 'กมลเพ็ชร', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('100', null, 'chaiy.rungsiyakull@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ชาย', 'รังสิยากูล', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('101', null, 'phrut.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'พฤทธ์', 'สกุลช่างสัจจะทัย', '', '', 'รองศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('102', null, 'attakorn.asana@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อรรถกร', 'อาสนคำ', '', '', 'รองศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('103', null, 'theeraphong.wong@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ธีระพงษ์', 'ว่องรัตนะไพศาล', '', '', 'รองศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('104', null, 'watchapon.roj@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วัชพล', 'โรจนรัตนางกูร', '', '', 'รองศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('105', null, 'niti.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นิติ', 'คำเมืองลือ', '', '', 'รองศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('106', null, 'viboon.c@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วิบูลย์', 'ช่างเรือ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('107', null, 'james.moran@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'James', 'C. Moran', '', '', 'รองศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('108', null, 'damorn.b@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ดามร', 'บัณฑุรัตน์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('109', null, 'woradej.manosroi@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วรเดช', 'มโนสร้อย', '', '', 'รองศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('110', null, 'pana.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'พนา', 'สุทธกูล', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('111', null, 'yuttana.mona@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ยุทธนา', 'โมนะ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('112', null, 'pradit.terdtoon@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ประดิษฐ์', 'เทอดทูล', '', '', 'ศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('113', null, 'pruk.a@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'พฤกษ์', 'อักกะรังสี', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('114', null, 'krit.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'กฤต', 'สุจริตธรรม', '', '', 'อาจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('115', null, 'nattanee.v@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ณัฐนี', 'วรยศ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('116', null, 'arpiruk.hok@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อาภิรักษ์', 'หกพันนา', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '15', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('117', null, 'perapon.a@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'พีรพนธ์', 'อนุสารสุนทร', '', '', 'อาจารย์', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('118', null, 'peerapol.j@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'พีรพล', 'จิราพงศ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมไฟฟ้า', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('119', null, 'thanaphong.thanasak@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ธนะพงษ์', 'ธนะศักดิ์ศิริ', '', '', 'รองศาสตราจารย์', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('120', null, 'nipon.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นิพนธ์', 'ธีรอำพน', '', '', 'ศาสตราจารย์ ดร.', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('121', null, 'kasin.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'กสิณ', 'ประกอบไวทยกิจ', '', '', 'ผู้ช่วยศาสตราจารย์', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('122', null, 'tharadol.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ธราดล', 'โกมลมิศร์', '', '', 'ผู้ช่วยศาสตราจารย์', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('123', null, 'sermsak.uatrongjit@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'เสริมศักดิ์', 'เอื้อตรงจิตต์', '', '', 'รองศาสตราจารย์ ดร.', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('124', null, 'boonsri.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'บุญศรี', 'แก้วคำอ้าย', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('125', null, 'somboon.nuchprayoon@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สมบูรณ์', 'นุชประยูร', '', '', 'รองศาสตราจารย์ ดร.', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('126', null, 'doldet.tantraviwat@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ดลเดช', 'ตันตระวิวัฒน์', '', '', 'รองศาสตราจารย์ ดร.', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('127', null, 'suttichai.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สุทธิชัย', 'เปรมฤดีปรีชาชาญ', '', '', 'รองศาสตราจารย์ ดร.', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('128', null, 'kasemsak.u@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'เกษมศักดิ์', 'อุทัยชนะ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('129', null, 'ukrit.m@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'อุกฤษฏ์', 'มั่นคง', '', '', 'รองศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('130', null, 'witsarut.a@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วิศรุต', 'อัจฉริยวิริยะ', '', '', 'อาจารย์ ดร.', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('131', null, 'sirote.khunkitti@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สิโรตม์', 'คุณกิตติ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('132', null, 'panida.th@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ปณิดา', 'ธารารักษ์', '', '', 'อาจารย์ ดร.', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('133', null, 'yuttana.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ยุทธนา', 'ขำสุวรรณ์', '', '', 'ศาสตราจารย์ ดร.', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('134', null, 'watcharin.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วัชริน', 'ศรีรัตนาวิชัยกุล', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('135', null, 'nutapong.somjit@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ณัตพงศ์', 'สมจิตร', '', '', 'อาจารย์ ดร.', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('136', null, 'paramet.w@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ปารเมศ', 'วิระสันติ', '', '', 'รองศาสตราจารย์ ดร.', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('137', null, 'soraphon.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สรพล', 'กิจศิริสิน', '', '', 'อาจารย์ ดร.', '', '16', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('138', null, 'cheowchan.l@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'เชี่ยวชาญ', 'ลีลาสุขเสรี', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมเหมืองแร่', '19', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('139', null, 'suttithep.r@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สุทธิเทพ', 'รมยเวศม์', '', '', 'ผู้ช่วยศาสตราจารย์', '', '19', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('140', null, 'suparit.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สุพฤทธิ์', 'ตั้งพฤทธิ์กุล', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '19', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('141', null, 'teerapat.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ธีรภัทร์', 'ต่อสวย', '', '', 'อาจารย์', '', '19', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('142', null, 'tadsuda.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ทัศษุดา', 'ทักษะวสุ', '', '', 'อาจารย์ ดร.', '', '19', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('143', null, 'komsoon.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'คมสูรย์', 'สมประสงค์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '19', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('144', null, 'chanapol.c@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ชนะพล', 'เจริญธนาวรกุล', '', '', 'อาจารย์ ดร.', '', '19', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('145', null, 'puttipol.d@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'พุทธิพล', 'ดำรงชัย', '', '', 'รองศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('146', null, 'paisan.jourtong@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ไพศาล', 'จั่วทอง', '', '', 'อาจารย์', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('147', null, 'poon.th@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ปุ่น', 'เที่ยงบูรณธรรม', '', '', 'รองศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('148', null, 'chayanon.h@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ชยานนท์', 'หรรษภิญโญ', '', '', 'รองศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('149', null, 'damrongsak.r@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ดำรงศักดิ์', 'รินชุมภู', '', '', 'รองศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('150', null, 'natee.suriyanon@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นที', 'สุริยานนท์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('151', null, 'suriyah.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สุริยะ', 'ทองมุณี', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('152', null, 'sethapong.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'เศรษฐพงศ์', 'เศรษฐบุปผา', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('153', null, 'tawatchai.t@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'ธวัชชัย', 'ตันชัยสวัสดิ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('154', null, 'bhuddarak.c@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'พุทธรักษ์', 'จรัสพันธุ์กุล', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('155', null, 'pheerawat.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'พีรวัฒน์', 'ปลาเงิน', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('156', null, 'warakorn.tan@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วรากร', 'ตันตระพงศธร', '', '', 'อาจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('157', null, 'peerapong.j@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'พีรพงศ์', 'จิตเสงี่ยม', '', '', 'รองศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('158', null, 'kriangkrai.a@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'เกรียงไกร', 'อรุโณทยานันท์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('159', null, 'pitiwat.w@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ปิติวัฒน์', 'วัฒนชัย', '', '', 'รองศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('160', null, 'chinapat.b@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ชินพัฒน์', 'บัวชาติ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('161', null, 'teewara.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ธีวรา', 'สุวรรณ', '', '', 'รองศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('162', null, 'chana.sinsabvarodom@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ชนะ', 'สินทรัพย์วโรดม', '', '', 'อาจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('163', null, 'thanaporn.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ธนพร', 'สุปริยศิลป์', '', '', 'รองศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('164', null, 'nopadon.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นพดล', 'กรประเสริฐ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('165', null, 'songyot.k@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'ทรงยศ', 'กิจธรรมเกษร', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('166', null, 'preda.p@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'ปรีดา', 'พิชยาพันธ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมโยธา', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('167', null, 'piyapong.wongmatar@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ปิยะพงษ์', 'วงค์เมธา', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('168', null, 'kittikun.j@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'กิตติคุณ', 'จิตไพโรจน์', '', '', 'อาจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('169', null, 'auttawit.u@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อรรถวิทย์', 'อุปโยคิน', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '17', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('170', null, 'pharkphum.r@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'ภาคภูมิ', 'รักร่วม', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', '18', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('171', null, 'pimluck.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'พิมพ์ลักษณ์', 'กิจจนะพานิช', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '18', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('172', null, 'patiroop.p@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาย', 'ปฏิรูป', 'ผลจันทร์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมสิ่งแวดล้อม', '18', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('173', null, 'sarunnoud.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'สรัลนุช', 'ภู่พิสิฐ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '18', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('174', null, 'napat.ja@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ณภัทร', 'จักรวัฒนา', '', '', 'รองศาสตราจารย์ ดร.', '', '18', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('175', null, 'sirichai.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สิริชัย', 'คุณภาพดีเลิศ', '', '', 'รองศาสตราจารย์ ดร.', '', '18', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('176', null, 'aunnop.w@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อรรณพ', 'วงศ์เรือง', '', '', 'รองศาสตราจารย์ ดร.', '', '18', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('177', null, 'puangrat.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'พวงรัตน์', 'แก้วล้อม', '', '', 'ศาสตราจารย์ ดร.', '', '18', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('178', null, 'saoharit.n@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'เสาหฤท', 'นิตยวรรธนะ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '18', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('179', null, 'sulak.sumit@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สุลักษณ์', 'สุมิตสวรรค์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '18', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('180', null, 'prattakorn.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ปรัตถกร', 'สิทธิสม', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', '18', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('181', null, 'rattapol.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'รัฐพล', 'พรประสิทธิ์', '', '', 'นักวิจัย', '', '6', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('182', null, 'chalinee.m@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ชาลิณี ', 'พิพัฒนพิภพ', '', '', 'อาจารย์ ดร.', '', '35', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('183', null, 'อยู่ระหว่างการจัดทำคำสั่งบรรจุ', null, '', '0', '0', null, null, null, 'นาย', 'คุณานนต์', 'จงชาญสิทโธ', '', '', 'อาจารย์ ดร.', '', '0', '1', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('184', null, 'phannee.sojit@cmu.ac.th', null, '', '1', '0', null, null, null, 'นาง', 'พรรณี', 'โศจิธรรมพร', '', '', 'นักจัดการงานทั่วไป', 'เลขานุการคณะ', '1', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('185', null, 'sonthaya.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สนธยา', 'สุขสามัคคี', '', '', 'พนักงานช่าง', '', '20', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('186', null, 'wuttinun.in@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วุฒินันท์', 'อินทยศ', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '20', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('187', null, 'chetniphat.samta@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'เจตนิพัทธ์', 'สามตา', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '20', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('188', null, 'ponpun.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'พรพรรณ', 'คำมั่น', '', '', 'นักจัดการงานทั่วไป', '', '20', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('189', null, 'narin.c@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นรินทร์', 'จักร์ปั๋น', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '20', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('190', null, 'nattawoot.rinno@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ณัฐวุฒิ', 'รินโน', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '20', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('191', null, 'wimutita.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'วิมุทิตา', 'ปัญโญใหญ่', '', '', 'นักจัดการงานทั่วไป', '', '20', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('192', null, 'thunyaluk.kiti@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ธัญญาลักษณ์', 'กิติวิริยะชัย', '', '', 'นักจัดการงานทั่วไป', '', '20', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('193', null, 'sakdinon.nantana@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ศักดินนท์', 'นันทนา', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '20', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('194', null, 'wutipong.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วุฒิพงศ์', 'คำวงค์', '', '', 'นักจัดการงานทั่วไป', '', '20', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('195', null, 'rattiyakorn.c@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'รัตติยากร', 'ชาตตนนท์', '', '', 'นักจัดการงานทั่วไป', '', '20', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('196', null, 'naiyana.y@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'นัยนา', 'ยะสิงห์สาร', '', '', 'นักจัดการงานทั่วไป', '', '20', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('197', null, 'pornsuda.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'พรสุดา', 'เสาร์สิงห์', '', '', 'นักจัดการงานทั่วไป', '', '20', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('198', null, 'wipawarn.m@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'วิภาวรรณ', 'พันดวง', '', '', 'นักจัดการงานทั่วไป', '', '14', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('199', null, 'pornpimol.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'พรพิมล', 'พรมมินทร์', '', '', 'นักจัดการงานทั่วไป', '', '14', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('200', null, 'sittichon.a@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สิทธิชน', 'อังคุตรานนท์', '', '', 'นักวิชาการคอมพิวเตอร์', '', '14', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('201', null, 'aphichat.r@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อภิชาติ', 'รอดเรือน', '', '', 'นักจัดการงานทั่วไป', '', '14', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('202', null, 'waraporn.tipsorn@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ธิดากร', 'สิริชลวรา', '', '', 'พนักงานบริการทั่วไป', '', '14', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('203', null, 'piangta.a@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'เพียงตา', 'อภิวงศ์', '', '', 'นักจัดการงานทั่วไป', '', '14', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('204', null, 'urapee.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'อุรพี', 'ธรรมโยธิน', '', '', 'นักจัดการงานทั่วไป', '', '14', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('205', null, 'nathaprom.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ณฐพรหม', 'ปัญจมา', '', '', 'ช่างอิเล็กทรอนิกส์', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('206', null, 'panutda.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ปนัดดา', 'ตุ้ยอุ่นเรือน', '', '', 'นักจัดการงานทั่วไป', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('207', null, 'morakot.apiwongngam@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'มรกต', 'อภิวงศ์งาม', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('208', null, 'aswin.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อัศวิน', 'ปศุศฤทธากร', '', '', 'วิศวกร', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('209', null, 'natapon.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ณฐพล', 'ทองสอน', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('210', null, 'nipawan.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'นิภาวรรณ์', 'คำวัง', '', '', 'นักจัดการงานทั่วไป', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('211', null, 'norrasaet.b@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นรเศรษฐ์', 'บานนิกุล', '', '', 'วิศวกร', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('212', null, 'apasara.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'อาภัสรา', 'คล้ายณรงค์', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('213', null, 'pusadee.ch@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ผุสดี', 'จันทร์เอี่ยม', '', '', 'นักจัดการงานทั่วไป', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('214', null, 'nattapong.g@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ณัฐพงศ์', 'กันธะเรียน', '', '', 'นักวิชาการคอมพิวเตอร์', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('215', null, 'kanjarna.pang@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'กาญจนา', 'แปงสุตา', '', '', 'นักจัดการงานทั่วไป', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('216', null, 'thawatchai.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ธวัชชัย', 'ธรรมขันแก้ว', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('217', null, 'waraluck.l@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'วราลักษณ์', 'เหล็กสมบูรณ์', '', '', 'นักจัดการงานทั่วไป', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('218', null, 'warangkana.sukch@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'วรางคณา', 'สุกชัยเจริญพร', '', '', 'นักจัดการงานทั่วไป', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('219', null, 'sukphawat.siri@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สุขภวัฒ', 'ศิริมูล', '', '', 'พนักงานบริการทั่วไป', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('220', null, 'watchara.chomesri@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วัชระ', 'โฉมศรี', '', '', 'พนักงานช่าง', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('221', null, 'narid.m@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นริศ', 'เมืองแก่น', '', '', 'พนักงานช่าง', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('222', null, 'visanu.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วิษณุ', 'ตันไพจิตร', '', '', 'พนักงานช่าง', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('223', null, 'watcharapong.somsri@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วัชรพงษ์', 'สมศรี', '', '', 'พนักงานช่าง', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('224', null, 'songklot.m@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ทรงกลด', 'มายาง', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('225', null, 'ananya.l@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'อนัญญา', 'ลัทธิกุล', '', '', 'นักจัดการงานทั่วไป', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('226', null, 'nopphadon.h@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นพดล', 'หวลสัตย์', '', '', 'พนักงานสถานที่', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('227', null, 'aitsaraporn.l@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'อิสราภรณ์', 'ลายเขียว', '', '', 'นักจัดการงานทั่วไป', '', '15', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('228', null, 'prasert.m@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ประเสริฐ', 'มาวิมล', '', '', 'วิศวกรไฟฟ้า', '', '16', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('229', null, 'prayoon.b@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ประยูร', 'บัวรินทร์', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '16', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('230', null, 'prayoonsak.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ประยูรศักดิ์', 'พรายจันทร์', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '16', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('231', null, 'sangdaun.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'แสงเดือน', 'โปธา', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '16', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('232', null, 'uraiwan.ch@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'อุไรวรรณ', 'ไชยถา', '', '', 'นักจัดการงานทั่วไป', '', '16', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('233', null, 'suchada.ma@cmu.ac.th', null, '', '0', '0', null, null, null, 'ว่าที่ร้อยตรีหญิง', 'สุชาดา', 'มหาไม้', '', '', 'วิศวกร', '', '16', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('234', null, 'ramest.nantajan@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ราเมศ', 'นันทจันทร์', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '16', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('235', null, 'nuttanan.bu@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'นัฐนันท์', 'บุตรศักดิ์', '', '', 'นักจัดการงานทั่วไป', '', '16', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('236', null, 'matana.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'มัฒนา', 'เครืออุ่นเรือน', '', '', 'พนักงานบริการทั่วไป', '', '16', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('237', null, 'suwit.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สุวิทย์', 'สิทธิชัยวงศ์', '', '', 'พนักงานสถานที่', '', '16', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('238', null, 'dungruthai.i@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ดั่งฤทัย', 'อินมณี', '', '', 'นักจัดการงานทั่วไป', '', '16', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('239', null, 'suppagarn.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ศุภกานต์', 'ธิเตจ๊ะ', '', '', 'นักวิทยาศาสตร์', '', '19', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('240', null, 'siwadol.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ศิวดล', 'สุภาเปี้ย', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '19', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('241', null, 'suthin.meta@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สุทิน', 'เมทา', '', '', 'พนักงานบริการทั่วไป', '', '19', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('242', null, 'phoonnistha.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ปุณณิฐฐา', 'ธัญญาพิชญะนันท์', '', '', 'นักจัดการงานทั่วไป', '', '19', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('243', null, 'khrueawan.b@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'เครือวัลย์', 'บุญเกิด', '', '', 'พนักงานบริการทั่วไป', '', '19', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('244', null, 'kittithat.ph@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'กิตติทัศน์', 'ผ่องศรีธนสกุล', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '17', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('245', null, 'suttipong.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สุทธิพงศ์', 'คำดี', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '17', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('246', null, 'thanachot.m@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ธนโชติ', 'เมืองใจ', '', '', 'วิศวกร', '', '17', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('247', null, 'narong.sri@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ณรงค์', 'ศรีวิชัย', '', '', 'พนักงานช่าง', '', '17', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('248', null, 'phadungsak.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ผดุงศักดิ์', 'ปันครอง', '', '', 'พนักงานบริการทั่วไป', '', '17', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('249', null, 'sane.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'เสน่ห์', 'แก้วพงค์ธิ', '', '', 'พนักงานบริการทั่วไป', '', '17', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('250', null, 'sutthipong.kantha@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สุทธิพงษ์', 'กันทา', '', '', 'พนักงานบริการทั่วไป', '', '17', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('251', null, 'boonmee.j@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'บุญมี', 'เจิมจันทร์', '', '', 'พนักงานบริการทั่วไป', '', '17', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('252', null, 'kasinee.r@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'เกศิณี', 'เรือนคำ', '', '', 'วิศวกร', '', '17', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('253', null, 'winai.r@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วินัย', 'เรือนปัญโญ', '', '', 'พนักงานบริการทั่วไป', '', '17', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('254', null, 'nitwaree.y@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'นิจวรีย์', 'ยศสอน', '', '', 'นักจัดการงานทั่วไป', '', '17', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('255', null, 'natticha.th@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ณัฐธิชา', 'ทองหลอม', '', '', 'นักจัดการงานทั่วไป', '', '17', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('256', null, 'gatesunee.th@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'เกศสุนี', 'ทองเมฆ', '', '', 'นักจัดการงานทั่วไป', '', '17', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('257', null, 'pornsawan.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'พรสวรรค์', 'ขัติยศ', '', '', 'นักวิทยาศาสตร์', '', '18', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('258', null, 'noratep.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'นรเทพ', 'พลวณิช', '', '', 'นักวิทยาศาสตร์', '', '18', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('259', null, 'sorawisit.n@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สรวิศิษฐ์', 'นิลพรรณ', '', '', 'นักจัดการงานทั่วไป', '', '18', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('260', null, 'kobkul.m@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'กอบกุล', 'ชัยรักษ์', '', '', 'พนักงานบริการทั่วไป', '', '18', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('261', null, 'nareerat.h@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'นารีรัตน์', 'เหมโลหะ', '', '', 'นักวิทยาศาสตร์', '', '18', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('262', null, 'ratanaporn.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'รตนพร', 'พงษ์มณี', '', '', 'นักจัดการงานทั่วไป', '', '18', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('263', null, 'atcharawan.i@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'อัจฉราวรรณ', 'อินทรส', '', '', 'นักจัดการงานทั่วไป', 'หัวหน้างานบริหารทั่วไป', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('264', null, 'pattaravijit.m@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ภัทราวิจิตร', 'มณีประเสริฐ', '', '', 'นักจัดการงานทั่วไป', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('265', null, 'anuchit.n@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อนุชิต', 'เนตรศิลป์', '', '', 'คนสวน', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('266', null, 'chanon.ka@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ชานนท์', 'แก้วบุญเรือง', '', '', 'วิศวกร', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('267', null, 'kiattichai.b@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'เกียรติชัย', 'บุญทารักษ์', '', '', 'นักจัดการงานทั่วไป', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('268', null, 'pikul.in@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'พิกุล', 'อินตากุล', '', '', 'นักจัดการงานทั่วไป', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('269', null, 'kamonporn.m@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'กมลพร', 'มณีวรรณ', '', '', 'นักจัดการงานทั่วไป', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('270', null, 'nuttapong.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นัทธพงศ์', 'เสนรังษี', '', '', 'นักจัดการงานทั่วไป', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('271', null, 'wanit.lerttrakul@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วนิตย์', 'เลิศตระกูล', '', '', 'รองศาสตราจารย์', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('272', null, 'bunwaeo.m@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'บุญแวว', 'มหาวัน', '', '', 'พนักงานบริการทั่วไป', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('273', null, 'jakkrit.kunna@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'จักรกฤช', 'กุนนา', '', '', 'พนักงานบริการทั่วไป', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('274', null, 'nukul.b@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นุกุล', 'บัวคำปัน', '', '', 'พนักงานช่าง', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('275', null, 'orapin.pra@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'อรพิน', 'ประภาวิลัย', '', '', 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานบริหารงานทั่วไป', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('276', null, 'somporn.pomin@cmu.ac.th', null, '', '0', '0', null, null, null, 'ว่าที่ร้อยตรี', 'สมพร', 'พรมมินทร์', '', '', 'พนักงานช่าง', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('277', null, 'wichita.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'วิชิตา', 'ท้าวหน่อ', '', '', 'วิศวกร', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('278', null, 'aussatakorn.keaw@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อนุรักษ์', 'แก้วบุญเรือง', '', '', 'พนักงานบริการฝีมือ (ด้านเทคนิคและเครื่องยนต์)', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('279', null, 'wanpen.saelu@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'วันเพ็ญ', 'แซ่หลู่', '', '', 'พนักงานบริการทั่วไป', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('280', null, 'sadayu.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'สดายุ', 'คำทอง', '', '', 'นักจัดการงานทั่วไป', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('281', null, 'pitirat.nan@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ปิติรัตน์', 'นันทวาศ', '', '', 'พนักงานบริการทั่วไป', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('282', null, 'sasikan.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ศศิกานต์', 'กองค้า', '', '', 'นักจัดการงานทั่วไป', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('283', null, 'chanon.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ชานนท์', 'ทินหนุน', '', '', 'พนักงานบริการฝีมือ (ด้านเทคนิคและเครื่องยนต์)', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('284', null, 'worapong.d@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วรพงษ์', 'ดาวเลิศ', '', '', 'พนักงานช่าง', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('285', null, 'maneerat.n@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'มณีรัตน์', 'เงินก่ำ', '', '', 'นักจัดการงานทั่วไป', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('286', null, 'chanikan.jai@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ชนิกานต์', 'ใจนวล', '', '', 'นักจัดการงานทั่วไป', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('287', null, 'patipan.w@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ปฏิภาณ', 'วงศ์เทพ', '', '', 'พนักงานบริการทั่วไป', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('288', null, 'songkran.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'สงกรานต์', 'สุวรรณคำ', '', '', 'พนักงานบริการทั่วไป', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('289', null, 'jakkrit.ku@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'จักรกริช', 'กวงแหวน', '', '', 'นักจัดการงานทั่วไป', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('290', null, 'ratchanon.m@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'รัชชานนท์', 'มงคลวัจน์', '', '', 'วิศวกร', '', '8', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('291', null, 'sineenuch.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'สินีนุช', 'พรหมมิจิตร', '', '', 'นักการเงินและบัญชี', '', '13', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('292', null, 'nattawan.v@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ณัฐวรรณ', 'วรินทร์รักษ์', '', '', 'นักการเงินและบัญชี', '', '13', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('293', null, 'chetdanai.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'เชษฐ์ดนัย', 'พราหมณ์บุญมี', '', '', 'พนักงานพัสดุ', '', '13', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('294', null, 'preeyapat.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ปรียาภัทร', 'ปาคำ', '', '', 'นักการเงินและบัญชี', '', '13', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('295', null, 'wasan.ch@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วสันต์', 'ฉายหิรัญ', '', '', 'นักจัดการงานทั่วไป', '', '13', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('296', null, 'suttiluk.c@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'สุทธิลักษณ์', 'จักร์ปั๋น', '', '', 'นักจัดการงานทั่วไป', '', '13', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('297', null, 'phacharaphon.i@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'พชรพล', 'อินทกุล', '', '', 'นักจัดการงานทั่วไป', '', '13', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('298', null, 'naruemon.kawi@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'นฤมล', 'กาวิละวงค์', '', '', 'นักการเงินและบัญชี', '', '13', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('299', null, 'yuphinporn.nondjuy@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'ยุพินพร', 'โนนจุ้ย', '', '', 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานการเงินฯ', '13', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('300', null, 'suwimon.mathu@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'สุวิมล', 'มะธุ', '', '', 'นักการเงินและบัญชี', 'ผู้ช่วยหัวหน้างานการเงินฯ', '13', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('301', null, 'waralee.c@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'วราลี', 'ช่างย้อม', '', '', 'นักการเงินและบัญชี', 'หัวหน้างานการเงินฯ', '13', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('302', null, 'poranee.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ภรณี', 'สรรพศรี', '', '', 'นักจัดการงานทั่วไป', '', '13', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('303', null, 'tachchaphong.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ธัชพงศ์', 'เต็มป๊ก', '', '', 'นักจัดการงานทั่วไป', '', '13', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('304', null, 'yupin.b@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ยุพิณ', 'บัวคำปัน', '', '', 'นักการเงินและบัญชี', '', '13', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('305', null, 'nidchanun.kan@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ณิชนันทน์', 'กันชะนะ', '', '', 'นักการเงินและบัญชี', '', '13', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('306', null, 'kantinan.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'กันตินันท์', 'คำราพิช', '', '', 'นักจัดการงานทั่วไป', '', '13', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('307', null, 'tippawan.b@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ทิพวรรณ', 'บุญหล้า', '', '', 'นักจัดการงานทั่วไป', '', '7', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('308', null, 'tanyanan.m@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ธัญนันท์', 'มาดี', '', '', 'นักจัดการงานทั่วไป', '', '7', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('309', null, 'maruechat.c@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'มฤฉัตร', 'เจริญทรัพย์', '', '', 'นักจัดการงานทั่วไป', 'หัวหน้างานนโยบายและแผนฯ', '7', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('310', null, 'pimonporn.m@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'พิมลพร', 'อภิรมย์ชัยกุล', '', '', 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานนโยบายและแผนฯ', '7', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('311', null, 'chonthicha.kaew@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ชลธิชา', 'แก้วบุญเรือง', '', '', 'นักจัดการงานทั่วไป', '', '7', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('312', null, 'sutat.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สุทัศน์', 'ขันเลข', '', '', 'นักวิชาการศึกษา', 'หัวหน้างานบริการการศึกษา', '2', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('313', null, 'apisada.y@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ภิญญาพัชญ์', 'ยุตบุตร', '', '', 'นักจัดการงานทั่วไป', '', '2', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('314', null, 'kanchana.na@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'กาญจนา', 'นะพรานบุญ', '', '', 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานริการการศึกษา', '2', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('315', null, 'somtawin.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ณัฐอารี', 'ตุ่นจาอ้าย', '', '', 'นักจัดการงานทั่วไป', '', '2', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('316', null, 'supaporn.luangthi@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'สุภาพร', 'หลวงธิ', '', '', 'นักจัดการงานทั่วไป', '', '2', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('317', null, 'nitchanan.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ณิชนันทน์', 'ปัญญาชลรักษ์', '', '', 'นักจัดการงานทั่วไป', '', '2', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('318', null, 'raphiphat.r@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'รพีภัทร', 'รินดวงดี', '', '', 'บรรณารักษ์', '', '2', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('319', null, 'pailin.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ไพลิน', 'สิงห์เปา', '', '', 'เจ้าหน้าที่สำนักงาน', '', '2', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('320', null, 'tanchanok.mayang@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'ธัญชนก', 'มายาง', '', '', 'นักจัดการงานทั่วไป', '', '2', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('321', null, 'ratchapol.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'รัชพล', 'เครือทอง', '', '', 'นักจัดการงานทั่วไป', '', '2', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('322', null, 'kittisak.t@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'กิตติศักดิ์', 'ตุ่นกันทา', '', '', 'นักจัดการงานทั่วไป', '', '2', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('323', null, 'tassaporn.c@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ทัศพร', 'จันทนานุวัฒน์กุล', '', '', 'นักจัดการงานทั่วไป', '', '2', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('324', null, 'alongkoat.thep@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อลงกต', 'เทพคำอ้าย', '', '', 'นักจัดการงานทั่วไป', '', '6', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('325', null, 'nattaporn.j@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ณัฐพร', 'ใจพุทธ', '', '', 'นักจัดการงานทั่วไป', 'หัวหน้างานบริหารงานวิจัยฯ', '6', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('326', null, 'kittiphop.pr@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'กิตติภพ', 'พรหมเผ่า', '', '', 'วิศวกร', '', '6', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('327', null, 'waratida.u@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'วรธิดา', 'อุดมสม', '', '', 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานงานวิจัยฯ', '6', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('328', null, 'moltri.marsaen@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'มนตรี', 'มาแสน', '', '', 'วิศวกร', '', '6', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('329', null, 'sasinar.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ศศิณา', 'สิทธิชมภู', '', '', 'นักจัดการงานทั่วไป', '', '6', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('330', null, 'songsak.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ทรงศักดิ์', 'ขลังวิชา', '', '', 'นักจัดการงานทั่วไป', '', '6', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('331', null, 'arisara.ka@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'อริศรา', 'กัลยาณวุฒิ', '', '', 'นักจัดการงานทั่วไป', '', '6', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('332', null, 'sukanya.pi@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'สุกัญญา', 'พิบูลย์', '', '', 'นักจัดการงานทั่วไป', 'หัวหน้างานพัฒนาคุณภาพฯ', '28', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('333', null, 'natnapa.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'เนตรนภา', 'สาระแปง', '', '', 'นักจัดการงานทั่วไป', '', '28', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('334', null, 'chanakan.pa@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ชนากานต์', 'ปันต๊ะถา', '', '', 'นักจัดการงานทั่วไป', '', '28', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('335', null, 'nattapan.n@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นัฏพันธุ์', 'นันทวาศ', '', '', 'นักจัดการงานทั่วไป', 'หัวหน้างานพัฒนาเทคโนฯ', '29', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('336', null, 'akaradate.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อัครเดช', 'ประกอบของ', '', '', 'นักจัดการงานทั่วไป', '', '29', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('337', null, 'winai.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'วินัย', 'คำสุรินทร์', '', '', 'นักวิชาการคอมพิวเตอร์', '', '29', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('338', null, 'niwat.j@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'นิวัฒน์', 'เจริญรัตนเดชะกูล', '', '', 'นักวิชาการคอมพิวเตอร์', '', '29', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('339', null, 'patthamakarn.r@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'ปัฐมกานต์', 'ระเบ็ง', '', '', 'นักจัดการงานทั่วไป', '', '29', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('340', null, 'sittipong.b@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สิทธิพงษ์', 'บุญเพ็ชร', '', '', 'นักจัดการงานทั่วไป', '', '29', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('342', null, 'chalermporn.gurana@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาง', 'เฉลิมพร', 'กุรานา', '', '', 'นักจัดการงานทั่วไป', '', '32', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('343', null, 'nattavee.ch@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ณัฐวีณ์', 'ไชยริศรี', '', '', 'นักจัดการงานทั่วไป', '', '32', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('344', null, 'sarach.sri@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'สารัช', 'ศรีบูรณ์', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '32', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('345', null, 'tunyamon.wa@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ธัญมล', 'วรรณละเอียด', '', '', 'นักจัดการงานทั่วไป', '', '32', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('346', null, 'aurakanya.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'อรกัญญา', 'พุทธวงค์', '', '', 'นักจัดการงานทั่วไป', '', '32', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('347', null, 'thanawut.th@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ธนาวุฒิ', 'ธีรเกียรติกุล', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '32', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('348', null, 'bancha.s@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'บัญชา', 'สุวรรณพิทักษ์', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '32', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('349', null, 'kornthip.c@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'กรทิพย์', 'ชัยยานนท์', '', '', 'นักจัดการงานทั่วไป', '', '31', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('350', null, 'nuttasri.senaluang@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ณัฏฐนันท์', 'พันธุ์บุญปลูก', '', '', 'นักจัดการงานทั่วไป', '', '31', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('351', null, 'teenaphat.p@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'ธีร์นภัส', 'ปรากฏมาก', '', '', 'นักจัดการงานทั่วไป', '', '31', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('352', null, 'palita.aun@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'ปาลิตา', 'อุ่นแก้ว', '', '', 'นักจัดการงานทั่วไป', '', '31', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('353', null, 'jirathorn.w@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'จิราธร', 'วรรณสุยะ', '', '', 'นักจัดการงานทั่วไป', '', '27', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('354', null, 'anucha.pinsaimoon@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'อนุชา', 'ปินทรายมูล', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '27', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('355', null, 'jerachard.k@cmu.ac.th', null, '', '0', '0', null, null, null, 'นาย', 'จิรชาติ', 'ใคร้มา', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', '27', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('356', null, 'patcharida.insee@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'พัชริดา', 'อินทรีย์', '', '', 'นักจัดการงานทั่วไป', '', '27', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('357', null, 'benrava.r@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'เบญราวาห์', 'เรือนทิพย์', '', '', 'นักจัดการงานทั่วไป', '', '27', '2', null, '0', null, '0', '0', '0');
INSERT INTO `users` VALUES ('358', null, 'nitchanan.pr@cmu.ac.th', null, '', '0', '0', null, null, null, 'นางสาว', 'นิชนันท์', 'ประไพตระกูล', '', '', 'นักจัดการงานทั่วไป', '', '27', '2', null, '0', null, '0', '0', '0');
