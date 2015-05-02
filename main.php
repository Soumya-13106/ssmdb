<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript">
		$('#selectDBTag').change(function() {
		var parent = $(this).val();
		
		$('#payment_plan').children().each(function() {
			if($(this).data('parent') != parent) {
				$(this).hide();
			} else    $(this).show();
		});
	});
	</script>-->
</head>
<body>
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

?>
	<div id="modal">
		<div id="left">
		<form action='#' method="POST">
			<div class='field'>
			<input placeholder="Query" name="query">
			<label>Your Query</label>
			</div>
			<div class='field form-actions'>
			<button type='submit' name='customQuery'>Execute</button>
			</div>

			<?php
			if(isset($_POST["customQuery"])){
				$result = $mysqli->query($_POST["query"]);
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
			}
			?>
		</form>
		</div>


		<div id="center1">
		</div>

		<div id="middle">
			<div class='dropQueries'>
			<form action='#' method="POST">
		    <select name="queries" style="margin-right: 20px;width:100%;">
				<option value="SELECT * FROM actor GROUP BY name">SELECT * FROM actor GROUP BY name</option>
				<option value="SELECT * FROM movies WHERE title LIKE '%Princess%'">SELECT * FROM movies WHERE title LIKE "%Princess%"</option>
				<option value="SELECT * FROM actor, director WHERE actor.dob = director.dob">SELECT * FROM actor, director WHERE actor.dob = director.dob</option>
				<option value="select * FROM director, movies WHERE director.did = 32">select * FROM director, movies WHERE director.did = 32</option>
			</select>
		  </div>
		  <div class='field form-actions'>
		    <button type='submit' name='dropExecute'>Execute</button>
		  </div>

			<?php
			if(isset($_POST["dropExecute"])){
				$result = $mysqli->query($_POST["queries"]);
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
			}

			?>

		</form>
		</div>

		<div id="center2">
		</div>

		<div id="right">
			<div id="selectDB">
			<form method="POST" action="#">
				<?php
				$res = $mysqli->query("SHOW TABLES");
				echo "<select name='selectDBTag' id='selectDBTag'>";
				while($cRow = mysqli_fetch_array($res)) {
					echo "<option value=" . $cRow[0] . ">" . $cRow[0] ."</option>";
				}
				echo "</select>"
				?>
			<button type="submit" name="addEntry" id="addEntryID">Add</button>
			<button type="submit" name="updateEntry" id="updateEntryID" onclick="document.getElementById('selectDB').style.display='block';document.getElementById('executeQuery').style.display='block';">Update</button>
			<button type="submit" name="deleteEntry" id="deleteEntryID" onclick="document.getElementById('selectDB').style.display='block';document.getElementById('executeQuery').style.display='block';">Delete</button>
			</form>
			</div>
			<form name='selectQueryForm' action='#' method='POST'>	
			<?php
			//echo $_POST['addEntry'];
			if(isset($_POST['addEntry'])) {
				$result = $mysqli->query("SELECT * from " . $_POST['selectDBTag']);
				if (!$result) {
					echo 'Could not run query: ' . mysql_error();
					exit;
				}
				echo "<input type='hidden' value='" .$_POST['selectDBTag'] ."' name='databaseNameSelected'/>Hello";
				$finfo = $result->fetch_fields();
				foreach ($finfo as $val) {
					echo "<input class='attributeTextField' type='";
					if($val->type===10) {
						echo "date";
					} elseif ($val->type===11) {
						echo "time";
					} else {
						echo "text";
					}
					echo "' placeholder='" . $val->name . "' name='" . $val->name . "'>";
				}
			}
			?>
			
			<button type="submit" name="executeAddQuery">Execute</button>
			</form>

			<?php

			/*print("<pre>");
			print_r($_POST);
			print("</pre>");
			*/
			if(isset($_POST['executeAddQuery'])) {
				$str = "INSERT INTO " .$_POST['databaseNameSelected'] . " (";
				$result1 = $mysqli->query("SELECT * from " .$_POST['databaseNameSelected']);
				if (!$result1) {
					echo 'Could not run query: ' . mysql_error();
					exit;
				}

				$finfo = $result1->fetch_fields();
				foreach ($finfo as $val) {
					$str.= " " .$val->name . ",";
				}
				$str = rtrim($str, ",");
				$str .= ") VALUES (";
				foreach ($finfo as $val) {
					$str.= " " ."'" .$_POST[$val->name] ."'" . ",";
				}
				$str = rtrim($str, ",");
				$str .= ")";
				
				echo "SQL Query becomes: " .$str;
				$result = $mysqli->query($str);
				if (!$result) {
					echo 'Could not run query: ' . mysql_error();
					exit;
				} else {
					echo "Query inserted";
				}


			}
			?>
			</div>
			</div>
	



	<?php
	//echo "Yay";
	/*$result = $mysqli->query("SELECT * from actor, movies");
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

	$mysqli->close()*/
?>

</body>
</html>