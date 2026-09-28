UPDATE cryptomonnaie AS c
JOIN niveau_risque AS nr
    ON nr.nom_niveau_risque = @nom_niveau_risque
JOIN reseau AS r
    ON r.nom_reseau = @nom_reseau
SET
    c.id_niveau_risque = nr.id_niveau_risque,
    c.id_reseau = r.id_reseau,
    c.nom_crypto = @nom_crypto,
    c.symbole_crypto = @symbole_crypto,
    c.prix = @prix,
    c.qntte_jetons = @qntte_jetons,
    c.date_achat = @date_achat,
    c.note = @note
WHERE c.id_cryptomonnaie = @id_crypto;