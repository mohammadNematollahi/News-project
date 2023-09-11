<?php

namespace activities\category;

require_once('Admin.php');

use activities\Admin\Admin as adfunc;
use Database\database\Database as db;

class Category extends adfunc
{
    public function index()
    {
        $db = new db();
        $categories = $db->Select("SELECT * FROM categories");
        require_once(DIR . "/template/admin/category/index.php");
    }
    public function create()
    {
        require_once(DIR . "/template/admin/category/create.php");
    }
    public function store($request)
    {
        $insert = new db();
        $insert->Insert("categories", array_keys($request), array_values($request));
        $this->redirect("/admin/category");
    }
    public function distory($parameters)
    {
        $delete = new db();
        $delete->Delete("categories", $parameters);
        $this->redirect("/admin/category");
    }
    public function edit($parameters)
    {
        $show = new db();
        $result = $show->Select("SELECT * FROM categories WHERE id = ?", $parameters);
        require_once(DIR . "/template/admin/category/edit.php");
    }
    public function update($request, $parameters)
    {
        $update = new db();
        $update->Update("categories", array_keys($request), array_values($request), $parameters);
        $this->redirect("/admin/category");
    }
}
