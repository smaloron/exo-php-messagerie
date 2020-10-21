SET foreign_key_checks = 0;

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
    id_genre SMALLINT UNSIGNED NOT NULL,
    id_editeur SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT contrainte_livre_genre
        FOREIGN KEY (id_genre)
        REFERENCES genres(id),
    CONSTRAINT contrainte_livre_editeur 
        FOREIGN KEY (id_editeur) 
        REFERENCES editeurs(id)
);

INSERT INTO livres (titre, annee_publication, prix, id_genre, id_editeur)
VALUES 
('Les Misérables', '1985', 1500, 2, 1),
('SQL for smarties', '2005', 5700, 1, 2),
('Les dernières Trumperies sur le climat', '2020', 1200, 3, 2);


DROP TABLE IF EXISTS livres_auteurs;

CREATE TABLE livres_auteurs(
    id_livre SMALLINT UNSIGNED,
    id_auteur SMALLINT UNSIGNED,
    PRIMARY KEY (id_livre, id_auteur),
    CONSTRAINT contrainte_livres_auteurs_livre 
        FOREIGN KEY (id_livre) REFERENCES livres(id),
    CONSTRAINT contrainte_livres_auteurs_auteur 
        FOREIGN KEY (id_auteur) REFERENCES auteurs(id)
);

INSERT INTO livres_auteurs (id_livre, id_auteur)
VALUES (1, 1), (1, 2), (2, 3), (3, 3), (3, 1);


SET foreign_key_checks = 1;