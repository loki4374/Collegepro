<?php
$connection = mysqli_connect("localhost", "root", "", "2ndmech");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$db = mysqli_select_db($connection, "2ndmech");

// Check if 'del' parameter is set and is a valid integer
if (isset($_GET['del']) && is_numeric($_GET['del'])) {
    $delete = $_GET['del'];

    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM class WHERE id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $delete);

    if (mysqli_stmt_execute($stmt)) {
        // Successfully deleted
        echo '<script>alert("Record deleted successfully."); location.replace("view.php");</script>';
    } else {
        // Error occurred
        echo '<script>alert("Error deleting record: ' . mysqli_error($connection) . '"); history.go(-1);</script>';
    }

    mysqli_stmt_close($stmt);
} else {
    // Invalid 'del' parameter
    echo '<script>alert("Invalid request."); history.go(-1);</script>';
}

mysqli_close($connection);
?>
