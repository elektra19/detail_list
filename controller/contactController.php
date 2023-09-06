<?php
include_once __DIR__ . '/../model/contact.php';

class contactController extends contact{
    public function getContact(){
        return $this->getContactInfo();
    }
}