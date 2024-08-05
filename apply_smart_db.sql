-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2024 at 02:25 PM
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
(52, 'Biology I', 'Introduction to the study of living organisms and their environments.', 5, 3, '2024-08-05 12:03:33', '2024-08-05 12:03:33', 2, '2024-10-01', 'High School Biology', 25, 'Advanced Biology, Environmental Science', 'Biologist, Environmental Consultant', 4000.00),
(53, 'Organic Chemistry', 'Study of the structure, properties, and reactions of organic compounds.', 6, 3, '2024-08-05 12:03:33', '2024-08-05 12:03:33', 3, '2024-10-01', 'High School Chemistry', 29, 'Advanced Chemistry, Chemical Engineering', 'Chemist, Research Scientist', 4200.00);

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
(1, NULL, '$2y$10$dWRobPRNxqUZALIHl.urAuv.uOZhpy/wUOBU9Kj62GnwrwKvibFZW', 'thokozani26sngalela@gmail.com', 'thoko', 'Leibniz', 'current_student', NULL, '2024-08-05 09:13:22', '2024-08-05 09:13:22'),
(2, NULL, 'hashed_password', 'jane.smith@example.com', 'Jane', 'Smith', 'faculty', NULL, '2024-08-05 09:38:03', '2024-08-05 09:38:03'),
(3, NULL, 'hashed_password', 'emily.johnson@example.com', 'Emily', 'Johnson', 'faculty', NULL, '2024-08-05 09:38:03', '2024-08-05 09:38:03'),
(4, NULL, 'hashed_password', 'michael.brown@example.com', 'Michael', 'Brown', 'faculty', NULL, '2024-08-05 09:38:03', '2024-08-05 09:38:03'),
(5, NULL, 'hashed_password', 'sarah.davis@example.com', 'Sarah', 'Davis', 'faculty', NULL, '2024-08-05 09:38:03', '2024-08-05 09:38:03'),
(6, NULL, 'hashed_password', 'david.wilson@example.com', 'David', 'Wilson', 'faculty', NULL, '2024-08-05 09:38:03', '2024-08-05 09:38:03'),
(7, NULL, 'hashed_password', 'john.doe@example.com', 'John', 'Doe', '', 1, '2024-08-05 10:10:00', '2024-08-05 10:10:00'),
(8, NULL, 'hashed_password', 'alice.jones@example.com', 'Alice', 'Jones', 'current_student', 2, '2024-08-05 10:15:00', '2024-08-05 10:15:00'),
(9, NULL, 'hashed_password', 'bob.brown@example.com', 'Bob', 'Brown', 'faculty', 3, '2024-08-05 10:20:00', '2024-08-05 10:20:00'),
(10, NULL, 'hashed_password', 'carol.green@example.com', 'Carol', 'Green', '', 4, '2024-08-05 10:25:00', '2024-08-05 10:25:00'),
(11, NULL, 'hashed_password', 'david.white@example.com', 'David', 'White', 'faculty', 5, '2024-08-05 10:30:00', '2024-08-05 10:30:00');

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
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
