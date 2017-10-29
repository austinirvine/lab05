<!--
Author: Austin Irvine
Date: October 27, 2017
Brief: View Posts From User
-->

<!--
   Select A User<br>
   <select>
     <?php

     //echo "<option value='$num'";

     ?>
    <option value="volvo">Volvo</option>
    <option value="saab">Saab</option>
    <option value="mercedes">Mercedes</option>
    <option value="audi">Audi</option>
   </select>
   <input type="text" id="username" name="username"><br>
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
  		** Section 1 Brief: SELECT A USER
  		*/
      echo "<h3>Select A User & View Their Posts</h3><br>";
      $userSelection = "SELECT user_id FROM Users;";

      if($result = $mysqli->query($userSelection))
      {
  			if(mysqli_num_rows($result) > 0)
  			{
          echo'<form action="ViewUserPosts.php" method="POST"';
          echo "<select name='user'>";
  				while ($rowValue = $result->fetch_assoc()) {
  					echo ("<option value='" . $rowValue["user_id"] . "'>" . $userSelection);
            echo ("</option>");
  	      }
          echo '</select> <input type="submit">';
          echo'</form>';
  			}
  			else {
  				echo "There are no user to select from...";
  			}
      }
  		/* END Section
  		**/

      /*
  		** Section 2 Brief: Post Portion
  		*/
      $user = $_POST['username'];

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
    </select>
	</body>
</html>
