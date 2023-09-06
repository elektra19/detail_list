<?php
include_once __DIR__ . '/../model/tools.php';

class toolsController extends Tools
{
    public function getAllTools()
    {
        return $this->getAllToolsInfo();
    }

    public function createTool($name)
    {
        return $this->createToolInfo($name);
    }

    public function showTool($id)
    {
        return $this->showToolInfo($id);
    }

    public function updateTool($id, $name)
    {
        return $this->updateToolInfo($id, $name);
    }

    public function deleteTool($id)
    {
        return $this->deleteToolInfo($id);
    }

    public function toollist()
    {
        return $this->toollistInfo();
    }

    public function gettAllToolByCat($id)
    {
        return $this->gettAllToolByCatInfo($id);
    }

    public function latestPost(){
        return $this->latestPostInfo();
    }
}
?>
