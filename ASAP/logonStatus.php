<!DOCTYPE html>
<html>

    <body>
        <?php
         include "includeFiles/TrackErrors.php";
         
        session_start();

        $msg = "User ID is ";
        if (isset($_SESSION['email_address'])) {
            $msg .= $_SESSION['email_address'];
        } else {
            $msg .= "nothing";
        }
        
        $msg .="<br/> User email is ";       
        if (isset($_SESSION['email_address'])) {
            $msg .= $_SESSION['email_address'];
        } else {
            $msg .= "nothing";
        }
        
        $msg .="<br/> User first name is ";
        if (isset($_SESSION['first_name'])) {
            $msg .= $_SESSION['first_name'];
        } else {
            $msg .= "nothing";
        }
        $msg .= "<br/>";

        ?>
        
        <?php include "logonLinks.php"; ?>
        
        <h2>Login Status - Checking the session</h2>

        <?php echo $msg; ?>
        
    </body>
</html>