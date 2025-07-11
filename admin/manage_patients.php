<?php
session_start();
include("../db.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login.php");
    exit;
}

$sql = "SELECT patient_id, patient_name, date_of_birth, gender FROM PatientInformation";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Patients</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <h2>Manage Patients</h2>

  <?php if ($result->num_rows > 0): ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Date of Birth</th>
        <th>Gender</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row["patient_id"]) ?></td>
        <td><?= htmlspecialchars($row["patient_name"]) ?></td>
        <td><?= htmlspecialchars($row["date_of_birth"]) ?></td>
        <td><?= htmlspecialchars($row["gender"]) ?></td>
      </tr>
      <?php endwhile; ?>
    </table>
  <?php else: ?>
    <p>No patients found.</p>
  <?php endif; ?>

  <p class="back-link"><a href="dashboard.php">&larr; Back to Dashboard</a></p>
</body>
</html>
