<?php
require_once __DIR__ . "/crypto_form.php";

class update_crypto
{
    function getAllResultats($pdo, $oBdd, $GLOBALS_INI, $vars)
    {
        $idCrypto = isset($vars["id_crypto"]) ? filter_var($vars["id_crypto"], FILTER_VALIDATE_INT) : false;
        if (!$idCrypto || $idCrypto < 1) {
            throw new InvalidArgumentException("Identifiant de cryptomonnaie invalide");
        }

        $data = getCryptoFormData($vars);
        $data["id_crypto"] = $idCrypto;
        $sql = $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_SQL"] . "update_crypto.sql";
        $oBdd->treatDatas($pdo, $sql, $data);

        replaceCryptoRelations($pdo, $idCrypto, "strategies_crypto", "id_strategies", getRelationIds($vars, "strategies"));
        replaceCryptoRelations($pdo, $idCrypto, "notification_crypto", "id_notification", getRelationIds($vars, "notifications"));
        return $idCrypto;
    }
}
?>
