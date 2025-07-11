<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "patient") {
  header("Location: ../login.html");
  exit;
}
include("../db.php");
$patient_id = $_SESSION["linked_patient_id"];
$result = $conn->query("SELECT * FROM Consultation WHERE patient_id = '$patient_id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>View Consultations</title>
  <link rel="stylesheet" href="../css/form_views.css" />
</head>
<body>
  <h2>My Consultations</h2>
  <table>
    <tr><th>Symptoms</th><th>Diagnosis</th><th>Follow Up</th><th>Notes</th></tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['presenting_symptoms'] ?></td>
      <td><?= $row['diagnosis'] ?></td>
      <td><?= $row['follow_up_date'] ?></td>
      <td><?= $row['additional_notes'] ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
