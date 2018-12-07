<?php
$items = array();

for ($i = 0; $i < 3; $i++) {
    $items[$i] = "This is the results: " . date("Y-m-d H:i:s");
}

echo json_encode($items);
