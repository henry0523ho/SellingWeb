-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-12-12 04:38:25
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
-- 資料表結構 `chat`
--

CREATE TABLE `chat` (
  `user_id_from` int(11) NOT NULL,
  `user_id_to` int(11) NOT NULL,
  `chat_text` text NOT NULL,
  `chat_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `chat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `chat`
--

INSERT INTO `chat` (`user_id_from`, `user_id_to`, `chat_text`, `chat_time`, `chat_id`) VALUES
(1, 2, '你媽死了', '2022-12-12 02:05:23', 1),
(2, 1, '習近平小熊維尼', '2022-12-12 02:07:53', 2),
(1, 2, '習包子傻逼', '2022-12-12 02:08:41', 3),
(2, 1, '六四天安門', '2022-12-12 02:09:08', 4),
(1, 2, '登入送坦克', '2022-12-12 02:09:51', 5);

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
(1, '微積分', 10, 'https://i.imgur.com/OS3lebp.png', '牛逼了我的天', 'BOOK', 4, '一杓三花淡奶，全是科技與很活', 200, 1, '2022-11-20 02:01:39'),
(3, 'NIKE T恤', 1, 'https://i.imgur.com/OS3lebp.png', '就是T恤', 'CLOTHES', 3, 'TTT', 300, 8, '2022-12-03 10:31:52'),
(4, '手機', 1, 'https://i.imgur.com/OS3lebp.png', '手機', '3C', 2, '手機', 100, 8, '2022-12-03 10:34:05');

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
  `product_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `purchase`
--

INSERT INTO `purchase` (`user_id`, `delivery`, `payment`, `purchase_num`, `purchase_state`, `product_id`, `purchase_id`) VALUES
(8, '', '', 2, 'InCart', 1, 1),
(8, '', '', 2, 'InCart', 2, 2),
(9, '', '', 2, 'InCart', 2, 3);

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
(7, 'user2', '$2y$10$83Gg1N8RMrfRgdvEppZJ4OroMoTsF0hQCdnHiS3AOASLfJO9PoGBC', 'user2@gmail.com'),
(8, 'user5', '$2y$10$TTRlENxkWkLf4U/70aCVwe3.Ohi2GgrvjapHWWlR0eLP5I.Fr9h3i', 'user5@gmail.com'),
(9, 'user6', '$2y$10$YEiEGH0Fjs4zqmCMhRKN9uKQIBgwkbBG4lOuBlUeH0IZcEXw8luBS', 'user6@gmail.com'),
(10, 'ss', '$2y$10$hv7FuQyeP1owfasontw35uGNAS6zCuz9thQ0Dn6aPG3DYGTyY7SRG', 'ss');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- 資料表索引 `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `user_id` (`user_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
