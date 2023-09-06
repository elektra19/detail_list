<?php
include_once __DIR__ . '/../model/firmware.php';

class firmwaresController extends firmware
{
        public function getAllFirmware()
        {
                return $this->getAllFirmwareInfo();
        }

        public function createFirmware($name, $miui, $android, $size, $type, $down_link,$down_link_1,$details, $model_id)
        {
                return $this->createFirmwareInfo($name, $miui, $android, $size, $type, $down_link,$down_link_1,$details, $model_id);
        }

        public function showFirm($id)
        {
                return $this->showFirmInfo($id);
        }

        public function updateFirm($id, $name, $miui, $android, $size, $type, $down_link,$down_link_1,$details, $model_id)
        {
                return $this->updateFirmInfo($id, $name, $miui, $android, $size, $type, $down_link,$down_link_1,$details, $model_id);
        }

        public function deletefirm($id)
        {
                return $this->deletefirmInfo($id);
        }

        public function fimByModels($id){
                return $this->fimByModelsInfo($id);
        }

        public function imgFirm($id){
                return $this->imgFirmInfo($id);
                
        }
}
