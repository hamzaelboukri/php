








CREATE TABLE player (
    id_player INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    nationality VARCHAR(255) NOT NULL,
    photo_url TEXT NOT NULL,
    club VARCHAR(255) NOT NULL,
    pace INT CHECK (pace BETWEEN 1 AND 100),
    shooting INT CHECK (shooting BETWEEN 1 AND 100),
    passing INT CHECK (passing BETWEEN 1 AND 100),
    dribbling INT CHECK (dribbling BETWEEN 1 AND 100),
    defending INT CHECK (defending BETWEEN 1 AND 100),
    physical INT CHECK (physical BETWEEN 1 AND 100),
    flag_url TEXT NOT NULL,
    rating INT NOT NULL
);


CREATE TABLE nationalities (
    id_nationality INT AUTO_INCREMENT PRIMARY KEY,
    nationality_name VARCHAR(100) NOT NULL  UNIQUE,
    photo_url TEXT NOT NULL
);


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL
);



















CREATE TABLE statistiques (
    id_statistique INT AUTO_INCREMENT PRIMARY KEY,
    id_joueur INT,
    matchs_joues INT,
    buts INT,
    passes DECIMAL(5, 2),
    FOREIGN KEY (id_joueur) REFERENCES joueurs(id_joueur)
);
