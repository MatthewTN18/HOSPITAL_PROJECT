<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "patient") {
  header("Location: ../login.html");
  exit;
}

include("../db.php");

// Get linked_patient_id
$patient_id = $_SESSION["linked_patient_id"];

// Fetch the patient name
$stmt = $conn->prepare("SELECT patient_name FROM PatientInformation WHERE patient_id = ?");
$stmt->bind_param("s", $patient_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
  $patient_name = $row["patient_name"];
} else {
  die("Patient name not found for this account.");
}

// Fetch lab tests
$stmt2 = $conn->prepare("SELECT * FROM LabTest WHERE patient_name = ?");
$stmt2->bind_param("s", $patient_name);
$stmt2->execute();
$labtests = $stmt2->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>View Lab Tests</title>
  <link rel="stylesheet" href="../css/form_views.css" />
</head>
<body>
  <h2>My Lab Tests</h2>
  <table>
    <tr><th>Test</th><th>Instruction</th><th>Date</th></tr>
    <?php while ($row = $labtests->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['type_of_test']) ?></td>
      <td><?= htmlspecialchars($row['doctors_instruction']) ?></td>
      <td><?= htmlspecialchars($row['date_requested']) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
