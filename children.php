<?php
require "Database.php";

$config = require("config.php");

//dzekin tu esi nepareizaja mape

$db = new Database($config["Database"]);
$children = $db->query("SELECT * FROM children")->fetchAll();

echo "<ul>";
foreach($children as $post){
echo "<li>" . $post["firstname"] . "    " . $post["middlename"] . " " . $post["surname"] . " " . $post["age"] . "</li>";
}
echo "</ul>";


