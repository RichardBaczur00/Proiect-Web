<?php
    include('RecipeObject.php');

    $recipe_list = array();
    $inventory_list = array();

    /**
     * @param $db
     * @param $recipe_list
     * @param $inventory_list
     */
    function read_database($db, $recipe_list, $inventory_list) {
        $uid = $_SESSION['uid'];
        $query_recipes = "SELECT * FROM recipe";
        $query_inventory = "SELECT Produs FROM inventory WHERE user_id='$uid'";

        $result_recipe = mysqli_query($db, $query_recipes);
        $result_inventory = mysqli_query($db, $query_inventory);

        while ($row=mysqli_fetch_array($result_recipe)) {
            $recipe = new RecipeObject($row[0], $row[1], $row[2], $row[4], $row[5]);
            array_push($recipe_list, $recipe);
        }

        while ($row=mysqli_fetch_array($result_inventory)) {
            array_push($inventory_list, $row[0]);
        }

        get_kitchen_ready_recipes($db, $recipe_list, $inventory_list);
    }

    /**
     * @param $db
     * @param $recipe_list
     * @param $inventory_list
     */
    function get_kitchen_ready_recipes($db, $recipe_list, $inventory_list) {
        foreach ($recipe_list as $recipe) {
            $found_ingredients = 0;
            $number_of_ingredients = $recipe->getNumberOfIngredients();
            $recipe_id = $recipe->get_id();
            $query_bridge = "SELECT ingredient_id FROM recipe_inventory_bridge WHERE recipe_id='$recipe_id'";
            $result_bridge = mysqli_query($db, $query_bridge);

            while ($row=mysqli_fetch_array($result_bridge)) {
                if (in_array($row[0], $inventory_list)) {
                    $found_ingredients += 1;
                }
            }

            if ($number_of_ingredients == $found_ingredients) {
                print_recipe($recipe->get_id(), $recipe->get_name(), $recipe->get_image(), $recipe->get_special());
            }

        }
    }

    /**
     * @param $id
     * @param $name
     * @param $image
     * @param $specials
     */
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

    read_database($db, $recipe_list, $inventory_list);



