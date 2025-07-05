<?php
session_start();
?>



<?php
// hospital_lists.php

// Retrieve GET parameters from the form
$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];
$injury = $_GET['injury'];
$location = $_GET['location']; // To display the user's location

// Convert the injury type to match the database (capitalize first letter)
$injury = ucfirst(strtolower($injury));

// Database connection parameters – update these with your credentials


// Create connection to the database
$conn = mysqli_connect("localhost", "root", "", "HospitalDB");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query that calculates distance using the Haversine formula (in kilometers)
// and fetches the nearest 5 hospitals with the matching speciality.
$query = "SELECT id, name, latitude, longitude, speciality,
          (6371 * acos( cos( radians(?) ) * cos( radians(latitude) ) 
          * cos( radians(longitude) - radians(?) ) + sin( radians(?) ) * sin( radians(latitude) ) )) AS distance
          FROM hospitals
          WHERE speciality = ?
          ORDER BY distance
          LIMIT 5";

$stmt = $conn->prepare($query);
$stmt->bind_param("ddds", $latitude, $longitude, $latitude, $injury);
$stmt->execute();
$result = $stmt->get_result();

$hospitals = [];
while ($row = $result->fetch_assoc()) {
    $hospitals[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Nearest Hospitals for <?php echo htmlspecialchars($injury); ?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    .card {
      margin-bottom: 20px;
      cursor: pointer;
    }
    /* Half-screen popup styles */
    #hospitalDetailsPopup {
      position: fixed;
      bottom: -50vh; /* Initially hidden below the viewport */
      left: 0;
      width: 100%;
      height: 50vh;
      background-color: #fff;
      box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.5);
      transition: bottom 0.5s ease-in-out;
      z-index: 1050;
      padding: 20px;
      overflow-y: auto;
    }
    #hospitalDetailsPopup.show {
      bottom: 0;
    }
    #hospitalDetailsPopup .close-btn {
      font-size: 24px;
      float: right;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="mt-4">Nearest Hospitals for <?php echo htmlspecialchars($injury); ?></h1>
    <p>Your Location: <?php echo htmlspecialchars($location); ?></p>
    <div class="row">
      <?php if (count($hospitals) > 0): ?>
        <?php foreach ($hospitals as $hospital): ?>
          <div class="col-md-4">
            <div class="card" onclick="showHospitalDetails('<?php echo addslashes($hospital['name']); ?>', <?php echo round($hospital['distance'], 2); ?>)">
              <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($hospital['name']); ?></h5>
                <p class="card-text">
                  Speciality: <?php echo htmlspecialchars($hospital['speciality']); ?><br>
                  Distance: <?php echo round($hospital['distance'], 2); ?> km<br>
                  Coordinates: (<?php echo $hospital['latitude']; ?>, <?php echo $hospital['longitude']; ?>)
                </p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No hospitals found for the selected injury type.</p>
      <?php endif; ?>
    </div>
    <a href="emergency_location.php" class="btn btn-secondary">New Search</a>
  </div>

  <!-- Half-screen popup for Hospital Details -->
  <div id="hospitalDetailsPopup">
    <span class="close-btn" onclick="hideHospitalDetails()">&times;</span>
    <h3 id="popupHospitalName"></h3>
    <p id="popupDistance"></p>
    <p id="popupBeds"></p>
    <p id="popupDoctors"></p>
    <button class="btn btn-primary" onclick="bookNow()">Book Now</button>
  </div>

  <!-- Include jQuery and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script>
    // Sample doctor names array
    const doctorNames = ["Dr. Smith", "Dr. Johnson", "Dr. Williams", "Dr. Brown", "Dr. Jones", "Dr. Miller", "Dr. Davis"];

    // Function to show hospital details in the half-screen popup
    function showHospitalDetails(hospitalName, distance) {
      // Generate a random number of beds between 0 and 15
      const bedsAvailable = Math.floor(Math.random() * 16);
      
      // Generate a random number of doctors between 0 and 5
      const numDoctors = Math.floor(Math.random() * 6);
      let doctorsInfo = "";
      if (numDoctors > 0) {
        // Shuffle doctorNames and pick the first numDoctors names
        let shuffled = doctorNames.sort(() => 0.5 - Math.random());
        let selected = shuffled.slice(0, numDoctors);
        doctorsInfo = "Doctors Available: " + selected.join(', ');
      } else {
        doctorsInfo = "No doctors available.";
      }

      // Update the popup content
      document.getElementById("popupHospitalName").innerText = hospitalName;
      document.getElementById("popupDistance").innerText = "Distance: " + distance + " km";
      document.getElementById("popupBeds").innerText = "Beds Available: " + bedsAvailable;
      document.getElementById("popupDoctors").innerText = doctorsInfo;

      // Slide the half-screen popup up
      document.getElementById("hospitalDetailsPopup").classList.add("show");
    }

    // Function to hide the half-screen popup
    function hideHospitalDetails() {
      document.getElementById("hospitalDetailsPopup").classList.remove("show");
    }

    // Function to simulate booking confirmation
    function bookNow() {
      const hospitalName = document.getElementById("popupHospitalName").innerText;
      const injuryType = "<?php echo $injury; ?>"; // Get injury type from PHP
    
      // Redirect to confirmation page with parameters
      window.location.href = `booking_confirmation.php?hospital=${encodeURIComponent(hospitalName)}&injury=${encodeURIComponent(injuryType)}`;
    }
  </script>
</body>
</html>
