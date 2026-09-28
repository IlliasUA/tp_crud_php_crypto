<?php
function getCryptoFormData($vars)
{
    $required = array(
        "id_niveau_risque", "id_reseau", "nom_crypto", "symbole_crypto",
        "prix", "qntte_jetons", "date_achat"
    );

    foreach ($required as $field) {
        if (!isset($vars[$field]) || $vars[$field] === "") {
            throw new InvalidArgumentException("Champ obligatoire manquant : " . $field);
        }
    }

    $date = DateTime::createFromFormat("Y-m-d", $vars["date_achat"]);
    if (!$date || $date->format("Y-m-d") !== $vars["date_achat"]) {
        throw new InvalidArgumentException("Date d'achat invalide");
    }

    $idRisque = filter_var($vars["id_niveau_risque"], FILTER_VALIDATE_INT);
    $idReseau = filter_var($vars["id_reseau"], FILTER_VALIDATE_INT);
    $prix = filter_var($vars["prix"], FILTER_VALIDATE_FLOAT);
    $quantite = filter_var($vars["qntte_jetons"], FILTER_VALIDATE_FLOAT);

    if ($idRisque < 1 || $idRisque > 3 || $idReseau < 1 || $idReseau > 8) {
        throw new InvalidArgumentException("Risque ou réseau invalide");
    }
    if ($prix === false || $prix < 0 || $quantite === false || $quantite <= 0) {
        throw new InvalidArgumentException("Prix ou quantité invalide");
    }

    $nom = trim($vars["nom_crypto"]);
    $symbole = strtoupper(trim($vars["symbole_crypto"]));
    if ($nom === "" || mb_strlen($nom) > 50 || $symbole === "" || mb_strlen($symbole) > 10) {
        throw new InvalidArgumentException("Nom ou symbole invalide");
    }

    return array(
        "id_niveau_risque" => $idRisque,
        "id_reseau" => $idReseau,
        "nom_crypto" => $nom,
        "symbole_crypto" => $symbole,
        "prix" => $prix,
        "qntte_jetons" => $quantite,
        "date_achat" => $vars["date_achat"] . " 00:00:00",
        "note" => isset($vars["note"]) ? trim($vars["note"]) : ""
    );
}

function getRelationIds($vars, $field)
{
    $values = isset($vars[$field]) && is_array($vars[$field]) ? $vars[$field] : array();
    $ids = array_values(array_unique(array_map("intval", $values)));
    return array_values(array_filter($ids, function ($id) {
        return $id >= 1 && $id <= 5;
    }));
}

function replaceCryptoRelations($pdo, $idCrypto, $table, $column, $ids)
{
    $allowed = array(
        "strategies_crypto" => "id_strategies",
        "notification_crypto" => "id_notification"
    );
    if (!isset($allowed[$table]) || $allowed[$table] !== $column) {
        throw new InvalidArgumentException("Relation invalide");
    }

    $delete = $pdo->prepare("DELETE FROM " . $table . " WHERE id_cryptomonnaie = :id");
    $delete->execute(array("id" => $idCrypto));

    $insert = $pdo->prepare(
        "INSERT INTO " . $table . " (id_cryptomonnaie, " . $column . ") VALUES (:id_crypto, :id_relation)"
    );
    foreach ($ids as $idRelation) {
        $insert->execute(array("id_crypto" => $idCrypto, "id_relation" => $idRelation));
    }
}
?>
