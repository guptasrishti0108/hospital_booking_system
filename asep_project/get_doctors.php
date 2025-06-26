<?php
session_start();
$conn = new mysqli('sql205.infinityfree.com', 'if0_38509947', 'I123456789c', 'if0_38509947_appointment_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['hospital_id'])) {
    $hospital_id = $_POST['hospital_id'];
    $query = "SELECT * FROM doctors WHERE hospital_id='$hospital_id'";
    $result = $conn->query($query);
    
    echo "<option value=''>Select Doctor</option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['id']}'>{$row['name']} - {$row['speciality']}</option>";
    }
}
?>