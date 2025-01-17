<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('db.php');

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to the appropriate page based on the user role
    if ($_SESSION['user_email'] == 'admin@managadgetz.com') {
        // Redirect to admin page if the user is admin
        echo "<script>window.location.href = 'admin/';</script>";
    } else {
        // Redirect to the main page for regular users
        echo "<script>window.location.href = 'index.php';</script>";
    }
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($email) || empty($password)) {
        $error_message = "Email and password are required!";
    } else {
        // Check if the user exists in the database
        $sql = "SELECT * FROM accounts WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Fetch the user's data
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Start a session and store user data
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['user_email'] = $row['email']; // Store user email in the session

                // Redirect based on the user role
                if ($_SESSION['user_email'] == 'admin@managadgetz.com') {
                    // Redirect to admin page if the email is admin
                    echo "<script>window.location.href = 'admin/';</script>";
                } else {
                    // Redirect to the main page for other users
                    echo "<script>window.location.href = 'index.php';</script>";
                }
                exit();
            } else {
                $error_message = "Invalid password!";
            }
        } else {
            $error_message = "No account found with that email!";
        }
    }
}
?>
<style>
    .con {
        font-family: Arial, Helvetica, sans-serif;
        max-width: 400px;
        margin: auto;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        text-align: center;
        color: #333;
    }
    .input-field {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #fff;
        color: #333;
    }
    .btn {
        width: 100%;
        padding: 10px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .btn:hover {
        background-color: #444;
    }
    .error {
        color: red;
        text-align: center;
    }
</style>
<div class="con">
    <h2>Login</h2>
    <?php
    if (isset($error_message)) {
        echo "<p class='error'>$error_message</p>";
    }
    ?>
    <form method="POST" action="">
        <input type="email" name="email" class="input-field" placeholder="Email" required>
        <input type="password" name="password" class="input-field" placeholder="Password" required>
        <button type="submit" class="btn">Login</button>
    </form>
</div>

