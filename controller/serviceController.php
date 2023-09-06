<?php
include_once __DIR__ . '/../model/service.php';

class serviceController extends service
{
    public function getAllfaq()
    {
        return $this->getAllfaqInfo();
    }
    public function createfaq($title, $content)
    {
        return $this->createfaqInfo($title, $content);
    }

    public function showfaq($id)
    {
        return $this->showfaqInfo($id);
    }

    public function updatefaq($id, $title, $content)
    {
        return $this->updatefaqInfo($id, $title, $content);
    }
}

?>
