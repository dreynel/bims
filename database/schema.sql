-- Barangay Information Management System (BIMS) - Database Schema
-- Location: Barangay Dacutan, Dumangas, Iloilo
-- Target RDBMS: MySQL / MariaDB (XAMPP Compatible)

CREATE DATABASE IF NOT EXISTS `bims_dacutan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bims_dacutan`;

-- 1. Users Table (System Administrators & Staff)
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL, -- Hashed
  `full_name` VARCHAR(100) NOT NULL,
  `role` ENUM('admin', 'captain', 'secretary', 'treasurer', 'kagawad', 'staff') NOT NULL DEFAULT 'staff',
  `email` VARCHAR(100) NULL,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `last_login` DATETIME NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Households Table
CREATE TABLE IF NOT EXISTS `households` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `household_no` VARCHAR(20) NOT NULL UNIQUE,
  `purok` VARCHAR(50) NOT NULL, -- e.g. Purok 1, Purok 2, Sitio Ilawod
  `street_address` VARCHAR(255) NOT NULL,
  `income_level` ENUM('indigent', 'low', 'middle', 'high') DEFAULT 'indigent',
  `is_4ps_beneficiary` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Residents Table
CREATE TABLE IF NOT EXISTS `residents` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `resident_id` VARCHAR(20) NOT NULL UNIQUE, -- e.g., DAC-2026-0001
  `household_id` INT NULL,
  `first_name` VARCHAR(50) NOT NULL,
  `middle_name` VARCHAR(50) NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `suffix` VARCHAR(10) NULL, -- Jr., III, etc.
  `gender` ENUM('Male', 'Female', 'Other') NOT NULL,
  `birth_date` DATE NOT NULL,
  `civil_status` ENUM('Single', 'Married', 'Widowed', 'Separated') DEFAULT 'Single',
  `purok` VARCHAR(50) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `contact_no` VARCHAR(20) NULL,
  `email` VARCHAR(100) NULL,
  `occupation` VARCHAR(100) NULL,
  `monthly_income` DECIMAL(10, 2) DEFAULT 0.00,
  `voter_status` ENUM('Registered', 'Not Registered') DEFAULT 'Registered',
  `voter_precinct` VARCHAR(20) NULL,
  `is_senior` TINYINT(1) DEFAULT 0,
  `is_pwd` TINYINT(1) DEFAULT 0,
  `is_indigent` TINYINT(1) DEFAULT 0,
  `is_solo_parent` TINYINT(1) DEFAULT 0,
  `photo_path` VARCHAR(255) NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`household_id`) REFERENCES `households`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Certificates & Clearances Table
CREATE TABLE IF NOT EXISTS `certificates` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `control_no` VARCHAR(30) NOT NULL UNIQUE, -- e.g. CLR-2026-08001
  `resident_id` INT NOT NULL,
  `type` ENUM('Barangay Clearance', 'Certificate of Indigency', 'Certificate of Residency', 'Business Permit Clearance', 'First Time Job Seeker') NOT NULL,
  `purpose` VARCHAR(255) NOT NULL,
  `amount_paid` DECIMAL(8, 2) DEFAULT 0.00,
  `or_number` VARCHAR(30) NULL,
  `issued_by` VARCHAR(100) NOT NULL,
  `issue_date` DATE NOT NULL,
  `expiry_date` DATE NULL,
  `status` ENUM('Issued', 'Pending', 'Cancelled') DEFAULT 'Issued',
  `qr_code_hash` VARCHAR(255) NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`resident_id`) REFERENCES `residents`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Blotter & Incidents Table (Katarungang Pambarangay)
CREATE TABLE IF NOT EXISTS `blotter_records` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `case_no` VARCHAR(30) NOT NULL UNIQUE, -- e.g. BLT-2026-001
  `complainant_name` VARCHAR(150) NOT NULL,
  `complainant_address` VARCHAR(255) NULL,
  `complainant_contact` VARCHAR(20) NULL,
  `respondent_name` VARCHAR(150) NOT NULL,
  `respondent_address` VARCHAR(255) NULL,
  `incident_type` VARCHAR(100) NOT NULL, -- e.g. Boundary Dispute, Noise Complaint, Physical Injury, Theft
  `incident_location` VARCHAR(255) NOT NULL,
  `incident_date` DATETIME NOT NULL,
  `narrative` TEXT NOT NULL,
  `status` ENUM('Pending', 'In Mediation', 'Settled', 'Referred to PNP', 'Dismissed') DEFAULT 'Pending',
  `presiding_officer` VARCHAR(100) NULL,
  `hearing_date` DATETIME NULL,
  `resolution_details` TEXT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Financial Aid & Calamity Assistance Logs
CREATE TABLE IF NOT EXISTS `aid_distributions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `program_name` VARCHAR(150) NOT NULL, -- e.g. Typhoone Aid Relief 2026, Senior Citizens Subsidy
  `distribution_date` DATE NOT NULL,
  `resident_id` INT NOT NULL,
  `assistance_type` ENUM('Cash', 'Food Pack', 'Medical Kit', 'Agricultural Support') NOT NULL,
  `amount_or_quantity` VARCHAR(100) NOT NULL,
  `status` ENUM('Claimed', 'Pending', 'Unclaimed') DEFAULT 'Claimed',
  `distributor_name` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`resident_id`) REFERENCES `residents`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. AI Copilot Query & Activity Logs
CREATE TABLE IF NOT EXISTS `ai_logs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NULL,
  `prompt` TEXT NOT NULL,
  `ai_response` TEXT NOT NULL,
  `category` ENUM('Demographics', 'Legal/Blotter', 'Ordinance', 'Aid Allocation', 'General') DEFAULT 'General',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample Seed Data for Barangay Dacutan, Dumangas, Iloilo
INSERT INTO `households` (`household_no`, `purok`, `street_address`, `income_level`, `is_4ps_beneficiary`) VALUES
('HH-DAC-001', 'Purok 1', 'Main Road, Dacutan', 'low', 1),
('HH-DAC-002', 'Purok 2', 'Riverside St., Dacutan', 'indigent', 1),
('HH-DAC-003', 'Purok 3', 'Coastal Zone, Dacutan', 'middle', 0),
('HH-DAC-004', 'Purok 4', 'Sitio Ilawod, Dacutan', 'indigent', 1),
('HH-DAC-005', 'Purok 5', 'Sitio Ilaya, Dacutan', 'low', 0);

INSERT INTO `residents` (`resident_id`, `household_id`, `first_name`, `middle_name`, `last_name`, `gender`, `birth_date`, `civil_status`, `purok`, `address`, `contact_no`, `occupation`, `monthly_income`, `voter_status`, `is_senior`, `is_pwd`, `is_indigent`) VALUES
('DAC-2026-0001', 1, 'Juan', 'Dela Cruz', 'Dacutan', 'Male', '1962-04-12', 'Married', 'Purok 1', 'Main Road, Dacutan', '09171234567', 'Farmer', 8500.00, 'Registered', 1, 0, 1),
('DAC-2026-0002', 1, 'Maria', 'Santos', 'Dacutan', 'Female', '1965-08-25', 'Married', 'Purok 1', 'Main Road, Dacutan', '09189876543', 'Housewife', 0.00, 'Registered', 1, 0, 1),
('DAC-2026-0003', 2, 'Ramon', 'Gonzales', 'Bautista', 'Male', '1988-11-03', 'Single', 'Purok 2', 'Riverside St., Dacutan', '09205551234', 'Fisherman', 7200.00, 'Registered', 0, 1, 1),
('DAC-2026-0004', 3, 'Elena', 'Palma', 'Villanueva', 'Female', '1995-02-14', 'Single', 'Purok 3', 'Coastal Zone, Dacutan', '09993334444', 'Sari-sari Store Owner', 15000.00, 'Registered', 0, 0, 0),
('DAC-2026-0005', 4, 'Pedro', 'Alcantara', 'Solis', 'Male', '1955-09-30', 'Widowed', 'Purok 4', 'Sitio Ilawod, Dacutan', '09124445555', 'Retired', 4500.00, 'Registered', 1, 0, 1);
