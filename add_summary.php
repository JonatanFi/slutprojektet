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

?>

<form action="summaries.php" method="POST">
	<p>
		<label for="name">Subject: </label>
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
		<input type="text" name="title">
	</p>
	<p>
		<label for="content">Summary: </label>
		<input type="text" name="content" />
	</p>
	<p>
		<label for="image">Link to image: </label>
		<input type="text" name="image" />
	</p>
	<input type="submit" value="Post Summary" />
</form>
<hr />
	
	<footer>
		<div id="footer">
			<h5> &copy Jonatan Finsberg</h5>
		</div>
	</footer>
</body>
</html>