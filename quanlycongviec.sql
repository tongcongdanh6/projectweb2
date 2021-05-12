-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2021 at 03:55 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlycongviec`
--
CREATE DATABASE IF NOT EXISTS `quanlycongviec` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `quanlycongviec`;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(1) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `slug`, `name`) VALUES
(1, 'phong-kinh-doanh', 'Phòng kinh doanh'),
(2, 'phong-it', 'Phòng IT'),
(3, 'phong-nhan-su', 'Phòng nhân sự'),
(4, 'phong-ke-toan', 'Phòng kế toán');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `slug`, `name`) VALUES
(1, 'truong-phong', 'Trưởng phòng'),
(2, 'pho-phong', 'Phó phòng'),
(3, 'nhan-vien', 'Nhân viên');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) NOT NULL,
  `creator` int(5) NOT NULL,
  `handler` int(5) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `deadline` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `soft_delete` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `creator`, `handler`, `title`, `slug`, `content`, `status`, `deadline`, `created_at`, `soft_delete`) VALUES
(1, 6, 7, 'Nhiệm vụ 1', 'nhiem-vu-1', 'Nội dung nhiệm vụ 1', 1, '2021-05-20 17:15:49', '2021-05-04 01:01:46', 0),
(2, 3, 8, 'IT task', 'it-task', 'IT task', 1, '2021-05-19 17:15:57', '2021-05-05 20:44:31', 0),
(3, 6, 7, 'Kinh doanh task 1', 'kinh-doanh-task-1', 'Kinh doanh task 1', 1, '2021-05-18 17:15:59', '2021-05-05 21:03:31', 0),
(4, 9, 4, 'Phòng nhân sự task 1', 'phong-nhan-su-task-1', 'Phòng nhân sự task 1', 1, '2021-05-17 17:16:02', '2021-05-05 21:16:53', 0),
(5, 9, 10, 'Phòng nhân sự task 2', 'Phòng-nhân-sự-task-2', 'Phòng nhân sự task 2', 1, '2021-05-17 17:16:02', '2021-05-12 12:23:22', 0),
(6, 9, 4, 'Nhân sự task 3', 'Nhân-sự-task-3', 'Nhân sự task 3', 1, '2021-05-17 17:16:02', '2021-05-12 01:22:21', 0),
(7, 9, 10, 'Nhân sự task 4', 'nhan-su-task-4', 'Nhân sự task 4', 1, '2021-05-27 10:35:00', '2021-05-12 01:34:28', 0),
(8, 3, 8, 'IT Task 2', 'it-task-2', 'IT Task 2', 2, '2021-05-26 08:38:00', '2021-05-12 01:37:17', 0),
(9, 3, 11, 'IT Task 3', 'it-task-3', 'IT Task 3', 2, '2021-05-27 06:57:00', '2021-05-12 01:57:20', 0),
(10, 3, 11, 'IT Task 4', 'it-task-4', 'IT Task 4', 1, '2021-05-24 10:06:00', '2021-05-12 02:06:28', 0),
(11, 3, 8, 'Task của Việt 1', 'task-cua-viet-1', 'Task của Việt 1', 1, '2021-05-20 22:58:00', '2021-05-12 14:58:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `role` int(1) NOT NULL DEFAULT 2,
  `position` int(1) NOT NULL DEFAULT 3,
  `department` int(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fullname`, `role`, `position`, `department`, `created_at`) VALUES
(3, 'tong.congdanh@gmail.com', '46c15b98701216b284bc64e7b16d01abdaa4a847ecda894521cbc4cf59a6d73a488b295361823cbb003977064a3bdf037c16cd57f1fa5894c9412869f035a5b7rJm6fXbjBshFg7pkM3ZTf25CFiPt4bl8wB25QIv7rYM=', 'Tống Công Danh', 1, 1, 2, '2021-05-03 05:15:23'),
(4, 'romeo.juliet44@yahoo.com', 'de393f5f334e21f623d86b4c8215013b8d80a2776ae18dda5e08753b3a262faa2873fccb1b3edf1a3de0ca3eba4a3fa3816feb16d9b6acc87a786d33bb301307R94SOZw+MqxmIn4waRH8Diq/gH9PVf3uo6TxWHsMl80=', 'Nguyễn Văn A', 2, 3, 3, '2021-05-04 04:06:14'),
(5, 'nguyenvanb@gmail.com', '320efe48cf4077bbba4ed45b8f4630640dae30bd4e6a3d2e2b1555dfe42d1a2ecf72129aa93ef22d702dc7551a2ddb3135e0c63c9c24e4217f2139205c67f0e7z2FfqGJ5G9bHb0YcBRrl2yokLkqvVMd+YmYUBZHNZ8U=', 'Nguyễn Văn B', 2, 3, 4, '2021-05-04 05:29:45'),
(6, 'nguyenvanc@gmail.com', 'cd8b5918fb4076398de78256578ef8a506a8bf89d9a574ddb1c00b2f6c58d26a4eef7887710bf694a306edfe643a341390dd5173cc157d295effd1508bdfdee9jKkNlcdafP+B5/oFXv/kjNgWmZNFdIAqIBcDB/CkevI=', 'Nguyễn Văn C', 2, 1, 1, '2021-05-04 05:31:01'),
(7, 'nguyenvand@gmail.com', 'd20a6c2d84bf9321f5a4c48d2ef5c41ae3a414bb3a2bd4fa70deb2565826d667ecd726c4c378394c2f1f32e32a5a06f918e3c315adfaa6456babce9798607dabuWAJlIkCqj5rUI4jn3+xXM9uJQT6rv+0K6ZBhu9KPvE=', 'Nguyễn Văn D', 2, 3, 1, '2021-05-04 05:49:38'),
(8, 'vohoangviet@gmail.com', 'fa62191acca51cce79c16d235f74e569e1643025284a39ca377ad34a54911fe15aeb989463a3573f0abfc492a19616b8bbcc5a5689e5c7fd8f302a6aa0955ae4/G3WKH821j7aH2vEbtMbdOMc1pnCYdYH5WUjKZYuATk=', 'Võ Hoàng Việt', 2, 3, 2, '2021-05-05 03:45:16'),
(9, 'phamhongphuc@gmail.com', '545a6cdaf7480098fa1c7d637a4508aa2d36fd13bebf0d704b6780e2bd03c4c49458e73f0469defd4ace83d745ff8207444bb8e41b53eb5a151a6956e88aaa771U/TYjPuN7QxQK1Qz4wWibSkQ6mp60w1xqM1gn8K6wo=', 'Phạm Hồng Phúc', 2, 1, 3, '2021-05-05 04:13:47'),
(10, 'tranducquang@gmail.com', '0bea49ed27bb13297748addf574a1cf3d17b955dbac849f35536e519fbf4bb2ba4c988bc50ec1d8e1e8e860cbbf3309bf1956d4c1119aed216f1d2a28b6e1812sSf4HM7TtUh2KeP9aICxqfZgTcNz45K0taJIySlSakE=', 'Trần Đức Quang', 2, 3, 3, '2021-05-12 10:55:59'),
(11, 'lekimson@gmail.com', '898fe610f6ce2236e5b107ec31e024ec6cf23a12a2cdfcde9429644caebe749b5cf53cc021b809f18c26e5c006402dffb72b33ba7a5002bb912c741d04cec7d10mhwsvU9gW14eULSLNY9UVuN5VjFdFeQUA9FGXuD2+w=', 'Lê Kim Sơn', 2, 3, 2, '2021-05-12 10:56:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
