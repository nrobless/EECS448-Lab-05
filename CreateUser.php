<?php
// Debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*** Start Code ***/
// Initialize variables.
$mysqli = new mysqli('mysql.eecs.ku.edu', 'nrobless', 'Password123!', 'nrobless');
$user = $_POST['user'];

// Set up structure.
echo '<title>EECS448 Message Board - Create User</title>';
/* Link CSS from http://stackoverflow.com/questions/6315772/how-to-import-include-a-css-file-using-php-code-and-not-html-code */
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo '<div>';
echo '<h1>EECS448 Message Board</h1>';
echo '<h2>Create User</h2>';

// Check connection.
if ( $mysqli->connect_errno ) {
    echo '<strong style="color:red">Connect Failed:</strong>' . $mysqli->connect_error . '</div>';
    exit();
}

/* Validate new user ID. */
// Check if blank.
if ( $user == "" ) {
    echo '<strong style="color:red">Failed:</strong> User ID cannot be blank.</div>';
    exit();
}
else {
    // Check if already exists
    $query = 'SELECT user_id FROM Users';
    if ( $result = $mysqli->query($query) ) {
        // Fetch associative array.
        while ( $row = $result->fetch_assoc() ) {
            if ( $user == $row['user_id'] ) {
                echo '<strong style="color:red">Failed:</strong> User ID already exists.</div>';
                exit();
            }
        }
        // Free result set.
        $result->free();
    }

    // ID is not blank or previously existing, add to database.
    $query = 'INSERT INTO Users ( user_id ) VALUES ( "' . $user . '" )';
    if ( $mysqli->query($query) ) {
        echo '<strong style="color:green">Success:</strong> User ID added.';
    }
    else {
        // Uncaught database error.
        echo '<strong style="color:red">Failed:</strong> User ID could not be added.';
    }
    echo '</div>';
}
// Close connection.
$mysqli->close();

/*** End Code ***/
?>
