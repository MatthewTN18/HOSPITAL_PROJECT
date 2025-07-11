<?php
session_start();
include("../db.php");

// Only admin can access
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login.php");
    exit;
}

$sql = "SELECT doctor_id, doctor_name, license_no, department, specialization FROM DoctorInformation";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Doctors</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <h2>Manage Doctors</h2>

  <?php if ($result->num_rows > 0): ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>License No</th>
        <th>Department</th>
        <th>Specialization</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row["doctor_id"]) ?></td>
        <td><?= htmlspecialchars($row["doctor_name"]) ?></td>
        <td><?= htmlspecialchars($row["license_no"]) ?></td>
        <td><?= htmlspecialchars($row["department"]) ?></td>
        <td><?= htmlspecialchars($row["specialization"]) ?></td>
      </tr>
      <?php endwhile; ?>
    </table>
  <?php else: ?>
    <p>No doctors found.</p>
  <?php endif; ?>

  <p class="back-link"><a href="dashboard.php">&larr; Back to Dashboard</a></p>
</body>
</html>
