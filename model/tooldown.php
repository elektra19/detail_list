<?php
include_once __DIR__ . '/../vendor/database/database.php';

class tooldown
{
    public function getAllTollDownInfo()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'select * from tools_list';
        $statment = $con->prepare($sql);

        if ($statment->execute()) {
            $result = $statment->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function createToolInfo($name, $downlink, $image, $tools_id, $post)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'INSERT INTO tools_list(name,download_link,image,tools_id,post) VALUES (:name,:download_link,:image,:tools_id,:post)';
        $statment = $con->prepare($sql);
        $statment->bindParam(':name', $name);
        $statment->bindParam(':download_link', $downlink);
        $statment->bindParam(':image', $image);
        $statment->bindParam(':tools_id', $tools_id);
        $statment->bindParam(':post', $post);

        if ($statment->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function showAllTollDownInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $sql = 'SELECT tools_list.*, tools.name AS tname FROM tools_list JOIN tools ON tools.id = tools_list.tools_id WHERE tools_list.id = :id';
        $sql = 'select * from tools_list WHERE id=:id';
        $statment = $con->prepare($sql);
        $statment->bindParam(':id', $id);

        if ($statment->execute()) {
            $result = $statment->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function updateToolInfo($id,$name, $downlink, $image, $tools_id, $post)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'UPDATE tools_list SET name=:name,download_link=:download_link,image=:image,tools_id=:tools_id,post=:post WHERE id=:id';
        $statment = $con->prepare($sql);
        $statment->bindParam(':id', $id);
        $statment->bindParam(':name', $name);
        $statment->bindParam(':download_link', $downlink);
        $statment->bindParam(':image', $image);
        $statment->bindParam(':tools_id', $tools_id);
        $statment->bindParam(':post', $post);

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

        $sql = 'DELETE FROM tools_list WHERE id=:id';
        $statment = $con->prepare($sql);
        $statment->bindParam(':id', $id);

        if ($statment->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
