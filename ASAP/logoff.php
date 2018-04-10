<!DOCTYPE html>
<html>

    <body>
        <?php
        include "includeFiles/TrackErrors.php";

        session_start();
        session_unset();

        $msg = "You are now logged off.";
        ?>

        <?php include "logonLinks.php"; ?> 

        <h2>Log Off</h2>

        <?php echo $msg; ?>

    </body>
</html>