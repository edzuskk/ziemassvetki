<?php
require "Database.php";

$config = require("config.php");

//dzekin tu esi nepareizaja mape

$db = new Database($config["Database"]);
$children = $db->query("SELECT * FROM children")->fetchAll();
$letters = $db->query("SELECT * FROM letters")->fetchAll();

echo "<style>
    p{
        font-size:20px;
    }
</style>";

echo "<ul>";
foreach($children as $child) {
    echo "<li class='card'>"; 
    echo "<p>" . $child["firstname"] . " " . 
    $child["middlename"] . " " . 
    $child["surname"] . ", " . 
    $child["age"] . " gadi</p>"; 
    echo "<p>Vēstule: ";
    
    foreach($letters as $letter) {
        if ($letter["sender_id"] == $child["id"]) {
            echo $letter["letter_text"];
            break; 
        }
    }

    echo "</p>";
    echo "</li>";
}
echo "</ul>";


