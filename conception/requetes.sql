SELECT livres.*, genres.nom_genre
FROM livres, genres
WHERE livres.id_genre = genres.id;

SELECT livres.*, genres.nom_genre, editeurs.nom_editeur, 
GROUP_CONCAT(
CONCAT_WS(' ', auteurs.prenom_auteur, auteurs.nom_auteur) SEPARATOR ','
) as auteurs
FROM livres 
JOIN genres ON livres.id_genre = genres.id
JOIN editeurs ON livres.id_editeur = editeurs.id
JOIN livres_auteurs ON livres_auteurs.id_livre = livres.id
JOIN auteurs ON livres_auteurs.id_auteur = auteurs.id
GROUP BY livres.id;

SELECT editeurs.nom_editeur, 
COUNT(*) as nb, SUM(livres.prix)/100 as total_prix,
AVG(prix)/100 as prix_moyen,
MIN(prix), Max(prix), STD(prix)
FROM livres 
JOIN editeurs ON livres.id_editeur = editeurs.id
GROUP BY editeurs.id;

