-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-07-27 11:56:10
-- 服务器版本： 10.1.22-MariaDB
-- PHP Version: 7.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book`
--

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `category_no` int(11) DEFAULT NULL,
  `preview` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `name`, `category_no`, `preview`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'php', 1, NULL, NULL, NULL, NULL),
(2, 'java', 2, NULL, NULL, NULL, NULL),
(3, 'javascript', 3, NULL, NULL, NULL, NULL),
(4, 'laravel', 1, NULL, 1, NULL, NULL),
(5, 'thinkphp', 2, NULL, 1, NULL, NULL),
(6, 'yii', 3, NULL, 1, NULL, NULL),
(7, 'nodejs', 1, NULL, 3, NULL, NULL),
(8, 'reactjs', 2, NULL, 3, NULL, NULL),
(9, 'angularjs', 3, NULL, 3, NULL, NULL),
(10, 'java base', 1, NULL, 2, NULL, NULL),
(11, 'jave web', 2, NULL, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `nickname` varchar(16) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `active` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `member`
--

INSERT INTO `member` (`id`, `nickname`, `phone`, `password`, `created_at`, `updated_at`, `email`, `active`) VALUES
(23, NULL, '13125082176', 'e10adc3949ba59abbe56e057f20f883e', '2017-07-25 19:01:09', '2017-07-25 19:01:09', NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `pdt_content`
--

CREATE TABLE `pdt_content` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` varchar(20000) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pdt_content`
--

INSERT INTO `pdt_content` (`id`, `created_at`, `updated_at`, `content`, `product_id`) VALUES
(1, NULL, NULL, '<p>XXXXXXXXXX</p>', 1),
(2, NULL, NULL, '<p>XXXXXXXXXX</p>', 2),
(3, NULL, NULL, '<p>XXXXXXXXXX</p>', 3),
(4, NULL, NULL, '<p>XXXXXXXXXX</p>', 4),
(5, NULL, NULL, '<p>XXXXXXXXXX</p>', 5);

-- --------------------------------------------------------

--
-- 表的结构 `pdt_images`
--

CREATE TABLE `pdt_images` (
  `id` int(11) NOT NULL,
  `image_path` varchar(200) DEFAULT NULL,
  `image_no` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pdt_images`
--

INSERT INTO `pdt_images` (`id`, `image_path`, `image_no`, `product_id`, `created_at`, `updated_at`) VALUES
(1, '/images/book/1.jpg', 1, 1, NULL, NULL),
(2, '/images/book/2.jpg', 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `summary` varchar(200) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `preview` varchar(200) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `product`
--

INSERT INTO `product` (`id`, `name`, `summary`, `price`, `preview`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Laravel框架关键技术解析', '本书以新版本为基础进行介绍的。首先，本书从当前软件的开发思想和前沿编程技术讲起，而这些技术恰恰是laravel框架如此优雅的表现形式、模块间的低耦合、可扩展、易复用、支持分布式系统开发、支持异步数据处理等等一系列优势的核心。在此基础上从整体和模块两个层次上对laravel框架的运行机理和实现细节进行了详细介绍', '62.40', '/images/book/1.jpg', 4, NULL, NULL),
(2, 'ThinkPHP实战', 'PHP是一种通用开源脚本语言，开源、跨平台、易于使用，主要适用于Web开发领域。MVC模式使得PHP在大型Web项目开发中耦合性低、重用性高、可维护性高、有利于软件工程化管理。本书以实用性为目标，系统地介绍了ThinkPHP框架的相关技术及其在Web开发中的应用。 全书共14章，每一章都是相对独立的知识点的集合。', '38.70', '/images/book/2.jpg', 5, NULL, NULL),
(3, '深入浅出Node.js', '本书从不同的视角介绍了 Node 内在的特点和结构。涉及Node 的各个方面，主要内容包含模块机制的揭示、异步I/O 实现原理的展现、异步编程的探讨、内存控制的介绍、二进制数据Buffer 的细节、Node 中的网络编程基础、Node 中的Web 开发、进程间的消息传递、Node 测试以及通过Node 构建产品需要的注意事项。最后的附录介绍了Node 的安装、调试、编码规范和NPM 仓库等事宜。', '49.60', '/images/book/3.jpg', 7, NULL, NULL),
(4, 'AngularJS权威教程', '说到学习AngularJS，相信你早已厌倦了上网搜索、断续阅读的低效方式。本书堪称AngularJS领域的里程碑式著作，它以相当的篇幅涵盖了关于AngularJS的几乎所有内容，既是一部权威教程，又是一部参考指南。对于没有经验的人，本书平实、通俗的讲解，递进、严密的组织，可以让人毫无压力地登堂入室，迅速领悟新一代Web应用开发的精髓。', '78.20', '/images/book/4.jpg', 9, NULL, NULL),
(5, 'Java Web开发实战经典基础篇', '全书分4部分共17章，内容包括Java Web开发简介，HTML、JavaScript简介，XML简介，Tomcat服务器的安装及配置，JSP基础语法，JSP内置对象，JavaBean，文件上传，Servlet程序开发，表达式语言，Tomcat数据源，JSP标签编程，JSP标准标签库（JSTL），Ajax开发技术，Struts基础开发，Struts常用标签库，Struts高级开发。', '49.60', '/images/book/5.jpg', 11, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `temp_email`
--

CREATE TABLE `temp_email` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `code` varchar(32) DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `temp_email`
--

INSERT INTO `temp_email` (`id`, `member_id`, `code`, `deadline`) VALUES
(1, 21, '2e823168d05ae31122a9c455ca8526af', '2017-07-25 01:54:02'),
(2, 22, 'b4872918b5d5c0f1286f3a64299634cc', '2017-07-25 01:55:19');

-- --------------------------------------------------------

--
-- 表的结构 `temp_phone`
--

CREATE TABLE `temp_phone` (
  `id` int(11) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `temp_phone`
--

INSERT INTO `temp_phone` (`id`, `phone`, `code`, `deadline`) VALUES
(6, '13125082176', 975194, '2017-07-26 03:05:58'),
(7, '13125846459', 33562, '2017-07-26 03:05:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `phone_UNIQUE` (`phone`);

--
-- Indexes for table `pdt_content`
--
ALTER TABLE `pdt_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdt_images`
--
ALTER TABLE `pdt_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_email`
--
ALTER TABLE `temp_email`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_id_UNIQUE` (`member_id`);

--
-- Indexes for table `temp_phone`
--
ALTER TABLE `temp_phone`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- 使用表AUTO_INCREMENT `pdt_content`
--
ALTER TABLE `pdt_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `pdt_images`
--
ALTER TABLE `pdt_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `temp_email`
--
ALTER TABLE `temp_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `temp_phone`
--
ALTER TABLE `temp_phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
