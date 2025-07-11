<?php
session_start();
include("../db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $patient_id = $_POST["patient_id"];
  $presenting_symptoms = $_POST["presenting_symptoms"];
  $diagnosis = $_POST["diagnosis"];
  $follow_up_date = $_POST["follow_up_date"];
  $next_visit_time = $_POST["next_visit_time"];
  $notes = $_POST["additional_notes"];
  $doctor_id = $_SESSION["linked_doctor_id"];

  $stmt = $conn->prepare("INSERT INTO Consultation (patient_id, doctor_id, presenting_symptoms, diagnosis, follow_up_date, next_visit_time, additional_notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sisssss", $patient_id, $doctor_id, $presenting_symptoms, $diagnosis, $follow_up_date, $next_visit_time, $notes);
  $stmt->execute();
  echo "<p>Consultation saved successfully.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Consultation Form</title>
  <link rel="stylesheet" href="../css/form_views.css">
</head>
<body>
  <h2>Consultation Form</h2>
  <form method="POST">
    <label>Patient ID: <input name="patient_id" required></label><br>
    <label>Symptoms: <textarea name="presenting_symptoms" required></textarea></label><br>
    <label>Diagnosis: <input name="diagnosis" required></label><br>
    <label>Follow-up Date: <input type="date" name="follow_up_date"></label><br>
    <label>Next Visit Time: <input type="time" name="next_visit_time"></label><br>
    <label>Notes: <textarea name="additional_notes"></textarea></label><br>
    <button type="submit">Save Consultation</button>
  </form>
  <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
