<?php
include_once __DIR__ . '/../model/firminfo.php';

class firmsController extends firminfo
{
    public function firms($id)
    {
        return $this->firmsInfo($id);
    }

    public function firmsmodel($id)
    {
        return $this->firmsmodelInfo($id);
    }
}
