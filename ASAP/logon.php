<!DOCTYPE html>
<html>
    <head>
        <title>ASAP Coach Login Page</title>
    </head>
    <body>
        <div class="container">
            <img src="http://volunteer.unitedforimpact.org/content/volunteer.unitedforimpact.org/agency/54259.jpg?1474571495?area=agency" alt="asap_logo" width="300" height="225">
        </div>
        <?php
        include "includeFiles/TrackErrors.php";

        include "includeFiles/LogonFunctions.php";

        $msg = "";

        $strUserEmail = "";
        $strUserPwd = "";

        if (isset($_GET['userEmail'])) {

            $strUserEmail = $_GET['userEmail'];
            $strUserPwd = $_GET['userPwd'];

            $con = mysqli_connect('cis-linux2.temple.edu', 'tuf49524', 'xijaixoy', 'FA17_1052_tuf49524');
            if ($con) {
                $msg = checkLogon($con, $strUserEmail, $strUserPwd);
            } else {
                $msg = $con->connect_error;
            }
        }
        ?>

        <?php include "logonLinks.php"; ?>

        <h2>Login</h2>
        <form action="logon.php" method="get">
            User Email: <input type="text" name="userEmail" value="<?php echo $strUserEmail; ?>"/>
            <br/><br/>
            Password: <input type="password" name="userPwd" value="<?php echo $strUserPwd; ?>"/>
            <br/><br/>
            <input type="submit" value="Login"/>
        </form>
        <br/>

        <?php echo $msg; ?>

    </body>
</html>