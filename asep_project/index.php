<?php
session_start();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INSTANT BED RESERVER</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      scroll-behavior: smooth;
    }
    body {
      font-family:'Times New Roman', Times, serif;
      background-color: #d3e5f6;
    }
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background-color: #fff;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      transition: background-color 0.3s;
    }
    .logo {
      font-size: 45px;
      font-weight: bold;
      color: #a80505;
      cursor: pointer;
      margin-right:450px;
      font-family: "Stencilitis";
    }
    nav ul {
      list-style: none;
      display: flex;
      font-size: 18px;
    }
    nav ul li {
      margin: 0 15px;
    }
    nav ul li a {
      text-decoration: none;
      color: black;
      font-weight: bold;
      transition: color 0.3s;
    }
    nav ul li a:hover {
      color: #4c8cf2;
    }
    button {
      background-color: #0b7dc9dc;
      font-size: 18px;
      height:32px;
      align-items: center;
      margin-top:-8px;
      border-radius: 20px;
      box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.6); 
      transition: box-shadow 0.3s ease-in-out; 
    }
    .search-bar {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 30px;
      position: relative;
    }
    .search-bar input {
      padding: 10px;
      width: 60%;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .search-suggestions {
      position: absolute;
      top: 45px;
      background: white;
      width: 60%;
      max-height: 300px;
      overflow-y: auto;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      z-index: 1000;
      display: none;
    }
    .suggestion-item {
      padding: 10px;
      cursor: pointer;
      transition: background 0.3s;
    }
    .suggestion-item:hover {
      background: #f0f0f0;
    }
    .services {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 30px;
      background-color: rgb(244, 250, 251);
      padding: 20px;
    }
    .service {
      width: 250px;
      text-align: center;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }
    .service:hover {
      transform: scale(1.05);
    }
    .service img {
      width: 100px;
    }
    footer {
      text-align: center;
      padding: 20px;
      background-color: #0b7dc9dc;
      color: rgb(3, 1, 1);
      margin-top: 200px;
    }
  </style>
</head>
<body>
  <header>
    <img src="logo.jpeg" width="5%" height="5%">
    <div class="logo" onclick="scrollToTop()">InstDoc</div>
    <nav>
      <ul>
        <li><a href="my_appointments.php">BOOK APPOINTMENT</a></li>
        <li><a href="booking_confirmation.php">EMERGENCY</a></li>
        <li><a href="profile.php">PROFILE</a></li>
        <li><a href="aboutus.php">ABOUT US</a></li>
        <?php
          if (isset($_SESSION['email'])) {
              echo '<button><li><a href="logout.php">Logout</a></li></button>';
          } else {
              echo '<button><li><a href="register.php">Login / Signup</a></li></button>';
          }
        ?>
      </ul>
    </nav>
  </header>
  
  <div class="search-bar">
    <!-- Changed onkeyup to call showSuggestions() and added a container for suggestions -->
    <input type="text" id="search-input" placeholder="Search disease" onkeyup="showSuggestions()">
    <div id="searchSuggestions" class="search-suggestions"></div>
  </div>
  
  <div class="services">
    <div class="service" onclick="window.location.href='emergency_location.php'">
      <img src="EMERGENCY.jpg" alt="Emergency">
      <h3>EMERGENCY</h3>
      <p>For Emergency Situations</p>
    </div>
    <div class="service" onclick="window.location.href='doc_appointment.php'">
      <img src="DOCTOR.png" alt="searching hospitals">
      <h3>BOOK APPOINTMENT</h3>
      <p>Book your appointment now</p>
    </div>
    <div class="service" onclick="window.location.href='call_ambulance.php'">
      <img src="ambulance-design_24908-54589.avif" alt="Call Ambulance">
      <h3>CALL AMBULANCE</h3>
      <p>Safe and trusted Ambulance Services</p>
    </div>
  </div>
  
  <footer>
    <div style="margin-top: 8px">
      <h3>Follow us on :</h3>
      <br>
      <a href="https://www.instagram.com" target="_blank" style="margin: 0 10px">
        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" width="30" height="30"/>
      </a>
      <a href="https://www.whatsapp.com" target="_blank" style="margin: 0 10px">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" width="30" height="30"/>
      </a>
      <a href="https://www.linkedin.com" target="_blank" style="margin: 0 10px">
        <img src="https://upload.wikimedia.org/wikipedia/commons/c/ca/LinkedIn_logo_initials.png" alt="LinkedIn" width="30" height="30"/>
      </a>
      <br><br>
      <p>&copy; 2025 InstDoc. All Rights Reserved.</p>
    </div>
  </footer>
  
  <script>
    // Disease data
    const diseases = [
      "Diabetes", "Hypertension", "Cancer", "Influenza",
      "COVID-19", "Asthma", "Heart Disease", "Stroke",
      "Arthritis", "COPD"
    ];
  
    function showSuggestions() {
      const input = document.getElementById("search-input").value.toLowerCase();
      const suggestions = document.getElementById("searchSuggestions");
      suggestions.innerHTML = '';
  
      if (input.length > 0) {
        const filtered = diseases.filter(disease => 
          disease.toLowerCase().includes(input)
        ).slice(0, 10);
  
        filtered.forEach(disease => {
          const div = document.createElement('div');
          div.className = 'suggestion-item';
          div.textContent = disease;
          div.onclick = () => selectDisease(disease);
          suggestions.appendChild(div);
        });
  
        suggestions.style.display = 'block';
      } else {
        suggestions.style.display = 'none';
      }
    }
  
    function selectDisease(disease) {
      document.getElementById("search-input").value = disease;
      document.getElementById("searchSuggestions").style.display = 'none';
      // Redirect to disease details page
      window.location.href = `disease_details.php?disease=${encodeURIComponent(disease)}`;
    }
  
    // Close suggestions when clicking outside
    document.addEventListener('click', (e) => {
      if (!e.target.closest('.search-bar')) {
        document.getElementById("searchSuggestions").style.display = 'none';
      }
    });
  </script>
</body>
</html>