<?php
// Debug
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

/*** Start Code ***/
// Initialize variables.
$mysqli = new mysqli('mysql.eecs.ku.edu', 'nrobless', 'Password123!', 'nrobless');
$user = $_POST['user'];

// Set up structure.
echo '<title>EECS448 Message Board - View User Posts</title>';
/* Link CSS from http://stackoverflow.com/questions/6315772/how-to-import-include-a-css-file-using-php-code-and-not-html-code */
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo '<div>';
echo '<h1>EECS448 Message Board</h1>';
echo '<h2>View User Posts</h2>';

// Check connection.
if ( $mysqli->connect_errno ) {
    echo '<strong style="color:red">Connect Failed:</strong>' . $mysqli->connect_error . '</div>';
    exit();
}

echo '<table>';
echo '<form action="ViewUserPosts.php" method="post">';
echo '<tr><td>Select User:</td><td><select name="user" required>';

// Print user_id's to options.
$query = 'SELECT user_id FROM Users';
if ( $result = $mysqli->query($query) ) {
    // Fetch associative array.
    while ( $row = $result->fetch_assoc() ) {
        echo '<option>' . $row['user_id'] . '</option>';
    }
    // Free result set.
    $result->free();
}

echo '</select></td></tr>';
echo '<tr><td colspan="2"><input type="submit" value="View User Posts"></td></tr>';
echo '<tr><td colspan="2">&nbsp;</td></tr>';
echo '</form>';
echo '<tr><th>User ID</th><th>Post</th></tr>';

// Print user_id's to table.
$query = 'SELECT author_id, content FROM Posts WHERE author_id = "' . $user . '"';
if ( $result = $mysqli->query($query) ) {
    // Fetch associative array.
    while ( $row = $result->fetch_assoc() ) {
        echo '<tr><td>' . $row['author_id'] . '</td>';
        echo '<td>' . $row['content'] . '</td></tr>';
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
