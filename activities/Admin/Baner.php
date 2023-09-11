<?php

namespace activities\baner;

require_once(DIR . "/activities/Admin/Admin.php");

use activities\Admin\Admin;
use Database\database\Database as db;

class Baner extends Admin
{
    public function index()
    {
        $db = new db();
        $baners = $db->Select("SELECT * FROM baners");
        require_once(DIR . "/template/admin/baner/index.php");
    }
    public function create()
    {
        require_once(DIR . "/template/admin/baner/create.php");
    }
    public function store($request)
    {
        $db = new db();
        $request["img"] =  $this->saveImg($_FILES["img"], "baner-img");
        $db->Insert("baners", array_keys($request), array_values($request));
        $this->redirect("admin/baner");
    }
    public function edit($parameters)
    {
        $db = new db();
        $showBaner = $db->Select("SELECT * FROM baners WHERE id = ?", $parameters);
        require_once(DIR . "/template/admin/baner/edit.php");
    }
    public function distory($parameters)
    {
        $db = new db();
        $imageBaner = $db->Select("SELECT `img` FROM baners WHERE id = ?", $parameters);
        if (file_exists(DIR . $imageBaner->img)) {
            unlink(DIR . $imageBaner->img);
        }
        $db->Delete("baners", $parameters);
        $this->redirect("admin/baner");
    }
    public function update($request, $parameters)
    {
        $db = new db();
        if (isset($request["img"]) && !empty($request["img"]["name"])) {
            $imageBaner = $db->Select("SELECT `img` FROM baners WHERE id = ?", $parameters);
            if (file_exists(DIR . $imageBaner->img)) {
                unlink(DIR . $imageBaner->img);
            }
            $request["img"] =  $this->saveImg($_FILES["img"], "baner-img");
        } else {
            unset($request["img"]);
        }
        $db->Update("baners", array_keys($request), array_values($request), $parameters);
        $this->redirect("admin/baner");
    }
}
