<!DOCTYPE html>
<html>
    <head>
        <style>
            table {
                background-color:#72D694;
            }
            td,th {
                padding-left: 4px;
                padding-right: 4px;
            }
            th {
                background-color:#F98FA8;
            }
            td {
                background-color:#CFE9E4;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <img src="http://volunteer.unitedforimpact.org/content/volunteer.unitedforimpact.org/agency/54259.jpg?1474571495?area=agency" alt="asap_logo" width="1000" height="300">
        </div>

        <?php
        include "includeFiles/TrackErrors.php"; // copies 3 lines of code that will cause error message
        // to be shown on the page (not empty white page). 

        include "includeFiles/FormatFunctions.php";

        include "logonLinks.php";

        $msg = "";

        $con = mysqli_connect('cis-linux2.temple.edu', 'tuf49524', 'xijaixoy', 'FA17_1052_tuf49524');
        if ($con) {
            echo "<h2>Player List</h2>";
            echo "<table><tr><th>Rank</th><th>Name</th><th>Rating</th><th>USCF ID</th><th>State</th><th>Team</th><th>Registered Date</th>\n";

            try {
                // Get the result set (think grid of data) and put it into $result
                $sql = "SELECT ranking, name, rating, uscf_id, state, team, registered_date FROM chess_player_list ORDER BY rating DESC";

                if ($con) {
                    $stmt = $con->stmt_init();
                    if ($stmt->prepare($sql)) {

                        $stmt->execute();
                        $stmt->bind_result($player_id, $name, $rating, $uscf_id, $state, $team, $registered_date);

                        while ($stmt->fetch()) { // keep running the code in this block for each row in the result set
                            echo "<tr>"; // start a HTML row
                            // print the columns of the result set - each surrounded by <td> .. </td>         
                            echo "<td>" . $player_id . "</td>";
                            echo "<td>" . $name . "</td>";
                            echo "<td>" . $rating . "</td>";
                            echo "<td>" . $uscf_id . "</td>";
                            echo "<td>" . $state . "</td>";
                            echo "<td>" . $team . "</td>";
                            echo "<td>" . $registered_date . "</td>";

                            echo "</tr>"; // finish off the HTML row

                            echo "\n"; // this doesnt change what you see on the page, but puts a newline in View Source
                            //$i = $i + 1;  // add one to the row counter variable
                        }
                        echo "</table>"; // finish off the HTML table tag
                    } else {
                        echo "could not prepare statement";
                    }
                } else {
                    echo "could not connect: " + $con->connect_error;
                }
            } catch (Exception $e) {
                echo "<br/>Error in view.webUserList: " + $e->getMessage();
            }
        } else {
            // call a function that returns the database connection error message.
            echo "Connect Error: " . $con->connect_error;
        }

        // VERY IMPORTANT -- dont forget to close the connection or you will bring MySql down
        // -- for yourself and for all other students.
        $con->close();
        ?>

    </body>
</html>