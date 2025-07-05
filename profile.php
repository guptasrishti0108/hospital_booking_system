<?php
include 'config.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location:register.php");
    exit();
}

$email = $_SESSION['email'];
$query = "SELECT * FROM profile WHERE email='$email'";
$result = mysqli_query($con, $query);
$profile = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $medicalhistory = $_POST['medicalhistory'];
    $bloodgroup = $_POST['bloodgroup'];
    $gender = $_POST['gender'];

    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
        $filename = $_FILES['file']['name'];
        $tempfile = $_FILES['file']['tmp_name'];
        $folder = 'images/'.$filename;
        move_uploaded_file($tempfile, $folder);
    } else {
        $folder = $profile['profile_image'] ?? '';
    }

    if($profile) {
        $update = "UPDATE profile SET name='$name', age='$age', height='$height', weight='$weight', medical_history='$medicalhistory', blood_group='$bloodgroup', gender='$gender', profile_image='$folder' WHERE email='$email'";
        mysqli_query($con, $update);
    } else {
        $insert = "INSERT INTO profile (email,profile_image,  name, age, height, weight, medical_history, blood_group, gender) VALUES ('$email','$folder','$name', '$age', '$height', '$weight', '$medicalhistory', '$bloodgroup', '$gender')";
        mysqli_query($con, $insert);
    }
    header('Location: profile.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
        }

        .profile-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 600px;
            text-align: center;
            opacity: 0;
            transform: translateY(20px);
            animation: boxReveal 1s ease-out forwards;
        }

        @keyframes boxReveal {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-box h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            margin: 10px auto;
            background: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            overflow: hidden;
            border-radius: 5px;
            position: relative;
            transition: box-shadow 0.3s;
        }

        .profile-picture:hover {
            box-shadow: 0 0 10px #007bff;
        }

        .profile-picture img {
            width: 100%;
            height: auto;
        }

        .input-group {
            margin: 10px 0;
            position: relative;
        }

        .input-group input,
        .input-group select,
        .input-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            resize: none;
            transition: all 0.3s ease;
        }

        .input-group input:focus,
        .input-group select:focus,
        .input-group textarea:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .input-group label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            background: white;
            padding: 0 5px;
            color: #888;
            font-size: 14px;
            transition: all 0.3s;
            pointer-events: none;
        }

        .input-group input:focus+label,
        .input-group input:not(:placeholder-shown)+label,
        .input-group select:focus+label,
        .input-group select:not([value=""])+label,
        .input-group textarea:focus+label,
        .input-group textarea:not(:placeholder-shown)+label {
            top: -10px;
            font-size: 12px;
            color: #007bff;
        }

        .btn {
            padding: 10px 15px;
            font-size: 16px;
            color: white;
            background: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
   <form method="post" action="profile.php" enctype="multipart/form-data">
    <div class="profile-box">
        <h2>Profile Page</h2>
        <div class="profile-picture" id="profilePicture">
        <?php if(!empty($profile['profile_image'])) { ?>
        <img src="<?php echo $profile['profile_image']; ?>" alt="Profile Picture">
        <?php } else { ?>
        <span>Upload</span>
        <?php } ?>
     </div>
     <input type="file" name="file" id="fileInput" style="display: none;" accept="image/*">
        <div class="input-group">
            <input type="text"  name="name" id="name" placeholder=" " value="<?php echo htmlspecialchars($profile['name'] ?? ''); ?>" required>
            <label for="name">Name</label>
        </div>

        <div class="input-group">
            <input type="number"  name="age" id="age" placeholder=" " value="<?php echo htmlspecialchars($profile['age']??"");?>"required >
            <label for="age">Age</label>
        </div>

        <div class="input-group">
            <input type="number" name="height" id="height" placeholder=" " value="<?php echo htmlspecialchars($profile['height']??"");?>"required>
            <label for="height">Height (cm)</label>
        </div>

        <div class="input-group">
            <input type="number" name="weight" id="weight" placeholder=" " value="<?php echo htmlspecialchars($profile['weight']??"");?>"required>
            <label for="weight">Weight (kg)</label>
        </div>

        <div class="input-group">
            <textarea id="medicalHistory" name="medicalhistory" rows="4" placeholder=" " required><?php echo $profile['medical_history']??"";?></textarea>
            <label for="medicalHistory">Medical History</label>
        </div>

        <div class="input-group">
            <select id="bloodGroup" name="bloodgroup" placeholder=" " required>
               <option value="" disabled selected ></option>
               <option value="A+" <?php if (($profile['blood_group'] ?? '') == 'A+') echo 'selected'; ?>>A+</option>
               <option value="A-" <?php if (($profile['blood_group'] ?? '') == 'A-') echo 'selected'; ?>>A-</option>
               <option value="B+" <?php if (($profile['blood_group'] ?? '') == 'B+') echo 'selected'; ?>>B+</option>
               <option value="B-" <?php if (($profile['blood_group'] ?? '') == 'B-') echo 'selected'; ?>>B-</option>
               <option value="O+" <?php if (($profile['blood_group'] ?? '') == 'O+') echo 'selected'; ?>>O+</option>
               <option value="O-" <?php if (($profile['blood_group'] ?? '') == 'O-') echo 'selected'; ?>>O-</option>
               <option value="AB+" <?php if (($profile['blood_group'] ?? '') == 'AB+') echo 'selected'; ?>>AB+</option>
               <option value="AB-" <?php if (($profile['blood_group'] ?? '') == 'AB-') echo 'selected'; ?>>AB-</option>
            </select>
            <label for="bloodGroup">Blood Group</label>
        </div>

        <div class="input-group">
            <select id="gender" name="gender" placeholder=" " required>
                <option value="" disabled selected></option>
                <option value="Male" <?php if (($profile['gender'] ?? '') == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if (($profile['gender'] ?? '') == 'Female') echo 'selected'; ?>>Female</option>
                <option value="Other" <?php if (($profile['gender'] ?? '') == 'Other') echo 'selected'; ?>>Other</option>
            </select>
            <label for="gender">Gender</label>
        </div>
        <button class="btn" type="submit" name="submit">Save Profile</button>
        <button type="button" class="btn" onclick="window.location.href='index.php';">Back</button>
    </div>
    </form>
    <script>
        const profilePicture = document.getElementById('profilePicture');
        const fileInput = document.getElementById('fileInput');

        profilePicture.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    profilePicture.innerHTML = `<img src="${e.target.result}" alt="Profile Picture">`;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>

