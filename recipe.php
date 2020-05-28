<!DOCTYPE HTML>
<?php include('server.php') ?>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Recipes </title>
    <link rel="icon" type="image/png" href="Resources/logo.png">
    <link rel="stylesheet" type="text/css" href="stylesheets/style.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/card_style.css" />
</head>
<body>
<navbar>
    <ul>
        <li><img src="Resources/logo.png" width="50" height="50" alt="Logo"</li>
        <li style="margin-left: 10px;"><a href="index.php">Home</a></li>
        <li><a href="recipes.php" class="active">Recipes</a></li>
        <li><a href="personalized_recipes.php?uid=<?php echo $_SESSION['uid']; ?>">Get recipe</a></li>
        <li><a href="inventory.php?inventoryfid=<?php echo $_SESSION["uid"]; ?>">Inventory</a></li>
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
        <p>See our recipes</p>
    </div>
</div>

<div class="row" style="width:90%; margin: 5%;">
    <img src="<?php echo $recipe_image; ?>" width="400" height="400" style="float:left;" />
    <h1>
        <?php echo $recipe_name; ?>
    </h1>
    <br/>
    <p>
        <?php echo $recipe_steps; ?>
    </p>

</div>
<a href="recipe.php?recipe_id=<?php echo $recipe_id; ?>&done=1"><button class="btn" style="width:30%; margin-left:35%; margin-right:35%; margin-bottom: 30px;">Dish served?</button></a>

<script src="scripts/alert.js"></script>
</body>
</html>
