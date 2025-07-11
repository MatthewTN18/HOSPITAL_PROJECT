<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin") {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
   <link rel="stylesheet" href="../css/styles.css" />
</head>
<body class="admin">

  <h2>Admin Dashboard</h2>

  <div class="dashboard">
    <div class="card">
      <a href="manage_doctors.php">Manage Doctors</a>
    </div>

    <div class="card">
      <a href="manage_nurses.php">Manage Nurses</a>
    </div>

    <div class="card">
      <a href="manage_patients.php">Manage Patients</a>
    </div>

  
    <div class="card logout-card">
      <a href="../logout.php">Logout</a>
    </div>
  </div>

</body>
</html>
