<?php
include_once __DIR__ . '/../vendor/database/database.php';
class Tools
{
    public function getAllToolsInfo()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'select * from tools';
        $statment = $con->prepare($sql);

        if ($statment->execute()) {
            $result = $statment->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function createToolInfo($name)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'INSERT INTO tools(name) VALUES (:name)';
        $statment = $con->prepare($sql);
        $statment->bindParam(':name', $name);

        if ($statment->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function showToolInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'select * from tools WHERE id=:id';
        $statment = $con->prepare($sql);
        $statment->bindParam(':id', $id);

        if ($statment->execute()) {
            $result = $statment->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function updateToolInfo($id, $name)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'UPDATE tools SET name=:name WHERE id =:id';
        $statment = $con->prepare($sql);
        $statment->bindParam(':id', $id);
        $statment->bindParam(':name', $name);

        if ($statment->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteToolInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'DELETE FROM tools WHERE id=:id';
        $statment = $con->prepare($sql);
        $statment->bindParam(':id', $id);

        if ($statment->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function toollistInfo()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT tools.id AS tid,tools.name AS tname,COUNT(tools_list.id) AS total FROM tools JOIN tools_list ON tools.id = tools_list.tools_id GROUP BY tools.id, tools.name';
        $statment = $con->prepare($sql);

        if ($statment->execute()) {
            $result = $statment->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function gettAllToolByCatInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM `tools_list` WHERE tools_id = :id';
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

        $sql = 'SELECT * FROM tools_list ORDER BY created_at DESC LIMIT 5';
        $statment = $con->prepare($sql);

        if ($statment->execute()) {
            $result = $statment->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    
}

?>
