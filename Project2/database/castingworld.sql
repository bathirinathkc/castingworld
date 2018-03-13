

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `castingworld`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `sno` int(11) NOT NULL,
  `ausername` varchar(100) NOT NULL,
  `apwd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`sno`, `ausername`, `apwd`) VALUES
(8, 'sam', '$2y$10$/KBArrBRyBuDDxRDRFk/R.hSIvmrWoaWwztZdLhBwIme9hjvwHF7G'),
(9, 'admin', '$2y$10$04ebaL7R2lQ9ENWMoxPZE.XYm1OQVxwZxjSoi7Dcd9181ydwjM9SO'),
(10, 'what', '$2y$10$LzM6nNQK54TbE3uvgkrABOM89JfTKvk8eYGpXj47AZ4EIf0Y3gmQm');

-- --------------------------------------------------------

--
-- Table structure for table `auditiondetails`
--

CREATE TABLE `auditiondetails` (
  `scriptno` int(11) NOT NULL,
  `script` varchar(1000) NOT NULL,
  `auditiondate` date NOT NULL,
  `audition` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `age` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auditiondetails`
--

INSERT INTO `auditiondetails` (`scriptno`, `script`, `auditiondate`, `audition`, `category`, `age`, `id`) VALUES
(1, 'Have to save a child from pool', '2018-02-19', 'AVM studio, Chennai - 600018', 'Second Hero', '22 to 28', 1),
(2, 'Advice friend as sister', '2018-03-25', 'Jema Studio, Chennai - 600018', 'Support Heroiene', '18 to 20', 17),
(3, 'Jumping from 4 floor to ground', '2018-03-28', 'Bollyhood, Mumbai - 200001', 'Stunt hero', '24 to 35', 22),
(4, 'Dancing in sarrow', '2018-04-02', 'Nehru Park, Madurai -625019', 'Dancer', '18 to 28', 24),
(5, 'Have to fight with your friend', '2018-02-14', 'ABC Studio, Thircy - 345005', 'Junior Artist', '28 to 35', 25),
(6, 'Fight with your grilfriend', '2018-02-19', 'Bollyhood, Mumbai - 200001', 'Lover', '19 to 22', 26);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneno` varchar(12) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `sno` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`name`, `email`, `phoneno`, `comment`, `sno`, `time`) VALUES
('12', '1@gmail.com', '1', ' 1', 36, '2018-02-08 05:09:22'),
('bathirinath', 'bathirinath3@gmail.com', '2147483647', ' what to do ', 39, '2018-02-08 13:56:15'),
('bathiri', 'bathiri@gmail.com', '2147483647', ' dfs', 40, '2018-02-08 13:57:11'),
('bath123', 'bathiri@gmail.com', '9159369161', ' sadfa', 41, '2018-02-08 13:58:14'),
('shayam', 'shayamsundar@gmail.com', '9442326938', ' this is not nice', 42, '2018-02-13 04:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `count`
--

CREATE TABLE `count` (
  `id` int(11) NOT NULL,
  `uusername` varchar(100) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `txn_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_gross` float(10,2) NOT NULL,
  `currency_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uusername` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `txn_id`, `payment_gross`, `currency_code`, `payment_status`, `uusername`) VALUES
(16, '6AM19684ER553010N', 5.00, 'USD', 'Completed', 'nath'),
(17, '0NK507174Y161832V', 5.00, 'USD', 'Completed', 'padma'),
(18, '8TP88817VS3398928', 150.00, 'USD', 'Completed', 'anand'),
(19, '2LX87763VX117462H', 30.00, 'USD', 'Completed', 'bathirinath3@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `userdetail`
--

CREATE TABLE `userdetail` (
  `id` int(11) NOT NULL,
  `uusername` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `gen` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(300) NOT NULL,
  `category` varchar(11) NOT NULL,
  `experience` int(11) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `ppath` varchar(100) NOT NULL,
  `ptype` varchar(100) NOT NULL,
  `rname` varchar(100) NOT NULL,
  `rpath` varchar(100) NOT NULL,
  `rtype` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetail`
--

INSERT INTO `userdetail` (`id`, `uusername`, `fname`, `lname`, `dob`, `age`, `gen`, `email`, `phone`, `address`, `category`, `experience`, `pname`, `ppath`, `ptype`, `rname`, `rpath`, `rtype`) VALUES
(2, 'sam', 'Sam', 'Sam', '2012-12-12', 27, 'Male', 'samrockers@gmail.com', '9159369161', 'ECR road, chennai', 'actor', 2, 'face6.jpg', 'photo/face6.jpg', 'image/jpeg', 'prog1.html', 'resume/prog1.html', 'text/html'),
(3, 'nath', 'Nath', 'Nath', '1995-11-09', 22, 'Male', 'nath123@gmail.com', '9159916136', '101 - A/south veli street', 'Actor', 3, 'face4.jpg', 'photo/face4.jpg', 'image/jpeg', 'gallery.html', 'resume/gallery.html', 'text/html'),
(4, 'ram', 'Ram', 'Ram', '1995-12-09', 22, 'Male', 'ramkumar1234@gmail.com', '9442326987', 'bank rond chennai9', 'actor', 2, 'face3.jpg', 'photo/face3.jpg', 'image/jpeg', 'fourth.html', 'resume/fourth.html', 'text/html'),
(5, 'bathiri', 'Bathiri', 'Bathiri', '1995-11-02', 22, 'Male', 'bathirinath3@gmail.com', '9159369161', '101 - A/south veli street', 'actor', 3, 'face1.jpg', 'photo/face1.jpg', 'image/jpeg', '', 'resume/', ''),
(6, 'priya', 'Priya', 'Priya', '1994-11-05', 22, 'Female', 'priya@gmail.com', '9789636951', 'kamarajar salai, madurai - 525001', 'actress', 2, 'FB_IMG_1435375366885.jpg', 'photo/FB_IMG_1435375366885.jpg', 'image/jpeg', '', 'resume/', ''),
(7, 'padma', 'Padma', 'Padma', '1994-12-18', 23, 'Female', 'padma@gmail.com', '3698741259', 'kamarajar salai, madurai - 525001', 'actress', 3, 'ab.jpeg', 'photo/ab.jpeg', 'image/jpeg', 'Circuit_rx.PNG', 'resume/Circuit_rx.PNG', 'image/png'),
(8, 'Aravind', 'Aravindh', 'Aravindh', '1995-12-05', 22, 'Male', 'aravind@gmail.com', '9159369161', '101 - A/south veli street', 'actor', 3, '', 'photo/', '', 'FB_IMG_1435375366885.jpg', 'resume/FB_IMG_1435375366885.jpg', 'image/jpeg'),
(9, 'bathirinath3@gmail.com', 'bathiri', 'bathiri', '1995-11-09', 32, 'Male', 'bathirinath@gmail.com', '9159345432', '101 - A/south veli street', 'actor', 1, '', 'photo/', '', '', 'resume/', '');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `id` int(11) NOT NULL,
  `uusername` varchar(100) NOT NULL,
  `upwd` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`id`, `uusername`, `upwd`, `category`) VALUES
(9, 'nath', '$2y$10$xqjb43rE1JEPTZ8/u9amEu1DJ.FlbHNirutscFfZzDfGoEx0iqFNy', 'Free'),
(13, 'sam', '$2y$10$9ZLDJFjLX7pOVHwSoE263.ISmPSUGf59Hw3N8ntEyP2e/Ka/7nIxS', 'Subscribe'),
(14, 'ram', '$2y$10$42nSloTfJntJjyVFBMpaZOy9jGi/iuoFXGc0RkDklJO/g8Ro6pasq', 'Subscribe'),
(18, 'anand', '$2y$10$WWgigtgbjvMubXSZkLZA9Ob0rSUQxVL4naHsmGT/FycD6D6GeFNPa', 'Free'),
(19, 'priya', '$2y$10$z9CpzVlbDL/7s4wvwALaney0J17sVExOnhY7Oze9POOJ0bbMRHLqm', 'Free'),
(20, 'padma', '$2y$10$kdQG9.VMcmNYLN1ojsYKXO4rOwMWRn4sZAFx9FZtPct86QcnxkBgu', 'Subscribe'),
(21, 'bathiri', '$2y$10$Y.IrcnLOcW3J47ZGkkUF2urotN6PrMfs9kc0HKqEztCvyHo1CFb2u', 'Free'),
(24, 'bathirinath', '$2y$10$7CKiIY6tXbGHsv4c/snbce9TTpNBVZjtBklMEXyxCj8SuHdAz1ulu', 'Subscribe'),
(26, 'kumar', '$2y$10$7K5wT3yuZGCkapl86yiRNuTqKWOLRsOcHarJ5Abp7JHTx2pA8z7w.', 'Free'),
(27, 'shaym', '$2y$10$isz.v/HI/JCvNLQYnpW4Ge1ggndqktU3AOt.cRWMW5QxBoyRBwYde', 'Subscribe'),
(28, 'dfg', '$2y$10$E7DoWHwu2tqMxLrENy2laOa5e1wY6dH0cFDtiWtegvb5xir9BiIsW', 'Subscribe'),
(29, 'Aravind', '$2y$10$/Bqvw/SrzifxOxNPQVRJxesTr3J/uReWs4b7A.kHjG0mWggS4JeYy', 'Free'),
(30, 'bathirinath3@gmail.com', '$2y$10$wIMQ4rjGugSlwGJ0XOa91elgVHjriLCoByPWxLbbpfjiCcYt3ZFA6', 'Free');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `auditiondetails`
--
ALTER TABLE `auditiondetails`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `count`
--
ALTER TABLE `count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `userdetail`
--
ALTER TABLE `userdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `auditiondetails`
--
ALTER TABLE `auditiondetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `count`
--
ALTER TABLE `count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `userdetail`
--
ALTER TABLE `userdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
