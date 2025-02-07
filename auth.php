<?php
include('db_connection.php');

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the email and password from the form
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Fetch the user data from the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Check if a user with the provided email exists
    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if ($password == $user['password']) {
            session_start();
            // Set session variables for the logged-in user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            // Redirect to the dashboard or main page
            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: /inventory-system");
        }
    } else {
        header("Location:/inventory-system");
    }
}

// Close the connection
mysqli_close($conn);
?>