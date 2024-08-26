/*
Navicat MySQL Data Transfer

Source Server         : XamppServer
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : eroombook

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-08-26 15:58:08
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_roooms
-- ----------------------------
INSERT INTO `admin_roooms` VALUES ('1', '14', 'akaradate.p@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('2', '15', 'akaradate.p@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('3', '16', 'akaradate.p@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('4', '17', 'akaradate.p@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('5', '18', 'akaradate.p@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('6', '19', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('7', '20', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('8', '21', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('9', '22', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('10', '23', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('11', '24', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('12', '25', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('13', '26', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('14', '27', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('15', '28', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('16', '29', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('17', '30', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('18', '31', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('19', '32', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('20', '33', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('21', '34', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('22', '35', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('23', '36', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('24', '37', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('25', '38', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('26', '39', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('27', '40', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('28', '41', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('29', '42', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('30', '43', 'sittipong.b@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('31', '14', 'winai.k@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('32', '15', 'winai.k@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('33', '16', 'winai.k@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('34', '17', 'winai.k@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('35', '18', 'winai.k@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('36', '19', 'pitirat.nan@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('37', '20', 'pitirat.nan@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('38', '21', 'pitirat.nan@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('39', '22', 'pitirat.nan@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('40', '23', 'pitirat.nan@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('41', '24', 'pitirat.nan@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('42', '25', 'pitirat.nan@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('43', '26', 'pitirat.nan@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('44', '27', 'pitirat.nan@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('45', '28', 'pitirat.nan@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('46', '29', 'pitirat.nan@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('47', '30', 'pitirat.nan@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('48', '31', 'pitirat.nan@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('49', '32', 'pitirat.nan@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('50', '33', 'pitirat.nan@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('51', '34', 'kwanhathai.chai@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('52', '35', 'kwanhathai.chai@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('53', '36', 'kwanhathai.chai@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('54', '37', 'kwanhathai.chai@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('55', '38', 'kwanhathai.chai@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('56', '39', 'kwanhathai.chai@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('57', '40', 'kwanhathai.chai@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('58', '41', 'kwanhathai.chai@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('59', '42', 'kwanhathai.chai@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('60', '43', 'Bunwaeo.m@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('61', '14', 'niwat.j@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('62', '15', 'niwat.j@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('63', '16', 'niwat.j@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('64', '17', 'niwat.j@cmu.ac.th', null, '1', null, null);
INSERT INTO `admin_roooms` VALUES ('65', '18', 'niwat.j@cmu.ac.th', null, '1', null, null);
