<?php
session_start();
include("../db.php");

$patient_id = $_SESSION["linked_patient_id"];
$sql = "SELECT * FROM Appointments WHERE patient_id = ? ORDER BY preferred_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Appointments</title>
  <link rel="stylesheet" href="../css/form_views.css">
</head>
<body>
  <h2>My Appointments</h2>
  <table border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>Department</th>
      <th>Preferred Date</th>
      <th>Time</th>
      <th>Reason</th>
      <th>Status</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
      <td><?= htmlspecialchars($row['department']) ?></td>
      <td><?= htmlspecialchars($row['preferred_date']) ?></td>
      <td><?= htmlspecialchars($row['preferred_time']) ?></td>
      <td><?= htmlspecialchars($row['reason_for_appointment']) ?></td>
      <td><?= htmlspecialchars($row['status'] ?? "Pending") ?></td>
    </tr>
    <?php } ?>
  </table>
  <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
