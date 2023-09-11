<?php

namespace activities\auth;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Database\database\Database as db;
use Exception;

class Auth
{
    public function redirect($url)
    {
        return header("Location: " . trim(CURRENT_DOMAIN, " / ") . "/" . trim($url, " / "));
    }
    public function redirectBack()
    {
        return  header("Location: " . trim($_SERVER["HTTP_REFERER"], " / "));
    }

    private function hash($passwd)
    {
        return password_hash($passwd, PASSWORD_DEFAULT);
    }
    public function sendMail($email, $Subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->CharSet = "UTF-8";                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = MAIL_HOST;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = STMP_AUTH;                                   //Enable SMTP authentication
            $mail->Username   = MAIL_USERNAME;                     //SMTP username
            $mail->Password   = MAIL_PASSWORD;                               //SMTP password
            $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
            $mail->Port       = MAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(SENDER_MAIL, SENDER_NAME);
            $mail->addAddress($email);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $Subject;
            $mail->Body    = $body;
            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }
    private function random()
    {
        return bin2hex(openssl_random_pseudo_bytes(32));
    }
    private function activationMessate($username, $token)
    {
        return '
        <h1>فعال سازی حسال کاربری شما</h1>
        <p>' . $username . 'کاربر محترم برای فعال سازی حساب کاربری شما بر رو لینک زیر کلیک کنید</p>
        <div><a href="' . url('activation') . "/" . $token . '">کلیک کنید</a></div>
        ';
    }
    public function register()
    {
        require_once(DIR . "/template/auth/register.php");
    }
    public function registerStore($request)
    {
        if (empty($request["last_name"]) or empty($request["first_name"]) or empty($request["email"]) or empty($request["password"])) {
            flash("register_error", "لطفا تمامیه فیلد ها را پر کنید");
            $this->redirectBack();
        } else if (strlen($request["password"]) <= 8) {
            flash("register_error", "دوست عریز برای ایجاد امنیت بالا رمز ورود را بالا تر از هشت رقم وارد کنید");
            $this->redirectBack();
        } else if (!filter_var($request["email"], FILTER_VALIDATE_EMAIL)) {
            flash("register_error", "کاربر گرامی ایمیل وارد شده معتبر نمیباشد");
            $this->redirectBack();
        } else {
            $db = new db();
            $existEmails = $db->Select("SELECT * FROM users WHERE email = ?", $request["email"]);
            if ($existEmails) {
                flash("register_error", " دوست من ایمیل وارد شده قبلا در سیستم وارد شده است لطفا یک ایمیل دیگر را امتحان کنید");
                $this->redirectBack();
            } else {
                $randomToken = $this->random();
                $activationMessate = $this->activationMessate($request["first_name"], $randomToken);
                $sendEmail =  $this->sendMail($request["email"], "فعال سازی حساب کاربری ", $activationMessate);
                if ($sendEmail) {
                    $request["varify_token"] = $randomToken;
                    $request["password"] = $this->hash($request["password"]);
                    $db->Insert("users", array_keys($request), array_values($request));
                    $this->redirect("auth/login");
                }
            }
        }
    }
    public function acceptToken($varifayToken)
    {
        $db = new db();
        $result = $db->Select("SELECT * FROM users WHERE varify_token = ? AND is_active = 0 ;", $varifayToken);
        if (empty($result)) {
            $this->redirect("auth/register/store");
        } else {
            $db->Update("users", ["is_active"], [1], $result->id);
        }
    }
    private function checkPasswd($passwd, $hashPasswd)
    {
        return password_verify($passwd, $hashPasswd);
    }
    public function login()
    {
        require_once(DIR . "/template/auth/login.php");
    }
    public function loginStore($request)
    {
        $db = new db();
        if (empty($request["email"]) and empty($request["password"])) {
            flash("check_login", 'لطفا مقدار های ورودی را پر کنید');
            $this->redirectBack();
        } else {
            $exist = $db->Select("SELECT * FROM users WHERE email = ? AND is_active = 1", $request["email"]);
            if (!empty($exist)) {
                $truePasswd = $this->checkPasswd($request["password"], $exist->password);
                if ($truePasswd) {
                    $_SESSION["login"] = $exist->id;
                    $this->redirect("admin/user");
                } else {
                    flash("check_login", "کاربر گرامی ایمیل و یا رمز ورود شما صحیح نمیباشد");
                    $this->redirectBack();
                }
            } else {
                flash("check_login", "کاربر گرامی ایمیل و یا رمز ورود شما صحیح نمیباشد");
                $this->redirectBack();
            }
        }
    }

    public function isActive()
    {
        $user = $_SESSION["login"];
        if (isset($user)) {
            $db = new db();
            $userExist = $db->Select("SELECT * FROM users WHERE id = ? AND is_active = 1", $user);
            if ($userExist->permission != "admin") {
                $this->redirect("home");
            }
        } else {
            $this->redirect("home");
        }
    }

    public function logOut()
    {
        $logOutUser = $_SESSION["login"];
        if (isset($logOutUser)) {
            unset($_SESSION["login"]);
            session_destroy();
        }
        $this->redirect("home");
    }

    private function forgotMessage($token)
    {
        return '
        <h1>باز یابی رمز عبور</h1>
        <p>کاربر محترم برای بازیابی رمز عبور بر روی لینک زیر کلیک کیندی</p>
        <div><a href="' . url('restore-account') . "/" . $token . '">کلیک کنید</a></div>
        ';
    }
    public function forgot()
    {
        require_once(DIR . "/template/auth//forgot.php");
    }
    public function forgotStore($request)
    {
        if (!filter_var($request["email"], FILTER_VALIDATE_EMAIL)) {
            flash("forgot_error", "کاربر گرامی ایمیل وارد شده معتبر نیست");
            $this->redirectBack();
        } else {
            $db = new db();
            $emailExist =  $db->Select("SELECT * FROM users WHERE email = ? AND is_active = 1;", $request["email"]);
            if (empty($emailExist->email)) {
                flash("forgot_error", "دوست عزیز ایمیل وارد شده در سیستم وجود ندارد");
                $this->redirectBack();
            } else {
                $forgotToken = $this->random();
                $activationForgotToken = $this->forgotMessage($forgotToken);
                $sendEmail =  $this->sendMail($request["email"], "بازیابی رمز عبور", $activationForgotToken);
                if ($sendEmail) {
                    $db = new db();
                    date_default_timezone_set('Asia/Tehran');
                    $db->Update("users", ["forget_token", "forget_token_expire"], [$forgotToken, date('Y-m-d H:i:s', strtotime('+10 minute'))], $emailExist->id);
                    $this->redirect("auth/login");
                } else {
                    flash("forgot_error", "ارسال ایمیل انجام نشد لطفا ایمیل خود را بررسی کنید یا یک ایمیل دیگر امتحان کنید");
                    $this->redirectBack();
                }
            }
        }
    }

    public function restoreAccount($forgotToken)
    {
        $db = new db();
        $tokenExest =  $db->Select("SELECT * FROM users WHERE forget_token = ? AND is_active = 1", $forgotToken);
        if (empty($tokenExest)) {
            $this->redirect("auth/hom");
        } else {
            if ($tokenExest->forget_token == $forgotToken) {
                dd($this->redirect("auth/reset-account" . "/" . $tokenExest->id));
            }
        }
    }
    public function resetAccount($userId)
    {
        require_once(DIR . "/template/auth/reset-password.php");
    }
    public function passwordStore($request, $parameters)
    {
        $db = new db();
        $user = $db->Select("SELECT * FROM users WHERE id = ?", $parameters);
        if (empty($request["password"])) {
            flash("reset_passwrod_error", "لطفا پسورد مورد نظر خود را وارد کنید");
            $this->redirectBack();
        } else if (!strlen($request["password"]) >= 8) {
            flash("reset_passwrod_error", "دوست عزیز رمز عبور باید بیشتر از هشت حروف یا رقم باشد");
            $this->redirectBack();
        } else if ($user->forget_token_expire >= date("Y-m-d H-i-s")) {
            flash("reset_passwrod_error", "کاربر گرامی زمان تعییر رمز عبور شما به پایان رسیده لطفا دوباره اقدام برای ارسال ایمیل بکیند");
            $this->redirect("auth/for");
        } else {
            $checkPassword = $this->checkPasswd($request["passwrod"], $user->password);
            if ($checkPassword) {
                flash("reset_passwrod_error", "رمز ورود شما با رمز قبلی یکی میباشد");
                $this->redirectBack();
            } else {
                $db->Update("users", ["passwrod"], [$request["password"]], $parameters);
            }
        }
    }
}
