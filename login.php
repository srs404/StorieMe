<?php

require_once "App/View/header.php";
require_once "App/Model/login.php";

// session_destroy();
if (isset($_SESSION['USERID'])) {
    redirect('index.php');
} else {
    if (isset($_POST['submitbtn'])) {
        $login = new Login();
        if ($_POST['submitbtn'] == "Login") {
            if ($login->verify($_POST['login_username'], $_POST['login_passwd'])) {
                redirect($_SERVER['PHP_SELF']);
            } else {
                echo "alert('Username or Password Incorrect!')";
            }
            $login = null;
        } elseif ($_POST['submitbtn'] == "Register") {
            if ($_POST['reg_passwd'] == $_POST['reg_confirm_passwd']) {
                $login->register($_POST['reg_username'], $_POST['reg_passwd']);
            } else {
                echo "alert('Password Doesn't Match!')";
            }
            $login = null;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Project</title>
    <link rel="stylesheet" href="Assets/Styles/login.css">
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table class="login" id="loginPanel">
            <tr>
                <th colspan="2">
                    <h1 style="text-decoration-line: underline;">Login</h1>
                </th>
            </tr>
            <tr>
                <td>
                    <input type="text" name="login_username" id="" placeholder="Username">
                    <input type="text" name="login_passwd" id="" placeholder="Password">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submitbtn" value="Login" id="loginBtn" style="width: 98%;">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><a href="#" onclick="switch_card('register_Panel');" style="text-decoration: none; font-weight: bold; color: black;">Register</a></td>
            </tr>
        </table>
    </form>


    <!-- Registration -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table class="login" id="registrationPanel" hidden>
            <tr>
                <th>
                    <h1 style="text-decoration-line: underline;">Register</h1>
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" name="reg_username" id="" placeholder="Username" style="width: 92%;">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="reg_passwd" id="" placeholder="Password">
                    <input type="text" name="reg_confirm_passwd" id="" placeholder="Confirm Password">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submitbtn" value="Register" id="loginBtn" style="width: 98%;">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><a href="#" onclick="switch_card('login_Panel')" style="text-decoration: none; font-weight: bold; color: black;">Login</a></td>
            </tr>
        </table>
    </form>




    <script src="Assets/JS/main.js"></script>
</body>

</html>