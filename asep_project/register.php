
<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Signup'])) {
        $name=$_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword =  $_POST['confirm_password'];

        // Check if email already exists
        $emailquery = "SELECT * FROM signin WHERE email='$email'";
        $query = mysqli_query($con, $emailquery);
        $emailcount = mysqli_num_rows($query);

        if ($emailcount > 0) {
            ?>
            <script>alert("Email already exists")</script>
         <?php   

        } else {
            if ($password === $cpassword) {
                $pass = password_hash($password, PASSWORD_BCRYPT);
                
                $insertquery = "INSERT INTO signin (name,email, password ,cpassword) VALUES ('$name',$email', '$pass','$cpassword')";
                $check = mysqli_query($con, $insertquery);
                
                if ($check) {
                    
                    
                } else {
                    ?>
                    <script>alert('Error inserting data')</script>
                 <?php   
                    
                }
            } else {
                ?>
                <script>alert( "Passwords do not match")</script>
             <?php   
                
            }
        }
    }

    if (isset($_POST['Login'])) {
        $emaill = $_POST['email'];
        $passwordl =  $_POST['password'];
        $email_search = "SELECT * FROM signin WHERE email='$emaill'";
        $query = mysqli_query($con, $email_search);
        $email_pass=mysqli_fetch_assoc($query);
        $db_email=$email_pass['email'];
        $db_pass=$email_pass['password'];
        if ($emaill==$db_email){
            $_SESSION['email']=$db_email;
            $_SESSION['name'] = $name;
           if(password_verify($passwordl,$db_pass)){
          ?>
           <script>location.replace('index.php')</script>
         <?php
        } else {
            ?>
            <script>alert("Incorrect password")</script>
         <?php   
        }
    } else {
        ?>
        <script>alert("Invalid email")</script>
        <?php   
    }
  
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar with Indicator</title>
    <!-- CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    @import url("https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap");
    body {
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        color: #222;
        padding: 0px;
        margin: 0px;
        box-sizing: border-box;
        background-size: 100vw 100vh;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 340px;
    }

    * {
        box-sizing: border-box;
    }
    *::before,
    *::after {
        box-sizing: border-box;
    }

    .profile-container {
        background-color: white;
        padding: 35px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 400px;
    }

    .main {
        width: 340px;
        height: 400px;
        background: white;
        border-radius: 3px;
        padding: 30px;
        position: relative;
        display: flex;
    }
    .form_wrapper {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
    .tile {
        text-align: center;
        margin-bottom: 20px;
        width: 100%;
        overflow: hidden;
    }
    .tile h3 {
        font-size: 22px;
        margin: 0px;
        transition: all 0.3s ease;
    }
    .radio {
        display: none;
    }
    .tab {
        width: 50%;
        border: solid 2px #f1f1f1;
        height: 40px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        margin-bottom: 20px;
        font-weight: 500;
        transition: color 0.3s ease;
        user-select: none;
    }
    .login_tab {
        border-right: none;
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }
    .signup_tab {
        border-left: none;
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    .shape {
        background: linear-gradient(45deg, #22c2fc, #14a2c5) no-repeat center;
        width: 50%;
        height: calc(40px - 1px);
        border-radius: 5px;
        position: absolute;
        top: 55.5px;
        left: 0px;
        opacity: 0.9;
        transition: all 0.4s ease;
    }
    .shape:hover {
        background: linear-gradient(-45deg, #22c2fc, #14a2c5) no-repeat center;
    }
    #login:checked ~ .shape {
        left: 0px;
    }
    #login:checked ~ .login_tab {
        border-color: transparent;
        z-index: 1;
        color: white;
    }
    #login:checked ~ .tile .signup {
        display: none;
    }
    #login:checked ~ .form_wrap {
        transform: translateX(0);
    }
    #login:checked ~ .form_wrap .signup_form {
        opacity: 0;
    }
    #signup:checked ~ .shape {
        left: 50%;
    }
    #signup:checked ~ .signup_tab {
        border-color: transparent;
        z-index: 1;
        color: white;
    }
    #signup:checked ~ .tile .login {
        display: none;
    }
    #signup:checked ~ .form_wrap {
        transform: translateX(-100%);
    }
    #signup:checked ~ .form_wrap .login_form {
        opacity: 0;
    }
    a {
        color: #22c2fc;
        text-decoration: none;
        transition: all 0.3s linear;
    }
    a:hover {
        color: #14a2c5;
    }
    .form_wrap {
        display: flex;
        width: 100%;
        flex: 0 0 100%;
        transition: transform 0.3s ease, opacity 0.2s ease;
    }
    .form_fild {
        width: 100%;
        flex: 0 0 100%;
        transition: all 0.5s ease;
    }
    .input_group {
        width: 100%;
        margin-bottom: 12px;
    }
    .input {
        border: solid #f1f1f1 2px;
        border-radius: 5px;
        width: 100%;
        height: 40px;
        padding: 5px 10px;
        font-size: 15px;
        font-weight: 500;
        outline: none;
        transition: all 0.3s linear;
    }
    .input::placeholder {
        color: #adadad;
    }
    .input:hover {
        border-color: rgba(248, 66, 151, 0.3);
    }
    .input:focus {
        border-color: rgba(248, 66, 151, 0.3);
    }
    .forgot {
        display: block;
        margin-bottom: 15px;
        padding: 0px 2px;
    }
    .btn {
        width: 100%;
        height: 40px;
        margin-bottom: 20px;
        border: none;
        outline: none;
        font-size: 16px;
        font-weight: 500;
        letter-spacing: 0.8px;
        color: white;
        background: linear-gradient(45deg, #22c2fc, #14a2c5) no-repeat center;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s linear;
    }
    .btn:hover {
        background: linear-gradient(-45deg, #22c2fc, #14a2c5) no-repeat center;
    }
    .btn:active {
        transform: scale(0.95);
    }
    .not_mem {
        text-align: center;
    }
    .not_mem label {
        pointer-events: none;
    }
    .not_mem label span {
        pointer-events: all;
        color:  #14a2c5;
        text-decoration: none;
        transition: all 0.3s linear;
    }
    .not_mem label span:hover {
        color: #22c2fc;
    }
</style>

<body>
    <section class="main">
        <div class="form_wrapper">
            <input type="radio" class="radio" name="radio" id="login" checked />
            <input type="radio" class="radio" name="radio" id="signup" />
            <div class="tile">
                <h3 class="login">Login Form</h3>
                <h3 class="signup">Signup Form</h3>
            </div>

            <label class="tab login_tab" for="login">
                Login
            </label>

            <label class="tab signup_tab" for="signup">
                Signup
            </label>
            <span class="shape"></span>
            <div class="form_wrap">
                <div class="form_fild login_form">
                  <form method="post" >
                    <div class="input_group" >
                        <input type="email" name="email" class="input" placeholder="Email Address" />
                    </div>
                    <div class="input_group">
                        <input type="password" name="password" class="input" placeholder="Password" />
                    </div>
                    <input type="submit" class="btn"  name="Login" value="Login" />
                    <div class="not_mem">
                        <label for="signup">Not a member? <span>Signup now</span></label>
                    </div>
                  </form>
                </div>
                <div class="form_fild signup_form">
                  <form method="post" action="register.php">
                    <div class="input_group" >
                        <input type="text" name="name" class="input" placeholder="Username" />
                    </div>
                    <div class="input_group">
                        <input type="email" name="email" class="input" placeholder="Email Address" />
                    </div>
                    <div class="input_group">
                        <input type="password" name="password" class="input" placeholder="Password" />
                    </div>
                    <div class="input_group">
                        <input type="password" name="confirm_password" class="input" placeholder="Confirm Password" />
                    </div>
                    <input type="submit" class="btn" name="Signup" value="Signup" />
                  </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>


