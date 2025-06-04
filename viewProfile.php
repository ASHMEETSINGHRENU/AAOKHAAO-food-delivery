<?php
require_once 'inner-header.php';
?>
    <style>
        
        #notfound {
        position: relative;
        height: 89vh;
        background-color: aliceblue;
        }

        #notfound .notfound {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        }

        .notfound {
        max-width: 410px;
        width: 100%;
        text-align: center;
        }

        .notfound .notfound-404 {
        height: 280px;
        position: relative;
        z-index: -1;
        }

        .notfound .notfound-404 h1 {
        font-family: 'Montserrat', sans-serif;
        font-size: 230px;
        margin: 0px;
        font-weight: 900;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        background: url('img/bg.jpg') no-repeat;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-size: cover;
        background-position: center;
        }


        .notfound h2 {
        font-family: 'Montserrat', sans-serif;
        color: #000;
        font-size: 24px;
        font-weight: 700;
        text-transform: uppercase;
        margin-top: 0;
        }


        .notfound a {
        font-family: 'Montserrat', sans-serif;
        font-size: 14px;
        text-decoration: none;
        text-transform: uppercase;
        background: #0046d5;
        display: inline-block;
        padding: 15px 30px;
        border-radius: 40px;
        color: #fff;
        font-weight: 700;
        box-shadow: 0px 4px 15px -5px #0046d5;
        }


        @media only screen and (max-width: 767px) {
            .notfound .notfound-404 {
            height: 142px;
            }
            .notfound .notfound-404 h1 {
            font-size: 112px;
            }
        }

        .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        }

        button.btn.upload {
        border: 2px solid gray;
        background-color: #bababa;
        border-radius: 8px;
        font-size: 10px;
        font-weight: bold;
        }

        .upload-btn-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        }
    </style>
    <?php require_once 'partials/_dbconnect.php';?>
    
    <?php
        if($loggedin) {
    ?>
    <div class="contact-from-section mt-150 mb-150">
    <div class="container">
        <?php 
            $sql = "SELECT * FROM tbl_users WHERE id='$userId'"; 
            $result = mysqli_query($conn, $sql);
            $row=mysqli_fetch_assoc($result);
            $username = $row['username'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $email = $row['email'];
            $phone = $row['phone'];
            $userType = $row['userType'];
            if($userType == 0) {
                $userType = "User";
            }
            else {
                $userType = "Admin";
            }

        ?>
        <div class="row">
            <div class="jumbotron p-3 mb-3" style="display: flex;justify-content: center;width: 28%;border-radius: 50px;margin: 0 auto;">
                <div class="user-info">
                    <img class="rounded-circle mb-3 bg-dark" src="img/person-<?php echo $userId; ?>.jpg" onError="this.src = 'img/profilePic.jpg'" style="width:215px;height:215px;padding:1px;">
                    <form action="partials/_manageProfile.php" method="POST">
                        <small>Remove Image: </small><button type="submit" class="btn btn-primary" name="removeProfilePic" style="font-size: 12px;padding: 3px 8px;border-radius: 9px;">remove</button>
                    </form>
                    <form action="partials/_manageProfile.php" method="POST" enctype="multipart/form-data" style="margin-top: 7px;">
                        <div class="upload-btn-wrapper">
                            <small>Change Image:</small>
                            <button class="btn upload">choose</button>
                            <input type="file" name="image" id="image" accept="image/*">
                        </div>
                        <button type="submit" name="updateProfilePic" class="btn btn-primary" style="margin-top: -20px;font-size: 15px;padding: 3px 8px;">Update</button>
                    </form>
                    
                    <ul class="meta list list-unstyled" style="text-align:center;">
                        <li class="username my-2"><a href="viewProfile.php">@<?php echo $username ?></a></li>
                        <li class="name"><?php echo $firstName." ".$lastName; ?>
                            <label class="label label-info">(<?php echo $userType ?>)</label>
                        </li>
                        <li class="email"><?php echo $email ?></li>
                        <li class="my-2"><a href="partials/_logout.php"><button class="btn btn-secondary" style="font-size: 15px;padding: 3px 8px;">Logout</button></a></li>
                    </ul>
                </div>
            </div>
       
            <div class="content-panel mb-3" style="display: flex;justify-content: center;">
                <div class="border p-3" style="border: 2px solid rgba(0, 0, 0, 0.1);border-radius: 1.1rem;background-color: aliceblue;">
                    <h2 class="title text-center">Profile<span class="pro-label label label-warning"> (<?php echo $userType ?>)</span></h2>
                
                    <form action="partials/_manageProfile.php" method="post">
                        <div class="form-group">
                            <b><label for="username">Username:</label></b>
                            <input class="form-control" id="username" name="username" type="text" disabled value="<?php echo $username ?>">
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <b><label for="firstName">First Name:</label></b>
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required value="<?php echo $firstName ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <b><label for="lastName">Last Name:</label></b>
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name" required value="<?php echo $lastName ?>">
                        </div>
                        </div>
                        <div class="form-group">
                            <b><label for="email">Email:</label></b>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required value="<?php echo $email ?>">
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                <b><label for="phone">Phone No:</label></b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon">+91</span>
                                    </div>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone Number" required pattern="[0-9]{10}" maxlength="10" value="<?php echo $phone ?>">
                                </div>
                            </div>
                            <div class="form-group  col-md-6">
                                <b><label for="password">Password:</label></b>    
                                <input class="form-control" id="password" name="password" placeholder="Enter Password" type="password" required minlength="4" maxlength="21" data-toggle="password">
                            </div>
                        </div>
                        <button type="submit" name="updateProfileDetail" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php
        }
        else {
            echo '<div id="notfound">
                <div class="notfound">
                    <div class="notfound-404">
                        <h1>Oops!</h1>
                    </div>
                    <h2>404 - Page not found</h2>
                    <a href="index.php"> Go To Homepage </a>
                </div>
            </div>';
        }
    ?>
    <?php require_once 'footer.php' ?>
    
    <script>
        $('#image').change(function() {
            var i = $(this).prev('button').clone();
            var file = ($('#image')[0].files[0].name).substring(0, 5) + "..";
            $(this).prev('button').text(file);
        });
    </script>
