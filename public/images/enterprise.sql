-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 
-- 伺服器版本： 8.0.17
-- PHP 版本： 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `enterprise`
--

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL COMMENT '購物車編號',
  `p_id` int(11) NOT NULL COMMENT '產品編號',
  `id` int(11) NOT NULL COMMENT '會員編號',
  `number` int(11) NOT NULL COMMENT '選購數量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `cart`
--

INSERT INTO `cart` (`cart_id`, `p_id`, `id`, `number`) VALUES
(1, 1, 1, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `comment`
--

CREATE TABLE `comment` (
  `c_id` int(11) NOT NULL COMMENT '評論編號',
  `id` int(11) NOT NULL COMMENT '會員編號',
  `p_id` int(11) NOT NULL COMMENT '產品編號',
  `c_ment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '評論',
  `rate` int(1) NOT NULL COMMENT '評分'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `comment`
--

INSERT INTO `comment` (`c_id`, `id`, `p_id`, `c_ment`, `rate`) VALUES
(1, 2, 2, '', 5),
(4, 2, 2, '333', 4),
(5, 2, 2, '444', 3);

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL COMMENT '會員編號',
  `c_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '客戶信箱',
  `c_pword` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '密碼',
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '電話',
  `level` int(1) NOT NULL COMMENT '權限',
  `c_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT '客戶名字',
  `sex` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT '性別',
  `bd` date DEFAULT NULL COMMENT '生日',
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT '客戶圖片'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `customer`
--

INSERT INTO `customer` (`id`, `c_email`, `c_pword`, `phone`, `level`, `c_name`, `sex`, `bd`, `image`) VALUES
(0, '', '0000', '', 2, 'administrator', NULL, '0000-00-00', 'sujpg.jpg'),
(1, '1111@gmail.com', '1111', '0911112222', 1, '111', '女', '2021-12-02', 'G5PL8Ue.jpg'),
(2, '222', '222', '0922222222', 0, '222', '女', '2021-12-04', 'dog.jpg'),
(3, '333@gmail.com', '333', '0933333333', 0, '333', '女', '2021-12-15', '3.jpg'),
(4, '', 'wu', '0903410182', 0, 'wu', '男', NULL, NULL),
(5, '', '3a832052', '0912345678', 0, '3a832052', '女', NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `dindan`
--

CREATE TABLE `dindan` (
  `o_id` int(11) NOT NULL COMMENT '訂單編號',
  `id` int(11) NOT NULL COMMENT '會員編號',
  `p_id` int(11) NOT NULL COMMENT '產品編號',
  `ordernumber` int(11) NOT NULL COMMENT '訂購量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `dindan`
--

INSERT INTO `dindan` (`o_id`, `id`, `p_id`, `ordernumber`) VALUES
(1, 1, 4, 0),
(2, 1, 3, 0),
(3, 1, 3, 0),
(4, 1, 3, 0),
(5, 1, 3, 0),
(6, 1, 3, 0),
(7, 1, 3, 20),
(8, 1, 3, 0),
(9, 1, 3, 0),
(10, 1, 3, 0),
(11, 1, 0, 0),
(12, 1, 0, 0),
(13, 1, 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL COMMENT '會員編號',
  `h` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '歷史紀錄'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `history`
--

INSERT INTO `history` (`id`, `h`) VALUES
(1, '書');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL COMMENT '產品編號',
  `id` int(11) NOT NULL COMMENT '會員編號',
  `p_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '產品名稱',
  `p_des` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT '產品描述',
  `p_image` text NOT NULL COMMENT '產品圖片',
  `p_categ` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '產品類別',
  `price` int(11) NOT NULL COMMENT '產品價格',
  `p_quan` int(11) NOT NULL COMMENT '庫存量',
  `date` date NOT NULL COMMENT '商品上架日期',
  `frequency` int(11) NOT NULL COMMENT '被購買次數'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`p_id`, `id`, `p_name`, `p_des`, `p_image`, `p_categ`, `price`, `p_quan`, `date`, `frequency`) VALUES
(2, 1, '一度贊', 'aaa', '一度贊.png', '零食', 800, 20, '2021-12-27', 0),
(3, 1, '資料結構', '資料結構', '資料結構.png', '書', 1800, 20, '2021-12-27', 0),
(4, 1, '為什麼愛說謊', 'test', '為什麼愛說謊.png', '書', 1590, 20, '2021-12-29', 0),
(5, 1, '麥香', '麥dearfriend', '麥香.png', '零食', 54, 20, '2021-12-29', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `reply`
--

CREATE TABLE `reply` (
  `c_id` int(11) NOT NULL COMMENT '評論編號',
  `r_ply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '回覆內容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `reply`
--

INSERT INTO `reply` (`c_id`, `r_ply`) VALUES
(4, 'test'),
(4, 'test'),
(4, 'test'),
(4, 'test'),
(4, 'test'),
(4, 'test'),
(4, 'test'),
(4, 'test'),
(4, 'test'),
(4, 'test'),
(4, 'test'),
(4, 'test'),
(4, 'aaa'),
(4, 'aaa'),
(4, 'vbbb'),
(4, 'vbbb'),
(1, '1');

-- --------------------------------------------------------

--
-- 資料表結構 `seller`
--

CREATE TABLE `seller` (
  `id` int(11) NOT NULL COMMENT '會員編號',
  `s_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '賣家名字',
  `s_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '賣家地址',
  `s_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT '賣家照片'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `seller`
--

INSERT INTO `seller` (`id`, `s_name`, `s_address`, `s_image`) VALUES
(1, '111', '111', NULL);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart1_fk` (`p_id`),
  ADD KEY `cart2_fk` (`id`);

--
-- 資料表索引 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `c_fk` (`id`),
  ADD KEY `dp_fk` (`p_id`);

--
-- 資料表索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `dindan`
--
ALTER TABLE `dindan`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `dindana_fk` (`id`),
  ADD KEY `dp_fk` (`p_id`);

--
-- 資料表索引 `history`
--
ALTER TABLE `history`
  ADD KEY `hi_fk` (`id`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `pt_fk` (`id`);

--
-- 資料表索引 `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
