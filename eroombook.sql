
DROP TABLE IF EXISTS `action_status`;
CREATE TABLE `action_status` (
  `id` smallint(4) NOT NULL,
  `action_en` varchar(20) DEFAULT NULL,
  `action_th` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `action_status`
--

INSERT INTO `action_status` (`id`, `action_en`, `action_th`) VALUES
(1, 'approved', 'อนุมัติ'),
(2, 'canceled', 'ไม่อนุมัติ'),
(3, 'ForwardDean', 'ส่งต่อผู้บริหาร');

-- --------------------------------------------------------

--
-- Table structure for table `adminroom_type`
--

DROP TABLE IF EXISTS `adminroom_type`;
CREATE TABLE `adminroom_type` (
  `type_id` smallint(4) NOT NULL,
  `type_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminroom_type`
--

INSERT INTO `adminroom_type` (`type_id`, `type_name`) VALUES
(1, 'เจ้าหน้าที่ผู้ดูแลประจำห้อง'),
(2, 'Admin ความคุมการอนุมัติ');

-- --------------------------------------------------------

--
-- Table structure for table `admin_roooms`
--

DROP TABLE IF EXISTS `admin_roooms`;
CREATE TABLE `admin_roooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roomID` int(11) NOT NULL,
  `cmuitaccount` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `adminroom_type_id` smallint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_roooms`
--

INSERT INTO `admin_roooms` (`id`, `roomID`, `cmuitaccount`, `phone`, `adminroom_type_id`, `created_at`, `updated_at`) VALUES
(1, 11, 'suttipong.r@cmu.ac.th', '4120', 0, NULL, '2024-07-23 13:26:22'),
(6, 11, 'akaradate.p@cmu.ac.th', '4120', 0, '2024-07-23 13:45:38', '2024-07-23 13:45:38'),
(7, 11, 'winai.k@cmu.ac.th', '14120', 0, '2024-07-23 13:49:23', '2024-07-23 13:49:23'),
(9, 13, 'suttipong.r@cmu.ac.th', '4120', 2, '2024-07-27 10:12:01', '2024-07-27 10:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `booking_assign2`
--

DROP TABLE IF EXISTS `booking_assign2`;
CREATE TABLE `booking_assign2` (
  `id` int(11) NOT NULL,
  `cmuitaccount` varchar(120) DEFAULT NULL,
  `bookingID` bigint(20) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `is_send_email` tinyint(1) DEFAULT 0,
  `is_send_line` tinyint(1) DEFAULT 0,
  `is_confirm` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_assigns`
--

DROP TABLE IF EXISTS `booking_assigns`;
CREATE TABLE `booking_assigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cmuitaccount` varchar(255) NOT NULL,
  `bookingID` bigint(20) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `is_send_email` tinyint(1) NOT NULL DEFAULT 0,
  `is_send_line` tinyint(1) NOT NULL DEFAULT 0,
  `is_confirm` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_assigns`
--

INSERT INTO `booking_assigns` (`id`, `cmuitaccount`, `bookingID`, `is_read`, `is_send_email`, `is_send_line`, `is_confirm`, `created_at`, `updated_at`) VALUES
(3, 'suttipong.r@cmu.ac.th', 16, 0, 0, 0, 0, '2024-07-21 20:55:37', '2024-07-21 20:55:37'),
(4, 'akaradate.p@cmu.ac.th', 16, 0, 0, 0, 0, '2024-07-21 20:57:18', '2024-07-21 20:57:18'),
(5, 'sittipong.b@cmu.ac.th', 26, 0, 0, 0, 0, '2024-07-28 02:01:43', '2024-07-28 02:01:43'),
(6, 'suttipong.r@cmu.ac.th', 26, 0, 0, 0, 0, '2024-07-28 02:02:11', '2024-07-28 02:02:11'),
(9, 'pitirat.nan@cmu.ac.th', 26, 0, 0, 0, 0, '2024-08-01 00:06:12', '2024-08-01 00:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `booking_rooms`
--

DROP TABLE IF EXISTS `booking_rooms`;
CREATE TABLE `booking_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_rooms`
--

INSERT INTO `booking_rooms` (`id`, `booking_no`, `roomID`, `booking_date`, `schedule_startdate`, `schedule_enddate`, `booking_time_start`, `booking_time_finish`, `booking_subject`, `booking_subject_sec`, `booking_Instructor`, `booking_booker`, `booking_ofPeople`, `booking_department`, `booking_autio`, `booking_lcd`, `booking_computer`, `booking_zoom`, `bookingToken`, `booking_status`, `booking_type`, `booking_AdminAction`, `booking_DeanAction`, `description`, `booking_at`, `booking_cancel`, `booker_cmuaccount`, `booking_food`, `booking_camera`, `booking_email`, `booking_phone`, `admin_action_date`, `dean_action_date`, `admin_action_acount`, `dean_action_acount`, `booking_fileurl`, `is_read`, `created_at`, `updated_at`) VALUES
(2, '1719283893', 2, NULL, '2024-07-09', '2024-07-09', '11:30:00', '13:00:00', 'ประชุม', NULL, NULL, '1323', 1, '1', 0, 0, 0, '1', 'fcf7fbd86be9f3b326c2b3f74582ed95', 1, '0', 'canceled', '0', '12123', '2024-06-24 19:51:33', 1, NULL, 1, 1, 'suttipong.r@cmu.ac.th', '053944120', '2024-06-29 07:29:02', '0000-00-00 00:00:00', 'suttipong.r@cmu.ac.th', NULL, NULL, 1, '2024-06-24 19:51:33', '2024-06-24 19:51:33'),
(9, '1719285260', 2, NULL, '2024-07-09', '2024-07-09', '09:00:00', '10:30:00', 'ประชุมติดตามระบบ E-Project', NULL, NULL, 'หน่วยงานเทนโน ฯ', 10, '10', 0, 0, 1, '1', 'd95d6df6524fa7b190046bc55e91ba9c', 1, '0', 'approved', '0', 'test', '2024-06-24 20:14:20', 0, NULL, 1, 1, 'suttipong.r@cmu.ac.th', '053944120', '2024-06-29 07:26:10', '0000-00-00 00:00:00', 'suttipong.r@cmu.ac.th', NULL, NULL, 1, '2024-06-24 20:14:20', '2024-06-24 20:14:20'),
(10, '1719286608', 3, NULL, '2024-07-11', '2024-07-11', '09:00:00', '09:00:00', '1111321', NULL, NULL, 'AOd', 11, '5525', 0, 0, 1, '1', 'e6fe6cb86c6347047138039ea75ac5c9', 1, '0', 'canceled', '0', 'test ssend', '2024-06-24 20:36:48', 1, NULL, 1, 1, 'suttipong.r@cmu.ac.th', '053944120', '2024-06-29 07:35:28', NULL, 'suttipong.r@cmu.ac.th', NULL, NULL, 1, '2024-06-24 20:36:48', '2024-06-24 20:36:48'),
(11, '1719287560', 3, NULL, '2024-07-12', '2024-07-12', '09:00:00', '09:00:00', '1111321', NULL, NULL, 'AOd', 11, '5525', 0, 0, 1, '1', 'b3b60f3e56c0e6ae279e9bfe00b11915', 2, '0', 'ForwardDean', '0', 'test ssend', '2024-06-24 20:52:40', 0, NULL, 1, 1, 'suttipong.r@cmu.ac.th', '053944120', '2024-06-29 07:38:34', NULL, 'suttipong.r@cmu.ac.th', NULL, NULL, 1, '2024-06-24 20:52:40', '2024-06-24 20:52:40'),
(12, '1719288310', 2, NULL, '2024-07-12', '2024-07-12', '11:00:00', '12:00:00', 'ประชุม999 ประชุมติดตามระบบ E-Project', NULL, NULL, 'AOd', 1, '12', 0, 0, 1, '1', '545f314f6d62f98f30c8ba8867c8dae7', 0, '0', '', '0', 'test', '2024-06-24 21:05:10', 0, NULL, 1, 1, 'suttipong.r@cmu.ac.th', '053944120', NULL, NULL, NULL, NULL, NULL, 1, '2024-06-24 21:05:10', '2024-06-24 21:05:10'),
(13, '1719288738', 2, NULL, '2024-07-12', '2024-07-12', '13:00:00', '15:30:00', 'หารือกับสมาคม นศ.เก่า เรื่องการจัดกิจกรรมระหว่างสมาคมและคณะ หารือกับสมาคม นศ.เก่า เรื่องการจัดกิจกรรมระหว่างสมาคมและคณะ', NULL, NULL, 'AOd333', 12, NULL, 0, 0, 1, '1', '087a0f18cd3890a01807b71cfa9a3722', 1, '0', 'canceled', '0', '23858282828', '2024-06-24 21:12:18', 1, NULL, 1, 1, 'suttipong.r@cmu.ac.th', '053944120', '2024-06-29 13:53:09', NULL, 'suttipong.r@cmu.ac.th', NULL, NULL, 1, '2024-06-24 21:12:18', '2024-06-24 21:12:18'),
(14, '1719298867', 2, NULL, '2024-07-13', '2024-07-13', '16:00:00', '17:00:00', 'ประชุม88844', NULL, NULL, 'AOd', 123, '123', 0, 0, 1, '1', '3116c765babee8bee2198b2ca7032f6b', 1, '0', 'approved', '0', '313213', '2024-06-25 00:01:07', 0, NULL, 1, 1, 'suttipong.r@cmu.ac.th', '053944120', '2024-06-29 12:40:44', NULL, 'suttipong.r@cmu.ac.th', NULL, NULL, 1, '2024-06-25 00:01:07', '2024-06-25 00:01:07'),
(15, '1720415923', 1, NULL, '2024-07-10', '2024-07-10', '11:30:00', '14:30:00', 'ประชุม', NULL, NULL, '1323', 4141, '411', 0, 0, 1, '0', '12c6ff48e99c2490cc368648a57e6ad2', 1, '0', '', '', '41414', '2024-07-07 22:18:43', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, '', NULL, NULL, 1, '2024-07-07 22:18:43', '2024-07-07 22:18:43'),
(16, '1720426761', 1, NULL, '2024-07-10', '2024-07-10', '11:30:00', '13:00:00', 'หารือกับสมาคม นศ.เก่า เรื่องการจัดกิจกรรมระหว่างสมาคมและคณะ', NULL, NULL, 'นายสุทธิพงค์ ริโปนยอง', 10, 'เทคโนโลยี', 0, 0, 1, '0', 'd0c949ca3e5378633c8a29690a965431', 1, '0', 'approved', '', '1010', '2024-07-08 01:19:21', 0, NULL, 0, 0, NULL, NULL, '2024-07-08 08:19:42', NULL, 'suttipong.r@cmu.ac.th', NULL, NULL, 1, '2024-07-08 01:19:21', '2024-07-08 01:19:21'),
(17, '1721034133', 3, '15/07/2024', '2024-07-15', '2024-07-15', '16:00:00', '17:00:00', 'ประชุม', NULL, NULL, 'สุทธิพงค์ ริโปนยอง', 10, 'เทคโนโลยี', 0, 0, 0, NULL, '399b4fe7a185056102183ce944290275', 0, '0', '', '', 'test', '2024-07-15 02:02:13', 0, 'suttipong.r@cmu.ac.th', 0, 0, 'suttipong.r@cmu.ac.th', NULL, NULL, NULL, '', NULL, NULL, 1, '2024-07-15 02:02:13', '2024-07-15 02:02:13'),
(19, '1721036409', 3, '16/07/2024', '2024-07-16', '2024-07-16', '11:30:00', '14:00:00', 'ประชุม', NULL, NULL, 'สุทธิพงค์ ริโปนยอง', 10, 'IT', 0, 0, 0, NULL, '607e83a93615fd543cc6a8c31f7675b8', 0, '0', '', '', '1010101', '2024-07-15 02:40:09', 0, 'suttipong.r@cmu.ac.th', 0, 0, 'suttipong.r@cmu.ac.th', '1010101', NULL, NULL, '', NULL, NULL, 1, '2024-07-15 02:40:09', '2024-07-15 02:40:09'),
(20, '1721141916', 3, '17/07/2024', '2024-07-17', '2024-07-17', '10:00:00', '12:00:00', 'ite', NULL, NULL, 'สุทธิพงค์ ริโปนยอง', 10, 'it', 0, 0, 0, NULL, 'dc3fdd92f5c2e818b77d014e155d4a9d', 1, 'eng', '', '', 'test', '2024-07-16 07:58:36', 0, 'suttipong.r@cmu.ac.th', 0, 0, 'suttipong.r@cmu.ac.th', '10', NULL, NULL, '', NULL, '', 1, '2024-07-16 07:58:36', '2024-07-16 07:58:36'),
(21, '1721141962', 3, '17/07/2024', '2024-07-17', '2024-07-17', '08:00:00', '09:30:00', 'ประชุม999999999', NULL, NULL, 'สุทธิพงค์ ริโปนยอง', 10, 'it', 0, 0, 0, NULL, '41a653d8e80484762b016b2bfd1c044d', 1, 'eng', '', '', NULL, '2024-07-16 07:59:22', 0, 'suttipong.r@cmu.ac.th', 0, 0, 'suttipong.r@cmu.ac.th', NULL, NULL, NULL, '', NULL, '', 1, '2024-07-16 07:59:22', '2024-07-16 07:59:22'),
(22, '1721303935', 3, '18/07/2024', '2024-07-18', '2024-07-18', '19:30:00', '20:00:00', 'ssssssssss ssssss sa', NULL, NULL, 'Aod', 100, 'it', 0, 0, 0, NULL, 'aca619506139c0d47f5cab2853b6c548', 0, 'general', '', '', NULL, '2024-07-18 04:58:55', 0, NULL, 0, 0, 'stimulus.ad@gmail.com', '4120', NULL, NULL, '', NULL, '1721303934.pdf', 1, '2024-07-18 04:58:55', '2024-07-18 04:58:55'),
(23, '1721390843', 3, '20/07/2024', '2024-07-20', '2024-07-20', '08:30:00', '09:30:00', 'ประชุมuuuuuu uu uuu', NULL, NULL, 'สุทธิพงค์ ริโปนยอง', 2, 'it', 0, 0, 0, NULL, '01aaaa96a9a3f4cf888479513e1503d1', 1, 'eng', '', '', 'test', '2024-07-19 05:07:23', 0, 'suttipong.r@cmu.ac.th', 0, 0, 'suttipong.r@cmu.ac.th', '4120', NULL, NULL, '', NULL, '', 1, '2024-07-19 05:07:23', '2024-07-19 05:07:23'),
(24, '1721391843', 3, '19/07/2024', '2024-07-19', '2024-07-19', '10:00:00', '12:00:00', 'ประชุมiukki igkkk kk', NULL, NULL, 'สุทธิพงค์ ริโปนยอง', 10, 'it', 0, 0, 0, NULL, 'f4b6d0e8de3b023100b2eed058e3c363', 1, 'general', 'approved', '', 'tesr', '2024-07-19 05:24:03', 0, 'suttipong.r@cmu.ac.th', 0, 0, 'suttipong.r@cmu.ac.th', '4120', '2024-07-19 13:50:34', NULL, 'suttipong.r@cmu.ac.th', NULL, '1721391843.pdf', 1, '2024-07-19 05:24:03', '2024-07-19 05:24:03'),
(25, '1721481271', 3, '21/07/2024', '2024-07-21', '2024-07-21', '12:00:00', '13:00:00', 'ประชุม gsdsgsgsdfg', NULL, NULL, 'สุทธิพงค์ ริโปนยอง', 111, 'it', 0, 0, 0, NULL, 'b496a140d8efa22e90addfc606dca68d', 1, 'eng', '', '', '12312', '2024-07-20 06:14:31', 0, 'suttipong.r@cmu.ac.th', 0, 0, 'suttipong.r@cmu.ac.th', '4120', NULL, NULL, '', NULL, '', 1, '2024-07-20 06:14:31', '2024-07-20 06:14:31'),
(26, '1722104273', 13, '27/07/2024', '2024-07-27', '2024-07-27', '14:30:00', '16:30:00', 'ประชุม9999', NULL, NULL, 'สุทธิพงค์ ริโปนยอง', 10, 'it', 0, 0, 0, NULL, 'd9d5fd94b45cd18a09459f342440143f', 0, 'general', '', '', NULL, '2024-07-27 11:17:53', 0, 'suttipong.r@cmu.ac.th', 0, 0, 'suttipong.r@cmu.ac.th', '4120', '2024-07-28 08:50:17', NULL, 'suttipong.r@cmu.ac.th', NULL, '1722104273.pdf', 1, '2024-07-27 11:17:53', '2024-07-27 11:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `cmu_oauth`
--

DROP TABLE IF EXISTS `cmu_oauth`;
CREATE TABLE `cmu_oauth` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_payment`
--

DROP TABLE IF EXISTS `customer_payment`;
CREATE TABLE `customer_payment` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `dep_id` smallint(4) NOT NULL,
  `dep_name` varchar(200) NOT NULL,
  `dep_parent` smallint(4) NOT NULL,
  `title` varchar(10) NOT NULL,
  `dep_title` varchar(200) NOT NULL,
  `id_del` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `dep_name`, `dep_parent`, `title`, `dep_title`, `id_del`) VALUES
(1, 'สำนักงานคณะ', 0, 'eng', 'สำนักงานคณะ', NULL),
(2, 'งานบริการการศึกษา', 1, 'ES', 'งานบริการการศึกษา', NULL),
(6, 'งานบริหารงานวิจัยฯ', 1, 'RI', 'งานวิจัยฯ', NULL),
(7, 'งานนโยบายและแผน', 1, 'PP', 'งานนโยบายและแผน', NULL),
(8, 'งานบริหารทั่วไป', 1, 'AD', 'งานบริหารทั่วไป', NULL),
(13, 'งานการเงินการคลังและพัสดุ', 1, 'FS', 'งานการเงินการคลังและพัสดุ', NULL),
(14, 'ภาควิชาวิศวกรรมคอมพิวเตอร์', 0, '', 'ภาควิชาคอมพิวเตอร์', NULL),
(15, 'ภาควิชาวิศวกรรมเครื่องกล', 0, '', 'ภาควิชาเครื่องกล', NULL),
(16, 'ภาควิชาวิศวกรรมไฟฟ้า', 0, '', 'ภาควิชาไฟฟ้า', NULL),
(17, 'ภาควิชาวิศวกรรมโยธา', 0, '', 'ภาควิชาโยธา', NULL),
(18, 'ภาควิชาวิศวกรรมสิ่งแวดล้อม', 0, '', 'ภาควิชาสิ่งแวดล้อม', NULL),
(19, 'ภาควิชาวิศวกรรมเหมืองแร่', 0, '', 'ภาควิชาเหมืองแร่', NULL),
(20, 'ภาควิชาวิศวกรรมอุตสาหการ', 0, '', 'ภาควิชาอุตสาหการ', NULL),
(21, 'ศูนย์วิศวกรรมชีวการแพทย์', 0, '', 'ศูนย์วิศวกรรมชีวการแพทย์', NULL),
(22, 'เงินบริจาค-ทุนการศึกษา', 0, '', 'เงินบริจาค-ทุนการศึกษา', NULL),
(23, 'เงินบริจาค-สนับสนุนการศึกษา', 0, '', 'เงินบริจาค-สนับสนุนการศึกษา', NULL),
(24, 'เงินบริจาค-New Campus', 0, '', 'เงินบริจาค-New Campus', NULL),
(25, 'เงินบริจาค-สโมสรนักศึกษา', 0, '', 'เงินบริจาค-สโมสรนักศึกษา', NULL),
(26, 'เงินบริจาค-อื่นๆ', 0, '', 'เงินบริจาค-อื่นๆ', NULL),
(27, 'สาขาวิทยาการข้อมูล', 0, 'DS', 'สาขาวิทยาการข้อมูล', NULL),
(32, 'Entaneer Academy', 0, '', 'Entaneer Academy', NULL),
(28, 'งานพัฒนาคุณภาพนักศึกษา', 1, '', 'งานพัฒนาคุณภาพนักศึกษา', NULL),
(30, 'หลักสูตรวิศวกรรมหุ่นยนต์ฯ', 0, '', 'หลักสูตรวิศวกรรมหุ่นยนต์ฯ', NULL),
(29, 'งานพัฒนาเทคโนโลยีฯ', 1, '', 'งานพัฒนาเทคโนโลยีฯ', NULL),
(31, 'ศูนย์การศึกษานานาชาติฯ', 0, '', 'ศูนย์การศึกษานานาชาติฯ', NULL),
(34, 'วิศวกรรมบูรณาการ', 0, 'IGE', 'วิศวกรรมบูรณาการ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `address`, `mobile`, `created_at`, `updated_at`) VALUES
(1, 'Suttipong', 'CMU', '0898351335', '2024-06-18 00:49:13', '2024-06-18 00:49:13'),
(2, 'AOD', 'Eng', '0991406262', '2024-06-18 00:51:12', '2024-06-18 00:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listdays`
--

DROP TABLE IF EXISTS `listdays`;
CREATE TABLE `listdays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dayTitle` varchar(255) DEFAULT NULL,
  `dayList` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listdays`
--

INSERT INTO `listdays` (`id`, `dayTitle`, `dayList`, `created_at`, `updated_at`) VALUES
(1, 'Mo', 'Mon', NULL, NULL),
(2, 'Tu', 'Tue', NULL, NULL),
(3, 'We', 'Wed', NULL, NULL),
(4, 'Th', 'Thu', NULL, NULL),
(5, 'Fr', 'Fri', NULL, NULL),
(6, 'Sa', 'Sat', NULL, NULL),
(7, 'Su', 'Sun', NULL, NULL),
(8, 'MTU', 'Mon,Tue', NULL, NULL),
(9, 'MWe', 'Mon,Wed', NULL, NULL),
(10, 'MTh', 'Mon,Thu', NULL, NULL),
(11, 'MF', 'Mon,Fri', NULL, NULL),
(12, 'Msa', 'Mon,Sat', NULL, NULL),
(13, 'Msu', 'Mon,Sun', NULL, NULL),
(14, 'TuW', 'Tue,Wed', NULL, NULL),
(15, 'TuTh', 'Tue,Thu', NULL, NULL),
(16, 'TuF', 'Tue,Fri', NULL, NULL),
(17, 'TuSa', 'Tue,Sat', NULL, NULL),
(18, 'TuSu', 'Tue,Sun', NULL, NULL),
(19, 'WTh', 'Wed,Thu', NULL, NULL),
(20, 'WF', 'Wed,Fri', NULL, NULL),
(21, 'WSa', 'Wed,Sat', NULL, NULL),
(22, 'WSa', 'Wed,Sun', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_06_22_155543_create_rooms_table', 1),
(6, '2024_06_22_155638_room_type_table', 1),
(7, '2024_06_22_155805_create_place_table', 1),
(9, '2024_06_22_155916_create_cmu_oauth_table', 1),
(11, '2024_06_22_155945_create_booking_rooms_table', 2),
(13, '2014_10_12_000000_create_users_table', 3),
(14, '2024_07_01_063309_create_booking_assigns_table', 4),
(15, '2024_07_02_063122_create_schedule_table', 5),
(16, '2024_07_02_075802_create_room_schedules_table', 6),
(17, '2024_07_10_062357_create_listdays_table', 7),
(18, '2024_07_11_144023_create_room_galleries_table', 8),
(19, '2024_07_22_165242_create_admin_roooms_table', 9),
(20, '2024_06_22_155841_create_customer_payment_table', 10),
(22, '2024_07_31_055013_create_payments_table', 11);


DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customerToken` varchar(100) DEFAULT NULL,
  `urlPayment` varchar(150) DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `customerToken`, `urlPayment`, `bookingID`, `customerName`, `customerEmail`, `customerPhone`, `organization`, `customerTaxid`, `customerAddress`, `totalAmount`, `payment_status`, `is_confirm`, `payment_date`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 26, 'สุทธิพงค์ ริโปนยอง', 'stimulus.ad@gmail.com', '', NULL, '1858484646', '10010', 1000.00, 0, 0, NULL, '2024-08-04 22:11:08', '2024-08-04 22:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
CREATE TABLE `place` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `placeName` varchar(254) NOT NULL,
  `decription` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`id`, `placeName`, `decription`, `created_at`, `updated_at`) VALUES
(1, 'อาคาร 30 ปี', NULL, NULL, NULL),
(2, 'อาคาร RTT', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `roomToken`, `roomFullName`, `roomTitle`, `roomSize`, `roomTypeId`, `placeId`, `thumbnail`, `roomDetail`, `is_open`, `is_status`, `room_admin_email`, `room_price`, `room_wh`, `room_itemlist`, `created_at`, `updated_at`) VALUES
(1, '', 'ห้องประชุมสำนักงานคณบดี (ห้องกระจก)', NULL, '7', 1, 1, '1719204526.jpg', 'สำนักงานคณบดี ชั้น 6 อาคาร 30 ปี', 0, 0, NULL, 0, NULL, NULL, NULL, '2024-06-23 21:50:41'),
(2, '', 'ห้องประชุมตียาภรณ์', NULL, '15', 1, 1, '1719204497.jpg', 'สำนักงานเลขานุการ ชั้น 6 อาคาร 30 ปี', 1, 0, NULL, 0, NULL, NULL, NULL, '2024-06-23 21:48:18'),
(3, '', 'ห้องประชุม 2', NULL, '80', 1, 1, '1719204467.jpg', 'สำนักงานเลขานุการ ชั้น 7 อาคาร 30 ปี', 1, 0, NULL, 0, NULL, NULL, NULL, '2024-06-23 21:47:47'),
(4, '', 'ห้องประชุม 3', NULL, '20', 1, 1, '1719204439.jpg', 'สำนักงานเลขานุการ ชั้น 7 อาคาร 30 ปี', 1, 0, NULL, 0, NULL, NULL, NULL, '2024-06-23 21:47:19'),
(5, '', 'ห้องประชุม 4', NULL, '80', 1, 1, '1719204424.jpg', 'สำนักงานเลขานุการ ชั้น 7 อาคาร 30 ปี (สามารถใช้เป็นห้องรับประทานอาหารได้)', 1, 0, NULL, 0, NULL, NULL, NULL, '2024-06-23 21:47:04'),
(6, '', 'ห้องประชุมสำนักงานคณะ (ข้างห้อง วสท.1)', NULL, '10', 1, 1, '1719204404.jpg', 'ห้องประชุมสำนักงานคณะ ชั้น 6 อาคาร 30 ปี', 1, 0, NULL, 0, NULL, NULL, NULL, '2024-06-23 21:46:44'),
(7, '', 'หอเกียรติยศ', NULL, '15', 1, 1, '1719204384.jpg', 'หอเกียรติยศ ชั้น 6 อาคาร 30 ปี', 0, 0, NULL, 0, NULL, NULL, NULL, '2024-06-23 21:46:24'),
(8, '', 'ห้องคอมพิวเตอร์ 314', 'Lab314', '50', 2, 1, '1719222208.jpg', 'ชั้น 3 อาคาร 30 ปี', 1, 0, NULL, 0, NULL, NULL, NULL, '2024-06-29 22:34:16'),
(9, 'c0c04d3ac5d0184fc44530ae51824e2f', 'Lab303', '303', '12', 2, 1, '1719898298.jpg', '123456', 1, 0, NULL, 0, NULL, NULL, '2024-06-24 22:21:42', '2024-07-01 22:31:38'),
(10, '7158d436dd44018bfd3ed1a7ffeb0c22', 'ห้องเรียน 2-404', 'ห้องเรียน2-404', '50', 2, 1, '1719898272.jpg', NULL, 1, 0, NULL, 0, '1*1', '4,5,7,9', '2024-06-30 00:32:55', '2024-07-27 08:33:00'),
(11, '369b2c11ca3249180d4e9b22c016f697', 'ห้องเรียน 3-312', 'ห้องเรียน3-312', '80', 3, 1, '1719898240.jpg', 'ห้องคอมพิวเตอร์', 1, 0, NULL, 0, '200*200', '1,3,4,6,8,9', '2024-07-01 22:30:40', '2024-07-27 08:12:25'),
(13, '2763a1500aee412083462d7ca48a6cef', 'ห้องประชุมRtt3', 'ห้องประชุมRtt3', '40', 1, 2, '1722096613.jpg', NULL, 1, 0, NULL, 0, NULL, '1,4,5,7', '2024-07-27 09:09:13', '2024-07-27 09:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `room_galleries`
--

DROP TABLE IF EXISTS `room_galleries`;
CREATE TABLE `room_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roomID` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_items`
--

DROP TABLE IF EXISTS `room_items`;
CREATE TABLE `room_items` (
  `id` smallint(4) NOT NULL,
  `item_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_items`
--

INSERT INTO `room_items` (`id`, `item_name`) VALUES
(1, 'เครื่องเสียง'),
(2, 'คอมพิวเตอร์อาจารย์'),
(3, 'คอมพิวเตอร์นักศึกษา'),
(4, 'โปรเจคเตอร์'),
(5, 'ทีวี'),
(6, 'พัดลม'),
(7, 'เครื่องปรับอากาศ'),
(8, 'กระดาน'),
(9, 'Scinet');

-- --------------------------------------------------------

--
-- Table structure for table `room_schedules`
--

DROP TABLE IF EXISTS `room_schedules`;
CREATE TABLE `room_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_schedules`
--

INSERT INTO `room_schedules` (`id`, `courseNO`, `courseTitle`, `courseSec`, `Stdamount`, `schedule_startdate`, `schedule_enddate`, `booking_time_start`, `booking_time_finish`, `roomNo`, `roomID`, `lecturer`, `description`, `is_confirm`, `admin_confirm`, `is_confirm_date`, `admin_confirm_date`, `staffupdated`, `straff_account`, `schedule_repeatday`, `courseofyear`, `terms`, `is_import_excel`, `is_duplicate`, `created_at`, `updated_at`) VALUES
(2, 'MAth01', 'COMAWE01', '1', 55, '2024-07-03', '2024-07-27', '08:30:00', '10:00:00', NULL, 9, 'TESC2', '213', 0, 0, NULL, NULL, NULL, 'suttipong.r@cmu.ac.th', 'We', '2567', 1, 0, 0, '2024-07-02 02:57:52', '2024-07-03 02:19:24'),
(4, 'C3055', 'HTML5', '1', 100, '2024-07-05', '2024-09-30', '13:00:00', '14:30:00', NULL, 8, 'TESCA', 'test', 0, 0, NULL, NULL, NULL, 'suttipong.r@cmu.ac.th', 'TuF', '2567', 1, 0, 0, '2024-07-03 02:15:22', '2024-07-03 02:15:22'),
(67, 'C30221', 'COMAWE', '002', 50, '2024-07-01', '2024-07-24', '16:00:00', '19:30:00', NULL, 11, 'Aod', 'ทดสอบ', 0, 0, NULL, NULL, NULL, 'suttipong.r@cmu.ac.th', 'Tu', '2567', 1, 0, 0, '2024-07-07 22:51:26', '2024-07-07 22:53:00'),
(68, '254182', 'Introdution to Engergy', '001', 10, '2024-07-01', '2024-10-31', '13:00:00', '14:30:00', '2-404', 10, 'ผ.ศ.ดร.เก่งกมล วิรัตน์เกษม', NULL, 0, 0, NULL, NULL, NULL, 'suttipong.r@cmu.ac.th', 'TuF', '2567', 1, 1, 0, '2024-07-08 01:22:32', '2024-07-08 01:22:32'),
(69, '254182', 'Introdution to Engergy', '801', 14, '2024-07-01', '2024-10-31', '13:00:00', '14:20:00', '2-404', 10, 'ผ.ศ.ดร.เก่งกมล วิรัตน์เกษม', NULL, 0, 0, NULL, NULL, NULL, 'suttipong.r@cmu.ac.th', 'MTh', '2567', 1, 1, 0, '2024-07-08 01:22:32', '2024-07-08 01:22:32'),
(70, '254184', 'Prot tech For inddes', '001', 34, '2024-07-01', '2024-10-31', '09:30:00', '12:30:00', 'lab314', 8, 'ผ.ศ.ดร.เวชยันต์ รางศรี', 'ขอห้อง', 0, 0, NULL, NULL, NULL, 'suttipong.r@cmu.ac.th', 'Mo', '2567', 1, 1, 0, '2024-07-08 01:22:32', '2024-07-08 01:22:32'),
(71, '12321', 'rwerwerw', '001', 1000, '2024-07-01', '2024-10-31', '10:30:00', '11:03:11', 'lab314', 8, 'AA', NULL, 0, 0, NULL, NULL, NULL, 'suttipong.r@cmu.ac.th', 'Mo', '2567', 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

DROP TABLE IF EXISTS `room_type`;
CREATE TABLE `room_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roomtypeName` varchar(200) NOT NULL,
  `decription` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id`, `roomtypeName`, `decription`, `created_at`, `updated_at`) VALUES
(1, 'ห้องประชุม', NULL, NULL, NULL),
(2, 'ห้องเรียน', NULL, NULL, NULL),
(3, 'ห้องคอมพิวเตอร์', NULL, NULL, NULL),
(4, 'ห้องสโลบ', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE `schedule` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_apikey`
--

DROP TABLE IF EXISTS `tbl_apikey`;
CREATE TABLE `tbl_apikey` (
  `id` smallint(4) NOT NULL,
  `apiweb` varchar(10) DEFAULT NULL,
  `clientID` varchar(50) DEFAULT NULL,
  `clientSecret` varchar(50) DEFAULT NULL,
  `description` varchar(254) DEFAULT NULL,
  `redirect_uri` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_apikey`
--

INSERT INTO `tbl_apikey` (`id`, `apiweb`, `clientID`, `clientSecret`, `description`, `redirect_uri`) VALUES
(1, 'cmuoauth', 'nP2KgMxA05UV7VAq4uhQMDGN2xNfqhpjNbzZeQqM', 'U6bZTJ81TZnnUgPUgqTW9skTSKg5wNjreH6RCT4u', 'oauth.cmu.ac.th', 'http://127.0.0.1:8000/callback_booking');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--
-- Error reading structure for table eroombook.tbl_customer: #1932 - Table 'eroombook.tbl_customer' doesn't exist in engine
-- Error reading data for table eroombook.tbl_customer: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `eroombook`.`tbl_customer`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members`
--

DROP TABLE IF EXISTS `tbl_members`;
CREATE TABLE `tbl_members` (
  `user_id` int(4) NOT NULL,
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
  `lineToken` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_members`
--

INSERT INTO `tbl_members` (`user_id`, `username`, `password`, `fname`, `lname`, `is_dean`, `position_work`, `position`, `email`, `tel`, `img`, `Ulevel`, `tmp_pass`, `cmuitaccount`, `cmuitaccount_name`, `prename_TH`, `firstname_TH`, `lastname_TH`, `itaccounttype_id`, `itaccounttype_TH`, `groupId`, `dep_id`, `is_manage_sequence`, `is_finance`, `is_step_flow`, `is_step_secretary`, `is_step_dean`, `typeposition_id`, `is_step_plan`, `lineToken`) VALUES
(1, '', '', 'อัฐนันต์', 'วรรณชัย', 0, 'อาจารย์ ดร.', '', 'autanan.w@cmu.ac.th', '', '', 0, NULL, 'autanan.w@cmu.ac.th', NULL, 'นาย', 'อัฐนันต์', 'วรรณชัย', NULL, NULL, 0, 35, 0, 0, 0, 0, 0, 1, 0, NULL),
(2, '', '', 'นรพนธ์', 'วิเชียรสาร', 0, 'อาจารย์ ดร.', '', 'norrapon.v@cmu.ac.th', '', '', 0, NULL, 'norrapon.v@cmu.ac.th', NULL, 'นาย', 'นรพนธ์', 'วิเชียรสาร', NULL, NULL, 0, 35, 0, 0, 0, 0, 0, 1, 0, NULL),
(3, '', '', 'กิตติยา', 'ทุ่นศิริ', 0, 'อาจารย์ ดร.', '', 'kittiya.thunsiri@cmu.ac.th', '', '', 0, NULL, 'kittiya.thunsiri@cmu.ac.th', NULL, 'นางสาว', 'กิตติยา', 'ทุ่นศิริ', NULL, NULL, 0, 35, 0, 0, 0, 0, 0, 1, 0, NULL),
(4, '', '', 'วิชัย', 'ฉัตรทินวัฒน์', 0, 'รองศาสตราจารย์', '', 'wichai.chattinnawat@cmu.ac.th', '', '', 0, NULL, 'wichai.chattinnawat@cmu.ac.th', NULL, 'นาย', 'วิชัย', 'ฉัตรทินวัฒน์', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(5, '', '', 'อรรฆพจน์', 'วงศ์พึ่งไชย', 0, 'อาจารย์', '', 'akkapoj.w@cmu.ac.th', '', '', 0, NULL, 'akkapoj.w@cmu.ac.th', NULL, 'นาย', 'อรรฆพจน์', 'วงศ์พึ่งไชย', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(6, '', '', 'ณรงค์', 'เพชรชารี', 0, 'อาจารย์', '', 'narong.petcharee@cmu.ac.th', '', '', 0, NULL, 'narong.petcharee@cmu.ac.th', NULL, 'นาย', 'ณรงค์', 'เพชรชารี', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(7, '', '', 'ฐากร', 'โอภาสสุวรรณ', 0, 'อาจารย์ ดร.', '', 'takron.op@cmu.ac.th', '', '', 0, NULL, 'takron.op@cmu.ac.th', NULL, 'นาย', 'ฐากร', 'โอภาสสุวรรณ', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(8, '', '', 'ภวิกา', 'มงคลกิจทวีผล', 0, 'อาจารย์ ดร.', '', 'phavika.m@cmu.ac.th', '', '', 0, NULL, 'phavika.m@cmu.ac.th', NULL, 'นางสาว', 'ภวิกา', 'มงคลกิจทวีผล', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(9, '', '', 'โพธิ', 'จ้าวไพศาล', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'poti.chao@cmu.ac.th', '', '', 0, NULL, 'poti.chao@cmu.ac.th', NULL, 'นาย', 'โพธิ', 'จ้าวไพศาล', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(10, '', '', 'ทินกร', 'ปงธิยา', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'tinnakorn.phongthiya@cmu.ac.th', '', '', 0, NULL, 'tinnakorn.phongthiya@cmu.ac.th', NULL, 'นาย', 'ทินกร', 'ปงธิยา', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(11, '', '', 'นิวิท', 'เจริญใจ', 0, 'รองศาสตราจารย์', '', 'nivit.c@cmu.ac.th', '', '', 0, NULL, 'nivit.c@cmu.ac.th', NULL, 'นาย', 'นิวิท', 'เจริญใจ', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(12, '', '', 'พงษ์สวัสดิ์', 'เปรมเพ็ชร', 0, 'อาจารย์ ดร.', '', 'pongsawat.p@cmu.ac.th', '', '', 0, NULL, 'pongsawat.p@cmu.ac.th', NULL, 'นาย', 'พงษ์สวัสดิ์', 'เปรมเพ็ชร', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(13, '', '', 'สาลินี', 'สันติธีรากุล', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'salinee.s@cmu.ac.th', '', '', 0, NULL, 'salinee.s@cmu.ac.th', NULL, 'นางสาว', 'สาลินี', 'สันติธีรากุล', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(14, '', '', 'อภิชาต', 'โสภาแดง', 0, 'รองศาสตราจารย์', '', 'apichat.s@cmu.ac.th', '', '', 0, NULL, 'apichat.s@cmu.ac.th', NULL, 'นาย', 'อภิชาต', 'โสภาแดง', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(15, '', '', 'ชนม์เจริญ', 'แสวงรัตน์', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'choncharoen.s@cmu.ac.th', '', '', 0, NULL, 'choncharoen.s@cmu.ac.th', NULL, 'นาย', 'ชนม์เจริญ', 'แสวงรัตน์', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(16, '', '', 'นิรันดร์', 'พิสุทธอานนท์', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'nirand.p@cmu.ac.th', '', '', 0, NULL, 'nirand.p@cmu.ac.th', NULL, 'นาย', 'นิรันดร์', 'พิสุทธอานนท์', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(17, '', '', 'อรรถพล', 'สมุทคุปติ์', 1, 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', 'uttapol.s@cmu.ac.th', '', '', 0, NULL, 'uttapol.s@cmu.ac.th', NULL, 'นาย', 'อรรถพล', 'สมุทคุปติ์', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(18, '', '', 'วิมลิน สุขถมยา', 'เหล่าศิริถาวร', 0, 'รองศาสตราจารย์', '', 'wimalin.l@cmu.ac.th', '', '', 0, NULL, 'wimalin.l@cmu.ac.th', NULL, 'นาง', 'วิมลิน สุขถมยา', 'เหล่าศิริถาวร', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(19, '', '', 'อนิรุท', 'ไชยจารุวณิช', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'anirut.c@cmu.ac.th', '', '', 0, NULL, 'anirut.c@cmu.ac.th', NULL, 'นาย', 'อนิรุท', 'ไชยจารุวณิช', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(20, '', '', 'รัฐพล', 'ปิ่นนราทิพย์', 0, 'อาจารย์ ดร.', '', 'rattapol.pinn@cmu.ac.th', '', '', 0, NULL, 'rattapol.pinn@cmu.ac.th', NULL, 'นาย', 'รัฐพล', 'ปิ่นนราทิพย์', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(21, '', '', 'วัสสนัย', 'วรรธนัจฉริยา', 1, 'รองศาสตราจารย์', 'ผู้ช่วยคณบดี', 'wassanai.w@cmu.ac.th', '', '', 0, NULL, 'wassanai.w@cmu.ac.th', NULL, 'นาย', 'วัสสนัย', 'วรรธนัจฉริยา', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(22, '', '', 'วสวัชร', 'นาคเขียว', 1, 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมอุตสาหการ', 'wasawat.n@cmu.ac.th', '', '', 0, NULL, 'wasawat.n@cmu.ac.th', NULL, 'นาย', 'วสวัชร', 'นาคเขียว', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(23, '', '', 'อดิเรก', 'ใบสุขันธ์', 0, 'อาจารย์ ดร.', '', 'adirek.b@cmu.ac.th', '', '', 0, NULL, 'adirek.b@cmu.ac.th', NULL, 'นาย', 'อดิเรก', 'ใบสุขันธ์', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(24, '', '', 'วริษา', 'นาคเขียว', 0, 'รองศาสตราจารย์', '', 'warisa.w@cmu.ac.th', '', '', 0, NULL, 'warisa.w@cmu.ac.th', NULL, 'นาง', 'วริษา', 'นาคเขียว', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(25, '', '', 'ชมพูนุท', 'เกษมเศรษฐ์', 0, 'รองศาสตราจารย์', '', 'chompoonoot.kasemset@cmu.ac.th', '', '', 0, NULL, 'chompoonoot.kasemset@cmu.ac.th', NULL, 'นางสาว', 'ชมพูนุท', 'เกษมเศรษฐ์', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(26, '', '', 'รุ่งฉัตร', 'ชมภูอินไหว', 0, 'รองศาสตราจารย์ ดร.', '', 'rungchat.chompu@cmu.ac.th', '', '', 0, NULL, 'rungchat.chompu@cmu.ac.th', NULL, 'นางสาว', 'รุ่งฉัตร', 'ชมภูอินไหว', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(27, '', '', 'วรพจน์', 'เสรีรัฐ', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'worapod.s@cmu.ac.th', '', '', 0, NULL, 'worapod.s@cmu.ac.th', NULL, 'นาย', 'วรพจน์', 'เสรีรัฐ', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(28, '', '', 'กรกฎ ใยบัวเทศ', 'ทิพยาวงศ์', 1, 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 'korrakot.t@cmu.ac.th', '', '', 0, NULL, 'korrakot.t@cmu.ac.th', NULL, 'นาง', 'กรกฎ ใยบัวเทศ', 'ทิพยาวงศ์', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(29, '', '', 'วาปี', 'มโนภินิเวศ', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'wapee.m@cmu.ac.th', '', '', 0, NULL, 'wapee.m@cmu.ac.th', NULL, 'นางสาว', 'วาปี', 'มโนภินิเวศ', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(30, '', '', 'ศักดิ์เกษม', 'ระมิงค์วงศ์', 0, 'รองศาสตราจารย์ ดร.', '', 'sakgasem.ramingwong@cmu.ac.th', '', '', 0, NULL, 'sakgasem.ramingwong@cmu.ac.th', NULL, 'นาย', 'ศักดิ์เกษม', 'ระมิงค์วงศ์', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(31, '', '', 'คมกฤต', 'เล็กสกุล', 0, 'รองศาสตราจารย์ ดร.', '', 'komgrit.lek@cmu.ac.th', '', '', 0, NULL, 'komgrit.lek@cmu.ac.th', NULL, 'นาย', 'คมกฤต', 'เล็กสกุล', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(32, '', '', 'เศรษฐ์', 'สัมภัตตะกุล', 0, 'รองศาสตราจารย์ ดร.', '', 'sate.s@cmu.ac.th', '', '', 0, NULL, 'sate.s@cmu.ac.th', NULL, 'นาย', 'เศรษฐ์', 'สัมภัตตะกุล', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(33, '', '', 'อลงกต ลิ้มเจริญ', 'แก้วโชติช่วงกูล', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'alonggot.l@cmu.ac.th', '', '', 0, NULL, 'alonggot.l@cmu.ac.th', NULL, 'นาง', 'อลงกต ลิ้มเจริญ', 'แก้วโชติช่วงกูล', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(34, '', '', 'ธัญญานุภาพ', 'อานันทนะ', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'tanyanuparb.a@cmu.ac.th', '', '', 0, NULL, 'tanyanuparb.a@cmu.ac.th', NULL, 'นาย', 'ธัญญานุภาพ', 'อานันทนะ', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(35, '', '', 'ชวิศ', 'บุญมี', 0, 'รองศาสตราจารย์ ดร.', '', 'chawis.boonmee@cmu.ac.th', '', '', 0, NULL, 'chawis.boonmee@cmu.ac.th', NULL, 'นาย', 'ชวิศ', 'บุญมี', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(36, '', '', 'พริม', 'ฟองสมุทร', 0, 'อาจารย์ผู้ช่วย', '', 'prim.fong@cmu.ac.th', '', '', 0, NULL, 'prim.fong@cmu.ac.th', NULL, 'นางสาว', 'พริม', 'ฟองสมุทร', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(37, '', '', 'เจณชวิศ', 'เจริญใจ', 0, 'อาจารย์ผู้ช่วย', '', 'jenschwich.c@cmu.ac.th', '', '', 0, NULL, 'jenschwich.c@cmu.ac.th', NULL, 'นาย', 'เจณชวิศ', 'เจริญใจ', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 1, 0, NULL),
(38, '', '', 'ณัฐนันท์', 'พรหมสุข', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'natthanan.p@cmu.ac.th', '', '', 0, NULL, 'natthanan.p@cmu.ac.th', NULL, 'นาย', 'ณัฐนันท์', 'พรหมสุข', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(39, '', '', 'กำพล', 'วรดิษฐ์', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'kampol.w@cmu.ac.th', '', '', 0, NULL, 'kampol.w@cmu.ac.th', NULL, 'นาย', 'กำพล', 'วรดิษฐ์', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(40, '', '', 'ลัชนา', 'ระมิงค์วงศ์', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'lachana.ramingwong@cmu.ac.th', '', '', 0, NULL, 'lachana.ramingwong@cmu.ac.th', NULL, 'นาง', 'ลัชนา', 'ระมิงค์วงศ์', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(41, '', '', 'ยุทธพงษ์', 'สมจิต', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'yuthapong.somchit@cmu.ac.th', '', '', 0, NULL, 'yuthapong.somchit@cmu.ac.th', NULL, 'นาย', 'ยุทธพงษ์', 'สมจิต', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(42, '', '', 'นริศรา', 'เอี่ยมคณิตชาติ', 0, 'รองศาสตราจารย์ ดร.', '', 'narissara.e@cmu.ac.th', '', '', 0, NULL, 'narissara.e@cmu.ac.th', NULL, 'นางสาว', 'นริศรา', 'เอี่ยมคณิตชาติ', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(43, '', '', 'ศันสนีย์', 'เอื้อพันธ์วิริยะกุล', 0, 'รองศาสตราจารย์ ดร.', '', 'sansanee.a@cmu.ac.th', '', '', 0, NULL, 'sansanee.a@cmu.ac.th', NULL, 'นางสาว', 'ศันสนีย์', 'เอื้อพันธ์วิริยะกุล', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(44, '', '', 'สรรพวรรธน์', 'กันตะบุตร', 0, 'รองศาสตราจารย์ ดร.', '', 'sanpawat.k@cmu.ac.th', '', '', 0, NULL, 'sanpawat.k@cmu.ac.th', NULL, 'นาย', 'สรรพวรรธน์', 'กันตะบุตร', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(45, '', '', 'นษิ', 'ตันติธารานุกุล', 0, 'อาจารย์ ดร.', '', 'nasi.t@cmu.ac.th', '', '', 0, NULL, 'nasi.t@cmu.ac.th', NULL, 'นาย', 'นษิ', 'ตันติธารานุกุล', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(46, '', '', 'กานต์', 'ปทานุคม', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'karn.patanukhom@cmu.ac.th', '', '', 0, NULL, 'karn.patanukhom@cmu.ac.th', NULL, 'นาย', 'กานต์', 'ปทานุคม', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(47, '', '', 'ศศิน', 'จันทร์พวงทอง', 0, 'อาจารย์ ดร.', '', 'sasin.ja@cmu.ac.th', '', '', 0, NULL, 'sasin.ja@cmu.ac.th', NULL, 'นาย', 'ศศิน', 'จันทร์พวงทอง', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(48, '', '', 'ปฏิเวธ', 'วุฒิสารวัฒนา', 0, 'รองศาสตราจารย์ ดร.', '', 'patiwet.w@cmu.ac.th', '', '', 0, NULL, 'patiwet.w@cmu.ac.th', NULL, 'นาย', 'ปฏิเวธ', 'วุฒิสารวัฒนา', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(49, '', '', 'อัญญา อาภาวัชรุตม์', 'วีรประพันธ์', 0, 'รองศาสตราจารย์ ดร.', '', 'anya.a@cmu.ac.th', '', '', 0, NULL, 'anya.a@cmu.ac.th', NULL, 'นาง', 'อัญญา อาภาวัชรุตม์', 'วีรประพันธ์', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(50, '', '', 'ภาสกร', 'แช่มประเสริฐ', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'paskorn.c@cmu.ac.th', '', '', 0, NULL, 'paskorn.c@cmu.ac.th', NULL, 'นาย', 'ภาสกร', 'แช่มประเสริฐ', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(51, '', '', 'นวดนย์', 'คุณเลิศกิจ', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'navadon.k@cmu.ac.th', '', '', 0, NULL, 'navadon.k@cmu.ac.th', NULL, 'นาย', 'นวดนย์', 'คุณเลิศกิจ', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(52, '', '', 'ชินวัตร', 'อิศราดิสัยกุล', 0, 'อาจารย์ ดร.', '', 'chinawat.i@cmu.ac.th', '', '', 0, NULL, 'chinawat.i@cmu.ac.th', NULL, 'นาย', 'ชินวัตร', 'อิศราดิสัยกุล', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(53, '', '', 'กนก', 'ก๋องหล้า', 0, 'อาจารย์', '', 'kanok.k@cmu.ac.th', '', '', 0, NULL, 'kanok.k@cmu.ac.th', NULL, 'นาย', 'กนก', 'ก๋องหล้า', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(54, '', '', 'เกษมสิทธิ์', 'ตียพันธ์', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'kasemsit.t@cmu.ac.th', '', '', 0, NULL, 'kasemsit.t@cmu.ac.th', NULL, 'นาย', 'เกษมสิทธิ์', 'ตียพันธ์', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(55, '', '', 'ตรัสพงศ์', 'ไทยอุปถัมภ์', 0, 'รองศาสตราจารย์ ดร.', '', 'trasapong.t@cmu.ac.th', '', '', 0, NULL, 'trasapong.t@cmu.ac.th', NULL, 'นาย', 'ตรัสพงศ์', 'ไทยอุปถัมภ์', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(56, '', '', 'อานันท์', 'สีห์พิทักษ์เกียรติ', 0, 'อาจารย์ ดร.', '', 'arnan.s@cmu.ac.th', '', '', 0, NULL, 'arnan.s@cmu.ac.th', NULL, 'นาย', 'อานันท์', 'สีห์พิทักษ์เกียรติ', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(57, '', '', 'ธนาทิพย์', 'จันทร์คง', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'thanatip.ch@cmu.ac.th', '', '', 0, NULL, 'thanatip.ch@cmu.ac.th', NULL, 'นางสาว', 'ธนาทิพย์', 'จันทร์คง', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(58, '', '', 'พฤษภ์', 'บุญมา', 1, 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', 'pruet.b@cmu.ac.th', '', '', 0, NULL, 'pruet.b@cmu.ac.th', NULL, 'นาย', 'พฤษภ์', 'บุญมา', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(59, '', '', 'ศักดิ์กษิต', 'ระมิงค์วงศ์', 0, 'รองศาสตราจารย์ ดร.', '', 'sakgasit.ramingwong@cmu.ac.th', '', '', 0, NULL, 'sakgasit.ramingwong@cmu.ac.th', NULL, 'นาย', 'ศักดิ์กษิต', 'ระมิงค์วงศ์', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(60, '', '', 'จักรพงศ์', 'นาทวิชัย', 0, 'รองศาสตราจารย์ ดร.', '', 'juggapong.n@cmu.ac.th', '', '', 0, NULL, 'juggapong.n@cmu.ac.th', NULL, 'นาย', 'จักรพงศ์', 'นาทวิชัย', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(61, '', '', 'Kenneth  John', 'Cosh', 0, 'รองศาสตราจารย์ ดร.', '', 'kenneth.c@cmu.ac.th', '', '', 0, NULL, 'kenneth.c@cmu.ac.th', NULL, 'นาย', 'Kenneth  John', 'Cosh', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(62, '', '', 'โดม', 'โพธิกานนท์', 0, 'ผู้ช่วยศาสตราจารย์', '', 'dome.potikanond@cmu.ac.th', '', '', 0, NULL, 'dome.potikanond@cmu.ac.th', NULL, 'นาย', 'โดม', 'โพธิกานนท์', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(63, '', '', 'สันติ', 'พิทักษ์กิจนุกูร', 1, 'รองศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมคอมพิวเตอร์', 'santi.p@cmu.ac.th', '', '', 0, NULL, 'santi.p@cmu.ac.th', NULL, 'นาย', 'สันติ', 'พิทักษ์กิจนุกูร', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(64, '', '', 'เจนจิรา ', 'ใจมั่ง  ', 0, 'อาจารย์ ดร.', '', ' jenjira.j@cmu.ac.th', '', '', 0, NULL, ' jenjira.j@cmu.ac.th', NULL, 'นางสาว', 'เจนจิรา ', 'ใจมั่ง  ', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 1, 0, NULL),
(65, '', '', 'วงกต', 'วงศ์อภัย', 0, 'รองศาสตราจารย์', '', 'wongkot.w@cmu.ac.th', '', '', 0, NULL, 'wongkot.w@cmu.ac.th', NULL, 'นาย', 'วงกต', 'วงศ์อภัย', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(66, '', '', 'ขจรเดช', 'พิมพ์พิไล', 0, 'อาจารย์', '', 'kajorndej.p@cmu.ac.th', '', '', 0, NULL, 'kajorndej.p@cmu.ac.th', NULL, 'นาย', 'ขจรเดช', 'พิมพ์พิไล', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(67, '', '', 'มานะ', 'แซ่ด่าน', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'mana.saedan@cmu.ac.th', '', '', 0, NULL, 'mana.saedan@cmu.ac.th', NULL, 'นาย', 'มานะ', 'แซ่ด่าน', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(68, '', '', 'ยศธนา', 'คุณาทร', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'yottana.k@cmu.ac.th', '', '', 0, NULL, 'yottana.k@cmu.ac.th', NULL, 'นาย', 'ยศธนา', 'คุณาทร', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(69, '', '', 'อารีย์', 'อัจฉริยวิริยะ', 0, 'รองศาสตราจารย์ ดร.', '', 'aree.a@cmu.ac.th', '', '', 0, NULL, 'aree.a@cmu.ac.th', NULL, 'นาง', 'อารีย์', 'อัจฉริยวิริยะ', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(70, '', '', 'สมชาย', 'พัฒนา', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'somchai.pattana@cmu.ac.th', '', '', 0, NULL, 'somchai.pattana@cmu.ac.th', NULL, 'นาย', 'สมชาย', 'พัฒนา', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(71, '', '', 'เดช', 'ดำรงศักดิ์', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'det.d@cmu.ac.th', '', '', 0, NULL, 'det.d@cmu.ac.th', NULL, 'นาย', 'เดช', 'ดำรงศักดิ์', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(72, '', '', 'อิทธิชัย', 'ปรีชาวุฒิพงศ์', 0, 'รองศาสตราจารย์ ดร.', '', 'itthichai.p@cmu.ac.th', '', '', 0, NULL, 'itthichai.p@cmu.ac.th', NULL, 'นาย', 'อิทธิชัย', 'ปรีชาวุฒิพงศ์', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(73, '', '', 'เวชยันต์', 'รางศรี', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'wetchayan.rangsri@cmu.ac.th', '', '', 0, NULL, 'wetchayan.rangsri@cmu.ac.th', NULL, 'นาย', 'เวชยันต์', 'รางศรี', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(74, '', '', 'กอดขวัญ', 'นามสงวน', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'kodkwan.nam@cmu.ac.th', '', '', 0, NULL, 'kodkwan.nam@cmu.ac.th', NULL, 'นาง', 'กอดขวัญ', 'นามสงวน', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(75, '', '', 'วัชรพงษ์', 'ธัชยพงษ์', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'watcharapong.t@cmu.ac.th', '', '', 0, NULL, 'watcharapong.t@cmu.ac.th', NULL, 'นาย', 'วัชรพงษ์', 'ธัชยพงษ์', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(76, '', '', 'อนุศาล', 'เพิ่มสุวรรณ', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'anusan.p@cmu.ac.th', '', '', 0, NULL, 'anusan.p@cmu.ac.th', NULL, 'นาย', 'อนุศาล', 'เพิ่มสุวรรณ', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(77, '', '', 'ศิวะ', 'อัจฉริยวิริยะ', 0, 'รองศาสตราจารย์ ดร.', '', 'siva.a@cmu.ac.th', '', '', 0, NULL, 'siva.a@cmu.ac.th', NULL, 'นาย', 'ศิวะ', 'อัจฉริยวิริยะ', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(78, '', '', 'ชัชวาลย์', 'ชัยชนะ', 1, 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', 'chatchawan.c@cmu.ac.th', '', '', 0, NULL, 'chatchawan.c@cmu.ac.th', NULL, 'นาย', 'ชัชวาลย์', 'ชัยชนะ', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(79, '', '', 'ณัฐ', 'วรยศ', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'nat.v@cmu.ac.th', '', '', 0, NULL, 'nat.v@cmu.ac.th', NULL, 'นาย', 'ณัฐ', 'วรยศ', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(80, '', '', 'ณัฐวุฒิ', 'เนียมสอน', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'natawut.neamsorn@cmu.ac.th', '', '', 0, NULL, 'natawut.neamsorn@cmu.ac.th', NULL, 'นาย', 'ณัฐวุฒิ', 'เนียมสอน', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(81, '', '', 'ธรณิศวร์', 'ดีทายาท', 0, 'รองศาสตราจารย์ ดร.', '', 'thoranis.dee@cmu.ac.th', '', '', 0, NULL, 'thoranis.dee@cmu.ac.th', NULL, 'นาย', 'ธรณิศวร์', 'ดีทายาท', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(82, '', '', 'ใฝ่ฝัน', 'ตัณฑกิตติ', 0, 'อาจารย์ ดร.', '', 'faifan.tantakitti@cmu.ac.th', '', '', 0, NULL, 'faifan.tantakitti@cmu.ac.th', NULL, 'นางสาว', 'ใฝ่ฝัน', 'ตัณฑกิตติ', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(83, '', '', 'ระดม', 'พงษ์วุฒิธรรม', 0, 'ศาสตราจารย์ ดร.', '', 'radom.p@cmu.ac.th', '', '', 0, NULL, 'radom.p@cmu.ac.th', NULL, 'นาย', 'ระดม', 'พงษ์วุฒิธรรม', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(84, '', '', 'กัญญา', 'รัตนะมงคลกุล', 0, 'อาจารย์ ดร.', '', 'kanya.r@cmu.ac.th', '', '', 0, NULL, 'kanya.r@cmu.ac.th', NULL, 'นางสาว', 'กัญญา', 'รัตนะมงคลกุล', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(85, '', '', 'อนุชา', 'พรมวังขวา', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'anucha.prom@cmu.ac.th', '', '', 0, NULL, 'anucha.prom@cmu.ac.th', NULL, 'นาย', 'อนุชา', 'พรมวังขวา', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(86, '', '', 'นภัสวรรณ', 'วงษ์มงคล', 0, 'อาจารย์ ดร.', '', 'napassawan.k@cmu.ac.th', '', '', 0, NULL, 'napassawan.k@cmu.ac.th', NULL, 'นาง', 'นภัสวรรณ', 'วงษ์มงคล', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(87, '', '', 'ณัฐวิทย์', 'พรหมมา', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'nattawit.p@cmu.ac.th', '', '', 0, NULL, 'nattawit.p@cmu.ac.th', NULL, 'นาย', 'ณัฐวิทย์', 'พรหมมา', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(88, '', '', 'ภิญโญ', 'พวงมะลิ', 1, 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมเครื่องกล', 'pinyo.puangmali@cmu.ac.th', '', '', 0, NULL, 'pinyo.puangmali@cmu.ac.th', NULL, 'นาย', 'ภิญโญ', 'พวงมะลิ', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(89, '', '', 'นคร', 'ทิพยาวงศ์', 0, 'ศาสตราจารย์ ดร.', '', 'nakorn.t@cmu.ac.th', '', '', 0, NULL, 'nakorn.t@cmu.ac.th', NULL, 'นาย', 'นคร', 'ทิพยาวงศ์', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(90, '', '', 'ปวรุตม์', 'จงชาญสิทโธ', 1, 'รองศาสตราจารย์ ดร.', 'รองคณบดี', 'pawarut.j@cmu.ac.th', '', '', 0, NULL, 'pawarut.j@cmu.ac.th', NULL, 'นาย', 'ปวรุตม์', 'จงชาญสิทโธ', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(91, '', '', 'เก่งกมล', 'วิรัตน์เกษม', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'kengkamon.w@cmu.ac.th', '', '', 0, NULL, 'kengkamon.w@cmu.ac.th', NULL, 'นาย', 'เก่งกมล', 'วิรัตน์เกษม', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(92, '', '', 'กลยุทธ', 'ปัญญาวุธโธ', 0, 'รองศาสตราจารย์ ดร.', '', 'konlayutt.p@cmu.ac.th', '', '', 0, NULL, 'konlayutt.p@cmu.ac.th', NULL, 'นาย', 'กลยุทธ', 'ปัญญาวุธโธ', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(93, '', '', 'จักรพงษ์', 'จำรูญ', 1, 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 'chakkapong.ch@cmu.ac.th', '', '', 0, NULL, 'chakkapong.ch@cmu.ac.th', NULL, 'นาย', 'จักรพงษ์', 'จำรูญ', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(94, '', '', 'ธงชัย', 'ฟองสมุทร', 1, 'รองศาสตราจารย์ ดร.', 'คณบดี', 'thongchai.f@cmu.ac.th', '', '', 0, NULL, 'thongchai.f@cmu.ac.th', NULL, 'นาย', 'ธงชัย', 'ฟองสมุทร', NULL, NULL, 0, 15, 0, 0, 1, 0, 1, 1, 0, NULL),
(95, '', '', 'รามณรงค์', 'วณีสอน', 0, 'อาจารย์ ดร.', '', 'ramnarong.wanison@cmu.ac.th', '', '', 0, NULL, 'ramnarong.wanison@cmu.ac.th', NULL, 'นาย', 'รามณรงค์', 'วณีสอน', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(96, '', '', 'Matthew', 'Owen Thomas Cole', 0, 'ศาสตราจารย์ ดร.', '', 'matthew.o@cmu.ac.th', '', '', 0, NULL, 'matthew.o@cmu.ac.th', NULL, 'นาย', 'Matthew', 'Owen Thomas Cole', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(97, '', '', 'ภัทราพร', 'กมลเพ็ชร', 1, 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', 'patrapon.k@cmu.ac.th', '', '', 0, NULL, 'patrapon.k@cmu.ac.th', NULL, 'นาง', 'ภัทราพร', 'กมลเพ็ชร', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(98, '', '', 'ชาย', 'รังสิยากูล', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'chaiy.rungsiyakull@cmu.ac.th', '', '', 0, NULL, 'chaiy.rungsiyakull@cmu.ac.th', NULL, 'นาย', 'ชาย', 'รังสิยากูล', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(99, '', '', 'พฤทธ์', 'สกุลช่างสัจจะทัย', 0, 'รองศาสตราจารย์ ดร.', '', 'phrut.s@cmu.ac.th', '', '', 0, NULL, 'phrut.s@cmu.ac.th', NULL, 'นาย', 'พฤทธ์', 'สกุลช่างสัจจะทัย', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(100, '', '', 'อรรถกร', 'อาสนคำ', 0, 'รองศาสตราจารย์ ดร.', '', 'attakorn.asana@cmu.ac.th', '', '', 0, NULL, 'attakorn.asana@cmu.ac.th', NULL, 'นาย', 'อรรถกร', 'อาสนคำ', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(101, '', '', 'ธีระพงษ์', 'ว่องรัตนะไพศาล', 0, 'รองศาสตราจารย์ ดร.', '', 'theeraphong.wong@cmu.ac.th', '', '', 0, NULL, 'theeraphong.wong@cmu.ac.th', NULL, 'นาย', 'ธีระพงษ์', 'ว่องรัตนะไพศาล', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(102, '', '', 'วัชพล', 'โรจนรัตนางกูร', 0, 'รองศาสตราจารย์ ดร.', '', 'watchapon.roj@cmu.ac.th', '', '', 0, NULL, 'watchapon.roj@cmu.ac.th', NULL, 'นาย', 'วัชพล', 'โรจนรัตนางกูร', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(103, '', '', 'นิติ', 'คำเมืองลือ', 0, 'รองศาสตราจารย์ ดร.', '', 'niti.k@cmu.ac.th', '', '', 0, NULL, 'niti.k@cmu.ac.th', NULL, 'นาย', 'นิติ', 'คำเมืองลือ', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(104, '', '', 'วิบูลย์', 'ช่างเรือ', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'viboon.c@cmu.ac.th', '', '', 0, NULL, 'viboon.c@cmu.ac.th', NULL, 'นาย', 'วิบูลย์', 'ช่างเรือ', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(105, '', '', 'James', 'C. Moran', 0, 'รองศาสตราจารย์ ดร.', '', 'james.moran@cmu.ac.th', '', '', 0, NULL, 'james.moran@cmu.ac.th', NULL, 'นาย', 'James', 'C. Moran', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(106, '', '', 'ดามร', 'บัณฑุรัตน์', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'damorn.b@cmu.ac.th', '', '', 0, NULL, 'damorn.b@cmu.ac.th', NULL, 'นาย', 'ดามร', 'บัณฑุรัตน์', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(107, '', '', 'วรเดช', 'มโนสร้อย', 0, 'รองศาสตราจารย์ ดร.', '', 'woradej.manosroi@cmu.ac.th', '', '', 0, NULL, 'woradej.manosroi@cmu.ac.th', NULL, 'นาย', 'วรเดช', 'มโนสร้อย', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(108, '', '', 'พนา', 'สุทธกูล', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'pana.s@cmu.ac.th', '', '', 0, NULL, 'pana.s@cmu.ac.th', NULL, 'นาย', 'พนา', 'สุทธกูล', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(109, '', '', 'ยุทธนา', 'โมนะ', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'yuttana.mona@cmu.ac.th', '', '', 0, NULL, 'yuttana.mona@cmu.ac.th', NULL, 'นาย', 'ยุทธนา', 'โมนะ', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(110, '', '', 'ประดิษฐ์', 'เทอดทูล', 0, 'ศาสตราจารย์ ดร.', '', 'pradit.terdtoon@cmu.ac.th', '', '', 0, NULL, 'pradit.terdtoon@cmu.ac.th', NULL, 'นาย', 'ประดิษฐ์', 'เทอดทูล', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(111, '', '', 'พฤกษ์', 'อักกะรังสี', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'pruk.a@cmu.ac.th', '', '', 0, NULL, 'pruk.a@cmu.ac.th', NULL, 'นาย', 'พฤกษ์', 'อักกะรังสี', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(112, '', '', 'กฤต', 'สุจริตธรรม', 0, 'อาจารย์ ดร.', '', 'krit.s@cmu.ac.th', '', '', 0, NULL, 'krit.s@cmu.ac.th', NULL, 'นาย', 'กฤต', 'สุจริตธรรม', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(113, '', '', 'ณัฐนี', 'วรยศ', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'nattanee.v@cmu.ac.th', '', '', 0, NULL, 'nattanee.v@cmu.ac.th', NULL, 'นางสาว', 'ณัฐนี', 'วรยศ', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(114, '', '', 'อาภิรักษ์', 'หกพันนา', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'arpiruk.hok@cmu.ac.th', '', '', 0, NULL, 'arpiruk.hok@cmu.ac.th', NULL, 'นาย', 'อาภิรักษ์', 'หกพันนา', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 1, 0, NULL),
(115, '', '', 'พีรพนธ์', 'อนุสารสุนทร', 0, 'อาจารย์', '', 'perapon.a@cmu.ac.th', '', '', 0, NULL, 'perapon.a@cmu.ac.th', NULL, 'นาย', 'พีรพนธ์', 'อนุสารสุนทร', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(116, '', '', 'พีรพล', 'จิราพงศ์', 1, 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมไฟฟ้า', 'peerapol.j@cmu.ac.th', '', '', 0, NULL, 'peerapol.j@cmu.ac.th', NULL, 'นาย', 'พีรพล', 'จิราพงศ์', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(117, '', '', 'ธนะพงษ์', 'ธนะศักดิ์ศิริ', 0, 'รองศาสตราจารย์', '', 'thanaphong.thanasak@cmu.ac.th', '', '', 0, NULL, 'thanaphong.thanasak@cmu.ac.th', NULL, 'นาย', 'ธนะพงษ์', 'ธนะศักดิ์ศิริ', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(118, '', '', 'นิพนธ์', 'ธีรอำพน', 0, 'ศาสตราจารย์ ดร.', '', 'nipon.t@cmu.ac.th', '', '', 0, NULL, 'nipon.t@cmu.ac.th', NULL, 'นาย', 'นิพนธ์', 'ธีรอำพน', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(119, '', '', 'กสิณ', 'ประกอบไวทยกิจ', 0, 'ผู้ช่วยศาสตราจารย์', '', 'kasin.p@cmu.ac.th', '', '', 0, NULL, 'kasin.p@cmu.ac.th', NULL, 'นาย', 'กสิณ', 'ประกอบไวทยกิจ', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(120, '', '', 'ธราดล', 'โกมลมิศร์', 0, 'ผู้ช่วยศาสตราจารย์', '', 'tharadol.k@cmu.ac.th', '', '', 0, NULL, 'tharadol.k@cmu.ac.th', NULL, 'นาย', 'ธราดล', 'โกมลมิศร์', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(121, '', '', 'เสริมศักดิ์', 'เอื้อตรงจิตต์', 0, 'รองศาสตราจารย์ ดร.', '', 'sermsak.uatrongjit@cmu.ac.th', '', '', 0, NULL, 'sermsak.uatrongjit@cmu.ac.th', NULL, 'นาย', 'เสริมศักดิ์', 'เอื้อตรงจิตต์', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(122, '', '', 'บุญศรี', 'แก้วคำอ้าย', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'boonsri.k@cmu.ac.th', '', '', 0, NULL, 'boonsri.k@cmu.ac.th', NULL, 'นางสาว', 'บุญศรี', 'แก้วคำอ้าย', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(123, '', '', 'สมบูรณ์', 'นุชประยูร', 0, 'รองศาสตราจารย์ ดร.', '', 'somboon.nuchprayoon@cmu.ac.th', '', '', 0, NULL, 'somboon.nuchprayoon@cmu.ac.th', NULL, 'นาย', 'สมบูรณ์', 'นุชประยูร', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(124, '', '', 'ดลเดช', 'ตันตระวิวัฒน์', 0, 'รองศาสตราจารย์ ดร.', '', 'doldet.tantraviwat@cmu.ac.th', '', '', 0, NULL, 'doldet.tantraviwat@cmu.ac.th', NULL, 'นาย', 'ดลเดช', 'ตันตระวิวัฒน์', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(125, '', '', 'สุทธิชัย', 'เปรมฤดีปรีชาชาญ', 0, 'รองศาสตราจารย์ ดร.', '', 'suttichai.p@cmu.ac.th', '', '', 0, NULL, 'suttichai.p@cmu.ac.th', NULL, 'นาย', 'สุทธิชัย', 'เปรมฤดีปรีชาชาญ', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(126, '', '', 'เกษมศักดิ์', 'อุทัยชนะ', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'kasemsak.u@cmu.ac.th', '', '', 0, NULL, 'kasemsak.u@cmu.ac.th', NULL, 'นาย', 'เกษมศักดิ์', 'อุทัยชนะ', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(127, '', '', 'อุกฤษฏ์', 'มั่นคง', 1, 'รองศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 'ukrit.m@cmu.ac.th', '', '', 0, NULL, 'ukrit.m@cmu.ac.th', NULL, 'นาย', 'อุกฤษฏ์', 'มั่นคง', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(128, '', '', 'วิศรุต', 'อัจฉริยวิริยะ', 0, 'อาจารย์ ดร.', '', 'witsarut.a@cmu.ac.th', '', '', 0, NULL, 'witsarut.a@cmu.ac.th', NULL, 'นาย', 'วิศรุต', 'อัจฉริยวิริยะ', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(129, '', '', 'สิโรตม์', 'คุณกิตติ', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'sirote.khunkitti@cmu.ac.th', '', '', 0, NULL, 'sirote.khunkitti@cmu.ac.th', NULL, 'นาย', 'สิโรตม์', 'คุณกิตติ', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(130, '', '', 'ปณิดา', 'ธารารักษ์', 0, 'อาจารย์ ดร.', '', 'panida.th@cmu.ac.th', '', '', 0, NULL, 'panida.th@cmu.ac.th', NULL, 'นางสาว', 'ปณิดา', 'ธารารักษ์', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(131, '', '', 'ยุทธนา', 'ขำสุวรรณ์', 0, 'ศาสตราจารย์ ดร.', '', 'yuttana.k@cmu.ac.th', '', '', 0, NULL, 'yuttana.k@cmu.ac.th', NULL, 'นาย', 'ยุทธนา', 'ขำสุวรรณ์', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(132, '', '', 'วัชริน', 'ศรีรัตนาวิชัยกุล', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'watcharin.s@cmu.ac.th', '', '', 0, NULL, 'watcharin.s@cmu.ac.th', NULL, 'นาย', 'วัชริน', 'ศรีรัตนาวิชัยกุล', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(133, '', '', 'ณัตพงศ์', 'สมจิตร', 0, 'อาจารย์ ดร.', '', 'nutapong.somjit@cmu.ac.th', '', '', 0, NULL, 'nutapong.somjit@cmu.ac.th', NULL, 'นาย', 'ณัตพงศ์', 'สมจิตร', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(134, '', '', 'ปารเมศ', 'วิระสันติ', 0, 'รองศาสตราจารย์ ดร.', '', 'paramet.w@cmu.ac.th', '', '', 0, NULL, 'paramet.w@cmu.ac.th', NULL, 'นาย', 'ปารเมศ', 'วิระสันติ', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(135, '', '', 'สรพล', 'กิจศิริสิน', 0, 'อาจารย์ ดร.', '', 'soraphon.k@cmu.ac.th', '', '', 0, NULL, 'soraphon.k@cmu.ac.th', NULL, 'นาย', 'สรพล', 'กิจศิริสิน', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 1, 0, NULL),
(136, '', '', 'เชี่ยวชาญ', 'ลีลาสุขเสรี', 1, 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมเหมืองแร่', 'cheowchan.l@cmu.ac.th', '', '', 0, NULL, 'cheowchan.l@cmu.ac.th', NULL, 'นาย', 'เชี่ยวชาญ', 'ลีลาสุขเสรี', NULL, NULL, 0, 19, 0, 0, 0, 0, 0, 1, 0, NULL),
(137, '', '', 'สุทธิเทพ', 'รมยเวศม์', 0, 'ผู้ช่วยศาสตราจารย์', '', 'suttithep.r@cmu.ac.th', '', '', 0, NULL, 'suttithep.r@cmu.ac.th', NULL, 'นาย', 'สุทธิเทพ', 'รมยเวศม์', NULL, NULL, 0, 19, 0, 0, 0, 0, 0, 1, 0, NULL),
(138, '', '', 'สุพฤทธิ์', 'ตั้งพฤทธิ์กุล', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'suparit.t@cmu.ac.th', '', '', 0, NULL, 'suparit.t@cmu.ac.th', NULL, 'นาย', 'สุพฤทธิ์', 'ตั้งพฤทธิ์กุล', NULL, NULL, 0, 19, 0, 0, 0, 0, 0, 1, 0, NULL),
(139, '', '', 'ธีรภัทร์', 'ต่อสวย', 0, 'อาจารย์', '', 'teerapat.t@cmu.ac.th', '', '', 0, NULL, 'teerapat.t@cmu.ac.th', NULL, 'นาย', 'ธีรภัทร์', 'ต่อสวย', NULL, NULL, 0, 19, 0, 0, 0, 0, 0, 1, 0, NULL),
(140, '', '', 'ทัศษุดา', 'ทักษะวสุ', 0, 'อาจารย์ ดร.', '', 'tadsuda.t@cmu.ac.th', '', '', 0, NULL, 'tadsuda.t@cmu.ac.th', NULL, 'นางสาว', 'ทัศษุดา', 'ทักษะวสุ', NULL, NULL, 0, 19, 0, 0, 0, 0, 0, 1, 0, NULL),
(141, '', '', 'คมสูรย์', 'สมประสงค์', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'komsoon.s@cmu.ac.th', '', '', 0, NULL, 'komsoon.s@cmu.ac.th', NULL, 'นาย', 'คมสูรย์', 'สมประสงค์', NULL, NULL, 0, 19, 0, 0, 0, 0, 0, 1, 0, NULL),
(142, '', '', 'ชนะพล', 'เจริญธนาวรกุล', 0, 'อาจารย์ ดร.', '', 'chanapol.c@cmu.ac.th', '', '', 0, NULL, 'chanapol.c@cmu.ac.th', NULL, 'นาย', 'ชนะพล', 'เจริญธนาวรกุล', NULL, NULL, 0, 19, 0, 0, 0, 0, 0, 1, 0, NULL),
(143, '', '', 'พุทธิพล', 'ดำรงชัย', 0, 'รองศาสตราจารย์ ดร.', '', 'puttipol.d@cmu.ac.th', '', '', 0, NULL, 'puttipol.d@cmu.ac.th', NULL, 'นาย', 'พุทธิพล', 'ดำรงชัย', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(144, '', '', 'ไพศาล', 'จั่วทอง', 0, 'อาจารย์', '', 'paisan.jourtong@cmu.ac.th', '', '', 0, NULL, 'paisan.jourtong@cmu.ac.th', NULL, 'นาย', 'ไพศาล', 'จั่วทอง', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(145, '', '', 'ปุ่น', 'เที่ยงบูรณธรรม', 0, 'รองศาสตราจารย์ ดร.', '', 'poon.th@cmu.ac.th', '', '', 0, NULL, 'poon.th@cmu.ac.th', NULL, 'นาย', 'ปุ่น', 'เที่ยงบูรณธรรม', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(146, '', '', 'ชยานนท์', 'หรรษภิญโญ', 0, 'รองศาสตราจารย์ ดร.', '', 'chayanon.h@cmu.ac.th', '', '', 0, NULL, 'chayanon.h@cmu.ac.th', NULL, 'นาย', 'ชยานนท์', 'หรรษภิญโญ', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(147, '', '', 'ดำรงศักดิ์', 'รินชุมภู', 0, 'รองศาสตราจารย์ ดร.', '', 'damrongsak.r@cmu.ac.th', '', '', 0, NULL, 'damrongsak.r@cmu.ac.th', NULL, 'นาย', 'ดำรงศักดิ์', 'รินชุมภู', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(148, '', '', 'นที', 'สุริยานนท์', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'natee.suriyanon@cmu.ac.th', '', '', 0, NULL, 'natee.suriyanon@cmu.ac.th', NULL, 'นาย', 'นที', 'สุริยานนท์', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(149, '', '', 'สุริยะ', 'ทองมุณี', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'suriyah.t@cmu.ac.th', '', '', 0, NULL, 'suriyah.t@cmu.ac.th', NULL, 'นาย', 'สุริยะ', 'ทองมุณี', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(150, '', '', 'เศรษฐพงศ์', 'เศรษฐบุปผา', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'sethapong.s@cmu.ac.th', '', '', 0, NULL, 'sethapong.s@cmu.ac.th', NULL, 'นาย', 'เศรษฐพงศ์', 'เศรษฐบุปผา', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(151, '', '', 'ธวัชชัย', 'ตันชัยสวัสดิ์', 1, 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', 'tawatchai.t@cmu.ac.th', '', '', 0, NULL, 'tawatchai.t@cmu.ac.th', NULL, 'นาย', 'ธวัชชัย', 'ตันชัยสวัสดิ์', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(152, '', '', 'พุทธรักษ์', 'จรัสพันธุ์กุล', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'bhuddarak.c@cmu.ac.th', '', '', 0, NULL, 'bhuddarak.c@cmu.ac.th', NULL, 'นาย', 'พุทธรักษ์', 'จรัสพันธุ์กุล', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(153, '', '', 'พีรวัฒน์', 'ปลาเงิน', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'pheerawat.p@cmu.ac.th', '', '', 0, NULL, 'pheerawat.p@cmu.ac.th', NULL, 'นาย', 'พีรวัฒน์', 'ปลาเงิน', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(154, '', '', 'วรากร', 'ตันตระพงศธร', 0, 'อาจารย์ ดร.', '', 'warakorn.tan@cmu.ac.th', '', '', 0, NULL, 'warakorn.tan@cmu.ac.th', NULL, 'นาย', 'วรากร', 'ตันตระพงศธร', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(155, '', '', 'พีรพงศ์', 'จิตเสงี่ยม', 0, 'รองศาสตราจารย์ ดร.', '', 'peerapong.j@cmu.ac.th', '', '', 0, NULL, 'peerapong.j@cmu.ac.th', NULL, 'นาย', 'พีรพงศ์', 'จิตเสงี่ยม', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(156, '', '', 'เกรียงไกร', 'อรุโณทยานันท์', 1, 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 'kriangkrai.a@cmu.ac.th', '', '', 0, NULL, 'kriangkrai.a@cmu.ac.th', NULL, 'นาย', 'เกรียงไกร', 'อรุโณทยานันท์', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(157, '', '', 'ปิติวัฒน์', 'วัฒนชัย', 0, 'รองศาสตราจารย์ ดร.', '', 'pitiwat.w@cmu.ac.th', '', '', 0, NULL, 'pitiwat.w@cmu.ac.th', NULL, 'นาย', 'ปิติวัฒน์', 'วัฒนชัย', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(158, '', '', 'ชินพัฒน์', 'บัวชาติ', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'chinapat.b@cmu.ac.th', '', '', 0, NULL, 'chinapat.b@cmu.ac.th', NULL, 'นาย', 'ชินพัฒน์', 'บัวชาติ', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(159, '', '', 'ธีวรา', 'สุวรรณ', 0, 'รองศาสตราจารย์ ดร.', '', 'teewara.s@cmu.ac.th', '', '', 0, NULL, 'teewara.s@cmu.ac.th', NULL, 'นาย', 'ธีวรา', 'สุวรรณ', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(160, '', '', 'ชนะ', 'สินทรัพย์วโรดม', 0, 'อาจารย์ ดร.', '', 'chana.sinsabvarodom@cmu.ac.th', '', '', 0, NULL, 'chana.sinsabvarodom@cmu.ac.th', NULL, 'นาย', 'ชนะ', 'สินทรัพย์วโรดม', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(161, '', '', 'ธนพร', 'สุปริยศิลป์', 0, 'รองศาสตราจารย์ ดร.', '', 'thanaporn.s@cmu.ac.th', '', '', 0, NULL, 'thanaporn.s@cmu.ac.th', NULL, 'นางสาว', 'ธนพร', 'สุปริยศิลป์', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(162, '', '', 'นพดล', 'กรประเสริฐ', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'nopadon.k@cmu.ac.th', '', '', 0, NULL, 'nopadon.k@cmu.ac.th', NULL, 'นาย', 'นพดล', 'กรประเสริฐ', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(163, '', '', 'ทรงยศ', 'กิจธรรมเกษร', 1, 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 'songyot.k@cmu.ac.th', '', '', 0, NULL, 'songyot.k@cmu.ac.th', NULL, 'นาย', 'ทรงยศ', 'กิจธรรมเกษร', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(164, '', '', 'ปรีดา', 'พิชยาพันธ์', 1, 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมโยธา', 'preda.p@cmu.ac.th', '', '', 0, NULL, 'preda.p@cmu.ac.th', NULL, 'นาย', 'ปรีดา', 'พิชยาพันธ์', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(165, '', '', 'ปิยะพงษ์', 'วงค์เมธา', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'piyapong.wongmatar@cmu.ac.th', '', '', 0, NULL, 'piyapong.wongmatar@cmu.ac.th', NULL, 'นาย', 'ปิยะพงษ์', 'วงค์เมธา', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(166, '', '', 'กิตติคุณ', 'จิตไพโรจน์', 0, 'อาจารย์ ดร.', '', 'kittikun.j@cmu.ac.th', '', '', 0, NULL, 'kittikun.j@cmu.ac.th', NULL, 'นาย', 'กิตติคุณ', 'จิตไพโรจน์', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(167, '', '', 'อรรถวิทย์', 'อุปโยคิน', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'auttawit.u@cmu.ac.th', '', '', 0, NULL, 'auttawit.u@cmu.ac.th', NULL, 'นาย', 'อรรถวิทย์', 'อุปโยคิน', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 1, 0, NULL),
(168, '', '', 'ภาคภูมิ', 'รักร่วม', 1, 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 'pharkphum.r@cmu.ac.th', '', '', 0, NULL, 'pharkphum.r@cmu.ac.th', NULL, 'นาย', 'ภาคภูมิ', 'รักร่วม', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 1, 0, NULL),
(169, '', '', 'พิมพ์ลักษณ์', 'กิจจนะพานิช', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'pimluck.k@cmu.ac.th', '', '', 0, NULL, 'pimluck.k@cmu.ac.th', NULL, 'นางสาว', 'พิมพ์ลักษณ์', 'กิจจนะพานิช', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 1, 0, NULL),
(170, '', '', 'ปฏิรูป', 'ผลจันทร์', 1, 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมสิ่งแวดล้อม', 'patiroop.p@cmu.ac.th', '', '', 0, NULL, 'patiroop.p@cmu.ac.th', NULL, 'นาย', 'ปฏิรูป', 'ผลจันทร์', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 1, 0, NULL),
(171, '', '', 'สรัลนุช', 'ภู่พิสิฐ', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'sarunnoud.p@cmu.ac.th', '', '', 0, NULL, 'sarunnoud.p@cmu.ac.th', NULL, 'นางสาว', 'สรัลนุช', 'ภู่พิสิฐ', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 1, 0, NULL),
(172, '', '', 'ณภัทร', 'จักรวัฒนา', 0, 'รองศาสตราจารย์ ดร.', '', 'napat.ja@cmu.ac.th', '', '', 0, NULL, 'napat.ja@cmu.ac.th', NULL, 'นาย', 'ณภัทร', 'จักรวัฒนา', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 1, 0, NULL),
(173, '', '', 'สิริชัย', 'คุณภาพดีเลิศ', 0, 'รองศาสตราจารย์ ดร.', '', 'sirichai.k@cmu.ac.th', '', '', 0, NULL, 'sirichai.k@cmu.ac.th', NULL, 'นาย', 'สิริชัย', 'คุณภาพดีเลิศ', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 1, 0, NULL),
(174, '', '', 'อรรณพ', 'วงศ์เรือง', 0, 'รองศาสตราจารย์ ดร.', '', 'aunnop.w@cmu.ac.th', '', '', 0, NULL, 'aunnop.w@cmu.ac.th', NULL, 'นาย', 'อรรณพ', 'วงศ์เรือง', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 1, 0, NULL),
(175, '', '', 'พวงรัตน์', 'แก้วล้อม', 0, 'ศาสตราจารย์ ดร.', '', 'puangrat.k@cmu.ac.th', '', '', 0, NULL, 'puangrat.k@cmu.ac.th', NULL, 'นางสาว', 'พวงรัตน์', 'แก้วล้อม', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 1, 0, NULL),
(176, '', '', 'เสาหฤท', 'นิตยวรรธนะ', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'saoharit.n@cmu.ac.th', '', '', 0, NULL, 'saoharit.n@cmu.ac.th', NULL, 'นางสาว', 'เสาหฤท', 'นิตยวรรธนะ', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 1, 0, NULL),
(177, '', '', 'สุลักษณ์', 'สุมิตสวรรค์', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'sulak.sumit@cmu.ac.th', '', '', 0, NULL, 'sulak.sumit@cmu.ac.th', NULL, 'นาย', 'สุลักษณ์', 'สุมิตสวรรค์', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 1, 0, NULL),
(178, '', '', 'ปรัตถกร', 'สิทธิสม', 0, 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'prattakorn.s@cmu.ac.th', '', '', 0, NULL, 'prattakorn.s@cmu.ac.th', NULL, 'นาย', 'ปรัตถกร', 'สิทธิสม', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 1, 0, NULL),
(179, '', '', 'รัฐพล', 'พรประสิทธิ์', 0, 'นักวิจัย', '', 'rattapol.p@cmu.ac.th', '', '', 0, NULL, 'rattapol.p@cmu.ac.th', NULL, 'นาย', 'รัฐพล', 'พรประสิทธิ์', NULL, NULL, 0, 6, 0, 0, 0, 0, 0, 1, 0, NULL),
(180, '', '', 'ชาลิณี ', 'พิพัฒนพิภพ', 0, 'อาจารย์ ดร.', '', 'chalinee.m@cmu.ac.th', '', '', 0, NULL, 'chalinee.m@cmu.ac.th', NULL, 'นางสาว', 'ชาลิณี ', 'พิพัฒนพิภพ', NULL, NULL, 0, 35, 0, 0, 0, 0, 0, 1, 0, NULL),
(181, '', '', 'คุณานนต์', 'จงชาญสิทโธ', 0, 'อาจารย์ ดร.', '', 'อยู่ระหว่างการจัดทำคำสั่งบรรจุ', '', '', 0, NULL, 'อยู่ระหว่างการจัดทำคำสั่งบรรจุ', NULL, 'นาย', 'คุณานนต์', 'จงชาญสิทโธ', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 1, 0, NULL),
(182, '', '', 'พรรณี', 'โศจิธรรมพร', 1, 'นักจัดการงานทั่วไป', 'เลขานุการคณะ', 'phannee.sojit@cmu.ac.th', '', '', 0, NULL, 'phannee.sojit@cmu.ac.th', NULL, 'นาง', 'พรรณี', 'โศจิธรรมพร', NULL, NULL, 0, 1, 0, 0, 1, 1, 0, 2, 0, NULL),
(183, '', '', 'สนธยา', 'สุขสามัคคี', 0, 'พนักงานช่าง', '', 'sonthaya.s@cmu.ac.th', '', '', 0, NULL, 'sonthaya.s@cmu.ac.th', NULL, 'นาย', 'สนธยา', 'สุขสามัคคี', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 2, 0, NULL),
(184, '', '', 'วุฒินันท์', 'อินทยศ', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'wuttinun.in@cmu.ac.th', '', '', 0, NULL, 'wuttinun.in@cmu.ac.th', NULL, 'นาย', 'วุฒินันท์', 'อินทยศ', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 2, 0, NULL),
(185, '', '', 'เจตนิพัทธ์', 'สามตา', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'chetniphat.samta@cmu.ac.th', '', '', 0, NULL, 'chetniphat.samta@cmu.ac.th', NULL, 'นาย', 'เจตนิพัทธ์', 'สามตา', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 2, 0, NULL),
(186, '', '', 'พรพรรณ', 'คำมั่น', 0, 'นักจัดการงานทั่วไป', '', 'ponpun.k@cmu.ac.th', '', '', 0, NULL, 'ponpun.k@cmu.ac.th', NULL, 'นางสาว', 'พรพรรณ', 'คำมั่น', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 2, 0, NULL),
(187, '', '', 'นรินทร์', 'จักร์ปั๋น', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'narin.c@cmu.ac.th', '', '', 0, NULL, 'narin.c@cmu.ac.th', NULL, 'นาย', 'นรินทร์', 'จักร์ปั๋น', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 2, 0, NULL),
(188, '', '', 'ณัฐวุฒิ', 'รินโน', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'nattawoot.rinno@cmu.ac.th', '', '', 0, NULL, 'nattawoot.rinno@cmu.ac.th', NULL, 'นาย', 'ณัฐวุฒิ', 'รินโน', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 2, 0, NULL),
(189, '', '', 'วิมุทิตา', 'ปัญโญใหญ่', 0, 'นักจัดการงานทั่วไป', '', 'wimutita.p@cmu.ac.th', '', '', 0, NULL, 'wimutita.p@cmu.ac.th', NULL, 'นางสาว', 'วิมุทิตา', 'ปัญโญใหญ่', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 2, 0, NULL),
(190, '', '', 'ธัญญาลักษณ์', 'กิติวิริยะชัย', 0, 'นักจัดการงานทั่วไป', '', 'thunyaluk.kiti@cmu.ac.th', '', '', 0, NULL, 'thunyaluk.kiti@cmu.ac.th', NULL, 'นางสาว', 'ธัญญาลักษณ์', 'กิติวิริยะชัย', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 2, 0, NULL),
(191, '', '', 'ศักดินนท์', 'นันทนา', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'sakdinon.nantana@cmu.ac.th', '', '', 0, NULL, 'sakdinon.nantana@cmu.ac.th', NULL, 'นาย', 'ศักดินนท์', 'นันทนา', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 2, 0, NULL),
(192, '', '', 'วุฒิพงศ์', 'คำวงค์', 0, 'นักจัดการงานทั่วไป', '', 'wutipong.k@cmu.ac.th', '', '', 0, NULL, 'wutipong.k@cmu.ac.th', NULL, 'นาย', 'วุฒิพงศ์', 'คำวงค์', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 2, 0, NULL),
(193, '', '', 'รัตติยากร', 'ชาตตนนท์', 0, 'นักจัดการงานทั่วไป', '', 'rattiyakorn.c@cmu.ac.th', '', '', 0, NULL, 'rattiyakorn.c@cmu.ac.th', NULL, 'นางสาว', 'รัตติยากร', 'ชาตตนนท์', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 2, 0, NULL),
(194, '', '', 'นัยนา', 'ยะสิงห์สาร', 0, 'นักจัดการงานทั่วไป', '', 'naiyana.y@cmu.ac.th', '', '', 0, NULL, 'naiyana.y@cmu.ac.th', NULL, 'นางสาว', 'นัยนา', 'ยะสิงห์สาร', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 2, 0, NULL),
(195, '', '', 'พรสุดา', 'เสาร์สิงห์', 0, 'นักจัดการงานทั่วไป', '', 'pornsuda.s@cmu.ac.th', '', '', 0, NULL, 'pornsuda.s@cmu.ac.th', NULL, 'นางสาว', 'พรสุดา', 'เสาร์สิงห์', NULL, NULL, 0, 20, 0, 0, 0, 0, 0, 2, 0, NULL),
(196, '', '', 'วิภาวรรณ', 'พันดวง', 0, 'นักจัดการงานทั่วไป', '', 'wipawarn.m@cmu.ac.th', '', '', 0, NULL, 'wipawarn.m@cmu.ac.th', NULL, 'นาง', 'วิภาวรรณ', 'พันดวง', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 2, 0, NULL),
(197, '', '', 'พรพิมล', 'พรมมินทร์', 0, 'นักจัดการงานทั่วไป', '', 'pornpimol.p@cmu.ac.th', '', '', 0, NULL, 'pornpimol.p@cmu.ac.th', NULL, 'นาง', 'พรพิมล', 'พรมมินทร์', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 2, 0, NULL),
(198, '', '', 'สิทธิชน', 'อังคุตรานนท์', 0, 'นักวิชาการคอมพิวเตอร์', '', 'sittichon.a@cmu.ac.th', '', '', 0, NULL, 'sittichon.a@cmu.ac.th', NULL, 'นาย', 'สิทธิชน', 'อังคุตรานนท์', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 2, 0, NULL),
(199, '', '', 'อภิชาติ', 'รอดเรือน', 0, 'นักจัดการงานทั่วไป', '', 'aphichat.r@cmu.ac.th', '', '', 0, NULL, 'aphichat.r@cmu.ac.th', NULL, 'นาย', 'อภิชาติ', 'รอดเรือน', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 2, 0, NULL),
(200, '', '', 'ธิดากร', 'สิริชลวรา', 0, 'พนักงานบริการทั่วไป', '', 'waraporn.tipsorn@cmu.ac.th', '', '', 0, NULL, 'waraporn.tipsorn@cmu.ac.th', NULL, 'นางสาว', 'ธิดากร', 'สิริชลวรา', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 2, 0, NULL),
(201, '', '', 'เพียงตา', 'อภิวงศ์', 0, 'นักจัดการงานทั่วไป', '', 'piangta.a@cmu.ac.th', '', '', 0, NULL, 'piangta.a@cmu.ac.th', NULL, 'นางสาว', 'เพียงตา', 'อภิวงศ์', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 2, 0, NULL),
(202, '', '', 'อุรพี', 'ธรรมโยธิน', 0, 'นักจัดการงานทั่วไป', '', 'urapee.t@cmu.ac.th', '', '', 0, NULL, 'urapee.t@cmu.ac.th', NULL, 'นางสาว', 'อุรพี', 'ธรรมโยธิน', NULL, NULL, 0, 14, 0, 0, 0, 0, 0, 2, 0, NULL),
(203, '', '', 'ณฐพรหม', 'ปัญจมา', 0, 'ช่างอิเล็กทรอนิกส์', '', 'nathaprom.p@cmu.ac.th', '', '', 0, NULL, 'nathaprom.p@cmu.ac.th', NULL, 'นาย', 'ณฐพรหม', 'ปัญจมา', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(204, '', '', 'ปนัดดา', 'ตุ้ยอุ่นเรือน', 0, 'นักจัดการงานทั่วไป', '', 'panutda.t@cmu.ac.th', '', '', 0, NULL, 'panutda.t@cmu.ac.th', NULL, 'นางสาว', 'ปนัดดา', 'ตุ้ยอุ่นเรือน', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(205, '', '', 'มรกต', 'อภิวงศ์งาม', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'morakot.apiwongngam@cmu.ac.th', '', '', 0, NULL, 'morakot.apiwongngam@cmu.ac.th', NULL, 'นาย', 'มรกต', 'อภิวงศ์งาม', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(206, '', '', 'อัศวิน', 'ปศุศฤทธากร', 0, 'วิศวกร', '', 'aswin.p@cmu.ac.th', '', '', 0, NULL, 'aswin.p@cmu.ac.th', NULL, 'นาย', 'อัศวิน', 'ปศุศฤทธากร', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(207, '', '', 'ณฐพล', 'ทองสอน', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'natapon.t@cmu.ac.th', '', '', 0, NULL, 'natapon.t@cmu.ac.th', NULL, 'นาย', 'ณฐพล', 'ทองสอน', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(208, '', '', 'นิภาวรรณ์', 'คำวัง', 0, 'นักจัดการงานทั่วไป', '', 'nipawan.k@cmu.ac.th', '', '', 0, NULL, 'nipawan.k@cmu.ac.th', NULL, 'นางสาว', 'นิภาวรรณ์', 'คำวัง', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(209, '', '', 'นรเศรษฐ์', 'บานนิกุล', 0, 'วิศวกร', '', 'norrasaet.b@cmu.ac.th', '', '', 0, NULL, 'norrasaet.b@cmu.ac.th', NULL, 'นาย', 'นรเศรษฐ์', 'บานนิกุล', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(210, '', '', 'อาภัสรา', 'คล้ายณรงค์', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'apasara.k@cmu.ac.th', '', '', 0, NULL, 'apasara.k@cmu.ac.th', NULL, 'นางสาว', 'อาภัสรา', 'คล้ายณรงค์', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(211, '', '', 'ผุสดี', 'จันทร์เอี่ยม', 0, 'นักจัดการงานทั่วไป', '', 'pusadee.ch@cmu.ac.th', '', '', 0, NULL, 'pusadee.ch@cmu.ac.th', NULL, 'นางสาว', 'ผุสดี', 'จันทร์เอี่ยม', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(212, '', '', 'ณัฐพงศ์', 'กันธะเรียน', 0, 'นักวิชาการคอมพิวเตอร์', '', 'nattapong.g@cmu.ac.th', '', '', 0, NULL, 'nattapong.g@cmu.ac.th', NULL, 'นาย', 'ณัฐพงศ์', 'กันธะเรียน', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(213, '', '', 'กาญจนา', 'แปงสุตา', 0, 'นักจัดการงานทั่วไป', '', 'kanjarna.pang@cmu.ac.th', '', '', 0, NULL, 'kanjarna.pang@cmu.ac.th', NULL, 'นางสาว', 'กาญจนา', 'แปงสุตา', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(214, '', '', 'ธวัชชัย', 'ธรรมขันแก้ว', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'thawatchai.t@cmu.ac.th', '', '', 0, NULL, 'thawatchai.t@cmu.ac.th', NULL, 'นาย', 'ธวัชชัย', 'ธรรมขันแก้ว', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(215, '', '', 'วราลักษณ์', 'เหล็กสมบูรณ์', 0, 'นักจัดการงานทั่วไป', '', 'waraluck.l@cmu.ac.th', '', '', 0, NULL, 'waraluck.l@cmu.ac.th', NULL, 'นาง', 'วราลักษณ์', 'เหล็กสมบูรณ์', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(216, '', '', 'วรางคณา', 'สุกชัยเจริญพร', 0, 'นักจัดการงานทั่วไป', '', 'warangkana.sukch@cmu.ac.th', '', '', 0, NULL, 'warangkana.sukch@cmu.ac.th', NULL, 'นางสาว', 'วรางคณา', 'สุกชัยเจริญพร', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(217, '', '', 'สุขภวัฒ', 'ศิริมูล', 0, 'พนักงานบริการทั่วไป', '', 'sukphawat.siri@cmu.ac.th', '', '', 0, NULL, 'sukphawat.siri@cmu.ac.th', NULL, 'นาย', 'สุขภวัฒ', 'ศิริมูล', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(218, '', '', 'วัชระ', 'โฉมศรี', 0, 'พนักงานช่าง', '', 'watchara.chomesri@cmu.ac.th', '', '', 0, NULL, 'watchara.chomesri@cmu.ac.th', NULL, 'นาย', 'วัชระ', 'โฉมศรี', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(219, '', '', 'นริศ', 'เมืองแก่น', 0, 'พนักงานช่าง', '', 'narid.m@cmu.ac.th', '', '', 0, NULL, 'narid.m@cmu.ac.th', NULL, 'นาย', 'นริศ', 'เมืองแก่น', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(220, '', '', 'วิษณุ', 'ตันไพจิตร', 0, 'พนักงานช่าง', '', 'visanu.t@cmu.ac.th', '', '', 0, NULL, 'visanu.t@cmu.ac.th', NULL, 'นาย', 'วิษณุ', 'ตันไพจิตร', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(221, '', '', 'วัชรพงษ์', 'สมศรี', 0, 'พนักงานช่าง', '', 'watcharapong.somsri@cmu.ac.th', '', '', 0, NULL, 'watcharapong.somsri@cmu.ac.th', NULL, 'นาย', 'วัชรพงษ์', 'สมศรี', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(222, '', '', 'ทรงกลด', 'มายาง', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'songklot.m@cmu.ac.th', '', '', 0, NULL, 'songklot.m@cmu.ac.th', NULL, 'นาย', 'ทรงกลด', 'มายาง', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(223, '', '', 'อนัญญา', 'ลัทธิกุล', 0, 'นักจัดการงานทั่วไป', '', 'ananya.l@cmu.ac.th', '', '', 0, NULL, 'ananya.l@cmu.ac.th', NULL, 'นางสาว', 'อนัญญา', 'ลัทธิกุล', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(224, '', '', 'นพดล', 'หวลสัตย์', 0, 'พนักงานสถานที่', '', 'nopphadon.h@cmu.ac.th', '', '', 0, NULL, 'nopphadon.h@cmu.ac.th', NULL, 'นาย', 'นพดล', 'หวลสัตย์', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(225, '', '', 'อิสราภรณ์', 'ลายเขียว', 0, 'นักจัดการงานทั่วไป', '', 'aitsaraporn.l@cmu.ac.th', '', '', 0, NULL, 'aitsaraporn.l@cmu.ac.th', NULL, 'นางสาว', 'อิสราภรณ์', 'ลายเขียว', NULL, NULL, 0, 15, 0, 0, 0, 0, 0, 2, 0, NULL),
(226, '', '', 'ประเสริฐ', 'มาวิมล', 0, 'วิศวกรไฟฟ้า', '', 'prasert.m@cmu.ac.th', '', '', 0, NULL, 'prasert.m@cmu.ac.th', NULL, 'นาย', 'ประเสริฐ', 'มาวิมล', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 2, 0, NULL),
(227, '', '', 'ประยูร', 'บัวรินทร์', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'prayoon.b@cmu.ac.th', '', '', 0, NULL, 'prayoon.b@cmu.ac.th', NULL, 'นาย', 'ประยูร', 'บัวรินทร์', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 2, 0, NULL),
(228, '', '', 'ประยูรศักดิ์', 'พรายจันทร์', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'prayoonsak.p@cmu.ac.th', '', '', 0, NULL, 'prayoonsak.p@cmu.ac.th', NULL, 'นาย', 'ประยูรศักดิ์', 'พรายจันทร์', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 2, 0, NULL);
INSERT INTO `tbl_members` (`user_id`, `username`, `password`, `fname`, `lname`, `is_dean`, `position_work`, `position`, `email`, `tel`, `img`, `Ulevel`, `tmp_pass`, `cmuitaccount`, `cmuitaccount_name`, `prename_TH`, `firstname_TH`, `lastname_TH`, `itaccounttype_id`, `itaccounttype_TH`, `groupId`, `dep_id`, `is_manage_sequence`, `is_finance`, `is_step_flow`, `is_step_secretary`, `is_step_dean`, `typeposition_id`, `is_step_plan`, `lineToken`) VALUES
(229, '', '', 'แสงเดือน', 'โปธา', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'sangdaun.p@cmu.ac.th', '', '', 0, NULL, 'sangdaun.p@cmu.ac.th', NULL, 'นางสาว', 'แสงเดือน', 'โปธา', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 2, 0, NULL),
(230, '', '', 'อุไรวรรณ', 'ไชยถา', 0, 'นักจัดการงานทั่วไป', '', 'uraiwan.ch@cmu.ac.th', '', '', 0, NULL, 'uraiwan.ch@cmu.ac.th', NULL, 'นางสาว', 'อุไรวรรณ', 'ไชยถา', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 2, 0, NULL),
(231, '', '', 'สุชาดา', 'มหาไม้', 0, 'วิศวกร', '', 'suchada.ma@cmu.ac.th', '', '', 0, NULL, 'suchada.ma@cmu.ac.th', NULL, 'ว่าที่ร้อยตรีหญิง', 'สุชาดา', 'มหาไม้', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 2, 0, NULL),
(232, '', '', 'ราเมศ', 'นันทจันทร์', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'ramest.nantajan@cmu.ac.th', '', '', 0, NULL, 'ramest.nantajan@cmu.ac.th', NULL, 'นาย', 'ราเมศ', 'นันทจันทร์', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 2, 0, NULL),
(233, '', '', 'นัฐนันท์', 'บุตรศักดิ์', 0, 'นักจัดการงานทั่วไป', '', 'nuttanan.bu@cmu.ac.th', '', '', 0, NULL, 'nuttanan.bu@cmu.ac.th', NULL, 'นางสาว', 'นัฐนันท์', 'บุตรศักดิ์', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 2, 0, NULL),
(234, '', '', 'มัฒนา', 'เครืออุ่นเรือน', 0, 'พนักงานบริการทั่วไป', '', 'matana.k@cmu.ac.th', '', '', 0, NULL, 'matana.k@cmu.ac.th', NULL, 'นางสาว', 'มัฒนา', 'เครืออุ่นเรือน', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 2, 0, NULL),
(235, '', '', 'สุวิทย์', 'สิทธิชัยวงศ์', 0, 'พนักงานสถานที่', '', 'suwit.s@cmu.ac.th', '', '', 0, NULL, 'suwit.s@cmu.ac.th', NULL, 'นาย', 'สุวิทย์', 'สิทธิชัยวงศ์', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 2, 0, NULL),
(236, '', '', 'ดั่งฤทัย', 'อินมณี', 0, 'นักจัดการงานทั่วไป', '', 'dungruthai.i@cmu.ac.th', '', '', 0, NULL, 'dungruthai.i@cmu.ac.th', NULL, 'นางสาว', 'ดั่งฤทัย', 'อินมณี', NULL, NULL, 0, 16, 0, 0, 0, 0, 0, 2, 0, NULL),
(237, '', '', 'ศุภกานต์', 'ธิเตจ๊ะ', 0, 'นักวิทยาศาสตร์', '', 'suppagarn.t@cmu.ac.th', '', '', 0, NULL, 'suppagarn.t@cmu.ac.th', NULL, 'นาย', 'ศุภกานต์', 'ธิเตจ๊ะ', NULL, NULL, 0, 19, 0, 0, 0, 0, 0, 2, 0, NULL),
(238, '', '', 'ศิวดล', 'สุภาเปี้ย', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'siwadol.s@cmu.ac.th', '', '', 0, NULL, 'siwadol.s@cmu.ac.th', NULL, 'นาย', 'ศิวดล', 'สุภาเปี้ย', NULL, NULL, 0, 19, 0, 0, 0, 0, 0, 2, 0, NULL),
(239, '', '', 'สุทิน', 'เมทา', 0, 'พนักงานบริการทั่วไป', '', 'suthin.meta@cmu.ac.th', '', '', 0, NULL, 'suthin.meta@cmu.ac.th', NULL, 'นาย', 'สุทิน', 'เมทา', NULL, NULL, 0, 19, 0, 0, 0, 0, 0, 2, 0, NULL),
(240, '', '', 'ปุณณิฐฐา', 'ธัญญาพิชญะนันท์', 0, 'นักจัดการงานทั่วไป', '', 'phoonnistha.t@cmu.ac.th', '', '', 0, NULL, 'phoonnistha.t@cmu.ac.th', NULL, 'นางสาว', 'ปุณณิฐฐา', 'ธัญญาพิชญะนันท์', NULL, NULL, 0, 19, 0, 0, 0, 0, 0, 2, 0, NULL),
(241, '', '', 'เครือวัลย์', 'บุญเกิด', 0, 'พนักงานบริการทั่วไป', '', 'khrueawan.b@cmu.ac.th', '', '', 0, NULL, 'khrueawan.b@cmu.ac.th', NULL, 'นาง', 'เครือวัลย์', 'บุญเกิด', NULL, NULL, 0, 19, 0, 0, 0, 0, 0, 2, 0, NULL),
(242, '', '', 'กิตติทัศน์', 'ผ่องศรีธนสกุล', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'kittithat.ph@cmu.ac.th', '', '', 0, NULL, 'kittithat.ph@cmu.ac.th', NULL, 'นาย', 'กิตติทัศน์', 'ผ่องศรีธนสกุล', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 2, 0, NULL),
(243, '', '', 'สุทธิพงศ์', 'คำดี', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'suttipong.k@cmu.ac.th', '', '', 0, NULL, 'suttipong.k@cmu.ac.th', NULL, 'นาย', 'สุทธิพงศ์', 'คำดี', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 2, 0, NULL),
(244, '', '', 'ธนโชติ', 'เมืองใจ', 0, 'วิศวกร', '', 'thanachot.m@cmu.ac.th', '', '', 0, NULL, 'thanachot.m@cmu.ac.th', NULL, 'นาย', 'ธนโชติ', 'เมืองใจ', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 2, 0, NULL),
(245, '', '', 'ณรงค์', 'ศรีวิชัย', 0, 'พนักงานช่าง', '', 'narong.sri@cmu.ac.th', '', '', 0, NULL, 'narong.sri@cmu.ac.th', NULL, 'นาย', 'ณรงค์', 'ศรีวิชัย', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 2, 0, NULL),
(246, '', '', 'ผดุงศักดิ์', 'ปันครอง', 0, 'พนักงานบริการทั่วไป', '', 'phadungsak.p@cmu.ac.th', '', '', 0, NULL, 'phadungsak.p@cmu.ac.th', NULL, 'นาย', 'ผดุงศักดิ์', 'ปันครอง', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 2, 0, NULL),
(247, '', '', 'เสน่ห์', 'แก้วพงค์ธิ', 0, 'พนักงานบริการทั่วไป', '', 'sane.k@cmu.ac.th', '', '', 0, NULL, 'sane.k@cmu.ac.th', NULL, 'นาย', 'เสน่ห์', 'แก้วพงค์ธิ', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 2, 0, NULL),
(248, '', '', 'สุทธิพงษ์', 'กันทา', 0, 'พนักงานบริการทั่วไป', '', 'sutthipong.kantha@cmu.ac.th', '', '', 0, NULL, 'sutthipong.kantha@cmu.ac.th', NULL, 'นาย', 'สุทธิพงษ์', 'กันทา', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 2, 0, NULL),
(249, '', '', 'บุญมี', 'เจิมจันทร์', 0, 'พนักงานบริการทั่วไป', '', 'boonmee.j@cmu.ac.th', '', '', 0, NULL, 'boonmee.j@cmu.ac.th', NULL, 'นาย', 'บุญมี', 'เจิมจันทร์', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 2, 0, NULL),
(250, '', '', 'เกศิณี', 'เรือนคำ', 0, 'วิศวกร', '', 'kasinee.r@cmu.ac.th', '', '', 0, NULL, 'kasinee.r@cmu.ac.th', NULL, 'นางสาว', 'เกศิณี', 'เรือนคำ', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 2, 0, NULL),
(251, '', '', 'วินัย', 'เรือนปัญโญ', 0, 'พนักงานบริการทั่วไป', '', 'winai.r@cmu.ac.th', '', '', 0, NULL, 'winai.r@cmu.ac.th', NULL, 'นาย', 'วินัย', 'เรือนปัญโญ', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 2, 0, NULL),
(252, '', '', 'นิจวรีย์', 'ยศสอน', 0, 'นักจัดการงานทั่วไป', '', 'nitwaree.y@cmu.ac.th', '', '', 0, NULL, 'nitwaree.y@cmu.ac.th', NULL, 'นางสาว', 'นิจวรีย์', 'ยศสอน', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 2, 0, NULL),
(253, '', '', 'ณัฐธิชา', 'ทองหลอม', 0, 'นักจัดการงานทั่วไป', '', 'natticha.th@cmu.ac.th', '', '', 0, NULL, 'natticha.th@cmu.ac.th', NULL, 'นางสาว', 'ณัฐธิชา', 'ทองหลอม', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 2, 0, NULL),
(254, '', '', 'เกศสุนี', 'ทองเมฆ', 0, 'นักจัดการงานทั่วไป', '', 'gatesunee.th@cmu.ac.th', '', '', 0, NULL, 'gatesunee.th@cmu.ac.th', NULL, 'นางสาว', 'เกศสุนี', 'ทองเมฆ', NULL, NULL, 0, 17, 0, 0, 0, 0, 0, 2, 0, NULL),
(255, '', '', 'พรสวรรค์', 'ขัติยศ', 0, 'นักวิทยาศาสตร์', '', 'pornsawan.k@cmu.ac.th', '', '', 0, NULL, 'pornsawan.k@cmu.ac.th', NULL, 'นางสาว', 'พรสวรรค์', 'ขัติยศ', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 2, 0, NULL),
(256, '', '', 'นรเทพ', 'พลวณิช', 0, 'นักวิทยาศาสตร์', '', 'noratep.p@cmu.ac.th', '', '', 0, NULL, 'noratep.p@cmu.ac.th', NULL, 'นาง', 'นรเทพ', 'พลวณิช', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 2, 0, NULL),
(257, '', '', 'สรวิศิษฐ์', 'นิลพรรณ', 0, 'นักจัดการงานทั่วไป', '', 'sorawisit.n@cmu.ac.th', '', '', 0, NULL, 'sorawisit.n@cmu.ac.th', NULL, 'นาย', 'สรวิศิษฐ์', 'นิลพรรณ', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 2, 0, NULL),
(258, '', '', 'กอบกุล', 'ชัยรักษ์', 0, 'พนักงานบริการทั่วไป', '', 'kobkul.m@cmu.ac.th', '', '', 0, NULL, 'kobkul.m@cmu.ac.th', NULL, 'นาง', 'กอบกุล', 'ชัยรักษ์', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 2, 0, NULL),
(259, '', '', 'นารีรัตน์', 'เหมโลหะ', 0, 'นักวิทยาศาสตร์', '', 'nareerat.h@cmu.ac.th', '', '', 0, NULL, 'nareerat.h@cmu.ac.th', NULL, 'นางสาว', 'นารีรัตน์', 'เหมโลหะ', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 2, 0, NULL),
(260, '', '', 'รตนพร', 'พงษ์มณี', 0, 'นักจัดการงานทั่วไป', '', 'ratanaporn.p@cmu.ac.th', '', '', 0, NULL, 'ratanaporn.p@cmu.ac.th', NULL, 'นางสาว', 'รตนพร', 'พงษ์มณี', NULL, NULL, 0, 18, 0, 0, 0, 0, 0, 2, 0, NULL),
(261, '', '', 'อัจฉราวรรณ', 'อินทรส', 0, 'นักจัดการงานทั่วไป', 'หัวหน้างานบริหารทั่วไป', 'atcharawan.i@cmu.ac.th', '', '', 0, NULL, 'atcharawan.i@cmu.ac.th', NULL, 'นาง', 'อัจฉราวรรณ', 'อินทรส', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(262, '', '', 'ภัทราวิจิตร', 'มณีประเสริฐ', 0, 'นักจัดการงานทั่วไป', '', 'pattaravijit.m@cmu.ac.th', '', '', 0, NULL, 'pattaravijit.m@cmu.ac.th', NULL, 'นางสาว', 'ภัทราวิจิตร', 'มณีประเสริฐ', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(263, '', '', 'อนุชิต', 'เนตรศิลป์', 0, 'คนสวน', '', 'anuchit.n@cmu.ac.th', '', '', 0, NULL, 'anuchit.n@cmu.ac.th', NULL, 'นาย', 'อนุชิต', 'เนตรศิลป์', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(264, '', '', 'ชานนท์', 'แก้วบุญเรือง', 0, 'วิศวกร', '', 'chanon.ka@cmu.ac.th', '', '', 0, NULL, 'chanon.ka@cmu.ac.th', NULL, 'นาย', 'ชานนท์', 'แก้วบุญเรือง', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(265, '', '', 'เกียรติชัย', 'บุญทารักษ์', 0, 'นักจัดการงานทั่วไป', '', 'kiattichai.b@cmu.ac.th', '', '', 0, NULL, 'kiattichai.b@cmu.ac.th', NULL, 'นาย', 'เกียรติชัย', 'บุญทารักษ์', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(266, '', '', 'พิกุล', 'อินตากุล', 0, 'นักจัดการงานทั่วไป', '', 'pikul.in@cmu.ac.th', '', '', 0, NULL, 'pikul.in@cmu.ac.th', NULL, 'นางสาว', 'พิกุล', 'อินตากุล', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(267, '', '', 'กมลพร', 'มณีวรรณ', 0, 'นักจัดการงานทั่วไป', '', 'kamonporn.m@cmu.ac.th', '', '', 0, NULL, 'kamonporn.m@cmu.ac.th', NULL, 'นางสาว', 'กมลพร', 'มณีวรรณ', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(268, '', '', 'นัทธพงศ์', 'เสนรังษี', 0, 'นักจัดการงานทั่วไป', '', 'nuttapong.s@cmu.ac.th', '', '', 0, NULL, 'nuttapong.s@cmu.ac.th', NULL, 'นาย', 'นัทธพงศ์', 'เสนรังษี', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(269, '', '', 'วนิตย์', 'เลิศตระกูล', 0, 'รองศาสตราจารย์', '', 'wanit.lerttrakul@cmu.ac.th', '', '', 0, NULL, 'wanit.lerttrakul@cmu.ac.th', NULL, 'นาย', 'วนิตย์', 'เลิศตระกูล', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(270, '', '', 'บุญแวว', 'มหาวัน', 0, 'พนักงานบริการทั่วไป', '', 'bunwaeo.m@cmu.ac.th', '', '', 0, NULL, 'bunwaeo.m@cmu.ac.th', NULL, 'นาง', 'บุญแวว', 'มหาวัน', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(271, '', '', 'จักรกฤช', 'กุนนา', 0, 'พนักงานบริการทั่วไป', '', 'jakkrit.kunna@cmu.ac.th', '', '', 0, NULL, 'jakkrit.kunna@cmu.ac.th', NULL, 'นาย', 'จักรกฤช', 'กุนนา', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(272, '', '', 'นุกุล', 'บัวคำปัน', 0, 'พนักงานช่าง', '', 'nukul.b@cmu.ac.th', '', '', 0, NULL, 'nukul.b@cmu.ac.th', NULL, 'นาย', 'นุกุล', 'บัวคำปัน', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(273, '', '', 'อรพิน', 'ประภาวิลัย', 0, 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานบริหารงานทั่วไป', 'orapin.pra@cmu.ac.th', '', '', 0, NULL, 'orapin.pra@cmu.ac.th', NULL, 'นาง', 'อรพิน', 'ประภาวิลัย', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(274, '', '', 'สมพร', 'พรมมินทร์', 0, 'พนักงานช่าง', '', 'somporn.pomin@cmu.ac.th', '', '', 0, NULL, 'somporn.pomin@cmu.ac.th', NULL, 'ว่าที่ร้อยตรี', 'สมพร', 'พรมมินทร์', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(275, '', '', 'วิชิตา', 'ท้าวหน่อ', 0, 'วิศวกร', '', 'wichita.t@cmu.ac.th', '', '', 0, NULL, 'wichita.t@cmu.ac.th', NULL, 'นางสาว', 'วิชิตา', 'ท้าวหน่อ', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(276, '', '', 'อนุรักษ์', 'แก้วบุญเรือง', 0, 'พนักงานบริการฝีมือ (ด้านเทคนิคและเครื่องยนต์)', '', 'aussatakorn.keaw@cmu.ac.th', '', '', 0, NULL, 'aussatakorn.keaw@cmu.ac.th', NULL, 'นาย', 'อนุรักษ์', 'แก้วบุญเรือง', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(277, '', '', 'วันเพ็ญ', 'แซ่หลู่', 0, 'พนักงานบริการทั่วไป', '', 'wanpen.saelu@cmu.ac.th', '', '', 0, NULL, 'wanpen.saelu@cmu.ac.th', NULL, 'นางสาว', 'วันเพ็ญ', 'แซ่หลู่', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(278, '', '', 'สดายุ', 'คำทอง', 0, 'นักจัดการงานทั่วไป', '', 'sadayu.k@cmu.ac.th', '', '', 0, NULL, 'sadayu.k@cmu.ac.th', NULL, 'นาง', 'สดายุ', 'คำทอง', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(279, '', '', 'ปิติรัตน์', 'นันทวาศ', 0, 'พนักงานบริการทั่วไป', '', 'pitirat.nan@cmu.ac.th', '', '', 0, NULL, 'pitirat.nan@cmu.ac.th', NULL, 'นาย', 'ปิติรัตน์', 'นันทวาศ', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(280, '', '', 'ศศิกานต์', 'กองค้า', 0, 'นักจัดการงานทั่วไป', '', 'sasikan.k@cmu.ac.th', '', '', 0, NULL, 'sasikan.k@cmu.ac.th', NULL, 'นางสาว', 'ศศิกานต์', 'กองค้า', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(281, '', '', 'ชานนท์', 'ทินหนุน', 0, 'พนักงานบริการฝีมือ (ด้านเทคนิคและเครื่องยนต์)', '', 'chanon.t@cmu.ac.th', '', '', 0, NULL, 'chanon.t@cmu.ac.th', NULL, 'นาย', 'ชานนท์', 'ทินหนุน', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(282, '', '', 'วรพงษ์', 'ดาวเลิศ', 0, 'พนักงานช่าง', '', 'worapong.d@cmu.ac.th', '', '', 0, NULL, 'worapong.d@cmu.ac.th', NULL, 'นาย', 'วรพงษ์', 'ดาวเลิศ', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(283, '', '', 'มณีรัตน์', 'เงินก่ำ', 0, 'นักจัดการงานทั่วไป', '', 'maneerat.n@cmu.ac.th', '', '', 0, NULL, 'maneerat.n@cmu.ac.th', NULL, 'นางสาว', 'มณีรัตน์', 'เงินก่ำ', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(284, '', '', 'ชนิกานต์', 'ใจนวล', 0, 'นักจัดการงานทั่วไป', '', 'chanikan.jai@cmu.ac.th', '', '', 0, NULL, 'chanikan.jai@cmu.ac.th', NULL, 'นางสาว', 'ชนิกานต์', 'ใจนวล', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(285, '', '', 'ปฏิภาณ', 'วงศ์เทพ', 0, 'พนักงานบริการทั่วไป', '', 'patipan.w@cmu.ac.th', '', '', 0, NULL, 'patipan.w@cmu.ac.th', NULL, 'นาย', 'ปฏิภาณ', 'วงศ์เทพ', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(286, '', '', 'สงกรานต์', 'สุวรรณคำ', 0, 'พนักงานบริการทั่วไป', '', 'songkran.s@cmu.ac.th', '', '', 0, NULL, 'songkran.s@cmu.ac.th', NULL, 'นาง', 'สงกรานต์', 'สุวรรณคำ', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(287, '', '', 'จักรกริช', 'กวงแหวน', 0, 'นักจัดการงานทั่วไป', '', 'jakkrit.ku@cmu.ac.th', '', '', 0, NULL, 'jakkrit.ku@cmu.ac.th', NULL, 'นาย', 'จักรกริช', 'กวงแหวน', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(288, '', '', 'รัชชานนท์', 'มงคลวัจน์', 0, 'วิศวกร', '', 'ratchanon.m@cmu.ac.th', '', '', 0, NULL, 'ratchanon.m@cmu.ac.th', NULL, 'นาย', 'รัชชานนท์', 'มงคลวัจน์', NULL, NULL, 0, 8, 0, 0, 0, 0, 0, 2, 0, NULL),
(289, '', '', 'สินีนุช', 'พรหมมิจิตร', 0, 'นักการเงินและบัญชี', '', 'sineenuch.p@cmu.ac.th', '', '', 0, NULL, 'sineenuch.p@cmu.ac.th', NULL, 'นางสาว', 'สินีนุช', 'พรหมมิจิตร', NULL, NULL, 0, 13, 0, 0, 0, 0, 0, 2, 0, NULL),
(290, '', '', 'ณัฐวรรณ', 'วรินทร์รักษ์', 0, 'นักการเงินและบัญชี', '', 'nattawan.v@cmu.ac.th', '', '', 0, NULL, 'nattawan.v@cmu.ac.th', NULL, 'นางสาว', 'ณัฐวรรณ', 'วรินทร์รักษ์', NULL, NULL, 0, 13, 0, 0, 0, 0, 0, 2, 0, NULL),
(291, '', '', 'เชษฐ์ดนัย', 'พราหมณ์บุญมี', 0, 'พนักงานพัสดุ', '', 'chetdanai.p@cmu.ac.th', '', '', 0, NULL, 'chetdanai.p@cmu.ac.th', NULL, 'นาย', 'เชษฐ์ดนัย', 'พราหมณ์บุญมี', NULL, NULL, 0, 13, 0, 0, 0, 0, 0, 2, 0, NULL),
(292, '', '', 'ปรียาภัทร', 'ปาคำ', 0, 'นักการเงินและบัญชี', '', 'preeyapat.p@cmu.ac.th', '', '', 0, NULL, 'preeyapat.p@cmu.ac.th', NULL, 'นางสาว', 'ปรียาภัทร', 'ปาคำ', NULL, NULL, 0, 13, 1, 1, 1, 0, 0, 2, 0, NULL),
(293, '', '', 'วสันต์', 'ฉายหิรัญ', 0, 'นักจัดการงานทั่วไป', '', 'wasan.ch@cmu.ac.th', '', '', 0, NULL, 'wasan.ch@cmu.ac.th', NULL, 'นาย', 'วสันต์', 'ฉายหิรัญ', NULL, NULL, 0, 13, 0, 0, 0, 0, 0, 2, 0, NULL),
(294, '', '', 'สุทธิลักษณ์', 'จักร์ปั๋น', 0, 'นักจัดการงานทั่วไป', '', 'suttiluk.c@cmu.ac.th', '', '', 0, NULL, 'suttiluk.c@cmu.ac.th', NULL, 'นางสาว', 'สุทธิลักษณ์', 'จักร์ปั๋น', NULL, NULL, 0, 13, 0, 0, 0, 0, 0, 2, 0, NULL),
(295, '', '', 'พชรพล', 'อินทกุล', 0, 'นักจัดการงานทั่วไป', '', 'phacharaphon.i@cmu.ac.th', '', '', 0, NULL, 'phacharaphon.i@cmu.ac.th', NULL, 'นาย', 'พชรพล', 'อินทกุล', NULL, NULL, 0, 13, 0, 0, 0, 0, 0, 2, 0, NULL),
(296, '', '', 'นฤมล', 'กาวิละวงค์', 0, 'นักการเงินและบัญชี', '', 'naruemon.kawi@cmu.ac.th', '', '', 0, NULL, 'naruemon.kawi@cmu.ac.th', NULL, 'นางสาว', 'นฤมล', 'กาวิละวงค์', NULL, NULL, 0, 13, 0, 0, 0, 0, 0, 2, 0, NULL),
(297, '', '', 'ยุพินพร', 'โนนจุ้ย', 0, 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานการเงินฯ', 'yuphinporn.nondjuy@cmu.ac.th', '', '', 0, NULL, 'yuphinporn.nondjuy@cmu.ac.th', NULL, 'นาง', 'ยุพินพร', 'โนนจุ้ย', NULL, NULL, 0, 13, 0, 0, 0, 0, 0, 2, 0, NULL),
(298, '', '', 'สุวิมล', 'มะธุ', 0, 'นักการเงินและบัญชี', 'ผู้ช่วยหัวหน้างานการเงินฯ', 'suwimon.mathu@cmu.ac.th', '', '', 0, NULL, 'suwimon.mathu@cmu.ac.th', NULL, 'นางสาว', 'สุวิมล', 'มะธุ', NULL, NULL, 0, 13, 0, 0, 0, 0, 0, 2, 0, NULL),
(299, '', '', 'วราลี', 'ช่างย้อม', 0, 'นักการเงินและบัญชี', 'หัวหน้างานการเงินฯ', 'waralee.c@cmu.ac.th', '', '', 0, NULL, 'waralee.c@cmu.ac.th', NULL, 'นาง', 'วราลี', 'ช่างย้อม', NULL, NULL, 0, 13, 0, 0, 0, 0, 0, 2, 0, NULL),
(300, '', '', 'ภรณี', 'สรรพศรี', 0, 'นักจัดการงานทั่วไป', '', 'poranee.s@cmu.ac.th', '', '', 0, NULL, 'poranee.s@cmu.ac.th', NULL, 'นางสาว', 'ภรณี', 'สรรพศรี', NULL, NULL, 0, 13, 0, 0, 0, 0, 0, 2, 0, NULL),
(301, '', '', 'ธัชพงศ์', 'เต็มป๊ก', 0, 'นักจัดการงานทั่วไป', '', 'tachchaphong.t@cmu.ac.th', '', '', 0, NULL, 'tachchaphong.t@cmu.ac.th', NULL, 'นาย', 'ธัชพงศ์', 'เต็มป๊ก', NULL, NULL, 0, 13, 0, 0, 0, 0, 0, 2, 0, NULL),
(302, '', '', 'ยุพิณ', 'บัวคำปัน', 0, 'นักการเงินและบัญชี', '', 'yupin.b@cmu.ac.th', '', '', 0, NULL, 'yupin.b@cmu.ac.th', NULL, 'นางสาว', 'ยุพิณ', 'บัวคำปัน', NULL, NULL, 0, 13, 0, 0, 0, 0, 0, 2, 0, NULL),
(303, '', '', 'ณิชนันทน์', 'กันชะนะ', 0, 'นักการเงินและบัญชี', '', 'nidchanun.kan@cmu.ac.th', '', '', 0, NULL, 'nidchanun.kan@cmu.ac.th', NULL, 'นางสาว', 'ณิชนันทน์', 'กันชะนะ', NULL, NULL, 0, 13, 0, 0, 0, 0, 0, 2, 0, NULL),
(304, '', '', 'กันตินันท์', 'คำราพิช', 0, 'นักจัดการงานทั่วไป', '', 'kantinan.k@cmu.ac.th', '', '', 0, NULL, 'kantinan.k@cmu.ac.th', NULL, 'นางสาว', 'กันตินันท์', 'คำราพิช', NULL, NULL, 0, 13, 0, 0, 0, 0, 0, 2, 0, NULL),
(305, '', '', 'ทิพวรรณ', 'บุญหล้า', 0, 'นักจัดการงานทั่วไป', '', 'tippawan.b@cmu.ac.th', '', '', 0, NULL, 'tippawan.b@cmu.ac.th', NULL, 'นางสาว', 'ทิพวรรณ', 'บุญหล้า', NULL, NULL, 0, 7, 1, 0, 0, 0, 0, 2, 0, NULL),
(306, '', '', 'ธัญนันท์', 'มาดี', 0, 'นักจัดการงานทั่วไป', '', 'tanyanan.m@cmu.ac.th', '', '', 0, NULL, 'tanyanan.m@cmu.ac.th', NULL, 'นางสาว', 'ธัญนันท์', 'มาดี', NULL, NULL, 0, 7, 1, 0, 0, 0, 0, 2, 1, NULL),
(307, '', '', 'มฤฉัตร', 'เจริญทรัพย์', 0, 'นักจัดการงานทั่วไป', 'หัวหน้างานนโยบายและแผนฯ', 'maruechat.c@cmu.ac.th', '', '', 0, NULL, 'maruechat.c@cmu.ac.th', NULL, 'นาง', 'มฤฉัตร', 'เจริญทรัพย์', NULL, NULL, 0, 7, 0, 0, 0, 0, 0, 2, 0, NULL),
(308, '', '', 'พิมลพร', 'อภิรมย์ชัยกุล', 0, 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานนโยบายและแผนฯ', 'pimonporn.m@cmu.ac.th', '', '', 0, NULL, 'pimonporn.m@cmu.ac.th', NULL, 'นางสาว', 'พิมลพร', 'อภิรมย์ชัยกุล', NULL, NULL, 0, 7, 0, 0, 1, 0, 0, 2, 0, NULL),
(309, '', '', 'ชลธิชา', 'แก้วบุญเรือง', 0, 'นักจัดการงานทั่วไป', '', 'chonthicha.kaew@cmu.ac.th', '', '', 0, NULL, 'chonthicha.kaew@cmu.ac.th', NULL, 'นางสาว', 'ชลธิชา', 'แก้วบุญเรือง', NULL, NULL, 0, 7, 0, 0, 0, 0, 0, 2, 0, NULL),
(310, '', '', 'สุทัศน์', 'ขันเลข', 0, 'นักวิชาการศึกษา', 'หัวหน้างานบริการการศึกษา', 'sutat.k@cmu.ac.th', '', '', 0, NULL, 'sutat.k@cmu.ac.th', NULL, 'นาย', 'สุทัศน์', 'ขันเลข', NULL, NULL, 0, 2, 0, 0, 0, 0, 0, 2, 0, NULL),
(311, '', '', 'ภิญญาพัชญ์', 'ยุตบุตร', 0, 'นักจัดการงานทั่วไป', '', 'apisada.y@cmu.ac.th', '', '', 0, NULL, 'apisada.y@cmu.ac.th', NULL, 'นางสาว', 'ภิญญาพัชญ์', 'ยุตบุตร', NULL, NULL, 0, 2, 0, 0, 0, 0, 0, 2, 0, NULL),
(312, '', '', 'กาญจนา', 'นะพรานบุญ', 0, 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานริการการศึกษา', 'kanchana.na@cmu.ac.th', '', '', 0, NULL, 'kanchana.na@cmu.ac.th', NULL, 'นาง', 'กาญจนา', 'นะพรานบุญ', NULL, NULL, 0, 2, 0, 0, 0, 0, 0, 2, 0, NULL),
(313, '', '', 'ณัฐอารี', 'ตุ่นจาอ้าย', 0, 'นักจัดการงานทั่วไป', '', 'somtawin.t@cmu.ac.th', '', '', 0, NULL, 'somtawin.t@cmu.ac.th', NULL, 'นางสาว', 'ณัฐอารี', 'ตุ่นจาอ้าย', NULL, NULL, 0, 2, 0, 0, 0, 0, 0, 2, 0, NULL),
(314, '', '', 'สุภาพร', 'หลวงธิ', 0, 'นักจัดการงานทั่วไป', '', 'supaporn.luangthi@cmu.ac.th', '', '', 0, NULL, 'supaporn.luangthi@cmu.ac.th', NULL, 'นางสาว', 'สุภาพร', 'หลวงธิ', NULL, NULL, 0, 2, 0, 0, 0, 0, 0, 2, 0, NULL),
(315, '', '', 'ณิชนันทน์', 'ปัญญาชลรักษ์', 0, 'นักจัดการงานทั่วไป', '', 'nitchanan.p@cmu.ac.th', '', '', 0, NULL, 'nitchanan.p@cmu.ac.th', NULL, 'นางสาว', 'ณิชนันทน์', 'ปัญญาชลรักษ์', NULL, NULL, 0, 2, 0, 0, 0, 0, 0, 2, 0, NULL),
(316, '', '', 'รพีภัทร', 'รินดวงดี', 0, 'บรรณารักษ์', '', 'raphiphat.r@cmu.ac.th', '', '', 0, NULL, 'raphiphat.r@cmu.ac.th', NULL, 'นางสาว', 'รพีภัทร', 'รินดวงดี', NULL, NULL, 0, 2, 0, 0, 0, 0, 0, 2, 0, NULL),
(317, '', '', 'ไพลิน', 'สิงห์เปา', 0, 'เจ้าหน้าที่สำนักงาน', '', 'pailin.s@cmu.ac.th', '', '', 0, NULL, 'pailin.s@cmu.ac.th', NULL, 'นางสาว', 'ไพลิน', 'สิงห์เปา', NULL, NULL, 0, 2, 0, 0, 0, 0, 0, 2, 0, NULL),
(318, '', '', 'ธัญชนก', 'มายาง', 0, 'นักจัดการงานทั่วไป', '', 'tanchanok.mayang@cmu.ac.th', '', '', 0, NULL, 'tanchanok.mayang@cmu.ac.th', NULL, 'นาง', 'ธัญชนก', 'มายาง', NULL, NULL, 0, 2, 0, 0, 0, 0, 0, 2, 0, NULL),
(319, '', '', 'รัชพล', 'เครือทอง', 0, 'นักจัดการงานทั่วไป', '', 'ratchapol.k@cmu.ac.th', '', '', 0, NULL, 'ratchapol.k@cmu.ac.th', NULL, 'นาย', 'รัชพล', 'เครือทอง', NULL, NULL, 0, 2, 0, 0, 0, 0, 0, 2, 0, NULL),
(320, '', '', 'กิตติศักดิ์', 'ตุ่นกันทา', 0, 'นักจัดการงานทั่วไป', '', 'kittisak.t@cmu.ac.th', '', '', 0, NULL, 'kittisak.t@cmu.ac.th', NULL, 'นาย', 'กิตติศักดิ์', 'ตุ่นกันทา', NULL, NULL, 0, 2, 0, 0, 0, 0, 0, 2, 0, NULL),
(321, '', '', 'ทัศพร', 'จันทนานุวัฒน์กุล', 0, 'นักจัดการงานทั่วไป', '', 'tassaporn.c@cmu.ac.th', '', '', 0, NULL, 'tassaporn.c@cmu.ac.th', NULL, 'นางสาว', 'ทัศพร', 'จันทนานุวัฒน์กุล', NULL, NULL, 0, 2, 0, 0, 0, 0, 0, 2, 0, NULL),
(322, '', '', 'อลงกต', 'เทพคำอ้าย', 0, 'นักจัดการงานทั่วไป', '', 'alongkoat.thep@cmu.ac.th', '', '', 0, NULL, 'alongkoat.thep@cmu.ac.th', NULL, 'นาย', 'อลงกต', 'เทพคำอ้าย', NULL, NULL, 0, 6, 0, 0, 0, 0, 0, 2, 0, NULL),
(323, '', '', 'ณัฐพร', 'ใจพุทธ', 0, 'นักจัดการงานทั่วไป', 'หัวหน้างานบริหารงานวิจัยฯ', 'nattaporn.j@cmu.ac.th', '', '', 0, NULL, 'nattaporn.j@cmu.ac.th', NULL, 'นางสาว', 'ณัฐพร', 'ใจพุทธ', NULL, NULL, 0, 6, 0, 0, 0, 0, 0, 2, 0, NULL),
(324, '', '', 'กิตติภพ', 'พรหมเผ่า', 0, 'วิศวกร', '', 'kittiphop.pr@cmu.ac.th', '', '', 0, NULL, 'kittiphop.pr@cmu.ac.th', NULL, 'นาย', 'กิตติภพ', 'พรหมเผ่า', NULL, NULL, 0, 6, 0, 0, 0, 0, 0, 2, 0, NULL),
(325, '', '', 'วรธิดา', 'อุดมสม', 0, 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานงานวิจัยฯ', 'waratida.u@cmu.ac.th', '', '', 0, NULL, 'waratida.u@cmu.ac.th', NULL, 'นางสาว', 'วรธิดา', 'อุดมสม', NULL, NULL, 0, 6, 0, 0, 0, 0, 0, 2, 0, NULL),
(326, '', '', 'มนตรี', 'มาแสน', 0, 'วิศวกร', '', 'moltri.marsaen@cmu.ac.th', '', '', 0, NULL, 'moltri.marsaen@cmu.ac.th', NULL, 'นาย', 'มนตรี', 'มาแสน', NULL, NULL, 0, 6, 0, 0, 0, 0, 0, 2, 0, NULL),
(327, '', '', 'ศศิณา', 'สิทธิชมภู', 0, 'นักจัดการงานทั่วไป', '', 'sasinar.s@cmu.ac.th', '', '', 0, NULL, 'sasinar.s@cmu.ac.th', NULL, 'นางสาว', 'ศศิณา', 'สิทธิชมภู', NULL, NULL, 0, 6, 0, 0, 0, 0, 0, 2, 0, NULL),
(328, '', '', 'ทรงศักดิ์', 'ขลังวิชา', 0, 'นักจัดการงานทั่วไป', '', 'songsak.k@cmu.ac.th', '', '', 0, NULL, 'songsak.k@cmu.ac.th', NULL, 'นาย', 'ทรงศักดิ์', 'ขลังวิชา', NULL, NULL, 0, 6, 0, 0, 0, 0, 0, 2, 0, NULL),
(329, '', '', 'อริศรา', 'กัลยาณวุฒิ', 0, 'นักจัดการงานทั่วไป', '', 'arisara.ka@cmu.ac.th', '', '', 0, NULL, 'arisara.ka@cmu.ac.th', NULL, 'นางสาว', 'อริศรา', 'กัลยาณวุฒิ', NULL, NULL, 0, 6, 0, 0, 0, 0, 0, 2, 0, NULL),
(330, '', '', 'สุกัญญา', 'พิบูลย์', 0, 'นักจัดการงานทั่วไป', 'หัวหน้างานพัฒนาคุณภาพฯ', 'sukanya.pi@cmu.ac.th', '', '', 0, NULL, 'sukanya.pi@cmu.ac.th', NULL, 'นาง', 'สุกัญญา', 'พิบูลย์', NULL, NULL, 0, 28, 0, 0, 0, 0, 0, 2, 0, NULL),
(331, '', '', 'เนตรนภา', 'สาระแปง', 0, 'นักจัดการงานทั่วไป', '', 'natnapa.s@cmu.ac.th', '', '', 0, NULL, 'natnapa.s@cmu.ac.th', NULL, 'นางสาว', 'เนตรนภา', 'สาระแปง', NULL, NULL, 0, 28, 0, 0, 0, 0, 0, 2, 0, NULL),
(332, '', '', 'ชนากานต์', 'ปันต๊ะถา', 0, 'นักจัดการงานทั่วไป', '', 'chanakan.pa@cmu.ac.th', '', '', 0, NULL, 'chanakan.pa@cmu.ac.th', NULL, 'นางสาว', 'ชนากานต์', 'ปันต๊ะถา', NULL, NULL, 0, 28, 0, 0, 0, 0, 0, 2, 0, NULL),
(333, '', '', 'นัฏพันธุ์', 'นันทวาศ', 0, 'นักจัดการงานทั่วไป', 'หัวหน้างานพัฒนาเทคโนฯ', 'nattapan.n@cmu.ac.th', '', '', 0, NULL, 'nattapan.n@cmu.ac.th', NULL, 'นาย', 'นัฏพันธุ์', 'นันทวาศ', NULL, NULL, 0, 29, 0, 0, 0, 0, 0, 2, 0, NULL),
(334, '', '', 'อัครเดช', 'ประกอบของ', 0, 'นักจัดการงานทั่วไป', '', 'akaradate.p@cmu.ac.th', '', '', 0, NULL, 'akaradate.p@cmu.ac.th', NULL, 'นาย', 'อัครเดช', 'ประกอบของ', NULL, NULL, 0, 29, 0, 0, 0, 0, 0, 2, 0, NULL),
(335, '', '', 'วินัย', 'คำสุรินทร์', 0, 'นักวิชาการคอมพิวเตอร์', '', 'winai.k@cmu.ac.th', '', '', 0, NULL, 'winai.k@cmu.ac.th', NULL, 'นาย', 'วินัย', 'คำสุรินทร์', NULL, NULL, 0, 29, 0, 0, 0, 0, 0, 2, 0, NULL),
(336, '', '', 'นิวัฒน์', 'เจริญรัตนเดชะกูล', 0, 'นักวิชาการคอมพิวเตอร์', '', 'niwat.j@cmu.ac.th', '', '', 0, NULL, 'niwat.j@cmu.ac.th', NULL, 'นาย', 'นิวัฒน์', 'เจริญรัตนเดชะกูล', NULL, NULL, 0, 29, 0, 0, 0, 0, 0, 2, 0, NULL),
(337, '', '', 'ปัฐมกานต์', 'ระเบ็ง', 0, 'นักจัดการงานทั่วไป', '', 'patthamakarn.r@cmu.ac.th', '', '', 0, NULL, 'patthamakarn.r@cmu.ac.th', NULL, 'นาง', 'ปัฐมกานต์', 'ระเบ็ง', NULL, NULL, 0, 29, 0, 0, 0, 0, 0, 2, 0, NULL),
(338, '', '', 'สิทธิพงษ์', 'บุญเพ็ชร', 0, 'นักจัดการงานทั่วไป', '', 'sittipong.b@cmu.ac.th', '', '', 0, NULL, 'sittipong.b@cmu.ac.th', NULL, 'นาย', 'สิทธิพงษ์', 'บุญเพ็ชร', NULL, NULL, 0, 29, 0, 0, 0, 0, 0, 2, 0, NULL),
(339, '', '', 'สุทธิพงค์', 'ริโปนยอง', 0, 'นักวิชาการคอมพิวเตอร์', '', 'suttipong.r@cmu.ac.th', '', '', 0, NULL, 'suttipong.r@cmu.ac.th', NULL, 'นาย', 'สุทธิพงค์', 'ริโปนยอง', NULL, NULL, 0, 29, 0, 0, 0, 0, 0, 2, 0, NULL),
(340, '', '', 'เฉลิมพร', 'กุรานา', 0, 'นักจัดการงานทั่วไป', '', 'chalermporn.gurana@cmu.ac.th', '', '', 0, NULL, 'chalermporn.gurana@cmu.ac.th', NULL, 'นาง', 'เฉลิมพร', 'กุรานา', NULL, NULL, 0, 32, 0, 0, 0, 0, 0, 2, 0, NULL),
(341, '', '', 'ณัฐวีณ์', 'ไชยริศรี', 0, 'นักจัดการงานทั่วไป', '', 'nattavee.ch@cmu.ac.th', '', '', 0, NULL, 'nattavee.ch@cmu.ac.th', NULL, 'นางสาว', 'ณัฐวีณ์', 'ไชยริศรี', NULL, NULL, 0, 32, 0, 0, 0, 0, 0, 2, 0, NULL),
(342, '', '', 'สารัช', 'ศรีบูรณ์', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'sarach.sri@cmu.ac.th', '', '', 0, NULL, 'sarach.sri@cmu.ac.th', NULL, 'นาย', 'สารัช', 'ศรีบูรณ์', NULL, NULL, 0, 32, 0, 0, 0, 0, 0, 2, 0, NULL),
(343, '', '', 'ธัญมล', 'วรรณละเอียด', 0, 'นักจัดการงานทั่วไป', '', 'tunyamon.wa@cmu.ac.th', '', '', 0, NULL, 'tunyamon.wa@cmu.ac.th', NULL, 'นางสาว', 'ธัญมล', 'วรรณละเอียด', NULL, NULL, 0, 32, 0, 0, 0, 0, 0, 2, 0, NULL),
(344, '', '', 'อรกัญญา', 'พุทธวงค์', 0, 'นักจัดการงานทั่วไป', '', 'aurakanya.p@cmu.ac.th', '', '', 0, NULL, 'aurakanya.p@cmu.ac.th', NULL, 'นางสาว', 'อรกัญญา', 'พุทธวงค์', NULL, NULL, 0, 32, 0, 0, 0, 0, 0, 2, 0, NULL),
(345, '', '', 'ธนาวุฒิ', 'ธีรเกียรติกุล', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'thanawut.th@cmu.ac.th', '', '', 0, NULL, 'thanawut.th@cmu.ac.th', NULL, 'นาย', 'ธนาวุฒิ', 'ธีรเกียรติกุล', NULL, NULL, 0, 32, 0, 0, 0, 0, 0, 2, 0, NULL),
(346, '', '', 'บัญชา', 'สุวรรณพิทักษ์', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'bancha.s@cmu.ac.th', '', '', 0, NULL, 'bancha.s@cmu.ac.th', NULL, 'นาย', 'บัญชา', 'สุวรรณพิทักษ์', NULL, NULL, 0, 32, 0, 0, 0, 0, 0, 2, 0, NULL),
(347, '', '', 'กรทิพย์', 'ชัยยานนท์', 0, 'นักจัดการงานทั่วไป', '', 'kornthip.c@cmu.ac.th', '', '', 0, NULL, 'kornthip.c@cmu.ac.th', NULL, 'นางสาว', 'กรทิพย์', 'ชัยยานนท์', NULL, NULL, 0, 31, 0, 0, 0, 0, 0, 2, 0, NULL),
(348, '', '', 'ณัฏฐนันท์', 'พันธุ์บุญปลูก', 0, 'นักจัดการงานทั่วไป', '', 'nuttasri.senaluang@cmu.ac.th', '', '', 0, NULL, 'nuttasri.senaluang@cmu.ac.th', NULL, 'นางสาว', 'ณัฏฐนันท์', 'พันธุ์บุญปลูก', NULL, NULL, 0, 31, 0, 0, 0, 0, 0, 2, 0, NULL),
(349, '', '', 'ธีร์นภัส', 'ปรากฏมาก', 0, 'นักจัดการงานทั่วไป', '', 'teenaphat.p@cmu.ac.th', '', '', 0, NULL, 'teenaphat.p@cmu.ac.th', NULL, 'นาย', 'ธีร์นภัส', 'ปรากฏมาก', NULL, NULL, 0, 31, 0, 0, 0, 0, 0, 2, 0, NULL),
(350, '', '', 'ปาลิตา', 'อุ่นแก้ว', 0, 'นักจัดการงานทั่วไป', '', 'palita.aun@cmu.ac.th', '', '', 0, NULL, 'palita.aun@cmu.ac.th', NULL, 'นางสาว', 'ปาลิตา', 'อุ่นแก้ว', NULL, NULL, 0, 31, 0, 0, 0, 0, 0, 2, 0, NULL),
(351, '', '', 'จิราธร', 'วรรณสุยะ', 0, 'นักจัดการงานทั่วไป', '', 'jirathorn.w@cmu.ac.th', '', '', 0, NULL, 'jirathorn.w@cmu.ac.th', NULL, 'นางสาว', 'จิราธร', 'วรรณสุยะ', NULL, NULL, 0, 27, 0, 0, 0, 0, 0, 2, 0, NULL),
(352, '', '', 'อนุชา', 'ปินทรายมูล', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'anucha.pinsaimoon@cmu.ac.th', '', '', 0, NULL, 'anucha.pinsaimoon@cmu.ac.th', NULL, 'นาย', 'อนุชา', 'ปินทรายมูล', NULL, NULL, 0, 27, 0, 0, 0, 0, 0, 2, 0, NULL),
(353, '', '', 'จิรชาติ', 'ใคร้มา', 0, 'พนักงานปฏิบัติงานช่วยสอน', '', 'jerachard.k@cmu.ac.th', '', '', 0, NULL, 'jerachard.k@cmu.ac.th', NULL, 'นาย', 'จิรชาติ', 'ใคร้มา', NULL, NULL, 0, 27, 0, 0, 0, 0, 0, 2, 0, NULL),
(354, '', '', 'พัชริดา', 'อินทรีย์', 0, 'นักจัดการงานทั่วไป', '', 'patcharida.insee@cmu.ac.th', '', '', 0, NULL, 'patcharida.insee@cmu.ac.th', NULL, 'นางสาว', 'พัชริดา', 'อินทรีย์', NULL, NULL, 0, 27, 0, 0, 0, 0, 0, 2, 0, NULL),
(355, '', '', 'เบญราวาห์', 'เรือนทิพย์', 0, 'นักจัดการงานทั่วไป', '', 'benrava.r@cmu.ac.th', '', '', 0, NULL, 'benrava.r@cmu.ac.th', NULL, 'นางสาว', 'เบญราวาห์', 'เรือนทิพย์', NULL, NULL, 0, 27, 0, 0, 0, 0, 0, 2, 0, NULL),
(356, '', '', 'นิชนันท์', 'ประไพตระกูล', 0, 'นักจัดการงานทั่วไป', '', 'nitchanan.pr@cmu.ac.th', '', '', 0, NULL, 'nitchanan.pr@cmu.ac.th', NULL, 'นางสาว', 'นิชนันท์', 'ประไพตระกูล', NULL, NULL, 0, 27, 0, 0, 0, 0, 0, 2, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room`
--
-- Error reading structure for table eroombook.tbl_room: #1932 - Table 'eroombook.tbl_room' doesn't exist in engine
-- Error reading data for table eroombook.tbl_room: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `eroombook`.`tbl_room`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `is_step_eng` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `isDean`, `isAdmin`, `remember_token`, `created_at`, `updated_at`, `cmuitaccount_name`, `prename_TH`, `firstname_TH`, `lastname_TH`, `itaccounttype_id`, `itaccounttype_TH`, `positionName`, `positionName2`, `dep_id`, `last_activity`, `typeposition_id`, `lineToken`, `is_step_secretary`, `is_step_dean`, `is_step_eng`) VALUES
(1, NULL, 'suttipong.r@cmu.ac.th', NULL, 'b986700c627db479a4d9460b75de7222', 1, 1, NULL, NULL, '2024-08-04 22:00:54', 'suttipong.r', 'นาย', 'สุทธิพงค์', 'ริโปนยอง', 'MISEmpAcc', 'บุคลากร', 'บุคลากร', '', NULL, '2024-08-04 22:00:54', 1, 'mMb96Ki0GrXKg21z4XARen0Hf32PL3imHuvOsxRFKCX', 0, 0, '0'),
(3, NULL, 'autanan.w@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'อัฐนันต์', 'อัฐนันต์', 'วรรณชัย', '', '', 'อาจารย์ ดร.', '', 35, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(4, NULL, 'norrapon.v@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'นรพนธ์', 'นรพนธ์', 'วิเชียรสาร', '', '', 'อาจารย์ ดร.', '', 35, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(5, NULL, 'kittiya.thunsiri@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'กิตติยา', 'กิตติยา', 'ทุ่นศิริ', '', '', 'อาจารย์ ดร.', '', 35, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(6, NULL, 'wichai.chattinnawat@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'วิชัย', 'วิชัย', 'ฉัตรทินวัฒน์', '', '', 'รองศาสตราจารย์', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(7, NULL, 'akkapoj.w@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'อรรฆพจน์', 'อรรฆพจน์', 'วงศ์พึ่งไชย', '', '', 'อาจารย์', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(8, NULL, 'narong.petcharee@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'ณรงค์', 'ณรงค์', 'เพชรชารี', '', '', 'อาจารย์', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(9, NULL, 'takron.op@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'ฐากร', 'ฐากร', 'โอภาสสุวรรณ', '', '', 'อาจารย์ ดร.', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(10, NULL, 'phavika.m@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'ภวิกา', 'ภวิกา', 'มงคลกิจทวีผล', '', '', 'อาจารย์ ดร.', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(11, NULL, 'poti.chao@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'โพธิ', 'โพธิ', 'จ้าวไพศาล', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(12, NULL, 'tinnakorn.phongthiya@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'ทินกร', 'ทินกร', 'ปงธิยา', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(13, NULL, 'nivit.c@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'นิวิท', 'นิวิท', 'เจริญใจ', '', '', 'รองศาสตราจารย์', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(14, NULL, 'pongsawat.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'พงษ์สวัสดิ์', 'พงษ์สวัสดิ์', 'เปรมเพ็ชร', '', '', 'อาจารย์ ดร.', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(15, NULL, 'salinee.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'สาลินี', 'สาลินี', 'สันติธีรากุล', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(16, NULL, 'apichat.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'อภิชาต', 'อภิชาต', 'โสภาแดง', '', '', 'รองศาสตราจารย์', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(17, NULL, 'choncharoen.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'ชนม์เจริญ', 'ชนม์เจริญ', 'แสวงรัตน์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(18, NULL, 'nirand.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'นิรันดร์', 'นิรันดร์', 'พิสุทธอานนท์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(19, NULL, 'uttapol.s@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'อรรถพล', 'อรรถพล', 'สมุทคุปติ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(20, NULL, 'wimalin.l@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'วิมลิน สุขถมยา', 'วิมลิน สุขถมยา', 'เหล่าศิริถาวร', '', '', 'รองศาสตราจารย์', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(21, NULL, 'anirut.c@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'อนิรุท', 'อนิรุท', 'ไชยจารุวณิช', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(22, NULL, 'rattapol.pinn@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'รัฐพล', 'รัฐพล', 'ปิ่นนราทิพย์', '', '', 'อาจารย์ ดร.', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(23, NULL, 'wassanai.w@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'วัสสนัย', 'วัสสนัย', 'วรรธนัจฉริยา', '', '', 'รองศาสตราจารย์', 'ผู้ช่วยคณบดี', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(24, NULL, 'wasawat.n@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'วสวัชร', 'วสวัชร', 'นาคเขียว', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมอุตสาหการ', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(25, NULL, 'adirek.b@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'อดิเรก', 'อดิเรก', 'ใบสุขันธ์', '', '', 'อาจารย์ ดร.', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(26, NULL, 'warisa.w@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'วริษา', 'วริษา', 'นาคเขียว', '', '', 'รองศาสตราจารย์', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(27, NULL, 'chompoonoot.kasemset@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:15', NULL, 'ชมพูนุท', 'ชมพูนุท', 'เกษมเศรษฐ์', '', '', 'รองศาสตราจารย์', '', 20, '2024-08-05 04:52:15', 1, NULL, 0, 0, '0'),
(28, NULL, 'rungchat.chompu@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'รุ่งฉัตร', 'รุ่งฉัตร', 'ชมภูอินไหว', '', '', 'รองศาสตราจารย์ ดร.', '', 20, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(29, NULL, 'worapod.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'วรพจน์', 'วรพจน์', 'เสรีรัฐ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 20, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(30, NULL, 'korrakot.t@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'กรกฎ ใยบัวเทศ', 'กรกฎ ใยบัวเทศ', 'ทิพยาวงศ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 20, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(31, NULL, 'wapee.m@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'วาปี', 'วาปี', 'มโนภินิเวศ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 20, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(32, NULL, 'sakgasem.ramingwong@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'ศักดิ์เกษม', 'ศักดิ์เกษม', 'ระมิงค์วงศ์', '', '', 'รองศาสตราจารย์ ดร.', '', 20, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(33, NULL, 'komgrit.lek@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'คมกฤต', 'คมกฤต', 'เล็กสกุล', '', '', 'รองศาสตราจารย์ ดร.', '', 20, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(34, NULL, 'sate.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'เศรษฐ์', 'เศรษฐ์', 'สัมภัตตะกุล', '', '', 'รองศาสตราจารย์ ดร.', '', 20, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(35, NULL, 'alonggot.l@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'อลงกต ลิ้มเจริญ', 'อลงกต ลิ้มเจริญ', 'แก้วโชติช่วงกูล', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 20, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(36, NULL, 'tanyanuparb.a@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'ธัญญานุภาพ', 'ธัญญานุภาพ', 'อานันทนะ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 20, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(37, NULL, 'chawis.boonmee@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'ชวิศ', 'ชวิศ', 'บุญมี', '', '', 'รองศาสตราจารย์ ดร.', '', 20, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(38, NULL, 'prim.fong@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'พริม', 'พริม', 'ฟองสมุทร', '', '', 'อาจารย์ผู้ช่วย', '', 20, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(39, NULL, 'jenschwich.c@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'เจณชวิศ', 'เจณชวิศ', 'เจริญใจ', '', '', 'อาจารย์ผู้ช่วย', '', 20, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(40, NULL, 'natthanan.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'ณัฐนันท์', 'ณัฐนันท์', 'พรหมสุข', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(41, NULL, 'kampol.w@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'กำพล', 'กำพล', 'วรดิษฐ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(42, NULL, 'lachana.ramingwong@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'ลัชนา', 'ลัชนา', 'ระมิงค์วงศ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(43, NULL, 'yuthapong.somchit@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'ยุทธพงษ์', 'ยุทธพงษ์', 'สมจิต', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(44, NULL, 'narissara.e@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'นริศรา', 'นริศรา', 'เอี่ยมคณิตชาติ', '', '', 'รองศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(45, NULL, 'sansanee.a@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'ศันสนีย์', 'ศันสนีย์', 'เอื้อพันธ์วิริยะกุล', '', '', 'รองศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(46, NULL, 'sanpawat.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'สรรพวรรธน์', 'สรรพวรรธน์', 'กันตะบุตร', '', '', 'รองศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(47, NULL, 'nasi.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'นษิ', 'นษิ', 'ตันติธารานุกุล', '', '', 'อาจารย์ ดร.', '', 14, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(48, NULL, 'karn.patanukhom@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'กานต์', 'กานต์', 'ปทานุคม', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(49, NULL, 'sasin.ja@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'ศศิน', 'ศศิน', 'จันทร์พวงทอง', '', '', 'อาจารย์ ดร.', '', 14, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(50, NULL, 'patiwet.w@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'ปฏิเวธ', 'ปฏิเวธ', 'วุฒิสารวัฒนา', '', '', 'รองศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(51, NULL, 'anya.a@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'อัญญา อาภาวัชรุตม์', 'อัญญา อาภาวัชรุตม์', 'วีรประพันธ์', '', '', 'รองศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(52, NULL, 'paskorn.c@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'ภาสกร', 'ภาสกร', 'แช่มประเสริฐ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(53, NULL, 'navadon.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:16', NULL, 'นวดนย์', 'นวดนย์', 'คุณเลิศกิจ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:16', 1, NULL, 0, 0, '0'),
(54, NULL, 'chinawat.i@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'ชินวัตร', 'ชินวัตร', 'อิศราดิสัยกุล', '', '', 'อาจารย์ ดร.', '', 14, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(55, NULL, 'kanok.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'กนก', 'กนก', 'ก๋องหล้า', '', '', 'อาจารย์', '', 14, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(56, NULL, 'kasemsit.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'เกษมสิทธิ์', 'เกษมสิทธิ์', 'ตียพันธ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(57, NULL, 'trasapong.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'ตรัสพงศ์', 'ตรัสพงศ์', 'ไทยอุปถัมภ์', '', '', 'รองศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(58, NULL, 'arnan.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'อานันท์', 'อานันท์', 'สีห์พิทักษ์เกียรติ', '', '', 'อาจารย์ ดร.', '', 14, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(59, NULL, 'thanatip.ch@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'ธนาทิพย์', 'ธนาทิพย์', 'จันทร์คง', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(60, NULL, 'pruet.b@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'พฤษภ์', 'พฤษภ์', 'บุญมา', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', 14, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(61, NULL, 'sakgasit.ramingwong@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'ศักดิ์กษิต', 'ศักดิ์กษิต', 'ระมิงค์วงศ์', '', '', 'รองศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(62, NULL, 'juggapong.n@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'จักรพงศ์', 'จักรพงศ์', 'นาทวิชัย', '', '', 'รองศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(63, NULL, 'kenneth.c@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'Kenneth  John', 'Kenneth  John', 'Cosh', '', '', 'รองศาสตราจารย์ ดร.', '', 14, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(64, NULL, 'dome.potikanond@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'โดม', 'โดม', 'โพธิกานนท์', '', '', 'ผู้ช่วยศาสตราจารย์', '', 14, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(65, NULL, 'santi.p@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'สันติ', 'สันติ', 'พิทักษ์กิจนุกูร', '', '', 'รองศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมคอมพิวเตอร์', 14, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(66, NULL, ' jenjira.j@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'เจนจิรา ', 'เจนจิรา ', 'ใจมั่ง  ', '', '', 'อาจารย์ ดร.', '', 14, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(67, NULL, 'wongkot.w@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'วงกต', 'วงกต', 'วงศ์อภัย', '', '', 'รองศาสตราจารย์', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(68, NULL, 'kajorndej.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'ขจรเดช', 'ขจรเดช', 'พิมพ์พิไล', '', '', 'อาจารย์', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(69, NULL, 'mana.saedan@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'มานะ', 'มานะ', 'แซ่ด่าน', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(70, NULL, 'yottana.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'ยศธนา', 'ยศธนา', 'คุณาทร', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(71, NULL, 'aree.a@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'อารีย์', 'อารีย์', 'อัจฉริยวิริยะ', '', '', 'รองศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(72, NULL, 'somchai.pattana@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'สมชาย', 'สมชาย', 'พัฒนา', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(73, NULL, 'det.d@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'เดช', 'เดช', 'ดำรงศักดิ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(74, NULL, 'itthichai.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'อิทธิชัย', 'อิทธิชัย', 'ปรีชาวุฒิพงศ์', '', '', 'รองศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(75, NULL, 'wetchayan.rangsri@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'เวชยันต์', 'เวชยันต์', 'รางศรี', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(76, NULL, 'kodkwan.nam@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'กอดขวัญ', 'กอดขวัญ', 'นามสงวน', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(77, NULL, 'watcharapong.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'วัชรพงษ์', 'วัชรพงษ์', 'ธัชยพงษ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(78, NULL, 'anusan.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'อนุศาล', 'อนุศาล', 'เพิ่มสุวรรณ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(79, NULL, 'siva.a@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'ศิวะ', 'ศิวะ', 'อัจฉริยวิริยะ', '', '', 'รองศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(80, NULL, 'chatchawan.c@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'ชัชวาลย์', 'ชัชวาลย์', 'ชัยชนะ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(81, NULL, 'nat.v@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'ณัฐ', 'ณัฐ', 'วรยศ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(82, NULL, 'natawut.neamsorn@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'ณัฐวุฒิ', 'ณัฐวุฒิ', 'เนียมสอน', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(83, NULL, 'thoranis.dee@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'ธรณิศวร์', 'ธรณิศวร์', 'ดีทายาท', '', '', 'รองศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(84, NULL, 'faifan.tantakitti@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'ใฝ่ฝัน', 'ใฝ่ฝัน', 'ตัณฑกิตติ', '', '', 'อาจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(85, NULL, 'radom.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'ระดม', 'ระดม', 'พงษ์วุฒิธรรม', '', '', 'ศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(86, NULL, 'kanya.r@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:17', NULL, 'กัญญา', 'กัญญา', 'รัตนะมงคลกุล', '', '', 'อาจารย์ ดร.', '', 15, '2024-08-05 04:52:17', 1, NULL, 0, 0, '0'),
(87, NULL, 'anucha.prom@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'อนุชา', 'อนุชา', 'พรมวังขวา', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(88, NULL, 'napassawan.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'นภัสวรรณ', 'นภัสวรรณ', 'วงษ์มงคล', '', '', 'อาจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(89, NULL, 'nattawit.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'ณัฐวิทย์', 'ณัฐวิทย์', 'พรหมมา', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(90, NULL, 'pinyo.puangmali@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'ภิญโญ', 'ภิญโญ', 'พวงมะลิ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมเครื่องกล', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(91, NULL, 'nakorn.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'นคร', 'นคร', 'ทิพยาวงศ์', '', '', 'ศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(92, NULL, 'pawarut.j@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'ปวรุตม์', 'ปวรุตม์', 'จงชาญสิทโธ', '', '', 'รองศาสตราจารย์ ดร.', 'รองคณบดี', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(93, NULL, 'kengkamon.w@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'เก่งกมล', 'เก่งกมล', 'วิรัตน์เกษม', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(94, NULL, 'konlayutt.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'กลยุทธ', 'กลยุทธ', 'ปัญญาวุธโธ', '', '', 'รองศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(95, NULL, 'chakkapong.ch@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'จักรพงษ์', 'จักรพงษ์', 'จำรูญ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(96, NULL, 'thongchai.f@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'ธงชัย', 'ธงชัย', 'ฟองสมุทร', '', '', 'รองศาสตราจารย์ ดร.', 'คณบดี', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(97, NULL, 'ramnarong.wanison@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'รามณรงค์', 'รามณรงค์', 'วณีสอน', '', '', 'อาจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(98, NULL, 'matthew.o@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'Matthew', 'Matthew', 'Owen Thomas Cole', '', '', 'ศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(99, NULL, 'patrapon.k@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'ภัทราพร', 'ภัทราพร', 'กมลเพ็ชร', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(100, NULL, 'chaiy.rungsiyakull@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'ชาย', 'ชาย', 'รังสิยากูล', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(101, NULL, 'phrut.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'พฤทธ์', 'พฤทธ์', 'สกุลช่างสัจจะทัย', '', '', 'รองศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(102, NULL, 'attakorn.asana@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'อรรถกร', 'อรรถกร', 'อาสนคำ', '', '', 'รองศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(103, NULL, 'theeraphong.wong@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'ธีระพงษ์', 'ธีระพงษ์', 'ว่องรัตนะไพศาล', '', '', 'รองศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(104, NULL, 'watchapon.roj@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'วัชพล', 'วัชพล', 'โรจนรัตนางกูร', '', '', 'รองศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(105, NULL, 'niti.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'นิติ', 'นิติ', 'คำเมืองลือ', '', '', 'รองศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(106, NULL, 'viboon.c@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'วิบูลย์', 'วิบูลย์', 'ช่างเรือ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(107, NULL, 'james.moran@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'James', 'James', 'C. Moran', '', '', 'รองศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(108, NULL, 'damorn.b@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'ดามร', 'ดามร', 'บัณฑุรัตน์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(109, NULL, 'woradej.manosroi@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:18', NULL, 'วรเดช', 'วรเดช', 'มโนสร้อย', '', '', 'รองศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:18', 1, NULL, 0, 0, '0'),
(110, NULL, 'pana.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'พนา', 'พนา', 'สุทธกูล', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(111, NULL, 'yuttana.mona@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'ยุทธนา', 'ยุทธนา', 'โมนะ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(112, NULL, 'pradit.terdtoon@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'ประดิษฐ์', 'ประดิษฐ์', 'เทอดทูล', '', '', 'ศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(113, NULL, 'pruk.a@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'พฤกษ์', 'พฤกษ์', 'อักกะรังสี', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(114, NULL, 'krit.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'กฤต', 'กฤต', 'สุจริตธรรม', '', '', 'อาจารย์ ดร.', '', 15, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(115, NULL, 'nattanee.v@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'ณัฐนี', 'ณัฐนี', 'วรยศ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(116, NULL, 'arpiruk.hok@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'อาภิรักษ์', 'อาภิรักษ์', 'หกพันนา', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 15, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(117, NULL, 'perapon.a@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'พีรพนธ์', 'พีรพนธ์', 'อนุสารสุนทร', '', '', 'อาจารย์', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(118, NULL, 'peerapol.j@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'พีรพล', 'พีรพล', 'จิราพงศ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมไฟฟ้า', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(119, NULL, 'thanaphong.thanasak@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'ธนะพงษ์', 'ธนะพงษ์', 'ธนะศักดิ์ศิริ', '', '', 'รองศาสตราจารย์', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(120, NULL, 'nipon.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'นิพนธ์', 'นิพนธ์', 'ธีรอำพน', '', '', 'ศาสตราจารย์ ดร.', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(121, NULL, 'kasin.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'กสิณ', 'กสิณ', 'ประกอบไวทยกิจ', '', '', 'ผู้ช่วยศาสตราจารย์', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(122, NULL, 'tharadol.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'ธราดล', 'ธราดล', 'โกมลมิศร์', '', '', 'ผู้ช่วยศาสตราจารย์', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(123, NULL, 'sermsak.uatrongjit@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'เสริมศักดิ์', 'เสริมศักดิ์', 'เอื้อตรงจิตต์', '', '', 'รองศาสตราจารย์ ดร.', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(124, NULL, 'boonsri.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'บุญศรี', 'บุญศรี', 'แก้วคำอ้าย', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(125, NULL, 'somboon.nuchprayoon@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'สมบูรณ์', 'สมบูรณ์', 'นุชประยูร', '', '', 'รองศาสตราจารย์ ดร.', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(126, NULL, 'doldet.tantraviwat@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'ดลเดช', 'ดลเดช', 'ตันตระวิวัฒน์', '', '', 'รองศาสตราจารย์ ดร.', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(127, NULL, 'suttichai.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'สุทธิชัย', 'สุทธิชัย', 'เปรมฤดีปรีชาชาญ', '', '', 'รองศาสตราจารย์ ดร.', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(128, NULL, 'kasemsak.u@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'เกษมศักดิ์', 'เกษมศักดิ์', 'อุทัยชนะ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(129, NULL, 'ukrit.m@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'อุกฤษฏ์', 'อุกฤษฏ์', 'มั่นคง', '', '', 'รองศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(130, NULL, 'witsarut.a@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'วิศรุต', 'วิศรุต', 'อัจฉริยวิริยะ', '', '', 'อาจารย์ ดร.', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(131, NULL, 'sirote.khunkitti@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'สิโรตม์', 'สิโรตม์', 'คุณกิตติ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(132, NULL, 'panida.th@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'ปณิดา', 'ปณิดา', 'ธารารักษ์', '', '', 'อาจารย์ ดร.', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(133, NULL, 'yuttana.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'ยุทธนา', 'ยุทธนา', 'ขำสุวรรณ์', '', '', 'ศาสตราจารย์ ดร.', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(134, NULL, 'watcharin.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'วัชริน', 'วัชริน', 'ศรีรัตนาวิชัยกุล', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(135, NULL, 'nutapong.somjit@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:19', NULL, 'ณัตพงศ์', 'ณัตพงศ์', 'สมจิตร', '', '', 'อาจารย์ ดร.', '', 16, '2024-08-05 04:52:19', 1, NULL, 0, 0, '0'),
(136, NULL, 'paramet.w@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'ปารเมศ', 'ปารเมศ', 'วิระสันติ', '', '', 'รองศาสตราจารย์ ดร.', '', 16, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(137, NULL, 'soraphon.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'สรพล', 'สรพล', 'กิจศิริสิน', '', '', 'อาจารย์ ดร.', '', 16, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(138, NULL, 'cheowchan.l@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'เชี่ยวชาญ', 'เชี่ยวชาญ', 'ลีลาสุขเสรี', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมเหมืองแร่', 19, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(139, NULL, 'suttithep.r@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'สุทธิเทพ', 'สุทธิเทพ', 'รมยเวศม์', '', '', 'ผู้ช่วยศาสตราจารย์', '', 19, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(140, NULL, 'suparit.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'สุพฤทธิ์', 'สุพฤทธิ์', 'ตั้งพฤทธิ์กุล', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 19, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(141, NULL, 'teerapat.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'ธีรภัทร์', 'ธีรภัทร์', 'ต่อสวย', '', '', 'อาจารย์', '', 19, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(142, NULL, 'tadsuda.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'ทัศษุดา', 'ทัศษุดา', 'ทักษะวสุ', '', '', 'อาจารย์ ดร.', '', 19, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(143, NULL, 'komsoon.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'คมสูรย์', 'คมสูรย์', 'สมประสงค์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 19, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(144, NULL, 'chanapol.c@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'ชนะพล', 'ชนะพล', 'เจริญธนาวรกุล', '', '', 'อาจารย์ ดร.', '', 19, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(145, NULL, 'puttipol.d@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'พุทธิพล', 'พุทธิพล', 'ดำรงชัย', '', '', 'รองศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(146, NULL, 'paisan.jourtong@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'ไพศาล', 'ไพศาล', 'จั่วทอง', '', '', 'อาจารย์', '', 17, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(147, NULL, 'poon.th@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'ปุ่น', 'ปุ่น', 'เที่ยงบูรณธรรม', '', '', 'รองศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(148, NULL, 'chayanon.h@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'ชยานนท์', 'ชยานนท์', 'หรรษภิญโญ', '', '', 'รองศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(149, NULL, 'damrongsak.r@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'ดำรงศักดิ์', 'ดำรงศักดิ์', 'รินชุมภู', '', '', 'รองศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(150, NULL, 'natee.suriyanon@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'นที', 'นที', 'สุริยานนท์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(151, NULL, 'suriyah.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'สุริยะ', 'สุริยะ', 'ทองมุณี', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(152, NULL, 'sethapong.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'เศรษฐพงศ์', 'เศรษฐพงศ์', 'เศรษฐบุปผา', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(153, NULL, 'tawatchai.t@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'ธวัชชัย', 'ธวัชชัย', 'ตันชัยสวัสดิ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'รองคณบดี', 17, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(154, NULL, 'bhuddarak.c@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:20', NULL, 'พุทธรักษ์', 'พุทธรักษ์', 'จรัสพันธุ์กุล', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:20', 1, NULL, 0, 0, '0'),
(155, NULL, 'pheerawat.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'พีรวัฒน์', 'พีรวัฒน์', 'ปลาเงิน', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(156, NULL, 'warakorn.tan@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'วรากร', 'วรากร', 'ตันตระพงศธร', '', '', 'อาจารย์ ดร.', '', 17, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(157, NULL, 'peerapong.j@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'พีรพงศ์', 'พีรพงศ์', 'จิตเสงี่ยม', '', '', 'รองศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(158, NULL, 'kriangkrai.a@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'เกรียงไกร', 'เกรียงไกร', 'อรุโณทยานันท์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 17, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(159, NULL, 'pitiwat.w@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'ปิติวัฒน์', 'ปิติวัฒน์', 'วัฒนชัย', '', '', 'รองศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(160, NULL, 'chinapat.b@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'ชินพัฒน์', 'ชินพัฒน์', 'บัวชาติ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(161, NULL, 'teewara.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'ธีวรา', 'ธีวรา', 'สุวรรณ', '', '', 'รองศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(162, NULL, 'chana.sinsabvarodom@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'ชนะ', 'ชนะ', 'สินทรัพย์วโรดม', '', '', 'อาจารย์ ดร.', '', 17, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(163, NULL, 'thanaporn.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'ธนพร', 'ธนพร', 'สุปริยศิลป์', '', '', 'รองศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(164, NULL, 'nopadon.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'นพดล', 'นพดล', 'กรประเสริฐ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(165, NULL, 'songyot.k@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'ทรงยศ', 'ทรงยศ', 'กิจธรรมเกษร', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 17, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(166, NULL, 'preda.p@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'ปรีดา', 'ปรีดา', 'พิชยาพันธ์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมโยธา', 17, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(167, NULL, 'piyapong.wongmatar@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'ปิยะพงษ์', 'ปิยะพงษ์', 'วงค์เมธา', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(168, NULL, 'kittikun.j@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'กิตติคุณ', 'กิตติคุณ', 'จิตไพโรจน์', '', '', 'อาจารย์ ดร.', '', 17, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(169, NULL, 'auttawit.u@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'อรรถวิทย์', 'อรรถวิทย์', 'อุปโยคิน', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 17, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(170, NULL, 'pharkphum.r@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'ภาคภูมิ', 'ภาคภูมิ', 'รักร่วม', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'ผู้ช่วยคณบดี', 18, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(171, NULL, 'pimluck.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'พิมพ์ลักษณ์', 'พิมพ์ลักษณ์', 'กิจจนะพานิช', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 18, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(172, NULL, 'patiroop.p@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'ปฏิรูป', 'ปฏิรูป', 'ผลจันทร์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', 'หัวหน้าภาควิชาวิศวกรรมสิ่งแวดล้อม', 18, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(173, NULL, 'sarunnoud.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'สรัลนุช', 'สรัลนุช', 'ภู่พิสิฐ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 18, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(174, NULL, 'napat.ja@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'ณภัทร', 'ณภัทร', 'จักรวัฒนา', '', '', 'รองศาสตราจารย์ ดร.', '', 18, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(175, NULL, 'sirichai.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'สิริชัย', 'สิริชัย', 'คุณภาพดีเลิศ', '', '', 'รองศาสตราจารย์ ดร.', '', 18, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(176, NULL, 'aunnop.w@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'อรรณพ', 'อรรณพ', 'วงศ์เรือง', '', '', 'รองศาสตราจารย์ ดร.', '', 18, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(177, NULL, 'puangrat.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'พวงรัตน์', 'พวงรัตน์', 'แก้วล้อม', '', '', 'ศาสตราจารย์ ดร.', '', 18, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(178, NULL, 'saoharit.n@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'เสาหฤท', 'เสาหฤท', 'นิตยวรรธนะ', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 18, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(179, NULL, 'sulak.sumit@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'สุลักษณ์', 'สุลักษณ์', 'สุมิตสวรรค์', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 18, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(180, NULL, 'prattakorn.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'ปรัตถกร', 'ปรัตถกร', 'สิทธิสม', '', '', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 18, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(181, NULL, 'rattapol.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'รัฐพล', 'รัฐพล', 'พรประสิทธิ์', '', '', 'นักวิจัย', '', 6, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(182, NULL, 'chalinee.m@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'ชาลิณี ', 'ชาลิณี ', 'พิพัฒนพิภพ', '', '', 'อาจารย์ ดร.', '', 35, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(183, NULL, 'อยู่ระหว่างการจัดทำคำสั่งบรรจุ', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'คุณานนต์', 'คุณานนต์', 'จงชาญสิทโธ', '', '', 'อาจารย์ ดร.', '', 0, '2024-08-05 04:52:21', 1, NULL, 0, 0, '0'),
(184, NULL, 'phannee.sojit@cmu.ac.th', NULL, '', 1, 0, NULL, NULL, '2024-08-05 04:52:21', NULL, 'พรรณี', 'พรรณี', 'โศจิธรรมพร', '', '', 'นักจัดการงานทั่วไป', 'เลขานุการคณะ', 1, '2024-08-05 04:52:21', 2, NULL, 0, 0, '0'),
(185, NULL, 'sonthaya.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'สนธยา', 'สนธยา', 'สุขสามัคคี', '', '', 'พนักงานช่าง', '', 20, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(186, NULL, 'wuttinun.in@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'วุฒินันท์', 'วุฒินันท์', 'อินทยศ', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 20, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(187, NULL, 'chetniphat.samta@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'เจตนิพัทธ์', 'เจตนิพัทธ์', 'สามตา', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 20, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(188, NULL, 'ponpun.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'พรพรรณ', 'พรพรรณ', 'คำมั่น', '', '', 'นักจัดการงานทั่วไป', '', 20, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(189, NULL, 'narin.c@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'นรินทร์', 'นรินทร์', 'จักร์ปั๋น', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 20, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(190, NULL, 'nattawoot.rinno@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'ณัฐวุฒิ', 'ณัฐวุฒิ', 'รินโน', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 20, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(191, NULL, 'wimutita.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'วิมุทิตา', 'วิมุทิตา', 'ปัญโญใหญ่', '', '', 'นักจัดการงานทั่วไป', '', 20, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(192, NULL, 'thunyaluk.kiti@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'ธัญญาลักษณ์', 'ธัญญาลักษณ์', 'กิติวิริยะชัย', '', '', 'นักจัดการงานทั่วไป', '', 20, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(193, NULL, 'sakdinon.nantana@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'ศักดินนท์', 'ศักดินนท์', 'นันทนา', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 20, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(194, NULL, 'wutipong.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'วุฒิพงศ์', 'วุฒิพงศ์', 'คำวงค์', '', '', 'นักจัดการงานทั่วไป', '', 20, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(195, NULL, 'rattiyakorn.c@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'รัตติยากร', 'รัตติยากร', 'ชาตตนนท์', '', '', 'นักจัดการงานทั่วไป', '', 20, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(196, NULL, 'naiyana.y@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'นัยนา', 'นัยนา', 'ยะสิงห์สาร', '', '', 'นักจัดการงานทั่วไป', '', 20, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(197, NULL, 'pornsuda.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'พรสุดา', 'พรสุดา', 'เสาร์สิงห์', '', '', 'นักจัดการงานทั่วไป', '', 20, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(198, NULL, 'wipawarn.m@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'วิภาวรรณ', 'วิภาวรรณ', 'พันดวง', '', '', 'นักจัดการงานทั่วไป', '', 14, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(199, NULL, 'pornpimol.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'พรพิมล', 'พรพิมล', 'พรมมินทร์', '', '', 'นักจัดการงานทั่วไป', '', 14, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(200, NULL, 'sittichon.a@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'สิทธิชน', 'สิทธิชน', 'อังคุตรานนท์', '', '', 'นักวิชาการคอมพิวเตอร์', '', 14, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(201, NULL, 'aphichat.r@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'อภิชาติ', 'อภิชาติ', 'รอดเรือน', '', '', 'นักจัดการงานทั่วไป', '', 14, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(202, NULL, 'waraporn.tipsorn@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'ธิดากร', 'ธิดากร', 'สิริชลวรา', '', '', 'พนักงานบริการทั่วไป', '', 14, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(203, NULL, 'piangta.a@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'เพียงตา', 'เพียงตา', 'อภิวงศ์', '', '', 'นักจัดการงานทั่วไป', '', 14, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(204, NULL, 'urapee.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'อุรพี', 'อุรพี', 'ธรรมโยธิน', '', '', 'นักจัดการงานทั่วไป', '', 14, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(205, NULL, 'nathaprom.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'ณฐพรหม', 'ณฐพรหม', 'ปัญจมา', '', '', 'ช่างอิเล็กทรอนิกส์', '', 15, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(206, NULL, 'panutda.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'ปนัดดา', 'ปนัดดา', 'ตุ้ยอุ่นเรือน', '', '', 'นักจัดการงานทั่วไป', '', 15, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(207, NULL, 'morakot.apiwongngam@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'มรกต', 'มรกต', 'อภิวงศ์งาม', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 15, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(208, NULL, 'aswin.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'อัศวิน', 'อัศวิน', 'ปศุศฤทธากร', '', '', 'วิศวกร', '', 15, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(209, NULL, 'natapon.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:22', NULL, 'ณฐพล', 'ณฐพล', 'ทองสอน', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 15, '2024-08-05 04:52:22', 2, NULL, 0, 0, '0'),
(210, NULL, 'nipawan.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:23', NULL, 'นิภาวรรณ์', 'นิภาวรรณ์', 'คำวัง', '', '', 'นักจัดการงานทั่วไป', '', 15, '2024-08-05 04:52:23', 2, NULL, 0, 0, '0'),
(211, NULL, 'norrasaet.b@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:23', NULL, 'นรเศรษฐ์', 'นรเศรษฐ์', 'บานนิกุล', '', '', 'วิศวกร', '', 15, '2024-08-05 04:52:23', 2, NULL, 0, 0, '0'),
(212, NULL, 'apasara.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:23', NULL, 'อาภัสรา', 'อาภัสรา', 'คล้ายณรงค์', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 15, '2024-08-05 04:52:23', 2, NULL, 0, 0, '0'),
(213, NULL, 'pusadee.ch@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:23', NULL, 'ผุสดี', 'ผุสดี', 'จันทร์เอี่ยม', '', '', 'นักจัดการงานทั่วไป', '', 15, '2024-08-05 04:52:23', 2, NULL, 0, 0, '0'),
(214, NULL, 'nattapong.g@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:23', NULL, 'ณัฐพงศ์', 'ณัฐพงศ์', 'กันธะเรียน', '', '', 'นักวิชาการคอมพิวเตอร์', '', 15, '2024-08-05 04:52:23', 2, NULL, 0, 0, '0'),
(215, NULL, 'kanjarna.pang@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:23', NULL, 'กาญจนา', 'กาญจนา', 'แปงสุตา', '', '', 'นักจัดการงานทั่วไป', '', 15, '2024-08-05 04:52:23', 2, NULL, 0, 0, '0'),
(216, NULL, 'thawatchai.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:23', NULL, 'ธวัชชัย', 'ธวัชชัย', 'ธรรมขันแก้ว', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 15, '2024-08-05 04:52:23', 2, NULL, 0, 0, '0'),
(217, NULL, 'waraluck.l@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:23', NULL, 'วราลักษณ์', 'วราลักษณ์', 'เหล็กสมบูรณ์', '', '', 'นักจัดการงานทั่วไป', '', 15, '2024-08-05 04:52:23', 2, NULL, 0, 0, '0'),
(218, NULL, 'warangkana.sukch@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:23', NULL, 'วรางคณา', 'วรางคณา', 'สุกชัยเจริญพร', '', '', 'นักจัดการงานทั่วไป', '', 15, '2024-08-05 04:52:23', 2, NULL, 0, 0, '0'),
(219, NULL, 'sukphawat.siri@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:23', NULL, 'สุขภวัฒ', 'สุขภวัฒ', 'ศิริมูล', '', '', 'พนักงานบริการทั่วไป', '', 15, '2024-08-05 04:52:23', 2, NULL, 0, 0, '0'),
(220, NULL, 'watchara.chomesri@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:24', NULL, 'วัชระ', 'วัชระ', 'โฉมศรี', '', '', 'พนักงานช่าง', '', 15, '2024-08-05 04:52:24', 2, NULL, 0, 0, '0'),
(221, NULL, 'narid.m@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:24', NULL, 'นริศ', 'นริศ', 'เมืองแก่น', '', '', 'พนักงานช่าง', '', 15, '2024-08-05 04:52:24', 2, NULL, 0, 0, '0'),
(222, NULL, 'visanu.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:24', NULL, 'วิษณุ', 'วิษณุ', 'ตันไพจิตร', '', '', 'พนักงานช่าง', '', 15, '2024-08-05 04:52:24', 2, NULL, 0, 0, '0'),
(223, NULL, 'watcharapong.somsri@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:24', NULL, 'วัชรพงษ์', 'วัชรพงษ์', 'สมศรี', '', '', 'พนักงานช่าง', '', 15, '2024-08-05 04:52:24', 2, NULL, 0, 0, '0'),
(224, NULL, 'songklot.m@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:24', NULL, 'ทรงกลด', 'ทรงกลด', 'มายาง', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 15, '2024-08-05 04:52:24', 2, NULL, 0, 0, '0'),
(225, NULL, 'ananya.l@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:24', NULL, 'อนัญญา', 'อนัญญา', 'ลัทธิกุล', '', '', 'นักจัดการงานทั่วไป', '', 15, '2024-08-05 04:52:24', 2, NULL, 0, 0, '0'),
(226, NULL, 'nopphadon.h@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:24', NULL, 'นพดล', 'นพดล', 'หวลสัตย์', '', '', 'พนักงานสถานที่', '', 15, '2024-08-05 04:52:24', 2, NULL, 0, 0, '0'),
(227, NULL, 'aitsaraporn.l@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:24', NULL, 'อิสราภรณ์', 'อิสราภรณ์', 'ลายเขียว', '', '', 'นักจัดการงานทั่วไป', '', 15, '2024-08-05 04:52:24', 2, NULL, 0, 0, '0'),
(228, NULL, 'prasert.m@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:24', NULL, 'ประเสริฐ', 'ประเสริฐ', 'มาวิมล', '', '', 'วิศวกรไฟฟ้า', '', 16, '2024-08-05 04:52:24', 2, NULL, 0, 0, '0'),
(229, NULL, 'prayoon.b@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:24', NULL, 'ประยูร', 'ประยูร', 'บัวรินทร์', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 16, '2024-08-05 04:52:24', 2, NULL, 0, 0, '0'),
(230, NULL, 'prayoonsak.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'ประยูรศักดิ์', 'ประยูรศักดิ์', 'พรายจันทร์', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 16, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(231, NULL, 'sangdaun.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'แสงเดือน', 'แสงเดือน', 'โปธา', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 16, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(232, NULL, 'uraiwan.ch@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'อุไรวรรณ', 'อุไรวรรณ', 'ไชยถา', '', '', 'นักจัดการงานทั่วไป', '', 16, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(233, NULL, 'suchada.ma@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'สุชาดา', 'สุชาดา', 'มหาไม้', '', '', 'วิศวกร', '', 16, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(234, NULL, 'ramest.nantajan@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'ราเมศ', 'ราเมศ', 'นันทจันทร์', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 16, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(235, NULL, 'nuttanan.bu@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'นัฐนันท์', 'นัฐนันท์', 'บุตรศักดิ์', '', '', 'นักจัดการงานทั่วไป', '', 16, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(236, NULL, 'matana.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'มัฒนา', 'มัฒนา', 'เครืออุ่นเรือน', '', '', 'พนักงานบริการทั่วไป', '', 16, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(237, NULL, 'suwit.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'สุวิทย์', 'สุวิทย์', 'สิทธิชัยวงศ์', '', '', 'พนักงานสถานที่', '', 16, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `isDean`, `isAdmin`, `remember_token`, `created_at`, `updated_at`, `cmuitaccount_name`, `prename_TH`, `firstname_TH`, `lastname_TH`, `itaccounttype_id`, `itaccounttype_TH`, `positionName`, `positionName2`, `dep_id`, `last_activity`, `typeposition_id`, `lineToken`, `is_step_secretary`, `is_step_dean`, `is_step_eng`) VALUES
(238, NULL, 'dungruthai.i@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'ดั่งฤทัย', 'ดั่งฤทัย', 'อินมณี', '', '', 'นักจัดการงานทั่วไป', '', 16, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(239, NULL, 'suppagarn.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'ศุภกานต์', 'ศุภกานต์', 'ธิเตจ๊ะ', '', '', 'นักวิทยาศาสตร์', '', 19, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(240, NULL, 'siwadol.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'ศิวดล', 'ศิวดล', 'สุภาเปี้ย', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 19, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(241, NULL, 'suthin.meta@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'สุทิน', 'สุทิน', 'เมทา', '', '', 'พนักงานบริการทั่วไป', '', 19, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(242, NULL, 'phoonnistha.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'ปุณณิฐฐา', 'ปุณณิฐฐา', 'ธัญญาพิชญะนันท์', '', '', 'นักจัดการงานทั่วไป', '', 19, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(243, NULL, 'khrueawan.b@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'เครือวัลย์', 'เครือวัลย์', 'บุญเกิด', '', '', 'พนักงานบริการทั่วไป', '', 19, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(244, NULL, 'kittithat.ph@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'กิตติทัศน์', 'กิตติทัศน์', 'ผ่องศรีธนสกุล', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 17, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(245, NULL, 'suttipong.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'สุทธิพงศ์', 'สุทธิพงศ์', 'คำดี', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 17, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(246, NULL, 'thanachot.m@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'ธนโชติ', 'ธนโชติ', 'เมืองใจ', '', '', 'วิศวกร', '', 17, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(247, NULL, 'narong.sri@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'ณรงค์', 'ณรงค์', 'ศรีวิชัย', '', '', 'พนักงานช่าง', '', 17, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(248, NULL, 'phadungsak.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'ผดุงศักดิ์', 'ผดุงศักดิ์', 'ปันครอง', '', '', 'พนักงานบริการทั่วไป', '', 17, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(249, NULL, 'sane.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'เสน่ห์', 'เสน่ห์', 'แก้วพงค์ธิ', '', '', 'พนักงานบริการทั่วไป', '', 17, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(250, NULL, 'sutthipong.kantha@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'สุทธิพงษ์', 'สุทธิพงษ์', 'กันทา', '', '', 'พนักงานบริการทั่วไป', '', 17, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(251, NULL, 'boonmee.j@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:25', NULL, 'บุญมี', 'บุญมี', 'เจิมจันทร์', '', '', 'พนักงานบริการทั่วไป', '', 17, '2024-08-05 04:52:25', 2, NULL, 0, 0, '0'),
(252, NULL, 'kasinee.r@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'เกศิณี', 'เกศิณี', 'เรือนคำ', '', '', 'วิศวกร', '', 17, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(253, NULL, 'winai.r@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'วินัย', 'วินัย', 'เรือนปัญโญ', '', '', 'พนักงานบริการทั่วไป', '', 17, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(254, NULL, 'nitwaree.y@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'นิจวรีย์', 'นิจวรีย์', 'ยศสอน', '', '', 'นักจัดการงานทั่วไป', '', 17, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(255, NULL, 'natticha.th@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'ณัฐธิชา', 'ณัฐธิชา', 'ทองหลอม', '', '', 'นักจัดการงานทั่วไป', '', 17, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(256, NULL, 'gatesunee.th@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'เกศสุนี', 'เกศสุนี', 'ทองเมฆ', '', '', 'นักจัดการงานทั่วไป', '', 17, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(257, NULL, 'pornsawan.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'พรสวรรค์', 'พรสวรรค์', 'ขัติยศ', '', '', 'นักวิทยาศาสตร์', '', 18, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(258, NULL, 'noratep.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'นรเทพ', 'นรเทพ', 'พลวณิช', '', '', 'นักวิทยาศาสตร์', '', 18, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(259, NULL, 'sorawisit.n@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'สรวิศิษฐ์', 'สรวิศิษฐ์', 'นิลพรรณ', '', '', 'นักจัดการงานทั่วไป', '', 18, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(260, NULL, 'kobkul.m@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'กอบกุล', 'กอบกุล', 'ชัยรักษ์', '', '', 'พนักงานบริการทั่วไป', '', 18, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(261, NULL, 'nareerat.h@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'นารีรัตน์', 'นารีรัตน์', 'เหมโลหะ', '', '', 'นักวิทยาศาสตร์', '', 18, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(262, NULL, 'ratanaporn.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'รตนพร', 'รตนพร', 'พงษ์มณี', '', '', 'นักจัดการงานทั่วไป', '', 18, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(263, NULL, 'atcharawan.i@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'อัจฉราวรรณ', 'อัจฉราวรรณ', 'อินทรส', '', '', 'นักจัดการงานทั่วไป', 'หัวหน้างานบริหารทั่วไป', 8, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(264, NULL, 'pattaravijit.m@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'ภัทราวิจิตร', 'ภัทราวิจิตร', 'มณีประเสริฐ', '', '', 'นักจัดการงานทั่วไป', '', 8, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(265, NULL, 'anuchit.n@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'อนุชิต', 'อนุชิต', 'เนตรศิลป์', '', '', 'คนสวน', '', 8, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(266, NULL, 'chanon.ka@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'ชานนท์', 'ชานนท์', 'แก้วบุญเรือง', '', '', 'วิศวกร', '', 8, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(267, NULL, 'kiattichai.b@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'เกียรติชัย', 'เกียรติชัย', 'บุญทารักษ์', '', '', 'นักจัดการงานทั่วไป', '', 8, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(268, NULL, 'pikul.in@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'พิกุล', 'พิกุล', 'อินตากุล', '', '', 'นักจัดการงานทั่วไป', '', 8, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(269, NULL, 'kamonporn.m@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'กมลพร', 'กมลพร', 'มณีวรรณ', '', '', 'นักจัดการงานทั่วไป', '', 8, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(270, NULL, 'nuttapong.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'นัทธพงศ์', 'นัทธพงศ์', 'เสนรังษี', '', '', 'นักจัดการงานทั่วไป', '', 8, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(271, NULL, 'wanit.lerttrakul@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'วนิตย์', 'วนิตย์', 'เลิศตระกูล', '', '', 'รองศาสตราจารย์', '', 8, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(272, NULL, 'bunwaeo.m@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:26', NULL, 'บุญแวว', 'บุญแวว', 'มหาวัน', '', '', 'พนักงานบริการทั่วไป', '', 8, '2024-08-05 04:52:26', 2, NULL, 0, 0, '0'),
(273, NULL, 'jakkrit.kunna@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'จักรกฤช', 'จักรกฤช', 'กุนนา', '', '', 'พนักงานบริการทั่วไป', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(274, NULL, 'nukul.b@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'นุกุล', 'นุกุล', 'บัวคำปัน', '', '', 'พนักงานช่าง', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(275, NULL, 'orapin.pra@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'อรพิน', 'อรพิน', 'ประภาวิลัย', '', '', 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานบริหารงานทั่วไป', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(276, NULL, 'somporn.pomin@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'สมพร', 'สมพร', 'พรมมินทร์', '', '', 'พนักงานช่าง', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(277, NULL, 'wichita.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'วิชิตา', 'วิชิตา', 'ท้าวหน่อ', '', '', 'วิศวกร', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(278, NULL, 'aussatakorn.keaw@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'อนุรักษ์', 'อนุรักษ์', 'แก้วบุญเรือง', '', '', 'พนักงานบริการฝีมือ (ด้านเทคนิคและเครื่องยนต์)', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(279, NULL, 'wanpen.saelu@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'วันเพ็ญ', 'วันเพ็ญ', 'แซ่หลู่', '', '', 'พนักงานบริการทั่วไป', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(280, NULL, 'sadayu.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'สดายุ', 'สดายุ', 'คำทอง', '', '', 'นักจัดการงานทั่วไป', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(281, NULL, 'pitirat.nan@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'ปิติรัตน์', 'ปิติรัตน์', 'นันทวาศ', '', '', 'พนักงานบริการทั่วไป', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(282, NULL, 'sasikan.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'ศศิกานต์', 'ศศิกานต์', 'กองค้า', '', '', 'นักจัดการงานทั่วไป', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(283, NULL, 'chanon.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'ชานนท์', 'ชานนท์', 'ทินหนุน', '', '', 'พนักงานบริการฝีมือ (ด้านเทคนิคและเครื่องยนต์)', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(284, NULL, 'worapong.d@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'วรพงษ์', 'วรพงษ์', 'ดาวเลิศ', '', '', 'พนักงานช่าง', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(285, NULL, 'maneerat.n@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'มณีรัตน์', 'มณีรัตน์', 'เงินก่ำ', '', '', 'นักจัดการงานทั่วไป', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(286, NULL, 'chanikan.jai@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'ชนิกานต์', 'ชนิกานต์', 'ใจนวล', '', '', 'นักจัดการงานทั่วไป', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(287, NULL, 'patipan.w@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'ปฏิภาณ', 'ปฏิภาณ', 'วงศ์เทพ', '', '', 'พนักงานบริการทั่วไป', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(288, NULL, 'songkran.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'สงกรานต์', 'สงกรานต์', 'สุวรรณคำ', '', '', 'พนักงานบริการทั่วไป', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(289, NULL, 'jakkrit.ku@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'จักรกริช', 'จักรกริช', 'กวงแหวน', '', '', 'นักจัดการงานทั่วไป', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(290, NULL, 'ratchanon.m@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'รัชชานนท์', 'รัชชานนท์', 'มงคลวัจน์', '', '', 'วิศวกร', '', 8, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(291, NULL, 'sineenuch.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'สินีนุช', 'สินีนุช', 'พรหมมิจิตร', '', '', 'นักการเงินและบัญชี', '', 13, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(292, NULL, 'nattawan.v@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'ณัฐวรรณ', 'ณัฐวรรณ', 'วรินทร์รักษ์', '', '', 'นักการเงินและบัญชี', '', 13, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(293, NULL, 'chetdanai.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'เชษฐ์ดนัย', 'เชษฐ์ดนัย', 'พราหมณ์บุญมี', '', '', 'พนักงานพัสดุ', '', 13, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(294, NULL, 'preeyapat.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'ปรียาภัทร', 'ปรียาภัทร', 'ปาคำ', '', '', 'นักการเงินและบัญชี', '', 13, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(295, NULL, 'wasan.ch@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'วสันต์', 'วสันต์', 'ฉายหิรัญ', '', '', 'นักจัดการงานทั่วไป', '', 13, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(296, NULL, 'suttiluk.c@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:27', NULL, 'สุทธิลักษณ์', 'สุทธิลักษณ์', 'จักร์ปั๋น', '', '', 'นักจัดการงานทั่วไป', '', 13, '2024-08-05 04:52:27', 2, NULL, 0, 0, '0'),
(297, NULL, 'phacharaphon.i@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:28', NULL, 'พชรพล', 'พชรพล', 'อินทกุล', '', '', 'นักจัดการงานทั่วไป', '', 13, '2024-08-05 04:52:28', 2, NULL, 0, 0, '0'),
(298, NULL, 'naruemon.kawi@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:28', NULL, 'นฤมล', 'นฤมล', 'กาวิละวงค์', '', '', 'นักการเงินและบัญชี', '', 13, '2024-08-05 04:52:28', 2, NULL, 0, 0, '0'),
(299, NULL, 'yuphinporn.nondjuy@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:28', NULL, 'ยุพินพร', 'ยุพินพร', 'โนนจุ้ย', '', '', 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานการเงินฯ', 13, '2024-08-05 04:52:28', 2, NULL, 0, 0, '0'),
(300, NULL, 'suwimon.mathu@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:28', NULL, 'สุวิมล', 'สุวิมล', 'มะธุ', '', '', 'นักการเงินและบัญชี', 'ผู้ช่วยหัวหน้างานการเงินฯ', 13, '2024-08-05 04:52:28', 2, NULL, 0, 0, '0'),
(301, NULL, 'waralee.c@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:28', NULL, 'วราลี', 'วราลี', 'ช่างย้อม', '', '', 'นักการเงินและบัญชี', 'หัวหน้างานการเงินฯ', 13, '2024-08-05 04:52:28', 2, NULL, 0, 0, '0'),
(302, NULL, 'poranee.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:28', NULL, 'ภรณี', 'ภรณี', 'สรรพศรี', '', '', 'นักจัดการงานทั่วไป', '', 13, '2024-08-05 04:52:28', 2, NULL, 0, 0, '0'),
(303, NULL, 'tachchaphong.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:28', NULL, 'ธัชพงศ์', 'ธัชพงศ์', 'เต็มป๊ก', '', '', 'นักจัดการงานทั่วไป', '', 13, '2024-08-05 04:52:28', 2, NULL, 0, 0, '0'),
(304, NULL, 'yupin.b@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:28', NULL, 'ยุพิณ', 'ยุพิณ', 'บัวคำปัน', '', '', 'นักการเงินและบัญชี', '', 13, '2024-08-05 04:52:28', 2, NULL, 0, 0, '0'),
(305, NULL, 'nidchanun.kan@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:28', NULL, 'ณิชนันทน์', 'ณิชนันทน์', 'กันชะนะ', '', '', 'นักการเงินและบัญชี', '', 13, '2024-08-05 04:52:28', 2, NULL, 0, 0, '0'),
(306, NULL, 'kantinan.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:28', NULL, 'กันตินันท์', 'กันตินันท์', 'คำราพิช', '', '', 'นักจัดการงานทั่วไป', '', 13, '2024-08-05 04:52:28', 2, NULL, 0, 0, '0'),
(307, NULL, 'tippawan.b@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:28', NULL, 'ทิพวรรณ', 'ทิพวรรณ', 'บุญหล้า', '', '', 'นักจัดการงานทั่วไป', '', 7, '2024-08-05 04:52:28', 2, NULL, 0, 0, '0'),
(308, NULL, 'tanyanan.m@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:28', NULL, 'ธัญนันท์', 'ธัญนันท์', 'มาดี', '', '', 'นักจัดการงานทั่วไป', '', 7, '2024-08-05 04:52:28', 2, NULL, 0, 0, '0'),
(309, NULL, 'maruechat.c@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:28', NULL, 'มฤฉัตร', 'มฤฉัตร', 'เจริญทรัพย์', '', '', 'นักจัดการงานทั่วไป', 'หัวหน้างานนโยบายและแผนฯ', 7, '2024-08-05 04:52:28', 2, NULL, 0, 0, '0'),
(310, NULL, 'pimonporn.m@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:28', NULL, 'พิมลพร', 'พิมลพร', 'อภิรมย์ชัยกุล', '', '', 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานนโยบายและแผนฯ', 7, '2024-08-05 04:52:28', 2, NULL, 0, 0, '0'),
(311, NULL, 'chonthicha.kaew@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:29', NULL, 'ชลธิชา', 'ชลธิชา', 'แก้วบุญเรือง', '', '', 'นักจัดการงานทั่วไป', '', 7, '2024-08-05 04:52:29', 2, NULL, 0, 0, '0'),
(312, NULL, 'sutat.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:29', NULL, 'สุทัศน์', 'สุทัศน์', 'ขันเลข', '', '', 'นักวิชาการศึกษา', 'หัวหน้างานบริการการศึกษา', 2, '2024-08-05 04:52:29', 2, NULL, 0, 0, '0'),
(313, NULL, 'apisada.y@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:29', NULL, 'ภิญญาพัชญ์', 'ภิญญาพัชญ์', 'ยุตบุตร', '', '', 'นักจัดการงานทั่วไป', '', 2, '2024-08-05 04:52:29', 2, NULL, 0, 0, '0'),
(314, NULL, 'kanchana.na@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:29', NULL, 'กาญจนา', 'กาญจนา', 'นะพรานบุญ', '', '', 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานริการการศึกษา', 2, '2024-08-05 04:52:29', 2, NULL, 0, 0, '0'),
(315, NULL, 'somtawin.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:29', NULL, 'ณัฐอารี', 'ณัฐอารี', 'ตุ่นจาอ้าย', '', '', 'นักจัดการงานทั่วไป', '', 2, '2024-08-05 04:52:29', 2, NULL, 0, 0, '0'),
(316, NULL, 'supaporn.luangthi@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:29', NULL, 'สุภาพร', 'สุภาพร', 'หลวงธิ', '', '', 'นักจัดการงานทั่วไป', '', 2, '2024-08-05 04:52:29', 2, NULL, 0, 0, '0'),
(317, NULL, 'nitchanan.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:29', NULL, 'ณิชนันทน์', 'ณิชนันทน์', 'ปัญญาชลรักษ์', '', '', 'นักจัดการงานทั่วไป', '', 2, '2024-08-05 04:52:29', 2, NULL, 0, 0, '0'),
(318, NULL, 'raphiphat.r@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:29', NULL, 'รพีภัทร', 'รพีภัทร', 'รินดวงดี', '', '', 'บรรณารักษ์', '', 2, '2024-08-05 04:52:29', 2, NULL, 0, 0, '0'),
(319, NULL, 'pailin.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:29', NULL, 'ไพลิน', 'ไพลิน', 'สิงห์เปา', '', '', 'เจ้าหน้าที่สำนักงาน', '', 2, '2024-08-05 04:52:29', 2, NULL, 0, 0, '0'),
(320, NULL, 'tanchanok.mayang@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:29', NULL, 'ธัญชนก', 'ธัญชนก', 'มายาง', '', '', 'นักจัดการงานทั่วไป', '', 2, '2024-08-05 04:52:29', 2, NULL, 0, 0, '0'),
(321, NULL, 'ratchapol.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:29', NULL, 'รัชพล', 'รัชพล', 'เครือทอง', '', '', 'นักจัดการงานทั่วไป', '', 2, '2024-08-05 04:52:29', 2, NULL, 0, 0, '0'),
(322, NULL, 'kittisak.t@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:30', NULL, 'กิตติศักดิ์', 'กิตติศักดิ์', 'ตุ่นกันทา', '', '', 'นักจัดการงานทั่วไป', '', 2, '2024-08-05 04:52:30', 2, NULL, 0, 0, '0'),
(323, NULL, 'tassaporn.c@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:30', NULL, 'ทัศพร', 'ทัศพร', 'จันทนานุวัฒน์กุล', '', '', 'นักจัดการงานทั่วไป', '', 2, '2024-08-05 04:52:30', 2, NULL, 0, 0, '0'),
(324, NULL, 'alongkoat.thep@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:30', NULL, 'อลงกต', 'อลงกต', 'เทพคำอ้าย', '', '', 'นักจัดการงานทั่วไป', '', 6, '2024-08-05 04:52:30', 2, NULL, 0, 0, '0'),
(325, NULL, 'nattaporn.j@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:30', NULL, 'ณัฐพร', 'ณัฐพร', 'ใจพุทธ', '', '', 'นักจัดการงานทั่วไป', 'หัวหน้างานบริหารงานวิจัยฯ', 6, '2024-08-05 04:52:30', 2, NULL, 0, 0, '0'),
(326, NULL, 'kittiphop.pr@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:30', NULL, 'กิตติภพ', 'กิตติภพ', 'พรหมเผ่า', '', '', 'วิศวกร', '', 6, '2024-08-05 04:52:30', 2, NULL, 0, 0, '0'),
(327, NULL, 'waratida.u@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:30', NULL, 'วรธิดา', 'วรธิดา', 'อุดมสม', '', '', 'นักจัดการงานทั่วไป', 'ผู้ช่วยหัวหน้างานงานวิจัยฯ', 6, '2024-08-05 04:52:30', 2, NULL, 0, 0, '0'),
(328, NULL, 'moltri.marsaen@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:30', NULL, 'มนตรี', 'มนตรี', 'มาแสน', '', '', 'วิศวกร', '', 6, '2024-08-05 04:52:30', 2, NULL, 0, 0, '0'),
(329, NULL, 'sasinar.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:30', NULL, 'ศศิณา', 'ศศิณา', 'สิทธิชมภู', '', '', 'นักจัดการงานทั่วไป', '', 6, '2024-08-05 04:52:30', 2, NULL, 0, 0, '0'),
(330, NULL, 'songsak.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:30', NULL, 'ทรงศักดิ์', 'ทรงศักดิ์', 'ขลังวิชา', '', '', 'นักจัดการงานทั่วไป', '', 6, '2024-08-05 04:52:30', 2, NULL, 0, 0, '0'),
(331, NULL, 'arisara.ka@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:31', NULL, 'อริศรา', 'อริศรา', 'กัลยาณวุฒิ', '', '', 'นักจัดการงานทั่วไป', '', 6, '2024-08-05 04:52:31', 2, NULL, 0, 0, '0'),
(332, NULL, 'sukanya.pi@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:31', NULL, 'สุกัญญา', 'สุกัญญา', 'พิบูลย์', '', '', 'นักจัดการงานทั่วไป', 'หัวหน้างานพัฒนาคุณภาพฯ', 28, '2024-08-05 04:52:31', 2, NULL, 0, 0, '0'),
(333, NULL, 'natnapa.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:31', NULL, 'เนตรนภา', 'เนตรนภา', 'สาระแปง', '', '', 'นักจัดการงานทั่วไป', '', 28, '2024-08-05 04:52:31', 2, NULL, 0, 0, '0'),
(334, NULL, 'chanakan.pa@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:31', NULL, 'ชนากานต์', 'ชนากานต์', 'ปันต๊ะถา', '', '', 'นักจัดการงานทั่วไป', '', 28, '2024-08-05 04:52:31', 2, NULL, 0, 0, '0'),
(335, NULL, 'nattapan.n@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:31', NULL, 'นัฏพันธุ์', 'นัฏพันธุ์', 'นันทวาศ', '', '', 'นักจัดการงานทั่วไป', 'หัวหน้างานพัฒนาเทคโนฯ', 29, '2024-08-05 04:52:31', 2, NULL, 0, 0, '0'),
(336, NULL, 'akaradate.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:31', NULL, 'อัครเดช', 'อัครเดช', 'ประกอบของ', '', '', 'นักจัดการงานทั่วไป', '', 29, '2024-08-05 04:52:31', 2, NULL, 0, 0, '0'),
(337, NULL, 'winai.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:31', NULL, 'วินัย', 'วินัย', 'คำสุรินทร์', '', '', 'นักวิชาการคอมพิวเตอร์', '', 29, '2024-08-05 04:52:31', 2, NULL, 0, 0, '0'),
(338, NULL, 'niwat.j@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:31', NULL, 'นิวัฒน์', 'นิวัฒน์', 'เจริญรัตนเดชะกูล', '', '', 'นักวิชาการคอมพิวเตอร์', '', 29, '2024-08-05 04:52:31', 2, NULL, 0, 0, '0'),
(339, NULL, 'patthamakarn.r@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:31', NULL, 'ปัฐมกานต์', 'ปัฐมกานต์', 'ระเบ็ง', '', '', 'นักจัดการงานทั่วไป', '', 29, '2024-08-05 04:52:31', 2, NULL, 0, 0, '0'),
(340, NULL, 'sittipong.b@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:31', NULL, 'สิทธิพงษ์', 'สิทธิพงษ์', 'บุญเพ็ชร', '', '', 'นักจัดการงานทั่วไป', '', 29, '2024-08-05 04:52:31', 2, NULL, 0, 0, '0'),
(342, NULL, 'chalermporn.gurana@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:32', NULL, 'เฉลิมพร', 'เฉลิมพร', 'กุรานา', '', '', 'นักจัดการงานทั่วไป', '', 32, '2024-08-05 04:52:32', 2, NULL, 0, 0, '0'),
(343, NULL, 'nattavee.ch@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:32', NULL, 'ณัฐวีณ์', 'ณัฐวีณ์', 'ไชยริศรี', '', '', 'นักจัดการงานทั่วไป', '', 32, '2024-08-05 04:52:32', 2, NULL, 0, 0, '0'),
(344, NULL, 'sarach.sri@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:32', NULL, 'สารัช', 'สารัช', 'ศรีบูรณ์', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 32, '2024-08-05 04:52:32', 2, NULL, 0, 0, '0'),
(345, NULL, 'tunyamon.wa@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:32', NULL, 'ธัญมล', 'ธัญมล', 'วรรณละเอียด', '', '', 'นักจัดการงานทั่วไป', '', 32, '2024-08-05 04:52:32', 2, NULL, 0, 0, '0'),
(346, NULL, 'aurakanya.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:32', NULL, 'อรกัญญา', 'อรกัญญา', 'พุทธวงค์', '', '', 'นักจัดการงานทั่วไป', '', 32, '2024-08-05 04:52:32', 2, NULL, 0, 0, '0'),
(347, NULL, 'thanawut.th@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:32', NULL, 'ธนาวุฒิ', 'ธนาวุฒิ', 'ธีรเกียรติกุล', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 32, '2024-08-05 04:52:32', 2, NULL, 0, 0, '0'),
(348, NULL, 'bancha.s@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:32', NULL, 'บัญชา', 'บัญชา', 'สุวรรณพิทักษ์', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 32, '2024-08-05 04:52:32', 2, NULL, 0, 0, '0'),
(349, NULL, 'kornthip.c@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:32', NULL, 'กรทิพย์', 'กรทิพย์', 'ชัยยานนท์', '', '', 'นักจัดการงานทั่วไป', '', 31, '2024-08-05 04:52:32', 2, NULL, 0, 0, '0'),
(350, NULL, 'nuttasri.senaluang@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:32', NULL, 'ณัฏฐนันท์', 'ณัฏฐนันท์', 'พันธุ์บุญปลูก', '', '', 'นักจัดการงานทั่วไป', '', 31, '2024-08-05 04:52:32', 2, NULL, 0, 0, '0'),
(351, NULL, 'teenaphat.p@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:32', NULL, 'ธีร์นภัส', 'ธีร์นภัส', 'ปรากฏมาก', '', '', 'นักจัดการงานทั่วไป', '', 31, '2024-08-05 04:52:32', 2, NULL, 0, 0, '0'),
(352, NULL, 'palita.aun@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:32', NULL, 'ปาลิตา', 'ปาลิตา', 'อุ่นแก้ว', '', '', 'นักจัดการงานทั่วไป', '', 31, '2024-08-05 04:52:32', 2, NULL, 0, 0, '0'),
(353, NULL, 'jirathorn.w@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:33', NULL, 'จิราธร', 'จิราธร', 'วรรณสุยะ', '', '', 'นักจัดการงานทั่วไป', '', 27, '2024-08-05 04:52:33', 2, NULL, 0, 0, '0'),
(354, NULL, 'anucha.pinsaimoon@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:33', NULL, 'อนุชา', 'อนุชา', 'ปินทรายมูล', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 27, '2024-08-05 04:52:33', 2, NULL, 0, 0, '0'),
(355, NULL, 'jerachard.k@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:33', NULL, 'จิรชาติ', 'จิรชาติ', 'ใคร้มา', '', '', 'พนักงานปฏิบัติงานช่วยสอน', '', 27, '2024-08-05 04:52:33', 2, NULL, 0, 0, '0'),
(356, NULL, 'patcharida.insee@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:33', NULL, 'พัชริดา', 'พัชริดา', 'อินทรีย์', '', '', 'นักจัดการงานทั่วไป', '', 27, '2024-08-05 04:52:33', 2, NULL, 0, 0, '0'),
(357, NULL, 'benrava.r@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:33', NULL, 'เบญราวาห์', 'เบญราวาห์', 'เรือนทิพย์', '', '', 'นักจัดการงานทั่วไป', '', 27, '2024-08-05 04:52:33', 2, NULL, 0, 0, '0'),
(358, NULL, 'nitchanan.pr@cmu.ac.th', NULL, '', 0, 0, NULL, NULL, '2024-08-05 04:52:33', NULL, 'นิชนันท์', 'นิชนันท์', 'ประไพตระกูล', '', '', 'นักจัดการงานทั่วไป', '', 27, '2024-08-05 04:52:33', 2, NULL, 0, 0, '0');
