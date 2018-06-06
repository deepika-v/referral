-- --------------------------------------------------------

--
-- Table structure for table `ref_emaillog`
--

CREATE TABLE `ref_emaillog` (
  `EmailLogID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `SentOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SentBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ref_referals`
--

CREATE TABLE `ref_referals` (
  `referalID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `MobileNo` varchar(20) DEFAULT NULL,
  `EmailId` varchar(255) DEFAULT NULL,
  `UnvId` int(11) DEFAULT NULL,
  `ReferalCode` varchar(10) DEFAULT NULL,
  `Status` char(10) DEFAULT 'R' COMMENT '''P'' for ''Pending'', ''C'' for ''Claim'',''A'' for ''Approved'', ''R'' for ''Referred''''',
  `EnquiryId` int(11) DEFAULT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedOn` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_referals`
--

INSERT INTO `ref_referals` (`referalID`, `UserID`, `FirstName`, `LastName`, `MobileNo`, `EmailId`, `UnvId`, `ReferalCode`, `Status`, `EnquiryId`, `CreatedOn`, `CreatedBy`, `ModifiedOn`, `ModifiedBy`) VALUES
(15, 1, 'smriti', 'gupta', '9930931676', 'smriti.gupta@gmail.com', 11, NULL, 'C', 139594, '2016-08-04 16:50:14', 1, NULL, NULL),
(23, 1, 'pratik', 'thakur', '9172763649', 'pratik.thakur@schoolguru.net', 11, NULL, 'R', 139643, '2016-08-09 12:51:21', 1, NULL, NULL),
(24, 1, 'Mayur ', 'Thakur', '1236547889', 'mayur.thakur@schoolguru.net', 11, NULL, 'R', 139644, '2016-08-09 13:00:18', 1, NULL, NULL),
(25, 1, 'Sumit', 'Nayak', '9632566666', 'sumit.nayak@schoolguru.net', 11, NULL, 'R', 139645, '2016-08-09 12:57:41', 1, NULL, NULL),
(26, 1, 'Sudesh', 'Gupta', '9833743274', 'sudesh.gupta@schoolguru.net', 11, NULL, 'R', 139647, '2016-08-09 13:02:27', 1, NULL, NULL),
(30, 1, 'Rohit', 'T', '9833743179', 'rohit.thorse@schoolguru.net', 11, NULL, 'R', 139654, '2016-08-09 13:44:08', 1, NULL, NULL),
(113, 1, 'Rozina', 'Nakhwa', '9004567891', 'rozina.nakhwa@schoolguru.net', 11, 'NED4N1', 'R', 139698, '2016-08-18 11:09:46', 1, NULL, NULL),
(114, 1, 'Deepika', 'V', '9004512345', 'deepika.vinchurkar@gmail.com', 11, 'F86AF0', 'R', NULL, '2016-08-18 11:09:53', 1, NULL, NULL),
(116, 1, 'rozi', 'y', '9004512346', 'rozinanakhwa@schoolguru.net', 11, 'NED4N2', 'R', 139699, '2016-08-18 11:09:53', NULL, NULL, NULL),
(117, 1, 'r', 'n', '9004512348', 'rozinakhwa@schoolguru.net', 11, 'NED4N3', 'R', 139700, '2016-08-18 11:09:53', 1, NULL, NULL),
(118, 1, 'Sumit', 'Nayak', '9892912600', 'nayak.sumit31@gmail.com', 11, 'JA7W02', 'R', NULL, '2016-08-19 10:47:11', 1, NULL, NULL),
(119, 1, 'lmn', 'opr', '9967970903', 'lmn@gmail.com', 11, 'NED4NJ', 'R', 139701, '2016-08-19 10:47:11', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_registereduser`
--

CREATE TABLE `ref_registereduser` (
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `MobileNo` varchar(15) DEFAULT NULL,
  `EmailID` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Address` mediumtext,
  `StateID` int(11) DEFAULT NULL,
  `CityID` int(11) DEFAULT NULL,
  `PinCode` int(10) DEFAULT NULL,
  `OTP` int(11) DEFAULT NULL,
  `IsOTPVerified` tinyint(4) DEFAULT NULL,
  `AltMobileNo` varchar(15) DEFAULT NULL,
  `AltEmailID` varchar(255) DEFAULT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedOn` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `Status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_registereduser`
--

INSERT INTO `ref_registereduser` (`UserID`, `FirstName`, `LastName`, `MobileNo`, `EmailID`, `Password`, `Address`, `StateID`, `CityID`, `PinCode`, `OTP`, `IsOTPVerified`, `AltMobileNo`, `AltEmailID`, `CreatedOn`, `CreatedBy`, `ModifiedOn`, `ModifiedBy`, `Status`) VALUES
(1, 'Deepika', 'V', '9123456789', 'deepika.vinchurkar@schoolguru.net', '098f6bcd4621d373cade4e832627b4f6', NULL, NULL, NULL, NULL, 1234, 1, NULL, NULL, '2016-08-02 12:55:58', NULL, NULL, NULL, NULL),
(18, 'test', 'users', '9012345678', 'testusers@gmail.com', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-08-02 18:28:07', NULL, NULL, NULL, 0),
(41, 'Chetana ', 'Fegade', '9561506164', 'chetana.fegade2013@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'Test Address', 3, 875, 400088, 745680, 1, '956150616', '', '2016-08-09 15:26:39', NULL, NULL, NULL, NULL),
(43, 'Demo', 'user', '8912345670', 'deepika.vinchurkar@gmail.com', '5d9c68c6c50ed3d02a2fcf54f63993b6', 'Test Address', 3, 875, 400088, 745680, 1, '956150616', '', '2016-08-09 15:26:39', NULL, '2016-08-19 11:02:31', NULL, NULL),
(48, 'Pratik', 'Thakur', '9172763649', 'pratik.thakur@schoolguru.net', '21232f297a57a5a743894a0e4a801fc3', 'this is for test', 8, 280, 0, 763294, 0, '', '', '2016-08-16 15:13:31', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_request_redemption`
--

CREATE TABLE `ref_request_redemption` (
  `RequestID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `RequestedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_request_redemption`
--

INSERT INTO `ref_request_redemption` (`RequestID`, `UserID`, `Amount`, `RequestedOn`) VALUES
(1, 1, 500, '2016-08-10 11:21:07'),
(2, 1, 500, '2016-08-10 11:25:54'),
(3, 1, 500, '2016-08-10 11:29:44'),
(4, 1, 500, '2016-08-10 11:33:08'),
(5, 41, 500, '2016-08-10 14:50:20'),
(6, 41, 500, '2016-08-10 15:04:57'),
(7, 41, 500, '2016-08-10 15:29:31'),
(8, 1, 500, '2016-08-12 12:01:40'),
(9, 1, 500, '2016-08-12 12:02:21');

-- --------------------------------------------------------

--
-- Table structure for table `ref_schema`
--

CREATE TABLE `ref_schema` (
  `SchemaID` int(11) NOT NULL,
  `UnvId` tinyint(4) DEFAULT NULL,
  `WEF` datetime DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedOn` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ref_emaillog`
--
ALTER TABLE `ref_emaillog`
  ADD PRIMARY KEY (`EmailLogID`),
  ADD KEY `EmailLogID` (`EmailLogID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `SentOn` (`SentOn`);

--
-- Indexes for table `ref_referals`
--
ALTER TABLE `ref_referals`
  ADD PRIMARY KEY (`referalID`),
  ADD KEY `referalID` (`referalID`),
  ADD KEY `EnquiryId` (`EnquiryId`),
  ADD KEY `CreatedOn` (`CreatedOn`),
  ADD KEY `CreatedBy` (`CreatedBy`),
  ADD KEY `ModifiedOn` (`ModifiedOn`),
  ADD KEY `ModifiedBy` (`ModifiedBy`),
  ADD KEY `referalID_2` (`referalID`);

--
-- Indexes for table `ref_registereduser`
--
ALTER TABLE `ref_registereduser`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `MobileNo_2` (`MobileNo`),
  ADD KEY `FirstName` (`FirstName`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `LastName` (`LastName`),
  ADD KEY `MobileNo` (`MobileNo`),
  ADD KEY `EmailID` (`EmailID`),
  ADD KEY `StateID` (`StateID`),
  ADD KEY `CityID` (`CityID`),
  ADD KEY `PinCode` (`PinCode`),
  ADD KEY `AltMobileNo` (`AltMobileNo`),
  ADD KEY `AltEmailID` (`AltEmailID`);

--
-- Indexes for table `ref_request_redemption`
--
ALTER TABLE `ref_request_redemption`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `RequestID` (`RequestID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `RequestedOn` (`RequestedOn`);

--
-- Indexes for table `ref_schema`
--
ALTER TABLE `ref_schema`
  ADD PRIMARY KEY (`SchemaID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ref_emaillog`
--
ALTER TABLE `ref_emaillog`
  MODIFY `EmailLogID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref_referals`
--
ALTER TABLE `ref_referals`
  MODIFY `referalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
--
-- AUTO_INCREMENT for table `ref_registereduser`
--
ALTER TABLE `ref_registereduser`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `ref_request_redemption`
--
ALTER TABLE `ref_request_redemption`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ref_schema`
--
ALTER TABLE `ref_schema`
  MODIFY `SchemaID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ref_request_redemption`
--
ALTER TABLE `ref_request_redemption`
  ADD CONSTRAINT `ref_request_redemption_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `ref_registereduser` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;