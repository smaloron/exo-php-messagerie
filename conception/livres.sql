USE formation;

DROP TABLE IF EXISTS auteurs;
CREATE TABLE auteurs(
    id SMALLINT UNSIGNED AUTO_INCREMENT,
    nom_auteur VARCHAR(50) NOT NULL,
    prenom_auteur VARCHAR(50),
    PRIMARY KEY (id)
);

INSERT INTO auteurs (nom_auteur, prenom_auteur)
VALUES ('Hugo', 'Victor'), ('Hamett', 'Dashiel'), ('Hikmet', 'Nazim');

DROP TABLE IF EXISTS editeurs;
CREATE TABLE editeurs(
    id SMALLINT UNSIGNED AUTO_INCREMENT,
    nom_editeur VARCHAR(50) NOT NULL,
    pays_editeur VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO editeurs (nom_editeur, pays_editeur)
VALUES ('Grasset', 'France'), ('Peachit Press', 'Etats Unis');

DROP TABLE IF EXISTS genres;
CREATE TABLE genres(
    id SMALLINT UNSIGNED AUTO_INCREMENT,
    nom_genre VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO genres (nom_genre) VALUES ('Informatique'), ('Roman'), ('Politique');

DROP TABLE IF EXISTS livres;
CREATE TABLE livres(
    id SMALLINT UNSIGNED AUTO_INCREMENT,
    titre VARCHAR(80) NOT NULL,
    annee_publication YEAR NOT NULL,
    prix SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO livres (titre, annee_publication, prix)
VALUES 
('Les Misérables', '1985', 1500),
('SQL for smarties', '2005', 5700),
('Les dernières Trumperies sur le climat', '2020', 1200);