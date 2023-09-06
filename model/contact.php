<?php
include_once __DIR__.'/../vendor/database/database.php';

class contact{
    function getcontactinfo()
{
    $con = Database::connect();
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sataement = $con->prepare('SELECT * FROM contact');
    if ($sataement->execute()) {
        $result = $sataement->fetchAll(PDO::FETCH_ASSOC);
    }
    return $result;
}

}
