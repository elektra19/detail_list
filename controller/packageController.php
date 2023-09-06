<?php
include_once __DIR__ . '/../model/package.php';

class PackageController extends Package
{
    public function getPackage()
    {
        return $this->getPackageInfo();
    }
    public function addPackage($name, $amount, $filename, $detail,$buy_link)
    {
        return $this->createPackage($name, $amount, $filename, $detail,$buy_link);
    }
    public function getPackageById($id)
    {
        return $this->getPackageInfoById($id);
    }
    public function updatePackage($id, $name, $amount, $filename, $detail, $buy_name)
    {
        return $this->editPackage($id, $name, $amount, $filename, $detail, $buy_name);
    }
    public function deletePackage($id)
    {
        return $this->deletePackageInfo($id);
    }
}
