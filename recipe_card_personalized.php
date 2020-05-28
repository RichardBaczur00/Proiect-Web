<?php
    $uid = $_SESSION['uid'];

    $query_recipes = "SELECT id, name, number_of_ingredients FROM recipe";
    $query_inventory = "SELECT Produs FROM inventory WHERE user_id='$uid'";

    $result_recipe = mysqli_query($db, $query_recipes);
    $result = null;

    $recipe_list = array();

    function print_recipe($id, $name, $image, $specials) {
        echo "<a style='color: black;' href='recipe.php?recipe_id=" . $id . "'>";
        echo "<div class='column'>
                    <div class='card'>
                        <img src='" . $image . "' style='width: 100%;' height='200'/>
                        <h3>" . $name . "</h3>
                        <p>Special tags: " . $specials . "</p>
                    </div> </div>";
        echo "</a>";
    }

    while ($row=mysqli_fetch_array($result_recipe)) {
        $recipe_list[$row[1]] = $row[2];
    }

    /*
    $i = 1;
    echo "<div class='row'>";
    while ($row=mysqli_fetch_array($result)) {
        $id = $row[0];
        $name = $row[1];
        $image = $row[2];
        $specials = $row[4];

        print_recipe($id, $name, $image, $specials);

        if ($i % 4 == 0) {
            echo "</div>";
            echo "<div class='row'>";
        }
        $i += 1;
    }
    mysqli_free_result($result);
    */