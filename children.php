<?php
require "Database.php";

$config = require("config.php");

$db = new Database($config["Database"]);
$children = $db->query("SELECT * FROM children")->fetchAll();
$letters = $db->query("SELECT * FROM letters")->fetchAll();
$gifts = $db->query("SELECT * FROM gifts")->fetchAll();

// Izveidot dāvanu nosaukumu masīvu
$gift_names = array_column($gifts, 'name');

echo "<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f0f8ff;
        color: #333;
        padding: 20px;
        text-align: center;
    }
    
    h1 {
        color: #e63946;
        font-size: 36px;
        text-transform: uppercase;
        margin-bottom: 30px;
    }
    
    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .card {
        background-color: white;
        border: 2px solid #e63946;
        padding: 15px;
        width: 45%;
        max-width: 500px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .card p {
        font-size: 18px;
        color: #555;
        line-height: 1.6;
    }

    .card p strong {
        font-weight: bold;
    }

    ul {
        list-style-type: none;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .footer {
        margin-top: 50px;
        font-size: 16px;
        color: #777;
    }

</style>";

echo "<h1>🎄Ziemassvētku Vēstules🎄</h1>";

echo "<div class='container'>";

foreach($children as $child) {
    echo "<div class='card'>";
    echo "<p><strong>"."🎄 " . $child["firstname"] . " " . 
    $child["middlename"] . " " . 
    $child["surname"] . ", " . 
    $child["age"] . " gadi 🎄</strong></p>";
    echo "<p>Vēstule: ";
    
    $child_wishes = [];
    foreach($letters as $letter) {
        if ($letter["sender_id"] == $child["id"]) {
            $letter_text = $letter["letter_text"];
            echo $letter_text;
            break;
        }
    }

    foreach($gift_names as $gift) {
        if (stripos($letter_text, $gift) !== false) {
            $child_wishes[] = $gift;
        }
    }

    if (!empty($child_wishes)) {
        echo "<p><strong>Vēlmju saraksts:</strong></p>";
        echo "<ul>";
        foreach($child_wishes as $wish) {
            echo "$wish <br><br>";
        }
        echo "</ul>";
    }

    echo "</div>";
}

echo "</div>";

echo "<div class='footer'>Novēlam jums priecīgus Ziemassvētkus!</div>"; // Christmas wish footer
?>
