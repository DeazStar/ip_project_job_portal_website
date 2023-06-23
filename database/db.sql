-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 23, 2023 at 02:09 AM
-- Server version: 8.0.33-0ubuntu0.22.04.2
-- PHP Version: 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `applied_job`
--

CREATE TABLE `applied_job` (
  `id` int NOT NULL,
  `job_postings_id` int NOT NULL,
  `job_seeker_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `applied_job`
--

INSERT INTO `applied_job` (`id`, `job_postings_id`, `job_seeker_id`) VALUES
(1, 2, 48);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `website` varchar(60) DEFAULT NULL,
  `founded_date` date NOT NULL,
  `email` varchar(60) NOT NULL,
  `recovery_email` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_number` varchar(60) NOT NULL,
  `country` varchar(60) NOT NULL,
  `address` varchar(60) DEFAULT NULL,
  `company_logo_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `postcode` int NOT NULL,
  `description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `website`, `founded_date`, `email`, `recovery_email`, `password`, `phone_number`, `country`, `address`, `company_logo_url`, `city`, `postcode`, `description`) VALUES
(2, 'DeazStar Tech', 'https://web.telegram.org', '2023-06-21', 'company@gmail.com', 'company@gmail.com', '05f6759b74183bda46782558e2559017', '0946612595', 'Jordan', 'Addis Ababa', NULL, '', 1000, '');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `education_id` int NOT NULL,
  `degree_type` varchar(60) NOT NULL,
  `field` varchar(60) NOT NULL,
  `institute` varchar(60) NOT NULL,
  `enrolled_date` year DEFAULT NULL,
  `graduated_date` year DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`education_id`, `degree_type`, `field`, `institute`, `enrolled_date`, `graduated_date`) VALUES
(9, 'bachelors', 'Computer Science', 'Addis Ababa Science and Technology University (AASTU)', '2020', '2025'),
(12, 'bachelors', 'Computer Science', 'Adama Science and Technology University (ASTU)', '2020', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `employment`
--

CREATE TABLE `employment` (
  `employment_id` int NOT NULL,
  `position` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `started_date` year DEFAULT NULL,
  `date_left` year DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employment`
--

INSERT INTO `employment` (`employment_id`, `position`, `company`, `started_date`, `date_left`) VALUES
(15, 'Junior Software Enginner', 'Holberton School', '2022', '2024');

-- --------------------------------------------------------

--
-- Table structure for table `job_postings`
--

CREATE TABLE `job_postings` (
  `id` int NOT NULL,
  `company_id` int NOT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `job_posted_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `company_name` varchar(255) NOT NULL,
  `company_location` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `company_industry` varchar(255) NOT NULL,
  `employment_type` varchar(255) NOT NULL,
  `seniority_level` varchar(255) NOT NULL,
  `payment_amount` decimal(20,0) NOT NULL,
  `payment_frequency` varchar(255) NOT NULL,
  `job_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `job_postings`
--

INSERT INTO `job_postings` (`id`, `company_id`, `company_logo`, `job_posted_date`, `company_name`, `company_location`, `job_title`, `company_industry`, `employment_type`, `seniority_level`, `payment_amount`, `payment_frequency`, `job_description`) VALUES
(1, 0, '1687465966_Screenshot from 2023-06-22 22-46-18.png', '2023-06-22 20:32:46', 'DeadZstar Technology', 'Addis Ababa', 'Front End Developer', 'Information_tecnology', 'Full-Time', 'Entery-Level', 40, 'Hour', 'we are looking for a dump ass nigga to join our company'),
(2, 2, '1687465966_Screenshot from 2023-06-22 22-46-18.png', '2023-06-22 23:38:01', 'DeazStar', 'Addis Ababa', 'Software Engineering', 'Information Technology', 'Full Time', 'Junior', 140, 'Per Day', 'sdkjflaskjfdlasjfdlkdsafjalskdjflsakdfjlsadjflsadjflasdkfjslkdjf');

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker`
--

CREATE TABLE `job_seeker` (
  `job_seeker_id` int NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` char(1) NOT NULL,
  `email` varchar(60) NOT NULL,
  `recovery_email` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `country` varchar(60) NOT NULL,
  `professional_title` varchar(255) DEFAULT NULL,
  `postcode` int DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `address` varchar(60) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `profile_picture_url` varchar(255) DEFAULT NULL,
  `resume_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `job_seeker`
--

INSERT INTO `job_seeker` (`job_seeker_id`, `first_name`, `last_name`, `date_of_birth`, `gender`, `email`, `recovery_email`, `password`, `phone_number`, `country`, `professional_title`, `postcode`, `city`, `address`, `description`, `profile_picture_url`, `resume_url`) VALUES
(48, 'Naod', 'Ararsa', '2023-06-07', 'M', 'naodararsa71@gmail.om', 'naodararsa7@gmail.com', '846c154f6e7c4d35281fdf70be7e8225', '0946612595', 'Jordan', 'Software Engineer', 1000, 'Addis  Ababa', 'Addis Ababa', 'hey am a software engineer', '/var/www/html/ip_project_job_portal_website/public/uploads/jobseeker-profile/6494b6e26f1819.20951258.jpg', '/var/www/html/ip_project_job_portal_website/public/uploads/jobseeker-profile/resume/6494bc892fdc51.09108411.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `language_id` int NOT NULL,
  `language` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`language_id`, `language`) VALUES
(22, 'Afar');

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `skill_id` int NOT NULL,
  `skill` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`skill_id`, `skill`) VALUES
(6, 'HTML');

-- --------------------------------------------------------

--
-- Table structure for table `user_education`
--

CREATE TABLE `user_education` (
  `job_seeker_id` int NOT NULL,
  `education_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_education`
--

INSERT INTO `user_education` (`job_seeker_id`, `education_id`) VALUES
(48, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user_employment`
--

CREATE TABLE `user_employment` (
  `employment_id` int DEFAULT NULL,
  `job_seeker_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_employment`
--

INSERT INTO `user_employment` (`employment_id`, `job_seeker_id`) VALUES
(15, 48);

-- --------------------------------------------------------

--
-- Table structure for table `user_language`
--

CREATE TABLE `user_language` (
  `job_seeker_id` int NOT NULL,
  `language_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_language`
--

INSERT INTO `user_language` (`job_seeker_id`, `language_id`) VALUES
(48, 22);

-- --------------------------------------------------------

--
-- Table structure for table `user_skill`
--

CREATE TABLE `user_skill` (
  `skill_id` int DEFAULT NULL,
  `job_seeker_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_skill`
--

INSERT INTO `user_skill` (`skill_id`, `job_seeker_id`) VALUES
(6, 48);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applied_job`
--
ALTER TABLE `applied_job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_applied_job_job_posting_id` (`job_postings_id`),
  ADD KEY `fk_applied_job_job_seeker_id` (`job_seeker_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`education_id`);

--
-- Indexes for table `employment`
--
ALTER TABLE `employment`
  ADD PRIMARY KEY (`employment_id`);

--
-- Indexes for table `job_postings`
--
ALTER TABLE `job_postings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_seeker`
--
ALTER TABLE `job_seeker`
  ADD PRIMARY KEY (`job_seeker_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`skill_id`);

--
-- Indexes for table `user_education`
--
ALTER TABLE `user_education`
  ADD KEY `fk_user_edu_job_seeker_id` (`job_seeker_id`),
  ADD KEY `fk_user_edu_education_id` (`education_id`);

--
-- Indexes for table `user_employment`
--
ALTER TABLE `user_employment`
  ADD KEY `fk_user_employment_employment_id` (`employment_id`),
  ADD KEY `fk_user_employment_job_seeker_id` (`job_seeker_id`);

--
-- Indexes for table `user_language`
--
ALTER TABLE `user_language`
  ADD KEY `fk_user_language_language_id` (`language_id`),
  ADD KEY `fk_user_language_job_seeker_id` (`job_seeker_id`);

--
-- Indexes for table `user_skill`
--
ALTER TABLE `user_skill`
  ADD KEY `fk_user_skill_job_seeker_id` (`job_seeker_id`),
  ADD KEY `fk_user_skill_skill_id` (`skill_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applied_job`
--
ALTER TABLE `applied_job`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `education_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employment`
--
ALTER TABLE `employment`
  MODIFY `employment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `job_postings`
--
ALTER TABLE `job_postings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_seeker`
--
ALTER TABLE `job_seeker`
  MODIFY `job_seeker_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `language_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `skill_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applied_job`
--
ALTER TABLE `applied_job`
  ADD CONSTRAINT `fk_applied_job_job_posting_id` FOREIGN KEY (`job_postings_id`) REFERENCES `job_postings` (`id`),
  ADD CONSTRAINT `fk_applied_job_job_seeker_id` FOREIGN KEY (`job_seeker_id`) REFERENCES `job_seeker` (`job_seeker_id`);

--
-- Constraints for table `user_education`
--
ALTER TABLE `user_education`
  ADD CONSTRAINT `fk_user_edu_education_id` FOREIGN KEY (`education_id`) REFERENCES `education` (`education_id`),
  ADD CONSTRAINT `fk_user_edu_job_seeker_id` FOREIGN KEY (`job_seeker_id`) REFERENCES `job_seeker` (`job_seeker_id`),
  ADD CONSTRAINT `user_education_ibfk_1` FOREIGN KEY (`job_seeker_id`) REFERENCES `job_seeker` (`job_seeker_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_education_ibfk_2` FOREIGN KEY (`education_id`) REFERENCES `education` (`education_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_employment`
--
ALTER TABLE `user_employment`
  ADD CONSTRAINT `fk_user_employment_employment_id` FOREIGN KEY (`employment_id`) REFERENCES `employment` (`employment_id`),
  ADD CONSTRAINT `fk_user_employment_job_seeker_id` FOREIGN KEY (`job_seeker_id`) REFERENCES `job_seeker` (`job_seeker_id`);

--
-- Constraints for table `user_language`
--
ALTER TABLE `user_language`
  ADD CONSTRAINT `fk_user_language_job_seeker_id` FOREIGN KEY (`job_seeker_id`) REFERENCES `job_seeker` (`job_seeker_id`),
  ADD CONSTRAINT `fk_user_language_language_id` FOREIGN KEY (`language_id`) REFERENCES `language` (`language_id`);

--
-- Constraints for table `user_skill`
--
ALTER TABLE `user_skill`
  ADD CONSTRAINT `fk_user_skill_job_seeker_id` FOREIGN KEY (`job_seeker_id`) REFERENCES `job_seeker` (`job_seeker_id`),
  ADD CONSTRAINT `fk_user_skill_skill_id` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`skill_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;