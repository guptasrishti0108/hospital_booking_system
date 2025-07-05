<?php
// booking_confirmation.php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: register.php");
    exit();
}
$email = $_SESSION['email'];

// Database connection

$conn = mysqli_connect("localhost", "root", "", "HospitalDB");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle new booking
$booking_made = false;
if (isset($_GET['hospital']) && isset($_GET['injury'])) {
    // Validate inputs
    $hospital_name = mysqli_real_escape_string($conn, $_GET['hospital']);
    $injury_type = mysqli_real_escape_string($conn, $_GET['injury']);
    
    if (!empty($hospital_name) && !empty($injury_type)) {
        $booking_time = date('Y-m-d H:i:s');
        
        // Insert booking
        $query = "INSERT INTO bookings (email, hospital_name, injury_type, booking_time) VALUES ('$email', '$hospital_name', '$injury_type', '$booking_time')";
        if (mysqli_query($conn, $query)) {
            $booking_made = true;
        }
    }
}

// Fetch bookings specific to the logged-in user
$bookings = [];
$query = "SELECT * FROM bookings WHERE email = '$email' ORDER BY booking_time DESC";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bookings[] = $row;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php if ($booking_made): ?>
        <div class="alert alert-success">
            <h4>Booking Confirmed! ✅</h4>
            <p>
                <strong>Hospital:</strong> <?= htmlspecialchars($_GET['hospital']) ?><br>
                <strong>Injury Type:</strong> <?= htmlspecialchars($_GET['injury']) ?><br>
                <strong>Booking Time:</strong> <?= date('M j, Y H:i:s') ?>
            </p>
        </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <h3>Your Booking History</h3>
            </div>
            <div class="card-body">
                <?php if (count($bookings) > 0): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Hospital</th>
                            <th>Injury Type</th>
                            <th>Booking Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?= htmlspecialchars($booking['hospital_name']) ?></td>
                            <td><?= htmlspecialchars($booking['injury_type']) ?></td>
                            <td><?= date('M j, Y H:i', strtotime($booking['booking_time'])) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="alert alert-info">
                    No previous bookings found.
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-3">
            <a href="index.php" class="btn btn-primary">Back</a>
        </div>
    </div>
</body>
</html>