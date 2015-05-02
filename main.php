<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="modal-position.js"></script>
</head>
<body>

	<div id="modal">
		<div id="left">
		<form action='#'>
		  <div class='field'>
		    <input placeholder='Query'>
		    <label>Your Query</label>
		  </div>
		  <div class='field form-actions'>
		    <button type='submit'>Execute</button>
		  </div>

		  <?php

		  ?>
		</form>
		</div>
		<div id="center">

		</div>
		<div id="right">

		</div>
	</div>
	

	<?php
	// your config
	
	global $conn;
	$dbHost = '127.0.0.1';
	$dbUser = 'root';
	$dbPass = '';
	$dbName = 'dbms_project1';

	$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
	//$conn = mysqli_connect($dbHost,$dbUser,$dbPass) or die("unable to connect to server");

	if($mysqli->connect_errno) {
		echo "Connection failed";
		exit();
	}

	$result = $mysqli->query("USE dbms_project1");
	if (!$result) {
	    echo 'Could not run query: ' . mysql_error();
	    exit;
	}

	//echo "Yay";
	$result = $mysqli->query("SELECT * from movies, actor, acts_in where acts_in.aid = actor.aid and movies.mid = acts_in.mid");
	if (!$result) {
	    echo 'Could not run query: ' . mysql_error();
	    exit;
	}

	echo "<table>";
	$finfo = $result->fetch_fields();
	echo "<tr>";
	foreach ($finfo as $val) {
		echo "<td>" . $val->name . "</td>";
	}
	echo "</tr>";

	while($row = $result->fetch_array()) {
    	$finfo = $result->fetch_fields();
		echo "<tr>";
		foreach ($finfo as $val) {
			echo "<td>" . $row[$val->name] . "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";

	//$conn->close()
*/?>
</body>
</html>