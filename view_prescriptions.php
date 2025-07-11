<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "patient") {
  header("Location: ../login.html");
  exit;
}
include("../db.php");
$patient_id = $_SESSION["linked_patient_id"];
$result = $conn->query("SELECT * FROM Prescription WHERE patient_id = '$patient_id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>View Prescriptions</title>
  <link rel="stylesheet" href="../css/form_views.css" />
</head>
<body>
  <h2>My Prescriptions</h2>
  <table>
    <tr><th>Drug</th><th>Dosage</th><th>Frequency</th><th>Duration</th><th>Instructions</th></tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['drug_name'] ?></td>
      <td><?= $row['dosage'] ?></td>
      <td><?= $row['frequency'] ?></td>
      <td><?= $row['duration'] ?></td>
      <td><?= $row['special_instructions'] ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
