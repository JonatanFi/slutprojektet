<!DOCTYPE html>
<html>
	<head>
		<?php
			header('Content-Type: text/html; charset=utf-8');
		?>
		<title>project_awesome</title>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>	
<body>

	<header id="header">
		<h1><a href="index.php">PROJECT AWESOME</a></h1>
	</header>


<?php

	//spara formdata i databasen

	$host     = "localhost";
	$dbname   = "project_awesome";
	$username = "project_awesome";
	$password = "awepro";

	$dsn = "mysql:host=$host;dbname=$dbname";
	$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
	$pdo = new PDO($dsn, $username, $password, $attr);
	if($pdo)
	{
		// har något postats? skriv till databas
		
		
		if(!empty($_POST))
		{
			$_POST = null;
			$post    = filter_input(INPUT_POST, 'post', FILTER_SANITIZE_SPECIAL_CHARS);
			$statement = $pdo->prepare("INSERT INTO subjects (name) VALUES (:post)");
			$statement->bindParam(":post", $post);
			$statement->execute();
		}
		
		//visa form
		?>
		
		<form action="index.php" method="POST" id="addSubjectForm">
			<p>
				<label for="subject_name">Subject Name: </label>
				<input type="text" name="subject_name" />
			</p>
			<div>
				<input type="submit" value="Add Subject" class="submitButton"/>
			</div>
		</form>
		<nav id="existingSubjects">
			<h2>Already existing subjects:</h2>
			<?php
			//visa alla subjects
			foreach ($pdo->query("SELECT subjects.* FROM subjects") as $row)
			{
				echo "<p>{$row['name']}</p>";
			}
		?>
		</nav>
		<?php
	}
	else
	{
		print_r($sum_statement->errorInfo());
	}
?>
	<footer id="footer">
		<h5> &copy Jonatan Finsberg</h5>
	</footer>
</body>
</html>