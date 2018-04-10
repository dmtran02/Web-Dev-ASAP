<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration Page</title>
        <div class="container">
            <img src="http://volunteer.unitedforimpact.org/content/volunteer.unitedforimpact.org/agency/54259.jpg?1474571495?area=agency" alt="asap_logo" width="300" height="225">
        </div>
    </head>
    <body>
        <?php
        include "includeFiles/TrackErrors.php";
        include "logonLinks.php";
        // Variables to hold user input
        $strEmail = "";
        $strPwd = "";
        $strFirstName = "";
        $strLastName = "";
        $con = "";

        // Variables to hold errors
        $strEmailError = "";
        $strPwdError = "";
        $strFirstNameError = "";
        $strLastNameError = "";

        // Message variable
        $msg = "";

        if (isset($_GET['email_address'])) {
            $strEmail = trim($_GET['email_address']);
            $strPwd = trim($_GET['pwd']);
            $strFirstName = trim($_GET['firstName']);
            $strLastName = trim($_GET['lastName']);

            if ($strEmail == "") {
                $strEmailError = "Please enter a valid email address";
            }

            if ($strPwd == "") {
                $strPwdError = "Please enter a password";
            }

            $allErrors = $strEmailError . $strPwdError . $strFirstNameError . $strLastNameError;

            if ($allErrors == "") {
                $con = mysqli_connect('cis-linux2.temple.edu', 'tuf49524', 'xijaixoy', 'FA17_1052_tuf49524');
                if ($con) {
                    $sql = "INSERT INTO coachLogin (user_name, pw, first_name, last_name) VALUES (?, ?, ?, ?)";
                }

                $stmt = $con->stmt_init();
                if ($stmt->prepare($sql)) {
                    $stmt->bind_param("ssss", $email_address, $pwd, $first_name, $last_name);
                    $email_address = $strEmail;
                    $pwd = $strPwd;
                    $first_name = $strFirstName;
                    $last_name = $strLastName;

                    $stmt->execute();
                    if ($con->error == "") {
                        $msg = "You have successfully registered!.";
                    } else {
                        // check to see if the DB is saying "duplicate error"
                        // in a case where some field was specified "must be unique"
                        $position = strpos($con->error, "Duplicate");
                        if ($position !== false) {
                            $msg = "That user email address already exists. Please use another one.";
                        } else {
                            $msg = "Error: " . $con->error;
                        }
                    }
                    $stmt->close();
                } else {
                    $msg = "Could not prepare this SQL statement: " . $sql .
                            "<br/> Error is: " . $con->error;
                }
            } else {
                // call a function that returns the database connection error message.
                echo "Connect error: " . $con->connect_error;
            }

            // VERY IMPORTANT -- dont forget to close the connection or you will bring MySql down
            // -- for yourself and for all other students.
            $con->close();
        }
        ?>
        <br/><br/>
        <form action="insertUser.php" method="GET">
            <br/>
            Email Address:
            <input type="text" name="email_address" value="<?php echo $strEmail; ?>"/>
            <span class="error"> <?php echo $strEmailError; ?> </span> <br/>
            <br/>

            Password: &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="text" name="pwd" value="<?php echo $strPwd; ?>"/>
            <span class="error"> <?php echo $strPwdError; ?> </span> <br/>
            <br/>

            First Name: &nbsp; &nbsp; &nbsp;
            <input type="text" name="firstName" value="<?php echo $strFirstName; ?>"/>
            <span class="error"> <?php echo $strFirstNameError; ?> </span> <br/>
            <br/>

            Last Name: &nbsp; &nbsp; &nbsp;
            <input type="text" name="lastName" value="<?php echo $strLastName; ?>"/>
            <span class="error"> <?php echo $strLastNameError; ?> </span> <br/>

            <br/><span style="font-weight: bold">
                <?php echo $msg; ?>
            </span> 

            <br/><input type="submit" value="Submit"/> &nbsp; &nbsp; &nbsp;
        </form>
    </body>
</html>
