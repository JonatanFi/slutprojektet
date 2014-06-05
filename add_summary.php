<!DOCTYPE html>
<html>
	<head>
		<?php
			header('Content-Type: text/html; charset=utf-8');
		?>
		<!--<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />-->
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

		?>
			<!--show Add Summary form-->
		<form action="summaries.php" method="POST" id="addSummaryForm">
			<p>
				<label for="name">Subject (very important): </label>
				<select name="subject_id">
					<?php
						foreach ($pdo->query("SELECT * FROM subjects ORDER BY name") as $row)
						{
							echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
						}
					?>
				</select>
			</p>
			<p>
				<label for="title">Title: </label>
				<input type="text" name="title" id="titleTextbox">
			</p>
			<p>
				<label for="content">Summary: </label>
				<input type="text" name="content" id="summaryTextbox"/>
			</p>
			<p>
				<label for="image">Link to image (optional): </label>
				<input type="text" name="image" id="imageTextbox"/>
			</p>
			<input type="submit" value="Post Summary" />
		</form>
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