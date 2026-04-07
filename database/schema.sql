DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    role TEXT NOT NULL DEFAULT 'student',
    status TEXT NOT NULL DEFAULT 'active',
    created_at TEXT DEFAULT CURRENT_TIMESTAMP
);

-- Contraseñas:
-- admin / Admin123*
-- teacher / Teacher123*
-- student / Student123*

INSERT INTO users (name, username, email, password_hash, role, status)
VALUES (
    'Administrador Principal',
    'admin',
    'admin@lms.com',
    '$2y$10$u6XcOa4yV4oPZrYl7uOe0eH7WlZ9g1YjU6f0rj7wP9jv8jGQ0F7gK',
    'admin',
    'active'
);

INSERT INTO users (name, username, email, password_hash, role, status)
VALUES (
    'Profesor Demo',
    'teacher',
    'teacher@lms.com',
    '$2y$10$u6XcOa4yV4oPZrYl7uOe0eH7WlZ9g1YjU6f0rj7wP9jv8jGQ0F7gK',
    'teacher',
    'active'
);

INSERT INTO users (name, username, email, password_hash, role, status)
VALUES (
    'Estudiante Demo',
    'student',
    'student@lms.com',
    '$2y$10$u6XcOa4yV4oPZrYl7uOe0eH7WlZ9g1YjU6f0rj7wP9jv8jGQ0F7gK',
    'student',
    'active'
);