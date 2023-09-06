<?php
include_once __DIR__ . '/../vendor/database/database.php';

class models{
    public function getAllModelsInfo(){
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT models.id as id,models.name as name,models.image as image,brands.name as brand from brands JOIN models on models.brands_id = brands.id";
        $statement = $con->prepare($sql);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function createNewModelInfo($name,$image,$brand_id){
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'INSERT INTO models(name,image,brands_id) VALUES (:name,:image,:brands_id)';
        $statement = $con->prepare($sql);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':image', $image);
        $statement->bindParam(':brands_id', $brand_id);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function showModelInfo($id){
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM models WHERE id = :id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if($statement->execute()){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function updateModelInfo($id,$name,$image,$brand_id){
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'UPDATE models SET name=:name,image=:image,brands_id=:brand_id WHERE id=:id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':image', $image);
        $statement->bindParam(':brand_id', $brand_id);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function deleteModelInfo($id){
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'DELETE FROM models WHERE id=:id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function showModelInfos($id){
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $sql = 'SELECT * FROM models WHERE brands_id = :id';
        $sql = 'SELECT models.* FROM models JOIN firmwares ON models.id = firmwares.models_id JOIN brands ON brands.id = models.brands_id WHERE models.brands_id =:id GROUP BY models.id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    // public function dirInfo($id){
    //     $con = Database::connect();
    //     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //     $sql = 'SELECT * FROM brands WHERE id = :id';
    //     $statement = $con->prepare($sql);
    //     $statement->bindParam(':id', $id);
    //     if($statement->execute()){
    //         $result = $statement->fetch(PDO::FETCH_ASSOC);
    //     }
    //     return $result;
    // }

}

?>