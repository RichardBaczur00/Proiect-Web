<?php
    session_start();

    $db = mysqli_connect('localhost', 'root', '', 'kitchenready');

    $username = '';
    $email = '';
    $password_1 = '';
    $password_2 = '';
    $img_url = '';
    $quantity = 0;
    $new_quantity = 0;
    $user_id = 0;
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

    function already_exists($db, $user_id, $product_id)
    {
        $query = "SELECT id, Cantitate FROM inventory WHERE user_id='$user_id' AND Produs='$product_id'";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 0) return false;
        return mysqli_fetch_array($result);
    }

    if (isset($_POST['add_item'])) {
        $user_id = $_SESSION['uid'];
        $quantity = $_POST['quantity'];
        $product_id = $_POST['name'];

        if ($data=already_exists($db, $user_id, $product_id))
        {
            $inventory_id = $data[0];
            $new_quantity = $data[1] + $quantity;
            echo $inventory_id;
            echo " ";
            echo $new_quantity;
            $query = "UPDATE inventory SET Cantitate='$new_quantity' WHERE  id='$inventory_id'";
        }
        else
        {
            $query = "INSERT INTO inventory (Produs, Cantitate, user_id) 
                    VALUES ('$product_id', '$quantity', '$user_id')";
        }
        mysqli_query($db, $query);
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: index.php');
    }

    if (isset($_GET['inventoryfid'])) {
        $user_id = $_GET['inventoryfid'];
    }

    if (isset($_GET['selected'])) {
        $query = "SELECT * FROM ingredients WHERE id = " . $_GET['selected'];
        $result = mysqli_query($db, $query);

        $img_url = mysqli_fetch_row($result)[2];
    }

    $recipe_id='';
    $recipe_name='';
    $recipe_steps='';
    $recipe_image='';
    $recipe_ingredients='';
    if (isset($_GET['recipe_id']))
    {
        $recipe_id = $_GET['recipe_id'];
        $query = "SELECT * FROM recipe WHERE id='$recipe_id'";
        $result = mysqli_query($db, $query);

        $row = mysqli_fetch_row($result);
        $recipe_name=$row[1];
        $recipe_image=$row[2];
        $recipe_steps=$row[3];
    }

    if (isset($_GET['done'])) {
        $recipe_id = $_GET['recipe_id'];
        $query_bridge = "SELECT * FROM recipe_inventory_bridge WHERE recipe_id='$recipe_id'";
        $result_bridge = mysqli_query($db, $query_bridge);

        while ($row=mysqli_fetch_array($result_bridge)) {
            $ingredient_id = $row[2];
            $quantity = $row[3];

            $inventory_query = already_exists($db, $_SESSION['uid'], $ingredient_id);
            $inventory_id = $inventory_query[0];
            $old_quantity = $inventory_query[1];
            $new_quantity = $old_quantity - $quantity;

            $query = "UPDATE inventory SET Cantitate='$new_quantity' WHERE  id='$inventory_id'";
            mysqli_query($db, $query);
        }
    }
