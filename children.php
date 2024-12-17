<?php
require "Database.php";

$config = require("config.php");

//dzekin tu esi nepareizaja mape

$db = new Database($config["Database"]);
$children = $db->query("SELECT * FROM children")->fetchAll();
$letters = $db->query("SELECT * FROM letters")->fetchAll();

echo "<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f0f8ff; /* Light, wintery blue background */
        color: #333; /* Dark text for contrast */
        padding: 20px;
        text-align: center;
    }
    
    h1 {
        color: #e63946; /* Christmas red */
        font-size: 36px;
        text-transform: uppercase;
        margin-bottom: 30px;
    }
    
    .container {
        display: flex;
        flex-wrap: wrap; /* Allow wrapping if content overflows */
        justify-content: center; /* Center the items */
        gap: 20px; /* Space between items */
    }

    .card {
        background-color: white;
        border: 2px solid #e63946; /* Christmas red border */
        padding: 15px;
        width: 45%; /* Each card takes up 45% of the width */
        max-width: 500px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center; /* Center the text inside the card */
    }

    .card p {
        font-size: 18px;
        color: #555; /* Soft grey for text */
        line-height: 1.6;
    }

    .card p strong {
        font-weight: bold;
    }

    .card p::before {
        content: '🎄'; /* Add a Christmas tree icon before each paragraph */
        margin-right: 10px;
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

echo "<h1>Ziemassvētku Vēstules</h1>"; // Add Christmas-themed title

echo "<div class='container'>"; // Wrap the cards in a flex container
foreach($children as $child) {
    echo "<div class='card'>"; 
    echo "<p><strong>" . $child["firstname"] . " " . 
    $child["middlename"] . " " . 
    $child["surname"] . ", " . 
    $child["age"] . " gadi</strong></p>"; 
    echo "<p>Vēstule: ";
    
    foreach($letters as $letter) {
        if ($letter["sender_id"] == $child["id"]) {
            echo $letter["letter_text"];
            break; 
        }
    }

    echo "</p>";
    echo "</div>";
}
echo "</div>"; // Close the container

echo "<div class='footer'>Novēlam jums priecīgus Ziemassvētkus!</div>"; // Christmas wish footer
?>
