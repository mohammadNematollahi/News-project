<?php

`session start`;

session_start();

`define`;

define("CURRENT_DOMAIN", currentDomain() . "news-project");
define("DIR", __DIR__);
define("DISPLAY_ERRORS", true);
define("DB_NAME", "news_project_db");
define("USERNAME", "root");
define("PASSWORD_DB", "Ms*?/.D@proG*83./");
define("HOSTNAEM", "127.0.0.1");

`mail`;

define("MAIL_HOST", "smtp.gmail.com");
define("STMP_AUTH", true);
define("MAIL_USERNAME", "sendmessagephp@gmail.com");
define("MAIL_PASSWORD", "uikjvrqtrixjcemi");
define("MAIL_PORT", 587);
define("SENDER_MAIL", "sendmessagephp@gmail.com");
define("SENDER_NAME", "دوره ی جامع php");

`namespace`;

require_once('database/Database.php');
require_once('database/Createdb.php');
require_once('activities/Admin/Category.php');
require_once('activities/Admin/Admin.php');
require_once("activities/Admin/Post.php");
require_once("activities/Admin/Baner.php");
require_once("activities/Admin/User.php");
require_once("activities/Admin/Comment.php");
require_once("activities/Admin/Menu.php");
require_once("activities/Admin/Websetting.php");
require_once("activities/Admin/Dashboard.php");
require_once("activities/App/Home.php");

use activities\auth\Auth as auth;

use Database\createdb\Createdb as cdb;
use Database\database\Database as db;

//// $cdb = new cdb();
//// $cdb->run();

require_once("activities/Auth/Auth.php");


`jalili date`;

spl_autoload_register(function ($class) {
    $path = DIR . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR;
    require_once($path . $class . ".php");
});

function jaliliDate($date)
{
    return \Parsidev\Jalali\jDate::forge($date)->format("datetime");
}

`routing`;
function uri($reservUrl, $class, $method, $requestMethod = "GET")
{
    `user url`;

    $currentUserUrl = explode("?", currentUrl())[0];
    $cleanUserUrl = str_replace(CURRENT_DOMAIN, "", $currentUserUrl);
    $trimUseUrl = trim($cleanUserUrl, " / ");
    $currentUserUrlArray = explode("/", $trimUseUrl);

    `reserv url`;

    $reservUrl = trim($reservUrl, " / ");
    $currentReservUrlArray = explode("/", $reservUrl);

    if (sizeof($currentUserUrlArray) != sizeof($currentReservUrlArray) || methodFile() != $requestMethod) {
        return false;
    }

    $parameters = array();
    if ($currentUserUrlArray[0] != '') {
        for ($key = 0; $key < count($currentUserUrlArray); $key++) {
            if (isset($currentReservUrlArray[$key][0]) == "{" && $currentReservUrlArray[$key][strlen($currentReservUrlArray[$key]) - 1] == "}") {
                array_push($parameters, $currentUserUrlArray[$key]);
            } else if ($currentUserUrlArray[$key] !== $currentReservUrlArray[$key]) {
                return false;
            }
        }
    }

    if (methodFile() == "POST") {
        $request = isset($_FILES) ? array_merge($_FILES, $_POST) : $_POST;
        if ($request == isset($_FILES)) {
            $parameters = array_merge([$request], $parameters);
        } else {
            $parameters = array_merge($parameters);
        }
    }

    $obj = new $class;
    call_user_func_array(array_merge([$obj, $method]), $parameters);
    exit;
}

`helpers`;
function protocol()
{
    $protocol = $_SERVER["REQUEST_SCHEME"] == "http" ? "http://" : "https://";
    return $protocol;
}

function currentDomain()
{
    $currentDomain = protocol() . trim($_SERVER["SERVER_NAME"], " / ") . "/";
    return $currentDomain;
}

function currentUrl()
{
    $currentUrl = currentDomain() . trim($_SERVER["REQUEST_URI"], " / ");
    return $currentUrl;
}

function displayErrors($display)
{
    if ($display) {
        ini_set("display_errors", 1);
        ini_set("display_startup_errors", 1);
        error_reporting(E_ALL);
    } else {
        ini_set("display_errors", 0);
        ini_set("display_errors", 0);
        error_reporting(0);
    }
}

function flash($name, $message = null)
{
    global $err;
    if ($message == null) {
        if (!empty($_SESSION["message_flash"][$name])) {
            $err[$name] = $_SESSION["message_flash"][$name];
            unset($_SESSION["message_flash"][$name]);
        } else {
            return false;
        }
    } else {
        $err[$name] = $_SESSION["message_flash"][$name] = $message;
    }
    return $err[$name];
}

function asset($src)
{
    $src = trim(CURRENT_DOMAIN, " / ") . "/" . trim($src, " / ");
    return $src;
}

function url($url)
{
    $url = trim(CURRENT_DOMAIN, " / ") . "/" . trim($url, " / ");
    return $url;
}

function dd($values)
{
    echo "<pre>";
    var_dump($values);
    exit;
}

function methodFile()
{
    $methodFile = $_SERVER["REQUEST_METHOD"];
    return $methodFile;
}

`reservs`;


// category
uri("admin/category", "activities\category\Category", "index");
uri("admin/category/create", "activities\category\Category", "create");
uri("admin/category/store", "activities\category\Category", "store", "POST");
uri("admin/category/distory/{id}", "activities\category\Category", "distory");
uri("admin/category/edit/{id}", "activities\category\Category", "edit");
uri("admin/category/update/{id}", "activities\category\Category", "update", "POST");
// post
uri("admin/post/", "activities\post\Post", "index");
uri("admin/post/create", "activities\post\Post", "create");
uri("admin/post/store", "activities\post\Post", "store", "POST");
uri("admin/post/distory/{id}", "activities\post\Post", "distory");
uri("admin/post/edit/{id}", "activities\post\Post", "edit");
uri("admin/post/update/{id}", "activities\post\Post", "update", "POST");
uri("admin/post/breaking-news/{id}", "activities\post\Post", "breakingNews");
uri("admin/post/selected/{id}", "activities\post\Post", "selected");
//baner
uri("admin/baner/", "activities\baner\Baner", "index");
uri("admin/baner/create", "activities\baner\Baner", "create");
uri("admin/baner/store", "activities\baner\Baner", "store", "POST");
uri("admin/baner/distory/{id}", "activities\baner\Baner", "distory");
uri("admin/baner/edit/{id}", "activities\baner\Baner", "edit");
uri("admin/baner/update/{id}", "activities\baner\Baner", "update", "POST");
//user
uri("admin/user/", "activities\user\User", "index");
uri("admin/user/edit/{id}", "activities\user\User", "edit");
uri("admin/user/update/{id}", "activities\user\User", "update", "POST");
uri("admin/user/distory/{id}", "activities\user\User", "distory");
uri("admin/user/change-user/{id}", "activities\user\User", "changeUser");
//comment
uri("admin/comment/", "activities\comment\Comment", "index");
uri("admin/comment/change-status/{id}", "activities\comment\Comment", "changeStatus");
//menu
uri("admin/menu/", "activities\menu\Menu", "index");
uri("admin/menu/create", "activities\menu\Menu", "create");
uri("admin/menu/store", "activities\menu\Menu", "store", "POST");
uri("admin/menu/distory/{id}", "activities\menu\Menu", "distory");
uri("admin/menu/edit/{id}", "activities\menu\Menu", "edit");
//websetting
uri("admin/setting", "activities\websetting\Websetting", "index");
uri("admin/setting/show-websetting", "activities\websetting\Websetting", "show");
uri("admin/setting/set-websetting", "activities\websetting\Websetting", "set", "POST");
//register
uri("auth/register", "activities\auth\Auth", "register");
uri("auth/register/store", "activities\auth\Auth", "registerStore", "POST");
uri("activation/{token}", "activities\auth\Auth", "acceptToken");
//login
uri("auth/login", "activities\auth\Auth", "login");
uri("auth/check-login", "activities\auth\Auth", "loginStore", "POST");
uri("auth/logout", "activities\auth\Auth", "logOut");
//forgot
uri("auth/forgot", "activities\auth\Auth", "forgot");
uri("auth/forgot-store", "activities\auth\Auth", "forgotStore", "POST");
uri("restore-account/{token}", "activities\auth\Auth", "restoreAccount");
uri("auth/reset-account/{id}", "activities\auth\Auth", "resetAccount");
uri("auth/password-sotre/{id}", "activities\auth\Auth", "passwordStore", "POST");
//home
uri("", "activities\app\Home", "index");
uri("home", "activities\app\Home", "index");
uri("send-comment/{id}", "activities\app\Home", "commentSotre" , "POST");
uri("internal-page/{id}", "activities\app\Home", "internalPage");
//admin
uri("admin/show", "activities\dashboard\Dashboard", "index");
//not find 
echo "404";
