-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-01-04 18:24:29
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
-- 資料表結構 `bidding`
--

CREATE TABLE `bidding` (
  `raise` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` int(11) DEFAULT NULL,
  `bid_length` datetime NOT NULL,
  `start_bidding` datetime NOT NULL DEFAULT current_timestamp(),
  `bidding_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `bidding`
--

INSERT INTO `bidding` (`raise`, `price`, `state`, `user_id`, `bid_length`, `start_bidding`, `bidding_id`, `product_id`) VALUES
(10, 120, 0, NULL, '2023-02-10 23:56:37', '2023-01-04 23:56:37', 2, 5),
(101, 200, 0, NULL, '2023-02-09 00:03:57', '2023-01-05 00:03:57', 3, 6),
(2, 230, 1, 14, '2023-01-10 01:23:34', '2023-01-05 01:23:34', 5, 8);

--
-- 觸發器 `bidding`
--
DELIMITER $$
CREATE TRIGGER `late_bidding` BEFORE UPDATE ON `bidding` FOR EACH ROW IF (OLD.state = '1') AND TIMEDIFF(OLD.`bid_length`, NOW())<= TIME_FORMAT('00:10:00', '%H:%i:%s') THEN
		SET NEW.bid_length = DATE_ADD(NOW(), INTERVAL 10 MINUTE),
        NEW.start_bidding = CURRENT_TIMESTAMP;
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 資料表結構 `chat`
--

CREATE TABLE `chat` (
  `user_id_from` int(11) NOT NULL,
  `user_id_to` int(11) NOT NULL,
  `chat_text` text NOT NULL,
  `chat_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `chat_id` int(11) NOT NULL,
  `already_read` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `chat`
--

INSERT INTO `chat` (`user_id_from`, `user_id_to`, `chat_text`, `chat_time`, `chat_id`, `already_read`) VALUES
(1, 2, '你媽死了', '2022-12-12 02:05:23', 1, 0),
(2, 1, '習近平小熊維尼', '2022-12-12 02:07:33', 2, 1),
(1, 2, '習包子傻逼', '2022-12-12 02:08:41', 3, 0),
(2, 1, '六四天安門', '2022-12-12 02:09:00', 4, 1),
(1, 2, '登入送坦克', '2022-12-12 02:09:51', 5, 0),
(7, 1, '哈囉', '2022-12-15 12:45:05', 6, 1),
(1, 7, '你好', '2022-12-15 12:46:07', 7, 0),
(1, 7, 'LOL', '2022-12-17 08:32:22', 8, 0),
(1, 2, 'NMSL', '2022-12-17 08:33:35', 9, 0),
(1, 2, '輸贏拉', '2022-12-17 08:34:12', 10, 0),
(1, 2, '烏干達手槍', '2022-12-17 08:35:23', 11, 0),
(1, 2, '斐濟盃 足球大賽', '2022-12-17 08:36:14', 12, 0),
(1, 2, '(燦笑', '2022-12-17 08:36:50', 13, 0);

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
(4, '手機', 1, 'https://i.imgur.com/OS3lebp.png', '手機', '3C', 2, '手機', 100, 8, '2022-12-03 10:34:05'),
(5, 'aAAAA', 1, '', 'aaaa', 'Book', 3, 'aaa', 120, 13, '2023-01-04 23:56:37'),
(6, 'aaa', 5, '', 'aaa', 'Book', 3, 'aa', 200, 13, '2023-01-05 00:03:57'),
(8, '2', 2, '', '2', 'Book', 2, '22', 222, 14, '2023-01-05 01:23:34');

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
(9, '', '', 2, 'InCart', 2, 3),
(1, '', '', 1, 'Ordering', 3, 11),
(1, '', '', 1, 'Ordering', 4, 12),
(1, '', '', 1, 'Ordering', 1, 13);

-- --------------------------------------------------------

--
-- 資料表結構 `test`
--

CREATE TABLE `test` (
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` date NOT NULL,
  `datetime` datetime NOT NULL,
  `time` time NOT NULL,
  `now_time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `test`
--

INSERT INTO `test` (`timestamp`, `date`, `datetime`, `time`, `now_time`) VALUES
('2022-12-13 10:20:25', '2022-12-13', '2022-12-12 11:20:02', '17:20:02', '18:27:57');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_pwd_hash` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `real_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `auth` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_pwd_hash`, `user_email`, `real_name`, `phone`, `auth`) VALUES
(1, 'henry', '$2y$10$334WyUJT6aDfs3rstQgh5.LfmStIb2PrftouC0WAAS1GtJZ/a8wN2', 'henry@gmail.com', '', '', 'OK'),
(2, 'user1', '$2y$10$TU5qS7jK1/PDrq9Bri6Ep.3cEwr3nesU2PtxfEStRSKI6YdmFh44K', 'user1@gmail.com', '', '', '0'),
(3, 'user', '$2y$10$hiwq1S43RhOPo7a.NcLzFOJ5AjuqCZm.ym3ITouvQccIItx8m.Awa', 'user@gmail.com', '', '', '0'),
(7, 'user2', '$2y$10$83Gg1N8RMrfRgdvEppZJ4OroMoTsF0hQCdnHiS3AOASLfJO9PoGBC', 'user2@gmail.com', '', '', '0'),
(8, 'user5', '$2y$10$TTRlENxkWkLf4U/70aCVwe3.Ohi2GgrvjapHWWlR0eLP5I.Fr9h3i', 'user5@gmail.com', '', '', '0'),
(9, 'user6', '$2y$10$YEiEGH0Fjs4zqmCMhRKN9uKQIBgwkbBG4lOuBlUeH0IZcEXw8luBS', 'user6@gmail.com', '', '', '0'),
(10, 'ss', '$2y$10$hv7FuQyeP1owfasontw35uGNAS6zCuz9thQ0Dn6aPG3DYGTyY7SRG', 'ss', '', '', '0'),
(11, 'user123', '$2y$10$4olrBWXQWmH8hbEsPe9vGeCiFd21n/usWGvtNf/0tVpcowfPb7Ki.', '123', '', '', '0'),
(12, 'Chen', '$2y$10$bO/bnVuufhUPdJISUT5G0.Go.qAPvcY8q35B2rWjdaHI5qVdgvi0.', '00957130@email.ntou.edu.tw', '陳', '0000000000', 'jt43bsevr4gyN1ouAk2nYwNslrRH9EVc'),
(13, 'joanna', '$2y$10$wn4tkyd6rbxP/mqv9Yzj2uHcILVvpgdWKOx43NnpYtI08i8g/t1iy', 'cherry09618822@gmail.com', '邱語芊', '0905288731', 'OK'),
(14, 'lin', '$2y$10$u7ybKroulQWFEjkOWu4IMuvZjuBf40NePS4UWe0OiM8mjsBV0IwIO', 'chengenl20@gmail.com', 'aa', 'aa', 'OK');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `bidding`
--
ALTER TABLE `bidding`
  ADD PRIMARY KEY (`bidding_id`),
  ADD KEY `product_id` (`product_id`);

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
-- 資料表索引 `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`date`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `bidding`
--
ALTER TABLE `bidding`
  MODIFY `bidding_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `bidding`
--
ALTER TABLE `bidding`
  ADD CONSTRAINT `bidding_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- 事件
--
CREATE DEFINER=`root`@`localhost` EVENT `check_bidding` ON SCHEDULE EVERY 1 SECOND STARTS '2022-12-15 00:16:21' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
        INSERT INTO `purchase`
        (user_id, product_id)
        select user_id, product_id
        FROM `bidding`
        where state = '1' AND TIMEDIFF(NOW(), bid_length) >= TIME_FORMAT('00:00:00', '%H:%i:%s');

        UPDATE `purchase` 
        SET purchase_num = '1', purchase_state = 'inCart' 
        WHERE purchase_num = 0 AND purchase_state = '';

        UPDATE `bidding` 
        SET state = 0 
        WHERE state = 1 AND TIMEDIFF(NOW(), bid_length) >= TIME_FORMAT('00:00:00', '%H:%i:%s');
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
