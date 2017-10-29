<!--
Author: Austin Irvine
Date: October 27, 2017
Brief: View Posts From User
-->
<html>
	<body>
  		<?php
      //Error Checking..
  		/*ini_set('display_errors', 1);
  		ini_set('display_startup_errors', 1);
  		error_reporting(E_ALL);*/

      //Jump Into the Database
      $mysqli = new mysqli("mysql.eecs.ku.edu", "airvine", "derek", "airvine");

  		if ($mysqli->connect_errno) {
  				printf("Connect failed: %s\n", $mysqli->connect_error);
  				exit();
  		}

      /*
  		** Section 1 Brief: SELECT A USER
  		*/
      echo "<h3>Select A User & View Their Posts</h3><br>";
			echo "<form action='ViewUsersPosts.php' method='POST'>";
      $userSelection = "SELECT user_id FROM Users;";

			if($result = $mysqli->query($userSelection))
      {
  			if(mysqli_num_rows($result) > 0)
  			{
					echo "<select name='user'>";
  				while ($rowValue = $result->fetch_assoc()) {
  					echo "<option value='" . $rowValue['user_id'] . "'>" . $rowValue['user_id'] . "</option>";
  	      }
          echo "</select>";
  			}
  			else {
  				echo "There are no user to select from...";
  			}
      }
			echo '<input type="submit" value="Submit">';
			echo "</form>";
  		/* END Section
  		**/

      /*
  		** Section 2 Brief: Post Portion
  		*/
      $user = $_POST['user'];

      $queryPosts = "SELECT post_id, content, author_id FROM Posts WHERE author_id='$user'";

      if($result = $mysqli->query($queryPosts))
      {
        if(mysqli_num_rows($result) > 0)
        {
          echo "Posts Made By " . $user . ":";
          echo "<table>";
          echo "<th>Post ID</th><th>Content</th></tr>";
          while ($rowValue = $result->fetch_assoc()) {
  					echo "<tr>";
  					echo "<td>" . $rowValue["post_id"] . "</td>";
            echo "<td>" . $rowValue["content"] . "</td>";
  					echo "</tr>";
  	      }
          echo "</table>";
        }
        else {
          echo "No Post Exists By This User!";
        }
      }

  	  $mysqli->close();
  	?>
	</body>
</html>
