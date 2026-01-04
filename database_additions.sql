-- Additional Database Tables for New Pages
-- Run this file to add new tables for Disclosure, Sports, SLC, Bus Routes, and Fee Structure

-- Create disclosure_documents table
CREATE TABLE IF NOT EXISTS `disclosure_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `document_file` varchar(255) DEFAULT NULL,
  `document_type` enum('mandatory','general','cbse','financial','other') DEFAULT 'general',
  `file_size` varchar(50) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample disclosure documents
INSERT INTO `disclosure_documents` (`title`, `description`, `document_type`, `display_order`, `status`) VALUES
('CBSE Affiliation Certificate', 'Official CBSE Affiliation Certificate and Details', 'cbse', 1, 'active'),
('School NOC', 'No Objection Certificate from State Education Department', 'mandatory', 2, 'active'),
('Annual Report 2023-24', 'Complete Annual Report with Academic and Financial Details', 'financial', 3, 'active'),
('Fee Structure Document', 'Detailed Fee Structure for all classes', 'financial', 4, 'active'),
('School Infrastructure Details', 'Complete details of school infrastructure and facilities', 'general', 5, 'active');

-- Create sports table
CREATE TABLE IF NOT EXISTS `sports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sport_name` varchar(150) NOT NULL,
  `category` enum('outdoor','indoor','athletic','water','other') DEFAULT 'outdoor',
  `description` text DEFAULT NULL,
  `coach_name` varchar(150) DEFAULT NULL,
  `facilities` text DEFAULT NULL,
  `achievements` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `schedule` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample sports
INSERT INTO `sports` (`sport_name`, `category`, `description`, `coach_name`, `facilities`, `achievements`, `display_order`, `status`) VALUES
('Cricket', 'outdoor', 'Professional cricket training with state-of-the-art facilities', 'Mr. Vikas Sharma', 'Full-size cricket ground, practice nets, indoor practice hall', 'State Championship Winners 2023, District Champions 2024', 1, 'active'),
('Basketball', 'outdoor', 'International standard basketball court and training', 'Ms. Priya Rao', 'Two outdoor courts, one indoor court with professional flooring', 'Inter-School Tournament Winners 2024', 2, 'active'),
('Swimming', 'water', 'Olympic size swimming pool with professional coaching', 'Mr. Rajesh Kumar', '50m Olympic size pool, 25m training pool, changing rooms', 'State Level Medals in various age groups', 3, 'active'),
('Table Tennis', 'indoor', 'Indoor table tennis facility with professional coaches', 'Mr. Anil Verma', 'Dedicated hall with 8 professional tables', 'District Champions 2023-24', 4, 'active'),
('Athletics', 'athletic', 'Complete track and field facilities', 'Mrs. Sunita Devi', '400m synthetic track, jumping pits, throwing areas', 'Multiple medals in State Athletics Meet', 5, 'active'),
('Football', 'outdoor', 'FIFA standard football ground with professional training', 'Mr. Deepak Singh', 'Full-size FIFA standard ground, mini football field', 'Regional Champions 2024', 6, 'active');

-- Create school_leaving_certificates table
CREATE TABLE IF NOT EXISTS `school_leaving_certificates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(150) NOT NULL,
  `father_name` varchar(150) NOT NULL,
  `mother_name` varchar(150) NOT NULL,
  `admission_no` varchar(50) NOT NULL,
  `class_left` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_admission` date NOT NULL,
  `date_of_leaving` date NOT NULL,
  `reason_for_leaving` text DEFAULT NULL,
  `conduct` varchar(100) DEFAULT 'Good',
  `remarks` text DEFAULT NULL,
  `issued_date` date NOT NULL,
  `status` enum('pending','issued','cancelled') DEFAULT 'pending',
  `certificate_number` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admission_no` (`admission_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create bus_routes table
CREATE TABLE IF NOT EXISTS `bus_routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route_number` varchar(50) NOT NULL,
  `route_name` varchar(150) NOT NULL,
  `areas_covered` text NOT NULL,
  `pickup_points` text NOT NULL,
  `timing_morning` varchar(100) DEFAULT NULL,
  `timing_afternoon` varchar(100) DEFAULT NULL,
  `bus_number` varchar(50) DEFAULT NULL,
  `driver_name` varchar(150) DEFAULT NULL,
  `driver_contact` varchar(20) DEFAULT NULL,
  `conductor_name` varchar(150) DEFAULT NULL,
  `conductor_contact` varchar(20) DEFAULT NULL,
  `monthly_fee` decimal(10,2) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `status` enum('active','inactive','maintenance') DEFAULT 'active',
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `route_number` (`route_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample bus routes
INSERT INTO `bus_routes` (`route_number`, `route_name`, `areas_covered`, `pickup_points`, `timing_morning`, `timing_afternoon`, `bus_number`, `driver_name`, `driver_contact`, `conductor_name`, `conductor_contact`, `monthly_fee`, `capacity`, `display_order`, `status`) VALUES
('R-01', 'North Delhi Route', 'Model Town, Guru Teg Bahadur Nagar, Azadpur', 'Model Town Metro (6:45 AM), GTB Nagar (7:00 AM), Azadpur (7:15 AM)', '6:45 AM - 7:30 AM', '2:00 PM - 2:45 PM', 'DL-01-AB-1234', 'Ramesh Kumar', '9876543210', 'Suresh Yadav', '9876543211', 2500.00, 45, 1, 'active'),
('R-02', 'South Delhi Route', 'Saket, Malviya Nagar, Hauz Khas', 'Saket Metro (6:30 AM), Malviya Nagar (6:45 AM), Hauz Khas (7:00 AM)', '6:30 AM - 7:30 AM', '2:00 PM - 3:00 PM', 'DL-01-AB-5678', 'Vijay Singh', '9876543220', 'Rakesh Kumar', '9876543221', 2800.00, 45, 2, 'active'),
('R-03', 'East Delhi Route', 'Laxmi Nagar, Preet Vihar, Mayur Vihar', 'Laxmi Nagar Metro (6:40 AM), Preet Vihar (6:55 AM), Mayur Vihar (7:10 AM)', '6:40 AM - 7:30 AM', '2:00 PM - 2:50 PM', 'DL-01-AB-9012', 'Mohan Lal', '9876543230', 'Dinesh Kumar', '9876543231', 2600.00, 45, 3, 'active'),
('R-04', 'West Delhi Route', 'Rajouri Garden, Punjabi Bagh, Paschim Vihar', 'Rajouri Garden Metro (6:35 AM), Punjabi Bagh (6:50 AM), Paschim Vihar (7:05 AM)', '6:35 AM - 7:30 AM', '2:00 PM - 2:55 PM', 'DL-01-AB-3456', 'Satish Sharma', '9876543240', 'Mukesh Yadav', '9876543241', 2700.00, 45, 4, 'active'),
('R-05', 'Central Delhi Route', 'Connaught Place, Karol Bagh, Paharganj', 'CP Metro (6:50 AM), Karol Bagh (7:05 AM), Paharganj (7:15 AM)', '6:50 AM - 7:30 AM', '2:00 PM - 2:40 PM', 'DL-01-AB-7890', 'Anil Kumar', '9876543250', 'Prem Singh', '9876543251', 2900.00, 45, 5, 'active');

-- Create fee_structure table
CREATE TABLE IF NOT EXISTS `fee_structure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(50) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `tuition_fee` decimal(10,2) NOT NULL,
  `admission_fee` decimal(10,2) DEFAULT 0.00,
  `annual_charges` decimal(10,2) DEFAULT 0.00,
  `computer_fee` decimal(10,2) DEFAULT 0.00,
  `library_fee` decimal(10,2) DEFAULT 0.00,
  `sports_fee` decimal(10,2) DEFAULT 0.00,
  `lab_fee` decimal(10,2) DEFAULT 0.00,
  `exam_fee` decimal(10,2) DEFAULT 0.00,
  `development_fee` decimal(10,2) DEFAULT 0.00,
  `transport_fee` decimal(10,2) DEFAULT 0.00,
  `other_charges` decimal(10,2) DEFAULT 0.00,
  `total_annual_fee` decimal(10,2) NOT NULL,
  `payment_terms` text DEFAULT NULL,
  `discount_info` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample fee structure
INSERT INTO `fee_structure` (`class_name`, `academic_year`, `tuition_fee`, `admission_fee`, `annual_charges`, `computer_fee`, `library_fee`, `sports_fee`, `lab_fee`, `exam_fee`, `development_fee`, `transport_fee`, `other_charges`, `total_annual_fee`, `payment_terms`, `discount_info`, `display_order`, `status`) VALUES
('Nursery', '2024-2025', 30000.00, 5000.00, 3000.00, 2000.00, 1000.00, 1500.00, 0.00, 1000.00, 2000.00, 0.00, 500.00, 46000.00, 'Quarterly payment: ₹11,500 per quarter. Annual payment: 5% discount', 'Sibling discount: 10%, Early bird discount: 5%', 1, 'active'),
('KG', '2024-2025', 32000.00, 5000.00, 3000.00, 2000.00, 1000.00, 1500.00, 0.00, 1000.00, 2000.00, 0.00, 500.00, 48000.00, 'Quarterly payment: ₹12,000 per quarter. Annual payment: 5% discount', 'Sibling discount: 10%, Early bird discount: 5%', 2, 'active'),
('Class 1-2', '2024-2025', 35000.00, 5000.00, 3000.00, 2500.00, 1200.00, 1500.00, 1000.00, 1200.00, 2000.00, 0.00, 600.00, 53000.00, 'Quarterly payment: ₹13,250 per quarter. Annual payment: 5% discount', 'Sibling discount: 10%, Early bird discount: 5%', 3, 'active'),
('Class 3-5', '2024-2025', 38000.00, 5000.00, 3000.00, 3000.00, 1500.00, 2000.00, 1500.00, 1500.00, 2000.00, 0.00, 800.00, 58300.00, 'Quarterly payment: ₹14,575 per quarter. Annual payment: 5% discount', 'Sibling discount: 10%, Early bird discount: 5%', 4, 'active'),
('Class 6-8', '2024-2025', 42000.00, 5000.00, 3500.00, 3500.00, 1800.00, 2000.00, 2000.00, 1800.00, 2500.00, 0.00, 1000.00, 65100.00, 'Quarterly payment: ₹16,275 per quarter. Annual payment: 5% discount', 'Sibling discount: 10%, Early bird discount: 5%', 5, 'active'),
('Class 9-10', '2024-2025', 45000.00, 5000.00, 4000.00, 4000.00, 2000.00, 2500.00, 2500.00, 2000.00, 3000.00, 0.00, 1200.00, 71200.00, 'Quarterly payment: ₹17,800 per quarter. Annual payment: 5% discount', 'Sibling discount: 10%, Merit scholarship available', 6, 'active'),
('Class 11-12', '2024-2025', 50000.00, 5000.00, 4500.00, 4500.00, 2500.00, 2500.00, 3000.00, 2500.00, 3500.00, 0.00, 1500.00, 79500.00, 'Quarterly payment: ₹19,875 per quarter. Annual payment: 5% discount', 'Sibling discount: 10%, Merit scholarship available', 7, 'active');
