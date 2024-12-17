<?php
require "Database.php";
$config = require("config.php");
$db = new Database($config["Database"]);
$gifts = $db->query("SELECT * FROM gifts")->fetchAll();

echo "<ol>";
foreach($gifts as $post){
echo "<li>" . $post["name"] . "  " . $post["count_available"] . "</li>";
}
echo "</ol>";