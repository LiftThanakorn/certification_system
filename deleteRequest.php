<<<<<<< HEAD
<?php
// Connect to the database
require_once 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the request ID is provided
    if (isset($_POST['requestId'])) {
        $requestId = $_POST['requestId'];

        // Perform the delete operation
        $sql = "DELETE FROM requestcertificate WHERE requestcertificate_id = '$requestId'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Deletion successful
            echo "success";
        } else {
            // Deletion failed
            echo "error";
        }
    } else {
        // Request ID not provided
        echo "error";
    }
} else {
    // Invalid request method
    echo "error";
}
?>
=======
<?php
// Connect to the database
require_once 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the request ID is provided
    if (isset($_POST['requestId'])) {
        $requestId = $_POST['requestId'];

        // Perform the delete operation
        $sql = "DELETE FROM requestcertificate WHERE requestcertificate_id = '$requestId'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Deletion successful
            echo "success";
        } else {
            // Deletion failed
            echo "error";
        }
    } else {
        // Request ID not provided
        echo "error";
    }
} else {
    // Invalid request method
    echo "error";
}
?>
>>>>>>> b353122d0de52891d8d361ae6125960e22323f67
