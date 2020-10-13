CREATE OR REPLACE VIEW vue_livres AS
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