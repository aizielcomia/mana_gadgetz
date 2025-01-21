<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
include('db.php');

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['user_id'])) {
  echo "<script>window.location.href = 'index.php?page=login';</script>";
    exit;
}

// Fetch user data from the session
$user_id = $_SESSION['user_id'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];

$sql = "SELECT * FROM accounts WHERE id = '$user_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
?>
<style>

  .con {
        font-family: Arial, Helvetica, sans-serif;
      max-width: 800px;
      margin: 50px auto;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      color: #333;
  }

  h2 {
      text-align: center;
      color: #333;
  }

  .profile-info {
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  .profile-info p {
      margin: 10px 0;
  }

  .btn {
      display: inline-block;
      width: 100%;
      padding: 15px;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 10px;
      text-align: center;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
      text-decoration: none;
  }

  .btn:hover {
      background-color: #444;
  }

  .logout-btn {
      background-color: #e74c3c;
  }

  .logout-btn:hover {
      background-color: #c0392b;
  }
</style>
<div class="con">
  <h2>Hello <?= $firstname ?> <?= $lastname ?>!</h2>
  <div class="profile-info">
      <h3>Profile Details</h3>
      <p><strong>Email:</strong> <?= $row['email'] ?></p>
      <p><strong>Joined On:</strong> <?= $row['created_at'] ?></p>
  </div>

  <a href="logout.php" class="btn logout-btn">Logout</a>
</div>
