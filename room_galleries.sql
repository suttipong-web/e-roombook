/*
Navicat MySQL Data Transfer

Source Server         : XamppServer
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : eroombook

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-08-27 10:30:04
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of room_galleries
-- ----------------------------
INSERT INTO `room_galleries` VALUES ('1', '2', 'room2-1', '2024-08-27 10:29:30', '2024-08-27 10:29:30');
INSERT INTO `room_galleries` VALUES ('2', '2', 'room2-2', '2024-08-27 10:29:30', '2024-08-27 10:29:30');
INSERT INTO `room_galleries` VALUES ('3', '2', 'room2-3', '2024-08-27 10:29:30', '2024-08-27 10:29:30');
INSERT INTO `room_galleries` VALUES ('4', '2', 'room2-4', '2024-08-27 10:29:31', '2024-08-27 10:29:31');
INSERT INTO `room_galleries` VALUES ('5', '7', 'room7-1', '2024-08-27 10:29:31', '2024-08-27 10:29:31');
INSERT INTO `room_galleries` VALUES ('6', '7', 'room7-2', '2024-08-27 10:29:31', '2024-08-27 10:29:31');
INSERT INTO `room_galleries` VALUES ('7', '7', 'room7-3', '2024-08-27 10:29:31', '2024-08-27 10:29:31');
INSERT INTO `room_galleries` VALUES ('8', '7', 'room7-4', '2024-08-27 10:29:31', '2024-08-27 10:29:31');
INSERT INTO `room_galleries` VALUES ('9', '3', 'room3-1', '2024-08-27 10:29:31', '2024-08-27 10:29:31');
INSERT INTO `room_galleries` VALUES ('10', '3', 'room3-2', '2024-08-27 10:29:31', '2024-08-27 10:29:31');
INSERT INTO `room_galleries` VALUES ('11', '3', 'room3-3', '2024-08-27 10:29:31', '2024-08-27 10:29:31');
INSERT INTO `room_galleries` VALUES ('12', '3', 'room3-4', '2024-08-27 10:29:31', '2024-08-27 10:29:31');
INSERT INTO `room_galleries` VALUES ('13', '4', 'room4-1', '2024-08-27 10:29:31', '2024-08-27 10:29:31');
INSERT INTO `room_galleries` VALUES ('14', '4', 'room4-2', '2024-08-27 10:29:31', '2024-08-27 10:29:31');
INSERT INTO `room_galleries` VALUES ('15', '4', 'room4-3', '2024-08-27 10:29:31', '2024-08-27 10:29:31');
INSERT INTO `room_galleries` VALUES ('16', '4', 'room4-4', '2024-08-27 10:29:31', '2024-08-27 10:29:31');
INSERT INTO `room_galleries` VALUES ('17', '4', 'room4-5', '2024-08-27 10:29:31', '2024-08-27 10:29:31');
INSERT INTO `room_galleries` VALUES ('18', '4', 'room4-6', '2024-08-27 10:29:31', '2024-08-27 10:29:31');
INSERT INTO `room_galleries` VALUES ('19', '4', 'room4-7', '2024-08-27 10:29:32', '2024-08-27 10:29:32');
INSERT INTO `room_galleries` VALUES ('20', '1', 'room1-1', '2024-08-27 10:29:32', '2024-08-27 10:29:32');
INSERT INTO `room_galleries` VALUES ('21', '1', 'room1-2', '2024-08-27 10:29:32', '2024-08-27 10:29:32');
INSERT INTO `room_galleries` VALUES ('22', '1', 'room1-3', '2024-08-27 10:29:32', '2024-08-27 10:29:32');
INSERT INTO `room_galleries` VALUES ('23', '1', 'room1-4', '2024-08-27 10:29:32', '2024-08-27 10:29:32');
INSERT INTO `room_galleries` VALUES ('24', '6', 'room6-1', '2024-08-27 10:29:32', '2024-08-27 10:29:32');
INSERT INTO `room_galleries` VALUES ('25', '6', 'room6-2', '2024-08-27 10:29:32', '2024-08-27 10:29:32');
INSERT INTO `room_galleries` VALUES ('26', '6', 'room6-3', '2024-08-27 10:29:32', '2024-08-27 10:29:32');
INSERT INTO `room_galleries` VALUES ('27', '6', 'room6-4', '2024-08-27 10:29:32', '2024-08-27 10:29:32');
