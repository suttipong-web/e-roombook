/*
Navicat MySQL Data Transfer

Source Server         : XamppServer
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : eroombook

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-08-28 09:17:03
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
INSERT INTO `room_galleries` VALUES ('1', '2', 'room2-1.jpg', '2024-08-27 11:01:25', '2024-08-27 11:01:25');
INSERT INTO `room_galleries` VALUES ('2', '2', 'room2-2.jpg', '2024-08-27 11:01:26', '2024-08-27 11:01:26');
INSERT INTO `room_galleries` VALUES ('3', '2', 'room2-3.jpg', '2024-08-27 11:01:26', '2024-08-27 11:01:26');
INSERT INTO `room_galleries` VALUES ('4', '2', 'room2-4.jpg', '2024-08-27 11:01:26', '2024-08-27 11:01:26');
INSERT INTO `room_galleries` VALUES ('5', '7', 'room7-1.jpg', '2024-08-27 11:01:26', '2024-08-27 11:01:26');
INSERT INTO `room_galleries` VALUES ('6', '7', 'room7-2.jpg', '2024-08-27 11:01:26', '2024-08-27 11:01:26');
INSERT INTO `room_galleries` VALUES ('7', '7', 'room7-3.jpg', '2024-08-27 11:01:26', '2024-08-27 11:01:26');
INSERT INTO `room_galleries` VALUES ('8', '7', 'room7-4.jpg', '2024-08-27 11:01:26', '2024-08-27 11:01:26');
INSERT INTO `room_galleries` VALUES ('9', '3', 'room3-1.jpg', '2024-08-27 11:01:26', '2024-08-27 11:01:26');
INSERT INTO `room_galleries` VALUES ('10', '3', 'room3-2.jpg', '2024-08-27 11:01:26', '2024-08-27 11:01:26');
INSERT INTO `room_galleries` VALUES ('11', '3', 'room3-3.jpg', '2024-08-27 11:01:26', '2024-08-27 11:01:26');
INSERT INTO `room_galleries` VALUES ('12', '3', 'room3-4.jpg', '2024-08-27 11:01:26', '2024-08-27 11:01:26');
INSERT INTO `room_galleries` VALUES ('13', '4', 'room4-1.jpg', '2024-08-27 11:01:26', '2024-08-27 11:01:26');
INSERT INTO `room_galleries` VALUES ('14', '4', 'room4-2.jpg', '2024-08-27 11:01:26', '2024-08-27 11:01:26');
INSERT INTO `room_galleries` VALUES ('15', '4', 'room4-3.jpg', '2024-08-27 11:01:26', '2024-08-27 11:01:26');
INSERT INTO `room_galleries` VALUES ('19', '4', 'room4-7.jpg', '2024-08-27 11:01:27', '2024-08-27 11:01:27');
INSERT INTO `room_galleries` VALUES ('20', '1', 'room1-1.jpg', '2024-08-27 11:01:27', '2024-08-27 11:01:27');
INSERT INTO `room_galleries` VALUES ('21', '1', 'room1-2.jpg', '2024-08-27 11:01:27', '2024-08-27 11:01:27');
INSERT INTO `room_galleries` VALUES ('22', '1', 'room1-3.jpg', '2024-08-27 11:01:27', '2024-08-27 11:01:27');
INSERT INTO `room_galleries` VALUES ('23', '1', 'room1-4.jpg', '2024-08-27 11:01:27', '2024-08-27 11:01:27');
INSERT INTO `room_galleries` VALUES ('24', '6', 'room6-1.jpg', '2024-08-27 11:01:27', '2024-08-27 11:01:27');
INSERT INTO `room_galleries` VALUES ('25', '6', 'room6-2.jpg', '2024-08-27 11:01:27', '2024-08-27 11:01:27');
INSERT INTO `room_galleries` VALUES ('26', '6', 'room6-3.jpg', '2024-08-27 11:01:27', '2024-08-27 11:01:27');
INSERT INTO `room_galleries` VALUES ('27', '6', 'room6-4.jpg', '2024-08-27 11:01:27', '2024-08-27 11:01:27');
