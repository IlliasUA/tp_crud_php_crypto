INSERT INTO cryptomonnaie (
    id_niveau_risque,
    id_reseau,
    nom_crypto,
    symbole_crypto,
    prix,
    qntte_jetons,
    date_achat,
    note
)
SELECT
    nr.id_niveau_risque,
    r.id_reseau,
    @nom_crypto,
    @symbole_crypto,
    @prix,
    @qntte_jetons,
    @date_achat,
    @note
FROM niveau_risque AS nr
CROSS JOIN reseau AS r
WHERE nr.nom_niveau_risque = @nom_niveau_risque
  AND r.nom_reseau = @nom_reseau;