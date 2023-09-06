<?php
include_once __DIR__ . '/../vendor/database/database.php';

class firminfo
{
    public function firmsInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT brands.name AS brand_name, models.name AS model_name, firmwares.name AS firmware_name
            FROM firmware_info
            JOIN models ON firmware_info.models_id = models.id
            JOIN brands ON models.brands_id = brands.id
            JOIN firmwares ON firmware_info.firmwares_id = firmwares.id
            AND models.id =:id GROUP BY firmware_info.brands_id
            ';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function firmsmodelInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT brands.name AS brand_name, models.name AS model_name, firmwares.name AS firmware_name
            FROM firmware_info
            JOIN models ON firmware_info.models_id = models.id
            JOIN brands ON models.brands_id = brands.id
            JOIN firmwares ON firmware_info.firmwares_id = firmwares.id
            AND firmwares.id =:id GROUP BY firmware_info.brands_id
            ';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}
