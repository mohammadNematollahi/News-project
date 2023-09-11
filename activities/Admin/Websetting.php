<?php

namespace activities\websetting;

use activities\Admin\Admin;
use Database\database\Database as db;

class Websetting extends Admin
{
    public function index()
    {
        $db = new db();
        $setSetting = $db->Select("SELECT * FROM websetting");
        require_once(DIR . "/template/admin/setting/index.php");
    }
    public function show()
    {
        $db = new db();
        $result =  $db->Select("SELECT * FROM websetting");
        require_once(DIR . "/template/admin/setting/edit.php");
    }
    public function set($request)
    {
        $db = new db();
        $result =  $db->Select("SELECT * FROM websetting");
        if (empty($result)) {
            $request["icon"] =  $this->saveImg($request["icon"], "icon");
            $request["logo"] = $this->saveImg($request["logo"], "logo");
           $db->Insert("websetting", array_keys($request), array_values($request));
        } else {
            if ($request["logo"]["tmp_name"] != null && $request["icon"]["tmp_name"] != null) {
                $this->removeImg($result[0]->logo);
                $this->removeImg($result[0]->icon);
                $request["icon"] =  $this->saveImg($request["icon"], "icon");
                $request["logo"] = $this->saveImg($request["logo"], "logo");
            } else {
                unset($request["logo"]);
                unset($request["icon"]);
            }
            $db->Update("websetting", array_keys($request), array_values($request), intval($result[0]->id));
        }
        $this->redirect("admin/setting");
    }
}
