<!--
Author: Austin Irvine
Date: October 27, 2017
Brief: Delete Posts
-->
<html>
	<body>
		<form action="DeletePost.php" method="POST">
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
      echo "<h3>Select Posts To Delete</h3><br>";
      $postSelection = "SELECT post_id, content, author_id FROM Posts;";

      if($result = $mysqli->query($postSelection))
      {
  			if(mysqli_num_rows($result) > 0)
  			{
          //echo'<form action="DeletePost.php" method="POST">';
          echo "Posts That Can Be Deleted";
          echo "<table>";
          echo "<tr><th>Delete</th><th>Post ID</th><th>Content</th><th>User</th></tr>";
          while ($rowValue = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><input type='checkbox' name='" . $rowValue["post_id"] . "' value='delete'></input>";
            echo "</td>";
            echo "<td>" . $rowValue["post_id"] . "</td>";
            echo "<td>" . $rowValue["content"] . "</td>";
            echo "<td>" . $rowValue["author_id"] . "</td>";
            echo "</tr>";
          }
          echo "</table><br><br>";

					//echo "</form>";
  			}
  			else {
  				echo "There are no user to select from...";
  			}
      }
			echo "<input type='submit' value='Submit Deletion'>";
  		/* END Section
  		**/

      /*
  		** Section 2 Brief: Deletion of Posts
  		*/
      $queryDelete = "SELECT post_id FROM Posts";

      if($result = $mysqli->query($queryDelete))
      {
        if(mysqli_num_rows($result) > 0)
        {
          while ($rowValue = $result->fetch_assoc())
          {
						if($_POST[$rowValue['post_id']] == 'delete')
            {
							$finishDelete = "DELETE FROM Posts WHERE post_id=" . $rowValue['post_id'];
              if($mysqli->query($finishDelete))
              {
                echo "The following post has been deleted: " . $rowValue['post_id'];
              }
              else {
                echo "The following post has NOT been deleted: " . $rowValue['post_id'];
              }
            }
  	      }
        }
        else {
          echo "No Posts To Delete!";
        }
      }

  	  $mysqli->close();
  	?>
		</form>
	</body>
</html>
