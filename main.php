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
		<form action='#' method="POST">
		  <div class='field'>
		    <input placeholder="Select Query" name="selectQuery">
		    <label>Query Chosen</label>
		    <select name="cars">
				<option value="volvo">Volvo</option>
				<option value="saab">Saab</option>
				<option value="fiat" selected>Fiat</option>
				<option value="audi">Audi</option>
			</select>
		  </div>
		  <div class='field form-actions'>
		    <button type='submit'>Execute</button>
		  </div>
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
			<button type="submit" name="addEntry" id="addEntryID" onclick="document.getElementById('selectDB').style.display='block';document.getElementById('executeQuery').style.display='block';">Add</button>
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

				$finfo = $result->fetch_fields();
				foreach ($finfo as $val) {
					echo "<input class='attributeTextField' type='text' placeholder=" . $val->name . " name=" . $val->name . "</input>";
				}
				echo "<table>";
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
	



	<?php
	//echo "Yay";
	/*$result = $mysqli->query("SELECT * from actor");
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