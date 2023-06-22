-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2023 at 11:29 PM
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
DROP DATABASE IF EXISTS job_portal;
CREATE DATABASE IF NOT EXISTS job_portal;
USE job_portal;
-- GRANT all on job_portal.* TO 'admin'@'localhost' Identified By 'admin';
-- if you are using workbench use the next line and COMMENT the above line
GRANT all on job_portal.* To 'admin'@'localhost';


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
  `description` varchar(1000)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--



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

-- --------------------------------------------------------

--
-- Table structure for table `job_postings`
--

CREATE TABLE `job_postings` (
  `id` int NOT NULL,
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


--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `education_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employment`
--
ALTER TABLE `employment`
  MODIFY `employment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `job_postings`
--
ALTER TABLE `job_postings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_seeker`
--
ALTER TABLE `job_seeker`
  MODIFY `job_seeker_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `language_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `skill_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

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
