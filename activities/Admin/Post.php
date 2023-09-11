<?php

namespace activities\post;

use activities\Admin\Admin;
use Database\database\Database as db;

require_once('Admin.php');

class Post extends Admin
{
    public function index()
    {
        $db = new db();
        $posts = $db->Select("SELECT posts.* , users.first_name , categories.name , users.last_name FROM posts LEFT JOIN users ON users.id = posts.id_user LEFT JOIN categories ON categories.id = posts.id_cat");
        require_once(DIR . "/template/admin/post/index.php");
    }
    public function create()
    {
        $db = new db();
        $categories = $db->Select("SELECT `name`,id FROM categories");
        require_once(DIR . '/template/admin/post/create.php');
    }
    public function store($request)
    {
        $convertToSeconde = substr($request["published_at"], 0, 10);
        $request["published_at"] = date("Y-m-d H:i:s", intval($convertToSeconde));
        $db  = new db();
        $select = $db->Select("SELECT id FROM categories WHERE id = ?", $request["id_cat"]);
        if ($select) {
            $request["image"] =  $this->saveImg($_FILES["image"], "post-img");
            $request["id_user"] = 12;
            $db->Insert("posts", array_keys($request), array_values($request));
            $this->redirect("admin/post");
        } else {
            $request;
        }
    }
    public function distory($parameters)
    {
        $db = new db();
        $db->Delete("posts", $parameters);
        $this->redirect("admin/posts");
    }
    public function edit($parameters)
    {
        $db = new db();
        $showPost = $db->Select("SELECT posts.* , categories.name AS cat_name FROM posts LEFT JOIN categories ON posts.id_cat = categories.id  WHERE posts.id = ?", $parameters);
        $selectCategories = $db->Select("SELECT * FROM categories");
        require_once(DIR . "/template/admin/post/edit.php");
    }
    public function update($request, $parameters)
    {
        $convertToSeconde = substr($request["published_at"], 0, 10);
        $request["published_at"] = date("Y-m-d H:i:s", intval($convertToSeconde));
        $db = new db();
        if (isset($request["image"]) && !empty($request["image"]["name"])) {
            $imagePost = $db->Select("SELECT `image` FROM posts WHERE id = ?", $parameters);
            $this->removeImg($imagePost->image);
            $request["image"] =  $this->saveImg($_FILES["image"], "post-img");
        } else {
            unset($request["image"]);
        }
        $request["id_user"] = 12;
        $db->Update("posts", array_keys($request), array_values($request), $parameters);
        $this->redirect("admin/post");
    }
    public function breakingNews($parameters)
    {
        $db = new db();
        $breaking = $db->Select("SELECT `breaking_news` FROM posts WHERE id = ?", $parameters);
        $send = $breaking->breaking_news == 2 ? 1 || 0 : 2;
        $db->Update("posts", ["breaking_news"], [$send], $parameters);
        $this->redirect("admin/post");
    }
    public function selected($parameters)
    {
        $db = new db();
        $selected = $db->Select("SELECT `selected` FROM posts WHERE id = ?", $parameters);
        $send = $selected->selected ==  2 ? 1 || 0 : 2;
        $db->Update("posts", ["selected"], [$send], $parameters);
        $this->redirect("admin/post");
    }
}
