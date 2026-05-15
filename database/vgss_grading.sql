-- Student Grading Information System Database
-- Venilale General Secondary School

CREATE DATABASE IF NOT EXISTS vgss_grading CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE vgss_grading;

-- Users table (Admin & Teacher accounts)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    role ENUM('admin', 'teacher') NOT NULL DEFAULT 'teacher',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Classes table
CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(50) NOT NULL,
    class_code VARCHAR(20) NOT NULL UNIQUE,
    academic_year VARCHAR(20) NOT NULL,
    section VARCHAR(10) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Students table
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    gender ENUM('male', 'female') NOT NULL,
    date_of_birth DATE NOT NULL,
    class_id INT NOT NULL,
    parent_name VARCHAR(100) DEFAULT NULL,
    parent_phone VARCHAR(20) DEFAULT NULL,
    address TEXT DEFAULT NULL,
    enrollment_date DATE NOT NULL,
    status ENUM('active', 'inactive', 'graduated') DEFAULT 'active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- Subjects table
CREATE TABLE subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_code VARCHAR(20) NOT NULL UNIQUE,
    subject_name VARCHAR(100) NOT NULL,
    description TEXT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Grades table
CREATE TABLE grades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    subject_id INT NOT NULL,
    class_id INT NOT NULL,
    academic_term ENUM('Term 1', 'Term 2', 'Term 3') NOT NULL,
    academic_year VARCHAR(20) NOT NULL,
    score DECIMAL(5,2) NOT NULL,
    grade_letter VARCHAR(5) DEFAULT NULL,
    remarks TEXT DEFAULT NULL,
    entered_by INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE RESTRICT,
    FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE RESTRICT,
    FOREIGN KEY (entered_by) REFERENCES users(id) ON DELETE RESTRICT,
    UNIQUE KEY unique_grade (student_id, subject_id, academic_term, academic_year)
) ENGINE=InnoDB;

-- Insert default admin user (password: admin123)
INSERT INTO users (username, email, password, full_name, role) VALUES
('admin', 'admin@vgss.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System Administrator', 'admin'),
('teacher1', 'teacher@vgss.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Maria Santos', 'teacher');

-- Insert sample classes
INSERT INTO classes (class_name, class_code, academic_year, section) VALUES
('Grade 7 - A', '7A', '2025-2026', 'A'),
('Grade 7 - B', '7B', '2025-2026', 'B'),
('Grade 8 - A', '8A', '2025-2026', 'A'),
('Grade 9 - A', '9A', '2025-2026', 'A'),
('Grade 10 - A', '10A', '2025-2026', 'A'),
('Grade 11 - Science', '11S', '2025-2026', 'Science'),
('Grade 11 - Arts', '11A', '2025-2026', 'Arts'),
('Grade 12 - Science', '12S', '2025-2026', 'Science'),
('Grade 12 - Arts', '12A', '2025-2026', 'Arts');

-- Insert sample subjects
INSERT INTO subjects (subject_code, subject_name, description) VALUES
('MATH', 'Mathematics', 'Core mathematics subject'),
('ENG', 'English', 'English language and literature'),
('SCI', 'Science', 'General science'),
('SOC', 'Social Studies', 'History and geography'),
('TET', 'Tetum', 'National language of Timor-Leste'),
('POR', 'Portuguese', 'Portuguese language'),
('PHY', 'Physics', 'Physics for senior classes'),
('CHE', 'Chemistry', 'Chemistry for senior classes'),
('BIO', 'Biology', 'Biology for senior classes'),
('PE', 'Physical Education', 'Sports and physical education'),
('ART', 'Arts', 'Visual arts and creative studies'),
('ICT', 'Information & Communication Technology', 'Computer and IT fundamentals');

-- Insert sample students
INSERT INTO students (student_id, full_name, gender, date_of_birth, class_id, parent_name, parent_phone, address, enrollment_date, status) VALUES
('VGSS-2025-001', 'Joao da Silva', 'male', '2010-03-15', 1, 'Carlos da Silva', '77234567', 'Venilale, Baucau', '2025-01-10', 'active'),
('VGSS-2025-002', 'Maria dos Santos', 'female', '2010-05-22', 1, 'Ana dos Santos', '77345678', 'Venilale, Baucau', '2025-01-10', 'active'),
('VGSS-2025-003', 'Pedro Alves', 'male', '2010-08-10', 1, 'Jose Alves', '77456789', 'Ossu, Viqueque', '2025-01-10', 'active'),
('VGSS-2025-004', 'Ana Fernandes', 'female', '2009-11-05', 3, 'Maria Fernandes', '77567890', 'Venilale, Baucau', '2024-01-10', 'active'),
('VGSS-2025-005', 'Carlos Pereira', 'male', '2009-01-20', 3, 'Antonio Pereira', '77678901', 'Baguia, Baucau', '2024-01-10', 'active'),
('VGSS-2025-006', 'Luisa Martins', 'female', '2008-07-18', 5, 'Jose Martins', '77789012', 'Venilale, Baucau', '2023-01-10', 'active'),
('VGSS-2025-007', 'Tomas Soares', 'male', '2008-12-25', 5, 'Rui Soares', '77890123', 'Venilale, Baucau', '2023-01-10', 'active'),
('VGSS-2025-008', 'Beatriz Costa', 'female', '2007-04-30', 7, 'Manuel Costa', '77901234', 'Laga, Baucau', '2022-01-10', 'active'),
('VGSS-2025-009', 'Miguel Ribeiro', 'male', '2007-09-12', 7, 'Paulo Ribeiro', '78012345', 'Venilale, Baucau', '2022-01-10', 'active'),
('VGSS-2025-010', 'Rosa Gomes', 'female', '2006-06-08', 9, 'Antonio Gomes', '78123456', 'Venilale, Baucau', '2021-01-10', 'active');

-- Insert sample grades for Term 1 2025-2026
INSERT INTO grades (student_id, subject_id, class_id, academic_term, academic_year, score, grade_letter, remarks, entered_by) VALUES
(1, 1, 1, 'Term 1', '2025-2026', 85.00, 'A', 'Very Good', 1),
(1, 2, 1, 'Term 1', '2025-2026', 78.00, 'B+', 'Good', 1),
(1, 3, 1, 'Term 1', '2025-2026', 90.00, 'A+', 'Excellent', 1),
(1, 5, 1, 'Term 1', '2025-2026', 88.00, 'A-', 'Very Good', 1),
(1, 6, 1, 'Term 1', '2025-2026', 72.00, 'B', 'Good', 1),
(2, 1, 1, 'Term 1', '2025-2026', 92.00, 'A+', 'Excellent', 1),
(2, 2, 1, 'Term 1', '2025-2026', 95.00, 'A+', 'Excellent', 1),
(2, 3, 1, 'Term 1', '2025-2026', 88.00, 'A-', 'Very Good', 1),
(2, 5, 1, 'Term 1', '2025-2026', 91.00, 'A+', 'Excellent', 1),
(2, 6, 1, 'Term 1', '2025-2026', 85.00, 'A', 'Very Good', 1),
(3, 1, 1, 'Term 1', '2025-2026', 70.00, 'B', 'Good', 1),
(3, 2, 1, 'Term 1', '2025-2026', 65.00, 'B-', 'Satisfactory', 1),
(3, 3, 1, 'Term 1', '2025-2026', 75.00, 'B+', 'Good', 1),
(3, 5, 1, 'Term 1', '2025-2026', 80.00, 'A-', 'Very Good', 1),
(3, 6, 1, 'Term 1', '2025-2026', 60.00, 'C+', 'Satisfactory', 1);
