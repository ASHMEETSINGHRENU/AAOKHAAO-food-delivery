<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $username = $_POST["loginusername"];
    $password = $_POST["loginpassword"]; 
    
    $sql = "Select * from tbl_users where username='$username'"; 
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $row=mysqli_fetch_assoc($result);
        $userId = $row['id'];
        if (password_verify($password, $row['password'])){ 
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['userId'] = $userId;

            echo "<script>
                  alert('You are Log-In Successfully');
                  window.location.href = '/food-ordering-system/index.php';
                  </script>";
            exit();
        } 
        else{
            echo "<script>alert('You have entered wrong password!');
                    window.history.back(1);
                    </script>";
        }
    } 
    else{
        echo "<script>alert('User name does not exists!');
                    window.history.back(1);
                    </script>";
    }
}    
?>