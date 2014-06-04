<html>
	<head>
		<title>project_awesome</title>
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>	
<body>

	<header>
		<div id="header">
			<h1><a href="index.php">PROJECT AWESOME</a></h1>
		</div>
	</header>

	<?php

	//spara formdata i db

	$host     = "localhost";
	$dbname   = "project_awesome";
	$username = "project_awesome";
	$password = "awepro";

	$dsn = "mysql:host=$host;dbname=$dbname";
	$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
	$pdo = new PDO($dsn, $username, $password, $attr);

	// har något postats? skriv till databas
	
	if(!empty($_POST))
	{
		if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['subject_id']))
		{
			if($_POST['title'] !== "" && $_POST['content'] !== "" && $_POST['subject_id'] !== "")
			{
				$title		= filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
				$content	= filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
				$image		= filter_input(INPUT_POST, 'image', FILTER_SANITIZE_SPECIAL_CHARS);
				$subject_id	= filter_input(INPUT_POST, 'subject_id', FILTER_VALIDATE_INT);
				$statement = $pdo->prepare("INSERT INTO summaries (title, content, image, subject_id) VALUES (:title, :content, :image, :subject_id)");		//ändrad
				$statement->bindParam(":title", $title);																									//ändrad
				$statement->bindParam(":content", $content);																								//ändrad
				$statement->bindParam(":image", $image);																									//ändrad
				$statement->bindParam(":subject_id", $subject_id);																							//ändrad
				if(!$statement->execute())
					print_r($statement->errorInfo());
			}
		}
		else if(isset($_POST['summary_id']) && isset($_POST['content']))
		{
			if($_POST['summary_id'] !== "" && $_POST['content'] !== "")
			{
				$summary_id	= filter_input(INPUT_POST, 'summary_id', FILTER_VALIDATE_INT);
				$content	= filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
				$statement = $pdo->prepare("INSERT INTO comments (summary_id, date, content) VALUES (:summary_id, NOW() ,:content)");						//ändrad
				$statement->bindParam(":summary_id", $summary_id);																							//ändrad
				$statement->bindParam(":content", $content);																								//ändrad
				if(!$statement->execute())
					print_r($statement->errorInfo());
			}
		}
		$_POST = null;
		
		
	}

	if(!empty($_GET) && isset($_GET['summary_id']))
	{
		if($_GET['summary_id'] !== "")
		{
			//show summary details
			?>
			
			<?php
			$summary_id = filter_input(INPUT_GET, "summary_id", FILTER_VALIDATE_INT);
			$sum_statement = $pdo->prepare("SELECT summaries.*, subjects.name AS 'subject_name' FROM summaries JOIN subjects ON summaries.subject_id=subjects.id WHERE summaries.id=:summary_id");
			$sum_statement->bindParam(":summary_id", $summary_id);
			if($sum_statement->execute())
			{
				if($row = $sum_statement->fetch())
				{
					echo "	<div id=\"comment\">
								<h2>{$row['subject_name']} - {$row['title']}</h2>
								<p>{$row['content']}</p>
								<p>{$row['image']}</p>
							</div>";
							//<p><a href=\"summaries.php\">Back</a></p>"
				
						// show comment form
					echo "<form action=\"summaries.php?summary_id={$row['id']}\" method=\"POST\">";
					echo "<input type=\"hidden\" name=\"summary_id\" value=\"{$row['id']}\" />"
					?>
					<div id="commentForm">
						<form>
							<p>
								<label for="content">Comment: </label>
								<input type="text" name="content" />
							</p>
							<input type="submit" />
						</form>
					</div>
					<?php
					// show all comments belonging to chosen summary
					$com_statement = $pdo->prepare("SELECT * FROM comments WHERE summary_id=:summary_id ORDER BY date DESC");
					$com_statement->bindParam(":summary_id", $summary_id);
					if($com_statement->execute())
					{
						while($comment = $com_statement->fetch())
						{
							echo "<p>{$comment['content']}</p> <p>{$comment['date']}</p> <hr />";
						}
					}
					else
						print_r($sum_statement->errorInfo());
				}
			}
			else
			{
				echo "";
				print_r($sum_statement->errorInfo());
			}
		}
	}
	else										//comment
	{
		//if... subject_id		en Back-knapp
		
		$subject_id = filter_input(INPUT_GET, 'subject_id', FILTER_VALIDATE_INT);
		$statement = $pdo->prepare("SELECT summaries.* FROM summaries WHERE subject_id=:subject_id ORDER BY title");
		$statement->bindParam(":subject_id", $subject_id);
		if($statement->execute())
		{
			?>
			<nav>
				<ul>
					<li id="addSummary">
						<a href="add_summary.php">Add Summary</a>
					</li>
			<?php
			while($row = $statement->fetch())
			{
				echo"	<li class=\"summaries\">
							<a href=\"?summary_id={$row['id']}\">{$row['title']}</a>
						</li>";
			}
			?>
				</ul>
			</nav>
			<?php
		}

		else
		{
			print_r($statement->errorInfo());
		}
	}
	?>

	<footer>
		<div id="footer">
			<h5> &copy Jonatan Finsberg</h5>
		</div>
	</footer>
</body>
</html>