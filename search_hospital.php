<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Hospital Finder</title>
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
        }

        /* Pop-up container */
        .popup {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50%;
            background: white;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            box-sizing: border-box;
            transition: transform 0.4s ease-in-out;
        }

        .popup.active {
            transform: translateY(0%);
        }

        /* Pop-up content */
        .popup h2 {
            margin: 0;
            color: #333;
        }

        .popup p {
            color: #555;
            margin: 10px 0 20px;
        }

        .popup input {
            padding: 10px;
            width: calc(100% - 22px);
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .popup .search-btn {
            padding: 10px 20px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .popup .search-btn:hover {
            background: #218838;
        }

        .popup .close-popup-btn {
            padding: 10px 20px;
            background: #ff4d4d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .popup .close-popup-btn:hover {
            background: #e60000;
        }
    </style>
</head>
<body>

    <div class="popup active" id="popup">
        <h2>Emergency Hospital Finder</h2>
        <p>Enter your location to find nearby hospitals with available beds:</p>
        <input type="text" placeholder="Enter your location" id="location-input">
        <button class="search-btn">Search Hospitals</button>
        <button class="close-popup-btn">Close</button>
    </div>

    <script>
        const popup = document.getElementById('popup');
        const closePopupBtn = popup.querySelector('.close-popup-btn');
        const searchBtn = popup.querySelector('.search-btn');

        // Close the pop-up
        closePopupBtn.addEventListener('click', () => {
            popup.classList.remove('active');
        });

        // Search button click event
        searchBtn.addEventListener('click', () => {
            const location = document.getElementById('location-input').value;
            if (location) {
                alert(`Searching hospitals near ${location}...`);
                // Add logic to search hospitals and display results
            } else {
                alert('Please enter a location.');
            }
        });

        // Optional: Close pop-up when clicking outside of it
        window.addEventListener('click', (event) => {
            if (event.target === popup) {
                popup.classList.remove('active');
            }
        });
    </script>
</body>
</html>
