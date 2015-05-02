<html>
<body>
	<?php
	// your config
	
	function connect($host, $user, $pass) {
		$this->dbcnt = mysqli_connect($host, $user, $pass) or
		die("unable to connect to server");
	}


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
	$result = $mysqli->query("SELECT * from movies ORDER BY mid");
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
?>
</body>
</html>