<?php
require_once __DIR__ . "/crypto_form.php";

class save_crypto
{
    function getAllResultats($pdo, $oBdd, $GLOBALS_INI, $vars)
    {
        $data = getCryptoFormData($vars);
        $sql = $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_SQL"] . "insert_crypto.sql";
        $oBdd->treatDatas($pdo, $sql, $data);
        $idCrypto = (int) $pdo->lastInsertId();

        replaceCryptoRelations($pdo, $idCrypto, "strategies_crypto", "id_strategies", getRelationIds($vars, "strategies"));
        replaceCryptoRelations($pdo, $idCrypto, "notification_crypto", "id_notification", getRelationIds($vars, "notifications"));
        return $idCrypto;
    }
}
?>
