<?php
// Debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*** Start Code ***/
// Initialize variables.
$mysqli = new mysqli('mysql.eecs.ku.edu', 'nrobless', 'Password123!', 'nrobless');

// Set up structure.
echo '<title>EECS448 Message Board - View Users</title>';
/* Link CSS from http://stackoverflow.com/questions/6315772/how-to-import-include-a-css-file-using-php-code-and-not-html-code */
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo '<div>';
echo '<h1>EECS448 Message Board</h1>';
echo '<h2>View Users</h2>';

// Check connection.
if ( $mysqli->connect_errno ) {
    echo '<strong style="color:red">Connect Failed:</strong>' . $mysqli->connect_error . '</div>';
    exit();
}

echo '<table>';
echo '<tr><th>User ID</th></tr>';

// Print user_id's to table.
$query = 'SELECT user_id FROM Users';
if ( $result = $mysqli->query($query) ) {
    // Fetch associative array.
    while ( $row = $result->fetch_assoc() ) {
        echo '<tr><td>' . $row['user_id'] . '</td></tr>';
    }
    // Free result set.
    $result->free();
}

echo '</table>';
echo '</div>';

// Close connection.
$mysqli->close();

/*** End Code ***/
?>
