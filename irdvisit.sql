-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2026 at 12:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `irdvisit`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(20) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Designation` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Contact` varchar(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Passcode` varchar(50) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Name`, `Designation`, `Email`, `Contact`, `UserName`, `Passcode`, `Role`, `Status`) VALUES
(2, 'Sami Kabir', 'Programmer', '', '', 'sami.kabir', 'PhDLTUNobel1', '1', 1),
(3, 'Farhad Khan Pathan', 'Assistant Programmer', '', '', 'farhad.pathan', 'FPird1#', '', 0),
(4, 'Md. Moinul Alam', 'Assistant Programmer', '', '', 'moinul.alam', 'MAKUET07eee!ird2#', '', 0),
(5, 'Anando Kumar Biswas', 'Assistant Programmer', 'abku07@gmail.com', '01790012288', 'anando.biswas', 'Ab@12288', '1', 1),
(6, 'Visitor', 'Visitor', '', '', 'visitor', '123456', '4', 1),
(7, 'S.M. Abdul Kader', 'Deputy Secretary', '', '', 'sm.abdulkader', 'SMAKbuet93@admin20!', '', 0),
(8, 'Md. Shafiqur Rahman', 'Joint Secretary', '', '', 'shafiqur.rahman', 'srrueco@admin9@#', '', 0),
(9, 'Suraiya Pervin Shelley\r\n', 'Joint Secretary', '', '', 'sp.shelley', 'DULingui@admin18_#!', '', 0),
(10, 'Md. Abdul Gafur', 'Joint Secretary', '', '', 'abdul.gafur', 'DUeco@tax15*&%', '', 0),
(11, 'Nusrat Jahan Nisu', 'Senior Assistant Secretary', '', '', 'nusrat.jahan', 'BMCeco*30_admin*(%@', '', 0),
(12, 'Md. Ahsan Habib', 'Deputy Secretary', '', '', 'ahsan.habib', 'RUsoc#admin24_$*^', '', 0),
(13, 'Dipak Kumar Biswas', 'Deputy Secretary', '', '', 'prof.dipakkumar', 'DUAct&edu16_%$', '', 0),
(14, 'Md. Shameem Ahsan', 'Assistant Secretary', '', '', 'shameem.ahsan', 'JnUeco&ec#!', '', 0),
(15, 'Mohammad Nairuzzaman', 'Personal Secretary to Senior Secretary', '', '', 'm.nairuzzaman', 'JUeco@%25admin*$', '', 0),
(16, 'Kanai Lal Shil', 'Senior Assistant Secretary', '', '', 'kanai.lal', 'BMnu@53!%', '', 0),
(17, 'Md. Abdul Jabbar', 'Senior Assistant Secretary', '', '', 'abdul.jabbar', 'aj^%@#22263', '', 0),
(18, 'Muhammad Firoz Reza', 'Accounts Officer', '', '', 'firoz.reza', 'fzaIrdactfin$@', '', 0),
(19, 'Abu Hena Md. Rahmatul Muneem\r\n', 'Senior Secretary', '', '', 'sr_secy', 'srsecy@IrdMoF1', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `foreignvisit`
--

CREATE TABLE `foreignvisit` (
  `ID` int(20) NOT NULL,
  `ServiceID` varchar(20) NOT NULL,
  `Cadre` varchar(50) NOT NULL,
  `Office` varchar(20) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Designation` varchar(200) NOT NULL,
  `Grade` int(5) NOT NULL,
  `Workplace` varchar(200) NOT NULL,
  `DestinationCountry` varchar(80) NOT NULL,
  `FundingSource` varchar(200) NOT NULL,
  `Purpose` varchar(200) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `ActualArrival` date NOT NULL,
  `ActualDeparture` date NOT NULL,
  `Days` int(20) NOT NULL,
  `GO` varchar(1000) NOT NULL,
  `Uploader` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `foreignvisit`
--

INSERT INTO `foreignvisit` (`ID`, `ServiceID`, `Cadre`, `Office`, `Name`, `Designation`, `Grade`, `Workplace`, `DestinationCountry`, `FundingSource`, `Purpose`, `StartDate`, `EndDate`, `ActualArrival`, `ActualDeparture`, `Days`, `GO`, `Uploader`) VALUES
(28, '1232', 'Customs', '', 'Mofazzel Hossain', 'Assistant Commissioner', 0, 'CEV Dhaka-2', 'Saudi Arabia', 'Self', 'Ex-Bangladesh leave (tourism)', '2018-05-20', '2018-06-05', '0000-00-00', '0000-00-00', 17, 'MofazzelHossainAC.pdf', ''),
(48, '200423', 'Tax', 'NBR', 'Ayesha Siddiqua Shelley', 'Additional Commissioner of Taxes', 5, 'Tax Zone-11, Dhaka', 'United Kingdom', 'Self', 'EBL', '2021-11-01', '2021-11-30', '0000-00-00', '0000-00-00', 30, 'AyeshaSiddiquaShelley.pdf', ''),
(49, '000', 'Customs', 'NBR', 'Mohammad Rashedul Alam', 'Additional Commissioner', 4, 'Customs Commissionerate, Sylhet', 'India', 'Self', 'EBL', '2021-10-15', '2021-10-23', '0000-00-00', '0000-00-00', 9, 'MohammadRashedulAlam.pdf', ''),
(50, '000', 'Customs', 'NBR', 'Dr Nahida Faridy', 'Additional Commissioner', 4, 'Customs Commissionerate,Dhaka (E)', 'Canada', 'Self', 'EBL', '2021-12-11', '2022-01-09', '0000-00-00', '0000-00-00', 30, 'NahidaFaridy.pdf', ''),
(51, '000', 'Customs', 'NBR', 'Md Shahiduzzaman Sarkar', 'Second Secretary', 6, 'WCO Affairs', 'Turkey', 'Self', 'EBL', '2021-12-01', '2021-12-15', '0000-00-00', '0000-00-00', 15, 'MdShahiduzzamanSarkar.pdf', ''),
(52, '000', 'Customs', 'NBR', 'Md Shahiduzzaman Sarkar', 'Second Secretary', 6, 'WCO Affairs', 'Egypt', 'Self', 'EBL', '2021-12-01', '2021-12-15', '0000-00-00', '0000-00-00', 15, 'MdShahiduzzamanSarkar.pdf', ''),
(53, '200423', 'Tax', 'NBR', 'Md Shajidul Islam', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone, Narayanganj', 'United Kingdom', 'Self', 'EBL', '2021-10-11', '2021-11-12', '0000-00-00', '0000-00-00', 33, 'MdShajidulIslam.pdf', ''),
(54, '00', 'Customs', 'NBR', 'Mobara Khanam', 'Commissioner', 3, 'ICD, Komlapur, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2021-10-21', '2021-11-04', '2021-11-06', '2021-10-25', 15, 'MobaraKhanam.pdf', ''),
(56, '00', 'Customs', 'NBR', 'Md Abdul Baten', 'Assistant Commissioner', 9, 'Customs Commissionerate,Dhaka (E)', 'India', 'Self', 'EBL', '2021-09-25', '2021-10-09', '0000-00-00', '0000-00-00', 15, 'AbdulBaten.pdf', ''),
(57, '200428', 'Tax', 'NBR', 'Md. Abdul Bari', 'Deputy Commissioner of Taxes', 6, 'Large Taxpayer Unit (LTU), Dhaka', 'Bangladesh', 'Employer', 'Lien', '2021-10-03', '2023-10-02', '0000-00-00', '0000-00-00', 730, 'AbdulBari.pdf', ''),
(58, '00', 'Tax', 'NBR', 'Nusrat Hassan', 'Deputy Commissioner of Taxes', 6, 'Large Taxpayer Unit (LTU), Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2021-10-14', '2021-11-02', '0000-00-00', '0000-00-00', 20, 'NusratHasan.pdf', ''),
(59, '00', 'Tax', 'NBR', 'Mohidul Islam Chowdhury', 'Second Secretary', 6, 'Head Office, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2021-10-14', '2021-11-02', '0000-00-00', '0000-00-00', 20, 'MohidulIsam.pdf', ''),
(60, '00', 'Customs', 'NBR', 'Md. Ziaur Rahman Khan', 'Deputy Commissioner', 6, 'Head Office, Dhaka', 'United States of America', 'Self', 'Study Leave', '2021-08-06', '2022-08-05', '0000-00-00', '0000-00-00', 365, 'ZiaurRahman.pdf', ''),
(61, '00', 'Tax', 'NBR', 'Md. Azizul Haque', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-9, Dhaka', 'India', 'Self', 'EBL', '2021-09-12', '2021-10-01', '0000-00-00', '0000-00-00', 20, 'AzizulHaque.pdf', ''),
(62, '00', 'Non Cadre', 'NBR', 'Khandakar Lutfal Azam', 'Revenue Officer', 9, 'CEV Commissionerate, Rajshahi', 'United Kingdom', 'Self', 'EBL', '2021-08-23', '2021-09-21', '0000-00-00', '0000-00-00', 30, 'LutfalAzam.pdf', ''),
(63, '00', 'Tax', 'NBR', 'Nazmun Nahar', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-2, Chattogram', 'Japan', 'Project', 'Deputation', '2021-09-01', '2023-10-31', '0000-00-00', '0000-00-00', 791, 'NazmunNahar.pdf', ''),
(64, '00', 'Not Applicable', 'NBR', 'Fatima Begum', 'Assistant Revenue Officer', 10, 'Audit Intelligence (VAT), Dhaka', 'Germany', 'Others', 'Study Leave', '2021-08-15', '2023-08-14', '0000-00-00', '0000-00-00', 730, 'FatimaBegum.pdf', ''),
(65, '00', 'Customs', 'NBR', 'Abu Hanif Abdul Ahad', 'Second Secretary', 6, 'Head Office, Dhaka', 'United Kingdom', 'Others', 'Study Leave', '2021-09-01', '2022-08-31', '0000-00-00', '0000-00-00', 365, 'AbdulAhad.pdf', ''),
(66, '00', 'Customs', 'NBR', 'Sefat E Mariam', 'Joint Commissioner', 5, 'Head Office, Dhaka', 'United States of America', 'Others', 'Deputation', '2021-08-12', '2022-07-31', '0000-00-00', '0000-00-00', 354, 'Sefat-E-Mariam.pdf', ''),
(67, '200585', 'Tax', 'NBR', 'Raihan Mian', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone, Narayanganj', 'Germany', 'Others', 'Deputation', '2019-09-03', '2021-10-01', '0000-00-00', '0000-00-00', 760, 'RaihanMian.pdf', ''),
(68, '00', 'Tax', 'NBR', 'Shrabani Chakma', 'Additional Commissioner of Taxes', 4, 'Taxes Zone-13, Dhaka', 'United States of America', 'Self', 'EBL', '2021-08-13', '2021-08-31', '0000-00-00', '0000-00-00', 19, 'ShrabaniChakma.pdf', ''),
(69, '200364', 'Tax', 'NBR', 'Md. Mesbah Uddin Khan', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-8, Dhaka', 'United States of America', 'Project', 'Deputation', '2021-08-13', '2023-08-30', '0000-00-00', '0000-00-00', 748, 'MesbahUddin.pdf', ''),
(70, '200290', 'Tax', 'NBR', 'Md. Muinul Islam', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-13, Dhaka', 'Netherlands', 'Others', 'Study Leave', '2021-07-28', '2022-09-02', '0000-00-00', '0000-00-00', 402, 'MoinulIslam.pdf', ''),
(71, '200559', 'Tax', 'NBR', 'Naznin Akhter Nipa', 'Second Secretary', 6, 'Head Office, Dhaka', 'China', 'University', 'Deputation', '2021-08-20', '2024-08-15', '0000-00-00', '0000-00-00', 1092, 'NazninNipa.pdf', ''),
(72, '00', 'Not Applicable', 'IRD', 'H. M Mizanur Rahman', 'Administrative Officer', 10, 'Secretariat, Dhaka', 'Kuwait', 'Self', 'EBL', '2021-07-25', '2021-10-22', '0000-00-00', '0000-00-00', 90, 'MizanurRahman.pdf', ''),
(73, '00', 'Customs', 'NBR', 'Muhammad Kamrul Hassan', 'Deputy Director', 6, 'Duty Exemption Office', 'Bangladesh', 'Employer', 'Lien', '2021-05-15', '2022-05-14', '0000-00-00', '0000-00-00', 365, 'KamrulHassan.pdf', ''),
(74, '00', 'Tax', 'NBR', 'Iqtiaruddin Md Mamun', 'First Secretary', 5, 'Head Office, Dhaka', 'Bangladesh', 'Employer', 'Lien', '2020-05-11', '2022-05-10', '0000-00-00', '0000-00-00', 730, 'Md. Mamun.pdf', ''),
(75, '00', 'Customs', 'NBR', 'Amimul Ehsan Khan', 'First Secretary', 5, 'Head Office, Dhaka', 'Bangladesh', 'Employer', 'Lien', '2021-06-01', '2022-05-31', '0000-00-00', '0000-00-00', 365, 'AmimulKhan.pdf', ''),
(76, '00', 'Administration', 'NBR', 'Md. Faizur Rahman', 'Member', 2, 'Head Office, Dhaka', 'India', 'Self', 'EBL', '2020-11-09', '2020-11-30', '0000-00-00', '0000-00-00', 22, 'Mr. Md Faijur Rahaman, Add. S.pdf', ''),
(77, '00', 'Tax', 'NBR', 'Mahfuja Khanom', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-5, Dhaka', 'Ireland', 'Self', 'EBL', '2021-02-07', '2021-06-06', '0000-00-00', '0000-00-00', 120, 'GO of Mahfuza Khanom.pdf', ''),
(78, '00', 'Customs', 'NBR', 'Mia Md. Abu Obaida', 'First Secretary', 5, 'Head Office, Dhaka', 'United Arab Erimates', 'Self', 'EBL', '2021-02-20', '2021-02-26', '0000-00-00', '0000-00-00', 7, 'go of abu obayda.pdf', ''),
(79, '00', 'Tax', 'NBR', 'Naznin Akhter Nipa', 'Second Secretary', 6, 'Head Office, Dhaka', 'China', 'Self', 'EBL', '2021-03-06', '2021-04-27', '0000-00-00', '0000-00-00', 53, 'Tax-51.pdf', ''),
(80, '00', 'Tax', 'NBR', 'Nasnin Farhana', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-5, Dhaka', 'India', 'Self', 'EBL', '2021-03-16', '2021-06-13', '0000-00-00', '0000-00-00', 90, 'Tax-64.pdf', ''),
(81, '00', 'Non Cadre', 'NSD', 'Farhan Fattah', 'Assistant Director', 9, 'Jamalpur Office', 'India', 'Self', 'EBL', '2021-04-08', '2021-06-07', '0000-00-00', '0000-00-00', 61, '06-04-2021.pdf', ''),
(82, '00', 'Non Cadre', 'NSD', 'Mohammad Mohinul Islam', 'Deputy Director', 6, 'Head Office, Dhaka', 'India', 'Self', 'EBL', '2021-03-10', '2021-04-08', '0000-00-00', '0000-00-00', 30, 'Md. Mohinul Islam.pdf', ''),
(83, '00', 'Customs', 'NBR', 'Md. Salim Reza', 'Deputy Commissioner', 6, 'LTU (VAT), Dhaka', 'Japan', 'FS', 'Deputation', '2021-03-07', '2022-03-31', '0000-00-00', '0000-00-00', 390, 'salim reza go.pdf', ''),
(84, '00', 'Tax', 'NBR', 'Md. Khademul Islam Chowdhury', 'Chairman', 6, 'Taxes Zone-09, Dhaka', 'Bangladesh', 'Employer', 'Lien', '2021-05-20', '2022-05-22', '0000-00-00', '0000-00-00', 368, 'Tax-122 E.pdf', ''),
(85, '00', 'Non Cadre', 'NSD', 'Muhammad Mizanur Rahman', 'Deputy Director', 6, 'Head Office, Dhaka', 'Bangladesh', 'Employer', 'Lien', '2021-01-25', '2022-01-24', '0000-00-00', '0000-00-00', 365, 'GO of Md. Mizanur Rahman.pdf', ''),
(86, '00', 'Non Cadre', 'NBR', 'Mohammad Mofazzel Hossain', 'Assistant Director', 9, 'Duty & Drawback Office, Dhaka', 'Singapore', 'Self', 'EBL', '2021-10-28', '2021-11-26', '0000-00-00', '0000-00-00', 30, 'GO of Mohammad Moffazel Hossain.pdf', ''),
(87, '00', 'Customs', 'NBR', 'Mst.Sarmin Akter Mazumder', 'Deputy Director', 6, 'Customs Intelligence, Dhaka', 'United States of America', 'Others', 'Study Leave', '2021-08-13', '2023-08-12', '0000-00-00', '0000-00-00', 730, 'go sharmin.pdf', ''),
(88, '200311', 'Tax', 'NBR', 'Dulal Chandra Panday ', 'Joint Commissioner of Taxes', 5, 'Large Taxpayer Unit (LTU), Dhaka ', 'Bangladesh', 'Employer', 'Lien', '2021-10-26', '2022-10-25', '0000-00-00', '0000-00-00', 365, 'Dulal Chandra.pdf', ''),
(89, '00', 'Tax', 'NBR', 'Dr. Haripada Sarker', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-3, Dhaka ', 'India', 'Self', 'EBL', '2021-10-10', '2021-11-08', '0000-00-00', '0000-00-00', 30, 'HaripadaSarker.pdf', 'irdmof'),
(90, '200559', 'Tax', 'NBR', 'Naznin Akhter Nipa', 'Second Secretary', 6, 'National Board of Revenue, Dhaka', 'China', 'University', 'Study Leave', '2021-10-20', '2024-08-15', '0000-00-00', '0000-00-00', 1031, 'Naznin Akhter Nipa.pdf', 'anando.biswas'),
(91, '00', 'Tax', 'NBR', 'Romana Islam Sammi', 'Deputy Director', 6, 'BCS (Tax) Academy, Dhaka', 'India', 'Self', 'EBL', '2021-10-25', '2021-11-23', '0000-00-00', '0000-00-00', 30, 'Romana Islam Sammi.pdf', 'anando.biswas'),
(92, '00', 'Tax', 'NBR', 'Khandokar Khurshid Kamal', 'Additional Commissioner of Taxes', 3, 'Taxes Zone-13, Dhaka', 'Mauritius', 'Self', 'EBL', '2021-10-15', '2021-11-30', '0000-00-00', '0000-00-00', 47, 'Khandokar Khurshid Kamal.pdf', 'anando.biswas'),
(93, '200450', 'Tax', 'NBR', 'Md. Shafiul Islam', 'Deputy Commissioner', 6, 'Taxes zone Mymensingh', 'Bangladesh', 'GoB', 'Lien', '2021-10-28', '2022-10-27', '0000-00-00', '0000-00-00', 365, 'Md. Shafiul.pdf', 'anando.biswas'),
(94, '00', 'Non Cadre', 'NBR', 'Md. Hafizul Islam', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-7', 'Saudi Arabia', 'Self', 'EBL', '2021-12-16', '2021-12-25', '0000-00-00', '0000-00-00', 10, 'Md. Hafizul Islam.pdf', 'anando.biswas'),
(95, '00', 'Customs', 'CEVT', 'Miazi Shahidul Alam Chowdhur', 'Member', 3, 'CEVT, Dhaka', 'United States of America', 'Self', 'EBL', '2021-12-14', '2022-01-03', '0000-00-00', '0000-00-00', 21, 'Miazi Shahidul Alam.pdf', 'anando.biswas'),
(96, '00', 'Tax', 'NBR', 'Md. Mizanur Rahman', 'Joint Commissioner of Taxes', 5, 'Tax Zone, Narayangonj', 'India', 'Self', 'EBL', '2021-11-02', '2021-12-05', '0000-00-00', '0000-00-00', 34, 'Md. Mizanur Rahman.pdf', 'anando.biswas'),
(97, '300310', 'Customs', 'NBR', 'H.M. Ahsanul Kabir', 'Deputy Commissioner', 6, 'Custom House, Benapole, Jessore ', 'India', 'Self', 'EBL', '2021-11-14', '2021-11-28', '0000-00-00', '0000-00-00', 15, 'H.M. Ahsanul Kabir.pdf', 'anando.biswas'),
(98, '300244', 'Customs', 'NBR', 'Rukba Iffat', 'Deputy Commissioner', 6, 'Customs Bond Commissionerate', 'Germany', 'Self', 'EBL', '2021-11-19', '2021-12-03', '0000-00-00', '0000-00-00', 15, 'Rukba Iffat.pdf', 'anando.biswas'),
(99, '200597', 'Tax', 'NBR', 'Runa Akhter', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-10, Dhaka ', 'India', 'Self', 'EBL', '2021-11-12', '2022-02-11', '0000-00-00', '0000-00-00', 92, 'Runa Akhter.pdf', 'anando.biswas'),
(100, '200231', 'Tax', 'NBR', 'Anjan kumar saha', 'Additional Commissioner of Taxes', 4, 'Taxes Zone-Khulna', 'Australia', 'Self', 'EBL', '2021-12-19', '2022-01-17', '0000-00-00', '0000-00-00', 30, 'Anjan kumar saha.pdf', 'anando.biswas'),
(101, '300084', 'Customs', 'NBR', 'Md. Zakir Hossain', 'Commissioner', 4, 'CEV (Appeal), Khulna', 'Saudi Arabia', 'Self', 'EBL', '2021-11-16', '2021-11-30', '0000-00-00', '0000-00-00', 15, 'GO of Md. Zakir Hossain.pdf', 'moinul.alam'),
(102, '00', 'Tax', 'NBR', 'Mr. Mohammad Masum Billah', 'Joint Commissioner of Taxes', 5, ' Taxes Zone, Bogura ', 'Singapore', 'Self', 'EBL', '2020-01-16', '2020-01-30', '0000-00-00', '0000-00-00', 15, 'Mr. Mohammad.pdf', 'anando.biswas'),
(103, '00', 'Tax', 'NBR', 'Mr. Iqtiaruddin Md. Mamun', 'First Secretary', 5, 'National Board of Revenue, Dhaka', 'Japan', 'IO', 'Official Trip', '2020-02-17', '2020-02-21', '0000-00-00', '0000-00-00', 5, 'Mr. Iqtiaruddin.pdf', 'anando.biswas'),
(104, '300294', 'Customs', 'NBR', 'Dipa Rani Halder', 'Assistant Commissioner', 9, 'CEVT, Dhaka(West)', 'India', 'Self', 'EBL', '2021-11-16', '2021-12-15', '0000-00-00', '0000-00-00', 30, 'Dipa Rani Halder.pdf', 'anando.biswas'),
(105, '00', 'Customs', 'NBR', 'Dr.Mohammad Tazul Islam', 'Assistant Commissioner', 4, 'Customs Bond Commissionerate', 'Singapore', 'Self', 'EBL', '2020-01-15', '2020-01-19', '0000-00-00', '0000-00-00', 5, 'Tazul Islam.pdf', 'anando.biswas'),
(106, '00', 'Customs', 'NBR', 'Mohammad Neazur Rahman', 'Additional Director General', 4, 'Customs Intelligence, Dhaka', 'United Kingdom', 'Self', 'Others', '2020-02-02', '2020-02-11', '0000-00-00', '0000-00-00', 10, 'Neazur Rahman.pdf', 'anando.biswas'),
(107, '00', 'Administration', 'NBR', 'Samarjit Das', 'Assistant Project Director', 4, 'National Board of Revenue, Dhaka', 'India', 'Self', 'EBL', '2019-12-15', '2019-12-29', '0000-00-00', '0000-00-00', 15, 'Samarjit Das.pdf', 'anando.biswas'),
(108, '00', 'Customs', 'NBR', ' K M Wahidul Alam', 'Member', 0, 'CEVT, Dhaka', 'India', 'Self', 'EBL', '2020-01-15', '2020-02-14', '0000-00-00', '0000-00-00', 31, 'K M Wahidul Alam.pdf', 'anando.biswas'),
(109, '00', 'Customs', 'NBR', 'Md. Salim Reza', 'Deputy Commissioner', 6, 'Mongla Customs House, Khulna', 'India', 'Self', 'EBL', '2020-02-12', '2020-02-26', '0000-00-00', '0000-00-00', 15, 'Md. Salim Reza.pdf', 'anando.biswas'),
(110, '00', 'Customs', 'NBR', 'Md. Jamal Hossain', 'Member', 3, 'National Board of Revenue. Dhaka.', 'Vietnam', 'Project', 'Official Trip', '2020-01-16', '2020-01-22', '0000-00-00', '0000-00-00', 7, 'Md. Jamal Hossain.pdf', 'anando.biswas'),
(111, '00', 'Customs', 'NBR', 'Mohammad Akbar Hossain', 'Additional Commissioner', 4, 'Custom House, Chattogram', 'Vietnam', 'GoB', 'Official Trip', '2020-01-16', '2020-01-22', '0000-00-00', '0000-00-00', 7, 'Mohammad Akbar Hossain.pdf', 'anando.biswas'),
(112, '00', 'Administration', 'NBR', 'Md Tofayel Ahmed', 'Joint Commissioner', 5, 'Customs Bond C. Chattogram', 'Vietnam', 'Project', 'Official Trip', '2020-01-16', '2020-01-22', '0000-00-00', '0000-00-00', 7, 'Md Tofayel Ahmed.pdf', 'anando.biswas'),
(113, '00', 'Non Cadre', 'NBR', 'Md Golam Mostafa ', 'Sustem Anlist', 5, 'National Board of Revenue, Dhaka', 'Vietnam', 'Project', 'Official Trip', '2020-01-16', '2020-01-22', '0000-00-00', '0000-00-00', 7, 'Md Golam Mostafa.pdf', 'anando.biswas'),
(114, '00', 'Customs', 'NBR', 'Farida Yasmin ', 'Second Secretary', 6, 'National Board of Revenue, Dhaka', 'Vietnam', 'Project', 'Official Trip', '2020-01-16', '2020-01-22', '0000-00-00', '0000-00-00', 7, 'Farida Yasmin.pdf', 'anando.biswas'),
(115, '00', 'Customs', 'NBR', 'Mohammad Sydul Islam', 'Register', 0, 'CEVT,Dhaka', 'Vietnam', 'Project', 'Official Trip', '2020-01-16', '2020-01-22', '0000-00-00', '0000-00-00', 7, 'Mohammad Sydul Islam.pdf', 'anando.biswas'),
(116, '00', 'Customs', 'NBR', 'Mohammad Sharfuddin Miah', 'Deputy Project Director', 0, 'National Board of Revenue, Dhaka', 'Vietnam', 'Project', 'Official Trip', '2020-01-16', '2020-01-22', '0000-00-00', '0000-00-00', 7, 'Mohammad Sharfuddin Miah.pdf', 'anando.biswas'),
(117, '00', 'Non Cadre', 'NBR', 'Khandokar Shahidul Alam', 'Account officer', 9, 'National Board of Revenue, Dhaka', 'Vietnam', 'Project', 'Official Trip', '2020-01-16', '2020-01-22', '0000-00-00', '0000-00-00', 7, 'Khandokar Shahidul Alam.pdf', 'anando.biswas'),
(118, '00', 'Non Cadre', 'IRD', 'H.M Mizanur Rahman', 'Administrative Officer', 10, 'Internal Resources Division', 'Vietnam', 'Project', 'Official Trip', '2020-01-16', '2020-01-22', '0000-00-00', '0000-00-00', 7, 'H.M Mizanur Rahman.pdf', 'anando.biswas'),
(119, '00', 'Non Cadre', 'NBR', 'Mohammad Jakir Hossain', 'Assistant Revenue Officer', 10, 'Custom House, Dhaka', 'Vietnam', 'Project', 'Official Trip', '2020-01-16', '2020-01-22', '0000-00-00', '0000-00-00', 7, 'Mohammad Jakir Hossain.pdf', 'anando.biswas'),
(120, '00', 'Non Cadre', 'NBR', 'Mithun Kumar Malaker', 'Administrative Officer', 10, 'National Board of Revenue, Dhaka', 'Vietnam', 'Project', 'Official Trip', '2020-01-16', '2020-01-22', '0000-00-00', '0000-00-00', 7, 'Mithun Kumar Malaker.pdf', 'anando.biswas'),
(121, '00', 'Customs', 'NBR', 'Surash Chandra Biswas', 'Commissioner', 3, 'Mongla Custom House, Khulna', 'Canada', 'Self', 'Others', '2020-02-02', '2020-02-11', '0000-00-00', '0000-00-00', 10, 'Surash Chandra Biswas.pdf', 'anando.biswas'),
(122, '00', 'Customs', 'NBR', 'Sabrina Amin', 'Assistant Commissioner', 9, 'CEVT, Dhaka(East)', 'Thailand', 'Self', 'EBL', '2020-01-20', '2020-01-30', '0000-00-00', '0000-00-00', 11, 'Sabrina Amin.pdf', 'anando.biswas'),
(123, '00', 'Tax', 'NBR', 'Mr. Md. Masudur Rahma', 'Joint Commissioner', 5, ' Taxes Zone-7, Dhaka', 'Australia', 'Self', 'EBL', '2020-03-12', '2020-03-26', '0000-00-00', '0000-00-00', 15, 'Masudur Rahman.pdf', 'anando.biswas'),
(124, '00', 'Tax', 'NBR', 'Mr. Md. Rashedul Hasan', 'Deputy Commissioner', 6, 'Taxes Zone-1, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2020-01-23', '2020-02-26', '0000-00-00', '0000-00-00', 35, 'Mr. Md. Rashedul Hasan.pdf', 'anando.biswas'),
(125, '00', 'Tax', 'NBR', 'Mr.Md. Ali Asgar', 'Commissioner', 3, 'Taxes Zone-Gazipur', 'Saudi Arabia', 'Self', 'EBL', '2020-01-09', '2020-01-18', '0000-00-00', '0000-00-00', 10, 'Mr.Md. Ali Asga.pdf', 'anando.biswas'),
(126, '00', 'Tax', 'NBR', 'Md. Saiduzzaman Bhuiyan', 'Joint Commissioner of Taxes', 5, 'Taxes zone 15, Dhaka', 'Australia', 'Self', 'EBL', '2020-03-11', '2020-03-25', '0000-00-00', '0000-00-00', 15, 'saiduzzaman Bhuiyan.pdf', 'anando.biswas'),
(127, '00', 'Non Cadre', 'NBR', 'Md Abdul Mannan Talukder', 'Revenue Officer', 9, 'CEVT, Dhaka(East)', 'Saudi Arabia', 'Self', 'EBL', '2019-12-25', '2020-01-03', '0000-00-00', '0000-00-00', 10, 'Md Abdul Mannan Talukder.pdf', 'anando.biswas'),
(128, '00', 'Customs', 'NBR', 'Nitish Biswas', 'Joint Commissioner', 6, 'Custom House, Chattogram', 'United States of America', 'University', 'Official Trip', '2020-03-01', '2020-03-01', '0000-00-00', '0000-00-00', 1, 'Nitish Biswas.pdf', 'anando.biswas'),
(129, '00', 'Customs', 'NBR', 'Rquibul Hassan', 'Second Secretary', 6, 'National Board of Revenue, Dhaka', 'United States of America', 'University', 'Official Trip', '2020-03-01', '2020-03-15', '0000-00-00', '0000-00-00', 15, 'Rquibul Hassan.pdf', 'anando.biswas'),
(130, '00', 'Customs', 'NBR', 'Rafia Sultana', 'Deputy Commissioner', 6, 'Custom House, ICD', 'Singapore', 'Self', 'EBL', '2020-01-06', '2020-01-12', '0000-00-00', '0000-00-00', 7, 'Rafia Sultana.pdf', 'anando.biswas'),
(131, '00', 'Customs', 'NBR', 'Md Belal Hossain Chowdhury', 'Commissioner', 3, 'Custom House, Benapole', 'United States of America', 'Self', 'Others', '2020-01-02', '2020-01-11', '0000-00-00', '0000-00-00', 10, 'Mohammad Belal Hossain Chowdhury.pdf', 'anando.biswas'),
(132, '00', 'Tax', 'NBR', 'Md. Hafiz Al Asad', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-11 Dhaka', 'United States of America', 'University', 'Official Trip', '2020-03-01', '2020-03-15', '0000-00-00', '0000-00-00', 15, 'Md. Hafiz Al Asad.pdf', 'anando.biswas'),
(133, '00', 'Tax', 'NBR', 'Mohammad Naimur Rasul', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-9 Dhaka', 'United States of America', 'University', 'Official Trip', '2020-03-01', '2020-03-15', '0000-00-00', '0000-00-00', 15, 'Mohammad Naimur Rasul.pdf', 'anando.biswas'),
(134, '00', 'Tax', 'NBR', 'Mohammad Amirul Karim Munshi', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-01 Dhaka', 'United States of America', 'University', 'Official Trip', '2020-03-01', '2020-03-15', '0000-00-00', '0000-00-00', 15, 'Mohammad Amirul Karim Munshi.pdf', 'anando.biswas'),
(135, '00', 'Tax', 'NBR', 'Mr. Sarder Md. Abu Helal', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-15 Dhaka', 'United States of America', 'University', 'Official Trip', '2020-03-01', '2020-03-15', '0000-00-00', '0000-00-00', 15, 'Mr. Sarder Md. Abu Helal.pdf', 'anando.biswas'),
(136, '00', 'Tax', 'NBR', ' S M Gulibe Faruque', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-05 Dhaka', 'United States of America', 'University', 'Official Trip', '2020-03-01', '2020-03-15', '0000-00-00', '0000-00-00', 15, 'S M Gulibe Faruque.pdf', 'anando.biswas'),
(137, '00', 'Tax', 'NBR', ' Lincoln Roy', 'Second Secretary', 6, 'National Board of Revenue, Dhaka', 'United States of America', 'Employer', 'Official Trip', '2020-03-01', '2020-03-15', '0000-00-00', '0000-00-00', 15, 'Lincoln Roy.pdf', 'anando.biswas'),
(138, '00', 'Tax', 'NBR', 'Jane Alam', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-05 Dhaka', 'United States of America', 'University', 'Official Trip', '2020-03-01', '2020-03-15', '0000-00-00', '0000-00-00', 15, 'Jane Alam.pdf', 'anando.biswas'),
(139, '00', 'Tax', 'NBR', 'Hafsa Sultana ', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-10, Dhaka', 'United States of America', 'University', 'Official Trip', '2020-03-01', '2020-03-15', '0000-00-00', '0000-00-00', 15, 'Jane Alam.pdf', 'anando.biswas'),
(140, '00', 'Non Cadre', 'NSD', 'Misbah Uddin', 'Assistant Director', 9, 'District Savings Office, B Baria.', 'India', 'Self', 'EBL', '2021-11-18', '2021-12-17', '0000-00-00', '0000-00-00', 30, 'Ex-Bangladesh Leave of Misbah Uddin, Assistant Director, District Savings OfficeBureau, Brahmanbaria.pdf', 'moinul.alam'),
(141, '00', 'Customs', 'NBR', 'Maminul Islam', 'Assistant Commissioner', 9, 'Custom House, ICD', 'Saudi Arabia', 'Self', 'EBL', '2020-01-01', '2020-01-15', '0000-00-00', '0000-00-00', 15, 'Maminul Islam.pdf', 'anando.biswas'),
(142, '00', 'Administration', 'IRD', 'Muhammed Nurul Absar', 'Additional Secretary', 2, 'Internal Resources Division', 'Indonesia', 'GoB', 'Official Trip', '2020-01-25', '2020-01-31', '0000-00-00', '0000-00-00', 7, 'Muhammed Nurul Absar.pdf', 'anando.biswas'),
(143, '00', 'Customs', 'NBR', 'Md. Zakir Hossain', 'Commissioner', 3, 'CEVT, Jashore', 'Indonesia', 'GoB', 'Official Trip', '2020-01-25', '2020-01-31', '0000-00-00', '0000-00-00', 7, 'Md. Zakir Hossain.pdf', 'anando.biswas'),
(144, '00', 'Tax', 'NBR', 'Md. Rahenul Islam', 'First Secretary', 5, 'National Board of Revenue, Dhaka', 'Indonesia', 'GoB', 'Official Trip', '2020-01-25', '2020-01-31', '0000-00-00', '0000-00-00', 7, 'Md. Rahenul Islam.pdf', 'anando.biswas'),
(145, '00', 'Tax', 'NBR', 'Zeenat Ara', 'First Secretary', 5, 'National Board of Revenue, Dhaka', 'Indonesia', 'GoB', 'Official Trip', '2020-01-25', '2020-01-31', '0000-00-00', '0000-00-00', 7, 'Zeenat Ara.pdf', 'anando.biswas'),
(146, '00', 'Non Cadre', 'NSD', 'Muhammad Mizanur Rahman', 'Deputy Director', 6, 'Directorate of National Savings', 'Indonesia', 'GoB', 'Official Trip', '2020-01-25', '2020-01-31', '0000-00-00', '0000-00-00', 7, 'Muhammad Mizanur Rahman.pdf', 'anando.biswas'),
(147, '00', 'Tax', 'NBR', 'Md. Mehedi Hassan', 'Deputy Commissioner', 6, 'Taxes Zone-2, Dhaka', 'Indonesia', 'GoB', 'Official Trip', '2020-01-25', '2020-01-31', '0000-00-00', '0000-00-00', 7, 'Md. Mehedi Hassan.pdf', 'anando.biswas'),
(148, '00', 'Customs', 'NBR', 'Md. Shamsuddin ', 'Second Secretary', 6, 'National Board of Revenue, Dhaka', 'Indonesia', 'GoB', 'Official Trip', '2020-01-25', '2020-01-31', '0000-00-00', '0000-00-00', 7, 'Md. Shamsuddin.pdf', 'anando.biswas'),
(149, '300262', 'Customs', 'NBR', 'Md. Mustafizur Rahman', 'Deputy Commissioner', 6, 'Custom House, Benapole', 'India', 'Self', 'EBL', '2021-12-16', '2021-12-30', '0000-00-00', '0000-00-00', 15, 'Md. Mustafizur Rahman.pdf', 'anando.biswas'),
(150, '300237', 'Customs', 'NBR', 'Fahmida Mahjabeen', 'Second Secretary', 6, 'National Board of Revenue, Dhaka', 'United Arab Erimates', 'Self', 'EBL', '2021-12-15', '2021-12-24', '0000-00-00', '0000-00-00', 10, 'Fahmida Mahjabeen.pdf', 'anando.biswas'),
(151, '00', 'Tax', 'TAT', 'Mohammad Abul Monsur', 'Member', 3, 'Taxes Appellate Tribunal', 'Singapore', 'Self', 'EBL', '2020-02-06', '2020-02-17', '0000-00-00', '0000-00-00', 12, 'Mohammad Abul Monsur.pdf', 'anando.biswas'),
(152, '00', 'Tax', 'NBR', 'Md. Moniruzzaman', 'Joint Commissioner of Taxes', 5, 'Taxes zone 10, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2020-01-12', '2020-01-26', '0000-00-00', '0000-00-00', 15, 'Md. Moniruzzaman.pdf', 'anando.biswas'),
(153, '00', 'Tax', 'NBR', 'Md. Bazlul Kabir Bhuiyan', 'Commissioner of Taxes', 3, 'Taxes Zone-13, Dhaka', 'United States of America', 'Self', 'EBL', '2020-04-01', '2020-04-10', '0000-00-00', '0000-00-00', 10, 'Md. Bazlul Kabir Bhuiyan.pdf', 'anando.biswas'),
(154, '00', 'Tax', 'NBR', 'Muhammad Muyenul Islam', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-13, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2019-12-15', '2019-12-29', '0000-00-00', '0000-00-00', 15, 'Muhammad Muyenul Islam.pdf', 'anando.biswas'),
(155, '00', 'Tax', 'NBR', 'Md. Jahirul Islam Bhuiyan', 'Commissioner of Taxes', 9, 'Taxes Zone, Gazipur', 'Thailand', 'Self', 'EBL', '2020-01-05', '2020-01-25', '0000-00-00', '0000-00-00', 21, 'Md. Jahirul Islam Bhuiyan.pdf', 'anando.biswas'),
(156, '00', 'Tax', 'NBR', 'Ujjwal Kumar Sarda', 'Deputy Commissioner of Taxes', 6, 'Taxes zone, Khulna', 'India', 'Self', 'EBL', '2020-02-01', '2020-02-21', '0000-00-00', '0000-00-00', 21, 'Ujjwal Kumar Sarda.pdf', 'anando.biswas'),
(157, '00', 'Tax', 'TAT', 'Kalipada Halder', 'President', 1, 'Taxes Appellate Tribunal', 'Finland', 'Self', 'EBL', '2020-02-01', '2020-02-15', '0000-00-00', '0000-00-00', 15, 'Kalipada Halder.pdf', 'anando.biswas'),
(158, '00', 'Customs', 'NBR', 'Shahed Ahmed', 'Deputy Commissioner', 6, 'Customs Valuation Commissionarate', 'India', 'Self', 'EBL', '2020-01-15', '2020-01-26', '0000-00-00', '0000-00-00', 12, 'Shahed Ahmed.pdf', 'anando.biswas'),
(159, '00', 'Customs', 'NBR', 'Md. Ahasan Ullah', 'Deputy Commissioner', 6, 'CEVT, Chattogram', 'Saudi Arabia', 'Self', 'EBL', '2020-01-10', '2020-01-24', '0000-00-00', '0000-00-00', 15, 'Md. Ahasan Ullah.pdf', 'anando.biswas'),
(160, '00', 'Administration', 'NBR', 'Md. Abdul Alim', 'Deputy Commissioner', 6, 'CEVT, Jashore', 'Saudi Arabia', 'Self', 'EBL', '2019-12-22', '2020-01-15', '0000-00-00', '0000-00-00', 25, 'Md. Abdul Alim.pdf', 'anando.biswas'),
(161, '00', 'Customs', 'NBR', ' S M Shamimur Rahman', 'Deputy Commissioner', 6, 'Custom House, Benapole', 'Singapore', 'Self', 'EBL', '2020-01-01', '2020-02-15', '0000-00-00', '0000-00-00', 46, 'S M Shamimur Rahman.pdf', 'anando.biswas'),
(162, '00', 'Tax', 'NBR', 'Mohidul Islam', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-6, Dhaka', 'Singapore', 'Self', 'EBL', '2020-02-09', '2020-02-14', '0000-00-00', '0000-00-00', 6, 'Mohidul Islam.pdf', 'anando.biswas'),
(163, '00', 'Tax', 'NBR', 'Shadhon Kumar Ray', 'Additional Commissioner of Taxes', 4, 'Taxes Zone, Cumilla', 'India', 'Self', 'EBL', '2019-12-25', '2020-01-03', '0000-00-00', '0000-00-00', 10, 'IRDoc_0008.pdf', 'moinul.alam'),
(164, '00', 'Customs', 'TAT', 'Waheeda Rahman Choudhury', 'Member', 3, 'Head Office, Dhaka', 'Thailand', 'Self', 'EBL', '2020-03-29', '2020-04-07', '0000-00-00', '0000-00-00', 10, 'Ex-Bangladesh Leave of Waheeda Rahman Choudhury.pdf', 'moinul.alam'),
(165, '00', 'Customs', 'NBR', 'Md. Tariq Hassan', 'Second Secretary', 6, 'Head Office, Dhaka', 'United States of America', 'IO', 'Official Trip', '2020-03-25', '2020-03-27', '0000-00-00', '0000-00-00', 3, 'GO of Md. Tariq Hassan.pdf', 'moinul.alam'),
(166, '00', 'Customs', 'NBR', 'MD. Aminul Islam', 'Assistant Commissioner', 9, 'Custom House, Chattogram', 'Thailand', 'Self', 'EBL', '2020-02-06', '2020-02-26', '0000-00-00', '0000-00-00', 21, 'Aminul.pdf', 'farhad.pathan'),
(167, '00', 'Tax', 'NBR', 'Monwar Ahmed', 'Additional Commissioner of Taxes', 0, 'Taxes Appeal Zone, Chattogram', 'Thailand', 'Self', 'EBL', '2020-03-29', '2020-04-02', '0000-00-00', '0000-00-00', 5, 'IRD_Doc_0001.pdf', 'moinul.alam'),
(168, '00', 'Customs', 'NBR', 'Nahid Nawahad Mukul', 'Joint Commissioner', 5, 'CEV Commissionerate, Jashore', 'India', 'IO', 'Official Trip', '2020-03-12', '2020-03-13', '0000-00-00', '0000-00-00', 2, 'kolkata go.pdf', 'moinul.alam'),
(169, '00', 'Customs', 'NBR', 'Mohammad Belal Hossain Chowdhury', 'Commissioner', 3, 'Customs House Benapole', 'India', 'IO', 'Official Trip', '2020-03-12', '2020-03-13', '0000-00-00', '0000-00-00', 2, 'kolkata go.pdf', 'moinul.alam'),
(170, '00', 'Customs', 'NBR', 'Mohammad Nuruzzaman Howlader', 'Assistant Commissioner', 10, '(CEVC, South) Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2020-02-15', '2020-02-29', '0000-00-00', '0000-00-00', 15, 'Customs 60.pdf', 'farhad.pathan'),
(171, '00', 'Customs', 'NBR', 'Md. Tarek Mahmud', 'Second Secretary', 6, 'Head Office, Dhaka', 'India', 'IO', 'Official Trip', '2020-03-12', '2020-03-13', '0000-00-00', '0000-00-00', 2, 'kolkata go.pdf', 'moinul.alam'),
(172, '00', 'Customs', 'NBR', 'Muhammad Mahi Uddin', 'Assistant Director', 9, 'AIID, VAT, Dhaka', 'Korea South', 'IO', 'Official Trip', '2020-03-17', '2020-03-19', '0000-00-00', '0000-00-00', 3, 'customs-48.pdf', 'farhad.pathan'),
(173, '00', 'Customs', 'NBR', 'Mohammad Bappee Shahriar Siddiquee', 'Joint Commissioner', 4, 'CEV Commissionerate, Khulna', 'India', 'IO', 'Official Trip', '2020-03-12', '2020-03-13', '0000-00-00', '0000-00-00', 2, 'kolkata go.pdf', 'moinul.alam'),
(174, '00', 'Tax', 'NBR', 'Md. Mahbubur Rahman', 'Commissioner of Taxes', 4, 'Taxes Zone, Cumilla', 'Thailand', 'Self', 'EBL', '2020-02-27', '2020-03-07', '0000-00-00', '0000-00-00', 10, 'IRD_Doc_0004.pdf', 'moinul.alam'),
(175, '00', 'Customs', 'NBR', 'Uttom Biswas ', 'Deputy Commissioner', 6, 'CEVC, Cumilla', 'Thailand', 'IO', 'Official Trip', '2020-03-23', '2020-03-27', '0000-00-00', '0000-00-00', 5, 'Customs-49.pdf', 'farhad.pathan'),
(176, '00', 'Not Applicable', 'IRD', 'Gazi Gulam Kibria', 'Despatch Rider', 18, 'Bangladesh Secretariat, Dhaka', 'India', 'Self', 'EBL', '2020-03-29', '2020-04-25', '0000-00-00', '0000-00-00', 28, 'IRD_Doc_0004.pdf', 'moinul.alam'),
(177, '00', 'Customs', 'NBR', 'Kazi Iraj Ishtiak ', 'Deputy Commissioner', 6, 'CEVC, Cumilla', 'Thailand', 'IO', 'Official Trip', '2020-03-23', '2020-03-27', '0000-00-00', '0000-00-00', 5, 'Customs-49.pdf', 'farhad.pathan'),
(178, '00', 'Customs', 'NBR', 'Md. Abul Kalam Azad', 'Assistant Commissioner', 9, 'CEVC, Cumilla', 'Thailand', 'IO', 'Official Trip', '2020-03-23', '2020-03-27', '0000-00-00', '0000-00-00', 5, 'Customs-49.pdf', 'farhad.pathan'),
(179, '00', 'Tax', 'TAT', 'Md. Sajjad Hossain Bhuiyan', 'Member', 3, 'Head Office, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2020-05-12', '2020-05-26', '0000-00-00', '0000-00-00', 15, 'Tax-39.pdf', 'moinul.alam'),
(180, '00', 'Tax', 'NBR', 'Mohammad Amirul Karim Munshi', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-1, Dhaka', 'India', 'Self', 'EBL', '2020-02-05', '2020-02-26', '0000-00-00', '0000-00-00', 22, 'IRD_Doc_0002.pdf', 'moinul.alam'),
(181, '00', 'Customs', 'NBR', 'Dr. Md. Neyamul Islam', 'Additional Commissioner', 5, 'Customs House Benapole', 'Belgium', 'GoB', 'Official Trip', '2020-03-24', '2020-03-27', '0000-00-00', '0000-00-00', 4, 'getContent.pdf', 'moinul.alam'),
(182, '00', 'Tax', 'NBR', 'Sehela Siddiqua', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-1, Dhaka', 'Thailand', 'Self', 'EBL', '2020-04-01', '2020-04-15', '0000-00-00', '0000-00-00', 15, 'IRDoc_0001.pdf', 'moinul.alam'),
(183, '00', 'Non Cadre', 'NBR', 'Mohammad Shafiqur Rahman', 'System Manager', 3, 'Head Office, Dhaka', 'India', 'Self', 'EBL', '2020-02-23', '2020-02-29', '0000-00-00', '0000-00-00', 7, 'IRD_Doc_0001.pdf', 'moinul.alam'),
(184, '00', 'Tax', 'NBR', 'S.M. Bashir Ahmed', 'Commissioner of Taxes', 3, 'LTU, Dhaka', 'India', 'Self', 'EBL', '2020-03-08', '2020-03-27', '0000-00-00', '0000-00-00', 20, 'IRDoc_0003.pdf', 'moinul.alam'),
(185, '00', 'Tax', 'NBR', 'Kanon Kumer Roy', 'Member', 2, 'Head Office, Dhaka', 'India', 'Self', 'EBL', '2020-03-08', '2020-03-27', '0000-00-00', '0000-00-00', 20, 'IRDoc_0004.pdf', 'moinul.alam'),
(186, '00', 'Not Applicable', 'NBR', 'Muhammad Muniruzzaman', 'Upper Division Assistant', 0, 'Taxes Appeal Zone, Khulna', 'Saudi Arabia', 'Self', 'EBL', '2020-07-30', '2020-09-12', '0000-00-00', '0000-00-00', 45, 'IRDoc_0002.pdf', 'moinul.alam'),
(187, '00', 'Customs', 'NBR', 'Md. Enamul Hoque', 'Deputy Commissioner', 6, 'CEVC, Chattogram', 'Saudi Arabia', 'Self', 'EBL', '2020-02-16', '2020-03-01', '0000-00-00', '0000-00-00', 15, 'enamul-7.pdf', 'farhad.pathan'),
(188, '00', 'Non Cadre', 'NBR', 'Mrs. Kamrun Naher Maya', 'Assistant Programmer', 9, 'NBR', 'United Kingdom', 'Self', 'EBL', '2020-02-07', '2020-02-14', '0000-00-00', '0000-00-00', 8, 'Ex-Bangladesh Leave of Mrs. Kamrun Naher Maya.pdf', 'farhad.pathan'),
(190, '00', 'Tax', 'NBR', 'Mrs. Hasina Akter Khan', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-10, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2020-01-01', '2020-01-15', '0000-00-00', '0000-00-00', 15, 'IRD_Doc_0001-10.pdf', 'farhad.pathan'),
(191, '00', 'Tax', 'NBR', 'Mr. A J M Ziaul Hoq', 'Commissioner of Taxes', 3, 'Taxes Zone-14, Dhaka', 'Singapore', 'Self', 'EBL', '2020-02-03', '2020-02-10', '0000-00-00', '0000-00-00', 8, 'IRD_Doc_0001-11.pdf', 'farhad.pathan'),
(192, '00', 'Tax', 'NBR', 'Mohammad Ataul Hoque', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-05, Dhaka', 'India', 'Self', 'EBL', '2020-02-02', '2020-02-23', '0000-00-00', '0000-00-00', 22, 'IRD_Doc_0002 -9.pdf', 'farhad.pathan'),
(193, '00', 'Tax', 'NBR', 'Md. Zakir Hossain ', 'Additional Commissioner of Taxes', 4, 'Taxes Zone-Bogura', 'Korea South', 'IO', 'Official Trip', '2020-02-17', '2020-02-21', '0000-00-00', '0000-00-00', 5, 'IRD_Doc_0002.pdf', 'farhad.pathan'),
(194, '00', 'Tax', 'NBR', 'Muhammad Aminur Rahman', 'First Secretary', 5, 'NBR', 'Korea South', 'IO', 'Official Trip', '2020-02-17', '2021-02-21', '0000-00-00', '0000-00-00', 371, 'IRD_Doc_0002.pdf', 'farhad.pathan'),
(195, '00', 'Tax', 'NBR', 'Md. Nazrul Islam', 'Commissioner of Taxes', 3, 'Taxes Zone-06, Dhaka', 'Canada', 'Self', 'EBL', '2020-03-22', '2020-03-26', '0000-00-00', '0000-00-00', 5, 'IRD_Doc_0003.pdf', 'farhad.pathan'),
(196, '00', 'Tax', 'NBR', 'Md. Nazrul Islam', 'Commissioner of Taxes', 3, 'Taxes Zone-06, Dhaka', 'Turkey', 'IO', 'EBL', '2020-03-16', '2020-03-20', '0000-00-00', '0000-00-00', 5, 'IRD_Doc_0005.pdf', 'farhad.pathan'),
(197, '00', 'Tax', 'NBR', 'Dipak Kumar Paul', 'Second Secretary', 0, 'Tax wing', 'Turkey', 'Self', 'Official Trip', '2020-03-16', '2020-03-20', '0000-00-00', '0000-00-00', 5, 'IRD_Doc_0005.pdf', 'farhad.pathan'),
(198, '00', 'Tax', 'NBR', 'Tapas Kumar Chanda', 'Deputy Commissioner of Taxes', 0, 'Taxes Zone-04, Dhaka', 'India', 'Self', 'EBL', '2020-02-23', '2020-03-08', '0000-00-00', '0000-00-00', 15, 'IRD_Doc_0006.pdf', 'farhad.pathan'),
(199, '00', 'Tax', 'NBR', 'Mrs. Salina Sultana', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-06, Dhaka', 'Korea South', 'IO', 'Official Trip', '2020-03-23', '2021-03-27', '0000-00-00', '0000-00-00', 370, 'IRD_Doc_0007-1.pdf', 'farhad.pathan'),
(200, '00', 'Tax', 'NBR', 'Mrs. Umme Ayman Kashmi ', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-04, Dhaka', 'Korea South', 'IO', 'Official Trip', '2020-03-23', '2020-03-27', '0000-00-00', '0000-00-00', 5, 'IRD_Doc_0007-1.pdf', 'farhad.pathan'),
(201, '00', 'Non Cadre', 'NBR', 'Mr. Khan Majles Shams E Tabriz', 'Assistant Programmer', 9, 'Taxes Zone-10, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2020-03-09', '2021-03-23', '0000-00-00', '0000-00-00', 380, 'IRDoc_0001 -8.pdf', 'farhad.pathan'),
(202, '00', 'Tax', 'NBR', ' K M Sarwar Alam', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-01, Dhaka', 'Australia', 'Employer', 'Lien', '2020-02-07', '2020-12-06', '0000-00-00', '0000-00-00', 304, 'IRDoc_0001.pdf', 'farhad.pathan'),
(203, '00', 'Tax', 'NBR', 'Mr. Hafiz Ahmed Murshed ', 'Member', 2, 'Tax wing', 'Austria', 'IO', 'Official Trip', '2020-03-16', '2020-03-20', '0000-00-00', '0000-00-00', 5, 'IRDoc_0003-2.pdf', 'farhad.pathan'),
(204, '00', 'Tax', 'NBR', ' Md. Meftha Uddin Khan', 'Member', 2, 'Tax wing', 'Austria', 'IO', 'Official Trip', '2020-03-16', '2020-03-20', '0000-00-00', '0000-00-00', 5, 'IRDoc_0003-2.pdf', 'farhad.pathan'),
(205, '00', 'Customs', 'NBR', 'Md. Sanuwarul Kabir', 'Deputy Commissioner', 6, 'Custom House, Dhaka', 'Belgium', 'GoB', 'Official Trip', '2020-02-12', '2020-02-14', '0000-00-00', '0000-00-00', 3, 'Md. Sanuwarul Kabir.pdf', 'anando.biswas'),
(206, '00', 'Customs', 'NBR', 'Md. Jahangir Alam', 'Second Secretary', 6, 'National Board of Revenue, Dhaka', 'Belgium', 'GoB', 'Official Trip', '2020-02-24', '2020-02-28', '0000-00-00', '0000-00-00', 5, 'Md. Jahangir Alam.pdf', 'anando.biswas'),
(207, '5738', 'Administration', 'IRD', ' Md. Abdus Sabur Chowdhury', 'Additional Secretary', 2, 'Internal Resources Division', 'Singapore', 'Self', 'EBL', '2020-01-22', '2020-01-31', '0000-00-00', '0000-00-00', 10, 'Md. Abdus Sabur Chowdhury.pdf', 'anando.biswas'),
(208, '00', 'Customs', 'NBR', 'Rukba Iffat', 'Deputy Director', 6, 'Customs Intelligence, Dhaka', 'Singapore', 'Self', 'EBL', '2020-02-02', '2020-02-11', '0000-00-00', '0000-00-00', 10, 'Rukba Iffat-1.pdf', 'anando.biswas'),
(209, '00', 'Tax', 'NBR', ' Md. Baktiar Uddin', 'Deputy Commissioner of Taxes', 6, 'Taxes zone 10, Dhaka', 'India', 'Self', 'EBL', '2020-02-11', '2020-02-20', '0000-00-00', '0000-00-00', 10, 'Md. Baktiar Uddin.pdf', 'anando.biswas'),
(210, '00', 'Tax', 'NBR', 'Towhidur Rahman', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-Mymensingh', 'India', 'Self', 'EBL', '2020-01-26', '2020-02-09', '0000-00-00', '0000-00-00', 15, 'Towhidur Rahman.pdf', 'anando.biswas'),
(211, '00', 'Tax', 'NBR', 'Md. Ashraf Jamil Afgan', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-11, Dhaka', 'India', 'Self', 'EBL', '2020-02-09', '2020-02-23', '0000-00-00', '0000-00-00', 15, 'Md. Ashraf Jamil Afgan.pdf', 'anando.biswas'),
(212, '00', 'Tax', 'NBR', 'Md. Khairul Islam', 'Commissioner of Taxes (Current Charge)', 4, 'Taxes Zone-Barisal', 'Singapore', 'Self', 'EBL', '2020-01-13', '2020-01-22', '0000-00-00', '0000-00-00', 10, 'Md. Khairul Islam.pdf', 'anando.biswas'),
(213, '00', 'Tax', 'NBR', 'Proshanta Kumar Roy', 'Commissioner of Taxes (Current Charge)', 10, 'Taxes Zone-Khulna', 'India', 'Self', 'EBL', '2020-02-10', '2020-02-15', '0000-00-00', '0000-00-00', 6, 'Proshanta Kumar Roy.pdf', 'anando.biswas'),
(214, '00', 'Tax', 'NBR', ' Muhammad Aminur Rahman', 'First Secretary', 5, 'National Board of Revenue, Dhaka', 'India', 'IO', 'Official Trip', '2020-02-03', '2020-02-04', '0000-00-00', '0000-00-00', 2, 'Muhammad Aminur Rahman.pdf', 'anando.biswas'),
(215, '00', 'Customs', 'NBR', ' Mohammad Bashir Ahmed', 'First Secretary', 5, 'National Board of Revenue, Dhaka', 'India', 'IO', 'Official Trip', '2020-02-03', '2020-02-04', '0000-00-00', '0000-00-00', 2, 'Mohammad Bashir Ahmed.pdf', 'anando.biswas'),
(216, '00', 'Non Cadre', 'IRD', 'Kanai Lal Shil ', 'Sr. Asssistant Secretary', 6, 'Internal Resources Division', 'India', 'IO', 'Official Trip', '2020-02-03', '2020-02-04', '0000-00-00', '0000-00-00', 2, 'Kanai Lal Shil.pdf', 'anando.biswas'),
(217, '00', 'Tax', 'NBR', 'Niaz Morshed', 'Second Secretary', 6, 'National Board of Revenue, Dhaka', 'India', 'IO', 'Official Trip', '2020-02-03', '2020-04-02', '0000-00-00', '0000-00-00', 60, 'Niaz Morshed.pdf', 'anando.biswas'),
(218, '00', 'Tax', 'NBR', 'Md. Mohidul Islam Chowdhury', 'Second Secretary', 6, 'National Board of Revenue. Dhaka.', 'India', 'IO', 'Official Trip', '2020-02-03', '2020-02-04', '0000-00-00', '0000-00-00', 2, 'Md. Mohidul Islam Chowdhury.pdf', 'anando.biswas'),
(219, '00', 'Customs', 'NBR', 'A.K.M. Mahbubur Rahman', 'Director General (current charge)', 0, 'CEVTA, Chattogram', 'Belgium', 'GoB', 'Official Trip', '2020-03-09', '2020-03-20', '0000-00-00', '0000-00-00', 12, 'mahbub.pdf', 'farhad.pathan'),
(220, '00', 'Non Cadre', 'NBR', 'Md. Nazrul Islam', 'Assistant Commissioner (Current Charge)', 10, 'CEVC, Rajshahi', 'India', 'Self', 'EBL', '2020-01-20', '2020-01-29', '0000-00-00', '0000-00-00', 10, 'Nazrul.pdf', 'farhad.pathan'),
(221, '00', 'Customs', 'NBR', 'Mohammad Mahraj ul Alam Samrat', 'Second Secretary', 6, 'Customs Wing', 'Phillipines', 'IO', 'Official Trip', '2020-03-09', '2020-03-20', '0000-00-00', '0000-00-00', 12, 'samrat-5.pdf', 'farhad.pathan'),
(222, '00', 'Tax', 'NBR', 'Md. Mizanur Rahman', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-Narayanganj', 'India', 'Self', 'EBL', '2020-03-12', '2020-03-31', '0000-00-00', '0000-00-00', 20, 'Tax--21.pdf', 'farhad.pathan'),
(223, '0', 'Tax', 'NBR', 'Mohammad Abdullah', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-Mymensingh', 'Saudi Arabia', 'Self', 'EBL', '2020-03-10', '2020-03-24', '0000-00-00', '0000-00-00', 15, 'Tax-22.pdf', 'farhad.pathan'),
(224, '0', 'Tax', 'NBR', 'Ganesh Chandra Mondal', 'First Secretary', 5, 'Tax wing', 'India', 'Self', 'EBL', '2020-01-25', '2020-02-08', '0000-00-00', '0000-00-00', 15, 'Tax-23.pdf', 'farhad.pathan'),
(225, '00', 'Tax', 'NBR', 'Md. Nazrul Alam Chowdhury', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-8, Dhaka', 'India', 'Self', 'EBL', '2020-01-23', '2020-02-06', '0000-00-00', '0000-00-00', 15, 'Tax-24-11.pdf', 'farhad.pathan'),
(226, '00', 'Tax', 'NBR', 'Mir Rezoanul Abed', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-15, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2020-02-20', '2020-03-10', '0000-00-00', '0000-00-00', 20, 'tax-27_20200211_0001-11.pdf', 'farhad.pathan'),
(227, '00', 'Tax', 'NBR', 'Tanmoy Kanti Sarker', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-Sylhet', 'India', 'Self', 'EBL', '2020-01-15', '2020-01-29', '0000-00-00', '0000-00-00', 15, 'Tax-28.pdf', 'farhad.pathan'),
(228, '0', 'Tax', 'NBR', 'Modud Ahmad Bhuiyan', 'Additional Commissioner of Taxes', 9, 'Taxes Zone-3, Chattogram', 'India', 'Self', 'EBL', '2020-02-02', '2020-02-16', '0000-00-00', '0000-00-00', 15, 'Tax-29.pdf', 'farhad.pathan'),
(229, '0', 'Tax', 'NBR', ' Farzana Sultana', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-7, Dhaka', 'United States of America', 'Self', 'EBL', '2019-12-20', '2020-01-13', '0000-00-00', '0000-00-00', 25, 'Tax-29.pdf', 'farhad.pathan'),
(230, '00', 'Non Cadre', 'IRD', 'Kanai Lal Shil', 'Sr. Asssistant Secretary', 6, 'ACR Section', 'Malaysia', 'GoB', 'Official Trip', '2020-02-16', '2020-02-15', '0000-00-00', '0000-00-00', 0, 'GO IRD Officers of 13-02-2020-3.pdf', 'farhad.pathan'),
(231, '0', 'Non Cadre', 'IRD', 'Md. Farhad Khan Pathan', 'Assistant Programmer', 9, 'ICT wing', 'Malaysia', 'GoB', 'Official Trip', '2020-02-16', '2020-02-15', '0000-00-00', '0000-00-00', 0, 'GO IRD Officers of 13-02-2020-3.pdf', 'farhad.pathan'),
(232, '00', 'Tax', 'NBR', 'Shaheen Akhter', 'Member', 2, 'Tax wing', 'Netherlands', 'IO', 'Official Trip', '2021-11-29', '2021-11-30', '0000-00-00', '0000-00-00', 2, 'Tax-311 E.pdf', 'farhad.pathan'),
(233, '00', 'Tax', 'NBR', 'Shoaeb Ahmed', 'Member', 2, 'Tax wing', 'Netherlands', 'IO', 'Official Trip', '2021-11-29', '2021-11-30', '0000-00-00', '0000-00-00', 2, 'Tax-311 E.pdf', 'farhad.pathan'),
(234, '00', 'Tax', 'NBR', 'Asma Dina Ghani', 'Additional Commissioner of Taxes', 4, 'Taxes Zone-02, Dhaka', 'Netherlands', 'IO', 'Official Trip', '2021-11-29', '2021-11-30', '0000-00-00', '0000-00-00', 2, 'Tax-311 E.pdf', 'farhad.pathan'),
(235, '00', 'Tax', 'NBR', 'Niaz Morshed', 'Second Secretary', 6, 'Tax wing', 'Netherlands', 'IO', 'Official Trip', '2021-11-29', '2021-11-30', '0000-00-00', '0000-00-00', 2, 'Tax-311 E.pdf', 'farhad.pathan'),
(236, '00', 'Tax', 'NBR', 'Bapan Chandra Das', 'Second Secretary', 6, 'Tax wing', 'Netherlands', 'IO', 'Official Trip', '2021-11-29', '2021-11-30', '0000-00-00', '0000-00-00', 2, 'Tax-311 E.pdf', 'farhad.pathan'),
(237, '00', 'Administration', 'NBR', 'Md. Saifur Rahman', 'Second Secretary', 6, 'Tax wing', 'Netherlands', 'IO', 'Official Trip', '2021-11-29', '2021-11-30', '0000-00-00', '0000-00-00', 2, 'Tax-311 E.pdf', 'farhad.pathan'),
(238, '00', 'Tax', 'NBR', 'Dr. Motiur Rahman', 'Commissioner', 3, 'LTU, Dhaka', 'Bangladesh', 'GoB', 'Lien', '2020-08-06', '2021-08-05', '0000-00-00', '0000-00-00', 365, 'Dr. Motiur Rahman.pdf', 'anando.biswas'),
(239, '00', 'Customs', 'NBR', 'Dr. Md. Abdur Rouf', 'Commissioner', 3, 'National Board of Revenue, Dhaka', 'Bangladesh', 'GoB', 'Lien', '2020-07-01', '2020-12-31', '0000-00-00', '0000-00-00', 184, 'Dr. Md. Abdur Rouf.pdf', 'anando.biswas'),
(240, '00', 'Customs', 'NBR', 'Md.Tarek Mahmud', 'Second Secretary', 6, 'National Board of Revenue, Dhaka', 'Japan', 'IO', 'Study Leave', '0020-09-01', '2021-09-30', '0000-00-00', '0000-00-00', 730880, 'Md. Tarek Mahmud.pdf', 'anando.biswas'),
(241, '00', 'Customs', 'NBR', 'Ahmedur Reza Chowdhury', 'Assistant Commissioner', 9, 'CEVT, Sylhet', 'Singapore', 'Self', 'EBL', '2020-08-01', '2020-08-20', '0000-00-00', '0000-00-00', 20, 'Ahmedur Reza Chowdhury.pdf', 'anando.biswas'),
(242, '00', 'Customs', 'NBR', 'Mohammad Ehteshamul Hoque', 'First Secretary', 5, 'National Board of Revenue, Dhaka', 'Bangladesh', 'IO', 'Lien', '2020-08-01', '2021-07-30', '0000-00-00', '0000-00-00', 364, 'Mohammad Ehteshamul Hoque.pdf', 'anando.biswas'),
(243, '00', 'Non Cadre', 'NBR', 'Shrabana Afrin', 'Revenue Officer', 10, 'CEVT, Sylhet', 'Korea North', 'University', 'Deputation', '2020-08-12', '2023-02-11', '0000-00-00', '0000-00-00', 914, 'Shrabana Afrin.pdf', 'anando.biswas'),
(244, '00', 'Non Cadre', 'NBR', 'Shrabana Afrin', 'Revenue Officer', 10, 'CEVT, Sylhet', 'Korea North', 'Others', 'Study Leave', '2020-02-12', '2023-08-27', '0000-00-00', '0000-00-00', 1293, 'Shrabana Afrin-1.pdf', 'anando.biswas'),
(245, '00', 'Non Cadre', 'NBR', 'Mezbah Uddin Bhuiya', 'Assistant Commissioner(Current Charge)', 10, 'Custom House, Pangaon', 'United States of America', 'Others', 'EBL', '2020-07-26', '2020-09-08', '0000-00-00', '0000-00-00', 45, 'Mezbah Uddin Bhuiya.pdf', 'anando.biswas'),
(246, '00', 'Customs', 'NBR', 'Mst. Sarmin Akter Mazumder', 'Deputy Commissioner', 6, 'Custom House, Dhaka', 'United States of America', 'Self', 'EBL', '2020-09-09', '2021-03-07', '0000-00-00', '0000-00-00', 180, 'Mst. Sarmin Akter Mazumder.pdf', 'anando.biswas'),
(247, '00', 'Administration', 'NBR', 'Mohammad Faizur Rahman', 'Member', 2, 'National Board of Revenue, Dhaka', 'India', 'Self', 'EBL', '2020-10-18', '2020-11-01', '0000-00-00', '0000-00-00', 15, 'Mohammad Faizur Rahman.pdf', 'anando.biswas'),
(248, '00', 'Tax', 'NBR', 'Mutasim Billah Faruqui', 'Commissioner of Taxes (Current Charge)', 4, 'Taxes Zone-04, Chattogram', 'India', 'Self', 'EBL', '2020-11-26', '2020-12-10', '0000-00-00', '0000-00-00', 15, 'Mutasim Billah Faruqui.pdf', 'anando.biswas'),
(249, '00', 'Customs', 'NBR', ' Md. Shayekh Arefin Zahedi', 'Deputy Commissioner', 6, 'Custom House, Dhaka', 'India', 'Self', 'EBL', '2020-12-15', '2020-12-30', '0000-00-00', '0000-00-00', 16, 'Md. Shayekh Arefin Zahedi.pdf', 'anando.biswas'),
(250, '00', 'Customs', 'NBR', 'Md. Raich Uddin Khan', 'First Secretary', 5, 'National Board of Revenue, Dhaka', 'Bangladesh', 'Others', 'Lien', '2021-01-01', '2021-12-31', '0000-00-00', '0000-00-00', 365, 'Md. Raich Uddin Khan.pdf', 'anando.biswas'),
(251, '200374', 'Tax', 'NBR', 'Naznin Farhana', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-05, Dhaka', 'India', 'FS', 'Deputation', '2021-12-01', '2024-12-30', '0000-00-00', '0000-00-00', 1126, 'Naznin Farhana.pdf', 'anando.biswas'),
(252, '300120', 'Customs', 'NBR', 'Mia Md. Abu Obaida', 'First Secretary', 5, 'National Board of Revenue, Dhaka', 'Thailand', 'Self', 'EBL', '2021-12-16', '2021-12-23', '0000-00-00', '0000-00-00', 8, 'Mia Md. Abu Obaida.pdf', 'anando.biswas'),
(253, '300347', 'Customs', 'NBR', 'Md. Abdul Baten', 'Deputy Commissioner', 6, 'CEVT, Chattogram', 'India', 'Self', 'EBL', '2021-12-01', '2021-12-15', '0000-00-00', '0000-00-00', 15, 'Md. Abdul Baten.pdf', 'anando.biswas'),
(254, '300075', 'Customs', 'NBR', 'Dr. Md. Abdur Rouf ', 'Director General', 3, 'Customs Intelligence, Dhaka', 'India', 'GoB', 'Official Trip', '2021-12-04', '2021-12-05', '0000-00-00', '0000-00-00', 2, 'Dr. Md. Abdur Rouf.pdf', 'anando.biswas'),
(255, '300171', 'Customs', 'NBR', 'Md Shamsul Arafin Khan', 'Joint Director', 5, 'Customs Intelligence, Dhaka', 'India', 'GoB', 'Official Trip', '2021-12-04', '2021-12-05', '0000-00-00', '0000-00-00', 2, 'Md Shamsul Arafin.pdf', 'anando.biswas'),
(256, '300076', 'Customs', 'NBR', 'Mohammad Fakhrul Alam', 'Commissioner', 3, 'Custom House, Chattogram', 'Australia', 'Self', 'EBL', '2021-12-01', '2021-12-15', '0000-00-00', '0000-00-00', 15, 'GO of Mohammad Fakhrul Alam.pdf', 'anando.biswas'),
(257, '00', 'Customs', 'NBR', 'Syed Golam Kibria', 'Member', 3, 'National Board of Revenue, Dhaka', 'Turkey', 'Others', 'Official Trip', '2021-12-13', '2021-12-20', '0000-00-00', '0000-00-00', 8, 'GO Turkey Tour.pdf', 'anando.biswas'),
(258, '00', 'Non Cadre', 'NBR', 'A.K.M. Zahid Hossain', 'System Manager', 4, 'National Board of Revenue, Dhaka', 'Turkey', 'Others', 'Official Trip', '2021-12-13', '2021-12-20', '0000-00-00', '0000-00-00', 8, 'A.K.M. Zahid Hossain.pdf', 'anando.biswas'),
(259, '00', 'Customs', 'NBR', 'AKM Nurul Huda Azad', 'First Secretary', 5, 'National Board of Revenue, Dhaka', 'Turkey', 'Others', 'Official Trip', '2021-12-13', '2021-12-20', '0000-00-00', '0000-00-00', 8, 'AKM Nurul Huda Azad.pdf', 'anando.biswas'),
(260, '00', 'Customs', 'NBR', 'Raquibul Hassan', 'Second Secretary', 6, 'National Board of Revenue, Dhaka', 'Turkey', 'Others', 'Official Trip', '2021-12-13', '2021-12-20', '0000-00-00', '0000-00-00', 8, 'Raquibul Hassan.pdf', 'anando.biswas');
INSERT INTO `foreignvisit` (`ID`, `ServiceID`, `Cadre`, `Office`, `Name`, `Designation`, `Grade`, `Workplace`, `DestinationCountry`, `FundingSource`, `Purpose`, `StartDate`, `EndDate`, `ActualArrival`, `ActualDeparture`, `Days`, `GO`, `Uploader`) VALUES
(261, '00', 'Customs', 'NBR', 'Md. Tarek Mahmud', 'Second Secretary', 6, 'National Board of Revenue, Dhaka', 'Turkey', 'Others', 'Official Trip', '2021-12-13', '2021-12-20', '0000-00-00', '0000-00-00', 8, 'Md. Tarek Mahmud.pdf', 'anando.biswas'),
(262, '200584', 'Tax', 'NBR', 'Mansur Ali', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-8, Dhaka', 'India', 'Self', 'EBL', '2020-12-06', '2021-01-04', '0000-00-00', '0000-00-00', 30, 'Mansur Ali.pdf', 'anando.biswas'),
(263, '300173', 'Administration', 'NBR', 'Mohammad Bappee Shahariar Siddiquee', 'Joint Commissioner', 5, 'Custom House, Chattogram', 'India', 'Self', 'EBL', '2021-11-16', '2021-11-30', '0000-00-00', '0000-00-00', 15, 'GO of Mohammad Bappee Shahariar..pdf', 'anando.biswas'),
(264, '4172', 'Administration', 'IRD', 'Md Shafiqur Rahman', 'Joint Secretary', 3, 'Admin Wing', 'Turkey', 'Project', 'Official Trip', '2021-12-21', '2021-12-28', '0000-00-00', '0000-00-00', 8, 'GO of Turkey Tour..pdf', 'farhad.pathan'),
(265, '300063', 'Customs', 'NBR', 'Kazi Mostafizur Rahman', 'Commissioner', 3, 'Customs Bond Commissionerate, Dhaka.', 'Turkey', 'Project', 'Official Trip', '2021-12-21', '2021-12-28', '0000-00-00', '0000-00-00', 8, 'GO of Turkey Tour..pdf', 'farhad.pathan'),
(266, '300116', 'Customs', 'NBR', 'S.M Shohel Rahman', 'Additional Commissioner', 4, 'Cutoms, Excise & VAT Commissionerate, Rajshahi', 'Turkey', 'Project', 'Official Trip', '2021-12-21', '2021-12-28', '0000-00-00', '0000-00-00', 8, 'GO of Turkey Tour..pdf', 'farhad.pathan'),
(267, '300329', 'Customs', 'NBR', 'Md. Pervaz Al Zaman', 'Deputy Commissioner', 6, 'Customs, Excise & VAT Commisionerate, Jashore', 'Turkey', 'Project', 'Official Trip', '2021-12-21', '2021-12-28', '0000-00-00', '0000-00-00', 8, 'GO of Turkey Tour..pdf', 'farhad.pathan'),
(268, '00', 'Non Cadre', 'NBR', ' Golam Sarwar', 'Assistant Programmer', 9, 'ICT wing', 'Turkey', 'Project', 'Official Trip', '2021-12-21', '2021-12-28', '0000-00-00', '0000-00-00', 8, 'GO of Turkey Tour..pdf', 'farhad.pathan'),
(273, '200314', 'Tax', 'NBR', 'Mohammad Amirul Karim Munshi', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-1, Dhaka', 'India', 'Self', 'EBL', '2021-12-15', '2022-01-05', '0000-00-00', '0000-00-00', 22, '1639298522Mohammad Amirul Karim Munshi.pdf', 'anando.biswas'),
(274, '200291', 'Tax', 'NBR', 'Shah Muhammad Itteda Hasan', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-Narayanganj', 'India', 'Self', 'EBL', '2021-12-05', '2021-12-24', '0000-00-00', '0000-00-00', 20, '1639302562Shah Muhammad Itteda Hasan.pdf', 'anando.biswas'),
(275, '200584', 'Tax', 'NBR', 'Mansur Ali', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-8, Dhaka', 'India', 'Self', 'EBL', '2021-01-07', '2021-02-05', '0000-00-00', '0000-00-00', 30, '1640074682Mansur Ali 07-01-2021.pdf', 'anando.biswas'),
(276, '300033', 'Customs', 'NBR', 'Md Masud Sadiq', 'Member', 2, 'National Board of Revenue, Dhaka', 'United States of America', 'Self', 'EBL', '2021-12-15', '2021-12-29', '0000-00-00', '0000-00-00', 15, '1640080439Md Masud Sadiq.pdf', 'anando.biswas'),
(277, '6521', 'Administration', 'IRD', 'Suraiya Parvin Shelley', 'Joint Secretary', 3, 'Customs Wing', 'United Arab Erimates', 'Self', 'EBL', '2022-02-24', '2022-03-10', '0000-00-00', '0000-00-00', 15, '1640502660শেলী ম্যাডাম.pdf', 'sami.kabir'),
(278, '200367', 'Tax', 'NBR', 'A.K.M. Shamsuzzaman', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-5, Dhaka', 'India', 'Self', 'EBL', '2022-01-01', '2022-01-15', '0000-00-00', '0000-00-00', 15, '1640588455A.K.M. Shamsuzzaman.pdf', 'anando.biswas'),
(279, '300129', 'Customs', 'NBR', 'Md. Khairul Kabir Mia', 'First Secretary', 4, 'Head Office, Dhaka', 'United States of America', 'Self', 'EBL', '2022-01-31', '2022-02-19', '0000-00-00', '0000-00-00', 20, '1640678794GO of Md. Khairul Kabir Mia.pdf', 'moinul.alam'),
(280, '300371', 'Customs', 'NBR', 'Md. Abdul Quayum', 'Deputy Commissioner', 6, 'Custom House, Benapole, Jessore', 'India', 'Self', 'EBL', '2021-12-11', '2021-12-25', '0000-00-00', '0000-00-00', 15, '1640678975GO of Md. Abdul Quayum.pdf', 'moinul.alam'),
(281, '200225', 'Tax', 'NBR', 'Zeenat Ara', 'Additional Commissioner of Taxes', 5, 'Taxes Zone-8, Dhaka', 'India', 'Self', 'EBL', '2021-12-19', '2022-01-02', '0000-00-00', '0000-00-00', 15, '1640835148Zeenat Ara (200225), Additional Commissioner of Taxes.pdf', 'moinul.alam'),
(282, '00', 'Customs', 'NBR', 'Rezaul Karim', 'Deputy Commissioner', 6, 'Custom House, Chattogram', 'India', 'Others', 'Official Trip', '2022-01-16', '2022-01-29', '0000-00-00', '0000-00-00', 14, '1641462431Rezaul Karim.pdf', 'anando.biswas'),
(283, '00', 'Non Cadre', 'NBR', 'Md.Jayed ul Alam', 'Assistant Revenue Officer', 10, 'Custom House, Chattogram', 'India', 'Others', 'Official Trip', '2022-01-16', '2022-01-29', '0000-00-00', '0000-00-00', 14, '1641462664Md. Jayed-ul-Alam.pdf', 'anando.biswas'),
(284, '00', 'Non Cadre', 'NBR', 'Md. Samsul Alam', 'Assistant Revenue Officer', 10, 'Custom House, Chattogram', 'India', 'Others', 'Official Trip', '2022-01-16', '2022-01-29', '0000-00-00', '0000-00-00', 14, '1641462718Md. Samsul Alam.pdf', 'anando.biswas'),
(285, '00', 'Non Cadre', 'NBR', 'Md. Hasan ud Dowla', 'Assistant Revenue Officer', 10, 'Custom House, Chattogram', 'India', 'Others', 'Official Trip', '2022-01-16', '2022-01-29', '0000-00-00', '0000-00-00', 14, '1641462774Md. Hasan-ud-Dowla.pdf', 'anando.biswas'),
(286, '00', 'Non Cadre', 'NBR', 'Md. Ahidul Islam', 'Assistant Revenue Officer', 10, 'Custom House, Chattogram', 'India', 'Others', 'Official Trip', '2022-01-16', '2022-01-29', '0000-00-00', '0000-00-00', 14, '1641462830Md. Ahidul Islam.pdf', 'anando.biswas'),
(287, '200155', 'Tax', 'NBR', ' Swapan Kumar Roy', 'Commissioner of Taxes (Current Charge)', 4, 'Taxes Zone-11, Dhaka', 'United States of America', 'Self', 'EBL', '2022-01-16', '2022-01-30', '0000-00-00', '0000-00-00', 15, '1641701053Swapan Kumar Roy.pdf', 'anando.biswas'),
(288, '00', 'Tax', 'NBR', 'Md. Moniruzzaman', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-10, Dhaka', 'India', 'Self', 'EBL', '2022-01-06', '2022-01-20', '0000-00-00', '0000-00-00', 15, '1641787602Md. Moniruzzaman.pdf', 'anando.biswas'),
(289, '00', 'Not Applicable', 'NBR', 'Md. Jalal Uddin', 'Revenue Officer', 9, 'Customs Excise & VAT Commissionerate, Chattogram', 'Saudi Arabia', 'Self', 'EBL', '2022-02-01', '2022-02-15', '0000-00-00', '0000-00-00', 15, '1646295550GO of Md. Jalal Uddin.pdf', 'sami.kabir'),
(290, '400011', 'Not Applicable', 'NSD', 'Muhammad Mizanur Rahman', 'Deputy Director', 6, 'Head Office, Dhaka', 'Bangladesh', 'Employer', 'Lien', '2022-02-01', '2023-01-31', '0000-00-00', '0000-00-00', 365, '1646295868MizanurRahmanGO.pdf', 'sami.kabir'),
(291, '00', 'Customs', 'NBR', 'Md. Raich Uddin Khan', 'First Secretary', 5, 'Head Office, Dhaka', 'Bangladesh', 'Employer', 'Lien', '2022-01-01', '2023-12-31', '0000-00-00', '0000-00-00', 730, '1646296426RaichUddin.pdf', 'sami.kabir'),
(292, '200526', 'Tax', 'NBR', 'S. M. Bashir Ahmed', 'Deputy Commissioner of Taxes', 6, 'Large Taxpayer Unit (LTU), Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-02-08', '2022-02-22', '0000-00-00', '0000-00-00', 15, '1646296613BashirAhmed.pdf', 'sami.kabir'),
(293, '200530', 'Tax', 'NBR', 'Md. Khademul Islam Chowdhury', 'Deputy Commissioner of Taxes', 6, 'Tax Zone-9, Dhaka', 'Australia', 'University', 'Deputation', '2022-02-17', '2026-02-16', '0000-00-00', '0000-00-00', 1461, '1646296801KhademulIslam.pdf', 'sami.kabir'),
(294, '200386', 'Tax', 'NBR', 'Sayeed Fahd Al Karim', 'Deputy Commissioner of Taxes', 6, 'Tax Zone-9, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-02-01', '2022-02-20', '0000-00-00', '0000-00-00', 20, '1646296950SayeedFahdAlKarim.pdf', 'sami.kabir'),
(295, '300311', 'Customs', 'NBR', 'Nur A flasna Sanjida Anushua', 'Deputy Commissioner', 6, 'ICD, Kamalapur, Dhaka', 'United Arab Erimates', 'Self', 'EBL', '2022-02-22', '2022-03-03', '0000-00-00', '0000-00-00', 10, '1646297235Anusua.pdf', 'sami.kabir'),
(296, '300295', 'Customs', 'NBR', 'Md Shahiduzzaman Sarkar', 'Second Secretary', 6, 'National Board of Revenue', 'Belgium', 'IO', 'EBL', '2022-02-09', '2022-05-20', '0000-00-00', '0000-00-00', 101, '1646297995Md Shahiduzzaman Sarkar.pdf', 'anando.biswas'),
(297, '00', 'Non Cadre', 'NBR', 'Md Abdul Mannan Talukder', 'Revenue Officer', 9, 'Duty Exemption and Drawback Office, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-03-07', '2022-04-13', '0000-00-00', '0000-00-00', 38, '1646298196Md Abdul Mannan Talukder.pdf', 'anando.biswas'),
(298, '200319', 'Tax', 'NBR', 'Md. Mizanur Rahman', 'Joint Commissioner of Taxes', 6, 'Taxes Zone-Narayangonj', 'Thailand', 'Self', 'EBL', '2022-02-01', '2022-04-01', '0000-00-00', '0000-00-00', 60, '1646298462Md. Mizanur Rahman.pdf', 'anando.biswas'),
(299, '00', 'Non Cadre', 'IRD', 'Mr. Sami Kabir', 'Programmer', 6, ' Internal Resources Division', 'Sweden', 'University', 'Deputation', '2022-03-09', '2026-03-08', '0000-00-00', '0000-00-00', 1461, '1646298614Mr. Sami Kabir.pdf', 'anando.biswas'),
(300, '200171', 'Tax', 'NBR', 'Monju Man Ara Begum', 'Additional Commissioner of Taxes', 3, 'Taxes Appeal ZoneChattogram', 'India', 'Self', 'EBL', '2022-03-02', '2022-04-30', '0000-00-00', '0000-00-00', 60, '1646298811Monju Man-Ara Begum.pdf', 'anando.biswas'),
(301, '300062', 'Customs', 'NBR', 'Ismail Hossain Shiraji ', 'Member', 3, 'Customs, Excise & VAT Appellate Tribunal, Dhaka', 'Canada', 'Self', 'EBL', '2022-04-14', '2022-05-13', '0000-00-00', '0000-00-00', 30, '1646299220Ismail Hossain Shiraji.pdf', 'anando.biswas'),
(302, '00', 'Tax', 'NBR', 'Khandokar Khurshid Kamal', 'Additional Commissioner of Taxes', 4, 'Taxes Zone-13, Dhaka', 'Mauritius', 'Self', 'EBL', '2022-03-01', '2022-03-30', '0000-00-00', '0000-00-00', 30, '1646300281Tax-84 E.pdf', 'farhad.pathan'),
(303, '00', 'Non Cadre', 'NSD', 'Shafiqul Islam', 'Assistant Director', 9, 'National Savings Special Bureau, Mirpur, Dhaka', 'India', 'Self', 'EBL', '2022-02-22', '2022-03-01', '0000-00-00', '0000-00-00', 8, '1646300573Shafipul.pdf', 'farhad.pathan'),
(304, '00', 'Non Cadre', 'NSD', 'Mohammad Mohinul Islam', 'Deputy Director', 9, 'Directorate of National Savings, Dhaka', 'India', 'Self', 'EBL', '2022-02-13', '2022-03-15', '0000-00-00', '0000-00-00', 31, '1646300733Mohinul.pdf', 'farhad.pathan'),
(305, '300156', 'Customs', 'NBR', 'Abdul Rashid Miah', 'Joint Commissioner', 5, 'Custom House, Benapole, Jessore', 'India', 'Self', 'EBL', '2022-03-01', '2022-03-15', '0000-00-00', '0000-00-00', 15, '1646301539GO of Abdul Rashid Miah.pdf', 'farhad.pathan'),
(306, '00', 'Non Cadre', 'NBR', 'Khan Majes Shams E Tabriz', 'Assistant Programmer', 9, 'Taxes Zone-10, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-02-09', '2022-02-28', '0000-00-00', '0000-00-00', 20, '1646301818notification-55.pdf', 'farhad.pathan'),
(307, '200543', 'Tax', 'NBR', 'Md. Baktiar Uddin', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-10, Dhaka ', 'India', 'Self', 'EBL', '2022-02-23', '2022-03-09', '0000-00-00', '0000-00-00', 15, '1646626008Md. Baktiar Uddin.pdf', 'anando.biswas'),
(308, '300232', 'Customs', 'NBR', 'Nitish Biswas', 'Deputy Commissioner', 5, 'Customs, Excise & VAT Commissionerate, Jessore', 'India', 'Self', 'EBL', '2022-03-10', '2022-03-24', '0000-00-00', '0000-00-00', 15, '1646730106go nitish.pdf', 'farhad.pathan'),
(309, '300255', 'Customs', 'NBR', 'Mokitul Hasan', 'Deputy Director', 0, 'Duty Exemption & Drawback Directorate, Dhaka', 'Australia', 'BS', 'Deputation', '2022-01-01', '2022-07-31', '0000-00-00', '0000-00-00', 212, '1646730459Deputaion order of Mokitul Hasan.pdf', 'farhad.pathan'),
(310, '200214', 'Tax', 'NBR', 'Towhidul Munir', 'Additional Director General', 4, 'Directorate of Taxes Inspection, Dhaka', 'India', 'Self', 'EBL', '2022-03-13', '2022-04-12', '0000-00-00', '0000-00-00', 31, '1647152124Towhidul Munir.pdf', 'anando.biswas'),
(311, '300178', 'Customs', 'NBR', 'Rafia Sultana', 'Deputy Commissioner', 6, 'Customs, Excise & VAT Commissionerate, Dhaka (East)', 'Saudi Arabia', 'Self', 'EBL', '2022-03-27', '2022-04-14', '0000-00-00', '0000-00-00', 19, '1647167761Rafia Sultana.pdf', 'anando.biswas'),
(312, '00', 'Non Cadre', 'NBR', 'Md. Salahuddin Talukder', 'Revenue Officer', 9, 'Customs, Excise & VAT Commissionerate, Comilla', 'United Kingdom', 'Self', 'EBL', '2022-03-14', '2022-04-23', '0000-00-00', '0000-00-00', 41, '1647252376Md. Salahuddin Talukder.pdf', 'anando.biswas'),
(313, '200477', 'Tax', 'NBR', 'Mr. Jane Alom', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-5, Dhaka', 'India', 'Self', 'EBL', '2022-03-15', '2022-03-29', '0000-00-00', '0000-00-00', 15, '1647769335Mr. Jane Alom.pdf', 'anando.biswas'),
(314, '200503', 'Tax', 'NBR', 'Rumana Islam Sammi', 'Deputy Director', 6, 'BCS (Tax) Academy, Dhaka', 'India', 'Self', 'EBL', '2022-03-27', '2022-04-10', '0000-00-00', '0000-00-00', 15, '1647849159Rumana Islam Sammi.pdf', 'anando.biswas'),
(315, '00', 'Not Applicable', 'CEVT', 'Miazi Shahidul Alam Chowdhury', 'Member', 3, 'Customs, Excise and VAT Appellate Tribunal, Dhaka ', 'United States of America', 'Self', 'EBL', '2022-06-02', '2022-06-25', '0000-00-00', '0000-00-00', 24, '1647859726Miazi Shahidul Alam Chowdhury.pdf', 'anando.biswas'),
(316, '200343', 'Tax', 'NBR', 'Mohammad Sarwar Murshed', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-11, Dhaka', 'India', 'Self', 'EBL', '2022-04-01', '2022-04-15', '0000-00-00', '0000-00-00', 15, '1647941549114.pdf', 'moinul.alam'),
(317, '6521', 'Administration', 'IRD', 'Suraiya Parvin Shelley', 'Senior Secretary', 3, 'Internal Resources Division (IRD)', 'Thailand', 'Self', 'EBL', '2022-04-03', '2022-04-09', '0000-00-00', '0000-00-00', 7, '1648099864getContent (1).pdf', 'moinul.alam'),
(318, '200595', 'Tax', 'NBR', 'Shaila Azeez', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-4, Dhaka', 'Australia', 'GoB', 'Deputation', '2022-05-10', '2023-06-30', '0000-00-00', '0000-00-00', 417, '1649062108Tax-127 E.pdf', 'moinul.alam'),
(319, '300042', 'Customs', 'NBR', 'Dr. Md. Shahidul Islam', 'Member', 3, 'NBR, Dhaka', 'Austria', 'IO', 'Official Trip', '2022-05-23', '2022-05-26', '0000-00-00', '0000-00-00', 4, '1649063234IMG_0001.pdf', 'moinul.alam'),
(320, '300137', 'Customs', 'NBR', 'Muhammad Safiur Rahman', 'First Secretary', 5, 'NBR, Dhaka', 'Austria', 'IO', 'Official Trip', '2022-05-23', '2022-05-26', '0000-00-00', '0000-00-00', 4, '1649063354IMG_0001.pdf', 'moinul.alam'),
(321, '300271', 'Customs', 'NBR', 'Mohammad Abdus Sadek', 'Deputy Commissioner', 6, 'Custom House, Dhaka', 'Austria', 'IO', 'Official Trip', '2022-05-23', '2022-05-26', '0000-00-00', '0000-00-00', 4, '1649063472IMG_0001.pdf', 'moinul.alam'),
(322, '300284', 'Customs', 'NBR', 'Md. Sharfuddin Miah', 'Deputy Commissioner', 6, 'Custom House, Chattogram', 'Austria', 'IO', 'Official Trip', '2022-05-23', '2022-05-26', '0000-00-00', '0000-00-00', 4, '1649063676IMG_0001.pdf', 'moinul.alam'),
(323, '300244', 'Customs', 'NBR', 'Rukba Iffat', 'Deputy Commissioner', 6, 'Customs Bond Commissionerate, Dhaka.', 'India', 'Self', 'EBL', '2022-04-29', '2022-05-08', '0000-00-00', '0000-00-00', 10, '1649130631GO of Rukba Iffat.pdf', 'moinul.alam'),
(324, '0', 'Non Cadre', 'NBR', 'Md Emdadul Hoque Mia', 'Assistant Commissioner', 9, 'Customs Valuation and Internal Audit Commissionerate, Dhaka.', 'India', 'Self', 'EBL', '2022-03-20', '2022-03-31', '0000-00-00', '0000-00-00', 12, '1649147164GO of Md Emdadul Haque Mia.pdf', 'moinul.alam'),
(325, '300227', 'Customs', 'NBR', 'Md. Shayekh Arefin Zahedi', 'Deputy Commissioner', 6, 'Customs, Excise and VAT Commissionerate, Sylhet', 'Saudi Arabia', 'Self', 'EBL', '2022-04-12', '2022-04-21', '0000-00-00', '0000-00-00', 10, '1649572335Md. Shayekh Arefin Zahedi.pdf', 'anando.biswas'),
(326, '00', 'Non Cadre', 'NBR', 'Md. Mofazzal Hossain', 'Revenue Officer', 9, 'Customs, Excise and VAT Commissionerate, Rangpur ', 'India', 'Self', 'EBL', '2022-03-28', '2022-04-26', '0000-00-00', '0000-00-00', 30, '1649656169Md. Mofazzal Hossain.pdf', 'anando.biswas'),
(327, '300120', 'Customs', 'NBR', 'Mia Md. Abu Obaida', 'First Secretary', 5, 'National Board of Revenue, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-04-11', '2022-04-20', '0000-00-00', '0000-00-00', 10, '1649840724IMG_0002.pdf', 'moinul.alam'),
(328, '300185', 'Customs', 'NBR', 'Suman Das', 'Deputy Commissioner', 6, 'Customs, Excise and Vat Commissionerate, Dhaka (East), Dhaka', 'India', 'Self', 'EBL', '2022-04-21', '2022-04-30', '0000-00-00', '0000-00-00', 10, '1650176357Suman Das.pdf', 'anando.biswas'),
(329, '300069', 'Customs', 'NBR', 'Mohammad Belal Hossain Chowdhury', 'Deputy Director', 6, 'Director General, Duty Exemption and Drawback Office, Dhaka ', 'United States of America', 'Self', 'EBL', '2022-04-03', '2022-04-17', '0000-00-00', '0000-00-00', 15, '1650176479Mohammad Belal Hossain Chowdhury.pdf', 'anando.biswas'),
(330, '00', 'Not Applicable', 'NBR', 'Afroza Sultana Rina', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-10, Dhaka ', 'Saudi Arabia', 'Self', 'EBL', '2022-04-17', '2022-05-06', '0000-00-00', '0000-00-00', 20, '1650176609Afroza Sultana Rina.pdf', 'anando.biswas'),
(331, '00', 'Tax', 'NBR', 'Khandokar Khurshid Kamal', 'Additional Commissioner of Taxes', 4, 'Taxes Zone-13, Dhaka ', 'India', 'Self', 'EBL', '2022-03-30', '2022-04-29', '0000-00-00', '0000-00-00', 31, '1650184946Khandokar Khurshid Kamal.pdf', 'anando.biswas'),
(332, '200126', 'Tax', 'NBR', 'Maqbul Hossain Paik', 'Member', 3, 'Taxes Appellate Tribunal, Chattogram Bench-Chattogram ', 'India', 'Self', 'EBL', '2022-04-27', '2022-05-10', '0000-00-00', '0000-00-00', 14, '1650254622Maqbul Hossain Paik.pdf', 'anando.biswas'),
(333, '300100', 'Customs', 'NBR', 'M. Sofiuzzaman', 'First Secretary', 5, 'Deputy Project Director, National Single Window Project', 'Saudi Arabia', 'Self', 'EBL', '2022-04-18', '2022-05-02', '0000-00-00', '0000-00-00', 15, '1650262650M. Sofiuzzaman.pdf', 'anando.biswas'),
(334, '00', 'Not Applicable', 'CEVT', 'Md Sohel Ahmed', 'Member', 3, 'Customs, Excise and VAT Appellate Tribunal, Dhaka', 'Thailand', 'Self', 'EBL', '2022-07-04', '2022-07-15', '0000-00-00', '0000-00-00', 12, '1650352427Md Sohel Ahmed.pdf', 'anando.biswas'),
(335, '00', 'Customs', 'NBR', 'Imam Gazzali ', 'Second Secretary', 6, 'National Board of Revenue, Dhaka.', 'Korea South', 'IO', 'Official Trip', '2022-05-03', '2022-05-05', '0000-00-00', '0000-00-00', 3, '1650352678Imam Gazzali.pdf', 'anando.biswas'),
(336, '00', 'Customs', 'NBR', 'H. M. Ahsanul Kabir', 'Deputy Commissioner', 6, 'Custom House, Benapole.', 'Korea South', 'GoB', 'Official Trip', '2022-05-03', '2022-05-05', '0000-00-00', '0000-00-00', 3, '1650352787H. M. Ahsanul Kabir.pdf', 'anando.biswas'),
(337, '200155', 'Tax', 'NBR', 'Swapan Kumar Roy', 'Commissioner of Taxes', 3, 'Taxes Zone-11, Dhaka ', 'United States of America', 'Self', 'EBL', '2022-04-20', '2022-05-04', '0000-00-00', '0000-00-00', 15, '1650444541Mr. Swapan Kumar Roy.pdf', 'anando.biswas'),
(338, '00', 'Tax', 'NBR', 'Md. Mahbubur Rahman', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-01, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-04-26', '2022-05-10', '0000-00-00', '0000-00-00', 15, '1650444673Md. Mahbubur Rahman.pdf', 'anando.biswas'),
(339, '00', 'Tax', 'NBR', 'Md. Mohtashibur Rahman Khan', 'First Secretary', 5, 'National Board of Revenue', 'United States of America', 'Self', 'EBL', '2022-04-19', '2022-05-07', '0000-00-00', '0000-00-00', 19, '1650444778Md. Mohtashibur Rahman Khan.pdf', 'anando.biswas'),
(340, '200457', 'Tax', 'NBR', 'Abdullah Al Mamun', 'Deputy Commissioner of Taxes', 6, 'Taxes, Taxes Zone-6, Dhaka', 'India', 'Self', 'EBL', '2022-04-26', '2022-05-14', '0000-00-00', '0000-00-00', 19, '1650858139Abdullah Al Mamun.pdf', 'anando.biswas'),
(341, '00', 'Tax', 'NBR', 'Mohammod Abdur Raquib', 'Additional Commissioner of Taxes (Current Charge', 4, 'Taxes Zone-1, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-04-18', '2022-05-02', '0000-00-00', '0000-00-00', 15, '1650862350Mohammod Abdur Raquib.pdf', 'anando.biswas'),
(342, '300378', 'Customs', 'NBR', 'Md. Billal Hossain', 'Deputy Commissioner', 6, 'Custom House, ICD', 'Thailand', 'Self', 'EBL', '2022-04-29', '2022-05-13', '0000-00-00', '0000-00-00', 15, '1650959781Md. Billal Hossain.pdf', 'anando.biswas'),
(343, '200432', 'Tax', 'NBR', 'Tarongo Kumar Mondol', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-7, Dhaka', 'India', 'Self', 'EBL', '2022-04-29', '2022-05-08', '0000-00-00', '0000-00-00', 10, '1651031454Tarongo Kumar Mondol.pdf', 'anando.biswas'),
(344, '300192', 'Customs', 'NBR', 'Md. Zahidul Istam', 'Deputy Director', 6, 'Customs, Excise and VAT Training Academy, Chattogram', 'Saudi Arabia', 'Self', 'EBL', '2022-05-01', '2022-05-10', '0000-00-00', '0000-00-00', 10, '1651117171Md. Zahidul Islam.pdf', 'anando.biswas'),
(345, '00', 'Not Applicable', 'NBR', 'Md. Mostofa Kamal', 'Assistant Director (Current Charge)', 9, 'Duty Exemption and Drawback Office, Dhaka', 'India', 'Self', 'EBL', '2022-04-30', '2022-05-09', '0000-00-00', '0000-00-00', 10, '1651987007Md. Mostofa Kamal.pdf', 'anando.biswas'),
(346, '00', 'Non Cadre', 'NBR', 'Dipak Kumar Mozumder', 'Revenue Officer', 9, 'Customs, Excise and VAT Commissionerate, Dhaka (East), Dhaka', 'India', 'Self', 'EBL', '2022-05-06', '2022-05-20', '0000-00-00', '0000-00-00', 15, '1652066390Dipak Kumar Mozumder.pdf', 'anando.biswas'),
(347, '300182', 'Customs', 'NBR', 'Razvee Ahmed', 'Joint Commissioner', 5, 'Customs Excise and VAT Commissionerate, Dhaka (South), Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-05-05', '2022-05-19', '0000-00-00', '0000-00-00', 15, '1652066515Razvee Ahmed.pdf', 'anando.biswas'),
(348, '200526', 'Tax', 'NBR', 'S. M. Bashir Ahmed', 'Deputy Commissioner of Taxes', 6, 'Large Taxpayer Unit (LTU), Dhaka ', 'Nepal', 'University', 'Study Leave', '2022-05-08', '2025-05-07', '0000-00-00', '0000-00-00', 1096, '1652066792S. M. Bashir Ahmed.pdf', 'anando.biswas'),
(349, '300215', 'Customs', 'NBR', 'Nazmun Naher Kaisar', 'Deputy Commissioner', 6, 'Customs Excise and VAT Commissionerate, Dhaka (East), Dhaka', 'Australia', 'University', 'Deputation', '2022-06-07', '2022-12-20', '0000-00-00', '0000-00-00', 197, '1652079765getContent (66).pdf', 'moinul.alam'),
(350, '300187', 'Customs', 'NBR', 'Mohibbur Rahman Bhuiyan', 'Joint Commissioner', 5, 'Custom House, Mongla', 'Thailand', 'Self', 'EBL', '2022-05-15', '2022-05-29', '0000-00-00', '0000-00-00', 15, '1652334058go mohibbur.pdf', 'moinul.alam'),
(351, '00', 'Tax', 'NBR', 'Umme Ayman Kashmi', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone15, Dhaka', 'India', 'Self', 'EBL', '2022-05-25', '2022-06-08', '0000-00-00', '0000-00-00', 15, '1652674454Umme Ayman Kashmi.pdf', 'anando.biswas'),
(352, '300320', 'Customs', 'NBR', 'Md. Mahfuz Alam', 'Deputy Commissioner', 6, 'Custom House, Chattogram', 'Thailand', 'Self', 'EBL', '2022-05-16', '2022-05-30', '0000-00-00', '0000-00-00', 15, '1652779294Md. Mahfuz Alam.pdf', 'anando.biswas'),
(353, '200558', 'Tax', 'NBR', 'Kazi Rukaiya Sultana', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-11, Dhaka', 'Australia', 'University', 'Deputation', '2022-05-29', '2024-07-31', '0000-00-00', '0000-00-00', 795, '1652844356Kazi Rukaiya Sultana.pdf', 'anando.biswas'),
(354, '00', 'Non Cadre', 'NBR', 'Md. Hafizur Rahman', 'Statistics Officer', 9, 'National Board of Revenue, Dhaka ', 'India', 'Self', 'EBL', '2022-05-27', '2022-06-10', '0000-00-00', '0000-00-00', 15, '1652958253Md. Hafizur Rahman.pdf', 'anando.biswas'),
(355, '0', 'Not Applicable', 'IRD', 'Mrs. Modhumita Akter', 'Accountant', 12, 'Internal Resources Division, Ministry of Finance', 'India', 'Self', 'EBL', '2022-05-29', '2022-06-04', '0000-00-00', '0000-00-00', 7, '1653372175IRD_0001.pdf', 'anando.biswas'),
(356, '300093', 'Customs', 'NBR', 'Sheikh Abu Faisal Md Murad', 'First Secretary', 5, 'National Board of Revenue, Dhaka', 'United States of America', 'Self', 'EBL', '2022-08-01', '2022-08-30', '0000-00-00', '0000-00-00', 30, '1653382284Sheikh Abu Faisal Md Murad.pdf', 'anando.biswas'),
(357, '4172', 'Administration', 'IRD', 'Md Shafiqur Rahman', 'Joint Secretary', 3, 'Internal Resources Division, Ministry of Finance', 'Turkey', 'BO', 'Official Trip', '2022-05-29', '2022-06-05', '0000-00-00', '0000-00-00', 8, '1653804003IMG_0002 (1).pdf', 'moinul.alam'),
(358, '300063', 'Customs', 'NBR', 'Kazi Mostafizur Rahman', 'Commissioner', 3, 'Customs Bond Commissionerate, Dhaka', 'Turkey', 'BO', 'Official Trip', '2022-05-29', '2022-06-05', '0000-00-00', '0000-00-00', 8, '1653809071IMG_0002 (1).pdf', 'moinul.alam'),
(359, '300116', 'Customs', 'NBR', 'S.M Shohel Rahman', 'Additional Commissioner', 4, 'Customs Excise and VAT Commissionerate, Rajshahi.', 'Turkey', 'BO', 'Official Trip', '2022-05-29', '2022-06-05', '0000-00-00', '0000-00-00', 8, '1653811252IMG_0002 (1).pdf', 'moinul.alam'),
(360, '0', 'Non Cadre', 'NBR', 'Golam Sarwar', 'Assistant Programmer', 9, 'National Board of Revenue, Dhaka', 'Turkey', 'BO', 'Official Trip', '2022-05-29', '2022-06-05', '0000-00-00', '0000-00-00', 8, '1653811548IMG_0002 (1).pdf', 'moinul.alam'),
(361, '200287', 'Tax', 'NBR', 'Mrs. Hasina Akter Khan', 'Joint Commissioner of Taxes', 5, 'BCS (Tax) academy, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-06-19', '2022-07-28', '0000-00-00', '0000-00-00', 40, '1653905244getContent (2).pdf', 'moinul.alam'),
(362, '300139', 'Customs', 'NBR', 'A. A. M. Amimul Ehsan Khan', 'First Secretary', 5, 'National Board of Revenue, Dhaka', 'Bangladesh', 'Others', 'Lien', '2022-06-01', '2024-05-30', '0000-00-00', '0000-00-00', 730, '1653906713getContent (77).pdf', 'moinul.alam'),
(363, '00', 'Non Cadre', 'NBR', 'Md. Mostakimul Yeazdani Chowdhury', 'Revenue Officer', 9, 'Audit Intelligence and Investigation Directorate, VAT, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-06-05', '2022-07-19', '0000-00-00', '0000-00-00', 45, '1653967906Md. Mostakimul Yeazdani Chowdhury.pdf', 'anando.biswas'),
(364, '300329', 'Customs', 'NBR', 'Md. Pervaz Al Zaman', 'Deputy Commissioner', 6, 'Customs, Excise & VAT Commissionarate. Jashore', 'Turkey', 'Others', 'Official Trip', '2022-05-29', '2022-06-05', '0000-00-00', '0000-00-00', 8, '1653994173Md. Pervaz-Al-Jaman.pdf', 'anando.biswas'),
(365, '300077', 'Customs', 'NBR', 'Syed Mushfequr Rahman', 'Commissioner', 3, 'Customs Excise & VAT Commissionerate, Dhaka (West), Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-06-20', '2022-07-24', '0000-00-00', '0000-00-00', 35, '1654053957Syed Mushfequr Rahman.pdf', 'anando.biswas'),
(366, '300044', 'Customs', 'NBR', 'SM Humayun Kabir', 'President', 2, 'Customs Excise and VAT Appellate Tribunal, Dhaka ', 'Saudi Arabia', 'Self', 'EBL', '2022-07-01', '2022-07-17', '0000-00-00', '0000-00-00', 17, '1654054181SM Humayun Kabir.pdf', 'anando.biswas'),
(367, '0', 'Not Applicable', 'NBR', 'Yasmin Akhter Shahnur', 'Assistant Commissioner', 9, 'Custom House, Benapole', 'India', 'Self', 'EBL', '2022-05-27', '2022-06-02', '0000-00-00', '0000-00-00', 7, '1654065771GO of Yeasmin Akther Shahnur.pdf', 'moinul.alam'),
(368, '00', 'Tax', 'NBR', 'Md. Shajidul Islam', 'Second Secretary', 6, 'National Board of Revenue (NBR), Dhaka ', 'United Kingdom', 'Self', 'EBL', '2022-04-26', '2022-05-28', '0000-00-00', '0000-00-00', 33, '1654142523Md. Shajidul Islam.pdf', 'anando.biswas'),
(369, '6916', 'Administration', 'IRD', 'S M Abdul Kader', 'Deputy Secretary', 6, 'Internal Resources Division', 'Thailand', 'Self', 'EBL', '2022-06-03', '2022-06-09', '0000-00-00', '0000-00-00', 7, '1654149797S M Abdul Kader.pdf', 'anando.biswas'),
(370, '00', 'Customs', 'NBR', 'Md Masud Sadiq', 'Member', 1, 'National Board of Revenue', 'Belgium', 'GoB', 'Official Trip', '2022-06-20', '2022-06-25', '0000-00-00', '0000-00-00', 6, '1654155333Md Masud Sadiq.pdf', 'anando.biswas'),
(371, '00', 'Customs', 'NBR', 'Md. Khairul Kabir Mia', 'First Secretary', 5, 'National Board of Revenue', 'Belgium', 'GoB', 'Official Trip', '2022-06-20', '2022-06-25', '0000-00-00', '0000-00-00', 6, '1654155496Md. Khairul Kabir Mia.pdf', 'anando.biswas'),
(372, '00', 'Non Cadre', 'NBR', 'Mohammad Saiful Islam Talukder', 'Revenue Officer', 9, 'Customs Excise and Vat Commissionerate, Dhaka (South), Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-06-03', '2022-07-17', '0000-00-00', '0000-00-00', 45, '1654401308Mohammad Saiful Islam Talukder.pdf', 'anando.biswas'),
(373, '00', 'Non Cadre', 'NBR', '  Md. Mostafa Nurul Islam', 'Programmer', 6, 'BCS (Tax) Academy, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-06-10', '2022-07-24', '0000-00-00', '0000-00-00', 45, '1654401524Md. Mostafa Nurul Islam.pdf', 'anando.biswas'),
(374, '300268', 'Customs', 'NBR', 'Mst. Iftakhar Jahan', 'Deputy Commissioner', 6, 'Customs Bond Commissionerate, Dhaka.', 'India', 'Self', 'EBL', '2022-06-16', '2022-06-30', '0000-00-00', '0000-00-00', 15, '1654404411getContent - 2022-06-03T223341.544.pdf', 'moinul.alam'),
(375, '00', 'Tax', 'NBR', 'Md. Zakir Hossain', 'Additional Commissioner of Taxes', 4, 'Taxes Zone-3, Chattogram', 'Saudi Arabia', 'Self', 'EBL', '2022-06-25', '2022-08-08', '0000-00-00', '0000-00-00', 45, '1654589133Md. Zakir Hossain.pdf', 'anando.biswas'),
(376, '200259', 'Tax', 'NBR', 'Md. Mohidul Islam', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-Bogra', 'Saudi Arabia', 'Self', 'EBL', '2022-05-30', '2022-07-14', '0000-00-00', '0000-00-00', 46, '1654589250Md. Mohidul Islam.pdf', 'anando.biswas'),
(377, '200300', 'Tax', 'NBR', 'Mohammed Fakrul Islam', 'Joint Commissioner of Taxes', 6, 'Taxes appeal Zone-2, Dhaka ', 'Saudi Arabia', 'Self', 'EBL', '2022-06-25', '2022-08-05', '0000-00-00', '0000-00-00', 42, '1654589768Mohammed Fakrul Islam.pdf', 'anando.biswas'),
(378, '200315', 'Tax', 'NBR', 'Mohammad Morshed Uddin Khan', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-13, Dhaka', 'Australia', 'University', 'Study Leave', '2022-07-21', '2024-07-20', '0000-00-00', '0000-00-00', 731, '1654590095Mohammad Morshed Uddin Khan.pdf', 'anando.biswas'),
(379, '00', 'Non Cadre', 'NBR', 'Salma Akter', 'Revenue Officer', 9, 'Large Taxpayers Unit, Value Added Tax, Dhaka ', 'Saudi Arabia', 'Self', 'EBL', '2022-06-07', '2022-07-21', '0000-00-00', '0000-00-00', 45, '1654590880Salma Akter.pdf', 'anando.biswas'),
(380, '300134', 'Customs', 'NBR', 'Dr. Md. Neyamul Islam', 'First Secretary', 5, 'National Board of Revenue, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-06-12', '2022-07-26', '0000-00-00', '0000-00-00', 45, '1654682653Dr. Md. Neyamul Islam.pdf', 'anando.biswas'),
(381, '300191', 'Customs', 'NBR', 'Hasnain Mahmood ', 'Joint Commissioner', 5, 'Customs, Excise & VAT Commissionerate, Rajshahi', 'Canada', 'Others', 'EBL', '2022-07-03', '2022-07-30', '0000-00-00', '0000-00-00', 28, '1654755501Hasnain Mahmood.pdf', 'anando.biswas'),
(382, '300031', 'Customs', 'NBR', 'Abdul Mannan Shikder', 'Member', 1, ', National Board or Revenue, Dhaka ', 'Canada', 'Others', 'EBL', '2022-06-20', '2022-07-19', '0000-00-00', '0000-00-00', 30, '1655019865Abdul Mannan Shikder.pdf', 'anando.biswas'),
(383, '00', 'Non Cadre', 'NBR', 'Md. Jalal Uddin', 'Revenue Officer', 9, 'Customs Excise & VAT Commissionerate, Chattogram ', 'Saudi Arabia', 'Self', 'EBL', '2022-06-10', '2022-07-24', '0000-00-00', '0000-00-00', 45, '1655019967Md. Jalal Uddin.pdf', 'anando.biswas'),
(384, '00', 'Non Cadre', 'NBR', 'Md. Mostofa Kamal', 'Assistant Director (Current Charge)', 10, 'Duty Exemption and Drawback Office, Dhaka', 'India', 'Self', 'EBL', '2022-06-09', '2022-07-03', '0000-00-00', '0000-00-00', 25, '1655020108Md. Mostofa Kamal.pdf', 'anando.biswas'),
(385, '00', 'Non Cadre', 'NBR', 'Jannatul Ferdous', 'Assistant Commissioner', 9, 'Customs Excise and VAT (Appeal) Commissionerate, Dhaka-1, Dh', 'Saudi Arabia', 'Self', 'EBL', '2022-06-12', '2022-07-26', '0000-00-00', '0000-00-00', 45, '1655020223Jannatul Ferdous.pdf', 'anando.biswas'),
(386, '00', 'Non Cadre', 'NBR', 'G.M Nasir Uddin', 'Revenue Officer', 9, 'Customs Excise and Vat (Appeal) Commissionerate, Khulna', 'Saudi Arabia', 'Self', 'EBL', '2022-06-19', '2022-08-02', '0000-00-00', '0000-00-00', 45, '1655020304G.M Nasir Uddin.pdf', 'anando.biswas'),
(387, '00', 'Non Cadre', 'NBR', 'Md Maniruzzaman Mia', 'Revenue Officer', 9, 'Customs Excise and Vat Commissionerate, Dhaka (South), Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-06-17', '2022-07-31', '0000-00-00', '0000-00-00', 45, '1655020394Md Maniruzzaman Mia.pdf', 'anando.biswas'),
(388, '300079', 'Customs', 'NBR', 'Mohammad Lutfor Rahman', 'Commissioner', 3, 'Customs, Excise & VAT Commissionerate, Rajshahi', 'United Kingdom', 'Self', 'EBL', '2022-07-08', '2022-07-28', '0000-00-00', '0000-00-00', 21, '1655020497Mohammad Lutfor Rahman.pdf', 'anando.biswas'),
(389, '200524', 'Tax', 'NBR', 'Nawab Siraj Oud Daula', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone- Rajshahi ', 'Saudi Arabia', 'Self', 'EBL', '2022-06-15', '2022-07-30', '0000-00-00', '0000-00-00', 46, '1655023636Nawab Siraj Oud Daula.pdf', 'anando.biswas'),
(390, '700168', 'Tax', 'NBR', 'Arina Begum', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-4, Chattogram ', 'Saudi Arabia', 'Self', 'EBL', '2022-06-05', '2022-08-03', '0000-00-00', '0000-00-00', 60, '1655023733Arina Begum.pdf', 'anando.biswas'),
(391, '200213', 'Tax', 'NBR', 'Md. Shah Ali', 'Additional Commissioner of Taxes', 4, ', Taxes Zone- 7, Dhaka ', 'Canada', 'Self', 'EBL', '2022-08-21', '2022-09-15', '0000-00-00', '0000-00-00', 26, '1655023862Md. Shah Ali.pdf', 'anando.biswas'),
(392, '200129', 'Tax', 'NBR', 'A K M Badiul Alam', 'Commissioner of Taxes', 3, 'Taxes Zone-1, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-07-01', '2022-07-30', '0000-00-00', '0000-00-00', 30, '1655093964A K M Badiul Alam.pdf', 'anando.biswas'),
(393, '00', 'Non Cadre', 'NBR', 'Md. Ayub Ali', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone- Cumilla', 'Saudi Arabia', 'Self', 'EBL', '2022-06-15', '2022-07-29', '0000-00-00', '0000-00-00', 45, '1655178096Md. Ayub Ali.pdf', 'anando.biswas'),
(394, '200147', 'Tax', 'NBR', 'Md. Asaduzzaman', 'Member', 3, 'Taxes Appellate Tribunal, Division Bench- Rangpur', 'Saudi Arabia', 'Self', 'EBL', '2022-06-20', '2022-07-25', '0000-00-00', '0000-00-00', 36, '1655272635Md. Asaduzzaman.pdf', 'anando.biswas'),
(395, '300310', 'Customs', 'NBR', 'H M Ahsanul Kabir', 'Deputy Commissioner', 6, 'Custom House, Benapole, Jessore ', 'Saudi Arabia', 'Self', 'EBL', '2022-06-17', '2022-07-23', '0000-00-00', '0000-00-00', 37, '1655272831H M Ahsanul Kabir.pdf', 'anando.biswas'),
(396, '300377', 'Customs', 'NBR', 'Kazi Raihanuj Jaman', 'Deputy Commissioner', 6, 'Customs Bond Commissionerate, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-06-26', '2022-08-09', '0000-00-00', '0000-00-00', 45, '1655272932Kazi Raihanuj Jaman.pdf', 'anando.biswas'),
(397, '00', 'Non Cadre', 'NBR', 'Md Abdus Sattar', 'Revenue Officer', 9, 'Customs Excise & VAT Commissionerate, Rajshahi', 'Saudi Arabia', 'Self', 'EBL', '2022-06-20', '2022-07-25', '0000-00-00', '0000-00-00', 36, '1655273038Md Abdus Sattar.pdf', 'anando.biswas'),
(398, '00', 'Non Cadre', 'NBR', 'Md. Shahjahan Ali', 'Additional Commissioner (Current Charge', 10, 'Customs Excise & VAT Commissionerate, Dhaka (West), Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-06-14', '2022-07-28', '0000-00-00', '0000-00-00', 45, '1655286843Md. Shahjahan Ali.pdf', 'anando.biswas'),
(399, '300292', 'Customs', 'NBR', 'Nazmun Nahar', 'Second Secretary', 6, ' National Board of Revenue, Dhaka', 'Thailand', 'IO', 'Official Trip', '2022-06-28', '2022-06-30', '0000-00-00', '0000-00-00', 3, '1655705581Nazmun Nahar.pdf', 'anando.biswas'),
(400, '00', 'Non Cadre', 'NBR', 'Mosamat Roksana Begum', 'Revenue Officer', 9, 'Custom House, Chattogram ', 'Saudi Arabia', 'Self', 'EBL', '2022-06-16', '2022-07-30', '0000-00-00', '0000-00-00', 45, '1655783838Mosamat Roksana Begum.pdf', 'anando.biswas'),
(401, '200367', 'Tax', 'NBR', 'A.K.M. Shamsuzzaman', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-1, Chattogram', 'India', 'Self', 'EBL', '2022-07-01', '2022-07-20', '0000-00-00', '0000-00-00', 20, '1655788343A.K.M. Shamsuzzaman.pdf', 'anando.biswas'),
(402, '200291', 'Tax', 'NBR', 'Shah Muhammad Itteda Hasan ', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-15, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-07-02', '2022-07-11', '0000-00-00', '0000-00-00', 10, '1655792738Shah Muhammad Itteda Hasan.pdf', 'anando.biswas'),
(403, '300145', 'Customs', 'NBR', 'Mohammad Shahidul Islam', 'Joint Director', 5, 'Audit Intelligence & Investigation Directorate, Value Added ', 'United Kingdom', 'Self', 'EBL', '2022-07-03', '2022-07-17', '0000-00-00', '0000-00-00', 15, '1655799170Mohammad Shahidul Islam.pdf', 'anando.biswas'),
(404, '00', 'Non Cadre', 'NBR', 'S M Faizul Quadir', 'Inspector', 9, 'Taxes Zone-12, Dhaka', 'Australia', 'University', 'Study Leave', '2022-06-11', '2023-08-07', '0000-00-00', '0000-00-00', 423, '1655961536S M Faizul Quadir.pdf', 'anando.biswas'),
(405, '200171', 'Tax', 'NBR', 'Monju Man Ara Begum', 'Additional Commissioner of Taxes', 4, 'Taxes Appeal Zone-Chattogram', 'India', 'Self', 'EBL', '2022-06-28', '2022-07-17', '0000-00-00', '0000-00-00', 20, '1655961813Monju Man-Ara Begum.pdf', 'anando.biswas'),
(406, '300358', 'Customs', 'NBR', 'Ahmedur Reza Chowdhury ', 'Deputy Director', 6, 'Customs Intelligence and Investigation Directorate, Dhaka ', 'Singapore', 'Self', 'EBL', '2022-07-05', '2022-07-14', '0000-00-00', '0000-00-00', 10, '1655971102Ahmedur Reza Chowdhury.pdf', 'anando.biswas'),
(407, '300321', 'Customs', 'NBR', 'Nasrin Akter Eti ', 'Deputy Commissioner', 6, 'Customs, Excise & VAT Commissionerate, Dhaka (West), Dhaka', 'Thailand', 'Self', 'EBL', '2022-07-17', '2022-07-31', '0000-00-00', '0000-00-00', 15, '1655971231Nasrin Akter Eti.pdf', 'anando.biswas'),
(408, '00', 'Tax', 'NBR', 'Md. Faruqul Islam', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-4, Dhaka', 'Singapore', 'Self', 'EBL', '2022-07-25', '2022-08-04', '0000-00-00', '0000-00-00', 11, '1655971539Md. Faruqul Islam.pdf', 'anando.biswas'),
(409, '300297', 'Customs', 'NBR', 'Md Shamim Ul Alam', 'Deputy Commissioner', 6, 'Custom House, Mongla', 'Singapore', 'Self', 'EBL', '2022-07-16', '2022-07-31', '0000-00-00', '0000-00-00', 16, '1656473784Md Shamim Ul Alam.pdf', 'anando.biswas'),
(410, '300279', 'Customs', 'NBR', 'Uttom Biswas ', 'Deputy Commissioner', 6, 'Customs Excise and VAT Commissionerate, Jessore.', 'India', 'Self', 'EBL', '2022-07-17', '2022-07-31', '0000-00-00', '0000-00-00', 15, '1656494397GO of Uttom Biswas.pdf', 'moinul.alam'),
(411, '300176', 'Customs', 'NBR', 'Md. Tariq Hassan', 'Joint Commissioner', 5, 'Custom House, Chattogram.', 'Thailand', 'Self', 'EBL', '2022-07-14', '2022-07-28', '0000-00-00', '0000-00-00', 15, '1656494497GO of Md Tariq Hassan.pdf', 'moinul.alam'),
(412, '00', 'Tax', 'NBR', 'Mohammad Jahid Hasan', 'Commissioner of Taxes', 3, 'Taxes Zone-6, Dhaka', 'Canada', 'Self', 'EBL', '2022-07-04', '2022-07-17', '0000-00-00', '0000-00-00', 14, '1656565543Mohammad Jahid Hasan.pdf', 'anando.biswas'),
(413, '200470', 'Tax', 'NBR', 'Nusrat Hassan', 'Second Secretary', 6, 'National Board of Revenue, Dhaka', 'Thailand', 'Self', 'EBL', '2022-07-13', '2022-07-27', '0000-00-00', '0000-00-00', 15, '1656566565Nusrat Hassan.pdf', 'anando.biswas'),
(414, '00', 'Tax', 'NBR', 'Md. Mohidul Islam Chowdhury', 'Second Secretary', 6, 'National Board of Revenue, Dhaka', 'Thailand', 'Self', 'EBL', '2022-07-13', '2022-07-17', '0000-00-00', '0000-00-00', 5, '1656576299Md. Mohidul Islam Chowdhury.pdf', 'anando.biswas'),
(415, '300042', 'Customs', 'NBR', 'Dr. Md Shahidul Islam', 'Member', 2, 'National Board of Revenue, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-07-02', '2022-07-20', '0000-00-00', '0000-00-00', 19, '1656576400Dr. Md Shahidul Islam.pdf', 'anando.biswas'),
(416, '300159', 'Customs', 'NBR', 'Mst. Shakila Pervin', 'Joint Commissioner', 5, 'Customs Bond Commissionerate, Dhaka', 'Singapore', 'Self', 'EBL', '2022-07-23', '2022-08-01', '0000-00-00', '0000-00-00', 10, '1656830656Mst. Shakila Pervin.pdf', 'anando.biswas'),
(417, '200225', 'Tax', 'NBR', 'Zeenat Ara', 'Additional Commissioner of Taxes', 4, 'Tax appeal Zone-1, Dhaka', 'Canada', 'Self', 'EBL', '2022-09-01', '2022-09-30', '0000-00-00', '0000-00-00', 30, '1656843046Zeenat Ara.pdf', 'anando.biswas'),
(418, '200255', 'Tax', 'NBR', 'Syed Mohidul Hasan', 'Additional Commissioner of Taxes (Current Charge)', 5, 'Taxes Zone-9, Dhaka', 'United States of America', 'Self', 'EBL', '2022-08-04', '2022-08-23', '0000-00-00', '0000-00-00', 20, '1656843583Syed Mohidul Hasan.pdf', 'anando.biswas'),
(419, '200280', 'Tax', 'NBR', 'Shaikh Shamim Bulbul', 'First Secretary', 5, 'National Board of Revenue, Dhaka', 'India', 'Self', 'EBL', '2022-07-06', '2022-08-19', '0000-00-00', '0000-00-00', 45, '1656905554Shaikh Shamim Bulbul.pdf', 'anando.biswas'),
(420, '200110', 'Tax', 'NBR', 'Md. Mahmudur Rahman', 'Member (Current Charge)', 3, 'National Board of Revenue, Dhaka', 'Singapore', 'Self', 'EBL', '2022-07-14', '2022-07-31', '0000-00-00', '0000-00-00', 18, '1656922254Md. Mahmudur Rahman.pdf', 'anando.biswas'),
(421, '00', 'Non Cadre', 'NBR', 'Shepon Kumer Das', 'Revenue Officer', 9, 'Custom House, Dhaka', 'India', 'Self', 'EBL', '2022-07-06', '2022-07-20', '0000-00-00', '0000-00-00', 15, '1657096343Shepon Kumer Das.pdf', 'anando.biswas'),
(422, '300231', 'Customs', 'NBR', 'Shahed Ahmed', 'Deputy Commissioner', 6, 'Customs Excise and VAT Commissionerate, Chattogram', 'Singapore', 'Self', 'EBL', '2022-07-15', '2022-08-03', '0000-00-00', '0000-00-00', 20, '1657100800IMG_0006.pdf', 'moinul.alam'),
(423, '0', 'Not Applicable', 'NBR', 'Zakir Hossain Chowdhury', 'Assistant Commissioner', 9, 'Custom House, ICD, Kamalapur, Dhaka', 'United States of America', 'Self', 'EBL', '2022-07-08', '2022-07-17', '0000-00-00', '0000-00-00', 10, '1657101100IMG_0005.pdf', 'moinul.alam'),
(424, '300170', 'Customs', 'NBR', 'Nusrat Jahan', 'Joint Commissioner', 5, 'Custom House, Benapole', 'India', 'Self', 'EBL', '2022-07-10', '2022-07-17', '0000-00-00', '0000-00-00', 8, '1657189498Nusrat Jahan.pdf', 'anando.biswas'),
(425, '300197', 'Customs', 'NBR', 'Md. Shafayet Hossain', 'Joint Commissioner', 5, 'Customs Excise and VAT Commissionerate, Jessore', 'Saudi Arabia', 'Self', 'EBL', '2022-08-01', '2022-08-21', '0000-00-00', '0000-00-00', 21, '1657189744Md. Shafayet Hossain.pdf', 'anando.biswas'),
(426, '300178', 'Customs', 'NBR', 'Rafia Sultana', 'Joint Commissioner', 5, 'Customs Excise and VAT Commissionerate, Dhaka (East), Dhaka', 'India', 'Self', 'EBL', '2022-07-07', '2022-07-13', '0000-00-00', '0000-00-00', 7, '1657191612Rafia Sultana.pdf', 'anando.biswas'),
(427, '00', 'Non Cadre', 'NBR', 'Md Zahidur Rahman', 'System Analyst', 5, 'National Board of Revenue, Dhaka', 'Malaysia', 'IO', 'Official Trip', '2022-07-18', '2022-07-29', '0000-00-00', '0000-00-00', 12, '1658042582Md Zahidur Rahman.pdf', 'anando.biswas'),
(428, '00', 'Non Cadre', 'NBR', 'Golam Sarwar', 'Programmer', 6, 'National Board of Revenue, Dhaka', 'Malaysia', 'IO', 'Official Trip', '2022-07-18', '2022-07-29', '0000-00-00', '0000-00-00', 12, '1658042633Golam Sarwar.pdf', 'anando.biswas'),
(429, '00', 'Non Cadre', 'NBR', 'Kamrun Naher Maya', 'Assistant Programmer', 9, 'National Board of Revenue, Dhaka', 'Malaysia', 'IO', 'Official Trip', '2022-07-18', '2022-07-29', '0000-00-00', '0000-00-00', 12, '1658042700Kamrun Naher Maya.pdf', 'anando.biswas'),
(430, '00', 'Non Cadre', 'NBR', 'Md. Amirul Islam Jiban', 'Assistant Programmer', 9, 'National Board of Revenue, Dhaka', 'Malaysia', 'IO', 'Official Trip', '2022-07-18', '2022-07-29', '0000-00-00', '0000-00-00', 12, '1658042758Md. Amirul Islam Jiban.pdf', 'anando.biswas'),
(431, '00', 'Non Cadre', 'NBR', 'Md. Ronju Mia', 'Assistant Programmer', 9, 'National Board of Revenue, Dhaka', 'Malaysia', 'IO', 'Official Trip', '2022-07-18', '2022-07-29', '0000-00-00', '0000-00-00', 12, '1658042812Md. Ronju Mia.pdf', 'anando.biswas'),
(432, '00', 'Non Cadre', 'NBR', 'Istiaq Akbar', 'Assistant Programmer', 9, 'National Board of Revenue, Dhaka', 'Malaysia', 'IO', 'Official Trip', '2022-07-18', '2022-07-29', '0000-00-00', '0000-00-00', 12, '1658042871Istiaq Akbar.pdf', 'anando.biswas'),
(433, '200312', 'Tax', 'NBR', 'Mohammad Abdullah', 'Joint Commissioner of Taxes', 5, 'Taxes Zone12, Dhaka', 'India', 'Self', 'EBL', '2022-07-17', '2022-07-31', '0000-00-00', '0000-00-00', 15, '1658122469Mohammad Abdullah.pdf', 'anando.biswas'),
(434, '00', 'Tax', 'NBR', 'Shadhon Kumar Ray', 'Additional Commissioner of Taxes', 3, 'Taxes Appeal Zone-3, Dhaka', 'India', 'Self', 'EBL', '2022-08-05', '2022-08-19', '0000-00-00', '0000-00-00', 15, '1658658146Shadhon Kumar Ray.pdf', 'anando.biswas'),
(435, '300262', 'Customs', 'NBR', 'Md. Mustafizur Rahman', 'Deputy Commissioner', 6, 'Custom House, Benapole', 'Thailand', 'Self', 'EBL', '2022-09-01', '2022-09-17', '0000-00-00', '0000-00-00', 17, '1658658265Md. Mustafizur Rahman.pdf', 'anando.biswas'),
(436, '00', 'Customs', 'NBR', 'Kazi Mostafizur Rahman', 'Commissioner', 2, 'Customs Bond Commissionerate, Dhaka', 'Malaysia', 'Others', 'EBL', '2022-07-15', '2022-07-20', '0000-00-00', '0000-00-00', 6, '1658821092Kazi Mostafizur Rahman.pdf', 'anando.biswas'),
(437, '00', 'Administration', 'IRD', 'Suraiya Pervin Shelley', 'Joint Secretary', 3, 'Internal Resources Division', 'Malaysia', 'Others', 'EBL', '2022-07-15', '2022-07-20', '0000-00-00', '0000-00-00', 6, '1658821305Suraiya Pervin Shelley.pdf', 'anando.biswas'),
(438, '00', 'Customs', 'NBR', 'Md. Eidtazul Islam', 'First Secretary', 3, 'National Board of Revenue, Dhaka', 'Malaysia', 'Others', 'EBL', '2022-07-15', '2022-07-20', '0000-00-00', '0000-00-00', 6, '1658821445Md. Eidtazul Islam.pdf', 'anando.biswas'),
(439, '00', 'Customs', 'NBR', 'Md. Abdul Hakim', 'Additional Commissioner', 4, 'Customs Excise e VAT Commissionerate, Comilla', 'Malaysia', 'Others', 'EBL', '2022-07-15', '2022-07-20', '0000-00-00', '0000-00-00', 6, '1658821881Md. Abdul Hakim.pdf', 'anando.biswas'),
(440, '00', 'Customs', 'NBR', 'Md. Mosiur Rahman', 'Additional Commissioner', 4, 'Custom House, Dhaka.', 'Malaysia', 'Others', 'EBL', '2022-07-15', '2022-07-20', '0000-00-00', '0000-00-00', 6, '1658821940Md. Mosiur Rahman.pdf', 'anando.biswas'),
(441, '00', 'Customs', 'NBR', 'Md. Bodruzzaman Munshi', 'Deputy Commissioner', 6, 'Custom House, Dhaka.', 'Malaysia', 'Others', 'EBL', '2022-07-15', '2022-07-20', '0000-00-00', '0000-00-00', 6, '1658822008Md. Bodruzzaman Munshi.pdf', 'anando.biswas'),
(442, '200615', 'Tax', 'NBR', 'Arpa Banik', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone, Sylhet', 'India', 'Self', 'EBL', '2022-07-24', '2022-08-07', '0000-00-00', '0000-00-00', 15, '1658893099Arpa Banik.pdf', 'anando.biswas'),
(443, '00', 'Non Cadre', 'NBR', 'Md Masud Karim', 'Revenue Officer', 9, 'Customs Excise & VAT Commissionerate, Rajshahi ', 'India', 'Self', 'EBL', '2022-07-31', '2022-08-24', '0000-00-00', '0000-00-00', 25, '1658893219Md Masud Karim.pdf', 'anando.biswas'),
(444, '200164', 'Tax', 'NBR', 'Mrs. Rownak Afroze', 'Chairman', 3, 'Taxes Appeal Zone-2, Dhaka', 'Canada', 'Self', 'EBL', '2022-08-21', '2022-09-22', '0000-00-00', '0000-00-00', 33, '1658901211Mrs. Rownak Afroze.pdf', 'anando.biswas'),
(445, '200513', 'Tax', 'NBR', 'Awrange Jeb Khan', 'Deputy Commissioner of Taxes', 6, 'Taxes ZoneSylhet', 'Thailand', 'Self', 'EBL', '2022-08-07', '2022-08-30', '0000-00-00', '0000-00-00', 24, '1659256379Awrange Jeb Khan.pdf', 'anando.biswas'),
(446, '200580', 'Tax', 'NBR', 'Pritish Biswas', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-6, Dhaka', 'India', 'Self', 'EBL', '2022-08-05', '2022-08-14', '0000-00-00', '0000-00-00', 10, '1659342012Pritish Biswas.pdf', 'anando.biswas'),
(447, '200452', 'Tax', 'NBR', 'Md. Golam Kibria', 'Second Secretary', 6, 'National Board of Revenue, Dhaka', 'India', 'Self', 'EBL', '2022-08-08', '2022-08-17', '0000-00-00', '0000-00-00', 10, '1659423638Md. Golam Kibria.pdf', 'anando.biswas'),
(448, '00', 'Tax', 'NBR', 'Mohammad Zakir Hossain', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone-2, Dhaka ', 'India', 'Self', 'EBL', '2022-08-12', '2022-08-20', '0000-00-00', '0000-00-00', 9, '1659432555Mohammad Zakir Hossain.pdf', 'anando.biswas'),
(449, '00', 'Customs', 'NBR', 'Mohammad Salahuddin Rizvi', 'Joint Commissioner', 5, 'Custom House, Chattogram', 'Belgium', 'GoB', 'Lien', '2022-09-15', '2023-07-14', '0000-00-00', '0000-00-00', 303, '1660190873Mohammad Salahuddin Rizvi.pdf', 'anando.biswas'),
(450, '4172', 'Administration', 'IRD', 'Mr. Md. Shafiqur Rahman', 'Joint Secretary', 3, 'IRD', 'Singapore', 'Self', 'EBL', '2022-08-10', '2022-08-24', '0000-00-00', '0000-00-00', 15, '1660191879getContent.pdf', 'irdmof'),
(451, '200516', 'Tax', 'NBR', 'Md. Omar Faruq Khan', 'Deputy Director', 6, 'Central Intelligence Cell', 'India', 'Self', 'EBL', '2022-09-12', '2022-09-18', '0000-00-00', '0000-00-00', 7, '1660208780Md. Omar Faruq Khan.pdf', 'anando.biswas'),
(452, '300081', 'Customs', 'NBR', 'Mobara Khanam', 'Commissioner', 3, 'Customs Excise and VAT Commissionerate, Dhaka (West), Dhaka', 'Singapore', 'Self', 'EBL', '2022-09-11', '2022-09-22', '0000-00-00', '0000-00-00', 12, '1660620061Mobara Khanam.pdf', 'anando.biswas'),
(453, '300246', 'Customs', 'NBR', 'Syed Ahmmed Rubel', 'Deputy Commissioner', 6, 'Customs Excise and VAT Commissionerate, Chattogram', 'France', 'Others', 'Deputation', '2022-09-26', '2023-09-25', '0000-00-00', '0000-00-00', 365, '1660620253Syed Ahmmed Rubel.pdf', 'anando.biswas'),
(454, '300099', 'Customs', 'NBR', 'AKM Nurul Huda Azad', 'Commissioner (Current Charge', 4, 'Custom House, Dhaka ', 'Singapore', 'IO', 'Official Trip', '2022-08-29', '2022-09-01', '0000-00-00', '0000-00-00', 4, '1660620402AKM Nurul Huda Azad.pdf', 'anando.biswas'),
(456, '200151', 'Tax', 'TAT', 'Md. Rafiqul Islam Chowdhury', 'Member', 3, 'Taxes Appeallate Tribunal, Dhaka ', 'Thailand', 'Self', 'EBL', '2022-08-21', '2022-09-04', '0000-00-00', '0000-00-00', 15, '1661076428Md. Rafiqul Islam Chowdhury.pdf', 'anando.biswas'),
(457, '300079', 'Customs', 'NBR', 'Mohammad Lutfor Rahman', 'Commissioner', 3, 'r, Customs, Excise & VAT Commissionerate, Rajshahi', 'United Kingdom', 'Others', 'EBL', '2022-08-27', '2022-09-16', '0000-00-00', '0000-00-00', 21, '1661076559Mohammad Lutfor Rahman.pdf', 'anando.biswas');
INSERT INTO `foreignvisit` (`ID`, `ServiceID`, `Cadre`, `Office`, `Name`, `Designation`, `Grade`, `Workplace`, `DestinationCountry`, `FundingSource`, `Purpose`, `StartDate`, `EndDate`, `ActualArrival`, `ActualDeparture`, `Days`, `GO`, `Uploader`) VALUES
(458, '300295', 'Customs', 'NBR', 'Md Shahiduzzaman Sarkar', 'Second Secretary', 5, 'National Board of Revenue, Dhaka', 'Korea South', 'IO', 'EBL', '2022-08-29', '2022-09-09', '0000-00-00', '0000-00-00', 12, '1661076705Md Shahiduzzaman Sarkar.pdf', 'anando.biswas'),
(459, '300095', 'Customs', 'NBR', 'Kazi Tauhida Akther', 'Commissioner (Current Charge', 4, 'Custom House, Pangaon, Dhaka', 'Singapore', 'Others', 'EBL', '2022-08-28', '2022-09-08', '0000-00-00', '0000-00-00', 12, '1661076940Kazi Tauhida Akther.pdf', 'anando.biswas'),
(460, '300174', 'Customs', 'NBR', 'Ayasha Akter', 'Joint Commissioner', 5, 'Customs Excise and VAT Commissionerate, Dhaka (West), Dhaka', 'Singapore', 'Self', 'EBL', '2022-09-11', '2022-09-25', '0000-00-00', '0000-00-00', 15, '1661164905Ayasha Akter.pdf', 'anando.biswas'),
(461, '00', 'Customs', 'NBR', 'Nipun Chakma ', 'Deputy Commissioner', 6, 'Bond Management Automation Project, Dhaka', 'Indonesia', 'IO', 'Official Trip', '2022-10-02', '2022-10-08', '0000-00-00', '0000-00-00', 7, '1661235712Nipun Chakma.pdf', 'anando.biswas'),
(462, '00', 'Customs', 'NBR', 'Shagufta Mahjabin', 'Deputy Commissioner', 6, 'Custom House, Dhaka.', 'Indonesia', 'IO', 'Official Trip', '2022-10-02', '2022-10-08', '0000-00-00', '0000-00-00', 7, '1661235784Shagufta Mahjabin.pdf', 'anando.biswas'),
(463, '300326', 'Customs', 'NBR', 'Nazma Zabin', 'Deputy Director', 6, 'Customs Intelligence and Investigation, Directorate, Dhaka', 'Italy', 'Self', 'EBL', '2022-09-10', '2022-09-24', '0000-00-00', '0000-00-00', 15, '1661754442Nazma Zabin.pdf', 'anando.biswas'),
(464, '300151', 'Customs', 'NBR', 'Md. Tofayel Ahmed', 'Joint Commissioner', 5, 'Custom House, Chattogram', 'Korea South', 'IO', 'Official Trip', '2022-10-19', '2022-10-28', '0000-00-00', '0000-00-00', 10, '1662017330Md. Tofayel Ahmed.pdf', 'anando.biswas'),
(465, '00', 'Tax', 'NBR', 'Farid Ahmed ', 'Additional Commissioner of Taxes', 4, 'Additional Commissioner of Taxes', 'India', 'IO', 'Official Trip', '2022-09-12', '2022-09-16', '0000-00-00', '0000-00-00', 5, '1662450623Farid Ahmed.pdf', 'anando.biswas'),
(466, '00', 'Customs', 'NBR', 'Ferdousi Mahbub ', 'Deputy Commissioner', 6, 'Customs Excise and VAT Commissionerate, Dhaka (North), Dhaka', 'India', 'IO', 'Official Trip', '2022-09-12', '2022-09-16', '0000-00-00', '0000-00-00', 5, '1662450698Ferdousi Mahbub.pdf', 'anando.biswas'),
(467, '00', 'Customs', 'NBR', 'Othello Chowdhury', 'Deputy Director', 6, 'Audit, Intelligence & Investigation Directorate, VAT, Dhaka.', 'India', 'IO', 'Official Trip', '2022-09-12', '2022-09-16', '0000-00-00', '0000-00-00', 5, '1662450763Othello Chowdhury.pdf', 'anando.biswas'),
(468, '00', 'Customs', 'NBR', 'Nazmun Nahar ', 'Second Secretary', 6, 'National Board of Revenue, Dhaka.', 'India', 'IO', 'Official Trip', '2022-09-12', '2022-09-16', '0000-00-00', '0000-00-00', 5, '1662450889Nazmun Nahar.pdf', 'anando.biswas'),
(469, '00', 'Tax', 'NBR', 'Ayesha Siddiqua ', 'Second Secretary', 6, ' National Board of Revenue, Dhaka', 'India', 'IO', 'Official Trip', '2022-09-12', '2022-09-16', '0000-00-00', '0000-00-00', 5, '1662451085Ayesha Siddiqua.pdf', 'anando.biswas'),
(470, '00', 'Tax', 'NBR', 'Ruma Akter ', 'Second Secretary', 6, 'National Board of Revenue', 'India', 'IO', 'Official Trip', '2022-09-12', '2022-09-16', '0000-00-00', '0000-00-00', 5, '1662451162Ruma Akter.pdf', 'anando.biswas'),
(471, '300316', 'Customs', 'NBR', 'Purabi Saha', 'Deputy Commissioner', 6, ', Customs Excise & VAT Commissionerate, Khulna', 'United Kingdom', 'Others', 'Study Leave', '2022-09-19', '2023-07-31', '0000-00-00', '0000-00-00', 316, '1663041749Purabi Saha.pdf', 'anando.biswas'),
(472, '00', 'Customs', 'NBR', 'Al Amin Mahmud Ashraf', 'Assistant Commissioner', 9, 'Customs Excise & VAT Commissionerate, Sylhet', 'Indonesia', 'Self', 'EBL', '2022-10-12', '2022-10-21', '0000-00-00', '0000-00-00', 10, '1663124494Al Amin Mahmud Ashraf.pdf', 'anando.biswas'),
(473, '300172', 'Customs', 'NBR', 'Mohammad Jakir Hossain', 'Joint Commissioner', 5, 'Custom House, Chattogram', 'Saudi Arabia', 'Self', 'EBL', '2022-09-12', '2022-09-26', '0000-00-00', '0000-00-00', 15, '1663136475GO of Jakir Hossain.pdf', 'irdmof'),
(474, '300121', 'Customs', 'NBR', 'Mohammad Bashir Ahmed', 'Assistant Director', 4, 'Customs Intelligence and Investigation Directorate, Dhaka', 'India', 'IO', 'Official Trip', '2022-09-21', '2022-09-21', '0000-00-00', '0000-00-00', 1, '1663209353Mohammad Bashir Ahmed.pdf', 'anando.biswas'),
(475, '300076', 'Customs', 'NBR', 'Mohammad Fakhrul Alam', 'Director Genera', 3, 'Customs Intelligence and Investigation Directorate, Dhaka ', 'Korea South', 'GoB', 'Official Trip', '2022-09-27', '2022-09-29', '0000-00-00', '0000-00-00', 3, '1663209517Mohammad Fakhrul Alam.pdf', 'anando.biswas'),
(476, '300131', 'Customs', 'NBR', 'Dr. Mohammad Tazul Islam', 'Additional Commissioner', 4, 'Customs Excise & VAT Commissionerate, Dhaka (North), Dhaka', 'Singapore', 'Self', 'EBL', '2022-09-12', '2022-09-23', '0000-00-00', '0000-00-00', 12, '1663209647Dr. Mohammad Tazul Islam.pdf', 'anando.biswas'),
(477, '00', 'Non Cadre', 'NBR', 'Alamgir Kabir', 'Revenue Officer', 9, 'Custom House, Benapole', 'India', 'Self', 'EBL', '2022-10-16', '2022-11-13', '0000-00-00', '0000-00-00', 29, '1663472458Alamgir Kabir.pdf', 'anando.biswas'),
(478, '2225', 'Administration', 'IRD', 'Abu Hena Md. Rahmatul Muneem', 'Senior Secretary', 1, 'Internal Resources Division', 'United States of America', 'Others', 'Official Trip', '2022-09-15', '2022-09-23', '0000-00-00', '0000-00-00', 9, '1663553250Abu Hena Md. Rahmatul Muneem.pdf', 'anando.biswas'),
(479, '00', 'Customs', 'NBR', 'Md Masud Sadiq', 'Member', 1, 'National Board of Revenue, Dhaka.', 'United States of America', 'Others', 'Official Trip', '2022-09-15', '2022-09-23', '0000-00-00', '0000-00-00', 9, '1663553357Md Masud Sadiq.pdf', 'anando.biswas'),
(480, '00', 'Non Cadre', 'NBR', 'Md. Fazlur Rahman', 'System Manager', 3, 'National Board of Revenue, Dhaka.', 'United Arab Erimates', 'Others', 'Official Trip', '2022-09-15', '2022-09-23', '0000-00-00', '0000-00-00', 9, '1663553525Md. Fazlur Rahman.pdf', 'anando.biswas'),
(481, '00', 'Customs', 'NBR', 'AKM Nurul Huda Azad', 'Commissioner (Current Charge)', 4, 'Custom House, Dhaka.', 'United States of America', 'Others', 'Official Trip', '2022-09-15', '2022-09-23', '0000-00-00', '0000-00-00', 9, '1663553645AKM Nurul Huda Azad.pdf', 'anando.biswas'),
(482, '00', 'Customs', 'NBR', 'Raquibul Hassan', 'First Secretary', 5, 'National Board of Revenue. Dhaka.', 'United States of America', 'Others', 'Official Trip', '2022-09-15', '2022-09-23', '0000-00-00', '0000-00-00', 9, '1663553750Raquibul Hassan.pdf', 'anando.biswas'),
(483, '00', 'Customs', 'NBR', 'Mohd Parvez Reza Chowdhury', 'Second Secretary', 6, 'National Board of Revenue, Dhaka.', 'United States of America', 'Others', 'Official Trip', '2022-09-15', '2022-09-23', '0000-00-00', '0000-00-00', 9, '1663553815Mohd Parvez Reza Chowdhury.pdf', 'anando.biswas'),
(484, '200585', 'Tax', 'NBR', 'Raihan Mian', 'Assistant Commissioner of Taxes', 9, 'Taxes Zone9, Dhaka ', 'India', 'Self', 'EBL', '2022-09-11', '2022-09-25', '0000-00-00', '0000-00-00', 15, '1663565672Raihan Mian.pdf', 'anando.biswas'),
(485, '300177', 'Customs', 'NBR', 'Raquibul Hassan', 'First Secretary', 5, 'National Board of Revenue, Dhaka', 'Canada', 'Self', 'EBL', '2022-09-29', '2022-10-12', '0000-00-00', '0000-00-00', 14, '1663565790Raquibul Hassan.pdf', 'anando.biswas'),
(486, '200585', 'Tax', 'NBR', 'Md. Jasim Uddin Ahmed', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-13, Dhaka', 'Singapore', 'Self', 'EBL', '2022-09-23', '2022-10-07', '0000-00-00', '0000-00-00', 15, '1663571910Md. Jasim Uddin Ahmed.pdf', 'anando.biswas'),
(487, '2225', 'Administration', 'IRD', 'Abu Hena Md. Rahmatul Muneem', 'Senior Secretary', 1, 'Internal Resources Division', 'Iran', 'Others', 'Official Trip', '2022-10-06', '2022-10-08', '0000-00-00', '0000-00-00', 3, '1663739050Abu Hena Md. Rahmatul Muneem.pdf', 'anando.biswas'),
(488, '00', 'Tax', 'NBR', 'Md. Shahidul Islam', 'First Secretary', 5, 'National Board of Revenue, Dhaka.', 'Iran', 'Others', 'Official Trip', '2022-10-06', '2022-10-08', '0000-00-00', '0000-00-00', 3, '1663739150Md. Shahidul Islam.pdf', 'anando.biswas'),
(489, '00', 'Tax', 'NBR', 'Niaz Morshed', 'Second Secretary', 6, 'National Board of Revenue, Dhaka.', 'Iran', 'Others', 'Official Trip', '2022-10-06', '2022-10-08', '0000-00-00', '0000-00-00', 3, '1663739224Niaz Morshed.pdf', 'anando.biswas'),
(490, '200585', 'Tax', 'NBR', 'Raihan Mian', 'Assistant Director', 9, 'Taxes Zone-9, Dhaka', 'India', 'Self', 'EBL', '2022-09-11', '2022-09-25', '0000-00-00', '0000-00-00', 15, '1663837286IMG_20220922_0001.pdf', 'irdmof'),
(491, '300244', 'Customs', 'NBR', 'Rukba Iffat', 'Deputy Commissioner', 6, 'Large Taxpayers Unit, Value Added Tax, Dhaka', 'Germany', 'Self', 'EBL', '2022-10-21', '2022-11-19', '0000-00-00', '0000-00-00', 30, '1664419798Rukba Iffat.pdf', 'anando.biswas'),
(492, '00', 'Non Cadre', 'NBR', 'Mohammad Saker Ahmed', 'Revenue Officer', 9, 'Customs Excise and VAT Commissionerate, Dhaka (North), Dhaka', 'India', 'Self', 'EBL', '2022-09-25', '2022-10-09', '0000-00-00', '0000-00-00', 15, '1664441499Mohammad Saker Ahmed.pdf', 'anando.biswas'),
(493, '00', 'Non Cadre', 'NBR', 'Mohammad Junayed Iqbal', 'Revenue Officer', 9, 'Customs Excise and VAT Commissionerate, Dhaka (North), Dhaka', 'Singapore', 'Self', 'EBL', '2022-10-10', '2022-11-08', '0000-00-00', '0000-00-00', 30, '1664441601Mohammad Junayed Iqbal.pdf', 'anando.biswas'),
(494, '200260', 'Tax', 'NBR', 'Md. Masudur Rahman Masud', 'Director', 4, 'CIC, NBR', 'India', 'IO', 'Official Trip', '2022-10-17', '2022-10-21', '0000-00-00', '0000-00-00', 5, '1664685837Tax-360 E.pdf', 'irdmof'),
(495, '200270', 'Tax', 'NBR', 'Mohammad Wahid Ullah Khan', 'First Secretary', 4, 'NBR', 'India', 'IO', 'Official Trip', '2022-10-17', '2022-10-21', '0000-00-00', '0000-00-00', 5, '1664686134Tax-360 E.pdf', 'irdmof'),
(496, '200353', 'Tax', 'NBR', 'Erin Islam Julee', 'Chairman', 5, 'NBR', 'India', 'IO', 'Official Trip', '2022-10-17', '2022-10-21', '0000-00-00', '0000-00-00', 5, '1664686336Tax-360 E.pdf', 'irdmof'),
(497, '200470', 'Tax', 'NBR', 'Nusrat Hassan', 'Second Secretary', 6, 'NBR', 'India', 'IO', 'Official Trip', '2022-10-17', '2022-10-21', '0000-00-00', '0000-00-00', 5, '1664688412Tax-360 E.pdf', 'irdmof'),
(498, '200509', 'Tax', 'NBR', 'H M Shahriar Hassan', 'Second Secretary', 6, 'NBR', 'India', 'IO', 'Official Trip', '2022-10-17', '2022-10-21', '2022-10-21', '0000-00-00', 5, '1664688649Tax-360 E.pdf', 'irdmof'),
(499, '300311', 'Customs', 'NBR', 'Nur A Hasna Sanjida Anushua ', 'Deputy Commissioner', 6, 'Customs House, ICD, Kamalapur, Dhaka', 'United Kingdom', 'Self', 'EBL', '2022-10-09', '2022-10-23', '0000-00-00', '0000-00-00', 15, '1665031828go anushua.pdf', 'irdmof'),
(500, '200423', 'Tax', 'NBR', 'Md. Shajidul Islam', 'Second Secretary', 6, 'Income tax Wing', 'Malaysia', 'IO', 'Official Trip', '2022-10-18', '2022-10-20', '0000-00-00', '0000-00-00', 3, '1665033053364 (1).pdf', 'irdmof'),
(501, '200396', 'Tax', 'NBR', 'Sheikh Murad Hossain', 'Second Secretary', 6, 'Income Tax Wing', 'Malaysia', 'IO', 'Official Trip', '2022-10-18', '2022-10-20', '0000-00-00', '0000-00-00', 3, '1665033195364 (1).pdf', 'irdmof'),
(502, '15931', 'Administration', 'IRD', 'Mohammad Nairuzzaman', 'Deputy Secretary', 0, '(Stamp)', 'Malaysia', 'IO', 'EBL', '2022-10-18', '2022-10-20', '0000-00-00', '0000-00-00', 3, '1665033557364 (1).pdf', 'irdmof'),
(503, '0', 'Administration', 'NBR', 'Md. Shahiduzzaman', 'First Secretary', 5, 'Tax wing', 'Malaysia', 'IO', 'Official Trip', '2022-10-18', '2022-10-20', '0000-00-00', '0000-00-00', 3, '1665033728364 (1).pdf', 'irdmof'),
(504, '200237', 'Tax', 'NBR', 'Sk Md. Moniruzzaman', 'First Secretary', 5, 'Tax wing', 'Malaysia', 'IO', 'Official Trip', '2022-10-18', '2022-10-20', '0000-00-00', '0000-00-00', 3, '1665033878364 (1).pdf', 'irdmof'),
(505, '200226', 'Tax', 'NBR', 'Shrabani Chakma', 'First Secretary', 5, 'Tax wing', 'Malaysia', 'IO', 'Official Trip', '2022-10-18', '2022-10-20', '0000-00-00', '0000-00-00', 3, '1665033993364 (1).pdf', 'irdmof'),
(506, '200106', 'Tax', 'NBR', 'Mahbuba Hossain', 'Member', 3, 'Tax wing (CC)', 'Malaysia', 'IO', 'Official Trip', '2022-10-18', '2022-10-20', '0000-00-00', '0000-00-00', 3, '1665034137364 (1).pdf', 'irdmof'),
(507, '200102', 'Tax', 'NBR', 'Md. Abdul Majid', 'Member', 3, 'Tax wing (CC)', 'Malaysia', 'IO', 'Official Trip', '2022-10-18', '2022-10-20', '0000-00-00', '0000-00-00', 3, '1665034300364 (1).pdf', 'irdmof'),
(508, '300073', 'Customs', 'NBR', 'Md. Azizur Rahman', 'Commissioner', 3, 'Customs Bond Commissionerate, Dhaka.', 'Saudi Arabia', 'Self', 'EBL', '2022-10-11', '2022-10-25', '0000-00-00', '0000-00-00', 15, '1665371633go azizur.pdf', 'irdmof'),
(509, '300073', 'Non Cadre', 'NBR', 'Mohammad Atikuzzaman', 'Revenue Officer', 9, 'Customs Excise and VAT Commissionerate, Dhaka (west), Dhaka', 'Singapore', 'Self', 'EBL', '2022-10-11', '2022-10-20', '0000-00-00', '0000-00-00', 10, '1665372024go atik.pdf', 'irdmof'),
(510, '200089', 'Tax', 'NBR', 'Shaheen Akhter', 'Member', 2, 'Tax wing', 'Japan', 'IO', 'Official Trip', '2022-10-25', '2022-10-26', '0000-00-00', '0000-00-00', 2, '1665372422Tax-372 E.pdf', 'irdmof'),
(511, '200404', 'Tax', 'NBR', 'Md. Mohidul Islam Chowdhury', 'Second Secretary', 6, 'Tax wing', 'Japan', 'IO', 'Official Trip', '2022-10-25', '2022-10-26', '0000-00-00', '0000-00-00', 2, '1665372704Tax-372 E.pdf', 'irdmof'),
(512, '00', 'Customs', 'NBR', 'Tasmina Hossain', 'Commissioner', 3, 'Customs Excise & Vat Commissionerate, Dhaka (East), Dhaka', 'Thailand', 'Self', 'EBL', '2022-10-23', '2022-11-06', '0000-00-00', '0000-00-00', 15, '1665379413Tasmina Hossain.pdf', 'anando.biswas'),
(513, '300208', 'Customs', 'NBR', 'Tahmina Akter Poli', 'Deputy Commissioner', 6, 'Customs Excise & VAT Commissionerate, Rajshahi ', 'Thailand', 'Self', 'EBL', '2022-10-05', '2022-10-19', '0000-00-00', '0000-00-00', 15, '1665382361Tahmina Akter Poli.pdf', 'anando.biswas'),
(514, '00', 'Customs', 'NBR', 'H M Ahsanul Kabir', 'Assistant Project Director (Deputy Commissioner)', 6, 'National Single Window, National Board of Revenue', 'Japan', 'Others', 'Official Trip', '2022-10-18', '2022-10-25', '0000-00-00', '0000-00-00', 8, '1665382886H M Ahsanul Kabir.pdf', 'anando.biswas'),
(515, '200551', 'Tax', 'NBR', 'Sharif Mahmud', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone-06, Dhaka ', 'India', 'Self', 'EBL', '2022-10-07', '2022-10-21', '0000-00-00', '0000-00-00', 15, '1665388632Sharif Mahmud.pdf', 'anando.biswas'),
(516, '300376', 'Customs', 'NBR', 'Jewela Khanam', 'Resister', 6, 'Customs Excise and VAT Appellate Tribunal, Dhaka ', 'Turkey', 'Self', 'EBL', '2022-09-30', '2022-10-15', '0000-00-00', '0000-00-00', 16, '1665455855Jewela Khanam.pdf', 'anando.biswas'),
(517, '00', 'Customs', 'NBR', 'Md. Mahfuz Alam', 'Deputy Commissioner', 6, 'Custom House, Chattogram', 'India', 'Others', 'Official Trip', '2022-10-17', '2022-10-30', '0000-00-00', '0000-00-00', 14, '1665456131Md. Mahfuz Alam.pdf', 'anando.biswas'),
(518, '00', 'Non Cadre', 'NBR', 'Mohammad Morshed Alam', 'Assistant Programmer', 9, 'Custom House, Chattogram', 'India', 'Others', 'Official Trip', '2022-10-17', '2022-10-30', '0000-00-00', '0000-00-00', 14, '1665456241Mohammad Morshed Alam.pdf', 'anando.biswas'),
(519, '00', 'Non Cadre', 'NBR', 'Anisuzzaman Khan', 'Revenue Officer', 9, 'Custom House, Chattogram', 'India', 'Others', 'Official Trip', '2022-10-17', '2022-10-30', '0000-00-00', '0000-00-00', 14, '1665456342Anisuzzaman Khan.pdf', 'anando.biswas'),
(520, '00', 'Non Cadre', 'NBR', 'Md Saber Noor Chowdhury', 'Sub Assistant Engineer', 10, 'Custom House, Chattogram', 'India', 'Others', 'Official Trip', '2022-10-17', '2022-10-30', '0000-00-00', '0000-00-00', 14, '1665456485Md Saber Noor Chowdhury.pdf', 'anando.biswas'),
(521, '300127', 'Customs', 'NBR', 'Md Mosiur Rahman', 'Additional Commissioner', 4, 'Custom House, Dhaka', 'Australia', 'IO', 'Official Trip', '2022-10-17', '2022-10-21', '0000-00-00', '0000-00-00', 5, '1665456743Md Mosiur Rahman.pdf', 'anando.biswas'),
(522, '200129', 'Tax', 'IRD', 'A K M Badiul Alam', 'Director General (Commissioner of Taxes)', 3, 'Central Intelligent Cell (CIC)', 'Singapore', 'Self', 'EBL', '2022-10-25', '2022-11-03', '0000-00-00', '0000-00-00', 10, '1665458774A K M Badiul Alam.pdf', 'anando.biswas'),
(523, '300167', 'Customs', 'NBR', 'Sefat E Mariam', 'Joint Commissioner', 5, 'Custom House, Dhaka', 'Korea South', 'IO', 'Official Trip', '2022-10-24', '2022-11-18', '0000-00-00', '0000-00-00', 26, '1665458955Sefat-E-Mariam.pdf', 'anando.biswas'),
(524, '300159', 'Customs', 'NBR', 'Mst. Shakila Pervin', 'Joint Commissioner', 5, 'Customs Bond Commissionerate, Dhaka ', 'Australia', 'IO', 'Official Trip', '2022-11-21', '2022-11-30', '0000-00-00', '0000-00-00', 10, '1665467079Mst. Shakila Pervin.pdf', 'anando.biswas'),
(525, '2225', 'Administration', 'IRD', 'Abu Hena Md. Rahmatul Muneem', 'Senior Secretary', 1, 'IRD', 'Hungary', 'GoB', 'Official Trip', '2022-11-08', '2022-11-10', '0000-00-00', '0000-00-00', 3, '1666083612GO 16-10-2022.pdf', 'irdmof'),
(526, '200220', 'Tax', 'NBR', 'Asma Dina Ghani', 'Additional Commissioner of Taxes', 4, 'Taxes Zone-2. Dhaka', 'Hungary', 'GoB', 'Official Trip', '2022-11-08', '2022-11-10', '0000-00-00', '0000-00-00', 3, '1666083806GO 16-10-2022.pdf', 'irdmof'),
(527, '200393', 'Tax', 'NBR', 'Niaz Morshed', 'Second Secretary', 6, 'Tax wing', 'Hungary', 'GoB', 'Official Trip', '2022-11-08', '2022-11-10', '0000-00-00', '0000-00-00', 3, '1666233836GO 16-10-2022.pdf', 'irdmof'),
(528, '200445', 'Tax', 'NBR', 'Bapan Chandra Das', 'Second Secretary', 6, 'Tax wing', 'Hungary', 'GoB', 'Official Trip', '2022-11-08', '2022-11-10', '0000-00-00', '0000-00-00', 3, '1666234080GO 16-10-2022.pdf', 'irdmof'),
(529, '00', 'Non Cadre', 'NBR', 'Murshed Hossain Zinnah', 'Revenue Officer', 9, 'Customs Intelligence and Investigation Directorate, Dhaka', 'India', 'Self', 'EBL', '2022-10-30', '2022-11-20', '0000-00-00', '0000-00-00', 22, '1666667957Murshed Hossain Zinnah.pdf', 'anando.biswas'),
(530, '200550', 'Tax', 'NBR', 'Nipu Chandra Dey', 'Deputy Commissioner of Taxes', 6, 'Taxes Zone, Mymenshing', 'Thailand', 'Self', 'EBL', '2022-11-01', '2022-11-10', '0000-00-00', '0000-00-00', 10, '1666668571Nipu Chandra Dey.pdf', 'anando.biswas'),
(531, '0', 'Non Cadre', 'NBR', 'Dipak Kumar Mozumder', 'Chairman', 9, 'Customs Excise & VAT Commissionerate, Dhaka (East), Dhaka', 'India', 'Self', 'EBL', '2022-10-23', '2022-11-06', '0000-00-00', '0000-00-00', 15, '1667112461getContent - 2022-10-30T120515.706.pdf', 'farhad.pathan'),
(532, '00', 'Non Cadre', 'NBR', 'Modh. Abul Kalam Azad', 'Revenue Officer', 9, 'Customs Excise & VAT Commissionerate, Dhaka (North), Dhaka', 'Thailand', 'Self', 'EBL', '2022-11-06', '2022-11-20', '0000-00-00', '0000-00-00', 15, '1667270159Modh. Abul Kalam Azad.pdf', 'anando.biswas'),
(533, '200160', 'Tax', 'NBR', 'Mohammad Mustafa ', 'Commissioner of Taxes', 3, 'Taxes Appeal Zone3, Dhaka', 'Saudi Arabia', 'Self', 'EBL', '2022-12-17', '2022-12-26', '0000-00-00', '0000-00-00', 10, '1667270277Mohammad Mustafa.pdf', 'anando.biswas'),
(534, '300335', 'Customs', 'NBR', 'Md. Tarek Mahmud', 'Deputy Director', 6, 'Central Intelligence Cell', 'Japan', 'IO', 'Official Trip', '2022-11-04', '2022-12-03', '0000-00-00', '0000-00-00', 30, '1667270489Md. Tarek Mahmud.pdf', 'anando.biswas'),
(535, '300189', 'Customs', 'NBR', 'Muhammad Imtiaz Hassan', 'Joint Commissioner', 5, 'Large Taxpayers Unit, Value Added Tax, Dhaka', 'Thailand', 'Self', 'EBL', '2022-10-30', '2022-11-13', '0000-00-00', '0000-00-00', 15, '1667289367Muhammad Imtiaz Hassan.pdf', 'anando.biswas'),
(536, '200280', 'Tax', 'NBR', 'Shaikh Shamim Bulbul', 'First Secretary', 5, 'Tax wing', 'India', 'Self', 'EBL', '2022-11-01', '2022-11-11', '0000-00-00', '0000-00-00', 11, '1667452255401.pdf', 'farhad.pathan'),
(537, '300125', 'Customs', 'NBR', 'Kazi Farid Uddin', 'Chairman', 4, 'Custom House, Dhaka', 'Singapore', 'Self', 'EBL', '2022-10-22', '2022-11-05', '0000-00-00', '0000-00-00', 15, '1667786906customs letter 297.pdf', 'moinul.alam'),
(538, '200238', 'Tax', 'NBR', 'Muhammad Aminur Rahman', 'Additional Commissioner of Taxes', 4, 'Taxes Zone-06, Dhaka', 'India', 'Self', 'EBL', '2022-11-06', '2022-11-17', '0000-00-00', '0000-00-00', 12, '1667796743Muhammad Aminur Rahman.pdf', 'anando.biswas'),
(539, '200186', 'Tax', 'NBR', 'Mr. Monwar Ahmed', 'Additional Commissioner of Taxes', 4, 'Taxes Appeal Zone-3, Dhaka ', 'Thailand', 'Self', 'EBL', '2022-11-13', '2022-11-17', '0000-00-00', '0000-00-00', 5, '1667796865Mr. Monwar Ahmed.pdf', 'anando.biswas'),
(540, '300325', 'Customs', 'NBR', 'Omar Mobin', 'Second Secretary', 6, 'National Board of Revenue, Dhaka', 'Indonesia', 'Others', 'Official Trip', '2022-12-19', '2022-12-23', '0000-00-00', '0000-00-00', 5, '1667802013Omar Mobin.pdf', 'anando.biswas'),
(541, '00', 'Customs', 'NBR', 'Kazi Raihanuj Jaman', 'Deputy Project Director', 6, 'Bond Management Automation Project', 'Thailand', 'Others', 'Official Trip', '2022-11-21', '2022-11-25', '0000-00-00', '0000-00-00', 5, '1667810747Kazi Raihanuj.pdf', 'anando.biswas'),
(542, '00', 'Customs', 'NBR', 'Md Shahiduzzaman Sarkar', 'Second Secretary', 6, 'National Board of Revenue, Dhaka', 'Thailand', 'Others', 'Official Trip', '2022-11-21', '2022-11-25', '0000-00-00', '0000-00-00', 5, '1667810866Md Shahiduzzaman.pdf', 'anando.biswas'),
(543, '00', 'Customs', 'NBR', 'Sunjida Sharmin', 'Deputy Director', 6, 'Customs Intelligence and Investigation Directorate,', 'Vietnam', 'Others', 'Official Trip', '2022-11-23', '2022-11-24', '0000-00-00', '0000-00-00', 2, '1667810965Sunjida Sharmin.pdf', 'anando.biswas'),
(544, '00', 'Customs', 'NBR', 'Md Shamsul Arafin Khan', 'Joint Director ', 6, 'Customs Intelligence and Investigation Directorate,', 'Vietnam', 'Others', 'Official Trip', '2022-11-23', '2022-11-24', '0000-00-00', '0000-00-00', 2, '1667811058Md Shamsul Arafin.pdf', 'anando.biswas'),
(545, '200338', 'Tax', 'NBR', 'Mohammad Tariq Iqbal', 'Joint Commissioner of Taxes', 5, 'Taxes Zone-7, Dhaka ', 'Thailand', 'Self', 'EBL', '2022-12-01', '2022-12-15', '0000-00-00', '0000-00-00', 15, '1667959087Mohammad Tariq Iqbal.pdf', 'anando.biswas'),
(546, '300079', 'Tax', 'NBR', 'Mohammad Lutfor Rahman', 'Commissioner', 3, 'Customs, Excise & VAT Commissionerate, Rajshahi', 'Singapore', 'Self', 'EBL', '2022-11-13', '2022-11-27', '0000-00-00', '0000-00-00', 15, '1668054487Mohammad Lutfor Rahman.pdf', 'anando.biswas'),
(547, '200171', 'Tax', 'NBR', 'Monju Man Ara Begum', 'Additional Commissioner of Taxes', 4, 'Taxes Appeal Zone-1, Dhaka', 'India', 'Self', 'EBL', '2022-12-28', '2023-01-16', '0000-00-00', '0000-00-00', 20, '1668569606Monju Man-Ara Begum.pdf', 'anando.biswas'),
(548, '200299', 'Tax', 'NBR', 'Mohammad Naimur Rasul', 'Appealte Joint Commissioner of Taxes', 5, 'Taxes Appeal Zone-3, Dhaka', 'India', 'Self', 'EBL', '2022-11-17', '2022-12-01', '0000-00-00', '0000-00-00', 15, '1668677789101.pdf', 'irdmof'),
(549, '0', 'Non Cadre', 'NSD', 'Tapan Kumar Das', 'Assistant Director', 9, 'District Savings Office, Gopalganj', 'India', 'Self', 'EBL', '2022-11-27', '2022-12-05', '0000-00-00', '0000-00-00', 9, '1668677943তপন কুমার.pdf', 'irdmof'),
(550, '0', 'Non Cadre', 'NBR', 'Golam Sarwar', 'Programmer', 6, 'National Board of Revenue, Dhaka', 'Malaysia', 'IO', 'Official Trip', '2022-11-28', '2022-12-09', '0000-00-00', '0000-00-00', 12, '1668678374G.O (NBR).pdf', 'moinul.alam'),
(551, '0', 'Non Cadre', 'NBR', 'Md. Abdul Momin', 'Assistant Programmer', 9, 'Custom House, Dhaka', 'Malaysia', 'IO', 'Official Trip', '2022-11-28', '2022-12-09', '0000-00-00', '0000-00-00', 12, '1668678443G.O (NBR).pdf', 'moinul.alam'),
(552, '0', 'Non Cadre', 'NBR', 'Md. Monirul Islam', 'Assistant Programmer', 9, 'National Board of Revenue, Dhaka', 'Malaysia', 'IO', 'Official Trip', '2022-11-28', '2022-12-09', '0000-00-00', '0000-00-00', 12, '1668678502G.O (NBR).pdf', 'moinul.alam'),
(553, '0', 'Non Cadre', 'NBR', 'Rajib Das', 'Assistant Programmer', 9, 'National Board of Revenue, Dhaka', 'Malaysia', 'IO', 'Official Trip', '2022-11-28', '2022-12-09', '0000-00-00', '0000-00-00', 12, '1668678553G.O (NBR).pdf', 'moinul.alam'),
(554, '0', 'Non Cadre', 'NBR', 'Md. Ronju Mia', 'Assistant Programmer', 9, 'National Board of Revenue, Dhaka', 'Malaysia', 'IO', 'Official Trip', '2022-11-28', '2022-12-09', '0000-00-00', '0000-00-00', 12, '1668678599G.O (NBR).pdf', 'moinul.alam'),
(555, '0', 'Non Cadre', 'NBR', 'Md. Ahad Ali', 'Assistant Programmer', 9, 'Custom House, Benapole', 'Malaysia', 'IO', 'Official Trip', '2022-11-28', '2022-12-09', '0000-00-00', '0000-00-00', 12, '1668678649G.O (NBR).pdf', 'moinul.alam'),
(556, '0', 'Non Cadre', 'NBR', 'Istiaq Akbar', 'Assistant Programmer', 9, 'National Board of Revenue, Dhaka', 'Malaysia', 'IO', 'Official Trip', '2022-11-28', '2022-12-09', '0000-00-00', '0000-00-00', 12, '1668678699G.O (NBR).pdf', 'moinul.alam'),
(557, '2002991', 'Tax', 'NBR', 'Mohammad Naimur Rasul', 'Joint Commissioner of Taxes', 5, 'Taxes Appeal Zone-3, Dhaka', 'India', 'Self', 'EBL', '2022-11-17', '2022-12-01', '0000-00-00', '0000-00-00', 15, '1668918232Mohammad Naimur Rasul.pdf', 'anando.biswas');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `file_name` varchar(50) NOT NULL,
  `uploaded_on` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`file_name`, `uploaded_on`) VALUES
('08731972.pdf', '2021-09-02 16:14:03'),
('20.Mr. Sami Kabir.pdf', '2021-09-02 16:14:52'),
('2021_08_03_12-49-05_pm.pdf', '2021-09-02 16:21:03'),
('2021_08_03_12-49-05_pm.pdf', '2021-09-05 13:12:42'),
('07421977.pdf', '2021-09-05 14:27:09'),
('07592858.pdf', '2021-09-05 14:28:04'),
('Lulea&#778; tekniska universitet Mail - [Remote Se', '2021-09-15 13:01:01'),
('Reviewers comments.pdf', '2021-09-15 13:03:52');

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `No.` int(20) NOT NULL,
  `Service_ID` varchar(20) NOT NULL,
  `Cadre` varchar(20) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Designation` varchar(80) NOT NULL,
  `Workplace` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `passnid`
--

CREATE TABLE `passnid` (
  `ID` int(20) NOT NULL,
  `ServiceID` int(20) NOT NULL,
  `Cadre` varchar(100) NOT NULL,
  `Office` varchar(100) NOT NULL,
  `Name` varchar(500) NOT NULL,
  `Designation` varchar(500) NOT NULL,
  `Grade` int(20) NOT NULL,
  `Passport` varchar(50) DEFAULT NULL,
  `ExpiryDate` date NOT NULL,
  `NID_Num` varchar(50) DEFAULT NULL,
  `Uploader` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `passnid`
--

INSERT INTO `passnid` (`ID`, `ServiceID`, `Cadre`, `Office`, `Name`, `Designation`, `Grade`, `Passport`, `ExpiryDate`, `NID_Num`, `Uploader`) VALUES
(1, 2820, 'Non Cadre', 'IRD', 'Sami Kabir', 'Programmer', 6, 'F00000589', '2031-07-03', '19907654189076541', ''),
(2, 2818, 'Non Cadre', 'NBR', 'Sadek Hossain', 'System Analyst', 6, 'OC3184299', '2025-10-01', NULL, ''),
(3, 2819, 'Non Cadre', 'NSD', 'Tarana Nasrin', 'Programmer', 6, 'OC3184299', '2022-02-18', '4242452345234142134', ''),
(4, 2323, 'Non Cadre', 'IRD', 'sfsaf', 'Registrar', 6, 'sdfef', '2021-10-28', NULL, ''),
(5, 1278, 'Tax', 'NBR', 'Mehenaz Tabassum', 'Second Secretary', 6, 'OC3184299', '2022-03-17', '2147483647', ''),
(6, 2819, 'Customs', 'IRD', 'sadfsadf', 'Member', 6, 'sdfsadf', '2022-01-13', '2324234234', '');

-- --------------------------------------------------------

--
-- Table structure for table `revisedgo`
--

CREATE TABLE `revisedgo` (
  `ID` int(50) NOT NULL,
  `RevGO` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `revisedgo`
--

INSERT INTO `revisedgo` (`ID`, `RevGO`) VALUES
(32, 'SKabir_Letter_of_Acceptance.pdf'),
(32, 'SKabir_ePassport.pdf'),
(25, 'SKabir_MarriageCertificate.pdf'),
(25, 'Instruktion-ISP_eng-GB.pdf'),
(25, 'Roundcube Webmail __ Initially selection for Ph.D. in Pervasive and Mobile Computing with focus on Explainable Artificial Intelligence (AI)_.pdf'),
(25, 'ansokan.pdf'),
(25, 'Arduino.jpeg'),
(25, 'Laravel.png'),
(25, 'Motivation.jpeg'),
(0, 'ansokan (1).pdf'),
(33, '148617169_472674237074850_979379854515686_n.jpg'),
(0, '139612248_449074406273925_8465682978117605253_n.jpg'),
(0, '2021_09_07_11-04-49_am.pdf'),
(0, 'adts.202100220_reviewer.pdf'),
(34, '1-s2.0-S095070512100753X-main.pdf'),
(35, 'Crest_2.jpeg'),
(3, '220501145_10216000255319273_6574365547955972213_n.jpeg'),
(3, '192203396_1359613071092702_68646940224834795_n.jpg'),
(37, 'SKabir_AdmissionDecision.pdf'),
(37, 'SKabir_AdmissionDecision.pdf'),
(37, 'MAMP.html'),
(37, 'Roundcube Webmail __ Fwd_ Sami Kabir.pdf'),
(38, 'Prefektbeslut yttrande.pdf'),
(38, 'Roundcube Webmail __ Fwd_ E-signerad handling för handläggning eller kännedom - Prefektbeslut yttrande.pdf'),
(38, 'Roundcube Webmail __ Re_ Thank you, Prof. Dr. Karl Andersson!.pdf'),
(38, 'Roundcube Webmail __ Re_ Thank you, Prof. Dr. Karl Andersson!.pdf'),
(38, 'Instruktion-ISP_eng-GB.pdf'),
(38, 'Instruktion-ISP_eng-GB.pdf'),
(38, 'mall ISP-eng.docx'),
(38, 'mall ISP-eng.docx'),
(38, 'Exempel_Aktivitetskort_eng-GB.docx'),
(39, 'mall ISP-eng.docx'),
(39, 'Exempel_Aktivitetskort_eng-GB.docx'),
(39, 'Main-Combine-ISP-Morteza.docx'),
(39, 'Instruktion-ISP_eng-GB.pdf'),
(39, 'Bilaga C - Målmatris för licentiatexamen_eng-GB copy.xlsx'),
(38, 'Bilaga C - Målmatris för licentiatexamen_eng-GB copy.xlsx'),
(38, 'mall ISP-eng.docx'),
(38, 'Main-Combine-ISP-Morteza.docx'),
(40, 'Screen Shot 2021-08-03 at 7.03.16 PM.png'),
(42, '2021_09_07_11-04-49_am.pdf'),
(42, '133788593_138737291391535_2400119967985814293_n.jpg'),
(42, '149790608_867229857172640_4816565921301430317_n.jpg'),
(24, 'SKabir_Letter_of_Acceptance.pdf'),
(24, 'smartcities-03-00065-v2(doneTillPg26.50-Ref.70).pdf'),
(26, 'Roundcube Webmail __ Selected for second interview and task details_.pdf'),
(33, 'Roundcube Webmail __ Selected for second interview and task details_.pdf'),
(46, '126522848_4077175625630878_1472436581076665480_n.jpg'),
(46, '20.Mr. Sami Kabir.pdf'),
(47, '1-s2.0-S095070512100753X-main.pdf'),
(54, '2021_07_29_13-49-12_pm.pdf'),
(90, 'Naznin Akhter Nipa.pdf'),
(113, 'Md Golam Mostafa.pdf'),
(145, 'Zeenat Ara.pdf'),
(144, 'Md. Rahenul Islam.pdf'),
(95, 'Miazi Shahidul Alam Chowdhury.pdf'),
(151, 'Mohammad Abul Monsur.pdf'),
(151, 'Mohammad Abul Monsur.pdf'),
(169, 'kolkata go.pdf'),
(166, 'Aminul.pdf'),
(230, 'GO IRD Officers of 13-02-2020-3.pdf'),
(235, 'Tax-311 E.pdf'),
(243, 'Shrabana Afrin.pdf'),
(254, 'ID.jpg'),
(255, 'ID.jpg'),
(265, 'GO of Turkey Tour..pdf'),
(259, 'AKM Nurul Huda Azad.pdf'),
(266, 'GO of Turkey Tour..pdf'),
(269, 'innovation letter (1).pdf'),
(271, 'Mohammad Amirul Karim Munshi.pdf'),
(180, 'getContent (1) (1).pdf'),
(134, 'Amirul Karim Munshi01.03.20.pdf'),
(286, '1641464635Md. Ahidul Islam.pdf'),
(277, '1641701223Suraiya Parvin Shelley.pdf'),
(277, '1646297394SuraiyaParvinShelley.pdf'),
(308, '1646730566go nitish.pdf'),
(315, '1647922600Miazi Shahidul Alam Chowdhury.pdf'),
(320, '1649063573IMG_0001.pdf'),
(334, '1650445200Md Sohel.pdf'),
(355, '1653541980Mrs. Modhumita Akter.pdf'),
(367, '1654066478GO of Yeasmin Akther Shahnur.pdf'),
(368, '1656408590Md. Shajidul Islam.pdf'),
(438, '1658821798Md. Eidtazul Islam.pdf'),
(518, '1665456547Mohammad Morshed Alam.pdf'),
(523, '1665651808Sefat-E-Mariam.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `SL` int(10) NOT NULL,
  `Role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`SL`, `Role`) VALUES
(1, 'Administrator'),
(2, 'Admin'),
(3, 'User'),
(4, 'Visitor'),
(5, 'Operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `foreignvisit`
--
ALTER TABLE `foreignvisit`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `passnid`
--
ALTER TABLE `passnid`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`SL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `foreignvisit`
--
ALTER TABLE `foreignvisit`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=558;

--
-- AUTO_INCREMENT for table `passnid`
--
ALTER TABLE `passnid`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `SL` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
