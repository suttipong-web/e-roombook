/*
Navicat MySQL Data Transfer

Source Server         : XamppServer
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : eroombook

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-08-28 09:17:42
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of rooms
-- ----------------------------
INSERT INTO `rooms` VALUES ('1', '', 'ห้องประชุมสำนักงานคณบดี', null, '7', '1', '1', 'room1.jpg', 'สำนักงานคณบดี ชั้น 6 อาคาร 30 ปี', '1', '0', null, '0', null, '7,10', '2024-07-27 09:09:13', '2024-06-23 21:50:41');
INSERT INTO `rooms` VALUES ('2', '', 'ห้องประชุมตียาภรณ์', null, '15', '1', '1', 'room2.jpg', 'สำนักงานเลขานุการ ชั้น 6 อาคาร 30 ปี', '1', '0', null, '0', null, '2,5,7,10', '2024-07-27 09:09:13', '2024-06-23 21:48:18');
INSERT INTO `rooms` VALUES ('3', '', 'ห้องประชุม 2', null, '80', '1', '1', 'room3.jpg', 'สำนักงานเลขานุการ ชั้น 7 อาคาร 30 ปี', '1', '0', null, '0', null, '1,2,4,7,9', '2024-07-27 09:09:13', '2024-06-23 21:47:47');
INSERT INTO `rooms` VALUES ('4', '', 'ห้องประชุม 3', null, '20', '1', '1', 'room4.jpg', 'สำนักงานเลขานุการ ชั้น 7 อาคาร 30 ปี', '1', '0', null, '0', null, '1,5,7,9,10', '2024-07-27 09:09:13', '2024-06-23 21:47:19');
INSERT INTO `rooms` VALUES ('5', '', 'ห้องประชุม 4', null, '80', '1', '1', '1719204424.jpg', 'สำนักงานเลขานุการ ชั้น 7 อาคาร 30 ปี (สามารถใช้เป็นห้องรับประทานอาหารได้)', '0', '0', null, '0', null, '4,5,7,9', '2024-07-27 09:09:13', '2024-06-23 21:47:04');
INSERT INTO `rooms` VALUES ('6', '', 'ห้องประชุมสำนักงานคณะ (ข้างห้อง วสท.)', null, '10', '1', '1', '1719204404.jpg', 'ห้องประชุมสำนักงานคณะ ชั้น 6 อาคาร 30 ปี', '1', '0', null, '0', null, '2,5,7,9,10', '2024-07-27 09:09:13', '2024-06-23 21:46:44');
INSERT INTO `rooms` VALUES ('7', '', 'ห้องประชุมหอเกียรติยศ', null, '15', '1', '1', 'room7.jpg', 'หอเกียรติยศ ชั้น 6 อาคาร 30 ปี', '1', '0', null, '0', null, '1,5,7,9,10', '2024-07-27 09:09:13', '2024-06-23 21:46:24');
INSERT INTO `rooms` VALUES ('13', '2763a1500aee412083462d7ca48a6cef', 'Slope RTT', 'Slope RTT', '40', '1', '2', '1719222208.jpg', null, '1', '0', null, '0', null, '1,4,5,7', '2024-07-27 09:09:13', '2024-07-27 09:10:14');
INSERT INTO `rooms` VALUES ('14', '', '302', '302', '60', '3', '1', null, '', '1', '0', null, '0', null, '1,2,3,4,6,7,8', '2024-08-26 15:31:11', '2024-08-26 15:31:11');
INSERT INTO `rooms` VALUES ('15', '', '303', '303', '30', '3', '1', null, '', '1', '0', null, '0', null, '1,2,3,4,,6,7,8', '2024-08-26 15:31:11', '2024-08-26 15:31:11');
INSERT INTO `rooms` VALUES ('16', '', '304', '304', '30', '3', '1', null, '', '1', '0', null, '0', null, '1,2,3,4,,6,7,8', '2024-08-26 15:31:11', '2024-08-26 15:31:11');
INSERT INTO `rooms` VALUES ('17', '', '313', '313', '50', '3', '1', null, '', '1', '0', null, '0', null, '1,2,3,4,5,6,7,8', '2024-08-26 15:31:11', '2024-08-26 15:31:11');
INSERT INTO `rooms` VALUES ('18', '', '314', '314', '80', '3', '1', null, '', '1', '0', null, '0', null, '1,2,3,4,5,6,7,8', '2024-08-26 15:31:11', '2024-08-26 15:31:11');
INSERT INTO `rooms` VALUES ('19', '', '210', '210', '66', '2', '1', null, '', '1', '0', null, '0', null, '1,2,4,6,7,8,9', '2024-08-26 15:31:11', '2024-08-26 15:31:11');
INSERT INTO `rooms` VALUES ('20', '', '211', '211', '66', '2', '1', null, '', '1', '0', null, '0', null, '1,2,4,6,7,8,9', '2024-08-26 15:31:11', '2024-08-26 15:31:11');
INSERT INTO `rooms` VALUES ('21', '', '212', '212', '35', '2', '1', null, '', '1', '0', null, '0', null, '1,2,4,6,7,8', '2024-08-26 15:31:11', '2024-08-26 15:31:11');
INSERT INTO `rooms` VALUES ('22', '', '213', '213', '35', '2', '1', null, '', '1', '0', null, '0', null, '1,2,4,6,7,8', '2024-08-26 15:31:11', '2024-08-26 15:31:11');
INSERT INTO `rooms` VALUES ('23', '', '214', '214', '35', '2', '1', null, '', '1', '0', null, '0', null, '1,2,4,6,7,8', '2024-08-26 15:31:11', '2024-08-26 15:31:11');
INSERT INTO `rooms` VALUES ('24', '', '201', '201', '40', '2', '1', null, '', '1', '0', null, '0', null, '1,2,4,6,7,10,8', '2024-08-26 15:31:12', '2024-08-26 15:31:12');
INSERT INTO `rooms` VALUES ('25', '', '202-1', '202-1', '18', '2', '1', null, '', '1', '0', null, '0', null, '5,7,10,8', '2024-08-26 15:31:12', '2024-08-26 15:31:12');
INSERT INTO `rooms` VALUES ('26', '', '202-2', '202-2', '30', '2', '1', null, '', '1', '0', null, '0', null, '1,2,4,6,7,10,8', '2024-08-26 15:31:12', '2024-08-26 15:31:12');
INSERT INTO `rooms` VALUES ('27', '', '203', '203', '40', '2', '1', null, '', '1', '0', null, '0', null, '1,2,4,6,7,10,8', '2024-08-26 15:31:12', '2024-08-26 15:31:12');
INSERT INTO `rooms` VALUES ('28', '', '204', '204', '25', '3', '1', null, '', '1', '0', null, '0', null, '2,3,4,7,8', '2024-08-26 15:31:12', '2024-08-26 15:31:12');
INSERT INTO `rooms` VALUES ('29', '', '310', '310', '66', '2', '1', null, '', '1', '0', null, '0', null, '1,2,4,6,7,8,9', '2024-08-26 15:31:12', '2024-08-26 15:31:12');
INSERT INTO `rooms` VALUES ('30', '', '311', '311', '66', '2', '1', null, '', '1', '0', null, '0', null, '1,2,4,6,7,8,9', '2024-08-26 15:31:12', '2024-08-26 15:31:12');
INSERT INTO `rooms` VALUES ('31', '', '312', '312', '35', '2', '1', null, '', '1', '0', null, '0', null, '1,2,4,6,7,8', '2024-08-26 15:31:12', '2024-08-26 15:31:12');
INSERT INTO `rooms` VALUES ('32', '', '702', '702', '50', '2', '1', null, '', '1', '0', null, '0', null, '1,2,4,6,7,8', '2024-08-26 15:31:12', '2024-08-26 15:31:12');
INSERT INTO `rooms` VALUES ('33', '', '718', '718', '80', '2', '1', null, '', '1', '0', null, '0', null, '1,2,4,6,7,8', '2024-08-26 15:31:12', '2024-08-26 15:31:12');
INSERT INTO `rooms` VALUES ('34', '', 'Slope EG3-001', 'Slope EG3-001', '350', '2', '3', null, 'จอแสดงภาพ LED', '1', '0', null, '0', null, '1,2,4,6,7', '2024-08-26 15:31:12', '2024-08-26 15:31:12');
INSERT INTO `rooms` VALUES ('35', '', 'ห้องบรรยายโรงอาหาร', 'ห้องบรรยายโรงอาหาร', '133', '2', '4', null, '', '1', '0', null, '0', null, '1,4,6,7', '2024-08-26 15:31:12', '2024-08-26 15:31:12');
INSERT INTO `rooms` VALUES ('36', '', '2-301', '2-301', '35', '2', '5', null, '', '1', '0', null, '0', null, '1,2,4,6,7,8', '2024-08-26 15:31:12', '2024-08-26 15:31:12');
INSERT INTO `rooms` VALUES ('37', '', '2-302', '2-302', '25', '2', '5', null, '', '1', '0', null, '0', null, '1,2,4,6,7,8', '2024-08-26 15:31:13', '2024-08-26 15:31:13');
INSERT INTO `rooms` VALUES ('38', '', '2-306', '2-306', '45', '2', '5', null, '', '1', '0', null, '0', null, '1,2,4,6,7,8', '2024-08-26 15:31:13', '2024-08-26 15:31:13');
INSERT INTO `rooms` VALUES ('39', '', '2-307', '2-307', '35', '2', '5', null, '', '1', '0', null, '0', null, '1,2,4,6,7,8', '2024-08-26 15:31:13', '2024-08-26 15:31:13');
INSERT INTO `rooms` VALUES ('40', '', '2-401', '2-401', '80', '2', '5', null, '', '1', '0', null, '0', null, '1,2,4,5,6,7,8', '2024-08-26 15:31:13', '2024-08-26 15:31:13');
INSERT INTO `rooms` VALUES ('41', '', '2-403', '2-403', '30', '2', '5', null, '', '1', '0', null, '0', null, '1,2,4,6,7,8', '2024-08-26 15:31:13', '2024-08-26 15:31:13');
INSERT INTO `rooms` VALUES ('42', '', '2-404', '2-404', '50', '2', '5', null, '', '1', '0', null, '0', null, '1,2,4,5,6,7,8', '2024-08-26 15:31:13', '2024-08-26 15:31:13');
INSERT INTO `rooms` VALUES ('43', '', 'Slope RTT', 'Slope RTT', '48', '2', '2', null, '', '1', '0', null, '0', null, '1,5,7', '2024-08-26 15:31:13', '2024-08-26 15:31:13');
