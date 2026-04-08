DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    username VARCHAR(80) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role VARCHAR(30) NOT NULL DEFAULT 'student',
    status VARCHAR(30) NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contraseñas:
-- admin / Admin123*
-- teacher / Teacher123*
-- student / Student123*

INSERT INTO users (name, username, email, password_hash, role, status)
VALUES
('Administrador Principal', 'admin', 'admin@lms.com', '$2y$10$u6XcOa4yV4oPZrYl7uOe0eH7WlZ9g1YjU6f0rj7wP9jv8jGQ0F7gK', 'admin', 'active'),

('Profesor Demo', 'teacher', 'teacher@lms.com', '$2y$10$u6XcOa4yV4oPZrYl7uOe0eH7WlZ9g1YjU6f0rj7wP9jv8jGQ0F7gK', 'teacher', 'active'),

('Estudiante Demo', 'student', 'student@lms.com', '$2y$10$u6XcOa4yV4oPZrYl7uOe0eH7WlZ9g1YjU6f0rj7wP9jv8jGQ0F7gK', 'student', 'active');