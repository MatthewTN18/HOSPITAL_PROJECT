<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "patient") {
    header("Location: ../login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Patient Dashboard</title>
  <link rel="stylesheet" href="../css/styles.css" />
</head>
<body class="patient">

  <h2>Patient Dashboard</h2>

  <div class="dashboard">
    <div class="card">
      <a href="book_appointment.php">Book Appointment</a>
    </div>

    <div class="card">
      <a href="view_appointments.php">View Appointments</a>
    </div>

    <div class="card">
      <a href="view_billing.php">View Billing</a>
    </div>

    <div class="card">
      <a href="view_consultations.php">View Consultations</a>
    </div>

    <div class="card">
      <a href="view_labtest.php">View Lab Tests</a>
    </div>

    <div class="card">
      <a href="view_prescriptions.php">View Prescriptions</a>
    </div>

    <div class="card logout-card">
      <a href="../logout.php">Logout</a>
    </div>
  </div>

</body>
</html>
