<?php
session_start();
$con = mysqli_connect("localhost", "root", "Magazin2024", "social");

if(mysqli_connect_errno()){
    echo "Failed to connect: ".mysqli_connect_erno();
}

//Declaring variables to prevent errors
$fname = ""; //First name
$lname = ""; //Last name
$email = ""; //Email
$email2 = ""; //Email2
$password = ""; //Password
$password2 = ""; //Password2
$date = ""; //Sign up date
$error_array = ""; //Holds error messages

if(isset($_POST['register_button'])){

    //Registration form values

    //First name
    $fname = strip_tags($_POST['reg_fname']); //remove html tags
    $fname = str_replace(' ', '', $fname); //remove spaces
    $fname = ucfirst(strtolower($fname)); //uppercase first letter
    $_SESSION['reg_fname'] = $fname; //stores first name into session variable

    //Last name
    $lname = strip_tags($_POST['reg_lname']); //remove html tags
    $lname = str_replace(' ', '', $lname); //remove spaces
    $lname = ucfirst(strtolower($lname)); //uppercase first letter
    $_SESSION['reg_lname'] = $lname; //stores last name into session variable

    //Email
    $email = strip_tags($_POST['reg_email']); //remove html tags
    $email = str_replace(' ', '', $email); //remove spaces
    $email = ucfirst(strtolower($email)); //uppercase first letter
    $_SESSION['reg_email'] = $email; //stores email into session variable

    //Email2
    $email2 = strip_tags($_POST['reg_email2']); //remove html tags
    $email2 = str_replace(' ', '', $email2); //remove spaces
    $email2 = ucfirst(strtolower($email2)); //uppercase first letter
    $_SESSION['reg_email2'] = $email2; //stores email2 into session variable

    //Password
    $password = strip_tags($_POST['reg_password']); //remove html tags
    $password2 = strip_tags($_POST['reg_password2']); //remove html tags

    $date = date("Y-m-d"); //current date

    if($email == $email2) {
        //check if email is in valid format
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
              
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);    

            //check if email already exist
            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

            //count the number of rows returned
            $num_rows = mysqli_num_rows($e_check);

            if($num_rows > 0){
               echo "Email already in use"; 
            }
        }
        else{
            echo "Invalid format.";
        }
    }
    else{
        echo "Emails don't match.";
    }

    if(strlen($fname) > 25 || strlen($fname) < 2) {
        echo "Your first name must be between 2 and 25 characters";
    }

    if(strlen($lname) > 25 || strlen($lname) < 2) {
        echo "Your last name must be between 2 and 25 characters";
    }

    if($password != $password2) {
        echo "Your passwords do not match";
    }
    else {
        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            echo "Your password can only contain english characters or numbers";
        }
    }
    
    if(strlen($password > 30 || strlen($password) <5)) {
        echo "Your password must be between 5 and 30 characters";
    }
    

}
?>
<html>
<head>
    <title>Welcome to Swirlfeed</title>
</head>
<body>

    <form action="register.php" method="POST">
        <input type="text" name="reg_fname" placeholder="First Name" value="<?php 
        if(isset($_SESSION['reg_fname'])){
            echo $_SESSION['reg_fname'];
        }
        ?>" required>
        <br>
        <input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
        if(isset($_SESSION['reg_lname'])){
            echo $_SESSION['reg_lname'];
        }
        ?>" required>
        <br>
        <input type="email" name="reg_email" placeholder="Email" value="<?php 
        if(isset($_SESSION['reg_email'])){
            echo $_SESSION['reg_email'];
        }
        ?>" required>
        <br>
        <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
        if(isset($_SESSION['reg_email2'])){
            echo $_SESSION['reg_email2'];
        }
        ?>" required>
        <br>
        <input type="password" name="reg_password" placeholder="Password" required>
        <br>
        <input type="password" name="reg_password2" placeholder="Confirm Password" required>
        <br>
        <input type="submit" name="register_button" placeholder="Register" required>
        <br>
    </form>


</body>
</html>