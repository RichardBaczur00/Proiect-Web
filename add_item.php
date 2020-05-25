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
        <li><a href="recipes.php">Recipes</a></li>
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

<div class="jumbotron-custom">
    <div class="jumbotron-text">
        <h1>Kitchen Ready</h1>
        <p>Here you can add items to your inventory</p>
    </div>
</div>

<div class="addItem">
    <img src="<?php echo $img_url; ?>" id="product_img" width="300" height="300" style="float: left;" />
    <form method="post" action="inventory.php">
        <h1 style="text-align: center;">Add an item</h1>
        <div class="input-group">
            <label>Select product</label>
        </div>
        <div class="input-group">
            <select style="color: white;" onchange="change_img()" class="form-control" id="product_select" name="name">
                <?php include('get_products.php'); ?>
            </select>
        </div>
        <div class="input-group">
            <label>Quantity</label>
            <input type="number" name="quantity">
        </div>
        <button type="submit" name="add_item" class="btn">Add item</button>
    </form>
    <script src="scripts/add_img_selector.js"></script>
    <script src="scripts/select_styling.js"></script>
</div>
</body>
</html>
