<!DOCTYPE HTML>
<?php include('server.php') ?>
<html lang="en" xmlns:float="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Home page </title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<navbar>
    <ul>
        <li><img src="Resources/logo.png" width="50" height="50" alt="Logo"</li>
        <li style="margin-left: 10px;"><a href="index.php"">Home</a></li>
        <li><a href="#">Recipes</a></li>
        <li><a href="#">Get recipe</a></li>
        <li><a href="inventory.php" class="active">Inventory</a></li>
        <?php if (isset($_SESSION['username'])): ?>
            <li style="float: right;"><a href="index.php?logout=1" style="color:red">Logout</a></li>
            <li style="float: right;"><a href="#"><?php echo $_SESSION['username'] ?></a></li>
        <?php else: ?>
            <li style="float: right;"><a href="register.php">Register</a></li>
            <li style="float: right;"><a href="login.php">Log in</a></li>
        <?php endif ?>
    </ul>
</navbar>

<div class="jumbotron">
    <div class="jumbotron-text">
        <h1>Kitchen Ready</h1>
        <p>Check your inventory or add new items</p>
        <button class="btn">Add item</button>
    </div>
</div>




<script src="scripts/alert.js"></script>
</body>
</html>
