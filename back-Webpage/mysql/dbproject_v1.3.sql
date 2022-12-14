-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-12-14 18:48:21
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `dbproject`
--

-- --------------------------------------------------------

--
-- 資料表結構 `bulletin`
--

CREATE TABLE `bulletin` (
  `bulletin_ID` varchar(256) NOT NULL,
  `content` varchar(256) NOT NULL,
  `course_ID` varchar(256) NOT NULL,
  `class` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `course`
--

CREATE TABLE `course` (
  `course_ID` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `class` varchar(256) NOT NULL,
  `teacher` varchar(256) NOT NULL,
  `semester` varchar(256) NOT NULL,
  `dept` varchar(256) NOT NULL,
  `credit` int(20) NOT NULL,
  `grade` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `course`
--

INSERT INTO `course` (`course_ID`, `name`, `class`, `teacher`, `semester`, `dept`, `credit`, `grade`) VALUES
('B57011RQ', '計算機概論', 'B', '許為元(William Hsu)', '1091', '資訊工程學系(Computer Science and Engineering)', 3, 1),
('B5701M30', '程式設計實習', 'B', '張欽圳(Chin-Chun Chang)', '1091', '資訊工程學系(Computer Science and Engineering)', 1, 1),
('B5701M33', '程式設計', 'B', '張欽圳(Chin-Chun Chang)', '1091', '資訊工程學系(Computer Science and Engineering)', 3, 1),
('B5702N57', '資料結構', 'B', '蔡東佐(Tung-Tso Tsai)', '1101', '資訊工程學系(Computer Science and Engineering)', 3, 2),
('B5703N54', '資料庫系統', 'A', '張雅惠(Ya-Hui Chang)', '1111', '資訊工程學系(Computer Science and Engineering)', 3, 3);

-- --------------------------------------------------------

--
-- 資料表結構 `message`
--

CREATE TABLE `message` (
  `mess_ID` varchar(256) NOT NULL,
  `text` varchar(256) NOT NULL,
  `coures_ID` varchar(256) NOT NULL,
  `class` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `my_course`
--

CREATE TABLE `my_course` (
  `user_ID` varchar(256) NOT NULL,
  `course_ID` varchar(256) NOT NULL,
  `class` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `user_ID` varchar(256) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `account` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `bulletin`
--
ALTER TABLE `bulletin`
  ADD PRIMARY KEY (`bulletin_ID`),
  ADD KEY `course` (`course_ID`,`class`);

--
-- 資料表索引 `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_ID`,`class`);

--
-- 資料表索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mess_ID`),
  ADD KEY `course` (`coures_ID`,`class`);

--
-- 資料表索引 `my_course`
--
ALTER TABLE `my_course`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `course` (`course_ID`,`class`),
  ADD KEY `user` (`user_ID`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `bulletin`
--
ALTER TABLE `bulletin`
  ADD CONSTRAINT `b_course_fk` FOREIGN KEY (`course_ID`,`class`) REFERENCES `course` (`course_ID`, `class`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `m_course_fk` FOREIGN KEY (`coures_ID`,`class`) REFERENCES `course` (`course_ID`, `class`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `my_course`
--
ALTER TABLE `my_course`
  ADD CONSTRAINT `my_course_fk` FOREIGN KEY (`course_ID`,`class`) REFERENCES `course` (`course_ID`, `class`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_my_course_fk` FOREIGN KEY (`user_ID`) REFERENCES `my_course` (`user_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
