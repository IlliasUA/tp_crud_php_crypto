<?php
class Class_database_v4
{
    function connectBDD($host, $name, $login, $psw)
    {
        return new PDO(
            'mysql:host=' . $host . ';dbname=' . $name . ';charset=utf8mb4',
            $login,
            $psw,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    }

    function disconnectBDD($numero_de_connexion)
    {
        $numero_de_connexion = null;
    }

    function getSelectDatas($numero_de_connexion, $spathSQL, $data = array())
    {
        $sql = file_get_contents($spathSQL);
        $requete = $numero_de_connexion->prepare($sql);
        $requete->execute($data);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    function treatDatas($numero_de_connexion, $spathSQL, $data = array())
    {
        $sql = file_get_contents($spathSQL);
        $requete = $numero_de_connexion->prepare($sql);
        $requete->execute($data);
        return $requete->rowCount();
    }
}
?>
