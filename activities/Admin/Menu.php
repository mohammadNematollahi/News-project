<?php

namespace activities\menu;

use activities\Admin\Admin;
use Database\database\Database as db;

class Menu extends Admin
{
    public function index()
    {
        $db = new db();
        $menus = $db->Select("SELECT menus.* , m.name AS mainMenu FROM menus LEFT JOIN menus m ON m.id = menus.parent_id");
        require_once(DIR . "/template/admin/menu/index.php");
    }
    public function create()
    {
        $db = new db();
        $subMenus = $db->Select("SELECT * FROM menus  WHERE parent_id  IS NULL");
        require_once(DIR . "/template/admin/menu/create.php");
    }
    public function store($request)
    {
        $db = new db();
        if ($request["parent_id"] == "") {
            $request["parent_id"] = null;
        } else {
            intval($request["parent_id"]);
        }
        $db->Insert("menus", array_keys($request), array_values($request));
        $this->redirect("admin/menu");
    }
    public function distory($parameters)
    {
        $db = new db();
        $db->Delete("menus", $parameters);
        $this->redirect("admin/menu");
    }
    public function edit($parameters)
    {
        $db = new db();
        $menu =  $db->Select("SELECT * FROM menus WHERE id = ?", $parameters);
        $subMenus = $db->Select("SELECT * FROM menus  WHERE parent_id  IS NULL");
        require_once(DIR . "/template/admin/menu/edit.php");
    }
}
