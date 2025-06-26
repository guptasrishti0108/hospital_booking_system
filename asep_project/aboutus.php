<?php
session_start();

?>

<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   About Us - Ambulance Emergency
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            /* background-image:url(hospital.webp) ; */
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 10px 0;
            text-align: center;
            
        }
        header h1 {
            margin: 0;
            font-size: 2.5em;
            
        }
        .about-section {
            background-color: rgb(241, 230, 230);
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(191, 80, 80, 0.1);
            background-image:url(hospital.webp) ;
            
        }
        .about-section h2 {
            font-size: 2em;
            margin-bottom: 10px;
            
        }
        .about-section p {
            font-size: 1.2em;
            
            line-height: 1.6;
        }
        .team-section {
            margin-top: 40px;
        }
        .team-section h2 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        .team-member {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            background-color: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .team-member img {
            border-radius: 50%;
            margin-right: 20px;
        }
        .team-member h3 {
            margin: 0;
            font-size: 1.5em;
        }
        .team-member p {
            margin: 5px 0 0;
            font-size: 1em;
        }
        footer {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 40px;
        }
        footer p {
            margin: 0;
        }
  </style>
 </head>
 <body>
  <header>
   <h1>
    ABOUT THE TEAM
   </h1>
  </header>
  <div class="container">
   <div class="about-section">
    <h2>
     About Us
    </h2>
    <p>
     Welcome to Ambulance Emergency! We are dedicated to providing the fastest and most reliable emergency medical services. Our team of highly trained professionals is here to ensure that you receive the best care possible in times of need.
    </p>
    <p>
     Our mission is to save lives by providing prompt and efficient emergency medical services. We are equipped with state-of-the-art ambulances and medical equipment to handle any emergency situation.
    </p>
   </div>
   <div class="team-section">
    <h2>
     Meet Our Team
    </h2>
    <div class="team-member">
     <img alt="Portrait of KAUSTUBH GULWADE, GROUP LEADER AND BACKEND DEVELOPING MEMBER" height="100" src="kg.jpg" width="100"/>
     <div>
      <h3>
       KAUSTUBH GULWADE
      </h3>
      <p>
       GROUP LEADER AND BACKEND DEVELOPING MEMBER
      </p>
     </div>
    </div>
    <div class="team-member">
     <img alt="Portrait of SRISHTI GUPTA, ASSISTANT GROUP LEADER AND BACKEND DEVELOPING MEMBER" height="100" src="srishti.jpg" width="100"/>
     <div>
      <h3>
       SRISHTI GUPTA
      </h3>
      <p>
       ASSISTANT GROUP LEADER AND BACKEND DEVELOPING MEMBER
      </p>
     </div>
    </div>
    <div class="team-member">
     <img alt="Portrait of CHAITANYA HAPSE, GROUP MEMBER AND FRONTEND DEVELOPING MEMBER" height="100" src="photo chaitanya.jpg" width="100"/>
     <div>
      <h3>
       CHAITANYA HAPSE
      </h3>
      <p>
       GROUP MEMBER AND FRONTEND DEVELOPING MEMBER
      </p>
     </div>
    </div>
    <div class="team-member">
     <img alt="Portrait of RIYA GUPTA, GROUP MEMBER AND FRONTEND DEVELOPING MEMBER" height="100" src="WhatsApp Image 2024-12-19 at 18.26.48_24aab607.jpg" width="100"/>
     <div>
      <h3>
       RIYA GUPTA
      </h3>
      <p>
        GROUP MEMBER AND FRONTEND DEVELOPING MEMBER
      </p>
     </div>
    </div>
    <DIV>
        <div class="team-member">
            <img alt="Portrait of SWAPNIL GULBHILE , GROUP MEMBER AND FRONTEND DEVELOPING MEMBER" height="100" src="swapnil.jpg" width="100"/>
            <div>
             <h3>
              SWAPNIL GULBHILE
             </h3>
             <p>
               GROUP MEMBER AND FRONTEND DEVELOPING MEMBER
             </p>
            </div>
           </div>
    </DIV>
   </div>
  </div>
  <footer>
   <p>
    © 2024-2025 Ambulance Emergency. All rights reserved.
   </p>
  </footer>
 </body>
</html>