<?php
include_once __DIR__ . '/../vendor/database/database.php';

class firmware
{
    public function getAllFirmwareInfo()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $sql = "SELECT * FROM firmwares";
        $sql = "SELECT firmwares.*,models.name as model FROM firmwares JOIN models on firmwares.models_id = models.id";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function createFirmwareInfo($name, $miui, $android, $size, $type, $down_link, $down_link_1, $details, $model_id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = "INSERT INTO firmwares 
                (name, miui_version, android_version, size, type, download_link, download_link_1, details, models_id) 
                VALUES (:name, :miui, :android, :size, :type, :down_link, :down_link_1, :details, :model_id)";
        
        $statement = $con->prepare($sql);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':miui', $miui);
        $statement->bindParam(':android', $android);
        $statement->bindParam(':size', $size);
        $statement->bindParam(':type', $type);
        $statement->bindParam(':down_link', $down_link);
        $statement->bindParam(':down_link_1', $down_link_1);
        $statement->bindParam(':details', $details);
        $statement->bindParam(':model_id', $model_id);
    
        try {
            if ($statement->execute()) {
                return true; // Insertion was successful
            } else {
                return false; // Insertion failed
            }
        } catch (PDOException $e) {
            return false; // An exception occurred (likely a database error)
        }
    }
    

    public function showFirmInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM firmwares WHERE id=:id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function updateFirmInfo($id, $name, $miui, $android, $size, $type, $down_link,$down_link_1,$details, $model_id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'UPDATE firmwares SET name=:name,miui_version=:miui,android_version=:android,size=:size,type=:type,download_link=:down_link,download_link_1=:down_link_1,details=:details,models_id=:model_id WHERE id=:id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':miui', $miui);
        $statement->bindParam(':android', $android);
        $statement->bindParam(':size', $size);
        $statement->bindParam(':type', $type);
        $statement->bindParam(':down_link', $down_link);
        $statement->bindParam(':down_link_1', $down_link_1);
        $statement->bindParam(':details', $details);
        $statement->bindParam(':model_id', $model_id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletefirmInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'DELETE FROM firmwares WHERE id=:id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function fimByModelsInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM firmwares WHERE models_id =:id ';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function imgFirmInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT models.image FROM firmwares JOIN models ON firmwares.models_id = models.id
        WHERE firmwares.id = :id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}
