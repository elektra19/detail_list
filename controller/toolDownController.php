<?php
include_once __DIR__ . '/../model/tooldown.php';

class toolDownController extends tooldown
{
    public function getAllTollDown()
    {
        return $this->getAllTollDownInfo();
    }

    public function createTool($name, $downlink, $image, $tools_id, $post)
    {
        return $this->createToolInfo($name, $downlink, $image, $tools_id, $post);
    }
    public function showAllTollDown($id)
    {
        return $this->showAllTollDownInfo($id);
    }

    public function updateTool($id,$name, $downlink, $image, $tools_id, $post)
    {
        return $this->updateToolInfo($id,$name, $downlink, $image, $tools_id, $post);
    }


    public function deleteTool($id)
    {
        return $this->deleteToolInfo($id);
    }
}
