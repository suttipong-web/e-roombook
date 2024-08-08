/*
Navicat MySQL Data Transfer

Source Server         : xammp_localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : eroombook

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-08-09 06:09:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for users_type_admin
-- ----------------------------
DROP TABLE IF EXISTS `users_type_admin`;
CREATE TABLE `users_type_admin` (
  `admin_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_type_name` varchar(254) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `admin_type_detail` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`admin_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of users_type_admin
-- ----------------------------
INSERT INTO `users_type_admin` VALUES ('1', 'admin', 'ผู้ดูแลระบบ');
INSERT INTO `users_type_admin` VALUES ('2', 'major', 'ผู้ดูแลภาควิชา');
INSERT INTO `users_type_admin` VALUES ('3', 'eng', 'หัวหน้างานบริหาร');
INSERT INTO `users_type_admin` VALUES ('4', 'secretary', 'เลขานุการ');
INSERT INTO `users_type_admin` VALUES ('5', 'deaneng', 'รองคณบดี');
INSERT INTO `users_type_admin` VALUES ('6', 'dean', 'คณบดี');
INSERT INTO `users_type_admin` VALUES ('7', 'admin_room', 'ผู้ดูแลประจำห้อง');
INSERT INTO `users_type_admin` VALUES ('8', 'users', 'ผู้ใช้ทั่วไป');
