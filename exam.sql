-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2016-07-11 09:39:34
-- 服务器版本： 5.6.24
-- PHP Version: 5.5.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- 表的结构 `exam_attach`
--

CREATE TABLE `exam_attach` (
  `id` int(11) NOT NULL,
  `classId` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `createTime` datetime NOT NULL,
  `originalFileName` varchar(100) NOT NULL,
  `savedFileName` varchar(100) NOT NULL,
  `savedPath` varchar(100) NOT NULL,
  `fileSize` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `inUse` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `exam_attach`
--

INSERT INTO `exam_attach` (`id`, `classId`, `ownerId`, `createTime`, `originalFileName`, `savedFileName`, `savedPath`, `fileSize`, `status`, `inUse`) VALUES
(1, 3, 10001, '2016-07-04 03:13:38', 'i-form-comment.png', '577a0ca287f0d.png', '1000120160704/', 1, 1, 0),
(2, 3, 10001, '2016-07-04 03:19:49', 'Python3.2.3官方文档.pdf', '577a0e15948d8.pdf', '20160704/', 674, 1, 0),
(3, 3, 10001, '2016-07-04 03:31:03', 'Python3程序开发指南.第二版(带书签).pdf', '577a10b7286ba.pdf', '20160704/', 14320.1, 1, 0),
(4, 3, 10001, '2016-07-04 03:32:45', 'Python3程序开发指南.第二版(带书签).pdf', '577a111de5db2.pdf', '20160704/', 28640.1, 1, 0),
(5, 4, 10001, '2016-07-04 04:53:06', 'i-form-password.png', '577a23f23fc83.png', '20160704/', 2.36, 1, 0),
(6, 4, 10001, '2016-07-04 04:54:41', 'i-form-name.png', '577a2451b8624.png', '20160704/', 1.83, 1, 0),
(7, 4, 10001, '2016-07-04 04:55:17', 'i-form-name.png', '577a2475c11e9.png', '20160704/', 1.83, 1, 0),
(8, 4, 10001, '2016-07-04 04:56:04', 'i-form-name.png', '577a24a4b7f96.png', '20160704/', 1.83, 1, 0),
(9, 3, 10001, '2016-07-04 04:59:25', 'ydll.pdf', '577a256d06322.pdf', '20160704/', 13.05, 1, 0),
(10, 4, 10001, '2016-07-04 06:02:13', 'ydll.pdf', '577a342521b82.pdf', '20160704/', 13.05, 1, 1),
(11, 3, 10001, '2016-07-04 06:06:30', 'i-form-tel.png', '577a352626fab.png', '20160704/', 0, 1, 0),
(12, 3, 10001, '2016-07-04 06:15:09', 'i-form-gender.png', '577a372d1027c.png', '20160704/', 0, 1, 1),
(13, 3, 10001, '2016-07-04 06:15:40', 'ydll.pdf', '577a374cd8c1f.pdf', '20160704/', 13.05, 1, 0),
(14, 7, 10001, '2016-07-04 08:29:13', 'ydll.pdf', '577a56999729b.pdf', '20160704/', 13.05, 1, 1),
(15, 7, 10001, '2016-07-04 08:41:12', 'ydll.pdf', '577a59684d27f.pdf', '20160704/', 13.05, 1, 1),
(16, 7, 10001, '2016-07-04 09:51:37', 'ydll.pdf', '577a69e96e85f.pdf', '20160704/', 13.05, 1, 1),
(17, 7, 10001, '2016-07-04 09:52:05', 'Python3程序开发指南.第二版(带书签).pdf', '577a6a056b362.pdf', '20160704/', 29.33, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `exam_category`
--

CREATE TABLE `exam_category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(100) NOT NULL,
  `parentId` int(11) DEFAULT NULL,
  `ispaper` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `exam_class`
--

CREATE TABLE `exam_class` (
  `id` int(11) NOT NULL,
  `className` varchar(100) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `createTime` datetime NOT NULL,
  `ratedScore` int(11) DEFAULT '0',
  `ratedTime` int(11) NOT NULL DEFAULT '0',
  `classAttach` varchar(500) DEFAULT NULL,
  `memo` varchar(500) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `inUse` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `exam_class`
--

INSERT INTO `exam_class` (`id`, `className`, `ownerId`, `createTime`, `ratedScore`, `ratedTime`, `classAttach`, `memo`, `status`, `inUse`) VALUES
(3, 'class1', 10001, '2016-06-29 16:58:58', 719, 11, NULL, 'classqqqq', 1, 1),
(4, 'class2', 10001, '2016-06-30 09:21:47', 33900, 16, NULL, '', 1, 1),
(5, 'class3', 10001, '2016-06-30 09:22:02', 300, 4, NULL, '', 1, 1),
(6, 'class4', 10001, '2016-06-30 19:38:43', 400, 5, NULL, '', 1, 1),
(7, '课堂一', 10001, '2016-07-04 20:28:12', 395, 8, NULL, '', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `exam_classrated`
--

CREATE TABLE `exam_classrated` (
  `id` int(11) NOT NULL,
  `ratedClassId` int(11) NOT NULL,
  `rateduserId` int(11) NOT NULL,
  `ratedScore` int(11) NOT NULL,
  `ratedComment` varchar(500) NOT NULL,
  `ratedTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `exam_classrated`
--

INSERT INTO `exam_classrated` (`id`, `ratedClassId`, `rateduserId`, `ratedScore`, `ratedComment`, `ratedTime`) VALUES
(1, 3, 10001, 80, 'item1 comment', '2016-06-30 11:22:54'),
(2, 5, 10001, 30, 'item3', '2016-06-30 11:38:48'),
(3, 3, 10001, 100, '未评价', '2016-06-30 18:10:17'),
(4, 3, 10001, 90, '未评价', '2016-06-30 18:12:20'),
(5, 3, 10001, 100, '未评价', '2016-06-30 18:21:32'),
(6, 3, 10001, 9, '未评价', '2016-06-30 18:22:04'),
(7, 3, 10001, 9, '未评价', '2016-06-30 18:22:36'),
(8, 3, 10001, 9, '未评价', '2016-06-30 18:23:13'),
(9, 3, 10001, 9, '未评价', '2016-06-30 18:24:42'),
(10, 3, 10001, 100, '未评价', '2016-06-30 18:25:10'),
(11, 3, 10001, 100, '未评价', '2016-06-30 18:45:57'),
(12, 3, 10001, 0, '未评价', '2016-06-30 18:52:00'),
(13, 3, 10001, 0, '未评价', '2016-06-30 18:52:13'),
(14, 3, 10001, 100, '未评价', '2016-06-30 18:53:29'),
(15, 4, 10001, 100, '未评价', '2016-06-30 19:01:09'),
(16, 3, 10001, 0, '未评价', '2016-06-30 19:02:45'),
(17, 3, 10001, 100, '未评价', '2016-06-30 19:02:51'),
(18, 3, 10001, 100, '未评价', '2016-06-30 19:03:04'),
(19, 4, 10001, 100, '未评价', '2016-06-30 19:04:18'),
(20, 4, 10001, 100, '未评价', '2016-06-30 19:04:25'),
(21, 4, 10001, 100, '未评价', '2016-06-30 19:04:59'),
(22, 4, 10001, 0, '未评价', '2016-06-30 19:09:38'),
(23, 4, 10001, 100, '未评价', '2016-06-30 19:12:13'),
(24, 4, 10001, 100, '未评价', '2016-06-30 19:13:20'),
(25, 4, 10001, 100, '未评价', '2016-06-30 19:18:55'),
(26, 4, 10001, 100, '未评价', '2016-06-30 19:19:37'),
(27, 4, 10001, 1000, '未评价', '2016-06-30 19:19:46'),
(28, 4, 10001, 1000, '未评价', '2016-06-30 19:21:28'),
(29, 4, 10001, 1000, '未评价', '2016-06-30 19:23:55'),
(30, 4, 10001, 10000, '未评价', '2016-06-30 19:26:34'),
(31, 4, 10001, 10000, '未评价', '2016-06-30 19:26:46'),
(32, 4, 10001, 10000, '未评价', '2016-06-30 19:26:58'),
(33, 3, 10001, 100, '未评价', '2016-06-30 19:35:26'),
(34, 3, 10001, 100, '未评价', '2016-06-30 19:35:32'),
(35, 6, 10001, 50, '未评价', '2016-06-30 19:48:32'),
(36, 6, 10001, 50, '未评价', '2016-06-30 19:48:38'),
(37, 6, 10001, 100, '未评价', '2016-07-01 09:19:14'),
(38, 5, 10001, 100, '未评价', '2016-07-01 10:39:53'),
(39, 6, 10001, 100, '未评价', '2016-07-01 10:44:41'),
(40, 6, 10051, 100, '未评价', '2016-07-01 11:17:26'),
(41, 5, 10066, 100, '未评价', '2016-07-01 11:42:06'),
(42, 4, 1, 100, '未评价', '2016-07-04 10:24:37'),
(43, 5, 1, 100, '未评价', '2016-07-04 18:40:05'),
(44, 7, 1, 100, '未评价', '2016-07-04 21:55:52'),
(45, 7, 1, 80, '未评价', '2016-07-05 09:27:17'),
(46, 7, 1, 100, '未评价', '2016-07-05 19:06:53'),
(47, 7, 1, 2, '未评价', '2016-07-05 19:11:44'),
(48, 7, 1, 100, '未评价', '2016-07-05 19:16:15'),
(49, 7, 1, 1, '未评价', '2016-07-05 19:16:50'),
(50, 7, 1, 1, '未评价', '2016-07-05 19:20:18'),
(51, 7, 10001, 11, '未评价', '2016-07-05 19:22:27');

-- --------------------------------------------------------

--
-- 表的结构 `exam_form`
--

CREATE TABLE `exam_form` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `passWord` varchar(100) DEFAULT NULL,
  `memo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `exam_form`
--

INSERT INTO `exam_form` (`id`, `name`, `passWord`, `memo`) VALUES
(1, 'form', '1464682208', 'form');

-- --------------------------------------------------------

--
-- 表的结构 `exam_grade`
--

CREATE TABLE `exam_grade` (
  `id` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `roomId` int(11) NOT NULL,
  `submitAnswer` varchar(500) NOT NULL,
  `submitTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paperId` int(11) NOT NULL,
  `gradeFinal` float DEFAULT NULL,
  `gradeSetted` float DEFAULT NULL,
  `gradeResultId` int(11) NOT NULL COMMENT '关联gradeResult表的ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `exam_grade`
--

INSERT INTO `exam_grade` (`id`, `questionId`, `ownerId`, `roomId`, `submitAnswer`, `submitTime`, `paperId`, `gradeFinal`, `gradeSetted`, `gradeResultId`) VALUES
(104, 68, 10001, 28, '', '2016-07-11 16:05:32', 1, 0, 0, 37),
(105, 67, 10001, 28, '', '2016-07-11 16:05:32', 1, 0, 0, 37),
(106, 70, 10001, 28, '', '2016-07-11 16:05:32', 1, 0, 0, 37),
(107, 71, 10001, 28, '', '2016-07-11 16:05:32', 1, 0, 0, 37),
(108, 68, 10001, 28, '', '2016-07-11 16:07:15', 1, 0, 6, 38),
(109, 67, 10001, 28, '', '2016-07-11 16:07:15', 1, 0, 3, 38),
(110, 70, 10001, 28, '', '2016-07-11 16:07:15', 1, 0, 8, 38),
(111, 71, 10001, 28, '', '2016-07-11 16:07:15', 1, 0, 1, 38),
(112, 68, 10001, 28, '', '2016-07-11 16:09:40', 1, 0, 0, 39),
(113, 67, 10001, 28, '', '2016-07-11 16:09:40', 1, 0, 0, 39),
(114, 70, 10001, 28, '', '2016-07-11 16:09:40', 1, 0, 0, 39),
(115, 71, 10001, 28, '', '2016-07-11 16:09:40', 1, 0, 1, 39),
(116, 68, 10001, 28, '', '2016-07-11 16:10:50', 1, 0, 0, 40),
(117, 67, 10001, 28, '', '2016-07-11 16:10:50', 1, 0, 0, 40),
(118, 70, 10001, 28, '', '2016-07-11 16:10:50', 1, 0, 0, 40),
(119, 71, 10001, 28, '', '2016-07-11 16:10:50', 1, 0, 1, 40),
(120, 68, 10001, 28, '', '2016-07-11 16:20:51', 1, 0, 0, 41),
(121, 67, 10001, 28, '', '2016-07-11 16:20:51', 1, 0, 0, 41),
(122, 70, 10001, 28, '', '2016-07-11 16:20:51', 1, 0, 0, 41),
(123, 71, 10001, 28, '', '2016-07-11 16:20:51', 1, 0, 1, 41),
(124, 68, 10001, 28, '', '2016-07-11 16:35:21', 1, 0, 0, 42),
(125, 67, 10001, 28, '', '2016-07-11 16:35:21', 1, 0, 0, 42),
(126, 70, 10001, 28, '', '2016-07-11 16:35:21', 1, 0, 0, 42),
(127, 71, 10001, 28, '', '2016-07-11 16:35:21', 1, 0, 1, 42);

-- --------------------------------------------------------

--
-- 表的结构 `exam_graderesult`
--

CREATE TABLE `exam_graderesult` (
  `id` int(11) NOT NULL,
  `roomId` int(11) NOT NULL,
  `paperId` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `finalScore` float DEFAULT '0',
  `scoredTime` datetime DEFAULT NULL,
  `scoredTeacherId` int(11) NOT NULL,
  `assignerId` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createTime` datetime NOT NULL COMMENT '交卷时间',
  `startTime` datetime NOT NULL COMMENT '开始答卷时间',
  `paperRule1` int(11) NOT NULL,
  `paperRule2` int(11) NOT NULL,
  `paperRule3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `exam_graderesult`
--

INSERT INTO `exam_graderesult` (`id`, `roomId`, `paperId`, `ownerId`, `finalScore`, `scoredTime`, `scoredTeacherId`, `assignerId`, `status`, `createTime`, `startTime`, `paperRule1`, `paperRule2`, `paperRule3`) VALUES
(37, 28, 1, 10001, 0, NULL, 10001, NULL, 0, '2016-07-11 16:05:32', '0000-00-00 00:00:00', 0, 1, 0),
(38, 28, 1, 10001, 0, NULL, 10001, NULL, 0, '2016-07-11 16:07:15', '0000-00-00 00:00:00', 0, 1, 0),
(39, 28, 1, 10001, 0, NULL, 10001, NULL, 0, '2016-07-11 16:09:40', '0000-00-00 00:00:00', 0, 1, 0),
(40, 28, 1, 10001, 0, NULL, 10001, NULL, 0, '2016-07-11 16:10:50', '0000-00-00 00:00:00', 0, 1, 0),
(41, 28, 1, 10001, 0, NULL, 10001, NULL, 0, '2016-07-11 16:20:51', '0000-00-00 00:00:00', 0, 1, 0),
(42, 28, 1, 10001, 0, NULL, 10001, NULL, 0, '2016-07-11 16:35:21', '2016-07-11 16:34:20', 0, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `exam_org`
--

CREATE TABLE `exam_org` (
  `id` int(11) NOT NULL,
  `orgName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `roleGroup` int(11) DEFAULT NULL,
  `parentId` int(11) DEFAULT NULL,
  `isUser` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `exam_org`
--

INSERT INTO `exam_org` (`id`, `orgName`, `roleGroup`, `parentId`, `isUser`) VALUES
(1, '根节点', NULL, NULL, 0),
(33, '分类1', NULL, 1, 0),
(41, '分类22', NULL, 1, 0),
(42, '分类2-1', NULL, 41, 0),
(43, '分类1-1', NULL, 33, 0),
(44, '分类3', NULL, 1, 0),
(45, '分类1-2', NULL, 33, 0);

-- --------------------------------------------------------

--
-- 表的结构 `exam_paper`
--

CREATE TABLE `exam_paper` (
  `id` int(11) NOT NULL,
  `paperName` varchar(100) NOT NULL,
  `paperRule1` int(11) NOT NULL DEFAULT '0' COMMENT '评分方式，手动、自动',
  `paperRule2` int(11) DEFAULT NULL COMMENT '预留评分规则字段',
  `paperRule3` int(11) DEFAULT NULL,
  `paperShare` int(11) NOT NULL DEFAULT '1' COMMENT '是否共享',
  `status` int(11) NOT NULL DEFAULT '0',
  `memo` varchar(500) DEFAULT NULL,
  `createTime` datetime NOT NULL,
  `ownerId` int(11) NOT NULL,
  `questionHowMany` int(11) DEFAULT '0',
  `inUse` int(11) NOT NULL DEFAULT '1',
  `gradeTotal` float DEFAULT '0',
  `isAuto` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `exam_paper`
--

INSERT INTO `exam_paper` (`id`, `paperName`, `paperRule1`, `paperRule2`, `paperRule3`, `paperShare`, `status`, `memo`, `createTime`, `ownerId`, `questionHowMany`, `inUse`, `gradeTotal`, `isAuto`) VALUES
(1, 'paper1', 0, 1, 0, 0, 1, 'paper1', '2016-06-18 00:00:00', 10001, NULL, 1, 0, 0),
(2, 'paper2', 0, NULL, NULL, 1, 1, '', '2016-06-18 00:00:00', 10001, NULL, 1, 0, 0),
(3, 'paper5', 1, NULL, NULL, 1, 0, '', '2016-06-23 13:58:51', 10001, NULL, 1, 0, 0),
(4, 'paper4', 1, NULL, NULL, 1, 1, '', '2016-06-23 14:01:51', 10001, NULL, 0, 0, 0),
(5, 'paper3', 1, NULL, NULL, 1, 1, '', '2016-06-23 20:57:33', 10001, NULL, 1, 0, 0),
(6, 'paper6', 0, NULL, NULL, 0, 0, '', '2016-06-23 21:10:49', 10001, NULL, 1, 0, 0),
(7, 'paper7', 0, 1, 0, 0, 0, '', '2016-06-23 21:21:24', 10001, NULL, 1, 0, 0),
(8, 'paper8', 0, 1, 1, 0, 0, '', '2016-06-23 21:22:37', 10001, NULL, 1, 3, 0),
(9, 'paper9', 0, NULL, NULL, 0, 0, '', '2016-06-23 21:26:08', 10001, NULL, 0, 0, 0),
(10, 'paper111', 0, 0, 1, 0, 0, '', '2016-06-23 21:27:07', 10001, NULL, 1, 0, 0),
(11, 'paper11', 1, NULL, NULL, 1, 0, '', '2016-06-23 21:42:49', 10001, NULL, 0, 0, 0),
(12, 'paper12', 0, NULL, NULL, 0, 0, '', '2016-06-23 21:45:13', 10001, NULL, 0, NULL, 0),
(13, 'paper13', 1, NULL, NULL, 1, 1, '', '2016-06-23 21:45:45', 10001, NULL, 0, 0, 0),
(14, '试题测试', 0, NULL, NULL, 0, 0, '', '2016-06-24 09:27:30', 10001, NULL, 0, 0, 0),
(15, 'paper102', 1, 1, 0, 0, 1, '', '2016-07-07 10:54:47', 10001, NULL, 1, 100, 0),
(72, '自动组卷-测试自动组卷一-admin2016-07-07 19:07:00', 1, 1, 0, 0, 0, '本试卷为系统自动组卷，组卷人：admin,组卷试卷：2016-07-07 19:07:00', '2016-07-07 19:07:00', 10001, NULL, 1, 100, 1),
(73, '自动组卷-测试自动组卷一-admin2016-07-07 19:07:14', 1, 1, 0, 0, 0, '本试卷为系统自动组卷，组卷人：admin,组卷试卷：2016-07-07 19:07:14', '2016-07-07 19:07:14', 10001, NULL, 1, 100, 1),
(74, '自动组卷-测试自动组卷二-admin2016-07-07 19:07:25', 1, 1, 0, 0, 0, '本试卷为系统自动组卷，组卷人：admin,组卷试卷：2016-07-07 19:07:25', '2016-07-07 19:07:25', 10001, NULL, 1, 100, 1),
(75, '自动组卷-测试考场自动组卷三-admin2016-07-07 19:07:25', 1, 1, 0, 0, 1, '本试卷为系统自动组卷，组卷人：admin,组卷试卷：2016-07-07 19:07:25', '2016-07-07 19:07:25', 10001, NULL, 1, 100, 1),
(76, '自动组卷-自动组卷考场-admin2016-07-07 19:07:52', 1, 1, 0, 0, 1, '本试卷为系统自动组卷，组卷人：admin,组卷试卷：2016-07-07 19:07:52', '2016-07-07 19:07:52', 10001, NULL, 1, 100, 1),
(77, '自动组卷-auto-admin2016-07-07 19:07:40', 1, 1, 0, 0, 1, '本试卷为系统自动组卷，组卷人：admin,组卷试卷：2016-07-07 19:07:40', '2016-07-07 19:07:40', 10001, NULL, 1, 100, 1),
(78, '自动组卷-auto2-admin2016-07-07 19:07:07', 1, 1, 0, 0, 1, '本试卷为系统自动组卷，组卷人：admin,组卷试卷：2016-07-07 19:07:07', '2016-07-07 19:07:07', 10001, NULL, 1, 100, 1),
(79, '自动组卷-aaaaa-admin2016-07-07 19:07:14', 1, 1, 0, 0, 1, '本试卷为系统自动组卷，组卷人：admin,组卷试卷：2016-07-07 19:07:14', '2016-07-07 19:07:14', 10001, NULL, 1, 100, 1),
(80, '自动组卷-bbbbb-admin2016-07-07 19:07:49', 1, 1, 0, 0, 1, '本试卷为系统自动组卷，组卷人：admin,组卷试卷：2016-07-07 19:07:49', '2016-07-07 19:07:49', 10001, NULL, 1, 100, 1),
(81, '自动组卷-cccc-admin2016-07-07 19:07:08', 1, 1, 0, 0, 1, '本试卷为系统自动组卷，组卷人：admin,组卷试卷：2016-07-07 19:07:08', '2016-07-07 19:07:08', 10001, NULL, 1, 100, 1),
(82, '自动组卷-ddddd-admin2016-07-07 19:07:13', 1, 1, 0, 0, 1, '本试卷为系统自动组卷，组卷人：admin,组卷试卷：2016-07-07 19:07:13', '2016-07-07 19:07:13', 10001, NULL, 1, 100, 1),
(83, '自动组卷-eeeee-admin2016-07-07 19:07:14', 1, 1, 0, 0, 1, '本试卷为系统自动组卷，组卷人：admin,组卷试卷：2016-07-07 19:07:14', '2016-07-07 19:07:14', 10001, NULL, 1, 100, 1),
(84, '测试试题数量', 0, 0, 0, 0, 0, '', '2016-07-08 11:14:51', 10001, 6, 1, 0, 0),
(85, '自动组卷-测试自动组卷-admin2016-07-08 11:07:40', 1, 1, 0, 0, 1, '本试卷为系统自动组卷，组卷人：admin,组卷试卷：2016-07-08 11:07:40', '2016-07-08 11:07:40', 10001, 8, 1, 100, 1),
(86, '试卷test', 1, 0, 0, 0, 0, '', '2016-07-10 09:01:00', 10001, 0, 1, 0, 0),
(87, '试卷test2', 1, 1, 1, 0, 1, '', '2016-07-10 09:30:15', 10001, 5, 1, 80, 0),
(88, '自动组卷-自动-admin2016-07-10 09:07:45', 1, 1, 0, 0, 1, '本试卷为系统自动组卷，组卷人：admin,组卷试卷：2016-07-10 09:07:45', '2016-07-10 09:07:45', 10001, 13, 1, 100, 1),
(89, 'A-dfsfd-admin-2016-07-10 09:38:51', 1, 1, 0, 0, 1, '本试卷为系统自动组卷，组卷人：admin,组卷试卷：2016-07-10 09:07:51', '2016-07-10 09:07:51', 10001, 8, 1, 12, 1);

-- --------------------------------------------------------

--
-- 表的结构 `exam_question`
--

CREATE TABLE `exam_question` (
  `id` int(11) NOT NULL,
  `questionName` varchar(500) NOT NULL,
  `questionContent` varchar(500) DEFAULT NULL,
  `questionHowMany` int(11) DEFAULT NULL COMMENT '问题数量',
  `ownerId` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `answer` varchar(100) DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `questionType` int(11) DEFAULT NULL,
  `questionShare` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `inUse` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `exam_question`
--

INSERT INTO `exam_question` (`id`, `questionName`, `questionContent`, `questionHowMany`, `ownerId`, `createTime`, `answer`, `comment`, `questionType`, `questionShare`, `status`, `inUse`) VALUES
(1, 'question1', 'q1', 1, 10001, '0000-00-00 00:00:00', '', '0', 1, 0, 0, 0),
(2, '单选5', 'q2', 1, 10001, '0000-00-00 00:00:00', 'da', '0', 2, 0, 1, 1),
(3, '单选6', 'q3', 2, 10001, '0000-00-00 00:00:00', 'da', '0', 2, 0, 1, 1),
(4, '单选4', 'q4', 2, 10001, '0000-00-00 00:00:00', 'da', '0', 2, 0, 1, 1),
(13, '单选3', 'q5', 1, 10001, NULL, 'da', '', 2, 0, 1, 1),
(14, 'question6', 'q6', 6, 10001, NULL, NULL, NULL, 1, 0, 1, 0),
(15, '问答1', 'q7', 1, 10001, NULL, 'aaa', '', 4, 0, 1, 1),
(16, 'question8', 'q8', 2, 10001, NULL, NULL, NULL, 3, 0, 1, 0),
(17, '测试问题一', '测试问题一的内容', 2, 10001, '2016-06-27 10:58:34', '测试问题一的答案', '0', 4, 1, 1, 1),
(18, '测试试题一', '', 0, 10001, '2016-06-27 11:02:37', '', '', 1, 0, 0, 0),
(19, '单选2', '试题二内容', 1, 10001, '2016-06-27 11:05:45', 'da', '', 2, 1, 1, 1),
(20, 'question111', '试题三内容', 10, 10001, '2016-06-27 11:11:19', '试题三答案', 'sssss', 2, 1, 0, 0),
(21, '问题四', '四，内容四，答案', 5, 10001, '2016-06-27 11:16:45', '', '四，解答', 2, 1, 1, 0),
(22, '试题五', '五，内容', 2, 10001, '2016-06-27 11:22:58', '五答案/答案/', '五，解答', 3, 1, 1, 0),
(23, 'question11', 'question11 content', 10, 10001, '2016-06-27 11:33:54', 'q11 answer', 'q11 comment', 4, 0, 1, 1),
(24, 'q12', 'q12', 8, 10001, '2016-06-27 11:36:55', 'q12', 'q12', 4, 0, 1, 0),
(25, '测试换行', 'a\r\nb\r\nc\r\nd\r\n', 1, 10001, '2016-06-28 22:27:24', 'a', '', 4, 0, 1, 1),
(26, '单选11', 'qqqq', 1, 10001, '2016-07-01 15:52:57', 'q', '', 1, 0, 1, 1),
(27, 'testquestion', 'test', 1, 10001, '2016-07-10 09:05:31', 'test', '', 1, 0, 1, 0),
(28, 'ttttt', 'tttt', 1, 10001, '2016-07-10 09:17:07', 'tt', '', 1, 0, 1, 0),
(29, 'ddd', 'ddd', 1, 10001, '2016-07-10 09:17:24', 'ddd', '', 2, 0, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `exam_questionselected`
--

CREATE TABLE `exam_questionselected` (
  `id` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `paperId` int(11) NOT NULL,
  `gradeSetted` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `exam_questionselected`
--

INSERT INTO `exam_questionselected` (`id`, `questionId`, `paperId`, `gradeSetted`) VALUES
(43, 15, 2, 0),
(44, 16, 2, 0),
(67, 13, 1, 0),
(68, 14, 1, 0),
(70, 16, 1, 0),
(71, 15, 1, 1),
(75, 14, 2, 0),
(77, 1, 3, 0),
(78, 2, 3, 0),
(79, 4, 3, 0),
(80, 3, 3, 0),
(82, 3, 4, 0),
(83, 13, 4, 0),
(84, 1, 5, 0),
(86, 2, 5, 0),
(97, 1, 11, 0),
(100, 25, 2, 0),
(101, 19, 8, 11),
(103, 17, 8, 18),
(104, 19, 8, 12),
(105, 25, 8, 19),
(106, 2, 10, 1),
(107, 3, 10, 2),
(108, 17, 10, 3),
(109, 25, 10, 4),
(110, 2, 8, 15),
(111, 3, 8, 16),
(112, 4, 8, 20),
(113, 13, 8, 13),
(114, 15, 8, 17),
(115, 23, 8, 21),
(116, 26, 8, 14),
(117, 17, 7, 1),
(118, 19, 7, 1),
(119, 4, 74, 16.67),
(120, 13, 74, 16.67),
(121, 19, 74, 16.67),
(122, 17, 74, 16.67),
(123, 23, 74, 16.67),
(124, 25, 74, 16.67),
(125, 4, 75, 16.67),
(126, 13, 75, 16.67),
(127, 19, 75, 16.67),
(131, 2, 76, 25),
(132, 3, 76, 25),
(133, 13, 76, 25),
(134, 19, 76, 25),
(135, 2, 77, 50),
(136, 19, 77, 50),
(137, 3, 78, 20),
(138, 4, 78, 20),
(139, 13, 78, 20),
(140, 19, 78, 20),
(141, 26, 78, 20),
(142, 2, 79, 11.11),
(143, 3, 79, 11.11),
(144, 4, 79, 11.11),
(145, 13, 79, 11.11),
(146, 26, 79, 11.11),
(147, 15, 79, 11.11),
(148, 17, 79, 11.11),
(149, 23, 79, 11.11),
(150, 25, 79, 11.11),
(151, 2, 80, 12.5),
(152, 3, 80, 12.5),
(153, 4, 80, 12.5),
(154, 13, 80, 12.5),
(155, 19, 80, 12.5),
(156, 26, 80, 12.5),
(157, 17, 80, 12.5),
(158, 23, 80, 12.5),
(159, 2, 81, 16.67),
(160, 3, 81, 16.67),
(161, 4, 81, 16.67),
(162, 13, 81, 16.67),
(163, 19, 81, 16.67),
(164, 26, 81, 16.67),
(165, 3, 82, 25),
(166, 13, 82, 25),
(167, 19, 82, 25),
(168, 26, 82, 25),
(169, 2, 83, 16.67),
(170, 3, 83, 16.67),
(171, 4, 83, 16.67),
(172, 13, 83, 16.67),
(173, 19, 83, 16.67),
(174, 26, 83, 16.67),
(177, 4, 84, 0),
(178, 13, 84, 0),
(179, 15, 84, 0),
(180, 17, 84, 0),
(181, 19, 84, 0),
(182, 23, 84, 0),
(183, 2, 85, 12.5),
(184, 3, 85, 12.5),
(185, 4, 85, 12.5),
(186, 13, 85, 12.5),
(187, 19, 85, 12.5),
(188, 26, 85, 12.5),
(189, 23, 85, 12.5),
(190, 25, 85, 12.5),
(191, 2, 87, 0),
(192, 3, 87, 0),
(193, 4, 87, 0),
(194, 13, 87, 0),
(200, 26, 87, 0),
(201, 2, 88, 11.11),
(202, 3, 88, 11.11),
(203, 4, 88, 11.11),
(204, 13, 88, 11.11),
(205, 19, 88, 11.11),
(206, 15, 88, 11.11),
(207, 17, 88, 11.11),
(208, 23, 88, 11.11),
(209, 25, 88, 11.11),
(210, 2, 89, 2.4),
(211, 3, 89, 2.4),
(212, 4, 89, 2.4),
(213, 13, 89, 2.4),
(214, 19, 89, 2.4);

-- --------------------------------------------------------

--
-- 表的结构 `exam_questiontype`
--

CREATE TABLE `exam_questiontype` (
  `id` int(11) NOT NULL,
  `typeName` varchar(50) NOT NULL,
  `memo` varchar(100) NOT NULL,
  `inUse` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `exam_questiontype`
--

INSERT INTO `exam_questiontype` (`id`, `typeName`, `memo`, `inUse`) VALUES
(1, '填空', '以括号()代表一个空格', 1),
(2, '单选', '需填写选项数量', 1),
(3, '多选', '需填写选项数量', 1),
(4, '问答', '问答类型无特殊要求', 1);

-- --------------------------------------------------------

--
-- 表的结构 `exam_role`
--

CREATE TABLE `exam_role` (
  `id` int(11) NOT NULL,
  `roleTitle` varchar(50) DEFAULT NULL,
  `roleLevel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `exam_role`
--

INSERT INTO `exam_role` (`id`, `roleTitle`, `roleLevel`) VALUES
(1, '系统管理员', 1),
(2, '老师', 2),
(3, '普通用户', 3);

-- --------------------------------------------------------

--
-- 表的结构 `exam_room`
--

CREATE TABLE `exam_room` (
  `id` int(11) NOT NULL,
  `roomName` varchar(100) NOT NULL,
  `paper` varchar(100) DEFAULT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `timeLimit` int(11) DEFAULT NULL,
  `userRange` varchar(100) DEFAULT NULL,
  `passScore` int(11) NOT NULL DEFAULT '0',
  `memo` varchar(1000) DEFAULT NULL,
  `forceEnd` int(11) DEFAULT '0',
  `ownerId` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `inUse` int(11) NOT NULL DEFAULT '1',
  `paperAuto` int(11) DEFAULT '0',
  `questionHowMany` int(11) DEFAULT NULL,
  `questionType1` int(11) DEFAULT NULL,
  `questionType2` int(11) DEFAULT NULL,
  `questionType3` int(11) DEFAULT NULL,
  `questionType4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='考场信息表';

--
-- 转存表中的数据 `exam_room`
--

INSERT INTO `exam_room` (`id`, `roomName`, `paper`, `startTime`, `endTime`, `timeLimit`, `userRange`, `passScore`, `memo`, `forceEnd`, `ownerId`, `createTime`, `status`, `inUse`, `paperAuto`, `questionHowMany`, `questionType1`, `questionType2`, `questionType3`, `questionType4`) VALUES
(20, 'room2', '7', '2016-06-01 00:00:00', '2018-06-29 00:00:00', 30, '', 0, 'memo', 0, 10001, '2016-06-18 12:12:35', 1, 1, 0, NULL, 0, NULL, NULL, NULL),
(22, 'room4', '1', '2016-06-20 00:00:00', '2016-06-30 00:00:00', 10, '1,33,41,42', 0, '', 1, 10001, '2016-06-18 14:42:47', 1, 1, 0, NULL, 0, NULL, NULL, NULL),
(23, 'room5', '13', '2016-06-25 00:00:00', '2016-06-26 00:00:00', 80, '1,33,41,42', 0, '买买买', 1, 10001, '2016-06-18 14:53:50', 1, 1, 0, NULL, 0, NULL, NULL, NULL),
(26, 'room1', '7', '2016-06-14 00:00:00', '2017-06-30 00:00:00', 10, '33,43,45,44', 60, '', 1, 10001, '2016-06-18 18:08:15', 1, 1, 0, NULL, 0, NULL, NULL, NULL),
(27, '测试考场（一）', '2', '2016-06-23 00:00:00', '2016-06-30 00:00:00', 30, '1,33,41,42', 0, '测试考场备注', 0, 10001, '2016-06-22 22:03:57', 0, 1, 0, NULL, 0, NULL, NULL, NULL),
(28, 'room', '1', NULL, NULL, 1, '', 60, '', 1, 10001, '2016-07-01 16:00:50', 1, 1, 0, 0, 0, 0, 0, 0),
(29, 'room6', '1', NULL, NULL, 0, '', 0, '', 0, 10001, '2016-07-01 16:02:03', 1, 1, 0, NULL, 0, NULL, NULL, NULL),
(30, 'room7', '10', NULL, NULL, 0, '44,', 60, '', 0, 10001, '2016-07-01 16:06:54', 0, 1, 0, NULL, 0, NULL, NULL, NULL),
(31, 'room8', '8', '2016-07-06 00:00:00', '2016-07-15 00:00:00', 0, '33,43,45,', 60, '', 0, 10001, '2016-07-01 16:09:55', 0, 1, 0, NULL, 0, NULL, NULL, NULL),
(32, 'room9', '10', NULL, NULL, 0, '', 0, '', 0, 10001, '2016-07-01 16:14:00', 0, 0, 0, NULL, 0, NULL, NULL, NULL),
(33, 'room9999', '15', '2016-07-06 00:00:00', '2016-07-29 00:00:00', 30, '41,42', 60, 'room9 memo', 1, 10001, '2016-07-06 23:07:44', 1, 1, 1, 4, 1, 1, 1, 1),
(34, 'room111', '8', NULL, NULL, 0, '', 0, '', 1, 10001, '2016-07-07 11:25:38', 1, 1, 1, 0, 1, 1, 1, 1),
(35, '测试手工选卷', '15', NULL, NULL, 0, '', 0, '', 0, 10001, '2016-07-07 18:53:12', 0, 1, 0, 0, 0, 0, 0, 0),
(36, '测试自动组卷一', '', NULL, NULL, 0, '', 0, '', 0, 10001, '2016-07-07 19:02:00', 0, 1, 1, 6, 0, 50, 0, 50),
(37, '测试自动组卷二', '', NULL, NULL, 0, '', 0, '', 0, 10001, '2016-07-07 19:04:25', 0, 1, 1, 6, 0, 50, 0, 50),
(38, '测试考场自动组卷三', '75', NULL, NULL, 0, '', 0, '', 0, 10001, '2016-07-07 19:06:25', 0, 1, 1, 6, 0, 50, 0, 50),
(39, '自动组卷考场', '76', NULL, NULL, 0, '', 0, '', 0, 10001, '2016-07-07 19:25:52', 0, 1, 1, 4, 1, 50, 1, 1),
(40, 'auto', '77', NULL, NULL, 0, '', 0, '', 0, 10001, '2016-07-07 19:32:40', 0, 1, 1, 6, 20, 20, 20, 10),
(41, 'auto2', '78', NULL, NULL, 0, '', 0, '', 0, 10001, '2016-07-07 19:38:07', 0, 1, 1, 5, 0, 100, 0, 0),
(42, 'aaaaa', '79', NULL, NULL, 0, '', 0, '', 0, 10001, '2016-07-07 19:44:14', 0, 1, 1, 10, 0, 50, 0, 50),
(43, 'bbbbb', '80', NULL, NULL, 0, '44,', 60, '', 1, 10001, '2016-07-07 19:45:49', 1, 1, 1, 0, 0, 80, 0, 20),
(44, 'cccc', '81', NULL, NULL, 0, '', 60, '', 1, 10001, '2016-07-07 19:48:08', 1, 1, 1, 0, 0, 100, 0, 0),
(45, 'ddddd', '82', NULL, NULL, 0, '', 60, '', 1, 10001, '2016-07-07 19:49:13', 1, 1, 1, 0, 0, 100, 0, 0),
(46, 'eeeee', '83', NULL, NULL, 0, '44,', 60, '', 1, 10001, '2016-07-07 19:51:14', 1, 1, 1, 0, 0, 100, 0, 0),
(47, '测试自动组卷111', '85', NULL, NULL, 0, '33,43,45,', 0, '', 0, 10001, '2016-07-08 11:19:40', 1, 1, 0, 0, 0, 6, 0, 2),
(48, '考场222', '87', NULL, NULL, 0, '', 0, '', 0, 10001, '2016-07-10 09:32:07', 0, 0, 0, NULL, 0, 0, 0, 0),
(49, '自动', '88', NULL, NULL, 0, '', 0, '', 0, 10001, '2016-07-10 09:34:45', 0, 1, 1, 13, 1, 6, 1, 5),
(50, 'dfsfd', '89', NULL, NULL, 0, '', 0, '', 0, 10001, '2016-07-10 09:38:51', 0, 1, 1, 8, 1, 5, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `exam_test`
--

CREATE TABLE `exam_test` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `passWord` varchar(100) DEFAULT NULL,
  `memo` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `exam_test`
--

INSERT INTO `exam_test` (`id`, `name`, `passWord`, `memo`) VALUES
(23, 'zzz', NULL, 'memo'),
(24, 'zzz', NULL, 'memo'),
(25, '111', '111', 'memo');

-- --------------------------------------------------------

--
-- 表的结构 `exam_users`
--

CREATE TABLE `exam_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `userName` varchar(50) CHARACTER SET utf8 NOT NULL,
  `userPass` varchar(50) CHARACTER SET utf8 NOT NULL,
  `userRole` int(11) NOT NULL,
  `parentId` int(11) NOT NULL,
  `isuser` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `inUse` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `exam_users`
--

INSERT INTO `exam_users` (`id`, `userName`, `userPass`, `userRole`, `parentId`, `isuser`, `status`, `inUse`) VALUES
(10001, 'admin', 'b41e8b803278088c272dcba94a78233c', 1, 1, 1, 1, 1),
(10051, 'yh1', '698d51a19d8a121ce581499d7b701668', 3, 33, 1, 1, 1),
(10056, 'yh66', '698d51a19d8a121ce581499d7b701668', 2, 33, 1, 1, 1),
(10065, 'yh2', '698d51a19d8a121ce581499d7b701668', 3, 41, 1, 1, 1),
(10066, 'yh3', '698d51a19d8a121ce581499d7b701668', 3, 33, 1, 1, 1),
(10067, 'yh4', '698d51a19d8a121ce581499d7b701668', 3, 43, 1, 1, 1),
(10068, 'yh5', '698d51a19d8a121ce581499d7b701668', 3, 44, 1, 1, 1),
(10069, 'yh6', '698d51a19d8a121ce581499d7b701668', 3, 45, 1, 1, 1),
(10070, 'yhaa', '698d51a19d8a121ce581499d7b701668', 3, 43, 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam_attach`
--
ALTER TABLE `exam_attach`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_category`
--
ALTER TABLE `exam_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_class`
--
ALTER TABLE `exam_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_classrated`
--
ALTER TABLE `exam_classrated`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_form`
--
ALTER TABLE `exam_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_grade`
--
ALTER TABLE `exam_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_graderesult`
--
ALTER TABLE `exam_graderesult`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_org`
--
ALTER TABLE `exam_org`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_paper`
--
ALTER TABLE `exam_paper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_question`
--
ALTER TABLE `exam_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_questionselected`
--
ALTER TABLE `exam_questionselected`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_questiontype`
--
ALTER TABLE `exam_questiontype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_role`
--
ALTER TABLE `exam_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_room`
--
ALTER TABLE `exam_room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_test`
--
ALTER TABLE `exam_test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `exam_users`
--
ALTER TABLE `exam_users`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `exam_attach`
--
ALTER TABLE `exam_attach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- 使用表AUTO_INCREMENT `exam_category`
--
ALTER TABLE `exam_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `exam_class`
--
ALTER TABLE `exam_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `exam_classrated`
--
ALTER TABLE `exam_classrated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- 使用表AUTO_INCREMENT `exam_form`
--
ALTER TABLE `exam_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `exam_grade`
--
ALTER TABLE `exam_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- 使用表AUTO_INCREMENT `exam_graderesult`
--
ALTER TABLE `exam_graderesult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- 使用表AUTO_INCREMENT `exam_org`
--
ALTER TABLE `exam_org`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- 使用表AUTO_INCREMENT `exam_paper`
--
ALTER TABLE `exam_paper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- 使用表AUTO_INCREMENT `exam_question`
--
ALTER TABLE `exam_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- 使用表AUTO_INCREMENT `exam_questionselected`
--
ALTER TABLE `exam_questionselected`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;
--
-- 使用表AUTO_INCREMENT `exam_questiontype`
--
ALTER TABLE `exam_questiontype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `exam_role`
--
ALTER TABLE `exam_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `exam_room`
--
ALTER TABLE `exam_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- 使用表AUTO_INCREMENT `exam_test`
--
ALTER TABLE `exam_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- 使用表AUTO_INCREMENT `exam_users`
--
ALTER TABLE `exam_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10071;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
