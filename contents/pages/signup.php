<?php
include('db.php');
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get user input from the form
  $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Validate inputs
  if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password)) {
      $error_message = "All fields are required!";
  } elseif ($password !== $confirm_password) {
      $error_message = "Passwords do not match!";
  } else {
      // Hash the password
      $hashed_password = password_hash($password, PASSWORD_BCRYPT);

      // Insert data into the accounts table
      $sql = "INSERT INTO accounts (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$hashed_password')";
      
      if ($conn->query($sql) === TRUE) {
          // Get the ID of the newly created user
          $user_id = $conn->insert_id;

          // Set session variables for auto-login
          $_SESSION['user_id'] = $user_id;
          $_SESSION['firstname'] = $firstname;
          $_SESSION['lastname'] = $lastname;
          $_SESSION['email'] = $email;

          echo "<script>window.location.href = 'index.php';</script>";
          exit;
      } else {
          $error_message = "Error: " . $conn->error;
      }
  }
}
?>
<style>
  body {
      font-family: Arial, sans-serif;
  }
  .con {
      max-width: 400px;
      margin: auto;
      background-color: #f5f5f5;
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
  .success {
      color: green;
      text-align: center;
  }
</style>
<div class="con">
    <h2>Signup</h2>
    <?php
    if (isset($error_message)) {
        echo "<p class='error'>$error_message</p>";
    }
    if (isset($success_message)) {
        echo "<p class='success'>$success_message</p>";
    }
    ?>
    <form method="POST" action="">
        <input type="text" name="firstname" class="input-field" placeholder="First Name" value="<?= isset($firstname) ? $firstname : '' ?>" required>
        <input type="text" name="lastname" class="input-field" placeholder="Last Name" value="<?= isset($lastname) ? $lastname : '' ?>" required>
        <input type="email" name="email" class="input-field" placeholder="Email" value="<?= isset($email) ? $email : '' ?>" required>
        <input type="password" name="password" class="input-field" placeholder="Password" required>
        <input type="password" name="confirm_password" class="input-field" placeholder="Confirm Password" required>
        <button type="submit" class="btn">Create Account</button>
    </form>
</div>
