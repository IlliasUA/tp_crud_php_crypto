SELECT
    c.id_cryptomonnaie,
    c.id_niveau_risque,
    c.id_reseau,
    c.nom_crypto AS nom,
    c.symbole_crypto AS symbole,
    c.prix,
    c.qntte_jetons AS quantite,
    DATE(c.date_achat) AS dateAchat,
    c.note AS notes,
    r.nom_blockchain AS reseau,
    (SELECT GROUP_CONCAT(sc.id_strategies ORDER BY sc.id_strategies)
       FROM strategies_crypto AS sc
      WHERE sc.id_cryptomonnaie = c.id_cryptomonnaie) AS id_strategies,
    (SELECT GROUP_CONCAT(nc.id_notification ORDER BY nc.id_notification)
       FROM notification_crypto AS nc
      WHERE nc.id_cryptomonnaie = c.id_cryptomonnaie) AS id_notifications
FROM cryptomonnaie AS c
INNER JOIN reseau AS r ON r.id_reseau = c.id_reseau
ORDER BY c.id_cryptomonnaie;
