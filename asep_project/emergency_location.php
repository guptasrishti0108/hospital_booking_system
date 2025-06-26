<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Emergency Details</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f5f7fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container-box {
      background: white;
      border-radius: 10px;
      padding: 40px;
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
      max-width: 1100px;
      width: 100%;
      display: flex;
      flex-direction: row;
    }

    .left-section {
      flex: 1.5;
      padding-right: 30px;
    }

    .right-section {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      border-left: 1px solid #ddd;
      padding-left: 30px;
    }

    h2 {
      color: #0d6efd;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
    }

    input, select {
      width: 100%;
      padding: 12px;
      margin: 12px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .btn-custom {
      background-color: #0d6efd;
      color: white;
      width: 100%;
      padding: 12px;
      border-radius: 5px;
      font-size: 18px;
      margin-top: 20px;
    }

    .btn-custom:hover {
      background-color: #0b5ed7;
    }

    /* Video Styling */
    .right-section video {
      max-width: 100%;
      border-radius: 10px;
    }

    /* Suggestions Dropdown */
    #suggestions {
      border: 1px solid #ccc;
      max-height: 200px;
      overflow-y: auto;
      margin-top: 5px;
      border-radius: 5px;
      background: white;
      position: absolute;
      width: calc(100% - 24px);
      z-index: 1000;
    }

    .suggestion {
      padding: 8px;
      cursor: pointer;
      border-bottom: 1px solid #eee;
    }

    .suggestion:hover {
      background-color: #f0f0f0;
    }
  </style>
</head>

<body>
  <div class="container-box">
    <!-- Left Section: Form -->
    <form action="hospital_lists.php" method="GET">
      <div class="left-section">
        <h2><strong>ENTER YOUR EMERGENCY DETAILS</strong></h2>

        <div class="form-group position-relative">
          <label for="locationInput"><strong>Enter Your Location:</strong></label>
          <input type="text" id="locationInput" name="location" class="form-control" placeholder="Type your location..." autocomplete="off">
          <input type="hidden" id="latitude" name="latitude">
          <input type="hidden" id="longitude" name="longitude">
          <div id="suggestions" class="list-group"></div>
        </div>

        <div class="form-group">
          <label for="injury"><strong>Where are you hurt?</strong></label>
          <select id="injury" name="injury" class="form-control">
            <option value="" disabled selected>Select an injury part</option>
            <option value="head">Head</option>
            <option value="eye">Eye</option>
            <option value="neck">Neck</option>
            <option value="chest">Chest</option>
            <option value="abdomen">Abdomen</option>
            <option value="arm">Arm</option>
            <option value="leg">Leg</option>
            <option value="full body ">full body</option>
          </select>
        </div>

        <button type="submit" class="btn btn-custom">Find Hospitals</button>
      </div>
    </form>

    <!-- Right Section: Video -->
    <div class="right-section">
      <video loop muted autoplay>
        <source src="Screen Recording 2025-02-27 234312.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      const locationInput = $("#locationInput");
      const suggestionsDiv = $("#suggestions");

      function debounce(func, delay) {
        let timeout;
        return function(...args) {
          clearTimeout(timeout);
          timeout = setTimeout(() => func.apply(this, args), delay);
        };
      }

      function fetchSuggestions(query) {
        if (query.length < 3) {
          suggestionsDiv.html('');
          return;
        }

        const apiKey = 'pk.9d70d4abd0dd986062058532456829b0';
        const url = `https://us1.locationiq.com/v1/search.php?key=${apiKey}&q=${encodeURIComponent(query)}&format=json&limit=5`;

        fetch(url)
          .then(response => response.json())
          .then(data => {
            suggestionsDiv.html('');
            data.forEach(place => {
              const div = `<div class='suggestion list-group-item' data-lat='${place.lat}' data-lon='${place.lon}'>${place.display_name}</div>`;
              suggestionsDiv.append(div);
            });

            $(".suggestion").click(function() {
              locationInput.val($(this).text());
              $("#latitude").val($(this).attr('data-lat'));
              $("#longitude").val($(this).attr('data-lon'));
              suggestionsDiv.html('');
            });
          })
          .catch(error => console.error('Error fetching suggestions:', error));
      }

      const debouncedFetchSuggestions = debounce(function() {
        fetchSuggestions(locationInput.val());
      }, 500);

      locationInput.on("input", debouncedFetchSuggestions);

      // Hide suggestions when clicking outside
      $(document).click(function(event) {
        if (!$(event.target).closest("#locationInput, #suggestions").length) {
          suggestionsDiv.html('');
        }
      });
    });
  </script>
</body>
</html>

