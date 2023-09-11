<?php

namespace activities\comment;

use activities\Admin\Admin;
use Database\database\Database as db;

class Comment extends Admin
{
    public function index()
    {
        $db = new db();
        $commentsUnseen = $db->Select("SELECT id,`status` FROM comments WHERE `status` = 'unseen'");
        foreach ($commentsUnseen as $CommentSeen) {
            $db->Update("comments", ["status"], ["seen"], $CommentSeen->id);
        }
        $comments = $db->Select("SELECT posts.title , users.first_name , users.last_name , comments.* FROM comments LEFT JOIN users ON users.id = comments.user_id LEFT JOIN posts ON posts.id = comments.post_id");
        require_once(DIR . "/template/admin/comment/index.php");
    }
    public function changeStatus($parameters)
    {
        $db = new db();
        $typeStatus = $db->Select("SELECT `status` FROM comments WHERE id = ?", $parameters);
        $result = $typeStatus->status == "seen" ? "approved" : "seen";
        $db->Update("comments", ["status"], [$result], $parameters);
        $this->redirect("admin/comment");
    }
}
