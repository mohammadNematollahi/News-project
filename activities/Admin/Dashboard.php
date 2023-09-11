<?php

namespace activities\dashboard;

use activities\Admin\Admin;
use Database\database\Database as db;

class Dashboard extends Admin
{
    public function index()
    {
        $db = new db();
        $countCategories = $db->Select("SELECT COUNT(id) AS existCat FROM categories");
        $countUsers = $db->Select("SELECT COUNT(id) AS existUser FROM users");
        $countNormalusers = $db->Select("SELECT COUNT(id) AS normalUser FROM users WHERE permission = 'user' ");
        $countAdminusers = $db->Select("SELECT COUNT(id) AS adminUser FROM users WHERE permission = 'admin' ");
        $countPosts = $db->Select("SELECT COUNT(id) AS post FROM posts");
        $sumViewPosts = $db->Select("SELECT SUM(view) AS view FROM posts");
        $countComments = $db->Select("SELECT COUNT(id) AS existComment FROM comments");
        $commentsApproved = $db->Select("SELECT COUNT(id) AS existApproved FROM comments WHERE `status` = 'approved' ");
        $commentsUnseen = $db->Select("SELECT COUNT(id) AS exsitUnseen FROM comments WHERE `status` = 'unseen' ");
        $mostViewPosts = $db->Select("SELECT * , MAX(`view`) FROM news_project_db.posts GROUP BY id ORDER BY view desc LIMIT 5;");
        $mostCommentoPosts = $db->Select("SELECT COUNT(comments.post_id) as countP , MAX(comments.post_id) AS maxP , posts.title FROM comments INNER JOIN posts ON comments.post_id = posts.id GROUP BY comments.post_id ORDER BY countP desc LIMIT 5;");

        require_once(DIR . "/template/admin/dashboard/index.php");
    }
}
