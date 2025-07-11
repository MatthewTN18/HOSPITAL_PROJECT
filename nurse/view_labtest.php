<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "nurse") {
    header("Location: ../login.html");
    exit;
}

include("../db.php");

// Fetch all lab tests
$sql = "SELECT labtest_id, patient_name, type_of_test, doctors_instruction, date_requested FROM LabTest ORDER BY date_requested DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>View Lab Tests</title>
    <link rel="stylesheet" href="../css/form_views.css" />
</head>
<body>

  <h2>All Lab Tests</h2>

  <?php if ($result && $result->num_rows > 0): ?>
    <table>
      <thead>
        <tr>
          <th>Lab Test ID</th>
          <th>Patient Name</th>
          <th>Test Type</th>
          <th>Doctor's Instruction</th>
          <th>Date Requested</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($row["labtest_id"]); ?></td>
            <td><?php echo htmlspecialchars($row["patient_name"]); ?></td>
            <td><?php echo htmlspecialchars($row["type_of_test"]); ?></td>
            <td><?php echo htmlspecialchars($row["doctors_instruction"]); ?></td>
            <td><?php echo htmlspecialchars($row["date_requested"]); ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No lab tests found.</p>
  <?php endif; ?>

  <p class="back-link"><a href="dashboard.php">Back to Dashboard</a></p>

</body>
</html>
