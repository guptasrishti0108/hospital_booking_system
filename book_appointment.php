
<?php
session_start();  
if (!isset($_SESSION['email'])){
  header("Location:register.php");
  exit();
}
$email=$_SESSION['email'];
$conn = mysqli_connect("localhost", "root", "", "appointment_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_name = $_POST['patient_name'];
    $doctor_id = $_POST['doctor_id'];
    $hospital_id = $_POST['hospital_id'];
    $appointment_date = $_POST['appointment_date'];
    $slot = $_POST['slot'];

    // Check if the slot is available
    $check_query = "SELECT * FROM appointments WHERE doctor_id='$doctor_id' AND hospital_id='$hospital_id' AND appointment_date='$appointment_date' AND slot='$slot'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "<script>alert('Slot already booked! Choose a different slot.'); window.location.href='doc_appointment.php';</script>";
    } else {
        // Insert appointment
        $query = "INSERT INTO appointments (email,patient_name, doctor_id, hospital_id, appointment_date, slot) 
                  VALUES ('$email','$patient_name', '$doctor_id', '$hospital_id', '$appointment_date', '$slot')";
        if ($conn->query($query) === TRUE) {
            echo "<script>alert('Appointment booked successfully!'); window.location.href='doc_appointment.php';</script>";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }
}
?>
