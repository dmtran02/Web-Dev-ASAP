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

        <?php
        include "includeFiles/TrackErrors.php"; // copies 3 lines of code that will cause error message
        // to be shown on the page (not empty white page). 

        include "includeFiles/FormatFunctions.php";

        include "logonLinks.php";

        $msg = "";

        $con = mysqli_connect('cis-linux2.temple.edu', 'tuf49524', 'xijaixoy', 'FA17_1052_tuf49524');
        if ($con) {
            echo "<h2>Official Middle School Standings</h2>";
            echo "<table><tr><th>Position</th><th>Name</th><th>USCF ID</th><th>Rating</th><th>Team</th><th>Grade</th><th>Rd 1</th><th>Rd 2</th><th>Rd 3</th><th>Rd 4</th><th>Total</th><th>TBrk[M]</th><th>TBrk[S]</th><th>TBrk[C]</th><th>TBrk[O]</th>\n";

            try {
                // Get the result set (think grid of data) and put it into $result
                $sql = "SELECT place, name, uscf_id, rating, team, grade, rd1, rd2, rd3, rd4, total, TBrkM, TBrkS, TBrkC, TBrkO FROM OfficialStandingsMS";

                if ($con) {
                    $stmt = $con->stmt_init();
                    if ($stmt->prepare($sql)) {

                        $stmt->execute();
                        $stmt->bind_result($place, $name, $uscf_id, $rating, $team, $grade, $rd1, $rd2, $rd3, $rd4, $total, $TBrkM, $TBrkS, $TBrkC, $TBrkO);

                        while ($stmt->fetch()) { // keep running the code in this block for each row in the result set
                            echo "<tr>"; // start a HTML row
                            // print the columns of the result set - each surrounded by <td> .. </td>         
                            echo "<td>" . $position . "</td>";
                            echo "<td>" . $name . "</td>";
                            echo "<td>" . $uscf_id . "</td>";
                            echo "<td>" . $rating . "</td>";
                            echo "<td>" . $team . "</td>";
                            echo "<td>" . $grade . "</td>";
                            echo "<td>" . $rd1 . "</td>";
                            echo "<td>" . $rd2 . "</td>";
                            echo "<td>" . $rd3 . "</td>";
                            echo "<td>" . $rd4 . "</td>";
                            echo "<td>" . $total . "</td>";
                            echo "<td>" . $TBrkM . "</td>";
                            echo "<td>" . $TBrkS . "</td>";
                            echo "<td>" . $TBrkC . "</td>";
                            echo "<td>" . $TBrkO . "</td>";
                            

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