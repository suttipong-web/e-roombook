/*
Navicat MySQL Data Transfer

Source Server         : xammp_localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : eroombook

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-06-25 02:08:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for booking_rooms
-- ----------------------------
DROP TABLE IF EXISTS `booking_rooms`;
CREATE TABLE `booking_rooms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_no` varchar(32) NOT NULL,
  `roomID` varchar(254) NOT NULL,
  `booking_date` char(10) NOT NULL,
  `booking_time_start` char(4) NOT NULL,
  `booking_time_finish` char(4) NOT NULL,
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
  `booking_type` tinyint(4) NOT NULL DEFAULT 0,
  `booking_AdminApprove` tinyint(1) NOT NULL DEFAULT 0,
  `booking_DeanApprove` tinyint(1) NOT NULL DEFAULT 0,
  `description` varchar(255) DEFAULT NULL,
  `booking_at` timestamp NULL DEFAULT NULL,
  `booking_cancel` tinyint(1) NOT NULL DEFAULT 0,
  `booker_cmuaccount` varchar(255) DEFAULT NULL,
  `booking_food` tinyint(1) DEFAULT 0,
  `booking_camera` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of booking_rooms
-- ----------------------------
INSERT INTO `booking_rooms` VALUES ('1', '1234', '2', '24/06/2024', '0900', '1030', 'ประชุมงาน IT ', null, null, 'สุทธิพงค์ ริโปนยอง', '10', 'งานIT', '0', '0', '0', null, '543564564', '0', '0', '0', '0', 'ทดสอบระบบ', '2024-06-24 22:18:02', '0', 'suttipong.r@cmu.ac.th', '0', '0', '2024-06-24 22:18:21', '2024-06-24 22:18:26');

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
  `customerName` varchar(254) DEFAULT NULL,
  `customerEmail` varchar(100) DEFAULT NULL,
  `customerPhone` varchar(100) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `receipt_fname` varchar(254) DEFAULT NULL,
  `receipt_taxid` varchar(20) DEFAULT NULL,
  `receipt_address` varchar(255) DEFAULT NULL,
  `receipt_phone` varchar(50) DEFAULT NULL,
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
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('4', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `migrations` VALUES ('5', '2024_06_22_155543_create_rooms_table', '1');
INSERT INTO `migrations` VALUES ('6', '2024_06_22_155638_room_type_table', '1');
INSERT INTO `migrations` VALUES ('7', '2024_06_22_155805_create_place_table', '1');
INSERT INTO `migrations` VALUES ('8', '2024_06_22_155841_create_customer_payment_table', '1');
INSERT INTO `migrations` VALUES ('9', '2024_06_22_155916_create_cmu_oauth_table', '1');
INSERT INTO `migrations` VALUES ('11', '2024_06_22_155945_create_booking_rooms_table', '2');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of rooms
-- ----------------------------
INSERT INTO `rooms` VALUES ('1', '', 'ห้องประชุมสำนักงานคณบดี (ห้องกระจก)', null, '7', '1', '1', '1719204526.jpg', 'สำนักงานคณบดี ชั้น 6 อาคาร 30 ปี', '0', '0', null, '2024-06-24 04:50:41');
INSERT INTO `rooms` VALUES ('2', '', 'ห้องประชุมตียาภรณ์', null, '15', '1', '1', '1719204497.jpg', 'สำนักงานเลขานุการ ชั้น 6 อาคาร 30 ปี', '1', '0', null, '2024-06-24 04:48:18');
INSERT INTO `rooms` VALUES ('3', '', 'ห้องประชุม 2', null, '80', '1', '1', '1719204467.jpg', 'สำนักงานเลขานุการ ชั้น 7 อาคาร 30 ปี', '1', '0', null, '2024-06-24 04:47:47');
INSERT INTO `rooms` VALUES ('4', '', 'ห้องประชุม 3', null, '20', '1', '1', '1719204439.jpg', 'สำนักงานเลขานุการ ชั้น 7 อาคาร 30 ปี', '1', '0', null, '2024-06-24 04:47:19');
INSERT INTO `rooms` VALUES ('5', '', 'ห้องประชุม 4', null, '80', '1', '1', '1719204424.jpg', 'สำนักงานเลขานุการ ชั้น 7 อาคาร 30 ปี (สามารถใช้เป็นห้องรับประทานอาหารได้)', '1', '0', null, '2024-06-24 04:47:04');
INSERT INTO `rooms` VALUES ('6', '', 'ห้องประชุมสำนักงานคณะ (ข้างห้อง วสท.1)', null, '10', '1', '1', '1719204404.jpg', 'ห้องประชุมสำนักงานคณะ ชั้น 6 อาคาร 30 ปี', '1', '0', null, '2024-06-24 04:46:44');
INSERT INTO `rooms` VALUES ('7', '', 'หอเกียรติยศ', null, '15', '1', '1', '1719204384.jpg', 'หอเกียรติยศ ชั้น 6 อาคาร 30 ปี', '1', '0', null, '2024-06-24 04:46:24');
INSERT INTO `rooms` VALUES ('8', '', 'ห้องคอมพิวเตอร์ 314', 'Lab 314', '50', '2', '1', '1719222208.jpg', 'ชั้น 3 อาคาร 30 ปี  21', '0', '0', null, '2024-06-24 09:43:28');

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
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
