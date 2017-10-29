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

    

		/* END Section
		**/



	  $mysqli->close();
	?>
	</body>
</html>
