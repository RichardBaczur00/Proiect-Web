<!DOCTYPE HTML>
<?php include('server.php') ?>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Home page </title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <navbar>
    <ul>
        <li><img src="Resources/logo.png" width="50" height="50" alt="Logo"</li>
        <li style="margin-left: 10px;"><a href="index.php" class="active">Home</a></li>
        <li><a href="recipes.php">Recipes</a></li>
        <li><a href="#">Get recipe</a></li>
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
            <p>Are you kitchen ready?</p>
            <button class="btn">Find out now</button>
        </div>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert  success">
            <span class="closebtn">&times;</span>
            <strong>Success!</strong> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif ?>

    <div class="about">
        <img src="Resources/food-illustration.jpg" alt="food" style="width: 50%; height: 100%; float: left;" />
        <h1 style="text-align: center;">About Kitchen Ready</h1> <br/>
        <p style="text-align: center;">
            Kitchen Ready is an app made to help people cook dishes for which they already have everything in their home.
            Just input the ingredients you have at home and the app will give you suggestions based on this, after which
            you can pick the dish of you choice and start preparing it using the step-by-step system.
        </p>
    </div>
    <br/>
    <br/>
    <br/>
    <div class="shopping">
        <img src="Resources/shopping-cart.jpg" alt="food" style="width: 50%; height: 140%; float: right;" />
        <h1 style="text-align: center;">No more unnecessary shopping</h1> <br/>
        <p style="text-align: center;">
            Every year, people throw away one third of food produced for human consumption globally,
            which amounts to about 1.3 billion tonnes of otherwise good food being wasted per year.
            This problem must be solved if we intend to solve world hunger and the best way to solve this problem
            would be to use the food you already have instead of buying new food. This app can show you a few ways
            to use the ingredients you already have so you don't have to buy new ingredients.
        </p>
    </div>



    <script src="scripts/alert.js"></script>
</body>
</html>
