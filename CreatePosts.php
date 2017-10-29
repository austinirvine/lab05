<!--
Author: Austin Irvine
Date: October 27, 2017
Brief: Create and Store Posts
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
		$user = $_POST['username'];
    $content = $_POST['postit'];

		if($user == '')
		{
			echo("User Must Specify A Valid Username!");
		}
    elseif($content == '')
    {
      echo("Requires Content To Post!");
    }
		else
		{
      //Base Procedure Finished
      /*
  		** Section 2 Brief: Create Post By Valid User
  		*/
      $query = "SELECT * FROM Users WHERE user_id ='".$user."';";

      $userCheck = $mysqli->query($query);

      if(mysqli_num_rows($userCheck) == 0)
      {
        echo("User doesn't already exist, unable to create post..");
      }
      else
      {
        $newID = 0;
        $lastID = "SELECT * FROM Posts ORDER BY post_id DESC LIMIT 1;";

        if($result = $mysqli->query($lastID))
        {
          $lastID = mysqli_fetch_assoc($result);
          echo ("This is the last post id: " . $lastID['post_id'] . "<br>");

          if($lastID['post_id'] == NULL)
          {
            $newID = 1;
          }
          else {
            $newID = $lastID['post_id'] + 1;
          }
        }

        $query = "INSERT INTO Posts (author_id, content, post_id) VALUES ('".$user."', '".$content."', " . $newID . ");";
        //CreatePostID();

        if ($result = $mysqli->query($query))
        {
          echo("Thanks for making a post " . $user . ".");
          echo("<br>You wrote this: '" . $content . "'.");
        }
        else
        {
          echo("Something has gone terribly wrong in " . $user . "'s post.");
        }
      }
      /* END Section
      **/
		}
		/* END Section
		**/



	  $mysqli->close();
	?>
	</body>
</html>
