<?php
    $query_user_inventory = "SELECT * FROM inventory WHERE user_id='$user_id'";
    $result_user_inventory = mysqli_query($db, $query_user_inventory);

    //Inventory table:
    //id, product_id, quantity, user_id
    //Product table:
    //id, name, Image

    /*
     *
     * <div class="row">
        <div class="column">
            <div class="card">
            <h3>Card 1</h3>
            <p>Some text</p>
            <p>Some text</p>
        </div>
       </div>
     */

    function print_product($name, $image, $quantity) {
        echo "<div class='column'>
                <div class='card'>
                    <img src='" . $image . "' style='width: 100%;' height='200'/>
                    <h3>" . $name . "</h3>
                    <p>Quantity " . $quantity . "</p>
                </div> </div>";
    }

    $i = 1;
    echo "<div class='row'>";
    while ($row_user_inventory = mysqli_fetch_array($result_user_inventory)) {
        $product_id = $row_user_inventory[1];
        $quantity = $row_user_inventory[2];

        $query_product = "SELECT * FROM ingredients WHERE id='$product_id'";
        $result_product = mysqli_query($db, $query_product);

        $row_product = mysqli_fetch_row($result_product);
        $name = $row_product[1];
        $image = $row_product[2];

        print_product($name, $image, $quantity);

        if ($i % 4 == 0)
        {
            echo "</div>";
            echo "<div class='row'>";
        }
        $i += 1;
        mysqli_free_result($result_product);
    }
    mysqli_free_result($result_user_inventory);


