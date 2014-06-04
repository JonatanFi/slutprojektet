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
	$dbname   = "project_awesome";																	//ändrad
	$username = "project_awesome";																	//ändrad
	$password = "awepro";																			//ändrad

	$dsn = "mysql:host=$host;dbname=$dbname";
	$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
	$pdo = new PDO($dsn, $username, $password, $attr);
	if($pdo)
	{
		// har något postats? skriv till databas
		
		
		if(!empty($_POST))
		{
			$_POST = null;
			$post    = filter_input(INPUT_POST, 'post', FILTER_SANITIZE_SPECIAL_CHARS);				//ändrad
			$statement = $pdo->prepare("INSERT INTO subjects (name) VALUES (:post)");				//ändrad
			$statement->bindParam(":post", $post);													//ändrad
			$statement->execute();
		}
		
		//visa form FIXAD
		?>
		
		<form action="index.php" method="POST">
			<p>
				<label for="subject_name">Subject Name: </label>
				<input type="text" name="subject_name" />
			</p>
			<input type="submit" value="Add Subject" />
		</form>
		<hr />
		
		<?php
		//visa alla subjects FIXAD
		foreach ($pdo->query("SELECT subjects.* FROM subjects") as $row)
		{
			echo "<p>{$row['name']}</p>";
		}
	}
	else
	{
		echo "not connected";
	}


?>
	
	<footer>
		<div id="footer">
			<h5> &copy Jonatan Finsberg</h5>
		</div>
	</footer>
</body>
</html>