-- Select the database
USE edutrack;

-- Drop existing tables for a clean slate
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Years;
DROP TABLE IF EXISTS Assignments;
DROP TABLE IF EXISTS Classes;
DROP TABLE IF EXISTS Finals;
DROP TABLE IF EXISTS Labs;
DROP TABLE IF EXISTS MidTerms;
DROP TABLE IF EXISTS Projects;
DROP TABLE IF EXISTS Quizzes;
DROP TABLE IF EXISTS Semesters;

-- Create Users Table
CREATE TABLE Users (
    u_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create Years Table
CREATE TABLE Years (
    y_id INT AUTO_INCREMENT PRIMARY KEY,
    year INT NOT NULL UNIQUE
);

-- Create Assignments Table
CREATE TABLE Assignments (
    a_id INT AUTO_INCREMENT PRIMARY KEY,
    c_id INT NOT NULL,
    l_id INT DEFAULT NULL,
    asmntNum INT NOT NULL,
    asmntName VARCHAR(255) NOT NULL,
    asmntDueDate DATE DEFAULT NULL
);

-- Create Classes Table
CREATE TABLE Classes (
    c_id INT AUTO_INCREMENT PRIMARY KEY,
    s_id INT NOT NULL,
    className VARCHAR(255) NOT NULL,
    classNotes TEXT DEFAULT NULL
);

-- Create Finals Table
CREATE TABLE Finals (
    f_id INT AUTO_INCREMENT PRIMARY KEY,
    c_id INT NOT NULL,
    l_id INT DEFAULT NULL,
    fnlNum INT NOT NULL,
    fnlName VARCHAR(255) NOT NULL,
    fnlDueDate DATE DEFAULT NULL
);

-- Create Labs Table
CREATE TABLE Labs (
    l_id INT AUTO_INCREMENT PRIMARY KEY,
    c_id INT NOT NULL,
    labName VARCHAR(255) NOT NULL,
    labNotes TEXT DEFAULT NULL
);

-- Create MidTerms Table
CREATE TABLE MidTerms (
    m_id INT AUTO_INCREMENT PRIMARY KEY,
    c_id INT NOT NULL,
    l_id INT DEFAULT NULL,
    mtNum INT NOT NULL,
    mtName VARCHAR(255) NOT NULL,
    mtDueDate DATE DEFAULT NULL
);

-- Create Projects Table
CREATE TABLE Projects (
    p_id INT AUTO_INCREMENT PRIMARY KEY,
    c_id INT NOT NULL,
    l_id INT DEFAULT NULL,
    projNum INT NOT NULL,
    projName VARCHAR(255) NOT NULL,
    projDueDate DATE DEFAULT NULL
);

-- Create Quizzes Table
CREATE TABLE Quizzes (
    q_id INT AUTO_INCREMENT PRIMARY KEY,
    c_id INT NOT NULL,
    l_id INT DEFAULT NULL,
    qzNum INT NOT NULL,
    qzName VARCHAR(255) NOT NULL,
    qzDueDate DATE DEFAULT NULL
);

-- Create Semesters Table
CREATE TABLE Semesters (
    s_id INT AUTO_INCREMENT PRIMARY KEY,
    y_id INT NOT NULL,
    smstrName VARCHAR(255) NOT NULL,
    smstrStartDate DATE DEFAULT NULL,
    smstrEndDate DATE DEFAULT NULL
);

-- Insert Sample Data into Users Table
INSERT INTO Users (username, email, password_hash)
VALUES
('user1', 'user1@example.com', '$2y$10$hashedpassword1'),
('user2', 'user2@example.com', '$2y$10$hashedpassword2');

-- Insert Sample Data into Years Table
INSERT INTO Years (year)
VALUES
(2024),
(2025);

-- Insert Sample Data into Assignments Table
INSERT INTO Assignments (c_id, l_id, asmntNum, asmntName, asmntDueDate)
VALUES
(1, 1, 1, 'Assignment 1', '2024-12-01');

-- Insert Sample Data into Classes Table
INSERT INTO Classes (s_id, className, classNotes)
VALUES
(1, 'Software Engineering', 'Notes for the class');

-- Insert Sample Data into Finals Table
INSERT INTO Finals (c_id, l_id, fnlNum, fnlName, fnlDueDate)
VALUES
(1, 1, 1, 'Final Exam', '2024-12-15');

-- Insert Sample Data into Labs Table
INSERT INTO Labs (c_id, labName, labNotes)
VALUES
(1, 'Lab 1', 'Lab notes');

-- Insert Sample Data into MidTerms Table
INSERT INTO MidTerms (c_id, l_id, mtNum, mtName, mtDueDate)
VALUES
(1, 1, 1, 'MidTerm Exam', '2024-11-15');

-- Insert Sample Data into Projects Table
INSERT INTO Projects (c_id, l_id, projNum, projName, projDueDate)
VALUES
(1, 1, 1, 'Project 1', '2024-12-10');

-- Insert Sample Data into Quizzes Table
INSERT INTO Quizzes (c_id, l_id, qzNum, qzName, qzDueDate)
VALUES
(1, 1, 1, 'Quiz 1', '2024-11-01');

-- Insert Sample Data into Semesters Table
INSERT INTO Semesters (y_id, smstrName, smstrStartDate, smstrEndDate)
VALUES
(1, 'Fall 2024', '2024-09-01', '2024-12-15');