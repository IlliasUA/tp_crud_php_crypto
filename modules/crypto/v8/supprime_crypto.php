<?php
class supprime_crypto
{
    function getAllResultats($pdo, $oBdd, $GLOBALS_INI, $vars)
    {
        $idCrypto = isset($vars["id_crypto"]) ? filter_var($vars["id_crypto"], FILTER_VALIDATE_INT) : false;
        if (!$idCrypto || $idCrypto < 1) {
            throw new InvalidArgumentException("Identifiant de cryptomonnaie invalide");
        }

        $pdo->prepare("DELETE FROM strategies_crypto WHERE id_cryptomonnaie = :id")->execute(array("id" => $idCrypto));
        $pdo->prepare("DELETE FROM notification_crypto WHERE id_cryptomonnaie = :id")->execute(array("id" => $idCrypto));
        $sql = $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_SQL"] . "delete_crypto.sql";
        return $oBdd->treatDatas($pdo, $sql, array("id_crypto" => $idCrypto));
    }
}
?>
