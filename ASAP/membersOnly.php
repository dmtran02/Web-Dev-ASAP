<!DOCTYPE html>
<html>

    <body>
        <?php
         include "includeFiles/TrackErrors.php";
         
        session_start();

        $msg = "How is your day going so far?";
        
        if (!isset($_SESSION['email_address'])) { 
            header("Location: error.php?errorMsg=: Only coaaches are allowed to view this page!", true, 303);
            die();
        } 

        ?>
        
        <?php include "logonLinks.php"; ?>
        
        <h2>Welcome to the Coaches Page!</h2>
        
        <br/>
        <?php echo $msg; ?>
        
    </body>
</html>