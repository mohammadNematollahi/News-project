<?php

namespace activities\app;

use Database\database\Database as db;

class Home
{
    public function redirectBack()
    {
        return  header("Location: " . trim($_SERVER["HTTP_REFERER"], " / "));
    }
    public function index()
    {
        $db = new db();
        $menus = $db->Select("SELECT * FROM menus");
        $baners = $db->Select("SELECT img FROM baners");
        $newsSelected = $db->Select("SELECT posts.* , ( SELECT count(id) FROM comments WHERE comments.post_id = posts.id) AS countComments , (SELECT categories.name FROM categories WHERE posts.id_cat = categories.id) AS nameCat FROM posts WHERE posts.selected = 2 ORDER BY posts.created_at desc limit 3; ");
        $lastNews = $db->Select("SELECT posts.* , ( SELECT count(id) FROM comments WHERE comments.post_id = posts.id) AS countComments , (SELECT categories.name FROM categories WHERE posts.id_cat = categories.id) AS nameCat FROM posts ORDER BY posts.created_at desc limit 4;");
        $mostViewPost = $db->Select("SELECT posts.* , max(posts.view),( SELECT count(id) FROM comments WHERE comments.post_id = posts.id) AS countComments , (SELECT categories.name FROM categories WHERE posts.id_cat = categories.id) AS nameCat FROM posts  group by id ORDER BY posts.view desc limit 3; ");
        $mostComments = $db->Select("SELECT posts.* ,( SELECT count(comments.id) FROM comments WHERE comments.post_id = posts.id) AS mostComment FROM posts  ORDER BY mostComment desc limit 4;");
        $brekingNews = $db->Select("SELECT * FROM posts WHERE breaking_news = 2 ORDER BY created_at desc LIMIT 1");
        require_once(DIR . "/template/app/index.php");
    }
    public function internalPage($parameters)
    {
        $db = new db();
        $menus = $db->Select("SELECT * FROM menus");
        $baners = $db->Select("SELECT img FROM baners");
        $newsSelected = $db->Select("SELECT posts.* , ( SELECT count(id) FROM comments WHERE comments.post_id = posts.id) AS countComments , (SELECT categories.name FROM categories WHERE posts.id_cat = categories.id) AS nameCat FROM posts WHERE posts.selected = 2 ORDER BY posts.created_at desc limit 1; ");
        $mostComments = $db->Select("SELECT posts.* ,( SELECT count(comments.id) FROM comments WHERE comments.post_id = posts.id) AS mostComment FROM posts  ORDER BY mostComment desc limit 4;");
        $fullInfoPost = $db->Select("SELECT posts.* , ( SELECT count(id) FROM comments WHERE comments.post_id = posts.id) AS countComments , (SELECT categories.name FROM categories WHERE posts.id_cat = categories.id) AS nameCat FROM posts WHERE posts.id = ?", $parameters);
        $showComments = $db->SelectAll("SELECT comments.* , users.first_name , users.last_name FROM comments LEFT JOIN users ON comments.user_id = users.id WHERE `status` = 'approved' AND comments.post_id = ?;", $parameters);
        require_once(DIR . "/template/app/internal-page.php");
    }
    public function commentSotre($request, $parameters)
    {
        $db = new db();
        $request["user_id"] = 12;
        $request["post_id"] = $parameters;
        $db->Insert("comments", array_keys($request), array_values($request));
        $this->redirectBack();
    }
}
