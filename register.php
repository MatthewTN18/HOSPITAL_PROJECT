<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Check if username exists
    $stmt = $conn->prepare("SELECT user_id FROM UserAccount WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        die("Registration failed: Username already exists.");
    }
    $stmt->close();

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $linked_patient_id = null;
    $linked_doctor_id = null;
    $linked_nurse_id = null;

    if ($role === "patient") {
        $patient_id = uniqid("PAT");
        $patient_name = $_POST["patient_name"] ?? "Unknown Patient";
        $dob = $_POST["date_of_birth"] ?? date('Y-m-d');
        $gender = $_POST["gender"] ?? "other";

        $stmt = $conn->prepare("INSERT INTO PatientInformation (patient_id, patient_name, date_of_birth, gender) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $patient_id, $patient_name, $dob, $gender);
        if (!$stmt->execute()) {
            die("Registration failed: Unable to insert patient record. " . $stmt->error);
        }
        $linked_patient_id = $patient_id;
        $stmt->close();

    } elseif ($role === "doctor") {
        $doctor_name = $_POST["doctor_name"] ?? "Unknown Doctor";
        $license_no = $_POST["license_no"] ?? uniqid("LIC");
        $department = $_POST["department"] ?? "general";
        $specialization = $_POST["specialization"] ?? "General";

        $stmt = $conn->prepare("SELECT doctor_id FROM DoctorInformation WHERE license_no = ?");
        $stmt->bind_param("s", $license_no);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            die("Registration failed: License number already exists.");
        }
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO DoctorInformation (doctor_name, license_no, department, specialization) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $doctor_name, $license_no, $department, $specialization);
        if (!$stmt->execute()) {
            die("Registration failed: Unable to insert doctor record. " . $stmt->error);
        }
        $linked_doctor_id = $conn->insert_id;
        $stmt->close();

    } elseif ($role === "nurse") {
        $nurse_name = $_POST["nurse_name"] ?? "Unknown Nurse";
        $license_no = $_POST["license_no"] ?? uniqid("LIC");
        $department = $_POST["department"] ?? "general";

        $stmt = $conn->prepare("SELECT nurse_id FROM NurseInformation WHERE license_no = ?");
        $stmt->bind_param("s", $license_no);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            die("Registration failed: License number already exists.");
        }
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO NurseInformation (nurse_name, license_no, department) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nurse_name, $license_no, $department);
        if (!$stmt->execute()) {
            die("Registration failed: Unable to insert nurse record. " . $stmt->error);
        }
        $linked_nurse_id = $conn->insert_id;
        $stmt->close();

    } elseif ($role === "admin") {
        // ✅ No linked records needed for admin
        // You could add extra checks here if needed
        // Nothing to insert in other tables
    } else {
        die("Invalid role selected.");
    }

    $stmt = $conn->prepare("INSERT INTO UserAccount (username, password, role, linked_patient_id, linked_doctor_id, linked_nurse_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss",
        $username,
        $hashed_password,
        $role,
        $linked_patient_id,
        $linked_doctor_id,
        $linked_nurse_id
    );

    if ($stmt->execute()) {
        echo "Registration successful. <a href='login.php'>Login here</a>";
    } else {
        echo "Registration failed: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Invalid request.";
}
?>
