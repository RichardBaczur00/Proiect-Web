<?php
    $query = "SELECT * FROM recipe";

    $result = mysqli_query($db, $query);

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
