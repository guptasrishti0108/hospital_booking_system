<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Disease Details</title>
  <!-- Bootstrap CSS for styling -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      padding-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 id="disease-title" class="mt-4"></h2>
    <div id="details-card" class="card mt-3" style="display:none;">
      <div class="card-body">
        <h5 class="card-title">Medication</h5>
        <p class="card-text" id="medication"></p>
        <h5 class="card-title">Symptoms</h5>
        <p class="card-text" id="symptoms"></p>
        <h5 class="card-title">Possible Cure</h5>
        <p class="card-text" id="cure"></p>
      </div>
    </div>
    <div id="not-found" class="alert alert-warning mt-3" style="display:none;">
      Disease details not found.
    </div>
    <a href="index.php" class="btn btn-secondary mt-3">Back to Search</a>
  </div>
  
  <script>
    // Predefined data for the top 10 diseases
    const diseaseData = {
      "Diabetes": {
        "medication": "Insulin, Metformin",
        "symptoms": "Increased thirst, frequent urination, hunger, fatigue",
        "cure": "Lifestyle changes, medication management"
      },
      "Hypertension": {
        "medication": "ACE inhibitors, beta blockers",
        "symptoms": "Headaches, shortness of breath, nosebleeds",
        "cure": "Lifestyle modifications, medication"
      },
      "Cancer": {
        "medication": "Chemotherapy, Radiation therapy",
        "symptoms": "Fatigue, weight loss, pain, lumps",
        "cure": "Multimodal treatment: surgery, chemotherapy, radiation, immunotherapy"
      },
      "Influenza": {
        "medication": "Antiviral drugs (oseltamivir)",
        "symptoms": "Fever, cough, sore throat, muscle aches",
        "cure": "Rest, fluids, antiviral medication"
      },
      "COVID-19": {
        "medication": "Antivirals (Remdesivir), supportive care",
        "symptoms": "Fever, cough, loss of taste/smell, shortness of breath",
        "cure": "Vaccination, supportive treatment, antiviral drugs"
      },
      "Asthma": {
        "medication": "Inhaled bronchodilators, steroids",
        "symptoms": "Wheezing, shortness of breath, chest tightness",
        "cure": "Avoid triggers, inhalers, long-term control medications"
      },
      "Heart Disease": {
        "medication": "Statins, beta blockers, aspirin",
        "symptoms": "Chest pain, shortness of breath, fatigue",
        "cure": "Lifestyle changes, medication, possible surgery"
      },
      "Stroke": {
        "medication": "Clot-busting drugs (tPA)",
        "symptoms": "Sudden numbness, confusion, trouble speaking",
        "cure": "Immediate medical intervention, rehabilitation"
      },
      "Arthritis": {
        "medication": "NSAIDs, corticosteroids, DMARDs",
        "symptoms": "Joint pain, stiffness, swelling",
        "cure": "Physical therapy, medication, sometimes surgery"
      },
      "COPD": {
        "medication": "Bronchodilators, steroids, oxygen therapy",
        "symptoms": "Shortness of breath, chronic cough, mucus production",
        "cure": "Smoking cessation, inhalers, pulmonary rehabilitation"
      }
    };

    // Function to get a query parameter value by name
    function getQueryParam(param) {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(param);
    }
    
    document.addEventListener("DOMContentLoaded", function(){
      const disease = getQueryParam("disease");
      document.getElementById("disease-title").innerText = disease ? disease : "Disease Details";
      
      if(disease && diseaseData[disease]) {
        document.getElementById("medication").innerText = diseaseData[disease].medication;
        document.getElementById("symptoms").innerText = diseaseData[disease].symptoms;
        document.getElementById("cure").innerText = diseaseData[disease].cure;
        document.getElementById("details-card").style.display = "block";
      } else {
        document.getElementById("not-found").style.display = "block";
      }
    });
  </script>
</body>
</html>
