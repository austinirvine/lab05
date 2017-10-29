<!--
Author: Austin Irvine
Date: October 27, 2017
Brief: Create and Store Users
-->

<html>
	<body>
		<?php

		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$mysqli = new mysqli("mysql.eecs.ku.edu", "airvine", "derek", "airvine");
			if ($mysqli->connect_errno) {
					printf("Connect failed: %s\n", $mysqli->connect_error);
					exit();
			}
			/*
			** Section 1 Brief: Check if name already used and msg user if used
			*/
				$names = $_POST['usernames'];

				if($names == '')
				{
					echo("Blank Usernames Are Not Allowed!");
				}
				else
				{

					/* checking connections - similar to lab procedure example from jgib*/
					$query = "SELECT * FROM Users WHERE user_id ='".$names."';";

					$queryQuery = $mysqli->query($query);

					if(mysqli_num_rows($queryQuery) > 0)
					{
						echo("User already exists..");
					}
					else
					{
						$query = "INSERT INTO Users (user_id) VALUES ('".$names."')";

						if ($result = $mysqli->query($query))
						{
							echo("You are looking good today, " . $names . ".");
							//$result->free();
						}
						else
						{
							echo("Something has gone terribly wrong," . $names . ".");
						}
					}
				}
			//}
			/* END Section
			**/
		$mysqli->close();
		?>
	</body>
</html>
