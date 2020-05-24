<?php
    session_start();

    $db = mysqli_connect('localhost', 'root', '', 'kitchenready');

    $username = '';
    $email = '';
    $password_1 = '';
    $password_2 = '';
    $errors = array();
    $items = array();

    if (isset($_POST['register']))
    {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password']);
        $password_2 = mysqli_real_escape_string($db, $_POST['conf_password']);

        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        if (empty($password_1)) {
            array_push($errors, "Password is required");
        } else if ($password_1 != $password_2) {
            array_push($errors, "Passwords don't match");
        }

        if (count($errors) == 0) {
            $password_1 = md5($password_1);
            $sql = "INSERT INTO users (username, password, email) 
                    VALUES ('$username', '$password_1', '$email')";
            mysqli_query($db, $sql);
            $_SESSION["username"] = $username;
            $_SESSION["success"] = "You are now logged in";
            header('location: index.php');
        }
    }

    $password = "";
    $username = "";

    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }

        if (count($errors) == 0) {
            $password = md5($password);
            $password = substr($password, 0, -2);
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = mysqli_query($db, $query);
            echo $password;
            if (mysqli_num_rows($result) == 1) {
                $_SESSION["uid"] = mysqli_fetch_row($result)[0];
                $_SESSION["username"] = $username;
                $_SESSION["success"] = "You are now logged in";
                header('location: index.php');
            } else {
                array_push($errors, "Wrong username/password!");
            }
            mysqli_free_result($result);
        }
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: index.php');
    }

    if (isset($_GET['inventoryfid'])) {

    }
