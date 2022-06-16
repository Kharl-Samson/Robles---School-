-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 22, 2022 at 03:30 AM
-- Server version: 10.5.13-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u853611092_Robles_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `acceptedappointment_tb`
--

CREATE TABLE `acceptedappointment_tb` (
  `id` int(100) NOT NULL,
  `patient_id` varchar(250) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `archive` varchar(250) NOT NULL,
  `service` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acceptedappointment_tb`
--

INSERT INTO `acceptedappointment_tb` (`id`, `patient_id`, `fname`, `mname`, `lname`, `address`, `contact`, `email`, `date`, `time`, `status`, `archive`, `service`) VALUES
(1, '', 'Venice', '', 'Sunga', 'Sulipan, Apalit, Pampaga', '09398176446', 'khrlsmsn1110@gmail.com', '09/02/2022', '12:00 pm - 12:30 pm', 'Accepted', 'on', ''),
(2, '', 'Georgina', '', 'Gil', 'Longos, Malolos, Bulacan', '09387163513', 'georgina@gmail.com', '03/02/2022', '12:30 pm - 1:00 pm', 'Accepted', 'off', ''),
(3, '', 'Christine', '', 'Ramos', 'Capalangan,Apalit, Pampanga', '09191364154', 'dsamsonoel@gmail.com', '05/02/2022', '11:00 am - 11:30 am', 'Accepted', 'off', ''),
(4, 'RM22-0114-87-1', 'Ash', 'Garcia', 'Cruz', 'San Jose, CALUMPIT, BULACAN', '09471357585', 'ash@gmail.com', '09/02/2022', '11:00 am - 11:30 am', 'Accepted', 'off', ''),
(5, '', 'Micah', '', 'De Jesus', 'Meyto, Calumpit, Bulacan', '09387165413', 'micah@gmail.com', '22/02/2022', '11:30 am - 12:00 am', 'Accepted', 'off', ''),
(6, '', 'Lesley', '', 'Santos', 'San Miguel, Calumpit, Bulacan', '09736154516', 'lesley@gmail.com', '10/02/2022', '11:00 am - 11:30 am', 'Accepted', 'off', ''),
(7, '', 'Sample', '', 'Name', 'Calumpit', '09396164116', 'dsamsonoel@gmail.com', '11/02/2022', '11:00 am - 11:30 am', 'Accepted', 'off', '');

-- --------------------------------------------------------

--
-- Table structure for table `appoinment_verification_tb`
--

CREATE TABLE `appoinment_verification_tb` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  `time_expire` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `audit_tb`
--

CREATE TABLE `audit_tb` (
  `id` int(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit_tb`
--

INSERT INTO `audit_tb` (`id`, `date`, `name`, `description`) VALUES
(1, '2022-02-03 01:14 AM', 'espie73', 'espie73 has logged in'),
(2, '2022-02-03 01:18 AM', 'espie73', 'espie73 rejected an appointment.'),
(3, '2022-02-03 08:32 AM', 'espie73', 'espie73 has logged in'),
(4, '2022-02-03 08:34 AM', 'espie73', 'espie73 rejected an appointment.'),
(5, '2022-02-03 08:39 AM', 'espie73', 'espie73 has logged in'),
(6, '2022-02-03 08:39 AM', 'espie73', 'espie73 has logged out.'),
(7, '2022-02-03 08:40 AM', 'arleen75', 'arleen75 has logged in'),
(8, '2022-02-03 09:10 AM', 'espie73', 'espie73 has logged out.'),
(9, '2022-02-03 09:12 AM', 'espie73', 'espie73 has logged in'),
(10, '2022-02-03 09:15 AM', 'espie73', 'espie73 has logged out.'),
(11, '2022-02-03 09:15 AM', 'arleen75', 'arleen75 has logged out.'),
(12, '2022-02-03 09:16 AM', 'arleen75', 'arleen75 has logged in'),
(13, '2022-02-03 09:19 AM', 'arleen75', 'arleen75 has logged out.'),
(14, '2022-02-03 09:19 AM', 'arleen75', 'arleen75 has logged in'),
(15, '2022-02-03 09:19 AM', 'espie73', 'espie73 has logged in'),
(16, '2022-02-03 09:23 AM', 'espie73', 'espie73 made a patient report.'),
(17, '2022-02-03 12:38 PM', 'espie73', 'espie73 has logged in'),
(18, '2022-02-03 12:41 PM', 'arleen75', 'arleen75 has logged in'),
(19, '2022-02-03 12:46 PM', 'arleen75', 'arleen75 has logged out.'),
(20, '2022-02-03 12:46 PM', 'espie73', 'espie73 has logged in'),
(21, '2022-02-03 12:46 PM', 'espie73', 'espie73 has logged in'),
(22, '2022-02-03 01:12 PM', 'espie73', 'espie73 has logged in'),
(23, '2022-02-03 01:13 PM', 'arleen75', 'arleen75 has logged in'),
(24, '2022-02-03 01:16 PM', 'arleen75', 'arleen75 has logged in'),
(25, '2022-02-03 01:22 PM', 'espie73', 'espie73 has logged out.'),
(26, '2022-02-03 01:26 PM', 'arleen75', 'arleen75 has logged in'),
(27, '2022-02-03 01:28 PM', 'espie73', 'espie73 has logged in'),
(28, '2022-02-03 01:31 PM', 'espie73', 'espie73 has logged out.'),
(29, '2022-02-03 01:31 PM', 'arleen75', 'arleen75 has logged in'),
(30, '2022-02-03 01:32 PM', 'arleen75', 'arleen75 has logged out.'),
(31, '2022-02-03 01:39 PM', 'arleen75', 'arleen75 has logged in'),
(32, '2022-02-03 01:39 PM', 'arleen75', 'arleen75 replied to inquiry.'),
(33, '2022-02-03 01:40 PM', 'arleen75', 'arleen75 has logged out.'),
(34, '2022-02-03 01:46 PM', 'arleen75', 'arleen75 has logged in'),
(35, '2022-02-03 01:46 PM', 'arleen75', 'arleen75 has logged out.'),
(36, '2022-02-03 01:51 PM', 'arleen75', 'arleen75 has logged in'),
(37, '2022-02-03 01:57 PM', 'arleen75', 'arleen75 has logged in'),
(38, '2022-02-03 02:09 PM', 'arleen75', 'arleen75 has logged out.'),
(39, '2022-02-03 02:10 PM', 'espie73', 'espie73 has logged in'),
(40, '2022-02-03 02:13 PM', 'espie73', 'espie73 has logged out.'),
(41, '2022-02-03 02:20 PM', 'arleen75', 'arleen75 has logged in'),
(42, '2022-02-03 02:20 PM', 'arleen75', 'arleen75 has logged out.'),
(43, '2022-02-03 03:06 PM', 'arleen75', 'arleen75 has logged in'),
(44, '2022-02-03 03:09 PM', 'arleen75', 'arleen75 prescribed a medicine with the name guaifenesin 10mg.'),
(45, '2022-02-03 03:13 PM', 'arleen75', 'arleen75 rejected an appointment.'),
(46, '2022-02-03 03:13 PM', 'arleen75', 'arleen75 accepted an appointment.'),
(47, '2022-02-03 03:14 PM', 'arleen75', 'arleen75 replied to inquiry.'),
(48, '2022-02-03 03:14 PM', 'arleen75', 'arleen75 has logged out.'),
(49, '2022-02-03 03:15 PM', 'espie73', 'espie73 has logged in'),
(50, '2022-02-03 03:17 PM', 'espie73', 'espie73 added a staff.'),
(51, '2022-02-03 03:17 PM', 'espie73', 'espie73 removed a staff.'),
(52, '2022-02-03 03:20 PM', 'espie73', 'espie73 has logged out.'),
(53, '2022-02-03 03:23 PM', 'espie73', 'espie73 has logged in'),
(54, '2022-02-04 12:01 AM', 'arleen75', 'arleen75 has logged in'),
(55, '2022-02-04 04:01 PM', 'espie73', 'espie73 has logged in'),
(56, '2022-02-04 04:03 PM', 'arleen75', 'arleen75 has logged in'),
(57, '2022-02-04 04:18 PM', 'espie73', 'espie73 has logged in'),
(58, '2022-02-04 04:18 PM', 'espie73', 'espie73 has logged in'),
(59, '2022-02-04 04:51 PM', 'arleen75', 'arleen75 has logged in'),
(60, '2022-02-04 05:17 PM', 'arleen75', 'arleen75 has logged in'),
(61, '2022-02-04 07:54 PM', 'espie73', 'espie73 has logged in'),
(62, '2022-02-04 09:33 PM', 'arleen75', 'arleen75 has logged in'),
(63, '2022-02-04 09:36 PM', 'arleen75', 'arleen75 has logged out.'),
(64, '2022-02-04 09:36 PM', 'espie73', 'espie73 has logged in'),
(65, '2022-02-04 09:41 PM', 'espie73', 'espie73 edited a staff schedule.'),
(66, '2022-02-04 10:10 PM', 'arleen75', 'arleen75 has logged in'),
(67, '2022-02-04 10:33 PM', 'espie73', 'espie73 has logged in'),
(68, '2022-02-04 10:54 PM', 'arleen75', 'arleen75 prescribed a medicine with the name guaifenesin 10mg.'),
(69, '2022-02-04 10:58 PM', 'arleen75', 'arleen75 edited a medicine with the name guaifenesin 10mg.'),
(70, '2022-02-04 11:02 PM', 'arleen75', 'arleen75 accepted an appointment.'),
(71, '2022-02-04 11:02 PM', 'arleen75', 'arleen75 rejected an appointment.'),
(72, '2022-02-04 11:05 PM', 'espie73', 'espie73 has logged in'),
(73, '2022-02-04 11:32 PM', 'arleen75', 'arleen75 added a medicine with the name warfarin 10mg.'),
(74, '2022-02-05 02:53 PM', 'espie73', 'espie73 has logged in'),
(75, '2022-02-05 03:08 PM', 'espie73', 'espie73 made a patient report.'),
(76, '2022-02-05 03:22 PM', 'espie73', 'espie73 edited a staff schedule.'),
(77, '2022-02-05 03:32 PM', 'arleen75', 'arleen75 has logged in'),
(78, '2022-02-05 05:37 PM', 'arleen75', 'arleen75 has logged in'),
(79, '2022-02-05 06:21 PM', 'arleen75', 'arleen75 has logged in'),
(80, '2022-02-05 06:21 PM', 'arleen75', 'arleen75 accepted an appointment.'),
(81, '2022-02-05 08:18 PM', 'espie73', 'espie73 has logged in'),
(82, '2022-02-05 08:19 PM', 'arleen75', 'arleen75 has logged in'),
(83, '2022-02-05 10:33 PM', 'espie73', 'espie73 has logged in'),
(84, '2022-02-05 10:33 PM', 'espie73', 'espie73 has logged in'),
(85, '2022-02-06 01:07 PM', 'espie73', 'espie73 has logged in'),
(86, '2022-02-08 01:44 PM', 'arleen75', 'arleen75 has logged in'),
(87, '2022-02-08 03:01 PM', 'espie73', 'espie73 has logged in'),
(88, '2022-02-10 10:56 AM', 'espie73', 'espie73 has logged in'),
(89, '2022-02-10 10:59 AM', 'espie73', 'espie73 has logged out.'),
(90, '2022-02-10 11:00 AM', 'espie73', 'espie73 has logged in'),
(91, '2022-02-10 01:52 PM', 'espie73', 'espie73 has logged in'),
(92, '2022-02-10 01:52 PM', 'espie73', 'espie73 has logged in'),
(93, '2022-02-10 09:31 PM', 'espie73', 'espie73 has logged in'),
(94, '2022-02-12 10:31 PM', 'espie73', 'espie73 has logged in'),
(95, '2022-02-13 08:26 PM', 'espie73', 'espie73 has logged in'),
(96, '2022-02-14 11:39 PM', 'espie73', 'espie73 has logged in'),
(97, '2022-02-15 08:09 PM', 'espie73', 'espie73 has logged in'),
(98, '2022-02-16 12:04 AM', 'arleen75', 'arleen75 has logged in'),
(99, '2022-02-16 12:05 AM', 'arleen75', 'arleen75 rejected an appointment.'),
(100, '2022-02-21 07:44 PM', 'arleen75', 'arleen75 has logged in');

-- --------------------------------------------------------

--
-- Table structure for table `doctorreport_tb`
--

CREATE TABLE `doctorreport_tb` (
  `report_id` int(11) NOT NULL,
  `patient_id` varchar(500) NOT NULL,
  `doctor` varchar(500) NOT NULL,
  `mw1` varchar(500) NOT NULL,
  `mw2` varchar(500) NOT NULL,
  `date` varchar(500) NOT NULL,
  `bp` varchar(500) NOT NULL,
  `prescribe` varchar(500) NOT NULL,
  `diagnostic` varchar(500) NOT NULL,
  `img` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `time` varchar(250) NOT NULL,
  `service` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctorreport_tb`
--

INSERT INTO `doctorreport_tb` (`report_id`, `patient_id`, `doctor`, `mw1`, `mw2`, `date`, `bp`, `prescribe`, `diagnostic`, `img`, `name`, `time`, `service`) VALUES
(1, 'RM07-0114-87-1', 'Esperanza Robles', 'Lhen Cabigao', 'Arleen Samson', '2022-02-02', '120/90', 'Diphenhydramine 25mg Tablet, Guaifenesin 10mg Capsule', '24 week pregnant', 'patient2.jpg', 'Ash Cruz', '11:00 AM', 'Pap Smear'),
(2, 'RM07-0213-75-2', 'Esperanza Robles', 'Lhen Cabigao', 'Arleen Samson', '2022-02-02', '110/90', 'Acetaminophen 15mg Capsule', '7 months pregnant', 'patient3.jpg', 'Elizabeth Binuya', '12:30 PM', 'Pap Smear'),
(3, 'RM09-0708-93-3', 'Esperanza Robles', 'Lhen Cabigao', 'Arleen Samson', '2022-02-02', '130/70', 'Dextromethorphan 5mg Capsule', '2 week before due date of pregnancy', 'patient4.jpg', 'Sofia Tolentino', '02:30 PM', 'Pap Smear'),
(4, 'RM09-0124-17-4', 'Esperanza Robles', 'Lhen Cabigao', 'Arleen Samson', '2022-02-02', '120/70', 'Warfarin 10mg Capsule', '10 weeks pregnant', 'spatient5.jpg', 'Mila Mercado', '10:30 AM\n', 'Pap Smear'),
(5, 'RM10-0114-00-5', 'Esperanza Robles', 'Lhen Cabigao', 'Arleen Samson', '2022-02-02', '110/70', 'Robitusin 10ml Liquid', '1 month pregnant', 'patient6.jpg', 'Bean Dela Cruz', '03:30 PM', 'Pap Smear'),
(6, 'RM07-0114-87-1', 'Esperanza Robles', 'Theresita Garcia', 'Arleen Samson', '2022-01-28', '110/90', 'Dextromethorphan 5mg Capsule', '12 weeks pregnant', 'patient2.jpg', 'Ash Cruz', '02:30 PM', 'Pap Smear'),
(7, 'RM11-0508-86-6', 'Esperanza Robles', 'Lhen Cabigao', 'Arleen Samson', '2022-02-02', '120/70', 'Acetaminophen 15mg Capsule', '16 weeks pregnant', 'patient7.jpg', 'Ivy Antonio', '11:00 AM', 'Pap Smear'),
(8, 'RM13-1229-95-7', 'Esperanza Robles', 'Lhen Cabigao', 'Arleen Samson', '2022-01-10', '140/90', 'Dextromethorphan 5mg Capsule', '7 weeks pregnant', 'patient8.jpg', 'Julia Garcia', '02:30 PM', 'Pap Smear'),
(9, 'RM13-0217-80-8', 'Esperanza Robles', 'Lhen Cabigao', 'Arleen Samson', '2022-02-02', '110/70', 'Diphenhydramine 25mg Tablet, Guaifenesin 10mg Capsule', '8 day before pregnany due date', 'patient9.jpg', 'Gabriella De Jesus', '03:30 PM', 'Pap Smear'),
(10, 'RM15-0415-76-9', 'Esperanza Robles', 'Lhen Cabigao', 'Arleen Samson', '2022-01-05', '130/80', 'Dextromethorphan 5mg Capsule', '8 weeks pregnant', 'patient10.jpg', 'Alice Cabrera', '11:00 AM', 'Pap Smear'),
(11, 'RM07-0114-87-1', 'Esperanza Robles', 'Lhen Cabigao', 'Arleen Samson', '2022-01-02', '120/70', 'Robitusin 10ml Liquid', '4 weeks pregnant', 'patient2.jpg', 'Ash Cruz', '02:30 PM', 'Pap Smear'),
(14, 'RM07-0114-87-1', 'Esperanza Robles', 'Lhen Cabigao', 'Arleen Samson', '2022-02-05', '120/80', 'Warfarin', '5w weeks pregnant', 'patient2.jpg', 'Ash Cruz', '03:08 PM', 'Pap Smear');

-- --------------------------------------------------------

--
-- Table structure for table `general_tb`
--

CREATE TABLE `general_tb` (
  `g_id` int(250) NOT NULL,
  `g_Sitename` varchar(250) NOT NULL,
  `g_LogoLight` varchar(250) NOT NULL,
  `g_LogoDark` varchar(250) NOT NULL,
  `g_Vision` varchar(250) NOT NULL,
  `g_Contact` varchar(250) NOT NULL,
  `g_Location` varchar(250) NOT NULL,
  `g_Email` varchar(250) NOT NULL,
  `g_WorkingHours` varchar(250) NOT NULL,
  `h_Tagline` varchar(250) NOT NULL,
  `h_Layoutimg` varchar(250) NOT NULL,
  `h_slide1` varchar(250) NOT NULL,
  `h_slide2` varchar(250) NOT NULL,
  `h_slide3` varchar(250) NOT NULL,
  `a_about` varchar(1000) NOT NULL,
  `a_layoutimg` varchar(250) NOT NULL,
  `e_content` varchar(1000) NOT NULL,
  `e_staffImage` varchar(1000) NOT NULL,
  `e_staffQuoute` longtext NOT NULL,
  `e_staffQuoteBy` varchar(1000) NOT NULL,
  `s_img` varchar(1000) NOT NULL,
  `s_Sheader` varchar(1000) NOT NULL,
  `s_sDesc` longtext NOT NULL,
  `holidays` longtext NOT NULL,
  `holiday_name` text NOT NULL,
  `companyCode` varchar(250) NOT NULL,
  `googlemap` text NOT NULL,
  `facebook` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `general_tb`
--

INSERT INTO `general_tb` (`g_id`, `g_Sitename`, `g_LogoLight`, `g_LogoDark`, `g_Vision`, `g_Contact`, `g_Location`, `g_Email`, `g_WorkingHours`, `h_Tagline`, `h_Layoutimg`, `h_slide1`, `h_slide2`, `h_slide3`, `a_about`, `a_layoutimg`, `e_content`, `e_staffImage`, `e_staffQuoute`, `e_staffQuoteBy`, `s_img`, `s_Sheader`, `s_sDesc`, `holidays`, `holiday_name`, `companyCode`, `googlemap`, `facebook`) VALUES
(1, 'Robles Maternity Clinic', 'webIconWhite.png', 'webIcon.png', 'A lead lying in clinic in the provision of quality affordable service in caring for women, expectant mothers, and newborn within the municipality.', '+63 923 020 1174', 'MacArthur Hwy, Apalit, Pampanga City', 'roblesmaternityclinic@gmail.com', 'Mon-Sat: 09:00am-05:00pm', 'Obsetrics and Gynecology in Calumpit, Bulacan. Robles is a dedicated womens health center.', '611.png', 'index_slideshow1.png', 'index_slideshow2.png', 'index_slideshow3.png', 'Robles Maternity Clinic are owned by Dr. Arnel Robles and Dr. Maria Esperanza Robles. They are a couple who graduated as an ob-gyn, a doctor with expertise in female reproductive health, pregnancy, and childbirth. In 1999, the couple moved to Apalit, Pampanga, wherein they decided to start a lying-in clinic named Robles Maternity Clinic. The couple was both graduates when they decided to start their careers driven by their passion.', 'about_robles.png', 'Our team collaborated with the Robles Maternity Clinic to create a convenient obstetrical core. We are committed to providing a system that helps employees, doctors, and patients. This manner, everyone involved in the system is informed.', 'dra.png,dr.png,arleen.png,tess.png,len.png', 'Hard work spotlights the character of people: some turn up their sleeves, some turn up their noses, and some dont turn up at all.|()|If you want to succeed, you should strike out on new paths, rather than travel the worn paths of accepted success.|()|The most important thing about art is to work. Nothing else matters except sitting down every day and trying.|()|Define success on your own terms, achieve it by your own rules, and build a life youre proud to live.|()|The big secret in life is that there is no big secret. Whatever your goal, you can get there if youre willing to work.', 'Sam Ewing|()|John Rockefeller|()|Steven Pressfield|()|Anne Sweeney|()|Oprah Winfrey', 'pt_test.png,prenatal.png,postnatal.png,newborn.png,hearing.png,papsmear.png,familyplanning.png,immun.png,delivery.png,2x2(Formal).jpg', 'Pregnancy Test,Pre-Natal Checkup,Post-Natal Checkup,Newborn Screening,Hearing Test,Pap Smear,Family Planning,Immunization,Delivery', 'A pregnancy test can tell whether you are pregnant by checking for a particular hormone in your urine or blood. The hormone is called human chorionic gonadotropin (HCG). HCG is made in a womans placenta after a fertilized egg implants in the uterus. It is normally made only during pregnancy. <br><br> A urine pregnancy test can find the HCG hormone about a week after youve missed a period. The test can be done in a health care providers office or with a home test kit. These tests are basically the same, so many women choose to use a home pregnancy test before calling a provider. When used correctly, home pregnancy tests are 97–99 percent accurate.<br><br> A pregnancy blood test is done in a health care providers office. It can find smaller amounts of HCG, and can confirm or rule out a pregnancy earlier than a urine test. A blood test can detect pregnancy even before youve missed a period. Pregnancy blood tests are about 99 percent accurate. A blood test is often used to confirm the results of a home pregnancy test.<br><br><br>|()|Pregnancy or prenatal care is medical care intended for pregnant women. At the first sign of being on the way, expectant mothers need to follow a pregnancy checkup schedule to ensure a healthy pregnancy until childbirth. During this series of visits, mothers can discuss important matters regarding their health and that of their baby with the doctor.<br><br> Another crucial aspect of the pregnancy checkup requires that soon-to-be-mothers undergo physical exams, weight checks, laboratory tests, and imaging scans. By taking these, women under prenatal care can be more confident about avoiding pregnancy-related complications such as high blood pressure or diabetes.<br></br> During pregnancy checkups, doctors can also prescribe prenatal vitamins to promote the healthy development of the fetus inside the womb. It then follows that prenatal care is a sure way for pregnant women to receive the right medication, nutrition, or treatment if needed.<br><br><br>|()|A postpartum checkup is a medical checkup you get after having a baby to make sure you’re recovering well from labor and birth. Go to your postpartum checkups, even if you’re feeling fine. They’re an important part of your overall pregnancy care. Postpartum care is important because new moms are at risk of serious and sometimes life-threatening health complications in the days and weeks after giving birth. Too many new moms have or even die from health problems that may be prevented by getting postpartum care.  <br><br>Postpartum checkups are important for any new mom. They’re especially important for moms who have a loss, including: <br><br><li> Miscarriage. This is when a baby dies in the womb before 20 weeks of pregnancy.</li><br><li>Stillbirth. This is when a baby dies in the womb after 20 weeks of pregnancy.</li><br><li> Neonatal death. This is when a baby dies in the first 28 days of life.</li><br><br>When these things happen, your postpartum checkups may help your health care provider or a genetic counselor learn more about what happened and see if you may be at risk for the same condition in another pregnancy. A genetic counselor is a person who is trained to help you understand about genes, birth defects and other medical conditions that run in families, and how they can affect your health and your babys health.<br><br><br>|()|Newborn screening helps in early identification of several genetic, endocrine and	metabolic diseases. A baby is saved 2 out of	every 3 days through newborn screenings. Saved means that a	childs	life is improved	with early detection and	intervention. Many of these	diseases if	not	caught early lead to brain damage, disability, and death. While many are not curable, they are medically manageable	if caught	early and thus improve	lives. In addition to lives saved, newborn	screenings save	money in the long run with reduced extended	care costs	and	what are called	diagnostic odyssey	costs; money spent on trying to	figure out	what is	wrong, testing for variety of rare disorders later in	life when not caught at	birth.<br><br> The screening program in	Missouri began in 1965, and	now	Missouri screens for more of these diseases	than any other state. The diseases that newborn	screenings look for do not show	any	symptoms in	the	newborns. This is why getting the screenings	within 24-48 of	birth are so important. Most children who are diagnosed	early can live full, productive	lives, and timing makes all	the	difference.The blood spot test is a simple prick in a newborns heel, placing spots of blood onto a card that is then sent to the Missouri State Public Health Lab for testing.<br><br><br>|()|Hearing tests carried out soon after birth can help identify most babies with significant hearing loss, and testing later in childhood can pick up any problems that have been missed or have been slowly getting worse.<br><br> Without routine hearing tests, theres a chance that a hearing problem could go undiagnosed for many months or even years.<br><br> Its important to identify hearing problems as early as possible because they can affect your childs speech and language development, social skills and education.<br><br> Treatment is more effective if any problems are detected and managed accordingly early on. An early diagnosis will also help ensure you and your child have access to any special support services you may need.<br><br><br>|()|A Pap smear involves collecting cells from your cervix — the lower, narrow end of your uterus thats at the top of your vagina.<br><br>  Detecting cervical cancer early with a Pap smear gives you a greater chance at a cure. A Pap smear can also detect changes in your cervical cells that suggest cancer may develop in the future. Detecting these abnormal cells early with a Pap smear is your first step in halting the possible development of cervical cancer.<br><br><br>Why its done?<br><br> A Pap smear is used to screen for cervical cancer.<br><br> The Pap smear is usually done in conjunction with a pelvic exam. In women older than age 30, the Pap test may be combined with a test for human papillomavirus (HPV) — a common sexually transmitted infection that can cause cervical cancer. In some cases, the HPV test may be done instead of a Pap smear.<br><br><br>|()|Family planning helps protect women from any health risks that may occur before, during or after childbirth. These include high blood pressure, gestational diabetes, infections, miscarriage and stillbirth.<br><br> According to studies, women who bear more than 4 children are at increased risk for maternal mortality, so they need to plan accordingly. Women who get pregnant after the age of 35 are vulnerable to health risks, so they should be protected through careful planning as well.<br><br> Also, by reducing unintended pregnancies, family planning also removes the option for unsafe abortion.<br><br><br><b>How can we help you?</b><br><br>We offer a wide scope of general and subspecialty inpatient and outpatient services that address every phase a woman experiences throughout her lifetime. We have included Family Planning as one of the modules in our regular mothers’ classes. Our trained OB-GYNs provide family planning counseling allowing our patients to choose which method is appropriate for them. We offer safe, effective, legal, non-abortifacient, and culturally acceptable family planning methods.<br><br><br>|()|Immunization, also called vaccination or shots, is an important way to protect an infants health. Vaccinations can prevent more than a dozen serious diseases. Failure to vaccinate may mean putting children at risk for serious and sometimes fatal diseases.<br><br> Infants are particularly vulnerable to infections; that is why it is so important to protect them with immunization. Immunizations help prevent the spread of disease and protect infants and toddlers against dangerous complications.<br><br> Childhood vaccines or immunizations can seem overwhelming when you are a new parent. Vaccine schedules recommended by agencies and organizations, such as the CDC, the American Academy of Pediatrics, and the American Academy of Family Physicians cover about 14 different diseases.<br><br> Vaccinations not only protect your child from deadly diseases, such as polio, tetanus, and diphtheria, but they also keep other children safe by eliminating or greatly decreasing dangerous diseases that used to spread from child to child.<br><br><br>|()|Also known as labour or delivery, is the ending of pregnancy where one or more babies leaves the uterus by passing through the vagina or by Caesarean section. In 2015, there were about 135 million births globally. About 15 million were born before 37 weeks of gestation, while between 3 and 12% were born after 42 weeks. In the developed world most deliveries occur in hospitals, while in the developing world most births take place at home with the support of a traditional birth attendant.<br><br> The most common way of childbirth is a vaginal delivery. It involves three stages of labour: the shortening and opening of the cervix during the first stage, descent and birth of the baby during the second stage, and the delivery of the placenta during the third stage. The first stage begins with crampy abdominal or back pain that lasts around half a minute and occurs every 10 to 30 minutes. The pain becomes stronger and closer together over time. The second stage ends when the infant is fully expelled. In the third stage, the delivery of the placenta, delayed clamping of the umbilical cord is generally recommended. As of 2014, all major health organisations advise that immediately following vaginal birth, or as soon as the mother is alert and responsive after a Caesarean section, that the infant be placed on the mothers chest, termed skin-to-skin contact, delaying routine procedures for at least one to two hours or until the baby has had its first breastfeeding.<br><br><br>', '2022-01-01(|)2022-01-28(|)2022-02-04', 'new Year(|)Emergency(|)emergency', '123456', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3854.844783811078!2d120.75622951476338!3d14.945738489583448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396564d3614e803%3A0xe9ab22a27c5782dc!2sRobles%20Maternity%20Clinic!5e0!3m2!1sen!2sph!4v1643696326176!5m2!1sen!2sph', 'https://www.facebook.com/Robles-Maternity-Clinic-105418682035506');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_tb`
--

CREATE TABLE `inquiry_tb` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `archive` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquiry_tb`
--

INSERT INTO `inquiry_tb` (`id`, `fname`, `lname`, `email`, `question`, `date`, `status`, `archive`, `time`) VALUES
(5, 'Marian', 'Lorenzo', 'aaliyaaaah.25@gmail.com', 'Good Morning', '03/02/2022', 'read', 'off', '07:58 AM'),
(6, 'Marian', 'Lorenzo', 'aaliyaaaah.25@gmail.com', 'Good Morning', '03/02/2022', 'read', 'off', '07:58 AM'),
(7, 'fred', 'oronce', 'frdrck.oronce@gmail.com', 'What time does the clinic open today?', '03/02/2022', 'read', 'off', '09:14 AM'),
(8, 'test', 'test', 'dsamsonoel@gmail.com', 'hello', '03/02/2022', 'read', 'off', '03:14 PM'),
(9, 'Janna', 'Angeles', 'marianjadelorenzo@gmail.com', 'wazzup', '05/02/2022', 'read', 'off', '08:22 PM');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_tb`
--

CREATE TABLE `medicine_tb` (
  `edit_delete` longtext NOT NULL,
  `id` int(11) NOT NULL,
  `main_id` varchar(250) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subname` varchar(250) NOT NULL,
  `category` varchar(250) NOT NULL,
  `type` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `substock` varchar(250) NOT NULL,
  `mfg_date` varchar(250) NOT NULL,
  `expiration_date` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `main_stat` varchar(250) NOT NULL,
  `stocks` varchar(250) NOT NULL,
  `critStock` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine_tb`
--

INSERT INTO `medicine_tb` (`edit_delete`, `id`, `main_id`, `name`, `subname`, `category`, `type`, `description`, `substock`, `mfg_date`, `expiration_date`, `status`, `main_stat`, `stocks`, `critStock`) VALUES
('diphenhydramine25mgTablethcl2022-02-012022-10-05,diphenhydramine 15mlLiquidGSK2022-01-052022-05-25', 1, 'R22-2210-8', 'diphenhydramine', 'diphenhydramine 25mg,diphenhydramine 15ml', 'Tablet,Liquid', 'hcl,gsk', 'diphenhydramine is an antihistamine mainly used to treat allergies.', '45,35', '2022-02-01,2022-01-05', '2022-10-05,2022-05-25', 'activated,activated', 'activated', '', '20,10'),
('dextromethorphan5mgCapsulejohnson2021-12-082023-02-28', 2, 'R21-2302-9', 'dextromethorphan', 'dextromethorphan 5mg', 'Capsule', 'johnson', 'Medication most often used as a cough suppressant in over-the-counter cold and cough medicines.', '30', '2021-12-08', '2023-02-28', 'activated', 'activated', '', '30'),
('guaifenesin10mgTabletjengga2020-06-022022-12-28,guaifenesin 10mgCapsuleJengga2020-06-022022-12-29,guaifenesin 10mgCapsulejengga2020-06-022023-09-06', 3, 'R20-2212-10', 'guaifenesin', 'guaifenesin 10mg,guaifenesin 10mg,guaifenesin 10mg', 'Tablet,Capsule,Capsule', 'jengga,jengga,jengga', 'intended to help cough out phlegm from the airways.', '15,45,35', '2020-06-02,2020-06-02,2020-06-02', '2022-12-28,2022-12-29,2023-09-06', 'activated,activated,deactivated', 'activated', '', '20,50'),
('acetaminophen 15mgTabletgeneric2020-10-282022-03-17,acetaminophen 15mgCapsulegeneric2020-10-282023-10-17', 4, 'R20-2203-11', 'acetaminophen', 'acetaminophen 15mg,acetaminophen 15mg', 'Tablet,Capsule', 'generic,generic', 'used to treat mild to moderate pain and to reduce fever.', '50,45', '2020-10-28,2020-10-28', '2022-03-17,2023-10-17', 'activated,activated', 'activated', '', '45,20'),
('warfarin 10mgTabletunilab2022-02-042023-03-31', 5, 'R22-2303-12', 'warfarin', 'warfarin 10mg', 'Tablet', 'unilab', 'gamot sa beach na peke', '50', '2022-02-04', '2023-03-31', 'activated', 'activated', '', '20');

-- --------------------------------------------------------

--
-- Table structure for table `patientinfo_db`
--

CREATE TABLE `patientinfo_db` (
  `ctr_id` int(100) NOT NULL,
  `id` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `region` varchar(250) NOT NULL,
  `street` varchar(250) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `municipality` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `bday` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `civilstatus` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_photo` varchar(100) NOT NULL,
  `date_added` varchar(250) NOT NULL,
  `gender_ob` longtext NOT NULL,
  `bday_ob` longtext NOT NULL,
  `bplace_ob` longtext NOT NULL,
  `weight_ob` longtext NOT NULL,
  `delivery_ob` longtext NOT NULL,
  `birth_ob` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patientinfo_db`
--

INSERT INTO `patientinfo_db` (`ctr_id`, `id`, `fname`, `mname`, `lname`, `region`, `street`, `barangay`, `municipality`, `province`, `bday`, `age`, `weight`, `religion`, `civilstatus`, `contact`, `email`, `username`, `password`, `profile_photo`, `date_added`, `gender_ob`, `bday_ob`, `bplace_ob`, `weight_ob`, `delivery_ob`, `birth_ob`) VALUES
(1, 'RM07-0114-87-1', 'Ash', 'Garcia', 'Cruz', 'REGION III (CENTRAL LUZON)', 'Purok 3', 'San Jose', 'CALUMPIT', 'BULACAN', '1987-01-14', '35', '70', 'Catholic', 'Married', '09471357585', 'ash@gmail.com', 'ash14', 'evaluate', 'patient2.jpg', '2007-08-21', 'Female,Male', '2015-02-30,2019-01-11', 'Pampanga|Bulacan', '5,3', 'Cesarean,Cesarean', 'Pre-Term,Pre-Term'),
(2, 'RM07-0213-75-2', 'Elizabeth', 'Santos', 'Binuya', 'REGION III (CENTRAL LUZON)', 'purok 1', 'San Vicente', 'APALIT', 'PAMPANGA', '1975-02-13', '46', '85', 'Iglesia ni Kristo', 'Married', '09956437184', 'elizabeth@gmail.com', 'elizabeth@gmail.com', '09956437184', 'patient3.jpg', '2007-10-13', '', '', '', '', '', ''),
(3, 'RM09-0708-93-3', 'Sofia', 'Lubao', 'Tolentino', 'REGION III (CENTRAL LUZON)', 'Purok 6', 'Meysulao', 'CALUMPIT', 'BULACAN', '1993-07-08', '28', '56', 'Catholic', 'Single', '09457564128', 'sofia@gmail.com', 'sofia@gmail.com', '09457564128', 'patient4.jpg', '2009-11-19', '', '', '', '', '', ''),
(4, 'RM09-0124-17-4', 'Mila', 'Diaz', 'Mercado', 'REGION III (CENTRAL LUZON)', 'Purok 4', 'Iba O\'Este', 'CALUMPIT', 'BULACAN', '1999-11-10', '22', '64', 'Catholic', 'Single', '09396164116', 'mila@gmail.com', 'mila@gmail.com', '09396164116', 'spatient5.jpg', '2009-12-21', '', '', '', '', '', ''),
(5, 'RM10-0114-00-5', 'Bean', 'Gomez', 'Dela Cruz', 'REGION III (CENTRAL LUZON)', 'Purok 7', 'Balite', 'CALUMPIT', 'BULACAN', '2000-01-14', '22', '50', 'Catholic', 'Single', '09167535336', 'bean@gmail.com', 'bean@gmail.com', '09167535336', 'patient6.jpg', '2010-07-08', '', '', '', '', '', ''),
(6, 'RM11-0508-86-6', 'Ivy', 'Cortez', 'Antonio', 'REGION III (CENTRAL LUZON)', 'Purok 5', 'Pio Cruzcosa', 'CALUMPIT', 'BULACAN', '1986-05-08', '35', '74', 'Catholic', 'Married', '09395153115', 'ivy@gmail.com', 'ivy@gmail.com', '09395153115', 'patient7.jpg', '2011-01-28', '', '', '', '', '', ''),
(7, 'RM13-1229-95-7', 'Julia', 'Solis', 'Garcia', 'REGION III (CENTRAL LUZON)', 'Purok 8', 'Balucuc', 'APALIT', 'PAMPANGA', '1995-12-29', '26', '45', 'Methodist', 'Married', '09278646447', 'littlemiss@gmail.com', 'Julia@gmail.com', '09278646447', 'patient8.jpg', '2013-08-14', '', '', '', '', '', ''),
(8, 'RM13-0217-80-8', 'Gabriella', 'Romero', 'De Jesus', 'REGION III (CENTRAL LUZON)', 'Purok 11', 'Santa Cruz', 'MASANTOL', 'PAMPANGA', '1980-02-17', '41', '81', 'Catholic', 'Married', '09394746661', 'gab@gmail.com', 'gab@gmail.com', '09394746661', 'patient9.jpg', '2013-10-19', '', '', '', '', '', ''),
(9, 'RM15-0415-76-9', 'Alice', 'Vargas', 'Cabrera', 'REGION III (CENTRAL LUZON)', 'purok 5', 'Poblacion', 'MABALACAT CITY', 'PAMPANGA', '1976-04-15', '45', '75', 'Catholic', 'Single', '09398184441', 'alice@gmail.com', 'alice@gmail.com', '09398184441', 'patient10.jpg', '2015-04-05', '', '', '', '', '', ''),
(10, 'RM15-0217-80-10', 'Hailey', 'Tamayo', 'Arellano', 'REGION III (CENTRAL LUZON)', 'Purok 1', 'Gugo', 'CALUMPIT', 'BULACAN', '1980-02-17', '41', '60', 'Born Again', 'Married', '09457481245', 'hailey@gmail.com', 'hailey@gmail.com', '09457481245', '', '2015-11-10', '', '', '', '', '', ''),
(11, 'RM15-0223-84-11', 'Clara', 'Atienza', 'Acosta', 'REGION III (CENTRAL LUZON)', 'Purok 7', 'Calumpang', 'CALUMPIT', 'BULACAN', '1984-02-23', '37', '50', 'Catholic', 'Married', '09954812394', 'clara@gmail.com', 'clara@gmail.com', '09954812394', '', '2015-12-18', '', '', '', '', '', ''),
(12, 'RM16-0216-94-12', 'Brielle', 'Moreno', 'Mallari', 'REGION III (CENTRAL LUZON)', 'Purok 5', 'San Pablo Libutad', 'SAN SIMON', 'PAMPANGA', '1994-02-16', '27', '63', 'Methodist', 'Married', '09957835612', 'brielle@gmail.com', 'brielle@gmail.com', '09957835612', '', '2016-02-14', '', '', '', '', '', ''),
(13, 'RM16-0518-78-13', 'Melanie', 'Pepito', 'Dela Rosa', 'REGION III (CENTRAL LUZON)', 'purok 4', 'Palimbang', 'CALUMPIT', 'BULACAN', '1978-05-18', '43', '79', 'Catholic', 'Married', '09675834513', 'melanie@gmail.com', 'melanie@gmail.com', '09675834513', '', '2016-12-19', '', '', '', '', '', ''),
(14, 'RM17-0415-87-14', 'Rose', 'Esguerra', 'Roque', 'REGION III (CENTRAL LUZON)', 'Purok 7', 'Sucad', 'APALIT', 'PAMPANGA', '1987-04-15', '34', '57', 'Catholic', 'Single', '09456361782', 'rose@gmail.com', 'rose@gmail.com', '09456361782', '', '2017-02-13', '', '', '', '', '', ''),
(15, 'RM17-0223-95-15', 'Isabelle', 'Nicolas', 'Ancheta', 'REGION III (CENTRAL LUZON)', 'Purok 1', 'Sulipan', 'APALIT', 'PAMPANGA', '1995-02-23', '26', '55', 'Catholic', 'Single', '09453746223', 'isabelle@gmail.com', 'isabelle@gmail.com', '09453746223', '', '2017-05-20', '', '', '', '', '', ''),
(16, 'RM18-1113-99-16', 'Valerie', 'Gamboa', 'Estrella', 'REGION III (CENTRAL LUZON)', 'Purok 2', 'Caniogan', 'CALUMPIT', 'BULACAN', '1999-11-13', '22', '53', 'Born Again', 'Single', '09957641234', 'valerie@gmail.com', 'valerie@gmail.com', '09957641234', '', '2018-06-30', '', '', '', '', '', ''),
(17, 'RM19-0113-94-17', 'Callie', 'Gallardo', 'Rosario', 'REGION III (CENTRAL LUZON)', 'Purok 8', 'Colgante', 'APALIT', 'PAMPANGA', '1994-01-13', '28', '66', 'Iglesia ni kristo', 'Married', '09498487771', 'callie@gmail.com', 'callie@gmail.com', '09498487771', '', '2019-09-12', '', '', '', '', '', ''),
(18, 'RM20-0224-92-18', 'Molly', 'Canlas', 'Cruz', 'REGION III (CENTRAL LUZON)', 'Purok 5', 'Gatbuca', 'CALUMPIT', 'BULACAN', '1992-02-24', '29', '66', 'Catholic', 'Single', '09574617849', 'molly@gmail.com', 'molly@gmail.com', '09574617849', '', '2020-11-15', '', '', '', '', '', ''),
(19, 'RM21-1217-97-19', 'Freya', 'Guerrero', 'Padua', 'REGION III (CENTRAL LUZON)', 'Purok 3', 'Calantipe', 'APALIT', 'PAMPANGA', '1997-12-17', '24', '51', 'Catholic', 'Single', '09456471245', 'freya@gmail.com', 'freya@gmail.com', '09456471245', '', '2021-05-07', '', '', '', '', '', ''),
(20, 'RM21-0118-85-20', 'Juliana', 'Bernal', 'Ronquillo', 'REGION III (CENTRAL LUZON)', 'purok 4', 'Sulipan', 'APALIT', 'PAMPANGA', '1985-01-18', '37', '66', 'Catholic', 'Married', '09945869014', 'juliana@gmail.com', 'juliana@gmail.com', '09945869014', '', '2021-12-20', '', '', '', '', '', ''),
(24, 'RM22-0617-87-21', 'Jollina', 'Catanghal', 'Reyes', 'REGION III (CENTRAL LUZON)', 'Purok 6', 'Lalangan', 'PLARIDEL', 'BULACAN', '1987-06-17', '34', '67', 'Catholic', 'Married', '09938746581', 'jollina@gmail.com', 'jollina@gmail.com', '09938746581', '', '2022-02-02', 'Male', '2015-09-30', 'Pampanga', '5', 'Cesarean', 'Pre-Term');

-- --------------------------------------------------------

--
-- Table structure for table `pendingappointment_tb`
--

CREATE TABLE `pendingappointment_tb` (
  `id` int(100) NOT NULL,
  `patient_id` varchar(250) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `service` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendingappointment_tb`
--

INSERT INTO `pendingappointment_tb` (`id`, `patient_id`, `fname`, `mname`, `lname`, `address`, `contact`, `email`, `date`, `time`, `status`, `service`) VALUES
(12, 'RM07-0114-87-1', 'Ash', 'Garcia', 'Cruz', 'San Jose, CALUMPIT, BULACAN', '09471357585', 'ash@gmail.com', '23/02/2022', '12:30 pm - 1:00 pm', 'Pending', ''),
(14, '', 'Kharl', '', 'Samson', 'Calumpit', '09453746128', 'biancachinee@gmail.com', '24/02/2022', '10:30 am - 11:00 am', 'Pending', 'Pap Smear');

-- --------------------------------------------------------

--
-- Table structure for table `prescribemedhistory_tb`
--

CREATE TABLE `prescribemedhistory_tb` (
  `id` int(250) NOT NULL,
  `meds_name` varchar(1000) NOT NULL,
  `issuedby` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `patient_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescribemedhistory_tb`
--

INSERT INTO `prescribemedhistory_tb` (`id`, `meds_name`, `issuedby`, `date`, `patient_name`) VALUES
(1, 'diphenhydramine 25mg (Tablet) - 5pcs', 'esperanza robles', '2022-02-02', 'jolina garcia'),
(2, 'guaifenesin 10mg (Tablet) - 5pcs, guaifenesin 10mg (Tablet) - 5pcs', 'arleen samson', '2022-02-02', 'sample name'),
(3, 'guaifenesin 10mg (Tablet) - 10pcs, guaifenesin 10mg (Tablet) - 5pcs', 'arleen samson', '2022-02-03', 'janna');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `time` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `time`) VALUES
(1, '10:00 am - 10:30 am'),
(2, '10:30 am - 11:00 am'),
(3, '11:00 am - 11:30 am'),
(4, '11:30 am - 12:00 pm'),
(5, '12:00 pm - 12:30 pm'),
(6, '12:30 pm - 1:00 pm'),
(7, '1:00 pm - 1:30 pm'),
(8, '1:30 pm - 2:00 pm'),
(9, '2:00 pm - 2:30 pm'),
(10, '2:30 pm - 3:00 pm'),
(11, '3:00 pm - 3:30 pm'),
(12, '3:30 pm - 4:00 pm');

-- --------------------------------------------------------

--
-- Table structure for table `staff_db`
--

CREATE TABLE `staff_db` (
  `main_id` int(250) NOT NULL,
  `id` varchar(250) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `reg` varchar(250) NOT NULL,
  `street` varchar(100) NOT NULL,
  `bar` varchar(100) NOT NULL,
  `mun` varchar(100) NOT NULL,
  `prov` varchar(100) NOT NULL,
  `civil_status` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birthday` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `schedule` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `profile_photo` varchar(100) NOT NULL,
  `date_start` varchar(250) NOT NULL,
  `date_end` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_db`
--

INSERT INTO `staff_db` (`main_id`, `id`, `fname`, `mname`, `lname`, `reg`, `street`, `bar`, `mun`, `prov`, `civil_status`, `religion`, `phone`, `email`, `birthday`, `age`, `username`, `password`, `role`, `schedule`, `time`, `profile_photo`, `date_start`, `date_end`, `status`) VALUES
(1, 'OB-0112-12-1', 'Esperanza', 'Tandoc ', 'Robles', 'REGION III (CENTRAL LUZON)', 'Goldridge sub. ', 'Tabang', 'GUIGUINTO', 'BULACAN', 'Married', 'Catholic', '09396163114', 'espie73@gmail.com', '1973-06-12', '48', 'espie73', 'evaluate', 'Ob-Gyne', 'Monday,Wednesday,Friday', '10:00 am - 03:00 pm', 'dra.png', '1990-12-01', '', 'Active'),
(200, '0', 'No Duty', '', 'For Today', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Sunday', '0:00 am - 0:00 pm', 'error_validation.gif', '', '', 'Active'),
(201, '0', 'No Duty', '', 'For Today', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Sunday', '0:00 am - 0:00 pm', 'error_validation.gif', '', '', 'Active'),
(202, '0', 'No Duty', '', 'For Today', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Sunday', '0:00 am - 0:00 pm', 'error_validation.gif', '', '', 'Active'),
(205, 'OB-0112-02-2', 'Arnel', 'Tandoc', 'Robles', 'REGION III (CENTRAL LUZON)', 'Goldridge Subdivision', 'Tabang', 'GUIGUINTO', 'BULACAN', 'Married', 'Catholic', '09787461541', 'arnel@gmail.com', '1984-02-02', '38', 'arnel@gmail.com', '09787461541', 'Ob-Gyne', 'Tuesday,Thursday,Saturday', '10:00 am - 04:00 pm', 'dr.png', '1990-12-01', '', 'Active'),
(206, 'MW-0401-17-3', 'Arleen', 'Dela Cruz', 'Samson', 'REGION III (CENTRAL LUZON)', 'Kalye Onse', 'San Miguel', 'CALUMPIT', 'BULACAN', 'Married', 'Catholic', '09196714289', 'arleen@gmail.com', '1975-01-17', '47', 'arleen75', 'evaluate', 'Midwife', 'Monday,Tuesday,Thursday,Saturday', '09:00 am - 04:00 pm', 'arleen.png', '2000-01-04', '', 'Active'),
(207, 'MW-0711-16-4', 'Theresita', 'Cruz', 'Garcia', 'REGION III (CENTRAL LUZON)', 'Purok 4', 'Calizon', 'CALUMPIT', 'BULACAN', 'Married', 'Born Again', '09456763967', 'thess@gmail.com', '1977-06-16', '44', 'thess@gmail.com', '09456763967', 'Midwife', 'Monday,Wednesday,Friday,Saturday', '09:00 am - 04:00 pm', 'tess.png', '2005-11-07', '', 'Active'),
(208, 'MW-2712-17-5', 'Lhen', 'Santos', 'Cabigao', 'REGION III (CENTRAL LUZON)', 'Purok 1', 'Balungao', 'CALUMPIT', 'BULACAN', 'Single', 'jehovahs witnesses', '09457619234', 'lhen@gmail.com', '1975-09-17', '46', 'lhen@gmail.com', '09457619234', 'Midwife', 'Tuesday,Wednesday,Thursday,Friday', '09:00 am - 04:00 pm', 'len1.png', '2005-12-27', '', 'Active'),
(209, 'MW-2202-10-6', 'Joane', 'Mislang', 'Graciano', 'REGION III (CENTRAL LUZON)', 'Purok 4', 'San Jose', 'SAN SIMON', 'PAMPANGA', 'Single', 'Catholic', '09187647898', 'joane@gmail.com', '1990-06-02', '31', 'joane@gmail.com', '09187647898', 'Midwife', 'Monday,Friday,Tuesday,Thursday', '09:00 am - 04:00 pm', '', '2018-10-22', '2020-06-07', 'Inactive'),
(210, 'OB-0302-03-7', 'test', 'test', 'test', 'REGION II (CAGAYAN VALLEY)', 'test', 'Minanga Norte', 'LASAM', 'CAGAYAN', 'Married', 'Catholic', '09396164116', 'test@gmail.com', '1989-11-03', '32', 'test@gmail.com', '09396164116', 'Ob-Gyne', 'Monday', '09:00 am - 04:00 pm', '', '2022-02-03', '2022-02-03', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `provider_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `provider`, `provider_value`) VALUES
(4, 'google', '1//0elhh325x2fRUCgYIARAAGA4SNwF-L9IrwIcOFbALr71vz9oljMGbJn_LStpiJKHlFrbiEjcpvlToYu89m6NjRJa6cwCwZKv5M28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acceptedappointment_tb`
--
ALTER TABLE `acceptedappointment_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appoinment_verification_tb`
--
ALTER TABLE `appoinment_verification_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_tb`
--
ALTER TABLE `audit_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorreport_tb`
--
ALTER TABLE `doctorreport_tb`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `general_tb`
--
ALTER TABLE `general_tb`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `inquiry_tb`
--
ALTER TABLE `inquiry_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_tb`
--
ALTER TABLE `medicine_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patientinfo_db`
--
ALTER TABLE `patientinfo_db`
  ADD PRIMARY KEY (`ctr_id`);

--
-- Indexes for table `pendingappointment_tb`
--
ALTER TABLE `pendingappointment_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescribemedhistory_tb`
--
ALTER TABLE `prescribemedhistory_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_db`
--
ALTER TABLE `staff_db`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acceptedappointment_tb`
--
ALTER TABLE `acceptedappointment_tb`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `appoinment_verification_tb`
--
ALTER TABLE `appoinment_verification_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `audit_tb`
--
ALTER TABLE `audit_tb`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `doctorreport_tb`
--
ALTER TABLE `doctorreport_tb`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `general_tb`
--
ALTER TABLE `general_tb`
  MODIFY `g_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inquiry_tb`
--
ALTER TABLE `inquiry_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `medicine_tb`
--
ALTER TABLE `medicine_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patientinfo_db`
--
ALTER TABLE `patientinfo_db`
  MODIFY `ctr_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pendingappointment_tb`
--
ALTER TABLE `pendingappointment_tb`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `prescribemedhistory_tb`
--
ALTER TABLE `prescribemedhistory_tb`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `staff_db`
--
ALTER TABLE `staff_db`
  MODIFY `main_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
