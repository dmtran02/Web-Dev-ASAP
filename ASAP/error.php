<!DOCTYPE html>
<html>

    <body>
        <?php
        include "includeFiles/TrackErrors.php"; 
       
        $msg = "Error";

        if (isset($_GET['errorMsg'])) {
            $msg .= $_GET['errorMsg'];
        }
        ?>

        <?php include "logonLinks.php"; ?>

        <h2>Error Page</h2>

        <span style="color:red; font-weight:bold; font-size: 18px;">
            <?php echo $msg; ?>
        </span>
        
    </body>
</html>