<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "nurse") {
    header("Location: ../login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Nurse Dashboard</title>
  <link rel="stylesheet" href="../css/styles.css" />
</head>
<body class="nurse">

  <h2>Nurse Dashboard</h2>

  <div class="dashboard">
    <div class="card">
      <a href="triage_form.php">Fill Triage Form</a>
    </div>

    <div class="card">
      <a href="view_triage.php">View Triage Records</a>
    </div>

    <div class="card">
      <a href="labtest.php">Add Lab Test</a>
    </div>

    <div class="card">
      <a href="view_labtest.php">View Lab Tests</a>
    </div>

    <div class="card">
      <a href="view_patients.php">View Patients</a>
    </div>

    <div class="card">
      <a href="view_consultations.php">View Consultations</a>
    </div>

    <div class="card logout-card">
      <a href="../logout.php">Logout</a>
    </div>
  </div>

</body>
</html>
