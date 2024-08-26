/*
Navicat MySQL Data Transfer

Source Server         : XamppServer
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : eroombook

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-08-26 15:44:32
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of place
-- ----------------------------
INSERT INTO `place` VALUES ('1', 'อาคาร 30 ปี', null, null, null);
INSERT INTO `place` VALUES ('2', 'อาคาร RTT', null, null, null);
INSERT INTO `place` VALUES ('3', 'อาคารเรียนรวม 3 ชั้น', null, null, null);
INSERT INTO `place` VALUES ('4', 'โรงอาหารคณะฯ', null, null, null);
INSERT INTO `place` VALUES ('5', 'อาคารเรียนรวม 4 ชั้น', null, null, null);
