<?php
include_once __DIR__ . '/../vendor/database/database.php';

class box
{
    public function getAllBoxInfo()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM box';
        $statement = $con->prepare($sql);

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function createBoxInfo($name)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'INSERT INTO box(name) VALUES (:name)';
        $statement = $con->prepare($sql);
        $statement->bindParam(':name', $name);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function showBoxInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM box WHERE id=:id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function updateBoxInfo($id,$name)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'UPDATE box SET name=:name WHERE id=:id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteBoxInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'DELETE FROM box WHERE id=:id';
        $statment = $con->prepare($sql);
        $statment->bindParam(':id', $id);

        if ($statment->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function boxlistInfo()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT box.id AS tid,box.name AS bname,COUNT(box_list.id) AS total FROM box JOIN box_list ON box.id = box_list.box_id GROUP BY box.id, box.name';
        $statment = $con->prepare($sql);

        if ($statment->execute()) {
            $result = $statment->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function showByCatInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM box_list WHERE box_id=:id';
        $statment = $con->prepare($sql);
        $statment->bindParam(':id', $id);

        if ($statment->execute()) {
            $result = $statment->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function latestPostInfo()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM box_list ORDER BY created_at DESC LIMIT 5';
        $statment = $con->prepare($sql);

        if ($statment->execute()) {
            $result = $statment->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}

?>
