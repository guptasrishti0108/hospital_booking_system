
<?php
session_start();
if (!isset($_SESSION['email'])){
    header("Location:register.php");
    exit();
}
?>

<?php
// Database connection without OOP
$conn = mysqli_connect("localhost","root", "", "appointment_db");

// Check if connection failed
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user email from SESSION
$email = $_SESSION['email'];

// Query to fetch all appointments based on email ID
$query = "
    SELECT a.patient_name, a.appointment_date, a.slot, d.name AS doctor_name, d.speciality, h.name AS hospital_name
    FROM appointments a
    JOIN doctors d ON a.doctor_id = d.id
    JOIN hospitals h ON a.hospital_id = h.id
    WHERE a.email = ?
    ORDER BY a.appointment_date DESC
";

// Prepare the statement
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color:rgb(22, 125, 215); color: white; }
        button { background-color: #007bff; color: white; border: none; cursor: pointer; padding: 10px; }
        a { text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>My Previous Appointments</h2>

        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <table>
                <tr>
                    <th>Patient Name</th>
                    <th>Date</th>
                    <th>Time Slot</th>
                    <th>Doctor</th>
                    <th>Speciality</th>
                    <th>Hospital</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['slot']); ?></td>
                        <td><?php echo htmlspecialchars($row['doctor_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['speciality']); ?></td>
                        <td><?php echo htmlspecialchars($row['hospital_name']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
            <br>
            <a href="index.php"><button>Back to Home</button></a>
        <?php else: ?>
            <p>No appointments found for your email ID.</p>
            <a href="index.php"><button>Back to Home</button></a>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>  