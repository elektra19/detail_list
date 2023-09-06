<?php
include_once __DIR__ . '/../model/boxdown.php';
class boxDownController extends boxdown
{
    public function getAllBoxdown()
    {
        return $this->getAllBoxdownInfo();
    }

    public function createBoxdown($name, $download_link, $image, $box_id, $post)
    {
        return $this->createBoxdownInfo($name, $download_link, $image, $box_id, $post);
    }

    public function showBoxdown($id)
    {
        return $this->showBoxdownInfo($id);
    }

    public function updateBoxdown($id, $name, $download_link, $image, $box_id, $post)
    {
        return $this->updateBoxdownInfo($id, $name, $download_link, $image, $box_id, $post);
    }

    public function deleteBox($id)
    {
        return $this->deleteBoxInfo($id);
    }
}
