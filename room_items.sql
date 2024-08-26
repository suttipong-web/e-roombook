/*
Navicat MySQL Data Transfer

Source Server         : XamppServer
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : eroombook

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-08-26 15:46:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for room_items
-- ----------------------------
DROP TABLE IF EXISTS `room_items`;
CREATE TABLE `room_items` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
INSERT INTO `room_items` VALUES ('10', 'เครื่องฟอกอากาศ');
