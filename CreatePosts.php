<?php
// Debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*** Start Code ***/
// Initialize variables.
$mysqli = new mysqli('mysql.eecs.ku.edu', 'nrobless', 'Password123!', 'nrobless');
$author = $_POST['user'];
$content = $_POST['post-text'];

// Set up structure.
echo '<title>EECS448 Message Board - Create Post</title>';
/* Link CSS from http://stackoverflow.com/questions/6315772/how-to-import-include-a-css-file-using-php-code-and-not-html-code */
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo '<div>';
echo '<h1>EECS448 Message Board</h1>';
echo '<h2>Create Post</h2>';

// Check connection.
if ( $mysqli->connect_errno ) {
    echo '<strong style="color:red">Connect Failed:</strong>' . $mysqli->connect_error . '</div>';
    exit();
}

/* Validate new user ID. */
// Check if post is blank.
if ( $content == "" ) {
    echo '<strong style="color:red">Failed:</strong> Post text cannot be blank.</div>';
    exit();
}
else {
    // Check if user exists.
    $query = 'SELECT user_id FROM Users WHERE user_id = "' . $author . '"';
    if ( $result = $mysqli->query($query) ) {
        if ( $result->num_rows == 0 ) {
            echo '<strong style="color:red">Failed:</strong> User ID does not exist.</div>';
            exit();
        }
        // Free result set.
        $result->free();
    }

    // Post is not blank and user ID exists, add to database.
    $query = 'INSERT INTO Posts ( content, author_id ) VALUES ( "' . $content . '", "' . $author . '" )';
    if ( $mysqli->query($query) ) {
        echo '<strong style="color:green">Success:</strong> Post added.';
    }
    else {
        echo '<strong style="color:red">Failed:</strong> Post could not be added.';
    }
    echo '</div>';
}
// Close connection.
$mysqli->close();

/*** End Code ***/
?>
