<?php
class update_crypto
{
    function getAllResultats($numero_de_connexion, $oBdd, $GLOBALS_INI, $VARS_HTML)
    {
        $spathSQL = $GLOBALS_INI["PATH_HOME"]
                  . $GLOBALS_INI["PATH_SQL"]
                  . "update_crypto.sql";

        $resultat = $oBdd->treatDatas(
            $numero_de_connexion,
            $spathSQL,
            array(
                "id_crypto"         => $VARS_HTML["id_crypto"],
                "nom_niveau_risque" => $VARS_HTML["nom_niveau_risque"],
                "nom_reseau"        => $VARS_HTML["nom_reseau"],
                "nom_crypto"        => $VARS_HTML["nom_crypto"],
                "symbole_crypto"    => $VARS_HTML["symbole_crypto"],
                "prix"              => $VARS_HTML["prix"],
                "qntte_jetons"      => $VARS_HTML["qntte_jetons"],
                "date_achat"        => $VARS_HTML["date_achat"],
                "note"              => $VARS_HTML["note"]
            )
        );

        return $resultat;
    }
}
?>