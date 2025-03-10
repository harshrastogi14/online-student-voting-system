 <div class="container-fluid">
        <div class="nav">
            <div class="col-1"> 
                <img src="assets/images/logo.gif" class="rounded-circle my-2 mx-3" height="40px "width="40px"/>
            </div>
            <div class="col-11 my-auto">
                <h2> ONLINE STUDENT VOTING SYSTEM  </h2>
               
            </div>
             
        </div>
    </div>
        





<?php 
    require_once("admin/inc/config.php");

    $fetchingElections = mysqli_query($db, "SELECT * FROM elections") OR die(mysqli_error($db));
    while($data = mysqli_fetch_assoc($fetchingElections))
    {
        $stating_date = $data['starting_date'];
        $ending_date = $data['ending_date'];
        $curr_date = date("Y-m-d");
        $election_id = $data['id'];
        $status = $data['status'];

        // Active = Expire = Ending Date
        // InActive = Active = Starting Date

        if($status == "Active")
        {
            $date1=date_create($curr_date);
            $date2=date_create($ending_date);
            $diff=date_diff($date1,$date2);
            
            if((int)$diff->format("%R%a") < 0)
            {
                // Update! 
                mysqli_query($db, "UPDATE elections SET status = 'Expired' WHERE id = '". $election_id ."'") OR die(mysqli_error($db));
            }
        }else if($status == "InActive")
        {
            $date1=date_create($curr_date);
            $date2=date_create($stating_date);
            $diff=date_diff($date1,$date2);
            

            if((int)$diff->format("%R%a") <= 0)
            {
                // Update! 
                mysqli_query($db, "UPDATE elections SET status = 'Active' WHERE id = '". $election_id ."'") OR die(mysqli_error($db));
            }
        }
        

    }
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login - Online Voting System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bd">
    <marquee class="mark"> New polls are up and running. But they will not be up forever! Voters Just Login and then go to Current Polls to vote for your favorite candidates.  </marquee>
    <div class="date-time-container" id="date-time-container">
    <div class="date" id="date"></div>
    <div class="time" id="time"></div>
</div>
   
            
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="assets/images/logo.gif" class="brand_logo " alt="Logo">
					</div>
				</div>

                <?php 
                    if(isset($_GET['sign-up']))
                    {
                ?>
                        <div class="d-flex justify-content-center form_container">
                            <form method="POST">
                                <div class="input-group mb-2">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="su_username" class="form-control input_user" placeholder="Username" required />
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="text" name="su_email" class="form-control input_pass" placeholder="email " required />
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" name="su_password" class="form-control input_pass" placeholder="Password" required />
                                </div>     
                                <div class="input-group mb-2">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" name="su_retype_password" class="form-control input_pass" placeholder="Retype Password" required />
                                </div>
                                
                                    <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="sign_up_btn" class="btn login_btn">Sign Up</button>
                        </div>
                            </form>
                        </div>
                
                        <div class="mt-2">
                            <div class="d-flex justify-content-center links text-white">
                                Already Created Account? <a href="index.php" class="ml-2 text-white">Sign In</a>
                            </div>
                        </div>
                <?php
                    }else {
                ?>
                        <div class="d-flex justify-content-center form_container">
                            <form method="POST">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="email" class="form-control input_user" placeholder="email" required />
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control input_pass" placeholder="Password" required />
                                </div>
                                    <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="loginBtn" class="login_btn btn">Login</button>
                        </div>
                            </form>   
                        </div>
                
                        <div class="mt-4">
                            <div class="d-flex justify-content-center links text-white">
                                Don't have an account? <a href="?sign-up=1" class="ml-2 text-white">Sign Up</a>
                            </div>
                            <div class="d-flex justify-content-center links">
                                <a href="forgot.php" class="text-white">Forgot your password?</a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center links">
                                <a href="front.php" class="text-white">Leave this page?</a>
                            </div>
                        </div>
    







                <?php
                    }
                    
                ?>

                <?php 
                    if(isset($_GET['registered']))
                    {
                ?>
                        <span class="bg-white text-success text-center my-3"> Your account has been created successfully! </span>
                <?php
                    }else if(isset($_GET['invalid'])) {
                ?>
                        <span class="bg-white text-danger text-center my-3"> Passwords mismatched, please try again! </span>
                <?php
                    }else if(isset($_GET['not_registered'])) {
                ?>
                        <span class="bg-white text-warning text-center my-3"> Sorry, you are not registered! </span>
                <?php
                    }else if(isset($_GET['invalid_access'])) {
                ?>
                        <span class="bg-white text-danger text-center my-3"> Invalid username or password! </span>
                <?php
                    }
                ?>
                       
			</div>
		</div>
	</div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/script.js"></script>
</body>
</html>

<?php 
    require_once("admin/inc/config.php");

    if(isset($_POST['sign_up_btn']))
    {
        $su_username = mysqli_real_escape_string($db, $_POST['su_username']);
        $su_email = mysqli_real_escape_string($db, $_POST['su_email']);
        $su_password = mysqli_real_escape_string($db, ($_POST['su_password']));
        $su_retype_password = mysqli_real_escape_string($db, ($_POST['su_retype_password']));
        $su_retype_password = mysqli_real_escape_string($db, ($_POST['su_retype_password']));
        $user_role = "Voter"; 

        if($su_password == $su_retype_password)
        {
            // Insert Query 

            mysqli_query($db, "INSERT INTO users(username, email, password, user_role) VALUES('". $su_username ."', '". $su_email ."', '". $su_password ."', '". $user_role ."')") or die(mysqli_error($db));

        ?>
            <script> location.assign("index.php?sign-up=1&registered=1"); </script>
        <?php

        }else {
    ?>
            <script> location.assign("index.php?sign-up=1&invalid=1"); </script>
    <?php
        }
             
    }else if(isset($_POST['loginBtn']))
    {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, ($_POST['password']));
        

        // Query Fetch / SELECT
        $fetchingData = mysqli_query($db, "SELECT * FROM users WHERE email = '". $email ."'") or die(mysqli_error($db));

        
        if(mysqli_num_rows($fetchingData) > 0)
        {
            $data = mysqli_fetch_assoc($fetchingData);

            if($email == $data['email'] AND $password == $data['password'])
            {
                session_start();
                $_SESSION['user_role'] = $data['user_role'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['user_id'] = $data['id'];
                
                if($data['user_role'] == "Admin")
                {
                    $_SESSION['key'] = "AdminKey";
            ?>
                    <script> location.assign("admin/index.php?homepage=1"); </script>
            <?php
                }else {
                    $_SESSION['key'] = "VotersKey";
            ?>
                    <script> location.assign("voters/index.php"); </script>
            <?php
                }

            }else {
        ?>
                <script> location.assign("index.php?invalid_access=1"); </script>
        <?php
            }


        }else {
    ?>
            <script> location.assign("index.php?sign-up=1&not_registered=1"); </script>
    <?php

        }

    }

?>
<div class="footer text-center text-white my-2">
        <div class="col-12 my-3 ">
            <p> &copy; Copyright 2024 - All Rights Reserved  <br />
                Developed by Harsh Rastogi
            </p>
        </div>
    </div>