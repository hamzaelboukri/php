








CREATE TABLE player(
    PlayerID int primary key AUTO_INCREMENT ,
    Name varchar(255) NOT NULL UNIQUE,
    ImagePlayer varchar(255) NOT NULL UNIQUE,
    Position varchar(255) NOT NULL,
    Rating int NOT NULL,
    ClubID int NOT NULL,
    NationalityID int
    );

CREATE TABLE club(
    ClubID int primary key AUTO_INCREMENT ,
    ClubName varchar(255)  NOT NULL UNIQUE,
    ClubImage varchar(255) NOT NULL UNIQUE
    );

CREATE TABLE nationality(
    NationalityID int primary key AUTO_INCREMENT,
    NationalityName varchar(255) NOT NULL UNIQUE,
    NationalityImage varchar(255) NOT NULL UNIQUE
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
