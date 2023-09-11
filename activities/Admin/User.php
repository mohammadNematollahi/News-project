<?php

namespace activities\user;

require_once(DIR . "/activities/Admin/Admin.php");

use activities\Admin\Admin;
use Database\database\Database as db;

class User extends Admin
{
    public function index()
    {
        $db = new db();
        $users = $db->Select("SELECT * FROM users");
        require_once(DIR . "/template/admin/user/index.php");
    }
    public function changeUser($parameters)
    {
        $db = new db();
        $permission = $db->Select("SELECT permission FROM users WHERE id = ?", $parameters);
        $status = $permission->permission == "admin" ? "user" : "admin";
        $db->Update("users", ["permission"], [$status], $parameters);
        $this->redirect("admin/user");
    }
    public function edit($parameters)
    {
        $db = new db();
        $infoUser = $db->Select("SELECT * FROM users WHERE id = ?", $parameters);
        require_once(DIR . "/template/admin/user/edit.php");
    }
    public function distory($parameters)
    {
        $db = new db();
        $db->Delete("users", $parameters);
        $this->redirect("admin/user");
    }
    public function update($request, $parameters)
    {
        $add = array(
            'first_name' => $request["first_name"],
            'last_name' => $request["last_name"],
            'permission' => $request["permission"]
        );
        $equal = array_diff_assoc($request, $add);
        if (empty($equal)) {
            $db = new db();
            $db->Update("users", array_keys($request), array_values($request), $parameters);
        }
        $this->redirect("admin/user");
        require_once(DIR . "/template/admin/user/edit.php");
    }
}
