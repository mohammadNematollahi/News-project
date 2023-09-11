<?php

namespace activities\Admin;
use activities\auth\Auth;

class Admin
{
    private $curren_domain = CURRENT_DOMAIN;
    private $base_url_project = DIR;
    // public function __construct(){
    //     $auth = new Auth;
    //     $auth->isActive();
    // }
    protected function redirect($url)
    {
        return header("Location: " . trim($this->curren_domain, " / ") . "/" . trim($url, " / "));
    }
    protected function saveImg($file, $pathName)
    {
        $accessPath = array("png", "jpg", "peng", "svg");
        $pathInfo = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (in_array($pathInfo, $accessPath)) {
            $imgPath =  "/asset/" . $pathName . "/" . date("Y-m-d-H-i-s") . '.' . $pathInfo;
            $moveImg =  move_uploaded_file($file["tmp_name"], $this->base_url_project . $imgPath);
            if ($moveImg) {
                return $imgPath;
            } else {
                return false;
            }
        }
    }
    protected function removeImg($imgUrl)
    {
        if (file_exists($this->base_url_project . $imgUrl)) {
            unlink($this->base_url_project . $imgUrl);
        }
    }
}
