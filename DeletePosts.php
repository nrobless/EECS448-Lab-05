<?php
// Debug
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

/*** Start Code ***/
// Initialize variables.
$mysqli = new mysqli('mysql.eecs.ku.edu', 'nrobless', 'Password123!', 'nrobless');
$delete = $_POST['delete'];

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

/* Checkbox handling from http://www.html-form-guide.com/php-form/php-form-checkbox.html */
if( empty($delete) ) {
    echo '<strong style="color:red">Failed:</strong> You have not selected any posts to delete.<br>';
}
else {
    $deleteNum = count($delete);

    for( $i=0; $i < $deleteNum; $i++ ) {
        // Print authors, posts, and delete checkboxes.
        $query = 'DELETE FROM Posts WHERE post_id = "' . $delete[$i] . '"';
        if ( $result = $mysqli->query($query) ) {
            echo '<strong style="color:green">Success:</strong> Post ID ' . $delete[$i] . ' deleted.<br>';
        }
        else {
            echo '<strong style="color:red">Failed:</strong> Unable to delete post ID ' . $delete[$i] . '.<br>';
        }
    }
}

echo '<table>';
echo '<tr><td colspan="3">&nbsp;</td></tr>';
echo '<form action="DeletePosts.php" method="post">';
echo '<tr><th>User ID</th><th>Post</th><th>Delete?</th></tr>';

// Print authors, posts, and delete checkboxes.
$query = 'SELECT post_id, author_id, content FROM Posts';
if ( $result = $mysqli->query($query) ) {
    // Fetch associative array.
    while ( $row = $result->fetch_assoc() ) {
        echo '<tr><td>' . $row['author_id'] . '</td>';
        echo '<td>' . $row['content'] . '</td>';
        echo '<td><input type="checkbox" name="delete[]" value="' . $row['post_id'] . '"></td></tr>';
    }
    // Free result set.
    $result->free();
}

echo '<tr><td colspan="3"><input type="submit" value="Delete Posts"></td></tr>';
echo '</form>';
echo '</table>';
echo '</div>';

// Close connection.
$mysqli->close();

/*** End Code ***/
?>