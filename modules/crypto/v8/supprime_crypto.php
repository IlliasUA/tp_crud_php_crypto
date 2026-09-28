<?php
class supprime_crypto
{
    function getAllResultats($numero_de_connexion, $oBdd, $GLOBALS_INI, $VARS_HTML)
    {
        $spathSQL = $GLOBALS_INI["PATH_HOME"]
                  . $GLOBALS_INI["PATH_SQL"]
                  . "delete_crypto.sql";

        $resultat = $oBdd->treatDatas(
            $numero_de_connexion,
            $spathSQL,
            array(
                "id_crypto" => $VARS_HTML["id_crypto"]
            )
        );

        return $resultat;
    }
}
?>