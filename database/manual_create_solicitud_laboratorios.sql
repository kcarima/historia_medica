CREATE TABLE solicitud_laboratorios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cedula VARCHAR(30),
    nombre VARCHAR(255),
    edad VARCHAR(20),
    historia VARCHAR(50),
    fecha VARCHAR(50),
    examenes TEXT,
    otros TEXT
);
