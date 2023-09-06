<?php
include_once __DIR__ . '/../model/tutorials.php';

class tutorialsController extends tutorials
{
    public function getAllTuto()
    {
        return $this->getAllTutoInfo();
    }

    public function uploadTuto($title, $video, $description, $package)
    {
        return $this->uploadTutoInfo($title, $video, $description, $package);
    }

    public function showTuto($id)
    {
        return $this->showTutoInfo($id);
    }

    public function getFreeTuto()
    {
        return $this->getAllFreeTuto();
    }

    public function updateTuto($id, $title, $video, $description, $package)
    {
        return $this->updateTutoInfo($id, $title, $video, $description, $package);
    }

    public function deletetuto($id)
    {
        return $this->deletetutoInfo($id);
    }
    public function getTutoByPack($id)
    {
        return $this->getTutoByPackInfo($id);
    }
}
?>
