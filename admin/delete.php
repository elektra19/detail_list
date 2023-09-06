<?php
include_once __DIR__ . '/../controller/brandsController.php';
include_once __DIR__ . '/../controller/modelsController.php';
include_once __DIR__ . '/../controller/firmwaresController.php';
include_once __DIR__ . '/../controller/toolsController.php';
include_once __DIR__ . '/../controller/toolDownController.php';
include_once __DIR__ . '/../controller/boxController.php';
include_once __DIR__ . '/../controller/boxDownController.php';
include_once __DIR__ . '/../controller/PackageController.php';
include_once __DIR__ . '/../controller/tutorialsController.php';

// var_dump($id);
$id = $_POST['id'];
$brandController = new brandsController();
$delete = $brandController->deleteBrand($id);

$models_controller = new modelsController();
$delete = $models_controller->deleteModel($id);

$firmware_controller = new firmwaresController();
$delete = $firmware_controller->deletefirm($id);

$tool_controller = new toolsController();
$delete = $tool_controller->deleteTool($id);

$tool_down_controller = new toolDownController();
$delete = $tool_down_controller->deleteTool($id);

$box_controller = new boxController();
$delete = $box_controller->deleteBox($id);

$box_down_controller = new boxDownController();
$delete = $box_down_controller->deleteBox($id);

$package_controller = new PackageController();
$deleete = $package_controller->deletePackage($id);

$tuto_controller = new tutorialsController();
$delete = $tuto_controller->deletetuto($id);