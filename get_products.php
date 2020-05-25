<?php
    $db = mysqli_connect('localhost', 'root', '', 'kitchenready');

    $query = "SELECT * FROM ingredients";
    $option_html = '';
    $image_urls = array();
    $selected = $_GET['selected'];

    $result = mysqli_query($db, $query);
    $i = 1;
    while ($row=mysqli_fetch_array($result))
    {
        if ($i != $selected) {
            $option_html .= '<option id="' . htmlspecialchars($row[0]) . '" value="' . htmlspecialchars($row[0]) . '">'
                . htmlspecialchars($row[1]) . '</option>';
        }
        else
        {
            $option_html .= '<option selected="selected" id="' . htmlspecialchars($row[0]) . '" value="' . htmlspecialchars($row[0]) . '">'
                . htmlspecialchars($row[1]) . '</option>';
        }
        $i += 1;
        $image_urls = $row[2];
    }
    mysqli_free_result($result);

    echo $option_html;

