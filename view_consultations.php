<?php
session_start();
include("../db.php");
$doctor_id = $_SESSION["linked_doctor_id"];
$stmt = $conn->prepare("SELECT * FROM Consultation WHERE doctor_id = ?");
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Consultations</title>
     <link rel="stylesheet" href="../css/form_views.css">
</head>
<body>
    <h2>My Consultations</h2>
<table border="1">
<tr><th>ID</th><th>Patient</th><th>Symptoms</th><th>Diagnosis</th><th>Follow Up</th></tr>
<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
  <td><?= $row["consultation_id"] ?></td>
  <td><?= $row["patient_id"] ?></td>
  <td><?= $row["presenting_symptoms"] ?></td>
  <td><?= $row["diagnosis"] ?></td>
  <td><?= $row["follow_up_date"] ?></td>
</tr>
<?php } ?>
</table>

</body>
</html>
