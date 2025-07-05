<?php
session_start();
?>


 <?php
$conn = mysqli_connect("localhost", "root", "", "appointment_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment Booking</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 10px; }
        input, select, button { width: 100%; margin: 10px 0; padding: 10px; }
        button { background-color: #28a745; color: white; border: none; cursor: pointer; }
    </style>
    <script>
        $(document).ready(function() {
            $("#hospital").change(function() {
                var hospital_id = $(this).val();
                $.ajax({
                    url: 'get_doctors.php',
                    type: 'POST',
                    data: {hospital_id: hospital_id},
                    success: function(response) {
                        $("#doctor").html(response);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h2>Book an Appointment</h2>
        <form action="book_appointment.php" method="POST">
            <input type="text" name="patient_name" placeholder="Enter Your Name" required>
            <select name="hospital_id" id="hospital" required>
                <option value="">Select Hospital</option>
                <?php
                $result = $conn->query("SELECT * FROM hospitals");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
            <select name="doctor_id" id="doctor" required>
                <option value="">Select Doctor</option>
            </select>
            <input type="date" name="appointment_date" required>
            <select name="slot" required>
                <option value="9AM-10AM">9AM - 10AM</option>
                <option value="10AM-11AM">10AM - 11AM</option>
                <option value="11AM-12PM">11AM-12PM</option>
                <option value="12PM-1PM">12PM-1PM</option>
                <option value="2PM-3PM">2PM-3PM</option>
                <option value="3PM-4PM">3PM-4PM</option>
                <option value="4PM-5PM">4PM-5PM</option>


            </select>
            <button type="submit">Book Appointment</button>
        </form>
        <p><a href="my_appointments.php">View My Appointments</a></p>
    </div>
</body>
</html>