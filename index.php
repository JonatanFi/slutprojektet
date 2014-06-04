<DOCTYPE html>
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
	
	<nav class="menu">
		<ul>
			<li id="addSubject">
				<a href="add_subject.php">Add Subject</a>
			</li>
	
			<?php

				//spara formdata i db

				$host     = "localhost";
				$dbname   = "project_awesome";																	//ändrad
				$username = "project_awesome";																	//ändrad
				$password = "awepro";																			//ändrad

				$dsn = "mysql:host=$host;dbname=$dbname";
				$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
				$pdo = new PDO($dsn, $username, $password, $attr);

				if(!empty($_POST))
				{
					if($_POST['subject_name'] !=="")
					{
						$_POST = null;
						$subject_name = filter_input(INPUT_POST, 'subject_name');
						$statement	= $pdo->prepare("INSERT INTO subjects (name) VALUES (:subject_name)");				//ändrad
						$statement->bindParam(":subject_name", $subject_name);													//ändrad
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
	<footer>
		<div id="footer">
			<h5> &copy Jonatan Finsberg</h5>
		</div>
	</footer>
	
</body>
</html>