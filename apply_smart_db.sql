-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2024 at 03:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apply_smart_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `application_status` enum('submitted','under_review','accepted','rejected') DEFAULT 'submitted',
  `application_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coursereviews`
--

CREATE TABLE `coursereviews` (
  `review_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_text` text DEFAULT NULL,
  `rating` tinyint(3) UNSIGNED DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `institution_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `minimum_duration_years` int(11) DEFAULT NULL,
  `closing_date` date DEFAULT NULL,
  `subject_required` varchar(100) DEFAULT NULL,
  `admission_point_score` int(11) DEFAULT NULL,
  `possible_further_studies` varchar(255) DEFAULT NULL,
  `possible_careers` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `description`, `faculty_id`, `institution_id`, `created_at`, `updated_at`, `minimum_duration_years`, `closing_date`, `subject_required`, `admission_point_score`, `possible_further_studies`, `possible_careers`, `price`) VALUES
(1, 'Organic Chemistry', 'Study of the structure, properties, and reactions of organic compounds.', 6, 3, '2024-08-05 12:03:33', '2024-08-05 13:10:21', 3, '2024-10-01', 'High School Chemistry', 29, 'Advanced Chemistry, Chemical Engineering', 'Chemist, Research Scientist', 4200.00),
(7, 'Introduction to Programming', 'Learn the basics of programming using Python.', 1, 1, '2024-08-05 09:46:38', '2024-08-05 09:46:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Data Structures and Algorithms', 'Study data structures and algorithms.', 2, 1, '2024-08-05 09:46:38', '2024-08-05 09:46:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Web Development Fundamentals', 'Learn HTML, CSS, and JavaScript for web development.', 3, 2, '2024-08-05 09:46:38', '2024-08-05 09:46:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Database Management Systems', 'Study SQL and database design.', 2, 2, '2024-08-05 09:46:38', '2024-08-05 09:46:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Advanced Machine Learning', 'Explore advanced machine learning techniques.', 3, 3, '2024-08-05 09:46:38', '2024-08-05 09:46:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Software Engineering', 'Learn software engineering principles and project management.', 1, 3, '2024-08-05 09:46:38', '2024-08-05 09:46:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Cybersecurity Fundamentals', 'Introduction to cybersecurity concepts and practices.', 2, 1, '2024-08-05 10:50:00', '2024-08-05 10:50:00', 1, '2024-12-01', 'Basic Computing', 20, 'Cybersecurity, Ethical Hacking', 'Security Analyst, Ethical Hacker', NULL),
(14, 'Cloud Computing', 'Learn about cloud services and architecture.', 1, 2, '2024-08-05 10:55:00', '2024-08-05 10:55:00', 1, '2025-05-15', 'Introduction to IT', 22, 'Cloud Engineering, DevOps', 'Cloud Engineer, DevOps Specialist', NULL),
(15, 'AI and Robotics', 'Study artificial intelligence and robotics.', 3, 3, '2024-08-05 11:00:00', '2024-08-05 11:00:00', 2, '2024-11-30', 'Advanced Programming', 30, 'Machine Learning, Robotics', 'AI Researcher, Robotics Engineer', NULL),
(16, 'Human-Computer Interaction', 'Explore user interface design and usability.', 1, 1, '2024-08-05 11:05:00', '2024-08-05 11:05:00', 3, '2025-01-15', 'Introduction to Programming', 24, 'UX Design, Interaction Design', 'UX Designer, UI Developer', NULL),
(17, 'Project Management for IT', 'Learn project management skills specific to IT projects.', 2, 2, '2024-08-05 11:10:00', '2024-08-05 11:10:00', 1, '2024-10-20', 'Basic Project Management', 21, 'Advanced Project Management', 'IT Project Manager, Scrum Master', NULL),
(18, 'Introduction to Data Science', 'Foundations of data science and analytics.', 3, 3, '2024-08-05 11:15:00', '2024-08-05 11:15:00', 2, '2025-02-28', 'Statistics', 26, 'Data Analytics, Data Engineering', 'Data Analyst, Data Engineer', NULL),
(19, 'Ethical Hacking and Penetration Testing', 'Learn techniques for ethical hacking and penetration testing.', 2, 2, '2024-08-05 11:20:00', '2024-08-05 11:20:00', 1, '2024-09-30', 'Cybersecurity Fundamentals', 27, 'Advanced Cybersecurity', 'Penetration Tester, Security Consultant', NULL),
(20, 'Introduction to Quantum Computing', 'Basics of quantum computing and its applications.', 3, 1, '2024-08-05 11:25:00', '2024-08-05 11:25:00', 1, '2025-06-30', 'Advanced Programming', 28, 'Quantum Information Science', 'Quantum Computing Researcher', NULL),
(46, 'Introduction to PHP', 'Learn the basics of PHP programming.', NULL, NULL, '2024-08-05 11:58:05', '2024-08-05 11:58:05', 1, '2024-12-31', 'High School Diploma', 25, 'Advanced PHP, Web Development', 'Web Developer, PHP Programmer', 199.99),
(47, 'Advanced JavaScript', 'Deep dive into JavaScript for advanced applications.', NULL, NULL, '2024-08-05 11:58:05', '2024-08-05 11:58:05', 2, '2025-06-30', 'Basic JavaScript knowledge', 30, 'Full-Stack Development', 'Frontend Developer, JavaScript Engineer', 299.99),
(48, 'Computer Science Basics', 'Introduction to fundamental concepts of computer science.', 1, 1, '2024-08-05 12:03:33', '2024-08-05 12:03:33', 4, '2024-09-01', 'High School Mathematics', 30, 'Advanced Computer Science, Software Engineering', 'Software Developer, IT Consultant', 5000.00),
(49, 'Applied Mathematics', 'A course covering practical applications of mathematics in various fields.', 2, 1, '2024-08-05 12:03:33', '2024-08-05 12:03:33', 3, '2024-09-01', 'High School Mathematics', 28, 'Statistics, Data Science', 'Mathematician, Data Analyst', 4500.00),
(50, 'Mechanical Engineering Fundamentals', 'An introductory course in mechanical engineering principles and practices.', 3, 2, '2024-08-05 12:03:33', '2024-08-05 12:03:33', 4, '2024-08-01', 'High School Physics', 32, 'Advanced Engineering, Robotics', 'Mechanical Engineer, Product Designer', 5500.00),
(51, 'Business Management 101', 'Basics of business management including finance, marketing, and operations.', 4, 2, '2024-08-05 12:03:33', '2024-08-05 12:03:33', 3, '2024-08-15', 'High School Business Studies', 27, 'Advanced Business Management', 'Business Manager, Marketing Specialist', 4800.00),
(52, 'Biology I', 'Introduction to the study of living organisms and their environments.', 5, 3, '2024-08-05 12:03:33', '2024-08-05 12:03:33', 2, '2024-10-01', 'High School Biology', 25, 'Advanced Biology, Environmental Science', 'Biologist, Environmental Consultant', 4000.00);

-- --------------------------------------------------------

--
-- Table structure for table `curriculum`
--

CREATE TABLE `curriculum` (
  `curriculum_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` enum('FIRST','SECOND') NOT NULL,
  `total_credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curriculum`
--

INSERT INTO `curriculum` (`curriculum_id`, `course_id`, `year`, `semester`, `total_credits`) VALUES
(1, 1, 1, 'FIRST', 120),
(2, 1, 1, 'SECOND', 60),
(3, 1, 2, 'FIRST', 60),
(4, 1, 2, 'SECOND', 60),
(5, 1, 3, 'FIRST', 60),
(6, 1, 3, 'SECOND', 60);

-- --------------------------------------------------------

--
-- Table structure for table `curriculum_modules`
--

CREATE TABLE `curriculum_modules` (
  `curriculum_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `module_type` enum('CORE','ELECTIVE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curriculum_modules`
--

INSERT INTO `curriculum_modules` (`curriculum_id`, `module_id`, `module_type`) VALUES
(1, 1, 'CORE'),
(1, 2, 'CORE'),
(1, 3, 'CORE'),
(1, 4, 'CORE'),
(1, 5, 'CORE'),
(1, 6, 'CORE'),
(1, 7, 'CORE'),
(1, 8, 'CORE'),
(1, 9, 'CORE'),
(1, 10, 'CORE'),
(2, 11, 'CORE'),
(2, 12, 'CORE'),
(2, 13, 'CORE'),
(2, 14, 'CORE'),
(3, 15, 'CORE'),
(3, 16, 'CORE'),
(3, 17, 'CORE'),
(3, 18, 'ELECTIVE'),
(4, 19, 'CORE'),
(4, 20, 'CORE'),
(4, 21, 'CORE'),
(4, 22, 'ELECTIVE'),
(4, 23, 'ELECTIVE'),
(5, 24, 'CORE');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `application_id` int(11) DEFAULT NULL,
  `document_type` enum('transcript','recommendation_letter','resume','other') DEFAULT NULL,
  `document_path` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL,
  `institution_id` int(11) NOT NULL,
  `department_name` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `institution_id`, `department_name`, `bio`) VALUES
(1, 1, 'Computer Science', 'The Computer Science department focuses on developing innovative technologies and teaching programming languages.'),
(2, 1, 'Mathematics', 'The Mathematics department offers a range of courses in pure and applied mathematics.'),
(3, 2, 'Engineering', 'The Engineering faculty specializes in various branches of engineering including civil, mechanical, and electrical.'),
(4, 2, 'Business Administration', 'The Business Administration department provides education in management, marketing, and finance.'),
(5, 3, 'Biology', 'The Biology faculty is dedicated to the study of living organisms and ecosystems.'),
(6, 3, 'Chemistry', 'The Chemistry department explores chemical processes and their applications in industry and research.');

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE `institutions` (
  `institution_id` int(11) NOT NULL,
  `institution_name` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `contact_info` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`institution_id`, `institution_name`, `location`, `contact_info`, `created_at`, `updated_at`) VALUES
(1, 'Tech University', '123 Tech Road, Tech City', 'contact@techuniversity.edu', '2024-08-05 09:46:22', '2024-08-05 09:46:22'),
(2, 'Science Institute', '456 Science Blvd, Sci Town', 'info@scienceinstitute.edu', '2024-08-05 09:46:22', '2024-08-05 09:46:22'),
(3, 'Engineering College', '789 Engineering Ave, Engineer City', 'enroll@engineeringcollege.edu', '2024-08-05 09:46:22', '2024-08-05 09:46:22'),
(4, 'Business School', '101 Business Park, Bus City', 'admissions@businessschool.edu', '2024-08-05 10:00:00', '2024-08-05 10:00:00'),
(5, 'Health Sciences Academy', '202 Health St, Med Town', 'info@healthacademy.edu', '2024-08-05 10:05:00', '2024-08-05 10:05:00'),
(6, 'Tech University', 'New York, USA', 'contact@techuniversity.edu', '2024-08-05 12:03:33', '2024-08-05 12:03:33'),
(7, 'Business School', 'Los Angeles, USA', 'info@businessschool.edu', '2024-08-05 12:03:33', '2024-08-05 12:03:33'),
(8, 'Science Institute', 'San Francisco, USA', 'support@scienceinstitute.edu', '2024-08-05 12:03:33', '2024-08-05 12:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nqf_level` int(11) NOT NULL,
  `credits` int(11) NOT NULL,
  `prerequisite_modules` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `code`, `name`, `nqf_level`, `credits`, `prerequisite_modules`) VALUES
(1, '16P105X', 'Communication for Academic Purposes', 5, 10, NULL),
(2, 'INF125D', 'Information Literacy', 5, 3, NULL),
(3, 'LFS125X', 'Life Skills', 5, 2, NULL),
(4, 'CFA115D', 'Computing Fundamentals A', 5, 15, NULL),
(5, 'COH115D', 'Computational Mathematics', 5, 15, NULL),
(6, 'PPA115D', 'Principles of Programming A', 5, 15, NULL),
(7, 'CFB115D', 'Computing Fundamentals B', 5, 15, 'Computing Fundamentals A'),
(8, 'DCT115D', 'Discrete Structures', 5, 15, 'Computational Mathematics'),
(9, 'PPB115D', 'Principles of Programming B', 5, 15, 'Principles of Programming A'),
(10, 'WEB115D', 'Web Computing', 5, 15, 'Principles of Programming A'),
(11, 'ADS216D', 'Advanced Discrete Structures', 6, 15, 'Discrete Structures'),
(12, 'CAO216D', 'Computer Architecture and Organisation', 6, 15, NULL),
(13, 'DTP216D', 'Database Principles', 6, 15, NULL),
(14, 'OOP216D', 'Object-Oriented Programming', 6, 15, 'Principles of Programming B'),
(15, 'AOP216D', 'Advanced Object-Oriented Programming', 6, 15, 'Object-Oriented Programming'),
(16, 'ISC216D', 'Information Security', 6, 15, NULL),
(17, 'ORS216D', 'Operating Systems', 6, 15, NULL),
(18, 'SEF216D', 'Software Engineering Fundamentals', 6, 15, NULL),
(19, 'INT316D', 'Internet Programming', 6, 15, 'Advanced Object-Oriented Programming'),
(20, 'MOB316D', 'Mobile Computing', 6, 15, 'Advanced Object-Oriented Programming'),
(21, 'SWP316D', 'Software Project', 6, 15, 'Advanced Object-Oriented Programming'),
(22, 'DBP316D', 'Database Programming', 6, 15, 'Database Principles'),
(23, 'DIS316D', 'Distributed Systems', 6, 15, NULL),
(24, 'WEM316D', 'Web Server Management', 6, 15, NULL),
(25, 'WOC316D', 'Work-Integrated Learning', 6, 60, 'Internet Programming, Mobile Computing, Software Project, Web Server Management or Database Programming or Distributed Systems');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `application_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supporttickets`
--

CREATE TABLE `supporttickets` (
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `issue_description` text NOT NULL,
  `status` enum('open','in_progress','resolved') DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `student_number` int(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `user_type` enum('prospective_student','current_student','admin','faculty') NOT NULL,
  `institution_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `student_number`, `password`, `email`, `name`, `lastName`, `user_type`, `institution_id`, `created_at`, `updated_at`) VALUES
(2, NULL, 'hashed_password', 'jane.smith@example.com', 'Jane', 'Smith', 'faculty', NULL, '2024-08-05 09:38:03', '2024-08-05 09:38:03'),
(3, NULL, 'hashed_password', 'emily.johnson@example.com', 'Emily', 'Johnson', 'faculty', NULL, '2024-08-05 09:38:03', '2024-08-05 09:38:03'),
(4, NULL, 'hashed_password', 'michael.brown@example.com', 'Michael', 'Brown', 'faculty', NULL, '2024-08-05 09:38:03', '2024-08-05 09:38:03'),
(5, NULL, 'hashed_password', 'sarah.davis@example.com', 'Sarah', 'Davis', 'faculty', NULL, '2024-08-05 09:38:03', '2024-08-05 09:38:03'),
(6, NULL, 'hashed_password', 'david.wilson@example.com', 'David', 'Wilson', 'faculty', NULL, '2024-08-05 09:38:03', '2024-08-05 09:38:03'),
(7, NULL, 'hashed_password', 'john.doe@example.com', 'John', 'Doe', '', 1, '2024-08-05 10:10:00', '2024-08-05 10:10:00'),
(8, NULL, 'hashed_password', 'alice.jones@example.com', 'Alice', 'Jones', 'current_student', 2, '2024-08-05 10:15:00', '2024-08-05 10:15:00'),
(9, NULL, 'hashed_password', 'bob.brown@example.com', 'Bob', 'Brown', 'faculty', 3, '2024-08-05 10:20:00', '2024-08-05 10:20:00'),
(10, NULL, 'hashed_password', 'carol.green@example.com', 'Carol', 'Green', '', 4, '2024-08-05 10:25:00', '2024-08-05 10:25:00'),
(11, NULL, 'hashed_password', 'david.white@example.com', 'David', 'White', 'faculty', 5, '2024-08-05 10:30:00', '2024-08-05 10:30:00'),
(13, NULL, '$2y$10$73vxIMxj0b3hDik2HSG5TOOi5jHm4z2wRBJdIp/ct95E/BnNrBhY2', 'thokozani26sngalela@gmail.com', 'THokozani', 'masanabo', 'current_student', NULL, '2024-08-05 12:30:55', '2024-08-05 12:30:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `coursereviews`
--
ALTER TABLE `coursereviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `institution_id` (`institution_id`);

--
-- Indexes for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`curriculum_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `curriculum_modules`
--
ALTER TABLE `curriculum_modules`
  ADD PRIMARY KEY (`curriculum_id`,`module_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`),
  ADD KEY `institution_id` (`institution_id`);

--
-- Indexes for table `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`institution_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `supporttickets`
--
ALTER TABLE `supporttickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`student_number`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `student_number` (`student_number`),
  ADD KEY `institution_id` (`institution_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coursereviews`
--
ALTER TABLE `coursereviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `curriculum`
--
ALTER TABLE `curriculum`
  MODIFY `curriculum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `institution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supporttickets`
--
ALTER TABLE `supporttickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `coursereviews`
--
ALTER TABLE `coursereviews`
  ADD CONSTRAINT `coursereviews_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `coursereviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`institution_id`);

--
-- Constraints for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD CONSTRAINT `curriculum_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `curriculum_modules`
--
ALTER TABLE `curriculum_modules`
  ADD CONSTRAINT `curriculum_modules_ibfk_1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`curriculum_id`),
  ADD CONSTRAINT `curriculum_modules_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`module_id`);

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `documents_ibfk_2` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`);

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_ibfk_1` FOREIGN KEY (`institution_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`);

--
-- Constraints for table `supporttickets`
--
ALTER TABLE `supporttickets`
  ADD CONSTRAINT `supporttickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`institution_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
