<?php
session_start();
include("../db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $patient_id = $_POST["patient_id"];
  $drug_name = $_POST["drug_name"];
  $dosage = $_POST["dosage"];
  $frequency = $_POST["frequency"];
  $duration = $_POST["duration"];
  $instructions = $_POST["special_instructions"];
  $doctor_id = $_SESSION["linked_doctor_id"];
  $date_issued = date('Y-m-d');

  $stmt = $conn->prepare("INSERT INTO Prescription (patient_id, doctor_id, date_issued, drug_name, dosage, frequency, duration, special_instructions) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sissssss", $patient_id, $doctor_id, $date_issued, $drug_name, $dosage, $frequency, $duration, $instructions);
  $stmt->execute();
  echo "<p>Prescription added successfully.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Prescription</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <h2>Add Prescription</h2>
  <form method="POST">
    <label>Patient ID: <input name="patient_id" required></label><br>
    <label>Drug Name: <input name="drug_name" required></label><br>
    <label>Dosage: <input name="dosage" required></label><br>
    <label>Frequency: <input name="frequency" required></label><br>
    <label>Duration: <input name="duration" required></label><br>
    <label>Instructions: <textarea name="special_instructions"></textarea></label><br>
    <button type="submit">Add Prescription</button>
  </form>
  <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
