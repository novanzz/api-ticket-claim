SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for event
-- ----------------------------
DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of event
-- ----------------------------
BEGIN;
INSERT INTO `event` (`id`, `name`) VALUES (1, 'blackpink');
INSERT INTO `event` (`id`, `name`) VALUES (2, 'new jeans');
INSERT INTO `event` (`id`, `name`) VALUES (3, 'westlife');
COMMIT;

-- ----------------------------
-- Table structure for ticket
-- ----------------------------
DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ticket_code` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `event_id` int NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ticket_code` (`ticket_code`),
  KEY `ticket_event_id_50ca8740_fk_event_id` (`event_id`),
  CONSTRAINT `ticket_event_id_50ca8740_fk_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ticket
-- ----------------------------
BEGIN;
INSERT INTO `ticket` (`id`, `ticket_code`, `status`, `event_id`, `updated_at`) VALUES (1, 'DTK01AHB89', 'claimed', 1, '2023-03-28 05:33:32');
INSERT INTO `ticket` (`id`, `ticket_code`, `status`, `event_id`, `updated_at`) VALUES (2, 'DTK01AHB86', 'claimed', 1, '2023-03-28 20:59:30');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
