<?php
// utility/proses_tolak.php

// Check if 'id' parameter is set in the POST request
if (isset($_POST['id'])) {
    // Get the 'id' from the POST request
    $id = $_POST['id'];

    // Check if 'alasan' is set in the POST request
    if (isset($_POST['alasan'])) {
        // Get the 'alasan' from the POST request
        $alasan = $_POST['alasan'];

        // Your database connection code goes here
        require("../koneksi.php");

        // Use prepared statements to prevent SQL injection
        $sql = "UPDATE `laporan` SET status='Tolak', alasan = ? WHERE id = ?";
        
        // Prepare the statement
        $stmt = mysqli_prepare($conn, $sql);

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "si", $alasan, $id);

        // Execute the statement
        $eksekusi = mysqli_stmt_execute($stmt);

        // Check if the query was successful
        if ($eksekusi) {
            // Redirect back to the previous page
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit();
        } else {
            // If the query fails, display an error message
            echo "Error: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);

        // Close the database connection
        mysqli_close($conn);
    } else {
        // If 'alasan' parameter is not set, display an error message
        echo "Invalid request. 'alasan' parameter is missing.";
    }
} else {
    // If 'id' parameter is not set, display an error message
    echo "Invalid request. 'id' parameter is missing.";
}
?>
