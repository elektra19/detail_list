<?php
include_once __DIR__ . '/../model/team.php';
class teamController extends team
{
    public function getAllMember()
    {
        return $this->getAllMemberInfo();
    }

    public function insertTeamMember($name, $role, $discription, $image)
    {
        return $this->insertTeamMemberInfo($name, $role, $discription, $image);
    }

    public function getMemberById($id)
    {
        return $this->getMemberByIdInfo($id);
    }
    public function updateTeamMember($id, $name, $role, $discription, $image)
    {
        return $this->updateTeamMemberInfo($id, $name, $role, $discription, $image);
    }
}
