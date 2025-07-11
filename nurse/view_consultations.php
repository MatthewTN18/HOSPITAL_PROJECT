<?php
session_start();
include("../db.php");

// Example: show all consultations ordered by latest
$sql = "SELECT * FROM Consultation ORDER BY follow_up_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Consultations</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <h2>View Consultations</h2>
  <table border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>Patient ID</th>
      <th>Symptoms</th>
      <th>Diagnosis</th>
      <th>Follow-up Date</th>
      <th>Next Visit Time</th>
      <th>Notes</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
      <td><?= htmlspecialchars($row['patient_id']) ?></td>
      <td><?= htmlspecialchars($row['presenting_symptoms']) ?></td>
      <td><?= htmlspecialchars($row['diagnosis']) ?></td>
      <td><?= htmlspecialchars($row['follow_up_date']) ?></td>
      <td><?= htmlspecialchars($row['next_visit_time']) ?></td>
      <td><?= htmlspecialchars($row['additional_notes']) ?></td>
    </tr>
    <?php } ?>
  </table>
  <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
