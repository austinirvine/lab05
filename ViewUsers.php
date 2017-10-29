<!--
Author: Austin Irvine
Date: October 27, 2017
Brief: View Table of Users
-->

<html>
	<body>
		<?php

    //Error Checking..
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

    //Jump Into the Database
    $mysqli = new mysqli("mysql.eecs.ku.edu", "airvine", "derek", "airvine");

		if ($mysqli->connect_errno) {
				printf("Connect failed: %s\n", $mysqli->connect_error);
				exit();
		}

    /*
		** Section 1 Brief: Finish Basic Tests
		*/
    $selectUsers = "SELECT user_id FROM Users;";

    if($result = $mysqli->query($selectUsers))
    {
			if(mysqli_num_rows($result) > 0)
			{
				echo "<table><tr>";
				echo "<th>Users</th></tr>";
				while ($rowValue = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $rowValue["user_id"] . "</td>";
					echo "</tr>";
					//echo ("%s (%s)\n", $rowValue["post_id"], $rowValue["content"], $rowValue["author_id"]);
	      }
				echo "</table>";
			}
			else {
				echo "No Table To Present | No Users Present";
			}
    }
		/* END Section
		**/



	  $mysqli->close();
	?>
	</body>
</html>
