<?php
include_once __DIR__ . '/../vendor/database/database.php';
class team
{
    public function getAllMemberInfo()
    {
        $connect = database::connect();
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'select * from team';
        $statment = $connect->prepare($sql);

        if ($statment->execute()) {
            $result = $statment->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function insertTeamMemberInfo($name, $role, $discription, $image)
    {
        $connect = database::connect();
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'INSERT INTO team(name,role,discription,image) VALUES (:name,:role,:discription,:image)';
        $statment = $connect->prepare($sql);
        $statment->bindParam(':name', $name);
        $statment->bindParam(':role', $role);
        $statment->bindParam(':discription', $discription);
        $statment->bindParam(':image', $image);

        if ($statment->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getMemberByIdInfo($id)
    {
        $connect = database::connect();
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'select * from team where id=:id';
        $statment = $connect->prepare($sql);
        $statment->bindParam(':id', $id);
        if ($statment->execute()) {
            $result = $statment->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function updateTeamMemberInfo($id,$name, $role, $discription, $image)
    {
        $connect = database::connect();
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'UPDATE team SET name=:name,role=:role,discription=:discription,image=:image WHERE id=:id';
        $statment = $connect->prepare($sql);
        $statment->bindParam(':id', $id);
        $statment->bindParam(':name', $name);
        $statment->bindParam(':role', $role);
        $statment->bindParam(':discription', $discription);
        $statment->bindParam(':image', $image);

        if ($statment->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
