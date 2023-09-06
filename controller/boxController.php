<?php
include_once __DIR__ . '/../model/box.php';

class boxController extends box
{
    public function getAllBox()
    {
        return $this->getAllBoxInfo();
    }

    public function createBox($name)
    {
        return $this->createBoxInfo($name);
    }

    public function showBox($id)
    {
        return $this->showBoxInfo($id);
    }

    public function updateBox($id, $name)
    {
        return $this->updateBoxInfo($id, $name);
    }

    public function deleteBox($id)
    {
        return $this->deleteBoxInfo($id);
    }

    public function boxlist()
    {
        return $this->boxlistInfo();
    }

    public function showByCat($id)
    {
        return $this->showByCatInfo($id);
    }

    public function latestPost($id)
    {
        return $this->latestPostInfo($id);
    }
}
