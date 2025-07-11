<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "doctor") {
    header("Location: ../login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Doctor Dashboard</title>
  <link rel="stylesheet" href="../css/styles.css" />
</head>
<body class="doctor">

  <h2>Doctor Dashboard</h2>

  <div class="dashboard">
    <div class="card">
      <a href="consultation_form.php">Add Consultation</a>
    </div>

    <div class="card">
      <a href="add_prescription.php">Add Prescription</a>
    </div>

    <div class="card">
      <a href="view_consultations.php">View Consultations</a>
    </div>

    <div class="card">
      <a href="view_labtests.php">View Lab Tests</a>
    </div>

    <div class="card">
      <a href="view_patients.php">View Patients</a>
    </div>

    <div class="card">
      <a href="view_triage.php">View Triage Forms</a>
    </div>

    <div class="card">
      <a href="billing.php">Generate Billing</a>
    </div>

    <div class="card logout-card">
      <a href="../logout.php">Logout</a>
    </div>
  </div>

</body>
</html>
