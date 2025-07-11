<?php
session_start();
include("../db.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login.php");
    exit;
}

$sql = "SELECT nurse_id, nurse_name, license_no, department FROM NurseInformation";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Nurses</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <h2>Manage Nurses</h2>

  <?php if ($result->num_rows > 0): ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>License No</th>
        <th>Department</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row["nurse_id"]) ?></td>
        <td><?= htmlspecialchars($row["nurse_name"]) ?></td>
        <td><?= htmlspecialchars($row["license_no"]) ?></td>
        <td><?= htmlspecialchars($row["department"]) ?></td>
      </tr>
      <?php endwhile; ?>
    </table>
  <?php else: ?>
    <p>No nurses found.</p>
  <?php endif; ?>

  <p class="back-link"><a href="dashboard.php">&larr; Back to Dashboard</a></p>
</body>
</html>
