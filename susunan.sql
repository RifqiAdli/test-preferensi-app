-- Membuat database
CREATE DATABASE IF NOT EXISTS preference_test;
USE preference_test;

-- Membuat tabel users
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Membuat tabel responses untuk menyimpan jawaban
CREATE TABLE IF NOT EXISTS responses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    question_number INT NOT NULL,
    answer CHAR(1) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Membuat tabel admin_users
CREATE TABLE IF NOT EXISTS admin_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default admin user (username: admin, password: admin123)
INSERT INTO admin_users (username, password) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Membuat indexes untuk optimasi query
CREATE INDEX idx_user_id ON responses(user_id);
CREATE INDEX idx_question_number ON responses(question_number);
CREATE INDEX idx_created_at ON users(created_at);
CREATE INDEX idx_email ON users(email);

-- Menambahkan constraints
ALTER TABLE responses
ADD CONSTRAINT chk_answer CHECK (answer IN ('A', 'B')),
ADD CONSTRAINT chk_question_number CHECK (question_number BETWEEN 1 AND 20);

-- Trigger untuk memastikan email unik per hari
DELIMITER //
CREATE TRIGGER before_user_insert 
BEFORE INSERT ON users
FOR EACH ROW
BEGIN
    IF EXISTS (
        SELECT 1 FROM users 
        WHERE email = NEW.email 
        AND DATE(created_at) = DATE(NEW.created_at)
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Email sudah digunakan hari ini';
    END IF;
END;//
DELIMITER ;

-- View untuk melihat ringkasan jawaban
CREATE OR REPLACE VIEW response_summary AS
SELECT 
    u.id as user_id,
    u.name,
    u.email,
    u.created_at,
    COUNT(r.id) as total_answers,
    SUM(CASE WHEN r.answer = 'A' THEN 1 ELSE 0 END) as total_a,
    SUM(CASE WHEN r.answer = 'B' THEN 1 ELSE 0 END) as total_b
FROM users u
LEFT JOIN responses r ON u.id = r.user_id
GROUP BY u.id, u.name, u.email, u.created_at;

-- View untuk analisis preferensi
CREATE OR REPLACE VIEW preference_analysis AS
SELECT 
    u.id as user_id,
    u.name,
    SUM(CASE 
        WHEN r.question_number IN (2,3,5,8,16,17,18) AND r.answer = 'A' THEN 1
        WHEN r.question_number IN (2,3,5,8,16,17,18) AND r.answer = 'B' THEN -1
        ELSE 0 
    END) as introvert_score,
    SUM(CASE 
        WHEN r.question_number IN (4,6,9,11,13,15,20) AND r.answer = 'A' THEN 1
        WHEN r.question_number IN (4,6,9,11,13,15,20) AND r.answer = 'B' THEN -1
        ELSE 0 
    END) as analytical_score
FROM users u
LEFT JOIN responses r ON u.id = r.user_id
GROUP BY u.id, u.name;
