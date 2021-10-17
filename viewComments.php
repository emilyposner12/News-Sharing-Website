
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "style.css">
    <title>Comments</title>
  </head>
  <body>
    <h1>Comments:</h1>
    <?php
        $story_ID = $_GET["story_id"];

        require 'database.php';

        $stmt = $mysqli->prepare("select Comment, Username from comments WHERE Story_Id =" .$story_ID. ";");
        if(!$stmt){
	        printf("Query Prep Failed: %s\n", $mysqli->error);
	        exit;
        }

        $stmt->execute();

        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()){
	        echo(htmlspecialchars($row["Comment"]));
            echo("<br>");
            echo("<b>Commented by: </b>".$row["Username"] );
            echo ("<hr>");
            echo("<br>");
        }
        $stmt->close();

        ?>
    <form method="POST" action="displayPostedStories.php">
    <input type="submit" value = "Go Back" />
  </form>
  </body>
</html>
