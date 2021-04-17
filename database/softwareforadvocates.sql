-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2021 at 01:11 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `softwareforadvocates`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `ID` int(20) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `mobno` varchar(10) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`ID`, `cname`, `mobno`, `date`, `time`, `subject`, `status`) VALUES
(1, 'Meena Tarun Khurana', '9833648990', '2021-05-01', '12:45', 'Progress of mortgage deed', 'OPEN'),
(2, 'Darshan Rajesh Sharma', '9320411419', '2021-05-01', '12:45', 'Client consulting', 'POSTPONED'),
(3, 'Munir Javed Merchant', '9863276510', '2021-05-01', '12:45', 'Explanation of remedies available', 'CLOSED'),
(4, 'Krishnava Ranjit Shetty', '9956824387', '2021-05-01', '12:45', 'Terms of hypothecation deed', 'CANCELLED'),
(5, 'Anirudha Jayant Sen', '9973400893', '2021-05-01', '12:45', 'International Negotiation', 'POSTPONED'),
(6, 'Manjula Sawant Singh', '9870632660', '2021-04-20', '17:00', 'Rejoinder in the case', 'CANCELLED'),
(7, 'Aaron Jonathon Solomon', '9321574908', '2021-03-10', '21:15', 'Verify documents', 'OPEN'),
(8, 'Sharanya Nikhil Ranga', '9900456239', '2021-03-08', '10:00', 'Feedback of the newsletter', 'OPEN');

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `ID` int(20) NOT NULL,
  `clientname` varchar(50) NOT NULL,
  `clienttype` varchar(20) NOT NULL,
  `oppositionname` varchar(50) NOT NULL,
  `oppositionadvocate` varchar(20) NOT NULL,
  `casenumber` int(20) NOT NULL,
  `casetype` varchar(20) NOT NULL,
  `act` varchar(20) NOT NULL,
  `filingnumber` int(20) NOT NULL,
  `filingdate` date NOT NULL,
  `regno` int(20) NOT NULL,
  `regdate` date NOT NULL,
  `hearingdate` date NOT NULL,
  `cnrno` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `courtno` int(20) NOT NULL,
  `courttype` varchar(50) NOT NULL,
  `courtname` varchar(20) NOT NULL,
  `judgename` varchar(30) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `priority` varchar(15) NOT NULL,
  `prioritynumber` int(200) NOT NULL,
  `phyloc` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`ID`, `clientname`, `clienttype`, `oppositionname`, `oppositionadvocate`, `casenumber`, `casetype`, `act`, `filingnumber`, `filingdate`, `regno`, `regdate`, `hearingdate`, `cnrno`, `description`, `courtno`, `courttype`, `courtname`, `judgename`, `remarks`, `status`, `priority`, `prioritynumber`, `phyloc`) VALUES
(1, 'Darshan Rajesh Sharma', 'Petitioner', 'Maharashtra Electricity Regulatory Commission', 'Sudha Naik', 45, 'Appeal', 'Electricity Act, 200', 498, '2020-12-16', 69, '2020-11-11', '2021-04-09', 'TNCB0A1234562017', 'Kidnapping and Murder 13 year old child', 2, 'Appellate Tribunal for Electricity', 'Delhi', 'Colabawalla', 'Scheduled', 'ACTIVE TRIAL', 'HIGH PRIORITY', 1, ''),
(2, 'Krishnava Ranjit Shetty', 'Petitioner', 'Priyadarshini Limited', 'Mohan Tripathi', 99, 'Civil', 'Contracts Act, 1978', 769, '2020-11-17', 8009, '2021-01-14', '2021-04-28', 'MHCB0A1234562987', 'Praecipe', 9, 'High Court', 'Dindoshi', 'Pathak', 'Adjourned', 'FINAL HEARING', 'NORMAL', 2, ''),
(3, 'Anirudha Jayant Sen', 'Petitioner', 'Jayant Sen', 'Trupti Lathi', 1007, 'Divorce', 'Family & Marriage Ac', 897, '2020-10-21', 4589, '2020-11-04', '2021-01-13', 'DSCK0258921', 'Proceedings going on', 7, 'Family Court', 'Bandra', 'Sambre', 'Trial going on', 'CLOSED', 'LOW PRIORITY', 3, ''),
(4, 'Sharanya Nikhil Ranga', 'Petitioner', 'Nirmal Nagda', 'Khushi Mehta', 9563, 'Original', 'Indian Penal Code, 1', 8956, '2020-10-23', 8912, '2020-12-17', '2021-04-23', '7856', 'Molestation', 6, 'District Sessions Court', 'Vikhroli', 'Naidu', 'Ongoing', 'ACTIVE TRIAL', 'NORMAL', 2, ''),
(5, 'Manjula Sawant Singh', 'Petitioner', 'Pertinent Infrastructure Limited', 'Tanvi Nandu', 1977, 'Civil', 'The National Highway', 5638, '2020-10-05', 7853, '2020-12-15', '2021-01-14', 'TNHB0A1234562017', 'Unfinished road', 2, 'Civil Court', 'Andheri', 'Daruwalla', 'Hearing stage', 'CLOSED', 'NORMAL', 2, ''),
(6, 'Rohan Paresh Shukla', 'Petitioner', 'Hindustan Unilever Limited', 'Yash Shah', 7184, 'Original', 'Consumer Protection', 739, '2020-10-15', 648, '2020-11-27', '2021-04-27', 'TNFT0A1234562017', 'Dispute on Sanyo LCD Television', 5, 'District Consumer Dispute Redressal Forum', 'Mumbai Suburban', 'Subramaniam', 'Hearing going on', 'ACTIVE TRIAL', 'NORMAL', 2, ''),
(7, 'Karan Manoj Vaswani', 'petitioner', 'Nishtha Mehta & Associates', 'Nishtha Mehta', 879, 'Original', 'The Industrial Emplo', 5462, '2020-08-07', 55, '2021-02-25', '2021-03-26', 'FBBB0A1234752017', 'Hire and Fire Case', 6, 'Labor Court', 'Bandra', 'Vyas', 'Filed complaint', 'PRE-TRIAL', 'NORMAL', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `ID` int(20) NOT NULL,
  `oname` varchar(50) NOT NULL,
  `oemail` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobno` varchar(10) NOT NULL,
  `alternateno` varchar(10) DEFAULT NULL,
  `address` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`ID`, `oname`, `oemail`, `website`, `name`, `gender`, `email`, `mobno`, `alternateno`, `address`) VALUES
(3, 'DSK Legal', 'dsk@gmail.com', 'www.dsklegal.com', 'Darshan Rajesh Sharma', 'Male', 'darshan.s@gmail.com', '9320411419', '9321611619', 'Ghatkopar'),
(4, 'Khurana & Khurana- Advocates and IP Attorney', 'info@khuranaandkhurana.com', 'www.khuranaandkhurana.com', 'Meena Tarun Khurana', 'Female', 'meena.k@khuranaandkhurana.com', '9833648990', '9765382764', 'Goregaon'),
(5, 'MZM Legal', 'lawyers@mzmlegal.com', 'www.mzmlegal.com', 'Munir Javed Merchant', 'Male', 'mjmerchant@gmail.com', '9863276510', '9327639007', 'Nariman Point'),
(6, 'Argus Partners', 'contact@argusp.com', 'www.argus-p.com', 'Krishnava Ranjit Shetty', 'Male', 'krs@argusp.com', '9956824387', '9344278790', 'Malad'),
(7, 'Trilegal', 'www.trilegal.com', 'www.trilegal.com', 'Anirudha Jayant Sen', 'Female', 'ani273@gmail.com', '9973400893', '0222407910', 'Borivali'),
(8, 'Advaya Legal', 'contact@advayalegal.com', 'www.advayalegal.com', 'Sharanya Nikhil Ranga', 'Female', 'sharanyaranga@hotmail.com', '9900456239', '9821115639', 'Sion'),
(9, 'Solomon & Co.', 'solomonco@slmnco.in', 'www.solomonco.in', 'Aaron Jonathon Solomon', 'Male', 'aaron.solomon@slmnco.in', '9321574908', '9362887470', 'Dadar'),
(10, 'Phoenix Legal', 'mumbai@phoenixlegal.in', 'www.phoenixlegal.in', 'Manjula Sawant Singh', 'Female', 'mssingh@phoenixlegal.in', '9870632660', '1149830000', 'Mahalaxmi'),
(11, 'Parinam Law Associates', 'info@parinamlaw.com', 'www.parinamlaw.com', 'Rohan Paresh Shukla', 'Male', 'rohan@gmail.com', '9810062367', '9810400635', 'Byculla'),
(12, 'Prudentia Advisory LLP', 'info@prudentia.com', 'www.prudentiaadvisory.com', 'Karan Manoj Vaswani', 'Male', 'yash.hn@somaiya.edu', '9897276008', '9377709265', 'Colaba');

-- --------------------------------------------------------

--
-- Table structure for table `evidence`
--

CREATE TABLE `evidence` (
  `cid` int(100) NOT NULL,
  `files` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `ID` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `expense` int(10) NOT NULL,
  `date` varchar(10) NOT NULL,
  `note` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`ID`, `name`, `expense`, `date`, `note`) VALUES
(1, 'Green Legal Pages', 1000, '2021-02-10', '500 pages'),
(2, 'Mousepad', 500, '2021-02-01', '5 for office'),
(3, 'Zoom', 3500, '2021-02-28', 'Paid feature for longer calls'),
(4, 'Filing Appeal', 10000, '2021-01-20', 'Case No. 25'),
(5, 'Office Trademark', 15000, '2021-01-05', 'Renewed for 10 years'),
(6, 'Travel', 1000, '2021-02-26', 'Round trip from office to court'),
(7, 'Lunch', 300, '2021-01-28', 'Outside court'),
(8, 'Client Meeting', 1000, '2021-02-08', 'Coffee at Starbucks');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `ID` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` varchar(10) NOT NULL,
  `amount_paid` int(10) NOT NULL,
  `total_amount` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`ID`, `name`, `date`, `amount_paid`, `total_amount`) VALUES
(2, 'Darshan Rajesh Sharma', '2021-02-04', 5500, 10000),
(3, 'Meena Tarun Khurana', '2021-02-07', 1700, 4000),
(4, 'Krishnava Ranjit Shetty', '2021-01-14', 47900, 100000),
(5, 'Munir Javed Merchant', '2021-01-19', 12000, 95000),
(6, 'Sharanya Nikhil Ranga', '2021-01-08', 49000, 50000),
(7, 'Anirudha Jayant Sen', '2021-02-26', 900, 4000),
(8, 'Karan Manoj Vaswani', '2021-02-08', 40000, 77500),
(9, 'Manjula Sawant Singh', '2021-02-28', 11000, 11000);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `ID` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobno` varchar(10) NOT NULL,
  `alternateno` varchar(10) NOT NULL,
  `address` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`ID`, `username`, `gender`, `email`, `mobno`, `alternateno`, `address`) VALUES
(1, 'admin', 'Male', 'admin@admin.com', '', '', ''),
(3, 'Darshan Rajesh Sharm', 'Male', 'darshan.s@gmail.com', '9320411419', '9321611619', 'Ghatkopar'),
(4, 'Meena Tarun Khurana', 'Female', 'meena.k@khuranaandkhurana.com', '9833648990', '9765382764', 'Goregaon'),
(5, 'Munir Javed Merchant', 'Male', 'mjmerchant@gmail.com', '9863276510', '9327639007', 'Nariman Point'),
(6, 'Krishnava Ranjit She', 'Male', 'krs@argusp.com', '9956824387', '9344278790', 'Malad'),
(7, 'Anirudha Jayant Sen', 'Female', 'ani273@gmail.com', '9973400893', '0222407910', 'Borivali'),
(8, 'Sharanya Nikhil Rang', 'Female', 'sharanyaranga@hotmail.com', '9900456239', '9821115639', 'Sion'),
(9, 'Aaron Jonathon Solom', 'Male', 'aaron.solomon@slmnco.in', '9321574908', '9362887470', 'Dadar'),
(10, 'Manjula Sawant Singh', 'Female', 'mssingh@phoenixlegal.in', '9870632660', '1149830000', 'Mahalaxmi'),
(11, 'Rohan Paresh Shukla', 'Male', 'rohan@gmail.com', '9810062367', '9810400635', 'Byculla'),
(12, 'Karan Manoj Vaswani', 'Male', 'karanvaswani23@gmail.com', '9897276008', '9377709265', 'Colaba'),
(13, 'Apurva', '', 'apurvadoshi@gmail.com', '', '', ''),
(14, 'Mayur', '', 'mayur@gmail.com', '', '', ''),
(15, 'Nirmal', '', 'nirmalnagda@gmail.com', '', '', ''),
(16, 'Karan', '', 'kabarvalia@gmail.com', '', '', ''),
(18, 'Kinjal', '', 'kinjal86@gmail.com', '', '', ''),
(19, 'Rashi', '', 'rashivaidya@gmail.com', '', '', ''),
(20, 'Manan', '', 'manan15@yahoo.com', '', '', ''),
(21, 'Kashish', '', 'kasharora@gmail.com', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `ID` int(11) NOT NULL,
  `taskname` varchar(100) NOT NULL,
  `related` varchar(200) NOT NULL,
  `start` date NOT NULL,
  `deadline` date NOT NULL,
  `assto` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`ID`, `taskname`, `related`, `start`, `deadline`, `assto`, `status`) VALUES
(1, 'Draft mortgage deed', 'Meena Tarun Khurana', '2021-02-28', '2021-03-02', 'Apurva', 'COMPLETED'),
(2, 'File petition before', 'Darshan Rajesh Sharma', '2021-04-05', '2021-05-12', 'Mayur', 'ASSIGNED'),
(3, 'Draft a hypothecation deed', 'Krishnava Ranjit Shetty', '2021-03-03', '2021-04-30', 'Nirmal', 'IN-PROGRESS'),
(4, 'Send February newsletter', 'Sharanya Nikhil Ranga', '2021-02-28', '2021-03-01', 'Karan', 'COMPLETED'),
(5, 'Update file of Case', 'Manjula Sawant Singh', '2021-03-01', '2021-03-31', 'Kinjal', 'COMPLETED'),
(6, 'Send review petition', 'Karan Manoj Vaswani', '2021-04-16', '2021-04-30', 'Rashi', 'ASSIGNED'),
(7, 'Follow up for documents', 'Aaron Jonathon Solomon', '2021-03-30', '2021-04-19', 'Manan', 'IN-PROGRESS'),
(8, 'Conference call of Case No. 190', 'Rohan Paresh Shukla', '2021-04-17', '2021-05-30', 'Kashish', 'ASSIGNED');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(5) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@admin.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Admin'),
(3, 'darshan.s', 'darshan.s@gmail.com', '6de0069ad03389abc5635a4853803f7fe1451ac1', 'Client'),
(4, 'meena.k', 'meena.k@khuranaandkhurana', 'a1c0b3497404726c50d0ce219c6bf01b59166e98', 'Client'),
(5, 'mjmerchant', 'mjmerchant@gmail.com', 'b8c2f54a96acbb95edd2537685e0c3d08b6f915f', 'Client'),
(6, 'krs', 'krs@argusp.com', 'a408568d69a7ed623ef98638e024c4db4f393983', 'Client'),
(7, 'ani273', 'ani273@gmail.com', '3d552ffce6fbda6dcb5f953fb482863c44627d2f', 'Client'),
(8, 'sharanyaranga', 'sharanyaranga@hotmail.com', '661491ff48447f4ce0745d4670559dbfdea417fb', 'Client'),
(9, 'aaron.solomon', 'aaron.solomon@slmnco.in', '7551aa8b99745043c2b8c1c56df592caa9c90ad0', 'Client'),
(10, 'mssingh', 'mssingh@phoenixlegal.in', '6f13e6fbba3944b4c86790c5044203651ff39a1a', 'Client'),
(11, 'rohan', 'rohan@gmail.com', 'bad67475e631dacf3ecad6b1f015468d91fe0eba', 'Client'),
(12, 'karanvaswani23', 'karanvaswani23@gmail.com', '86045c5fd879aa4dfd42711719f7ce8440c965eb', 'Client'),
(13, 'Apurva', 'apurvadoshi@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Staff'),
(14, 'Mayur', 'mayur@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Staff'),
(15, 'Nirmal', 'nirmalnagda@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Staff'),
(16, 'Karan', 'kabarvalia@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Staff'),
(18, 'Kinjal', 'kinjal86@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Staff'),
(19, 'Rashi', 'rashivaidya@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Staff'),
(20, 'Manan', 'manan15@yahoo.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Staff'),
(21, 'Kashish', 'kasharora@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `evidence`
--
ALTER TABLE `evidence`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
