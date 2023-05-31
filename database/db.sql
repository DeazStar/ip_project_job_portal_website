DROP DATABASE IF EXISTS job_portal;
CREATE DATABASE IF NOT EXISTS job_portal;
USE job_portal;
GRANT all on job_portal.* TO 'admin'@'localhost' Identified By 'admin';
-- if you are using workbench use the next line and COMMENT the above line
-- GRANT all on job_portal.* To 'admin'@'localhost';

CREATE TABLE user (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  firstName VARCHAR(255) NOT NULL,
  lastName VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  country VARCHAR(255) NOT NULL,
  gender ENUM('M', 'F') NOT NULL,
  phoneNumber VARCHAR(20) NOT NULL,
  recovery_email VARCHAR(255) NOT NULL,
  professional_title VARCHAR(255) NOT NULL,
  postcode INT NOT NULL,
  city VARCHAR(255) NOT NULL,
  address VARCHAR(255) NOT NULL
);

CREATE TABLE company (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  company_name VARCHAR(255) NOT NULL,
  website VARCHAR(255) NOT NULL,
  founded_date DATE NOT NULL,
  email VARCHAR(255) NOT NULL,
  recovery_email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  phone_number VARCHAR(20) NOT NULL,
  country VARCHAR(255) NOT NULL,
  address VARCHAR(255) NOT NULL
);
