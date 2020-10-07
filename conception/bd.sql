USE formation;
DROP TABLE IF EXISTS messages;
CREATE TABLE messages(
    id SMALLINT UNSIGNED AUTO_INCREMENT,
    auteur VARCHAR(30),
    texte VARCHAR(150),
    date_message DATETIME,
    PRIMARY KEY (id)
);
INSERT INTO messages (date_message, auteur, texte)
VALUES ('2020-07-12', 'Ufuk', 'Il fait très beau'),
    ('2020-07-13', 'Nazaré', 'Oui même trop chaud'),
    (
        '2020-10-05',
        'Sébastien',
        'Là il commence à faire mauvais'
    );