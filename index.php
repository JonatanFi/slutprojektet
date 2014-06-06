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
	
	<nav class="menu">
		<ul id="subjectNavigation">
			<li id="addSubject">
				<a href="add_subject.php">Add Subject</a>
			</li>
	
			<?php

				//spara formdata i databasen

				$host     = "localhost";
				$dbname   = "project_awesome";
				$username = "project_awesome";
				$password = "awepro";

				$dsn = "mysql:host=$host;dbname=$dbname";
				$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
				$pdo = new PDO($dsn, $username, $password, $attr);

				if(!empty($_POST))
				{
					if($_POST['subject_name'] !=="")
					{
						$_POST = null;
						$subject_name = filter_input(INPUT_POST, 'subject_name');
						$statement	= $pdo->prepare("INSERT INTO subjects (name) VALUES (:subject_name)");
						$statement->bindParam(":subject_name", $subject_name);
						if(!$statement->execute())
							print_r($statement->errorInfo());
					}
				}

				foreach($pdo->query("SELECT * FROM subjects ORDER BY name") as $row)
				{
					echo "<li class=\"subjects\"><a href=\"summaries.php?subject_id={$row['id']}\">{$row['name']}</a></li>";
				}
				
			?>
		</ul>
	</nav>
	<footer id="footer">
		<h5> &copy Jonatan Finsberg</h5>
	</footer>
	
</body>
</html>