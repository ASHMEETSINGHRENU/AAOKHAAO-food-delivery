<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $username = $_POST["username"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    // Check whether this username exists
    $existSql = "SELECT * FROM `tbl_users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        echo "<script>alert('Username Already Exists!');
                    window.history.back();
                    </script>";
    }
    else{
      if(($password == $cpassword)){
          $hash = password_hash($password, PASSWORD_DEFAULT);
          $sql = "INSERT INTO `tbl_users` ( `username`, `firstName`, `lastName`, `email`, `phone`, `password`, `joinDate`) VALUES ('$username', '$firstName', '$lastName', '$email', '$phone', '$hash', current_timestamp())";   
          $result = mysqli_query($conn, $sql);
          if ($result){
              $showAlert = true;
              echo "<script>alert('Registration successful. Please proceed to log in to your account.');
                     window.location.href = '/food-ordering-system/index.php';
                    </script>";
          }
      }
      else{
          echo "<script>alert('Passwords do not match!');
                    window.history.back();
                    </script>";
      }
    }
}
    
?>