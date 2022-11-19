-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-11-19 19:34:49
-- 伺服器版本： 10.4.25-MariaDB
-- PHP 版本： 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `selling_web`
--

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `product_num` int(11) NOT NULL DEFAULT 0,
  `product_img` text NOT NULL,
  `product_text` text NOT NULL,
  `product_label` text NOT NULL,
  `product_new_rate` int(11) NOT NULL,
  `product_info` text NOT NULL,
  `product_cost` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `product_postdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_num`, `product_img`, `product_text`, `product_label`, `product_new_rate`, `product_info`, `product_cost`, `seller_id`, `product_postdate`) VALUES
(1, '微積分', 10, 'https://i.imgur.com/OS3lebp.png', '牛逼了我的天', '', 4, '一杓三花淡奶，全是科技與很活', 200, 1, '2022-11-20 02:01:39');

-- --------------------------------------------------------

--
-- 資料表結構 `purchase`
--

CREATE TABLE `purchase` (
  `user_id` int(11) NOT NULL,
  `delivery` varchar(50) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `purchase_num` int(11) NOT NULL,
  `purchase_state` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_pwd_hash` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_pwd_hash`, `user_email`) VALUES
(1, 'henry', '$2y$10$334WyUJT6aDfs3rstQgh5.LfmStIb2PrftouC0WAAS1GtJZ/a8wN2', 'henry@gmail.com'),
(2, 'user1', '$2y$10$TU5qS7jK1/PDrq9Bri6Ep.3cEwr3nesU2PtxfEStRSKI6YdmFh44K', 'user1@gmail.com'),
(3, 'user', '$2y$10$hiwq1S43RhOPo7a.NcLzFOJ5AjuqCZm.ym3ITouvQccIItx8m.Awa', 'user@gmail.com'),
(7, 'user2', '$2y$10$83Gg1N8RMrfRgdvEppZJ4OroMoTsF0hQCdnHiS3AOASLfJO9PoGBC', 'user2@gmail.com');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
