<?php
include_once __DIR__ . '/../vendor/database/database.php';
class boxdown{
    public function getAllBoxdownInfo(){
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'select box_list.*,box.name as bname from box_list JOIN box ON box.id = box_list.box_id';
        $statment = $con->prepare($sql);

        if ($statment->execute()) {
            $result = $statment->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function createBoxdownInfo($name,$download_link,$image,$box_id,$post)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'INSERT INTO box_list(name,download_link,image,box_id,post) VALUES (:name,:download_link,:image,:box_id,:post)';
        $statment = $con->prepare($sql);
        $statment->bindParam(':name', $name);
        $statment->bindParam(':download_link', $download_link);
        $statment->bindParam(':image', $image);
        $statment->bindParam(':box_id', $box_id);
        $statment->bindParam(':post', $post);

        if ($statment->execute()) {
            return true;
        }else{
            return false;
        }
    }

    public function showBoxdownInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM box_list WHERE id=:id';
        $statment = $con->prepare($sql);
        $statment->bindParam(':id', $id);

        if ($statment->execute()) {
            $result = $statment->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function updateBoxdownInfo($id,$name, $download_link, $image, $box_id, $post)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'UPDATE box_list SET name=:name,download_link=:download_link,image=:image,box_id=:box_id,post=:post WHERE id=:id';
        $statment = $con->prepare($sql);
        $statment->bindParam(':id', $id);
        $statment->bindParam(':name', $name);
        $statment->bindParam(':download_link', $download_link);
        $statment->bindParam(':image', $image);
        $statment->bindParam(':box_id', $box_id);
        $statment->bindParam(':post', $post);

        if ($statment->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteBoxInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'DELETE FROM box_list WHERE id=:id';
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